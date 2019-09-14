<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM tbl_mnuitems WHERE id=".$id;
$objmysql->Query($sql);
$row = $objmysql->Fetch_Assoc();

$mnuid = isset($_GET['mnuid']) ? (int)$_GET['mnuid'] : 0;
$sql_menu = "SELECT * FROM tbl_menus WHERE id=".$mnuid;
$objmysql->Query($sql_menu);
$row_menu = $objmysql->Fetch_Assoc();

$viewtype = "block";
if(isset($_POST["txt_viewtype"])){
	$viewtype = $_POST["txt_viewtype"];
}else{
	$viewtype = $row['viewtype'];
}
?>
<style type="text/css">
	.form-group{
		display: block;
		overflow: hidden;
	}
</style>
<script language="javascript">
	function checkinput(){
		if($("#cbo_viewtype").val()=="block"){
			if($("#cbo_cate").val()=="0") {
				$("#err_cate").fadeTo(200,0.1, function(){ 
					$(this).html('Vui lòng chọn một nhóm tin').fadeTo(900,1);
				});
				return false;
			}
		}
		else if($("#cbo_viewtype").val()=="article"){
			if($("#cbo_article").val()=="0") {
				$("#err_article").fadeTo(200,0.1,function()
				{ 
					$(this).html('Vui lòng chọn một bài viết').fadeTo(900,1);
				});
				return false;
			}
		}
		else if($("#cbo_viewtype").val()=="link"){
			if($("#txtlink").val()=="" || $("#txtlink").val()=="http://" ) {
				$("#err_link").fadeTo(200,0.1,function()
				{ 
					$(this).html('Vui lòng nhập đường dẫn đến bài viết').fadeTo(900,1);
				});
				$("#txtlink").focus();
				return false;
			}
		}

		if($("#txtname").val()==""){
			$("#err_name").fadeTo(200,0.1,function()
			{ 
				$(this).html('Vui lòng nhập tên').fadeTo(900,1);
			});
			return false;
		}
		return true;
	}

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

<div id="path">
	<ol class="breadcrumb">
		<li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
		<li><a href="<?php echo ROOTHOST_ADMIN.COMS.'/'.$row_menu['id'];?>">Quản lý <?php echo $row_menu['name'];?></a></li>
		<li class="active">Cập nhật <?php echo $row_menu['name'];?> chi tiết</li>
	</ol>
</div>

<div class="com_header color" style="margin-bottom: 0px;">
	<h1>Cập nhật <?php echo $row_menu['name'];?></h1>
	<div class="pull-right">
		<form id="frm_menu" name="frm_menu" method="post" action="">
			<input type="hidden" name="txtorders" id="txtorders" />
			<input type="hidden" name="txtids" id="txtids" />
			<input type="hidden" name="txtaction" id="txtaction" />

			<ul class="list-inline">
				<li><a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</a></li>
				<li><a class="btn btn-default"  href="<?php echo ROOTHOST_ADMIN.COMS.'/'.$row_menu['id'];;?>" title="Đóng"><i class="fa fa-sign-out" aria-hidden="true"></i> Đóng</a></li>
			</ul>
		</form>
	</div>
</div>
<div class="clearfix"></div>

<form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
	<input type="text" name="txt_viewtype" id="txt_viewtype" />
</form>

