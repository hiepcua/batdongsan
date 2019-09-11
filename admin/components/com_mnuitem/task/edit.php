<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=(int)$_GET["id"];
$obj->getList(' WHERE id='.$id);
$row=$obj->Fetch_Assoc();
?>
<style type="text/css">
	.form-horizontal .control-label{text-align: left;}
</style>
<div class="body">
	<script language="javascript">
		function checkinput(){	
			if($("#cbo_viewtype").val()=="block"){
				if($("#cbo_cate").val()=="0") {
					$("#category_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Vui lòng chọn một nhóm tin').fadeTo(900,1);
					});
					$("#cbo_cate").focus();
					return false;
				}
			}
			else if($("#cbo_viewtype").val()=="article"){
				if($("#cbo_article").val()=="0") {
					$("#article_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Vui lòng chọn một bài viết').fadeTo(900,1);
					});
					$("#cbo_article").focus();
					return false;
				}
			}

			else if($("#cbo_viewtype").val()=="cate_intro"){
				if($("#cbo_cate_intro").val()=="0") {
					$("#cate_intro_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một nhóm giới thiệu').fadeTo(900,1);
					});
					$("#cbo_cate_intro").focus();
					return false;
				}			
			}
			else if($("#cbo_viewtype").val()=="introduct"){
				if($("#cbo_introduct").val()=="0") {
					$("#introduct_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một bài giới thiệu').fadeTo(900,1);
					});
					$("#cbo_introduct").focus();
					return false;
				}			
			}

			else if($("#cbo_viewtype").val()=="cate_service"){
				if($("#cbo_cate_service").val()=="0") {
					$("#cate_service_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một nhóm SP & DV').fadeTo(900,1);
					});
					$("#cbo_cate_service").focus();
					return false;
				}			
			}
			else if($("#cbo_viewtype").val()=="service"){
				if($("#cbo_service").val()=="0") {
					$("#service_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một SP & DV').fadeTo(900,1);
					});
					$("#cbo_service").focus();
					return false;
				}			
			}

			else if($("#cbo_viewtype").val()=="cate_partner"){
				if($("#cbo_cate_partner").val()=="0") {
					$("#cate_partner_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một nhóm đối tác').fadeTo(900,1);
					});
					$("#cbo_cate_partner").focus();
					return false;
				}			
			}
			else if($("#cbo_viewtype").val()=="partner"){
				if($("#cbo_partner").val()=="0") {
					$("#partner_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một đối tác').fadeTo(900,1);
					});
					$("#cbo_partner").focus();
					return false;
				}			
			}

			else if($("#cbo_viewtype").val()=="document_type"){
				if($("#cbo_document_type").val()=="0") {
					$("#document_type_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một nhóm tài liệu').fadeTo(900,1);
					});
					$("#cbo_document_type").focus();
					return false;
				}			
			}
			else if($("#cbo_viewtype").val()=="document"){
				if($("#cbo_document").val()=="0") {
					$("#document_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một tài liệu').fadeTo(900,1);
					});
					$("#cbo_document").focus();
					return false;
				}			
			}

			else if($("#cbo_viewtype").val()=="question_group"){
				if($("#cbo_question_group").val()=="0") {
					$("#question_group_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một nhóm câu hỏi').fadeTo(900,1);
					});
					$("#cbo_question_group").focus();
					return false;
				}			
			}
			else if($("#cbo_viewtype").val()=="question"){
				if($("#cbo_question").val()=="0") {
					$("#question_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một câu hỏi').fadeTo(900,1);
					});
					$("#cbo_question").focus();
					return false;
				}			
			}

			else if($("#cbo_viewtype").val()=="cate_guide"){
				if($("#cbo_cate_guide").val()=="0") {
					$("#cate_guide_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một nhóm trợ giúp').fadeTo(900,1);
					});
					$("#cbo_cate_guide").focus();
					return false;
				}			
			}
			else if($("#cbo_viewtype").val()=="guide"){
				if($("#cbo_guide").val()=="0") {
					$("#guide_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một bài viết trợ giúp').fadeTo(900,1);
					});
					$("#cbo_guide").focus();
					return false;
				}			
			}
			

			else if($("#cbo_viewtype").val()=="cate_recruitment"){
				if($("#cbo_cate_recruitment").val()=="0") {
					$("#cate_recruitment_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một nhóm tuyển dụng').fadeTo(900,1);
					});
					$("#cbo_cate_recruitment").focus();
					return false;
				}			
			}
			else if($("#cbo_viewtype").val()=="recruitment"){
				if($("#cbo_recruitment").val()=="0") {
					$("#recruitment_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Vui lòng chọn một bài viết tuyển dụng').fadeTo(900,1);
					});
					$("#cbo_recruitment").focus();
					return false;
				}
			}

			else if($("#cbo_viewtype").val()=="link"){
				if($("#txtlink").val()=="" || $("#txtlink").val()=="http://" ) {
					$("#link_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Vui lòng nhập đường dẫn đến bài viết').fadeTo(900,1);
					});
					$("#txtlink").focus();
					return false;
				}
			}

			if($("#txtname").val()==""){
				$("#txtname_err").fadeTo(200,0.1,function()
				{ 
					$(this).html('Vui lòng nhập tên').fadeTo(900,1);
				});
				$("#txtname").focus();
				return false;
			}
			return true;
		}

		$(document).ready(function(){
			$("#txtname").blur(function() {
				if( $(this).val()=='') {
					$("#txtname_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng nhập tên').fadeTo(900,1);
					});
				}
				else {
					$("#txtname_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('').fadeTo(900,1);
					});
				}
			})
		})

		function select_type(){
			var txt_viewtype=document.getElementById("txt_viewtype");
			var cbo_viewtype=document.getElementById("cbo_viewtype");
			for(i=0;i<cbo_viewtype.length;i++){
				if(cbo_viewtype[i].selected==true)
					txt_viewtype.value=cbo_viewtype[i].value;
			}
			document.frm_type.submit();
		}
	</script>
	<?php
	$viewtype="block";
	if(isset($_POST["txt_viewtype"])){
		$viewtype=addslashes($_POST["txt_viewtype"]);
	}
	else{
		$viewtype = $row['viewtype'];
	}
	?>
	<div class="com_header color">
		<i class="fa fa-pencil-square" aria-hidden="true"></i> Sửa menu chi tiết
		<div class="pull-right">
			<?php require_once("../global/libs/toolbar.php"); ?>
		</div>
	</div><br>
	<form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
		<input type="text" name="txt_viewtype" id="txt_viewtype" />
	</form>
	<form id="frm_action" name="frm_action" method="post" action=""> 
	<div class="col-md-12">
		<p>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</p>
		<div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-3 control-label">Kiểu hiển thị*</label>
				<div class="col-sm-9">
					<select name="cbo_viewtype" id="cbo_viewtype" class="form-control" onchange="select_type();">
						<option value="link" selected="selected">Links</option>
						<option value="block">Nhóm tin</option>
						<option value="article">Bài viết</option>
						<script language="javascript">
							cbo_Selected('cbo_viewtype','<?php echo $viewtype;?>');
						</script>
					</select>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php if($viewtype=="block"){?>
		<div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-3 control-label">Nhóm tin*</label>
				<div class="col-sm-9">
					<select name="cbo_cate" id="cbo_cate" class="form-control">
						<option value="0" title="Top">Chọn một nhóm tin</option>
						<?php $obj_cate->getListCate(0,0); ?>
					</select>
					<script type="text/javascript">
						cbo_Selected('cbo_cate','<?php echo $row['cate_id'];?>');
						$(document).ready(function() {
							$("#cbo_cate").select2();
						});
					</script>
					<font id="category_err" class="check_error" color="red"></font>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php } else if($viewtype=="article"){?>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="col-sm-3 form-control-label">Bài viết*</label>
				<div class="col-sm-9">
					<select name="cbo_article" id="cbo_article" class="form-control">
						<option value="0" title="N/A">Chọn một bài viết</option>
						<?php $obj_con->LoadConten(); ?>
						<script language="javascript">
							cbo_Selected('cbo_article','0');
						</script>
					</select>
					<font id="article_err" class="check_error" color="red"></font>
					<script type="text/javascript">
						cbo_Selected('cbo_article','<?php echo $row['con_id'];?>');
						$(document).ready(function() {
							$("#cbo_article").select2();
						});
					</script>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php } else { ?>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="col-sm-3 form-control-label">Link*</label>
				<div class="col-sm-9">
					<input name="txtlink" type="text" id="txtlink" class="form-control" value="<?php echo $row['link'];?>" placeholder="http://"/>
					<font id="link_err" class="check_error" color="red"></font>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<?php }?>
		<div class="clearfix"></div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="col-sm-3 form-control-label">Tên*</label>
				<div class="col-sm-9">
					<input name="txtname" type="text" id="txtname" value="<?php echo $row['name'];?>" class="form-control">
					<font id="txtname_err" class="check_error" color="red"></font>
					<input type="hidden" name="txtid" id="txtid" value="<?php echo $row['id'];?>">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="col-sm-3 form-control-label">Danh mục cha</label>
				<div class="col-sm-9">
					<select name="cbo_parid" id="cbo_parid" class="form-control" style="width: 100%;">
						<option value="0">Top</option>
						<?php echo $obj->getListMenuItem($mnuid,0,0); ?>
					</select>
					<script type="text/javascript">
						cbo_Selected('cbo_parid','<?php echo $row['par_id'];?>');
						$(document).ready(function() {
							$("#cbo_parid").select2();
						});
					</script>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-3 control-label">Biểu tượng (Icon)</label>
				<div class="col-sm-9">
					<input type="text" name="txticon" id="txticon" class="form-control" value="<?php echo $row['icon'];?>"/>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="col-sm-3 form-control-label">Class</label>
				<div class="col-sm-9">
					<input type="text" name="txtclass" id="txtclass" value="<?php echo $row['class'];?>" class="form-control"/>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="col-sm-3 form-control-label">Hiển thị</label>
				<div class="col-sm-9">
					<label class="radio-inline"><input name="optactive" type="radio" id="radio" value="1" <?php if($obj->isActive==1) echo "checked";?>>Có</label>
					<label class="radio-inline"><input name="optactive" type="radio" id="radio2" value="0" <?php if($obj->isActive==0) echo "checked";?>>Không</label>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
		<div class="clearfix"></div>
		<div class="text_inner">
			<div><strong>Mô tả:</strong></div>
			<textarea name="txtdesc" id="txtdesc" cols="45" rows="5"><?php echo $obj->Intro;?></textarea>
			<script language="javascript">
				var oEdit1=new InnovaEditor("oEdit1");
				oEdit1.width="100%";
				oEdit1.height="200";
				oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
				oEdit1.REPLACE("txtdesc");
				document.getElementById("idContentoEdit1").style.height="200px";
			</script>
			<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
		</div>
	</form>
</div>