<?php
$thisUrl = curPageURL();
$code = isset($_GET['code']) ? addslashes(trim($_GET['code'])) : '';
$par_code = isset($_GET['par_code']) ? addslashes(trim($_GET['par_code'])) : '';
if($code == '' || $par_code == '') {
	page404();
}

$sql = "SELECT * FROM tbl_categories WHERE `code` ='".$par_code."'";
$objmysql->Query($sql);
$r_cate		= $objmysql->Fetch_Assoc();
$cat_id 	= $r_cate['id'];
$par_id 	= $r_cate['par_id'];
$cat_name 	= stripslashes($r_cate['name']);


$sql = "SELECT * FROM tbl_contents WHERE isactive = 1 AND `code` ='".$code."'";
$objmysql->Query($sql);
$result = $objmysql->Fetch_Assoc();
$con_id = $result['id'];

if(!isset($_SESSION['VIEW-CONTENT-'.$con_id])){
	$sql_update = "UPDATE `tbl_contents` SET `visited` = `visited` + 1 WHERE `id` = ".$con_id;
	$_SESSION['VIEW-CONTENT-'.$con_id] = 1;
	$objdata->Exec($sql_update);
}

$cat_id 	= $result['category_id'];
$views 		= $result['visited'];
$cdate 		= date("d/m/Y", $result['cdate']);
$link  		= ROOTHOST.$r_cate['code'].'/'.$result['code'].'.html';
?>
<section class="page page-contents">
	<div class="article component">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					
				</div>
				<div class="col-md-6 col-sm-6"></div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<div class="content">
						<h1 class="page-title"><?php echo stripslashes(html_entity_decode($result['title'])); ?></h1>

						<div class="meta-info">
							<ul class="list-inline">
								<li class="date">Ngày đăng: <?php echo $cdate; ?></li>
								<?php
								if($views > 0){
									echo '<li class="views">Lượt xem: '.$views.'</li>';
								}else{
									echo '<li class="views">Lượt xem: 1</li>';
								}
								?>
							</ul>

							<ul class="list-inline article-social">
								<li><div class="fb-like" data-href="<?php echo $thisUrl; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div></li>	
							</ul>
						</div>

						<div class="intro"><?php echo $result['intro']; ?></div>

						<div class="full_text">
							<?php echo stripslashes(html_entity_decode($result['fulltext'])); ?>
						</div>
					</div>

					<div class="clearfix"><br></div>
					<ul class="list-inline">
						<!-- <li><div class="fb-like" data-href="<?= $thisUrl; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div></li>		 -->
					</ul>	
					<div class="clearfix"></div>
					<!-- <div class="fb-comments" data-href="<?= $thisUrl; ?>" data-width="100%" data-numposts="10"></div>				 -->
					<div class="clearfix"></div>

					<!-- Related news -->
					<div class="releated_news">
						<h2><i class="fa fa-circle" aria-hidden="true"></i><span>Bài viết cùng chuyên mục</span></h2>
						<ul>
							<?php 
							$sql = "SELECT * FROM tbl_contents WHERE isactive = 1 AND id <> $con_id AND category_id = $cat_id ORDER BY cdate DESC LIMIT 0,6";
							$objmysql->Query($sql);
							while($r = $objmysql->Fetch_Assoc()) { 
								$name = stripslashes(html_entity_decode($r['title'])); 
								$code = $r['code'];
								$link = ROOTHOST.$par_code.'/'.$code.'.html';
								echo '<li><a href="'.$link.'" title="'.$name.'"><i class="fa fa-circle" aria-hidden="true"></i>'.$name.'</a></li>';
							} ?>
						</ul>
					</div>
					<!-- End Related news -->
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
							$cdate 	= date('d/m/Y', $row['cdate']);

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
							$cdate 	= date('d/m/Y', $row['cdate']);

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
</div>