<form id="frm_action" class="" name="frm_action" method="post" action="">
	<input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
	<p>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</p>
	<div class="row">
		<div class="form-group">
			<div class="col-md-6">
				<label>Kiểu hiển thị<small class="cred"> (*)</small><span id="err_viewtype" class="mes-error"></span></label>
				<select name="cbo_viewtype" id="cbo_viewtype" class="form-control" onchange="select_type();">
					<option value="link" selected="selected">Links</option>
					<option value="block">Nhóm tin</option>
					<option value="article">Bài viết</option>
					<script language="javascript">
						cbo_Selected('cbo_viewtype','<?php echo $viewtype;?>');
					</script>
				</select>
			</div>

			<?php if($viewtype == "block"){?>
				<div class="col-md-6">
					<label>Nhóm tin<small class="cred"> (*)</small><span id="err_cate" class="mes-error"></span></label>
					<select name="cbo_cate" id="cbo_cate" class="form-control" style="width:100%;">
						<option value="0" title="Top">Chọn một nhóm tin</option>
						<?php $obj_cate->getListCate(0,0); ?>
					</select>
					<script type="text/javascript">
						$(document).ready(function() {
							cbo_Selected('cbo_cate','<?php echo $row['cate_id'];?>');
							$("#cbo_cate").select2();
						});
					</script>
				</div>
			
			<?php } else if($viewtype == "article"){?>
				<div class="col-md-6">
					<label>Bài viết<small class="cred"> (*)</small><span id="err_article" class="mes-error"></span></label>
					<select name="cbo_article" id="cbo_article" class="form-control" style="width: 100%;">
						<option value="0" title="N/A">Chọn một bài viết</option>
						<?php
						$sql_con = "SELECT * FROM `tbl_contents` WHERE  isactive = '1'";
						$objmysql->Query($sql_con);
						while($r_con = $objmysql->Fetch_Assoc()){
							$id 	= $r_con['id'];
							$title 	= $r_con['title'];
							echo "<option value=\"$id\">$title</option>";
						}
						?>
					</select>
					<script type="text/javascript">
						$(document).ready(function() {
							cbo_Selected('cbo_article','<?php echo $row['content_id'];?>');
							$("#cbo_article").select2();
						});
					</script>
					<div class="clearfix"></div>
				</div>
			<?php } else { ?>
				<div class="col-md-6">
					<label>Link<small class="cred"> (*)</small><span id="err_link" class="mes-error"></span></label>
					<input name="txtlink" type="text" id="txtlink" class="form-control" value="<?php echo $row['link'];?>" placeholder="http://"/>
					<div class="clearfix"></div>
				</div>
			<?php }?>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<label>Tên<small class="cred"> (*)</small><span id="err_name" class="mes-error"></span></label>
				<input name="txtname" type="text" id="txtname" class="form-control" value="<?php echo $row['name'];?>" placeholder="Tên menu item">
				<div class="clearfix"></div>
			</div>

			<div class="col-md-6">
				<label>Danh mục cha</label>
				<select name="cbo_parid" id="cbo_parid" class="form-control" style="width: 100%;">
					<option value="0">Top</option>
					<?php echo $obj->getListMenuItem($mnuid,0,0); ?>
				</select>
				<script type="text/javascript">
					$(document).ready(function() {
						cbo_Selected('cbo_parid','<?php echo $row['par_id'];?>');
						$("#cbo_parid").select2();
					});
				</script>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<label>Biểu tượng (Icon)</label>
				<input type="text" name="txticon" id="txticon" class="form-control" value="<?php echo $row['icon'];?>" />
				<div class="clearfix"></div>
			</div>

			<div class="col-md-6">
				<label>Class</label>
				<input type="text" name="txtclass" id="txtclass" class="form-control" value="<?php echo $row['class'];?>" />
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<label>Hiển thị</label>
				<div>
					<label class="radio-inline"><input type="radio" value="1" name="optactive" <?php if($row['isactive'] == '1') echo 'checked';?>>Có</label>
					<label class="radio-inline"><input type="radio" value="0" name="optactive" <?php if($row['isactive'] == '0') echo 'checked';?>>Không</label>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-xs-12">
				<label>Sapo:</label>
				<textarea name="txtdesc" id="txtdesc" cols="45" rows="5"><?php echo $row['intro'];?></textarea>
			</div>
		</div>
	</div>
	<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
	<div class="text-center toolbar">
		<div style="height: 20px;"></div>
		<a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
	</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        tinymce.init({selector:'#txtdesc'});
    });
</script>