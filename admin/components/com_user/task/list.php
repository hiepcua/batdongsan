<?php
$strwhere = 'WHERE 1=1 ';
$txt_search = '';
$objmysql = new CLS_MYSQL();

if(isset($_GET['q'])){
	$txt_search = trim($_GET['q']);
	$strwhere.= " AND username ='".$txt_search."' OR firstname LIKE '%".$txt_search."%' OR lastname LIKE '%".$txt_search."%'";
}

$sql="SELECT COUNT(*) FROM tbl_user ". $strwhere;
$objmysql->Query($sql);
$total_rows = $objmysql->Num_rows();

// Pagging
if(!isset($_SESSION['CUR_PAGE_USER']))
	$_SESSION['CUR_PAGE_USER']=1;
if(isset($_POST['txtCurnpage'])){
	$_SESSION['CUR_PAGE_USER']=(int)$_POST['txtCurnpage'];
}
?>
<div class="page">
	<div class='page-content'>
		<div class='row'>
			<div class="com_header color">
				<i class="fa fa-list" aria-hidden="true"></i>  Danh sách người dùng
				<div class="pull-right">
					<a href="<?php echo ROOTHOST_ADMIN."user/add";?>" class="btn btn-default"><i class="fa fa-user-plus" aria-hidden="true"></i> Thêm mới người dùng</a>
				</div>
			</div>
		</div>
		<div class='list_search' style="margin-bottom: 20px;">
			<!-- Search form -->
			<form method='GET' action="<?php echo ROOTHOST_ADMIN;?>user">
				<div class='row'>
					<div class='col-md-4 col-sm-6'>
						<div class="box-search">
							<input type="text" class="form-control" name="q" value="<?php echo $txt_search; ?>" placeholder="Tìm kiếm ...">
							<button type="submit" class="btn btn-default">Tìm kiếm</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="clearfix"></div>
		<div class="list">
			<table class="table table-bordered">
				<thead class="table-dark">
					<tr>
						<th width="30">#</th>
						<th width="10">&nbsp;</th>
						<th>Username</th>
						<th>Fullname</th>
						<th>Cơ quan</th>
						<th>Phone</th>
						<th>Giới tính</th>
						<th colspan="2"></th>
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
							if($row['isactive']==1)	$i_active='fa fa-check cgreen';
							else $i_active='fa fa-times cred';

							$edit_url = ROOTHOST_ADMIN."user/edit/".$ids;
							$delete_url = ROOTHOST_ADMIN."user/delete/".$ids;
							$active_url = ROOTHOST_ADMIN."user/active/".$ids;

							echo '<tr class="trow">';
							echo '<td width="center">'.$i.'</td>';
							echo '<td width="center">
							<a href="'.$delete_url.'" title="Xóa" onclick="return confirm(\'Bạn có chắc muốn xóa trường này?\');"><i class="fa fa-times cred" aria-hidden="true"></i></a>
							</td>';
							echo '<td>'.$username.'</td>';
							echo '<td>'.$fullname.'</td>';
							echo '<td>'.$organ.'</td>';
							echo '<td>'.$phone.'</td>';
							echo '<td>'.$gender.'</td>';
							echo '
							<td width="10"><a href="'.$edit_url.'" title="Sửa"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
							<td width="10"><a href="'.$active_url.'" title="Ẩn/hiện"><i class="'.$i_active.'" aria-hidden="true"></i></a></td>';
							echo '</tr>';
						}
					}else{ echo 'Chưa có người dùng.';}?>
				</tbody>
			</table>
			<div class="clearfix"></div>
		</div>
	</div>
</div>