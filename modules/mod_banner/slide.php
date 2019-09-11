<?php
$objalbum = new CLS_ALBUM();
$objgallery = new CLS_GALLERY();
$objalbum->getList(' AND `id` = 1 AND `isactive` = 1');
if($objalbum->Num_rows()>0) {
	$album = $objalbum->Fetch_Assoc();
	$album_id = $album['id'];
	$objgallery = new CLS_GALLERY();
	$objgallery->getList(' AND `album_id` = '.$album_id.' AND `isactive` = 1 ORDER BY `order`');
	$total = $objgallery->Num_rows();
	$i=0; $id_div = "carousel_slider"; ?>
	<div id='site_banner' >
		<div class=" banner">
			<div class="container">
			<div id="<?php echo $id_div;?>" class="carousel slide carousel-fade" data-ride="carousel">
				<ol class="carousel-indicators">
				<?php for($stt=0;$stt<$total;$stt++) { ?>
					<li data-target="#<?php echo $id_div;?>" data-slide-to="<?php echo $stt;?>" <?php if($stt==0) echo 'class="active"';?>></li>
				<?php } ?>
				</ol>
				<div class="carousel-inner" role="listbox">
					<?php
						while($row_img = $objgallery->Fetch_Assoc())
						{
							$i++; $intro = trim($row_img['intro']); $intro = str_replace("&nbsp;","",$intro);
							?>
							<div class="item <?php echo ($i==1) ? "active" : ""; ?>">
								<?php echo $intro; ?>
							</div>
						<?php
						}
					?>
				</div>
				<a class="left carousel-control" href="#<?php echo $id_div;?>" role="button" data-slide="prev">
					<img src="<?php echo ROOTHOST; ?>/images/icon/left.png">
				</a>
				<a class="right carousel-control" href="#<?php echo $id_div;?>" role="button" data-slide="next">
					<img src="<?php echo ROOTHOST; ?>/images/icon/right.png">
				</a>
			</div>
		</div>
	</div>
	<?php
} ?>