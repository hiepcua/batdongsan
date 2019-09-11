<?php
$id = ($_GET['id']) ? (int)$_GET['id'] :0;
$code = ($_GET['code']) ? addslashes(strip_tags($_GET['code'])) : "";
$objAlbum = new CLS_ALBUM();
$objAlbum->getList(" AND id=$id");
$r = $objAlbum->Fetch_Assoc();
$ablum_name = stripslashes(html_entity_decode($r['name']));
$ablum_intro = stripslashes(html_entity_decode($r['intro']));
$view = $r['visited'];
$cdate = date("d/m/Y",strtotime($r['cdate']));
$objAlbum->updateView($id);
?>
<div class="clearfix"></div>
<div class="wrapper_gallery">
    <div class="container">
        <div class="bread">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo ROOTHOST; ?>" title="Trang chủ">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo ROOTHOST; ?>gallery">Hình ảnh hoạt động</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $ablum_name; ?></li>
                </ol>
            </nav>
        </div>
		<div class="row">
		<div class="left col-lg-9 col-md-9 col-sm-12 col-xs-12 colmain "><div class="content">
			<div class="main-title"><h1 title="<?php echo $ablum_name;?>"><?php echo $ablum_name;?></h1></div>
			<div class="create_date"><small><i>Ngày đăng: <?php echo $cdate;?></i></small>
				<span class="pull-right">Lượt xem: <?php echo $view;?></span>
			</div>
			<div class="gallery-intro"><?php echo $ablum_intro;?></div>
			<div class="box_gallery"><div class="box">
				<?php
					$obj->getList(" AND album_id=$id");
					$total = $obj->Num_rows();
					if($total>0) { $i=0; $arr = array();
						echo "<div class='col-md-10 col-xs-10 big_thumb'>";
						while($img =$obj->Fetch_Assoc()) { $i++; $arr[] = $img;
							if($i==1) echo "<img src='".$img['link']."' class='img-responsive active' dataid='$i'/>";
							else echo "<img src='".$img['link']."' class='img-responsive' dataid='$i'/>";
						}
						echo "</div>";
						echo "<div class='col-md-2 col-xs-2 small_thumb'><div class='thumb_box'>";
						$i=0; 
						foreach($arr as $img) { $i++; 
							if($i==1) echo "<div class='horizontal'><div class='vertical active'>";
							else echo "<div class='horizontal'><div class='vertical'>";
							echo "<img src='".$img['link']."' class='img-responsive' dataid='$i'/>";
							echo "</div></div>";
						} // end while
						echo "</div></div>";
					} // end if
				?>
					<div class='preview'><i class='fa fa-angle-up'></i></div>
					<div class='next'><i class='fa fa-angle-down'></i></div>
				</div>
				<div class='clearfix'></div>
			</div>
			<?php
			$objAlbum->getList(" AND id<>$id ORDER BY `id` DESC LIMIT 0,9");
			if($objAlbum->Num_rows()>0) {
			?>
			<div class='orther-gallery'>
			<div class="main-title"><span>Hình ảnh khác</span></div>
			<div class="tit_line"></div>
			<div class="gallery row">
				<?php 
				while($row=$objAlbum->Fetch_Assoc()){
					$img=stripslashes($row["thumb"]);
					$title=stripslashes(trim($row['name']));
					$code=$row['code'];
					$link = ROOTHOST.'gallery/'.$row["id"].'/'.$code.'.html';
					echo '<div class="col-md-4 col-sm-6 col-xs-12 item">';
					echo '<a href="'.$link.'"><div class="img"><img src="'.$img.'" class="img-responsive"/></div><h3 class="name">'.$title.'</h3></a></div>';
				} ?>
			</div></div>
			<?php } // endif
			unset($content); unset($title); unset($id);
			?>
		</div></div>
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
<script>
var slide_number = 0;
var slide_top = 15; // default top:15px
var slide_total = $('.small_thumb img').length;
console.log(slide_total);
$(document).ready(function(){
	var timer = setInterval(autoSlide, 3000);
	$('.small_thumb img').click(function(){
		clearInterval(timer); 
		$('.small_thumb .vertical').removeClass('active');
		$(this).parent().addClass('active');
		slide_number = $(this).attr('dataid'); 
		var src = $(this).attr('src');
		$(".big_thumb img").removeClass('active');
		$(".big_thumb img[dataid='"+slide_number+"']").addClass('active');
	})
	$('.box_gallery .preview').click(function(){
		clearInterval(timer); 
		if(slide_number==1) slide_number=slide_total;
		else slide_number--;
		showSlidePrev(slide_number);
	})
	$('.box_gallery .next').click(function(){
		clearInterval(timer); 
		if(slide_number==slide_total) slide_number=1;
		else slide_number++;
		showSlideNext(slide_number);
	})
})
function autoSlide() {
	if(slide_number==slide_total) slide_number=1;
	else slide_number++;
	showSlideNext(slide_number);
	//console.log('a');
}
function showSlideNext(num) {
	$(".big_thumb img").removeClass('active');
	$(".big_thumb img[dataid='"+num+"']").addClass('active');
	$('.small_thumb .vertical').removeClass('active');
	$(".small_thumb img[dataid='"+num+"']").parent().addClass('active');
	
	var slideHeight = $(".small_thumb").height();
	if(slide_number==1) slide_top = 15; 
	else slide_top = slide_top-$(".small_thumb img[dataid='"+num+"']").height();	
	$('.box_gallery .small_thumb .thumb_box').css({'top':slide_top+'px'});
}
function showSlidePrev(num) {
	$(".big_thumb img").removeClass('active');
	$(".big_thumb img[dataid='"+num+"']").addClass('active');
	$('.small_thumb .vertical').removeClass('active');
	$(".small_thumb img[dataid='"+num+"']").parent().addClass('active');
	
	var slideHeight = $(".small_thumb").height();
	if(slide_number==slide_total) slide_top = slide_top - slideHeight; 
	else if(slide_number==1) slide_top = 15;
	else slide_top = slide_top+$(".small_thumb img[dataid='"+num+"']").height();	
	$('.box_gallery .small_thumb .thumb_box').css({'top':slide_top+'px'});
}
</script>