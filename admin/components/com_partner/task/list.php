<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','PARTNER');
$strwhere='';

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

$sql="SELECT COUNT(*) AS count FROM tbl_partner WHERE 1=1 ".$strwhere;
$objmysql->Query($sql);
$row_count = $objmysql->Fetch_Assoc();
$total_rows = $row_count['count'];

if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/MAX_ROWS_ADMIN)){
    $_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/MAX_ROWS_ADMIN);
}
$cur_page = (int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;
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
<div class=''>
    <div class="com_header color">
        <i class="fa fa-list" aria-hidden="true"></i> Danh sách đối tác
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
    </div>
</div><br>
<div class='col-md-12 user_list'>
	<div class="table-responsive">
		<table class="table table-bordered">
			<tr class="header">
                <th width="30" align="center">#</th>
                <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
                <th align="center">Logo</th>
                <th align="center">Đối tác</th>
                <th width="70" align="center" style="text-align: center;">Sắp xếp
                    <a href="javascript:saveOrder()"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                </th>
                <th width="50" align="center">Hiển thị</th>
                <th width="50" align="center">Sửa</th>
                <th width="50" align="center">Xóa</th>
            </tr>
            <?php
            $star = ($cur_page - 1) * MAX_ROWS;
            $leng = MAX_ROWS;
            $sql = "SELECT * FROM tbl_partner ".$strwhere." ORDER BY `order` ASC LIMIT ".$star.", ".$leng;
            $objmysql->Query($sql);  $i=0;
            while($rows = $objmysql->Fetch_Assoc()){
                $i++;
                $ids=$rows['id'];
                $img=$rows['images']!=''?"<img src='".$rows['images']."' height='80'/>":'';
                $title=Substring(stripslashes($rows['name']),0,10);
                if($rows['isactive']==1) 
                    $icon_active="<i class='fa fa-check cgreen' aria-hidden='true'></i>";
                else $icon_active='<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';

                echo "<tr name=\"trow\">";
                echo "<td width=\"30\" align=\"center\">$i</td>";
                echo "<td width=\"30\" align=\"center\"><label>";
                echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\"   onclick=\"docheckonce('chk');\" value=\"$ids\" />";
                echo "</label></td>";
                echo "<td>$img</td>";
                echo "<td title=''>$title</td>";
                $order=$rows['order'];
                echo "<td align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
                echo "<td align=\"center\">";
                echo "<a href=\"".ROOTHOST_ADMIN.COMS."/active/$ids\">";
                echo $icon_active;
                echo "</a></td>";
                echo "<td align=\"center\">";
                echo "<a href=\"".ROOTHOST_ADMIN.COMS."/edit/$ids\">";
                echo "<i class='fa fa-edit' aria-hidden='true'></i>";
                echo "</a></td>";
                echo "<td align='center' width='10'><a href='".ROOTHOST_ADMIN.COMS."/delete/$ids' onclick=\" return confirm('Bạn chắc chắn muốn xóa ?')\"><i class='fa fa-trash cgray' aria-hidden='true'></i></a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
        <tr>
            <td align="center">
                <?php
                paging($total_rows,MAX_ROWS,$cur_page);
                ?>
            </td>
        </tr>
    </table>
</div>
<?php //----------------------------------------------?>
