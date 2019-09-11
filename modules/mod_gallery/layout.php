
<div class="container padding5">
	<h3>HÌNH ẢNH TẠI <span class="i-color">MỸ ĐÌNH THC</span></h3>
	<div class="section-intro">Mỹ Đình THC tạo ra cách làm tốt hơn thông qua việc chuyên môn hóa tới từng khâu công việc, tới từng con người và luôn đặt tính hiệu quả lên trên hàng đầu</div>

	<div class="custome-button">
		<div class="custome-prev">
			<i class='fa fa-angle-left' aria-hidden='true'></i>
		</div>
		<div class="custome-next">
			<i class='fa fa-angle-right' aria-hidden='true'></i>
		</div>
	</div>

	<div id="block-4" class="owl-carousel owl-theme">
		<?php
		$objAlbum = new CLS_GALLERY();
		$objAlbum->getList(' ORDER BY `name` ASC, id DESC LIMIT 0,6');
		if($objAlbum->Num_rows()>0) {
			while($album = $objAlbum->Fetch_Assoc()) {
				$title = stripslashes($album['name']);
				?>
				<div class="item">
					<a href=""><div class="thumb"><img src="<?php echo $album['link'] ?>" class="img-responsive"></div></a>
				</div>
				<?php
			}
		} ?>
	</div>
</div>