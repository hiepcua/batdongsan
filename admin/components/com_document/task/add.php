<?php
defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div class="com_header color">
	<i class="fa fa-list" aria-hidden="true"></i> Thêm mới tài liệu
	<div class="pull-right">
		<form id="frm_menu" name="frm_menu" method="post" action="">
			<input type="hidden" name="txtorders" id="txtorders" />
			<input type="hidden" name="txtids" id="txtids" />
			<input type="hidden" name="txtaction" id="txtaction" />

			<ul class="list-inline">
				<li><a class="save btn btn-default" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</a></li>
				<li><a class="btn btn-default"  href="<?php echo ROOTHOST_ADMIN.COMS;?>" title="Đóng"><i class="fa fa-sign-out" aria-hidden="true"></i> Đóng</a></li>
			</ul>
		</form>
	</div>
</div>
<div class="col-md-12">
	<form id="frm_action" name="frm_action" method="post" action="">
	<div class="col-md-8"><div class="row"><div class="row">
		<div class="form-group">
			<div class="col-md-3"><label>Tên tài liệu <font color="red">*</font></label></div>
			<div class="col-md-9">
				<input name="txttitle" type="text" id="txttitle" size="50" class="form-control"/>
				<label id="txttitle_err" class="check_error"></label>
				<input name="txttask" type="hidden" id="txttask" value="1" />
				<input name="filetype" type="hidden" id="filetype" value="" size="50"/>
				<!--File size-->
				<input name="filesize" type="hidden" id="filesize" value="" size="50"/>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3"><label>Nhóm tài liệu <font color="red">*</font></label></div>
			<div class="col-md-6">
				<select name="cbo_group" id="cbo_group" class="form-control">
					<?php
					if(!isset($objdoctype))
						$objdoctype=new CLS_DOCUMENT_TYPE();
					$objdoctype->ListDocumentType(0,0,0,1);
					?>
				</select>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3"><label>File upload&nbsp;</label></div>
			<div class="col-md-6">
				<input size="35" name="txturl" type="text" class="form-control" value="" required> 
			</div><div class="col-md-3">
				<a href="#" class="btn btn-primary" onclick="OpenPopup('<?php echo ROOTHOST_ADMIN;?>extensions/upload_document.php');">Chọn</a>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3"><label>Ngày ban hành&nbsp;</label></div>
			<div class="col-md-6">
				<input id="txtdate_issued" name="txtdate_issued" type="date" class="form-control"/>
			</div>
			<div class="col-md-3">tháng/ngày/năm</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3"><label>Tình trạng&nbsp;</label></div>
			<div class="col-md-9">
				<input name="optactive" type="radio" id="radio" value="1" checked /> Hiện
				<input name="optactive" type="radio" id="radio2" value="0"/> Ẩn
			</div>
			<div class="clearfix"></div>
		</div>
	</div></div></div>
	<div class="form-group">
		<br style="clear:both" />
		<div><strong>Mô tả</strong></div>
		<textarea class="form-control" name="txtintro" id="txtintro" cols="45" rows="5"></textarea>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div><strong>Nội dung&nbsp;</strong></div>
		<textarea name="txtdesc" id="txtdesc" cols="45" rows="5"></textarea>
		<script language="javascript">
			var oEdit1=new InnovaEditor("oEdit1");
			oEdit1.width="100%";
			oEdit1.height="100";
			oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
			oEdit1.REPLACE("txtdesc");
			document.getElementById("idContentoEdit1").style.height="250px";
		</script>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div><strong>Meta title&nbsp;</strong></div>
		<input class='form-control' name="txtmetatitle" type="text" id="txtmetatitle" size="45" value="" />
	</div>
	<div class="form-group">
		<div><strong>Meta keyword&nbsp;</strong></div>
		<textarea class='form-control' name="txtmetakey" cols="28" rows="3" id="txtmetakey"></textarea>
	</div>
	<div class="form-group">
		<div><strong>Meta description&nbsp;</strong></div>
		<textarea class='form-control' name="textmetadesc" cols="28" rows="5" id="textmetadesc"></textarea>
		<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
	</div>
	</form>
</div>
<script language="javascript">
function checkinput(){
	if($("#txttitle").val()==""){
		$("#txttitle_err").fadeTo(200,0.1,function()
		{ 
			$(this).html('Vui lòng nhập tên tài liệu').fadeTo(900,1);
		});
		$("#txttitle").focus();
		return false;
	}
	return true;
}
$(document).ready(function() {
	$("#txttitle").blur(function(){
		if ($("#txttitle").val()=="") {
			$("#txttitle_err").fadeTo(200,0.1,function()
			{ 
				$(this).html('Vui lòng nhập tên tài liệu').fadeTo(900,1);
			});
		}
	});
});
</script>