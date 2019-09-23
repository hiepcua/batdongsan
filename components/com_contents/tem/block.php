<?php
$code = isset($_GET['code']) ? addslashes(trim($_GET['code'])) : '';
if($code == '') page404();

$sql="SELECT * FROM tbl_categories WHERE code ='".$code."'";
$objmysql->Query($sql);
$r_cate = $objmysql->Fetch_Assoc();

// Begin pagging
define('OBJ_PAGE','BLOCK_CONTENTS');
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
}
if(isset($_POST['txtCurnpage'])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
}

$sql_count = "SELECT COUNT(*) AS count FROM tbl_contents WHERE category_id = ".$r_cate['id'];
$objmysql->Query($sql_count);
$row_count = $objmysql->Fetch_Assoc();
$total_rows = $row_count['count'];

$MAX_ROWS = 9;
if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/$MAX_ROWS)){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/$MAX_ROWS);
}
$cur_page=(int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;
// End pagging

?>
<section class="page page-contents">
	<div class="container">
		<div class="page-content">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<h1 class="page-title"><?php echo $r_cate['name']; ?></h1>
					<section class="sec-category">
						<div class="row list-items">
							<?php
							$star = ($cur_page - 1) * $MAX_ROWS;
							$sql = "SELECT * FROM tbl_contents WHERE category_id = ".$r_cate['id']." ORDER BY `cdate` DESC LIMIT $star,".$MAX_ROWS;
							$objmysql->Query($sql);
							$i=0;
							while ($r_con = $objmysql->Fetch_Assoc()) {
								$i++;
								$title 	= stripcslashes($r_con['title']);
								$code 	= $r_con['code'];
								$thumb 	= getThumb($r_con['thumb'], 'img-responsive', '');
								$views 	= (int)$r_con['visited'];
								$cdate 	= date('d/m/Y', $r_con['cdate']);
								$sapo 	= Substring(html_entity_decode(stripslashes($r_con['sapo'])), 0, 60);
								$link 	= ROOTHOST.$r_cate['code'].'/'.$r_con['code'].'.html';
								if($i == 1){
									echo '<div class="item big">
									<div class="box-thumb">
									<a href="'.$link.'" title="'.$title.'">'.$thumb.'</a>
									</div>
									<div class="content">
									<div class="title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
									<div class="info">
									<span class="date">1h trước</span>';
									if($views > 0){
										echo '<span class="views">'.$views.' views</span>';
									}
									echo '<div class="sapo">'.$sapo.'</div>
									<div class="text-right"><a href="'.$link.'" title="Xem chi tiết" class="read-more">Chi tiết <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></div>
									</div>
									</div>
									</div>';
								}else{
									echo '<div class="col-md-6 col-sm-6 item">
									<div class="box-thumb">
									<a href="'.$link.'" title="'.$title.'">'.$thumb.'</a>
									</div>
									<div class="content">
									<div class="title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
									<div class="info">
									<span class="date">1h trước</span>';
									if($views > 0){
										echo '<span class="views">'.$views.' views</span>';
									}
									echo '<div class="sapo">'.$sapo.'</div>
									</div>
									</div>
									</div>';
								}
							}
							?>
						</div>
					</section>
					<div class="text-center">
						<?php paging($total_rows,$MAX_ROWS,$cur_page); ?>
					</div>

					<!-- Get child with child's content -->
					<?php
					$sql="SELECT * FROM tbl_categories WHERE par_id = ".$r_cate['id'];
					$objmysql->Query($sql);
					if($objmysql->Num_rows() > 0){
						while ($r_cate_child = $objmysql->Fetch_Assoc()) {							
							$cate_link = ROOTHOST.$r_cate_child['code'];
							echo '<section class="sec-category">
							<h2 class="sec-title"><i class="fa fa-circle" aria-hidden="true"></i><span><a href="'.$cate_link.'" title="'.$r_cate_child['name'].'">'.$r_cate_child['name'].'</a></span></h2>';

							echo '<div class="row list-items">';
							$sql_con="SELECT * FROM tbl_contents WHERE isactive=1 AND category_id = ".$r_cate_child['id']." ORDER BY cdate DESC LIMIT 0,4";
							$objdata->Query($sql_con);
							while ($r_con = $objdata->Fetch_Assoc()) {
								$title 	= stripcslashes($r_con['title']);
								$code 	= $r_con['code'];
								$thumb 	= getThumb($r_con['thumb'], 'img-responsive', '');
								$views 	= (int)$r_con['visited'];
								$cdate 	= date('d/m/Y', $r_con['cdate']);
								$sapo 	= Substring(html_entity_decode(stripslashes($r_con['sapo'])), 0, 60);
								$link 	= ROOTHOST.$r_cate_child['code'].'/'.$r_con['code'].'.html';

								echo '<div class="col-md-6 col-sm-6 item">
								<div class="box-thumb">
								<a href="'.$link.'" title="'.$title.'">'.$thumb.'</a>
								</div>
								<div class="content">
								<div class="title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
								<div class="info">
								<span class="date">1h trước</span>';
								if($views > 0){
									echo '<span class="views">'.$views.' views</span>';
								}
								echo '<div class="sapo">'.$sapo.'</div>
								</div>
								</div>
								</div>';
							}
							echo '</div>';
							echo '</section>';
						}
					} ?>
				</div>

				<div class="col-md-4 col-sm-4 wrap-aside">
					<aside class="aside latest-news">
						<h3 class="aside-title"><i class="fa fa-circle" aria-hidden="true"></i><span>Tin mới nhất</span></h3>
						<?php
						$sql="SELECT * FROM tbl_contents WHERE isactive=1 ORDER BY cdate DESC LIMIT 0,5";
						$objmysql->Query($sql);
						$i=1;
						while ($row = $objmysql->Fetch_Assoc()) {
							$title 	= stripcslashes($row['title']);
							$code 	= $row['code'];
							$thumb 	= getThumb($row['thumb'], 'img-responsive', '');
							$views 	= (int)$row['visited'];
							$cdate 	= date('d/m/Y', $row['cdate']);

							$sql_cate="SELECT * FROM tbl_categories WHERE isactive=1 AND id=".$row['category_id'];
							$objdata->Query($sql_cate);
							$r_cate = $objdata->Fetch_Assoc();
							$link 	= ROOTHOST.$r_cate['code'].'/'.$code.'.html';

							echo '<div class="item">
							<div class="number">'.$i.'.</div>
							<div class="content">
							<div class="title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
							<div class="info">
							<span class="date">'.$cdate.'</span>';
							if($views > 0){
								echo '<span class="views">'.$views.'views</span>';
							}
							echo '</div>
							</div>
							<div class="box-thumb"><a href="'.$link.'" title="'.$title.'">'.$thumb.'</a></div>
							</div>';
							$i++;
						}
						?>
					</aside>

					<aside class="aside advertisement">
						<h3 class="aside-title"><i class="fa fa-circle" aria-hidden="true"></i><span>Trending</span></h3>
						<div>
							<a href="" title="Trending"><img src="<?php echo ROOTHOST; ?>images/advantisement.jpg" align=""></a>
						</div>
					</aside>

					<aside class="aside latest-news">
						<h3 class="aside-title"><i class="fa fa-circle" aria-hidden="true"></i><span>Tin mới nhất</span></h3>
						<?php
						$sql="SELECT * FROM tbl_contents WHERE isactive=1 ORDER BY cdate DESC LIMIT 0,5";
						$objmysql->Query($sql);
						$i=1;
						while ($row = $objmysql->Fetch_Assoc()) {
							$title 	= stripcslashes($row['title']);
							$code 	= $row['code'];
							$thumb 	= getThumb($row['thumb'], 'img-responsive', '');
							$views 	= (int)$row['visited'];
							$cdate 	= date('d/m/Y', $row['cdate']);

							$sql_cate="SELECT * FROM tbl_categories WHERE isactive=1 AND id=".$row['category_id'];
							$objdata->Query($sql_cate);
							$r_cate = $objdata->Fetch_Assoc();
							$link 	= ROOTHOST.$r_cate['code'].'/'.$code.'.html';

							echo '<div class="item">
							<div class="number">'.$i.'.</div>
							<div class="content">
							<div class="title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
							<div class="info">
							<span class="date">'.$cdate.'</span>';
							if($views > 0){
								echo '<span class="views">'.$views.'views</span>';
							}
							echo '</div>
							</div>
							<div class="box-thumb"><a href="'.$link.'" title="'.$title.'">'.$thumb.'</a></div>
							</div>';
							$i++;
						}
						?>
					</aside>
				</div>
			</div>
		</div>
	</div>
</section>