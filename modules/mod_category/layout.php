<?php 
$obj_cat = new CLS_CATEGORY;
if($par_id==0)
	$obj_cat->getList(" AND `par_id`=$cat_id"); 
else $obj_cat->getList(" AND `par_id`=$par_id"); 
$cat_name = $obj_cat->getNameById($par_id);
if($obj_cat->Num_rows()>0) { ?>
<div class="module list_category">
	<div class="title"><i class="fa fa-angle-double-right"></i> <?php echo $cat_name;?></div><ul>
	<?php
	while($r=$obj_cat->Fetch_Assoc()) {
		$link = ROOTHOST.$r['code'].'/';
		$name = stripslashes($r['name']);
		$cls='';
		if(isset($cat_id) && $cat_id==$r['id']) $cls='active';
		echo "<li class='$cls'><a href='$link' title='$name'>$name</a></li>";
	} ?></ul>
</div>
<?php } ?>