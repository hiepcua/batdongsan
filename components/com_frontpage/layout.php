<?php 
global $tmp;
$objmysql = new CLS_MYSQL();
// $tmp->loadModule('banner');
$isConfig=true;
?>
<section class="section-follow">
	<div id="slide-follow" class="owl-carousel owl-theme">
		<?php
		$sql="SELECT * FROM tbl_contents WHERE isactive=1 ORDER BY cdate DESC LIMIT 0, 10";
		$objmysql->Query($sql);
		while($row 	= $objmysql->Fetch_Assoc()) {
			$slogan = stripcslashes($row['title']);
			$intro 	= $row['code'];
			$thumb 	= stripcslashes($row['thumb']);
			$views 	= (int)$row['visited'];
			$cdate 	= date('d/m/Y', $row['cdate']);
			?>
			<div class="item">
				<img src="<?= $thumb ?>" class="img">
				<div class="content">
					<div class="title"><?php echo $slogan;?></div>
					<div class="info">
						<span class="date"><?php echo $cdate;?></span>
						<span class="views"><?php echo $views.' ';?>views</span>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</section>

<!-- <div class="clearfix"></div>
<section class="">
	<article class="container">
		<?php if($isConfig){?>
			<div class="histories row row-flex">
				<?php 
				$sql="SELECT * FROM tbl_contents LIMIT 0,3";
				$objmysql->Query($sql);
				while($r=$objmysql->Fetch_Assoc()){
					?>
					<div class='col-md-4'>
						<div class='item-news'>
							<div class='thumb'><img src='<?php echo $r['thumb'];?>' width='100%'/></div>
							<h1 class='headding'><?php echo $r['title'];?></h1>
						</div>
					</div>
				<?php }?>
			</div>
		<?php }?>
		<div class="hotnews row row-flex">
			<div class='col-md-9'>
				<?php 
				$sql="SELECT * FROM tbl_contents LIMIT 0,1";
				$objmysql->Query($sql);
				$r=$objmysql->Fetch_Assoc();
				?>
				<div class='top-news'>
					<div class='thumb'><img src='<?php echo $r['thumb'];?>' width='100%'/></div>
					<h1 class='headding'><?php echo $r['title'];?></h1>
					<div class='intro'><?php echo $r['intro'];?></div>
				</div>
			</div>
			<div class='col-md-3'>
				hii
			</div>
		</div>
		<div class="news row row-flex">
			<div class='col-md-9'><div class='row row-flex'>
				<div class='col-sm-6'>
					hic
				</div>
				<div class='col-sm-6'>
					hii
				</div>
			</div></div>
			<div class='col-md-3'>
				hii
			</div>
		</div>
	</article>
</section> -->