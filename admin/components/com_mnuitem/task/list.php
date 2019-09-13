<?php
    defined('ISHOME') or die('Can not acess this page, please come back!');
    define('OBJ_PAGE','MNUITEM');
    $strwhere='';

    // Khai báo SESSION
    $keyword    = isset($_GET['q']) ? addslashes(trim($_GET['q'])) : '';
    $action     = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';
    $mnuid      = isset($_GET['mnuid']) ? (int)$_GET['mnuid'] : 0;

    // Get menu info
    $sql_menu = "SELECT * FROM tbl_menus WHERE id = ".$mnuid;
    $objmysql->Query($sql_menu);
    $r_menu = $objmysql->Fetch_Assoc();

    // Gán strwhere
    if($keyword !== ''){
        $strwhere.=" AND ( `name` like '%$keyword%' )";
    }
    if($action !== '' && $action !== 'all' ){
        $strwhere.=" AND `isactive` = '$action'";
    }
    if($mnuid !== 0){
        $strwhere.=" AND `menu_id` = '$mnuid'";
    }

    // Begin pagging
    if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
        $_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
    }
    if(isset($_POST['txtCurnpage'])){
        $_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
    }

    $sql = "SELECT COUNT(*) AS count FROM tbl_mnuitems WHERE 1=1 ".$strwhere;
    $objmysql->Query($sql);
    $row_count = $objmysql->Fetch_Assoc();
    $total_rows = $row_count['count'];

    if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/MAX_ROWS_ADMIN)){
        $_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/MAX_ROWS_ADMIN);
    }
    $cur_page = (int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;
    // End pagging
?>

<h1 style="margin: 10px 0;"><?php echo $r_menu['name'];?></h1>
<div class="com_header color">
    <form id="frm_list" method="get" action="<?php echo ROOTHOST_ADMIN.COMS.'/'.$mnuid;?>">
        <div class="frm-search-box form-inline pull-left">
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
                    <li><a class="addnew btn btn-default" href="<?php echo ROOTHOST_ADMIN.COMS.'/'.$mnuid;?>/add" title="Thêm mới"><i class="fa fa-plus-circle cgreen" aria-hidden="true"></i> Thêm mới</a></li>
                    <li><a class="delete btn btn-default" href="#" onclick="javascript:if(confirm('Bạn có chắc chắn muốn xóa thông tin này không?')){dosubmitAction('frm_menu','delete'); }" title="Xóa"><i class="fa fa-times-circle cred" aria-hidden="true"></i> Xóa</a></li>
                </ul>
            </form>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<form id="frm_list" name="frm_list" method="post" action="">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr class="header">
                <th width="30" align="center">#</th>
                <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
                <th width="50" align="center">Parent ID</th>
                <th align="center">Tên</th>
                <th align="center">Mã</th>
                <th width="100" align="center">Kiểu hiển thị</th>
                <th width="70" style="text-align: center;">Sắp xếp
                    <a href="javascript:saveOrder()">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </a>
                </th>
                <th>Hiển thị</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            <?php $obj->listTableItemMenu($strwhere,0,0,0); ?>
        </table>
    </div>
</form>
<?php //----------------------------------------------?>