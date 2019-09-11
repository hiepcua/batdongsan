<div class="releated_news">
	<div class="top">
		<div class="main-title"><span>Xem các mẫu khác</span></div>
	</div><ul>
	<?php $objdoc = new CLS_DOCUMENT();
	$objdoc->getList(" AND `id` <>$doc_id AND isactive=1 ORDER BY id DESC LIMIT 0,10 ");
	while($r = $objdoc->Fetch_Assoc()) { 
		$name = stripslashes(html_entity_decode($r['name'])); 
		$code = $r['code'];
		$link = ROOTHOST.'mau-phieu-dang-ki-xet-tuyen/'.$code.'.html';
		echo "<li><a href='$link' title='$name'>
			<i class='fa fa-dot-circle-o'></i> $name</a></li>";
	} ?>
	</ul>
</div>