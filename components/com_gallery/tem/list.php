<div class="clearfix"></div>
<div class="wrapper_album">
    <div class="container">
        <div class="bread">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo ROOTHOST; ?>" title="ngân sơn">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Hình ảnh hoạt động</li>
                </ol>
            </nav>
        </div>
        <div class="list_album">
            <div class="row">
                <div class="left col-lg-9 col-md-9 col-sm-12 col-xs-12 colmain ">
					<div class="top"><h1 class="main-title"><span>Thư viện hình ảnh</span></h1></div>
					<?php
                        $objAlbum = new CLS_ALBUM();
                        $strwhere = ' ';
                        $total_rows = $objAlbum->getCount($strwhere);
                        $max_rows = MAX_ROWS;
                        $cur_page = 1;
                        $max_page = ceil($total_rows / $max_rows);
                        if(isset($_GET['page'])){$cur_page = (int)$_GET['page'];}
                        if($cur_page > $max_page) $cur_page = $max_page;
                        $start = ($cur_page-1) * $max_rows;
                        if($total_rows > 0) {
                            $strwhere = " $strwhere ORDER BY `order` ASC, id DESC LIMIT $start,$max_rows";
                            $objAlbum->getList($strwhere);
                            ?>
                            <div class="row">
                                <?php
                                while($row = $objAlbum->Fetch_Assoc()) {
                                    $url = ROOTHOST.'gallery/'.$row['id'].'/'.$row['code'].'.html';
                                    $title = stripslashes($row['name']);
									$thumb = getThumb($row['thumb'],'img-responsive',$title);
									$thumb='<a href="'.$url.'" title="'.$title.'" class="box_img">'.$thumb.'</a>';
									?>
                                    <div class="col-md-6 col-xs-12 item_gallery">
										<div class="img"><?php echo $thumb;?></div>
										<div class="name">
											<h3 title="<?php echo $title;?>">
												<a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
												<?php echo $title; ?></a>
											</h3>
										</div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php } ?>
                    <div class="clearfix"></div>
                    <div id="paging" class="text-center">
                        <?php
                        $thisurl = curPageURL();
                        $par = getParameter($thisurl);
                        $par['page'] = "{page}";
                        $link_full=conver_to_par($par);
                        if ($total_rows>$max_rows) {
                            paging1($total_rows, $max_rows, $cur_page, $link_full);
                        }
                        ?>
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
</div>