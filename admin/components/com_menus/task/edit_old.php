<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=(int)$_GET["id"];
$obj->getList(' WHERE id='.$id);
$row=$obj->Fetch_Assoc();
?>
<div class="body">
	<script language="javascript">
		function checkinput(){
			if($("#txtname").val()==""){
				$("#txtname_err").fadeTo(200,0.1,function(){ 
					$(this).html('Yêu cầu nhập tên').fadeTo(900,1);
				});
				$("#txtname").focus();
				return false;
			}
			if($("#txtcode").val()==""){
				$("#txtcode_err").fadeTo(200,0.1,function(){ 
					$(this).html('Yêu cầu nhập mã').fadeTo(900,1);
				});
				$("#txtcode").focus();
				return false;
			}
			else if (($("#txtcode").val().trim()).length<2) {
				$("#txtcode_err").fadeTo(200,0.1,function(){
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
	<div class="com_header color">
		<i class="fa fa-pencil-square" aria-hidden="true"></i> Sửa menus
		<div class="pull-right">
			<?php require_once("../global/libs/toolbar.php"); ?>
		</div>
	</div><br>
	
	<form id="frm_action" name="frm_action" method="post" action="">
	<div class='col-sm-12'>
		<p>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</p>
		<input type="hidden" name="txtid" id="txtid" value="<?php echo $row['id'];?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-3 form-control-label">Tên menu*</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" value="<?php echo $row['name'];?>" name="txtname" id="txtname">
						<span id="txtname_err" class="check_error"></span>
						<input name="txttask" type="hidden" id="txttask" value="1" />
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-6"><label class="control-label"><font id="txtname_err" color="red"></font></label></div>
			<div class="clearfix"></div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-3 form-control-label">Mã menu*</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" value="<?php echo $row['code'];?>" name="txtcode" id="txtcode">
					</div>
					<span id="txtcode_err" class="check_error"></span>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-6"><label class="control-label"><font id="txtcode_err" color="red"></font></label></div>
			<div class="clearfix"></div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-3 form-control-label">Hiển thị</label>
					<div class="col-sm-9">
						<label class="radio-inline"><input name="optactive" type="radio" id="radio" value="1" <?php if($row['isactive']==1) echo "checked";?>>Có</label>
						<label class="radio-inline"><input name="optactive" type="radio" id="radio2" value="0" <?php if($row['isactive']==0) echo "checked";?>>Không</label>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		</div>
		<fieldset>
			<legend><strong>Mô tả:</strong></legend>
			<textarea name="txtdesc" id="txtdesc" cols="45" rows="5"><?php echo $row['desc'];?></textarea>
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