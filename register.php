<?php
session_start();
ini_set("display_errors",1);

require_once("global/libs/gfinit.php");
require_once("global/libs/gfconfig.php");
require_once("global/libs/gffunc.php");
require_once('libs/cls.mysql.php');
require_once('libs/cls.template.php');
require_once("libs/cls.contents.php");
require_once("libs/cls.category.php");
require_once("libs/cls.register.php");
require_once('libs/cls.module.php');
require_once('libs/cls.configsite.php');
require_once('libs/cls.tag.php');

$tmp = new CLS_TEMPLATE();
$conf = new CLS_CONFIG();
$conf->load_config();
global $tmp; global $conf;

if(isset($_POST['fullname'])) {
	$fullname = addslashes(strip_tags($_POST['fullname']));
	$cmt = addslashes(strip_tags($_POST['CMTND']));
	$sn = addslashes(strip_tags($_POST['birthday']));
	$sn = str_replace("-","/",$sn);
	$birthday = $sn;
	$gender = addslashes(strip_tags($_POST['gender']));
	$Hokhau = addslashes(strip_tags($_POST['Hokhau']));
	$Email = addslashes(strip_tags($_POST['Email']));
	$Dienthoai = addslashes(strip_tags($_POST['Dienthoai']));
	$year = (int)$_POST['year'];
	$address = addslashes(strip_tags($_POST['address']));
	$nganh = addslashes(strip_tags($_POST['nganh']));
	
	$objdata = new CLS_MYSQL();
	$sql = "INSERT INTO tbl_profile (`fullname`,`cmtnd`,`birthday`,`gender`,`household`,
	`address`,`tel`,`email`,`year`,`branch`,`cdate`) VALUES('$fullname','$cmt','$birthday',
	'$gender','$Hokhau','$address','$Dienthoai','$Email','$year','$nganh','".date("Y-m-d H:i:s")."')";
	if ($objdata->Query($sql)) 
		echo "<script>window.location='".ROOTHOST."dang-ky-xet-tuyen-thanh-cong.html'</script>";
} ?>
<!DOCTYPE html>
<html language='vi'>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex, nofollow" />
	<meta property="og:type" content="website" />
	<meta property="og:author" content='<?php echo $conf->CompanyName;?>' />
	<meta property="og:locale" content='vi_VN'/>
	<meta property="og:title" content="<?php echo $conf->Title;?>"/>
	<meta property="og:keywords" content='<?php echo $conf->Meta_key;?>' />
	<meta property='og:description' content='<?php echo $conf->Meta_desc;?>' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo ROOTHOST;?>imgs/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo ROOTHOST;?>imgs/favicon.ico">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo ROOTHOST;?>imgs/favicon.ico">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo ROOTHOST;?>imgs/favicon.ico">
	<title>ĐĂNG KÝ THÔNG TIN XÉT TUYỂN ĐẠI HỌC - <?php echo $conf->Title;?></title>
	<link rel="stylesheet" href="<?php echo ROOTHOST;?>global/css/bootstrap.min.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo ROOTHOST;?>global/css/font-awesome.min.css" type="text/css" media="all" >
	<link rel="stylesheet" href="<?php echo ROOTHOST;?>owl-carousel/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="<?php echo ROOTHOST;?>owl-carousel/owl.theme.css" type="text/css">
	<link rel="stylesheet" href="<?php echo ROOTHOST;?>css/style.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo ROOTHOST;?>css/style.responsive.min.css" type="text/css" />
	
	<script src="<?php echo ROOTHOST;?>global/js/jquery-1.11.2.min.js"></script>
	<script src="<?php echo ROOTHOST;?>global/js/bootstrap.min.js"></script>
	<script src='<?php echo ROOTHOST;?>owl-carousel/owl.carousel.js'></script>
	<script src="<?php echo ROOTHOST_ADMIN;?>js/script.min.js"></script>
	<script src="<?php echo ROOTHOST;?>js/main.js"></script>
