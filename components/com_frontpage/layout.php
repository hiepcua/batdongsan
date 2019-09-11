<?php global $tmp;global $conf;?>
<div class="clearfix"></div>
<?php $tmp->loadModule('banner');?>

<div id="main">
	<section id="welcome" class="padding">
		<div class="container">
			<?php $tmp->loadModule('box1'); ?>
		</div>
	</section>

	<section class="sec_our">
		<article class="container">
			<div class="row row-flex">
				<div class="box-left col-md-6 col-sm-6"></div>
				<div class="box col-md-6 col-sm-6">
					<?php $tmp->loadModule('box2'); ?>
				</div>
			</div>
		</article>
	</section>

	<section class="sec_how">
		<div class="container">
			<h2 class="text-center t-left">Quy trình cầm sim</h2>
			<div class="row clearfix">
				<?php $tmp->loadModule('box3'); ?>
			</div>
		</div>
	</section>
</div>

<section class="sec_wha padding">
	<div class="container">
		<div class="header">
			<h2 class="text-center t-left">Tại sao chọn <span class="lg">Camsim.com?</span></h2>
		</div>
		<div class="content">
			<div class="custom-row">
				<div class="c-col-md-4 col-1">
					<div class="item fea_con">
						<div class="description">
							<div class="i-title">Định giá cao</div>
							<div class="i-des">Với các thẩm định viên chuyên nghiệp, tài sản của bạn sẽ được định giá cao nhất và phù hợp nhất với nhu cầu của bạn.</div>
						</div>
					</div>
					<div class="item fea_hig">
						<div class="description">
							<div class="i-title">Định giá cao</div>
							<div class="i-des">Với các thẩm định viên chuyên nghiệp, tài sản của bạn sẽ được định giá cao nhất và phù hợp nhất với nhu cầu của bạn.</div>
						</div>
					</div>
				</div>
				<div class="c-col-md-4 col-2"><img src="<?= ROOTHOST ?>images/hinh-anh/question.png" class="bg-img"></div>
				<div class="c-col-md-4 col-3">
					<div class="item fea_sim">
						<div class="description">
							<div class="i-title">Định giá cao</div>
							<div class="i-des">Với các thẩm định viên chuyên nghiệp, tài sản của bạn sẽ được định giá cao nhất và phù hợp nhất với nhu cầu của bạn.</div>
						</div>
					</div>
					<div class="item fea_saf">
						<div class="description">
							<div class="i-title">Định giá cao</div>
							<div class="i-des">Với các thẩm định viên chuyên nghiệp, tài sản của bạn sẽ được định giá cao nhất và phù hợp nhất với nhu cầu của bạn.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-6 clearfix padding">
	<div class="bg-session"></div>
	<div class="shadow-mask"></div>
	<div class="container">
		<h3>CẢM NHẬN KHÁCH HÀNG</h3>
		<div class="dlab-separator-outer ">
			<div class="dlab-separator bg-white  style-skew"></div>
		</div>
		<?php include_once ("modules/mod_feedback/layout.php");?>
	</div>
</section>