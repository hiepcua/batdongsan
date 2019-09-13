<?php
if($UserLogin->isLogin()) {
	$PERMISSION = $UserLogin->getInfo('isroot');
}
$objmysql = new CLS_MYSQL();
?>
<div id="left_sidebar">
	<div class="sidebar_top"></div>
	<ul class="sidebar_body">
		<li>
			<a href="<?php echo ROOTHOST_ADMIN;?>" class='toggle' data-toggle="tooltip" data-placement="right" data-original-title="Trang Admin" style="font-weight: bold; border-bottom: 0px;">
				<i class="fa fa-desktop" aria-hidden="true"></i> <span>Bảng điều khiển</span>
			</a>
		</li>

		<li>
			<div class="title"><i class="fa fa-list" aria-hidden="true"></i> <span>Bài viết</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>contents/add" title="Thêm bài viết"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm bài viết</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>contents" title="Ds bài viết"><i class="fa fa-bars" aria-hidden="true"></i> <span>Danh sách bài viết</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-list" aria-hidden="true"></i> <span>Nhóm tin</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>category/add" title="Thêm nhóm tin"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm nhóm tin</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>category" title="Ds nhóm tin"><i class="fa fa-bars" aria-hidden="true"></i> <span>Danh sách nhóm tin</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-list" aria-hidden="true"></i> <span>Loại hình đất đai</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>type_of_land/add" title="Thêm loại hình đất"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm mới</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>type_of_land" title="Ds loại hình đất"><i class="fa fa-bars" aria-hidden="true"></i> <span>Ds loại hình đất</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-list" aria-hidden="true"></i> <span>Menu</span></div>
			<ul class="sub">
				<?php 
				$sql_menu="SELECT * FROM tbl_menus WHERE isactive = 1";
				$objmysql->Query($sql_menu);
				while($rows = $objmysql->Fetch_Assoc()){
					echo "<li><a href=\"".ROOTHOST_ADMIN."mnuitem/".$rows["id"]."\"><i class=\"fa fa-bars\" aria-hidden=\"true\"></i>".$rows["name"]."</a></li>";
				}
				?>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>menus"><i class="fa fa-bars" aria-hidden="true"></i>QL menu</a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-list" aria-hidden="true"></i> <span>Đối tác</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>partner/add" title="Thêm đối tác"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm đối tác</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>partner" title="Ds đối tác"><i class="fa fa-bars" aria-hidden="true"></i> <span>Danh sách đối tác</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-picture-o" aria-hidden="true"></i><span>Thư viện ảnh</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>gallery/add" title="Thêm mới"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm mới</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>gallery" title="Thư viện ảnh"><i class="fa fa-bars" aria-hidden="true"></i> <span>Thư viện ảnh</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-picture-o" aria-hidden="true"></i><span>Thư viện video</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>video/add" title="Thêm mới"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm mới</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>video" title="Ds video"><i class="fa fa-bars" aria-hidden="true"></i> <span>Ds video</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-list" aria-hidden="true"></i> <span>Banner</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>slider/add" title="Thêm banner"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm banner</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>slider" title="Banner"><i class="fa fa-bars" aria-hidden="true"></i> <span>Banner</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-list" aria-hidden="true"></i> <span>Cảm nhận khách hàng</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>feedback/add" title="Thêm cảm nhận"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm cảm nhận</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>feedback" title="Cảm nhận khách hàng"><i class="fa fa-bars" aria-hidden="true"></i> <span>Cảm nhận khách hàng</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-users" aria-hidden="true"></i> <span>Qlý người dùng</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>user/add" title="Thêm mới người dùng"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm mới</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>user" title="Danh sách người dùng"><i class="fa fa-bars" aria-hidden="true"></i> <span>Ds người dùng</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-users" aria-hidden="true"></i> <span>Qlý nhóm người dùng</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>user_group/add" title="Thêm mới nhóm người dùng"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm mới</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>user_group" title="Danh sách nhóm người dùng"><i class="fa fa-bars" aria-hidden="true"></i> <span>Ds nhóm người dùng</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-users" aria-hidden="true"></i> <span>Qlý module</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>module/add" title="Thêm mới module"><i class="fa fa-plus" aria-hidden="true"></i> <span>Thêm mới module</span></a></li>
				<li><a href="<?php echo ROOTHOST_ADMIN;?>module" title="Danh sách module"><i class="fa fa-bars" aria-hidden="true"></i> <span>Ds module</span></a></li>
			</ul>
		</li>

		<li>
			<div class="title"><i class="fa fa-cogs" aria-hidden="true"></i> <span>Cấu hình</span></div>
			<ul class="sub">
				<li><a href="<?php echo ROOTHOST_ADMIN;?>config/" title="Cấu hình website"><i class="fa fa-bars" aria-hidden="true"></i> <span>Cấu hình website</span></a></li>
			</ul>
		</li>
	</ul>
</div>
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	})
</script>