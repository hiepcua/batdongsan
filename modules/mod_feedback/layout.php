<?php
$objmysql = new CLS_MYSQL();
$sql="SELECT * FROM tbl_feedback WHERE isactive=1 ORDER BY `order` ASC LIMIT 0,6";
$objmysql->Query($sql);
$id_div = "slider-main";
$total = $objmysql->Num_rows();
?>
<div id="feedback" class="owl-carousel owl-theme">
<?php
while($row = $objmysql->Fetch_Assoc())
{
	$name = stripcslashes($row['name']);
	$comment = stripcslashes($row['comment']);
	$career = stripcslashes($row['career']);
	$avatar = stripcslashes($row['avatar']);
	?>
	<div class="item">
		<div class="item1">
			<div class="thumb"><img src="<?= $avatar ?>" class="img-responsive"></div>
			<div class="content">
				<p class="comment"><?= $comment ?></p>
				<div class="info"><span class="name"><?= $name ?></span><span class="devision">/</span><span class="position"><?= $career ?></span></div>
			</div>
		</div>
	</div>
	<?php
}
?>
</div>