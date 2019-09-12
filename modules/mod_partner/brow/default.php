<?php
$objpart = new CLS_PARTNER();
$objpart->getList(" AND isactive=1 ");
if($objpart->Num_rows()>0) { ?>
	<div id="owl4" class="owl-carousel owl-theme">
		<?php while($partner = $objpart->Fetch_Assoc()) { 
			$title = stripslashes($partner["name"]);
			$link = $partner['link']!=''?$partner['link']:"javascript:void(0)";
			$img = getThumb($partner['images'],'img-responsive',$title);?>
			<div class="item">
				<div class="ow-client-logo">
					<div class="client-logo">
						<?php echo $img;?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>