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
require_once 'libs/cls.mysql.php';
require_once 'libs/cls.template.php';
require_once 'libs/cls.menuitem.php';
require_once 'libs/cls.module.php';
require_once 'libs/cls.configsite.php';

$tmp = new CLS_TEMPLATE();
$objmysql = new CLS_MYSQL();
$objdata = new CLS_MYSQL();
$conf = new CLS_CONFIG();
$conf->load_config();
global $tmp;global $conf;
?>
<!DOCTYPE html>
<html language='vi'>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex, nofollow" />
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
	<link rel="stylesheet" href="<?php echo ROOTHOST; ?>css/Roboto.css" type="text/css" media="all">

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
			<div class="top-header">
				<div class="container">
					<div class="col-left">
						<ul>
							<li class="hotline">Hotline:&nbsp&nbsp<a href="tel:<?php echo $conf->Phone;?>"><?php echo $conf->Phone;?></a></li>
							<li class="current-day"><?php echo "Hôm nay: " . date("d/m/y") . "<br>"; ?></li>
						</ul>
					</div>
					<div class="col-right">
						<ul class="social">
							<li><a href="<?php echo $conf->Facebook;?>" target="_blank" rel="nofollow" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo $conf->Twitter;?>" target="_blank" rel="nofollow" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo $conf->Youtube;?>" target="_blank" rel="nofollow" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
						</ul>
						<section id="search">
							<form class="form-search-header" method="GET" action="<?php echo ROOTHOST;?>tim-kiem">
								<label for="search-input"><i class="fa fa-search" aria-hidden="true"></i><span class="sr-only">Search icons</span></label>
								<input id="search-input" name="q" class="form-control" placeholder="Tìm kiếm ...">
							</form>
						</section>
					</div>
				</div>
			</div>

			<div class="wrap-logo">
				<a href="<?php echo ROOTHOST;?>" title="Trang chủ">
					<img src="<?php echo ROOTHOST;?>images/logo/logo.png" class="img-responsive">
				</a>
			</div>

			<div id="navbar" class="wrap-menu">
				<div class="container">
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
			</div>
		</header>
		<?php if($tmp->isFrontpage()){ ?>
			<div class="main-home">
				<section class="section-follow">
					<div class="container">
						<div id="slide-follow" class="owl-carousel owl-theme">
							<?php
							$sql="SELECT * FROM tbl_contents WHERE isactive=1 ORDER BY cdate DESC LIMIT 0, 10";
							$objmysql->Query($sql);
							while($row 	= $objmysql->Fetch_Assoc()) {
								$title 	= stripcslashes($row['title']);
								$code 	= $row['code'];
								$thumb 	= getThumb($row['thumb'], 'img-responsive', '');
								$views 	= (int)$row['visited'];
								$cdate 	= convert_date($row['cdate']);

								$sql_cate="SELECT * FROM tbl_categories WHERE isactive=1 AND id=".$row['category_id'];
								$objdata->Query($sql_cate);
								$r_cate = $objdata->Fetch_Assoc();
								$link 	= ROOTHOST.$r_cate['code'].'/'.$code.'.html';
								?>
								<div class="item">
									<div class="box-thumb"><a href="<?php echo $link;?>" title="<?php echo $title;?>"><?php echo $thumb;?></a></div>
									<div class="content">
										<div class="title"><a href="<?php echo $link;?>" title="<?php echo $title;?>"><?php echo $title;?></a></div>
										<div class="info">
											<span class="date"><?php echo $cdate;?></span>
											<?php
											if($views > 0){
												echo '<span class="views">'.$views.'views</span>';
											}
											?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</section>

				<div class="container">
					<div class="row">
						<div class="col-md-8 col-sm-8">
							<div id="slide-hot-news" class="owl-carousel owl-theme">
								<?php
								$sql="SELECT * FROM tbl_contents WHERE isactive = 1 ORDER BY cdate DESC LIMIT 0, 3";
								$objmysql->Query($sql);
								while($row 	= $objmysql->Fetch_Assoc()) {
									$title 	= stripcslashes($row['title']);
									$code 	= $row['code'];
									$thumb 	= getThumb($row['thumb'], 'img-responsive', '');
									$views 	= (int)$row['visited'];
									$cdate 	= convert_date($row['cdate']);
									$sapo 	= Substring(html_entity_decode(stripslashes($row['sapo'])), 0, 60);

									$sql_cate="SELECT * FROM tbl_categories WHERE isactive=1 AND id=".$row['category_id'];
									$objdata->Query($sql_cate);
									$r_cate = $objdata->Fetch_Assoc();
									$link 	= ROOTHOST.$r_cate['code'].'/'.$code.'.html';
									?>
									<div class="item">
										<div class="box-thumb"><a href="<?php echo $link;?>" title="<?php echo $title;?>"><?php echo $thumb;?></a></div>
										<div class="content">
											<div class="title"><a href="<?php echo $link;?>" title="<?php echo $title;?>"><?php echo $title;?></a></div>
											<div class="info">
												<span class="date"><?php echo $cdate;?></span>
												<?php
												if($views > 0){
													echo '<span class="views">'.$views.' views</span>';
												}
												?>
												<div class="sapo"><?php echo $sapo; ?></div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>

							<?php
							$sql="SELECT * FROM tbl_categories WHERE isactive=1 AND par_id = 0 ORDER BY `order` ASC";
							$objmysql->Query($sql);
							while ($r_cate = $objmysql->Fetch_Assoc()) {
								$cate_link = ROOTHOST.$r_cate['code'];
								echo '<section class="sec-category">
								<h2 class="sec-title"><i class="fa fa-circle" aria-hidden="true"></i><span><a href="'.$cate_link.'" title="'.$r_cate['name'].'">'.$r_cate['name'].'</a></span></h2>';

								echo '<div class="row list-items">';
								$sql_con="SELECT * FROM tbl_contents WHERE isactive=1 AND category_id = ".$r_cate['id']." ORDER BY cdate DESC LIMIT 0,4";
								$objdata->Query($sql_con);
								while ($r_con = $objdata->Fetch_Assoc()) {
									$title 	= stripcslashes($r_con['title']);
									$code 	= $r_con['code'];
									$thumb 	= getThumb($r_con['thumb'], 'img-responsive', '');
									$views 	= (int)$r_con['visited'];
									$cdate 	= convert_date($row['cdate']);
									$sapo 	= Substring(html_entity_decode(stripslashes($r_con['sapo'])), 0, 60);
									$link 	= ROOTHOST.$r_cate['code'].'/'.$r_con['code'].'.html';

									echo '<div class="col-md-6 col-sm-6 item">
									<div class="box-thumb">
									<a href="'.$link.'" title="'.$title.'">'.$thumb.'</a>
									</div>
									<div class="content">
									<div class="title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
									<div class="info">
									<span class="date">'.$cdate.'</span>';
									if($views > 0){
										echo '<span class="views">'.$views.' views</span>';
									}
									echo '<div class="sapo">'.$sapo.'</div>
									</div>
									</div>
									</div>';
								}
								echo '</div>';
								echo '</section>';
							}
							?>

						</div>
						<div class="col-md-4 col-sm-4 wrap-aside">
							<aside class="aside latest-news">
								<h3 class="aside-title"><i class="fa fa-circle" aria-hidden="true"></i><span>Tin mới nhất</span></h3>
								<?php
								$sql="SELECT * FROM tbl_contents WHERE isactive=1 ORDER BY cdate DESC LIMIT 0,5";
								$objmysql->Query($sql);
								$i=1;
								while ($row = $objmysql->Fetch_Assoc()) {
									$title 	= stripcslashes($row['title']);
									$code 	= $row['code'];
									$thumb 	= getThumb($row['thumb'], 'img-responsive', '');
									$views 	= (int)$row['visited'];
									$cdate 	= convert_date($row['cdate']);

									$sql_cate="SELECT * FROM tbl_categories WHERE isactive=1 AND id=".$row['category_id'];
									$objdata->Query($sql_cate);
									$r_cate = $objdata->Fetch_Assoc();
									$link 	= ROOTHOST.$r_cate['code'].'/'.$code.'.html';

									echo '<div class="item">
									<div class="number">'.$i.'.</div>
									<div class="content">
									<div class="title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
									<div class="info">
									<span class="date">'.$cdate.'</span>';
									if($views > 0){
										echo '<span class="views">'.$views.'views</span>';
									}
									echo '</div>
									</div>
									<div class="box-thumb"><a href="'.$link.'" title="'.$title.'">'.$thumb.'</a></div>
									</div>';
									$i++;
								}
								?>
							</aside>

							<aside class="aside advertisement">
								<h3 class="aside-title"><i class="fa fa-circle" aria-hidden="true"></i><span>Trending</span></h3>
								<div>
									<a href="" title="Trending"><img src="<?php echo ROOTHOST; ?>images/advantisement.jpg" align=""></a>
								</div>
							</aside>

							<aside class="aside latest-news">
								<h3 class="aside-title"><i class="fa fa-circle" aria-hidden="true"></i><span>Tin mới nhất</span></h3>
								<?php
								$sql="SELECT * FROM tbl_contents WHERE isactive=1 ORDER BY cdate DESC LIMIT 0,5";
								$objmysql->Query($sql);
								$i=1;
								while ($row = $objmysql->Fetch_Assoc()) {
									$title 	= stripcslashes($row['title']);
									$code 	= $row['code'];
									$thumb 	= getThumb($row['thumb'], 'img-responsive', '');
									$views 	= (int)$row['visited'];
									$cdate 	= convert_date($row['cdate']);

									$sql_cate="SELECT * FROM tbl_categories WHERE isactive=1 AND id=".$row['category_id'];
									$objdata->Query($sql_cate);
									$r_cate = $objdata->Fetch_Assoc();
									$link 	= ROOTHOST.$r_cate['code'].'/'.$code.'.html';

									echo '<div class="item">
									<div class="number">'.$i.'.</div>
									<div class="content">
									<div class="title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
									<div class="info">
									<span class="date">'.$cdate.'</span>';
									if($views > 0){
										echo '<span class="views">'.$views.'views</span>';
									}
									echo '</div>
									</div>
									<div class="box-thumb"><a href="'.$link.'" title="'.$title.'">'.$thumb.'</a></div>
									</div>';
									$i++;
								}
								?>
							</aside>
						</div>
					</div>
				</div>
			</div>
		<?php }else{ ?> 
			<div class="component">
				<?php $tmp->loadComponent(); ?> 
			</div>
		<?php }?>

		<footer>
			<div class="container">
				<div class="row text-center">
					<div class="company-name">Copyright &coppy; DATHOABINH.COM | 2019</div>
					<p>Mọi chi tiết xin liên hệ 0946831277</p>
				</div>
			</div>
			<div class="copyright bg_copyright">© Copyright 2019 <?php echo $conf->Title; ?></div>
		</footer>
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

			$('#slide-follow').owlCarousel({
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
						items:4,
						nav:true,
						loop:false
					}
				}
			})

			$('#slide-hot-news').owlCarousel({
				loop:true,
				margin:10,
				responsiveClass:true,
				responsive:{
					0:{
						items:1,
						nav:true
					},
					600:{
						items:1,
						nav:false
					},
					1000:{
						items:1,
						nav:true,
						loop:false
					}
				}
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

		var prevScrollpos = window.pageYOffset;
		window.onscroll = function() {
			var currentScrollPos = window.pageYOffset;
			if(currentScrollPos > 300){
				if (prevScrollpos > currentScrollPos) {
					document.getElementById("navbar").style.position = "fixed";
					document.getElementById("navbar").style.top = "";
				} else {
					document.getElementById("navbar").style.position = "relative";
					document.getElementById("navbar").style.top = "-50px";
				}
				prevScrollpos = currentScrollPos;
			}else{
				document.getElementById("navbar").style.position = "relative";
			}
		}
	</script>
</body>
</html>