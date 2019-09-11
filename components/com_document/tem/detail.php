<?php
$code = ($_GET['code']) ? $_GET['code'] : "";
$doc_id = 0;
$objdoc = new CLS_DOCUMENT();
$objdoc->getList(' AND isactive=1 AND `code` = "' . $code . '"');
if($objdoc->Num_rows()>0) {
	$detail = $objdoc->Fetch_Assoc(); 
	$view = $detail['views'];
	$download = $detail['downloads'];
	$cdate = date("d/m/Y",strtotime($detail['cdate']));
	$doc_id = $detail['id'];
	$objdoc->updateView($doc_id);
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
						<div class="wrapper-right detail_document">
							<div class="main-title"><h1><?php echo $detail['name']; ?></h1></div>
							<div class="create_date"><small><i>Ngày đăng: <?php echo $cdate;?></i></small>
								<span class="pull-right">Lượt xem: <?php echo $view;?> | Lượt tải: <?php echo $download;?></span>
							</div>
							<div class="intro">
								<?php echo $detail['content']; ?>
							</div>
							<div class="clearfix"><br></div>
							<iframe src="http://docs.google.com/gview?url=<?php echo $detail['fullurl']; ?>&embedded=true" style="width:100%; height:1000px;" frameborder="0"></iframe>
							<div class="clearfix"><br></div>
							<div class="detail">
								<p><span style="font-size: 12pt;">Vui lòng tải file đính kèm và điền đầy đủ thông tin.</span></p>
								<div class="box_download">
									<a class="btn btn-md btn-success" href="<?php echo $detail['fullurl'];?>" onclick="updateDownload(<?php echo $doc_id;?>)">
									<i class="fa fa-cloud-download"></i> Download File</a>
									<div class="regis text-center animated fadeInRight">
										<a href="<?php echo ROOTHOST;?>dang-ky-xet-tuyen.html" target="_blank" class="btn btn-success btn-regis"><i class="fa fa-angle-double-down"></i> ĐĂNG KÝ XÉT TUYỂN TRỰC TUYẾN</a>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"><br></div>
						<?php include_once("modules/mod_document/releated.php"); ?>
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
<?php } ?>
<script>
function updateDownload(doc_id) {
	var url = "<?php echo ROOTHOST;?>ajaxs/update_download.php";
	$.post(url,{'doc_id':doc_id},function(req){
		console.log(req);
	})
}
</script>