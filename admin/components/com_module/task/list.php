<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','MODULE');
$strwhere='';

// Khai báo SESSION
$keyword 	= isset($_GET['q']) ? addslashes(trim($_GET['q'])) : '';
$action 	= isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';
$position 	= isset($_GET['cbo_position']) ? addslashes(trim($_GET['cbo_position'])) : '';

// Gán strwhere
if($keyword !== ''){
    $strwhere.=" AND ( `title` like '%$keyword%' )";
}
if($action !== '' && $action !== 'all' ){
    $strwhere.=" AND `isactive` = '$action'";
}
if($position !== '' && $position !== 'all' ){
	$strwhere.=" AND `position` = '".$position."'";
}

// Begin pagging
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
    $_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
}
if(isset($_POST['txtCurnpage'])){
    $_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
}

$sql="SELECT COUNT(*) AS count FROM tbl_modules WHERE 1=1 ".$strwhere;
$objmysql->Query($sql);
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
		var strids=document.getElementById('txtids');
		if(strids.value==''){
			alert('Bạn chưa chọn đối tượng nào');
			return false;
		}
		return true;
	}
</script>

<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li class="active">Danh sách module</li>
    </ol>
</div>

<div class="com_header color">
    <form id="frm_list" method="get" action="<?php echo ROOTHOST_ADMIN.COMS;?>">
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
            <select name="cbo_position" id="cbo_position" onchange="document.frm_list.submit();" class="form-control">
            	<option value="all">Select position</option>
            	<?php $obj->getPosition(); ?>
            	<script language="javascript">
            		cbo_Selected('cbo_position','<?php echo $position;?>');
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
</div>

<table class="table table-bordered">
	<tr class="header">
		<th width="30" align="center">STT</th>
		<th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
		<th align="center">Tiêu đề</th>
		<th width="75" align="center">Kiểu</th>
		<th width="75" align="center">Giao diện</th>
		<th width="75" align="center">Vị trí</th>
		<th width="70" style="text-align: center;">Sắp xếp
			<a href="javascript:saveOrder()">
				<i class="fa fa-floppy-o" aria-hidden="true"></i>
			</a>
		</th>
		<th width="50" align="center">Hiển thị</th>
		<th width="50" align="center">Sửa</th>
		<th width="50" align="center">Xóa</th>
	</tr>
	<?php
	$i = 0;
	$start = ($cur_page-1) * 20;
	$sql = "SELECT * FROM `tbl_modules` WHERE 1=1 ".$strwhere." ORDER BY `position` ASC, `order` ASC LIMIT ".$start.",20";
	$objmysql->Query($sql);
	while($rows = $objmysql->Fetch_Assoc()){ $i++; ?>
	<tr>
		<td align='center'><?php echo $i;?></td>
		<td align='center'><input type="checkbox" name="chk" id="chk" value="<?php echo $rows['id'];?>" onclick="docheckonce('chk');" /></td>
		<td><?php echo stripslashes($rows['title']);?></td>
		<td align='center'><?php echo $rows['type'];?></td>
		<td align='center'><?php echo $rows['theme'];?></td>
		<td align='center'><?php echo $rows['position'];?></td>
		<td align="center" width='50'>
			<input type="text" value="<?php echo $rows['order'];?>" name='txt_order' size='4' class='order'/>
		</td>

		<td width='50' align="center">
			<a href="<?php echo ROOTHOST_ADMIN.COMS;?>/active/<?php echo $rows["id"];?>">
				<?php showIconFun('publish',$rows["isactive"]);?>
			</a>
		</td>
		<td width='50' align="center">
			<a href="<?php echo ROOTHOST_ADMIN.COMS;?>/edit/<?php echo $rows["id"];?>">
				<?php showIconFun('edit','');?>
			</a>
		</td>
		<td width='50' align="center">
			<a href="<?php echo ROOTHOST_ADMIN.COMS;?>/delete/<?php echo $rows["id"];?>" onclick="return confirm('Bạn có chắc muốn xóa ?');">
				<?php showIconFun('delete','');?>
			</a>
		</td>
	</tr>
	<?php } unset($obj); unset($start);?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
	<tr>
		<td align="center"><?php paging($total_rows, '20', $cur_page);?></td>
	</tr>
</table>
<?php //----------------------------------------------?>