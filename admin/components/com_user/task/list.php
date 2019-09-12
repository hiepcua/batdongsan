<?php
	$strwhere = 'WHERE 1=1 ';
	$txt_search = isset($_GET['q']) ? addslashes(trim($_GET['q'])) : '';
	$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';
	$objmysql = new CLS_MYSQL();

	if($txt_search !== ''){
		$strwhere.= " AND username ='".$txt_search."' OR firstname LIKE '%".$txt_search."%' OR lastname LIKE '%".$txt_search."%'";
	}
	if($action !=='' && $action !== 'all'){
		$strwhere.=" AND `isactive` = '$action'";
	}

	$sql="SELECT COUNT(*) AS count FROM tbl_user ". $strwhere;
	$objmysql->Query($sql);
	$row_count = $objmysql->Fetch_Assoc();
	$total_rows = $row_count['count'];

	// Pagging
	if(!isset($_SESSION['CUR_PAGE_USER']))
		$_SESSION['CUR_PAGE_USER']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_USER']=(int)$_POST['txtCurnpage'];
	}
?>
<div id="path">
	<ol class="breadcrumb">
		<li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
		<li class="active">Danh sách người dùng</li>
	</ol>
</div>
<form id="frm_list" method="get" action="<?php echo ROOTHOST_ADMIN;?>user">
	<div class="frm-search-box form-inline pull-left">
		<label class="mr-sm-2" for="">Từ khóa: </label>
		<input class="form-control mb-2 mr-sm-2 mb-sm-0" type="text" value="<?php echo $txt_search?>" name="q" id="txtkeyword" placeholder="Keyword" value=""/>&nbsp;
		<button type="submit" id="_btnSearch" class="btn btn-success">Tìm kiếm</button>
		<select name="cbo_action" class="form-control" id="cbo_active">
			<option value="all">Tất cả</option>
			<option value="1">Hiển thị</option>
			<option value="0">Ẩn</option>
			<script language="javascript">
				cbo_Selected('cbo_active','<?php echo $action;?>');
			</script>
		</select>
	</div>
</form>
<div class="pull-right">
	<a href="<?php echo ROOTHOST_ADMIN.'user/add' ?>" class="btn btn-success button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
</div>
<div class="clearfix"></div>
<div style="height: 15px;"></div>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th width="30">#</th>
			<th>Username</th>
			<th>Fullname</th>
			<th>Cơ quan</th>
			<th>Phone</th>
			<th>Giới tính</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if($total_rows>0){
			$i=0;
			$sql1="SELECT * FROM tbl_user ". $strwhere;
			$objmysql->Query($sql1);
			while ($row = $objmysql->Fetch_Assoc()) {
				$i++;
				$ids=$row["id"];
				$username = stripslashes($row['username']);
				$fullname=$row["lastname"].' '.$row["firstname"];
				$phone = $row['phone'];
				$organ = stripslashes($row['organ']);
				if((int)$row['gender']==0) $gender="Nam";
				else $gender="Nữ";

				$edit_url = ROOTHOST_ADMIN."user/edit/".$ids;
				$delete_url = ROOTHOST_ADMIN."user/delete/".$ids;
				$active_url = ROOTHOST_ADMIN."user/active/".$ids;

				if($row['isactive']==1){
					$img = '<a href="'.$active_url.'" title="Hiển thị"><i class="fa fa-check green" aria-hidden="true"></i>Public</a>';
				}else{
					$img = '<a href="'.$active_url.'" title="Hiển thị"><i class="fa fa-times red" aria-hidden="true"></i>Public</a>';
				}

				echo '<tr class="trow">';
				echo '<td width="center">'.$i.'</td>';
				echo '<td>'.$username.'</td>';
				echo '<td>'.$fullname.'</td>';
				echo '<td>'.$organ.'</td>';
				echo '<td>'.$phone.'</td>';
				echo '<td>'.$gender.'</td>';
				echo '<td class="tbl_actions">
				'.$img.'
				<a href="'.$edit_url.'" title="Sửa"><i class="fa fa-pencil-square-o blue" aria-hidden="true"></i>Edit</a>
				<a href="'.$delete_url.'" title="Xóa" onclick="return confirm(\'Bạn có chắc muốn xóa ?\')"><i class="fa fa-trash red" aria-hidden="true"></i>Delete</a>
				</td>
				</tr>';
			}
		}else{ echo 'Chưa có người dùng.';}?>
	</tbody>
</table>
<div class="clearfix"></div>

