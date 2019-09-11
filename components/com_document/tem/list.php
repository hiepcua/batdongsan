<?php
$objdoc = new CLS_DOCUMENT();
$cur_page=isset($_GET['page'])? $_GET['page']: '1';
$cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
$strWhere = " AND isactive=1";
$total_rows = $objdoc->getCount($strWhere);
?>
<section class="wrapper-report">
    <div class="container">
        <div class="bread">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?php echo ROOTHOST;?>"><i class="fa fa-home" aria-hidden="true"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">
						<a href="<?php echo ROOTHOST;?>mau-phieu-dang-ki-xet-tuyen">
						Mẫu phiếu đăng kí xét tuyển</li></a>
				</ol>
            </nav>
        </div>
        <div class="wrapper-content">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 colmain">
					<div class="wrapper-right">
						<div class="top">
							<h1 class="main-title"><span>Mẫu phiếu đăng kí xét tuyển</span></h1>
						</div>
						<?php
						if($total_rows>0){
							$max_page=ceil($total_rows/MAX_ROWS);

							if($cur_page>$max_page) $cur_page=$max_page;
							$start=($cur_page-1)*MAX_ROWS;

							$objdoc->getList($strWhere." ORDER BY `order` ASC,id DESC LIMIT $start,".MAX_ROWS);
							$i=0;
							while ($row=$objdoc->Fetch_Assoc()) {
								$i++;
								$id = $row['id'];
								$title = stripslashes(html_entity_decode($row['name']));
								$code  = $row['code'];
								$link  = ROOTHOST.'mau-phieu-dang-ki-xet-tuyen/'.$code.'.html';
								$thumb = getThumb($row['thumb'],'img-responsive',$title);
								$thumb='<a href="'.$link.'" title="'.$title.'" class="box_img">'.$thumb.'</a>';
								$cdate = date('d/m/Y H:i A',strtotime($row['cdate']));
								$intro = stripslashes(html_entity_decode($row['intro']));
								echo '<div class="box_documents">';
									echo '<div class="img col-xs-4">'.$thumb.'</div>
									<div class="box_info col-xs-8">
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
				<div class="col-xl-3 col-md-3 hidden-sm hidden-xs colright">
					<?php
					include_once("modules/mod_lastestnews/hotnews.php");
					include_once("modules/mod_video/left.php");
					$this->loadModule('right');
					?>
				</div>
			</div>
		</div>
    </div>
</section>