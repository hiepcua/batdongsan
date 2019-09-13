<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','MENUS');
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

$sql_count = "SELECT COUNT(*) AS count FROM tbll_menus WHERE 1=1 ".$strwhere;
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
		<li class="active">Danh sách Menu</li>
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
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<th width="30" align="center">#</th>
				<th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
				<th width="150" align="center">Mã</th>
				<th align="center">Tên</th>
				<th align="center">Mô tả</th>
				<th width="100" align="center">Menu chi tiết</th>
				<th colspan="3"></th>
			</thead>
			<?php
			$start = ($cur_page-1) * MAX_ROWS;
			$sql="SELECT * FROM tbl_menus WHERE 1=1 ".$strwhere." LIMIT $start,".MAX_ROWS;
			$objmysql->Query($sql);
			$i=0;
			while($rows= $objmysql->Fetch_Assoc()){ $i++;
				$id 	= $rows['id'];
				$code 	= $rows['code'];
				$name 	= Substring($rows['name'],0,10);
				$desc 	= $rows['desc'];

				if($rows['isactive']==1) 
					$icon_active="<i class='fa fa-check cgreen' aria-hidden='true'></i>";
				else $icon_active='<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';

				echo "<tr name='trow'>";
				echo "<td width='30' align='center'>$i</td>";
				echo "<td width='30' align='center'><label>";
				echo "<input type='checkbox' name='chk' id='chk' onclick=\"docheckonce('chk');\" value='$id' />";
				echo "</label></td>";
				echo "<td width='75'>$code</td>";
				echo "<td>$name</td>";
				echo "<td>$desc &nbsp;</td>";

				echo "<td align='center'>";
				echo "<a href='".ROOTHOST_ADMIN."mnuitem/$id'>";
				showIconFun('menuitem',0);
				echo "</a>";
				echo "</td>";

				echo "<td width='10' align='center'>";
				echo "<a href='".ROOTHOST_ADMIN.COMS."/active/$id'>";
				echo $icon_active;
				echo "</a>";
				echo "</td>";

				echo "<td width='10' align='center'>";

				echo "<a href='".ROOTHOST_ADMIN.COMS."/edit/$id'>";
				echo "<i class='fa fa-edit' aria-hidden='true'></i>";
				echo "</a>";

				echo "</td>";
				echo "<td width='10' align='center'>";

				echo "<a href='".ROOTHOST_ADMIN.COMS."/delete/$id' onclick=\"return confirm('Bạn có chắc muốn xóa?')\">";
				echo "<i class='fa fa-times-circle cred' aria-hidden='true'></i>";
				echo "</a>";

				echo "</td>";
				echo "</tr>";
			}
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
	<?php //----------------------------------------------?>