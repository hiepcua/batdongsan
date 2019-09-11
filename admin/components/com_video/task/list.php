<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','VIDEO');
$keyword='';
if(isset($_POST['txtkeyword'])){
    $keyword=trim($_POST['txtkeyword']);
    $_SESSION['KEY_'.OBJ_PAGE]=$keyword;
}
$strwhere='Where 1=1';
if(isset($_POST['cbo_active']))
    $_SESSION['ACT'.OBJ_PAGE]=addslashes($_POST['cbo_active']);

if(isset($_SESSION['KEY_'.OBJ_PAGE]) && $keyword!='')
    $keyword=$_SESSION['KEY_'.OBJ_PAGE];
else
    $keyword='';

$action=isset($_SESSION['ACT'.OBJ_PAGE]) ? $_SESSION['ACT'.OBJ_PAGE]:'';
if($keyword!='')
    $strwhere.=" AND(`name` like '%$keyword%')";

if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}


$obj->getList($strwhere);
$total_rows=$obj->Num_rows();
$cur_page=isset($_POST['txtCurnpage'])? (int)$_POST['txtCurnpage']:'1';
?>
<div class=''>
    <div class="com_header color">
        <i class="fa fa-list" aria-hidden="true"></i> Danh sách Video
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
                <th width="50" align="center">Xóa</th>
				<th width="200" align="center">Ảnh đại diện</th>
				<th align="center">Tên Video</th>
				<th align="center">Ngày đăng</th>
				<th align="center">Lượt xem</th>
                <th width="100" align="center" style="text-align: center;">Sắp xếp
                    <a href="javascript:saveOrder()"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                </th>
                <th width="70" align="center">isHot</th>
                <th width="70" align="center">Hiển thị</th>
                <th width="70" align="center">Sửa</th>
            </tr>
            <?php
            $obj->listTable($strwhere,$cur_page);
            ?>
        </table>
	</div>
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
