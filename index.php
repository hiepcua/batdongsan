<?php
session_start();
ini_set("display_errors", 1);
define("ISHOME", true);
if (!isset($_SESSION['LANGUAGE'])) {
	$_SESSION['LANGUAGE'] = '0';
}
$isMobile = (bool) preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet' .
	'|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]' .
	'|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT']);
$actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

require_once "global/libs/gfinit.php";
require_once "global/libs/gfconfig.php";
require_once "global/libs/gffunc.php";
include_once "libs/cls.video.php";
include_once "libs/cls.album.php";
include_once "libs/cls.gallery.php";
include_once "libs/cls.partner.php";
include_once "libs/cls.video.php";
include_once "libs/cls.document.php";
include_once "libs/cls.register.php";

if (isset($_POST['txtlang'])) {
	$_SESSION['LANGUAGE'] = (int) $_POST['txtlang'];
	echo "<script language=\"javascript\">window.location='" . ROOTHOST . "'</script>";
}
if (isset($_SESSION['LANGUAGE']) && $_SESSION['LANGUAGE'] == 1) {
	include_once 'languages/en/default.php';
} else {
	include_once 'languages/vi/default.php';
}

// include libs
require_once 'libs/cls.mysql.php';
require_once 'libs/cls.template.php';
require_once 'libs/cls.menuitem.php';
require_once 'libs/cls.contents.php';
require_once 'libs/cls.category.php';
require_once 'libs/cls.module.php';
require_once 'libs/cls.configsite.php';
require_once 'libs/cls.tag.php';

$tmp = new CLS_TEMPLATE();
$conf = new CLS_CONFIG();
$conf->load_config();
global $tmp;global $conf;
?>
<!DOCTYPE html>
<html language='vi'>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	<meta property="og:type" content="website" />
	<meta property="og:author" content='<?php echo $conf->CompanyName; ?>' />
	<meta property="og:locale" content='vi_VN'/>
	<meta property="og:title" content="<?php echo $conf->Title; ?>"/>
	<meta property="og:keywords" content='<?php echo $conf->Meta_key; ?>' />
	<meta property='og:description' content='<?php echo $conf->Meta_desc; ?>' />
	<meta property="og:url" content="<?php echo $actual_link ?>" />
	<meta property="og:image" content="<?php echo $conf->Img; ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $conf->Title; ?></title>
	<link rel="stylesheet" href="<?php echo ROOTHOST; ?>css/bootstrap.min.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo ROOTHOST; ?>css/font-awesome.min.css" type="text/css" media="all" >
	<link rel="stylesheet" href="<?php echo ROOTHOST; ?>css/owl.carousel.min.css" >
	<link rel="stylesheet" href="<?php echo ROOTHOST; ?>css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo ROOTHOST; ?>css/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo ROOTHOST; ?>css/style-responsive.css" type="text/css" media="all">

	<script src="<?php echo ROOTHOST; ?>global/js/jquery-1.11.2.min.js"></script>
	<script src="<?php echo ROOTHOST; ?>global/js/bootstrap.min.js"></script>
	<script src='<?php echo ROOTHOST; ?>js/gfscript.js'></script>
	<script src='<?php echo ROOTHOST; ?>js/owl.carousel.js'></script>
</head>
<body>
	<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div id="container">
		<header id="header" class="active">
			<div class="container">
				<div id="logo">
					<a href="<?= ROOTHOST ?>"><img alt="camdonhanh-logo" src="<?= ROOTHOST ?>images/logo/logo.png"></a>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse">
					<nav id="main-menu"><?php $tmp->loadModule('navitor');?></nav>
				</div>
			</div>
		</header>
		<?php $tmp->loadComponent();?>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-6 box-right">
						<div class="company-name">CÔNG TY TNHH ĐẦU TƯ VÀ PHÁT TRIỂN CAMSIM.COM</div>
						<p>Giấy CNĐKKD: 0313412428 - Ngày cấp: 24/08/2015</p>
						<p>Cơ quan cấp: Phòng đăng ký kinh doanh Sở Kế Hoạch Đầu Tư</p>
						<p>Địa chỉ Số 6, ngõ 28, đường Tăng Thiết Giáp, Cổ Nhuế, Bắc Từ Liêm, Hà Nội</p>
						<p>Email: lienhe@camsim.com</p>
					</div>
					<div class="col-sm-6 box-left">
						<div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>Hà Nội : 128 Đốc Ngữ - Ba Đình - Hà Nội</div>
						<div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>TPHCM : 16 đường số 5 - khu phố 1 - hiệp bình chánh - thủ đức</div>
					</div>
				</div>
			</div>
		</footer>
		<div class="copyright"></div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#main-banner').owlCarousel({
				navigation : true,
				slideSpeed : 3000,
				paginationSpeed : 400,
				loop: true,
				items : 1, 
				itemsDesktop : false,
				itemsDesktopSmall : false,
				itemsTablet: false,
				itemsMobile : false
			})

			$("#feedback").owlCarousel({
				loop:true,
				margin:10,
				responsiveClass:true,
				responsive:{
					0:{
						items:1,
						nav:true
					},
					600:{
						items:2,
						nav:false
					},
					1000:{
						items:2,
						nav:true,
						loop:false
					}
				}
			});
		});

		// Search form
		$('#frmsearch .fa.fa-search').click(function(){
			$('#frmsearch').submit();
		});
	</script>
</body>
</html>