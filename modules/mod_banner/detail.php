<?php
if($album_id_banner>0)
{ 	$objgallery = new CLS_GALLERY();
	$objgallery->getList(' AND `album_id` = '.$album_id_banner.' AND `isactive` = 1');
	$total = $objgallery->Num_rows();
	if($total>0)
	{ ?>
		<div id='site_banner' >
			<div class=" banner">
				<div class="container">
					<div id="carousel_slider" class="carousel slide carousel-fade" data-ride="carousel">
						<ol class="carousel-indicators">
						<?php for($stt=0;$stt<$total;$stt++) { ?>
							<li data-target="#carousel_slider" data-slide-to="<?php echo $stt;?>" <?php if($stt==0) echo 'class="active"';?>></li>
						<?php } ?>
						</ol>
						<div class="carousel-inner" role="listbox">
							<?php
								$i=0;
								while($row_img_top = $objgallery->Fetch_Assoc())
								{
									$i++;
									?>
									<div class="item <?php echo ($i==1) ? "active" : ""; ?>">
										<?php echo trim($row_img_top['intro']); ?>
									</div>
								<?php
								}
							?>
						</div>
						<a class="left carousel-control" href="#carousel_slider" role="button" data-slide="prev">
                            <img src="<?php echo ROOTHOST; ?>/images/icon/left.png">
                        </a>
                        <a class="right carousel-control" href="#carousel_slider" role="button" data-slide="next">
                            <img src="<?php echo ROOTHOST; ?>/images/icon/right.png">
                        </a>
					</div>
				</div>
			</div>
		</div>
<?php
	}
}
?>