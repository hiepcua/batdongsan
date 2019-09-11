<?php
global $tmp; 
global $conf;
$thisurl= ROOTHOST.$_SERVER['REQUEST_URI'];
$objcat = new CLS_CATEGORY();
$objcon = new CLS_CONTENTS();
$cate_alias = ($_GET['code']) ? $_GET['code'] : "";
$cat_id = $par_id = 0; $cat_name ='';
$objcat->getList(' AND `code` = "' . $cate_alias . '"');
if($objcat->Num_rows()>0) {
	$cate = $objcat->Fetch_Assoc();
	$cat_id = $cate['id'];
	$par_id = $cate['par_id'];
	$cat_name = stripslashes($cate['name']);
} ?>
<section class="banner_page_header"></section>
<section class="wrapper-report component">
	<div class="container">
		<div class="bread">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?php echo ROOTHOST; ?>" title="Trang chủ">
							<i class="fa fa-home" aria-hidden="true"></i>
						</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $cat_name; ?></li>
				</ol>
			</nav>
		</div>
		<div class="wrapper-content">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="wrapper-right">
						<div class="top">
							<h1 class="main-title"><span><?php echo $cate['name']; ?></span></h1>
						</div>
						<div class="row">
							<?php
							$cur_page=isset($_GET['page'])? $_GET['page']: '1';
							$cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
							$strWhere = " AND category_id=$cat_id";
							$total_rows = $objcon->getCount($strWhere);
							if($total_rows>0){
								$max_page=ceil($total_rows/MAX_ROWS);

								if($cur_page>$max_page) $cur_page=$max_page;
								$start=($cur_page-1)*MAX_ROWS;

								$objcon->getList($strWhere." ORDER BY pin DESC,ishot DESC,`order` ASC,id DESC"," LIMIT $start,".MAX_ROWS);
								$i=0;
								while ($row=$objcon->Fetch_Assoc()) {
									$i++;
									$id = $row['id'];
									$title = stripslashes(html_entity_decode($row['title']));
									$code  = $row['code'];
									$info_cate = $objcat->getInfo(" AND id=".$row['category_id']);
									$link  = ROOTHOST.$info_cate['code'].'/'.$code.'.html';
									$thumb = getThumb($row['thumb'],'img-responsive',$title);
									$thumb='<a href="'.$link.'" title="'.$title.'" class="box_img">'.$thumb.'</a>';
									$cdate = date('d/m/Y H:i A',strtotime($row['cdate']));
									$intro = stripslashes(html_entity_decode($row['intro']));
									echo '<div class="box_news">';
									echo '<div class="img col-md-4 col-sm-4 col-xs-12">'.$thumb.'</div>
									<div class="box_info col-md-8 col-sm-8 col-xs-12">
									<h2 class="title"><a href="'.$link.'" class="name" title="'.$title.'">'.$title.'</a></h2>
									<div class="create_date"><small><i>'.$cdate.'</i></small></div>';
									if($intro!='') echo '<div class="intro">'.$intro.'</div>';
									echo '<div class="readmore"><a href="'.$link.'">xem thêm <i class="fa fa-angle-double-right"></i></a></div>
									</div><div class="clearfix"></div>';
									echo '</div>';
								}
								echo '<div class="clearfix"></div><div class="text-center">';
								paging_index($total_rows,MAX_ROWS,$cur_page);
								echo '</div>';
							} ?>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs colright">
					<?php
					include_once("modules/mod_category/layout.php");
					include_once("modules/mod_lastestnews/hotnews.php");
					include_once("modules/mod_video/left.php");
					$this->loadModule('right');
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('.colleft .list_category li').each(function(){
			if($(this).attr('class')=='<?php echo $cate_alias;?>')
			$(this).addClass('active');
		});
	})
</script>