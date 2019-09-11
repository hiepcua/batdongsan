<div class="wrapper_video">
    <div class="container">
        <div class="bread">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= ROOTHOST; ?>" title="Trang chủ">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thư viện video</li>
                </ol>
            </nav>
        </div>
        <div class="list_video">
            <div class="row">
                <div class="colmain left col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="top"><h1 class="main-title"><span>Thư viện Video</span></h1></div>
					<?php
						$objvi = new CLS_VIDEO();
                        $strwhere = ' AND `isactive` = 1 ORDER BY `order` ASC,id DESC';
                        $total_rows = $objvi->getCount($strwhere);
                        $max_rows = MAX_ROWS;
                        $cur_page = 1;
                        $max_page = ceil($total_rows / $max_rows);
                        if(isset($_GET['page'])){$cur_page = (int)$_GET['page'];}
                        if($cur_page > $max_page) $cur_page = $max_page;
                        $start = ($cur_page-1) * $max_rows;
                        if($total_rows > 0) {
                            $strwhere = " $strwhere LIMIT $start,$max_rows";
                            $objvi->getList($strwhere);
                            ?>
                            <div class="row">
                                <?php while($row = $objvi->Fetch_Assoc()) { 
								$video_id = $row['video_id'];
								$title = stripslashes(html_entity_decode($row['name']));?>
								<div class="col-md-6 col-xs-12 item_video">
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $video_id;?>?rel=0&amp;autoplay=0 " allowfullscreen="true"></iframe>
									</div>
									<div class="name">
										<h3 title="<?php echo $title;?>"><?php echo $row['name']; ?></h3>
									</div>
								</div>
								<?php } ?>
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
					$this->loadModule('right');
					?>
				</div>
            </div>
        </div>
    </div>
</div>