<?php if($r['viewtitle']==1){ ?>
<div class="main-title"><a href="<?php echo ROOTHOST.'video';?>" title="<?php echo htmlentities($r['title']);?>">
	<i class="fa fa-film"></i> <?php echo stripslashes($r['title']);?>
</a></div>
<?php } 
$objVideo = new CLS_VIDEO();
$objVideo->getList(' AND `isactive` = 1 ORDER BY `order` ASC, id DESC LIMIT 0,3');
$id_div = "slider-video";
$total = $objVideo->Num_rows();
?>
<div id="<?php echo $id_div;?>" class="carousel slide carousel-fade" data-ride="carousel">
	<ol class="carousel-indicators">
	<?php for($stt=0;$stt<$total;$stt++) { ?>
		<li data-target="#<?php echo $id_div;?>" data-slide-to="<?php echo $stt;?>" <?php if($stt==0) echo 'class="active"';?>></li>
	<?php } ?>
	</ol>
	<div class="carousel-inner" role="listbox">
		<?php $i=0;
			while($row = $objVideo->Fetch_Assoc())
			{   $i++; $video_id = $row['video_id'];
				$name = stripslashes($row['name']);
				$url = ROOTHOST.'video/'.$row['code'].'.html';
				if($i==1) echo '<div class="item active">';
				else echo '<div class="item">';
				echo '<a href="'.$url.'" title="'.$name.'">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="//www.youtube.com/embed/'.$video_id.'?rel=0&amp;autoplay=0 " allowfullscreen="true"></iframe>
						</div></a>';
				echo '</div>';
			}
		?>
	</div>
	<a href="#<?php echo $id_div;?>" class="left carousel-control" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
	<a href="#<?php echo $id_div;?>" class="right carousel-control" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
</div>