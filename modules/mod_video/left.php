<div class="module video">
	<div class="main-title"><span>VIDEO</span></div>
	<div class="clearfix"></div>
	<div class="video-upload">
		<?php
		$objVideo = new CLS_VIDEO();
		$objVideo->getList(' AND `isactive` = 1 ORDER BY `order` LIMIT 0,1');
		if($objVideo->Num_rows()>0) {
			$video = $objVideo->Fetch_Assoc();
			$video_id = $video['video_id'];
			?>
			<div class="video-latest">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $video_id;?>?rel=0&amp;autoplay=0 " allowfullscreen="true"></iframe>
				</div>
			</div>
			<div class="read-more-video text-center">
				<a href="<?php echo ROOTHOST.'video/';?>" class="btn btn-success">
					Xem Thêm &ensp;<i class="fa fa-angle-right" aria-hidden="true"></i>
				</a>
			</div>
		<?php
		}
		?>
	</div>
</div>