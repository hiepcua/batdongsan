<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div class="body">
	<script language="javascript">
		function checkinput(){	
			if($("#txtname").val()==""){
				$("#txtname_err").fadeTo(200,0.1,function()
				{ 
					$(this).html('Yêu cầu nhập tên').fadeTo(900,1);
				});
				$("#txtname").focus();
				return false;
			}
			if($("#txtcode").val()==""){
				$("#txtcode_err").fadeTo(200,0.1,function()
				{ 
					$(this).html('Yêu cầu nhập mã').fadeTo(900,1);
				});
				$("#txtcode").focus();
				return false;
			}
			else if (($("#txtcode").val().trim()).length<2) {
				$("#txtcode_err").fadeTo(200,0.1,function()
				{
					$("#txtcode_err").html("Mã gồm ít nhất 2 ký tự").fadeTo(900,1);
				});
				$("#txtcode").focus();
				return false;
			}
			return true;
		}
		$(document).ready(function(){
			$("#txtname").blur(function() {
				if( $(this).val()=='') {
					$("#txtname_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Yêu cầu nhập tên').fadeTo(900,1);
					});
				}
				else {
					$("#txtname_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('').fadeTo(900,1);
					});
				}
			})
			$("#txtcode").blur(function() {
				if( $(this).val()=='') {
					$("#txtcode_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Yêu cầu nhập mã').fadeTo(900,1);
					});
				}
				else {
					$("#txtcode_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('').fadeTo(900,1);
					});
				}
			})
		})
	</script>
	<div>
		<div class="com_header color">
			<i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới menus
			<div class="pull-right">
				<?php require_once("../global/libs/toolbar.php"); ?>
			</div>
		</div>
	</div><br>
	
	<form id="frm_action" class="form-horizontal" name="frm_action" method="post" action="">
		<div class='col-sm-12'>
		<p>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</p>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-sm-3 control-label">Tên menu<font color="red">*</font></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="txtname" id="txtname">
						<input name="txttask" type="hidden" id="txttask" value="1" />
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-6"><label class="control-label"><font id="txtname_err" color="red"></font></label></div>
			<div class="clearfix"></div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-sm-3 control-label">Mã menu<font color="red">*</font></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="txtcode" id="txtcode">
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-6"><label class="control-label"><font id="txtcode_err" color="red"></font></label></div>
			<div class="clearfix"></div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-sm-3 control-label">Hiển thị</label>
					<div class="col-sm-9">
						<label class="radio-inline"><input name="optactive" type="radio" id="radio" value="1" checked>Có</label>
						<label class="radio-inline"><input type="radio" value="0" name="optactive">Không</label>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		</div>
		<fieldset>
			<legend><strong>Mô tả:</strong></legend>
			<textarea name="txtdesc" id="txtdesc" cols="45" rows="5"></textarea>
			<script language="javascript">
				var oEdit1=new InnovaEditor("oEdit1");
				oEdit1.width="100%";
				oEdit1.height="200";
				oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
				oEdit1.REPLACE("txtdesc");
				document.getElementById("idContentoEdit1").style.height="200px";
			</script>
			<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
		</fieldset>
	</form>
</div>