</head>
<body>
<form action="#" enctype="multipart/form-data" method="post">  
<div class="wrapper_register">
	<?php $tmp->loadModule('user8'); ?>
    <div class="container"><div class="row">
		<div class="colmain col-xs-12">
			<div class="title text-center"><h1><span>
			ĐĂNG KÝ THÔNG TIN XÉT TUYỂN ĐẠI HỌC NĂM 2018</span></h1></div>
			<div style="font-size:18px; font-weight:500; margin-bottom:30px; text-align:center">
				Các thông tin đăng ký dưới đây nhằm đăng ký thông tin để được Đại học Đông Đô tư vấn tuyển sinh 
				<br>giúp các bạn thí sinh có thêm thông tin về tuyển sinh Đại học hệ chính quy của nhà Trường.
			</div>
			<div class="col-md-8 col-lg-offset-2">
				<div class="col-md-12">
					<div class="col-md-12">
						<strong>Họ và tên</strong>
						<div class="form-group">
							<input class="form-control" id="fullname" name="fullname" placeholder="Nhập đầy đủ họ và tên" type="text" value="" required>
							<span class="msg_fullname text-danger"></span>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4">
						<strong>CMTND/CCCD</strong>
						<div class="form-group">
							<input class="form-control" id="CMTND" name="CMTND" placeholder="Nhập số CMTND hoặc thẻ căn cước" type="text" value="">
							<span class="msg_cmt text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<strong>Ngày sinh</strong>
						<div class="form-group">
							<input class="form-control" id="birthday" name="birthday" placeholder="Ngày/tháng/năm" type="text" value="">
							<span class="msg_birthday text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<strong>Giới tính</strong>
						<div class="form-group">
							<select class="form-control" name="gender" required>
								<option value="">-- Chọn giới tính -- </option>
								<option value="Nam">Nam</option>
								<option value="Nữ">Nữ</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-12">
						<strong>Hộ khẩu thường trú: </strong>
						<div class="form-group">
							<input class="form-control" id="Hokhau" name="Hokhau" placeholder="Nhập địa chỉ theo hộ khẩu thường trú" type="text" value="">
							<span class="msg_hokhau text-danger"></span>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4">
						<strong>Email</strong>
						<div class="form-group">
							<input class="form-control" id="Email" name="Email" placeholder="VD: email@gmail.com" type="email" value="">
							<span class="msg_email text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<strong>Điện thoại</strong>
						<div class="form-group">
							<input class="form-control" id="Dienthoai" name="Dienthoai" placeholder="VD: 0983 282 282" type="text" value="" required>
							<span class="msg_tel text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<strong>Năm tốt nghiệp THPT:</strong>
						<div class="form-group">
							<input class="form-control" id="year" name="year" placeholder="Nhập năm bạn tốt nghiệp" type="text" value="" required>
							<span class="msg_year text-danger"></span>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-12">
						<strong>Địa chỉ: </strong><i>(Ghi rõ địa chỉ của bạn)</i>
						<div class="form-group">
							<input class="form-control" id="address" name="address" placeholder="Nhập đầy đủ họ tên và địa chỉ nơi bạn nhận hồ sơ thông báo" type="text" value="" required>
							<span class="msg_address text-danger"></span>
						</div>
					</div>
				</div>
				<div class="col-md-12 margin-bottom-5">
					<div class="col-md-12 margin-bottom-5">
						<strong>Ngành đăng ký xét tuyển</strong>
						<div class="form-group">
							<select class="form-control" id="nganh" name="nganh" required>
								<option value="">-- Lựa chọn ngành -- </option>
								<option value="Công nghệ kỹ thuật Môi trường">Công nghệ kỹ thuật Môi trường</option>
								<option value="Công nghệ sinh học">Công nghệ sinh học</option>
								<option value="Công nghệ Thông tin">Công nghệ Thông tin</option>
								<option value="Công nghệ Kỹ thuật ô tô">Công nghệ Kỹ thuật ô tô</option>
								<option value="Điều Dưỡng">Điều Dưỡng</option>
								<option value="Luật kinh tế">Luật kinh tế</option>
								<option value="Ngôn ngữ Anh">Ngôn ngữ Anh</option>
								<option value="Ngôn ngữ Anh – Nhật">Ngôn ngữ Anh – Nhật</option>
								<option value="Ngôn ngữ Anh – Hàn">Ngôn ngữ Anh – Hàn</option>
								<option value="Ngôn ngữ Nhật">Ngôn ngữ Nhật</option>
								<option value="Ngôn ngữ Trung">Ngôn ngữ Trung</option>
								<option value="Kế toán">Kế toán</option>
								<option value="Kỹ thuật Xây dựng">Kỹ thuật Xây dựng</option>
								<option value="Kiến Trúc">Kiến Trúc</option>
								<option value="Kỹ thuật điện tử, truyền thông">Kỹ thuật điện tử, truyền thông</option>
								<option value="Quan hệ Quốc tế">Quan hệ Quốc tế</option>
								<option value="Quản trị Kinh doanh">Quản trị Kinh doanh</option>
								<option value="Quản lý nhà nước">Quản lý nhà nước</option>
								<option value="Tài chính Ngân hàng">Tài chính Ngân hàng</option>
								<option value="Việt nam học">Việt nam học (Du lịch)</option>
								<option value="Thông tin - Thư viện">Thông tin - Thư viện</option>
								<option value="Thương mại điện tử">Thương mại điện tử</option>
								<option value="Thú y">Thú y</option>
							</select>
							<span class="msg_nganh text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 text-center btnsave">
				<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-check"></i> Đăng ký</button>
			</div>
		</div>
    </div></div>
</div>
</form>
</body>
</html>