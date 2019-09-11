<div class="releated_news">
	<div class="top">
		<div class="main-title"><span>Xem các tin khác</span></div>
	</div><ul>
	<?php $obj = new CLS_CONTENTS();
	$obj->getList(" AND `id` <>$con_id AND category_id=$cat_id "," ORDER BY id DESC "," LIMIT 0,10 ");
	while($r = $obj->Fetch_Assoc()) { 
		$name = stripslashes(html_entity_decode($r['title'])); 
		$code = $r['code'];
		$link = ROOTHOST.$par_code.'/'.$code.'.html';
		echo "<li><a href='$link' title='$name'>
			<i class='fa fa-dot-circle-o'></i> $name</a></li>";
	} ?>
	</ul>
</div>