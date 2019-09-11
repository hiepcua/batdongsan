<div class="module list-new-hot">
	<div class="main-title"><span>TIN NỔI BẬT</span></div>
	<div class="list-category-investors">
		<ul>
			<?php 
			$objCate = new CLS_CATEGORY;
			$objContent = new CLS_CONTENTS;
			$objContent->getList('', ' ORDER BY `visited` DESC ', 'LIMIT 0,5');
			$i = 0;
			if($objContent->Num_rows() > 0) {
				while($content = $objContent->Fetch_Assoc()) {
					$alias = $objCate->getCodeById($content['category_id']);
					$urlContents = ROOTHOST . $alias . "/" . $content['code'] . ".html";
					$intro = Substring($content['intro'], 0, 15);
					$thumb = stripcslashes($content['thumb']);
					if($i==0){
						?>
						<li class="big_item">
							<a href="<?php echo $urlContents; ?>" title="<?php echo $content['title'] ?>">
								<img src="<?= $thumb; ?>" alt="<?= $content['title']; ?>" class="img-responsive">
							</a>
							<div class="meta">
								<a href="<?php echo $urlContents; ?>" class="title" title="<?php echo $content['title'] ?>"><?php echo $content['title']; ?></a>
								<p class="intro"><?= $intro.'[...]' ?></p>
							</div>
						</li>
						<?php
					}else{
						?>
						<li>
							<a href="<?php echo $urlContents; ?>" title="<?php echo $content['title'] ?>">
								<i class="fa fa-angle-double-right"></i> <?php echo $content['title']; ?>
							</a>
						</li>
						<?php
					}
					$i++;
				}
			}
			?>
		</ul>
	</div>
</div>