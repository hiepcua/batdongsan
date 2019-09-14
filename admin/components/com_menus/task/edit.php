<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=(int)$_GET["id"];

$sql = "SELECT * FROM tbl_menus WHERE id = ".$id;
$objmysql->Query($sql);
$row = $objmysql->Fetch_Assoc();
?>
<script language="javascript">
	function checkinput(){	
		if($("#txtname").val()==""){
			$("#txtname_err").fadeTo(200,0.1,function(){
				$(this).html('Yêu cầu nhập tên').fadeTo(900,1);
			});
			return false;
		}
		return true;
	}
</script>

<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li><a href="<?php echo ROOTHOST_ADMIN.COMS;?>">Danh sách Menu</a></li>
        <li class="active">Cập nhật Menu</li>
    </ol>
</div>

<div class="com_header color">
    <h1>Cập nhật Menu</h1>
    <div class="pull-right">
        <form id="frm_menu" name="frm_menu" method="post" action="">
            <input type="hidden" name="txtorders" id="txtorders" />
            <input type="hidden" name="txtids" id="txtids" />
            <input type="hidden" name="txtaction" id="txtaction" />

            <ul class="list-inline">
                <li><a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</a></li>
                <li><a class="btn btn-default"  href="<?php echo ROOTHOST_ADMIN.COMS;?>" title="Đóng"><i class="fa fa-sign-out" aria-hidden="true"></i> Đóng</a></li>
            </ul>
        </form>
    </div>
</div>
<div class="clearfix"></div>

<form id="frm_action" class="form-horizontal" name="frm_action" method="post" action="">
	<input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
	<p>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</p>
	<div class='col-sm-12'>
		<div class="row">
			<div class="form-group">
				<div class="col-md-6">
					<label>Tên Menu<small class="cred"> (*)</small><span id="txtname_err" class="mes-error"></span></label>
					<input type="text" class="form-control" name="txtname" value="<?php echo $row['name'];?>" id="txtname">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6">
					<label>Hiển thị</label>
					<div>
						<label class="radio-inline"><input name="optactive" type="radio" id="radio" value="1" <?php if($row['isactive']=='1') echo 'checked';?>>Có</label>
						<label class="radio-inline"><input type="radio" value="0" name="optactive" <?php if($row['isactive']=='0') echo 'checked';?>>Không</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<textarea name="txtdesc" id="txtdesc" rows="5"><?php echo $row['desc'];?></textarea>
				</div>
			</div>
			<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
			<div class="text-center toolbar">
				<div style="height: 20px;"></div>
				<a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        tinymce.init({selector:'#txtdesc'});
    });
</script>