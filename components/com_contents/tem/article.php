<?php
$thisUrl = curPageURL();
$objcate = new CLS_CATEGORY();
$objcon = new CLS_CONTENTS();
$cat_id = $par_id =0; $cat_name='';
if (isset($_GET['par_code']) && isset($_GET['code']))
{
	$par_code = $_GET['par_code'];
	$code = $_GET['code'];
	$objcate->getList(' AND `code` = "' . $par_code.'"');
	$item = $objcate->Fetch_Assoc();
	$cat_id=$item['id'];
	$par_id=$item['par_id'];
	$cat_name=stripslashes($item['name']);
} ?>
<section class="banner_page_header"></section>
<div class="article component">
	<div class="container">
		<div class="bread">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= ROOTHOST; ?>" title="Trang chủ">
							<i class="fa fa-home" aria-hidden="true"></i>
						</a>
					</li>
					<li class="breadcrumb-item" aria-current="page">
						<a href="" title="<?= $item['name']; ?>" ><?= $item['name']; ?></a>
					</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 colmain">
				<?php 
				$objcon->getList(" AND `code` = '$code'");
				if ($objcon->Num_rows()>0) {
					$result = $objcon->Fetch_Assoc();
					$con_id = $result['id'];
					$objcon->updateView($con_id);
					$cat_id = $result['category_id'];
					$view = $result['visited'];
					$cdate = date("d/m/Y",strtotime($result['cdate']));
					$info_cate = $objcate->getInfo(" AND id=".$cat_id);
					$link  = ROOTHOST.$info_cate['code'].'/'.$code.'.html';
				?>
				<div class="content">
					<div class="main-title">
						<h1><?php echo stripslashes(html_entity_decode($result['title'])); ?></h1>
					</div>
					<div class="create_date"><small><i>Ngày đăng: <?php echo $cdate;?></i></small>
						<span class="pull-right">Lượt xem: <?php echo $view;?></span>
					</div>
					<div class="full_text">
						<?php echo stripslashes(html_entity_decode($result['fulltext'])); ?>
					</div>
				</div>
				
				<div class="clearfix"><br></div>
				<ul class="list-inline">
					<li><div class="fb-like" data-href="<?= $thisUrl; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div></li>
					<li class='google-share'><!-- Place this tag in your head or just before your close body tag. -->
					<script src="https://apis.google.com/js/platform.js" async defer>
					  	{lang: 'vi'}
					</script>				
				</ul>	
				<div class="clearfix"></div>
				<div class="fb-comments" data-href="<?= $thisUrl; ?>" data-width="100%" data-numposts="10"></div>				
				<div class="clearfix"></div>
				<?php include_once("modules/mod_content/releated.php"); 
				} ?>
			</div>
			<div class="col-xl-3 col-md-3 hidden-sm hidden-xs colright">
				<?php
				include_once("modules/mod_category/layout.php");
				include_once("modules/mod_lastestnews/hotnews.php");
				include_once("modules/mod_video/left.php");
				$this->loadModule('right');
				?>
			</div>
		</div>
	</div>
</div>