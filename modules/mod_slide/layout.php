<?php
$objmysql = new CLS_MYSQL();
$sql="SELECT * FROM tbl_slider WHERE isactive=1 ORDER BY `order` ASC,id ASC";
$objmysql->Query($sql);
$id_div = "slider-main";
$total = $objmysql->Num_rows();
?>
<div id="main-banner" class="owl-carousel owl-theme">
	<?php
	while($row = $objmysql->Fetch_Assoc()) {
		$slogan = stripcslashes($row['slogan']);
		$intro = stripcslashes($row['intro']);
		$link = stripcslashes($row['link']);
		$thumb = stripcslashes($row['thumb']);
		?>
		<div class="item">
			<div class="bn-mask"></div>
			<img src="<?= $thumb ?>" class="img">
			<div class="content">
				<div class="title"><?php echo $slogan;?></div>
				<div class="intro"><?php echo $intro;?></div>
			</div>
		</div>
	<?php } ?>
</div>