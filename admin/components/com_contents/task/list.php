<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','CONTENTS');
$strwhere='';

if(isset($_GET['cate'])){
    $cate_id = (int)$_GET['cate'];
    $name_category = $obj_cate->getNameById($cate_id);
    $strwhere.=" AND category_id = $cate_id ";
}

// Khai báo SESSION
$keyword = isset($_GET['q']) ? addslashes(trim($_GET['q'])) : '';
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';

// Gán strwhere
if($keyword !== ''){
    $strwhere.=" AND ( `name` like '%$keyword%' )";
}
if($action !== '' && $action !== 'all' ){
    $strwhere.=" AND `isactive` = '$action'";
}

// Begin pagging
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
    $_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
}
if(isset($_POST['txtCurnpage'])){
    $_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
}

$sql_count = "SELECT COUNT(*) AS count FROM tbl_contents WHERE 1=1 ".$strwhere;
$objmysql->Query($sql_count);
$row_count = $objmysql->Fetch_Assoc();
$total_rows = $row_count['count'];

if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/MAX_ROWS_ADMIN)){
    $_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/MAX_ROWS_ADMIN);
}
$cur_page=(int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;
// End pagging
?>

<script language="javascript">
    function checkinput(){
        var strids=document.getElementById("txtids");
        if(strids.value==""){
            alert('You are select once record to action');
            return false;
        }
        return true;
    }
</script>

<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li class="active">Danh sách bài tin</li>
    </ol>
</div>

<div class="com_header color">
    <form id="frm_list" method="get" action="<?php echo ROOTHOST_ADMIN.COMS;?>">
        <div class="frm-search-box form-inline pull-left">
            <label class="mr-sm-2" for="">Từ khóa: </label>
            <input class="form-control" type="text" value="<?php echo $keyword?>" name="q" id="txtkeyword" placeholder="Từ khóa"/>&nbsp;
            <button type="submit" id="_btnSearch" class="btn btn-success">Tìm kiếm</button>
            <select name="cbo_action" class="form-control" id="cbo_action">
                <option value="all">Tất cả</option>
                <option value="1">Hiển thị</option>
                <option value="0">Ẩn</option>
                <script language="javascript">
                    cbo_Selected('cbo_action','<?php echo $action;?>');
                </script>
            </select>
        </div>
    </form>
    <div class="pull-right">
        <div id="menus" class="toolbars">
            <form id="frm_menu" name="frm_menu" method="post" action="">
                <input type="hidden" name="txtorders" id="txtorders" />
                <input type="hidden" name="txtids" id="txtids" />
                <input type="hidden" name="txtaction" id="txtaction" />
                <ul class="list-inline">
                    <li><button class="btn btn-default" onclick="dosubmitAction('frm_menu','public');"><i class="fa fa-check-circle-o cgreen" aria-hidden="true"></i> Hiển thị</button></li>
                    <li><button class="btn btn-default" onclick="dosubmitAction('frm_menu','unpublic');"><i class="fa fa-times-circle-o cred" aria-hidden="true"></i> Ẩn</button></li>
                    <li><a class="addnew btn btn-default" href="<?php echo ROOTHOST_ADMIN.COMS;?>/add" title="Thêm mới"><i class="fa fa-plus-circle cgreen" aria-hidden="true"></i> Thêm mới</a></li>
                    <li><a class="delete btn btn-default" href="#" onclick="javascript:if(confirm('Bạn có chắc chắn muốn xóa thông tin này không?')){dosubmitAction('frm_menu','delete'); }" title="Xóa"><i class="fa fa-times-circle cred" aria-hidden="true"></i> Xóa</a></li>
                </ul>
            </form>
        </div>
    </div>
</div><br>
<div class="clearfix"></div>


<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <th width="30" align="center">STT</th>
            <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
            <th>Nhóm tin</th>
            <th>Bài tin</th>
            <th align="center" width="100">Ngày đăng</th>
            <th align="center" width="70">Lượt xem</th>
            <th width="70" align="center" style="text-align: center;">Sắp xếp
                <a href="javascript:saveOrder()"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
            </th>
            <th colspan="3"></th>
        </thead>
        <tbody>
            <?php
            $star = ($cur_page - 1) * MAX_ROWS_ADMIN;
            $sql = "SELECT * FROM tbl_contents WHERE 1=1 $strwhere ORDER BY `id` DESC LIMIT $star,".MAX_ROWS_ADMIN;
            $objmysql->Query($sql);
            $i = 0;
            while($rows = $objmysql->Fetch_Assoc()){
                $i++;
                $ids        = $rows['id'];
                $cat_id     = $rows['category_id'];
                $title      = Substring(stripslashes($rows['title']),0,10);
                $cdate      = date('d-m-Y H:i:sa',strtotime($rows['cdate']));
                $visited    = number_format($rows['visited']);
                $order      = number_format($rows['order']);
                if($rows['thumb'] == '')
                    $thumb  = '<img src="'.IMG_DEFAULT.'" alt="'.$title.'" width="60px">';
                else $thumb = '<img src="'.$rows["thumb"].'" alt="'.$title.'" width="60px">';

                if($rows['isactive'] == 1) 
                    $icon_active    = "<i class='fa fa-check cgreen' aria-hidden='true'></i>";
                else $icon_active   = '<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';

                // Get category name
                $sql_cate = "SELECT name FROM tbl_categories WHERE id = ".$cat_id;
                $objmysql2 = new CLS_MYSQL();
                $objmysql2->Query($sql_cate);
                $r_cate = $objmysql2->Fetch_Assoc();
                $category   = $r_cate['name'];
                // End Get category name

                echo "<tr name='trow'>";
                echo "<td width='30' align='center'>$i</td>";
                echo "<td width='30' align='center'><label>";
                echo "<input type='checkbox' name='chk' id='chk' onclick=\"docheckonce('chk');\" value='$ids'/>";
                echo "</label></td>";
                echo "<td>$category</td>";
                echo "<td>$title</td>";
                echo "<td>$cdate</td>";
                echo "<td align='center'>$visited</td>";

                echo "<td width='50' align='center'><input type='text' name='txt_order' id='txt_order' value='$order' size='4' class='order'></td>";

                echo "<td align='center' width='10'><a href='".ROOTHOST_ADMIN.COMS."/active/$ids'>".$icon_active."</a></td>";

                echo "<td align='center' width='10'><a href='".ROOTHOST_ADMIN.COMS."/edit/$ids'><i class='fa fa-edit' aria-hidden='true'></i></a></td>";

                echo "<td align='center' width='10'><a href='".ROOTHOST_ADMIN.COMS."/delete/$ids' onclick=\" return confirm('Bạn có chắc muốn xóa ?')\"><i class='fa fa-times-circle cred' aria-hidden='true'></i></a></td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
        <tr>
            <td align="center">
                <?php 
                paging($total_rows,MAX_ROWS_ADMIN,$cur_page);
                ?>
            </td>
        </tr>
    </table>
</div>

<?php //----------------------------------------------?>