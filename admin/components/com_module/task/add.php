<?php
defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div class="body">
    <script language="javascript">
        function checkinput(){
            if($('#txttitle').val()=="") {
                $("#txttitle_err").fadeTo(200,0.1,function(){ 
                    $(this).html('Mời bạn nhập tiêu đề Module').fadeTo(900,1);
                });
                $('#txttitle').focus();
                return false;
            }
            if( $('#cbo_type').val()=="mainmenu") {
                if($('#cbo_menutype').val()=="") {
                    $("#menutype_err").fadeTo(200,0.1,function(){ 
                        $(this).html('Mời chọn kiểu Menu cần hiển thị').fadeTo(900,1);
                    });
                    $('#cbo_menutype').focus();
                    return false;
                }
            }
            return true;
        }
        function select_type(){
            var txt_viewtype=document.getElementById("txt_type");
            var cbo_viewtype=document.getElementById("cbo_type");
            for(i=0;i<cbo_viewtype.length;i++){
                if(cbo_viewtype[i].selected==true)
                    txt_viewtype.value=cbo_viewtype[i].value;
            }
            document.frm_type.submit();
        }

        $(document).ready(function() {
            $('#txttitle').blur(function(){
                if($(this).val()=="") {
                    $("#txttitle_err").fadeTo(200,0.1,function(){ 
                        $(this).html('Mời bạn nhập tiêu đề Module').fadeTo(900,1);
                    });
                    $('#txttitle').focus();
                }
            })
        });
    </script>
    <?php
    $viewtype="mainmenu";
    if(isset($_POST["txt_type"]))
        $viewtype=$_POST["txt_type"];
    ?>
	<div class="com_header color">
		<i class="fa fa-list" aria-hidden="true"></i> Thêm mới Module
		<div class="pull-right">
			<?php require_once("../global/libs/toolbar.php"); ?>
		</div>
    </div><br>
	<div class="text_inner">
    <form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
        <input type="text" name="txt_type" id="txt_type" />
    </form>
    <form id="frm_action" class="form-horizontal" name="frm_action" method="post" action="">
        <p>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</p>
        <fieldset>
            <legend><strong>Chi tiết:</strong></legend>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kiểu hiển thị*</label>
                        <div class="col-sm-6">
                            <select name="cbo_type" class="form-control" id="cbo_type" onchange="select_type();" style="width: 100%;">
                                <?php 
                                $obj->LoadModType();?>
                                <script language="javascript">
                                    cbo_Selected('cbo_type','<?php echo $viewtype;?>');
                                    $(document).ready(function() {
                                        $("#cbo_type").select2();
                                    });
                                </script>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tiêu đề*</label>
                        <div class="col-sm-6">
                            <input name="txttitle" type="text" id="txttitle" class="form-control" value="">
                            <span id="txttitle_err" class="check_error"></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
				<?php $arr_type=array('html','news');
				if(in_array($viewtype,$arr_type)){ ?>
				<div class="col-md-9">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-6">
                            <textarea name="txtintro" id="txtintro" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
				<?php } ?>
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Hiển thị tiêu đề</label>
                        <div class="col-sm-6">
                            <label class="radio-inline"><input type="radio" name="optviewtitle" value="1">Có</label>
                            <label class="radio-inline"><input type="radio" name="optviewtitle" value="0" checked>Không</label>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vị trí</label>
                        <div class="col-sm-6">
                            <select name="cbo_position" class="form-control" id="cbo_position" style="width: 100%;">
                                <?php LoadPosition();?>
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $("#cbo_position").select2();
                                });
                            </script>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Class</label>
                        <div class="col-sm-6">
                            <input type="text" name="txtclass" id="txtclass" class="form-control" value="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Hiển thị</label>
                        <div class="col-sm-6">
                            <label class="radio-inline"><input type="radio" name="optactive" value="1" checked>Có</label>
                            <label class="radio-inline"><input type="radio" name="optactive" value="0">Không</label>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </fieldset>
        <?php 
        $arr_type=array('mainmenu','html','news','slide');
        if(in_array($viewtype,$arr_type)){ ?>
        <fieldset>
            <legend><strong>Parameter:</strong></legend>
			<?php if($viewtype=="mainmenu"){?>
			<div class="col-md-9">
				<div class="form-group">
					<label class="col-sm-2 control-label">Menu</label>
					<div class="col-sm-6">
						<select name="cbo_menutype" class="form-control" id="cbo_menutype">
							<option value="all">Select once menu</option>
							<?php echo $objmenu->getListmenu("option"); ?>
						</select>
						<span id="menutype_err" class="check_error"></span>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php }else if($viewtype=="news"){?>
			<div class="col-md-9">
				<div class="form-group">
					<label class="col-sm-2 control-label">Nhóm tin</label>
					<div class="col-sm-6">
						<select name="cbo_cate" class="form-control" id="cbo_cate" style="width: 100%;">
							<option value="0">Chọn một nhóm tin</option>
							<?php
							if(!isset($objCate)) $objCate=new CLS_CATEGORY();
							$objCate->getListCate(0,0);
							?>
						</select>
						<script type="text/javascript">
							$(document).ready(function() {
								$("#cbo_cate").select2();
							});
						</script>
						<span id="category_err" class="check_error"></span>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php }else if($viewtype=="html"){?>
			<div class="text-inner">
				<div class="form-group">
					<textarea name="txtcontent" id="txtcontent" class="form-control"></textarea>
					<script language="javascript">
						var oEdit2=new InnovaEditor("oEdit2");
						oEdit2.width="100%";
						oEdit2.height="200";
						oEdit2.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
						oEdit2.REPLACE("txtcontent");
						document.getElementById("idContentoEdit2").style.height="200px";
					</script>
				</div>
			</div>
			<?php } else {};?>
			<div class="clearfix"></div>
			<div class="col-md-9">
				<div class="form-group">
					<label class="col-sm-2 control-label">Giao diện</label>
					<div class="col-sm-6">
						<select name="cbo_theme" class="form-control" id="cbo_theme" style="width: 100%;">
							<option value="">Select once theme</option>
							<?php LoadModBrow("mod_".$viewtype);?>
						</select>
						<script type="text/javascript">
							$(document).ready(function() {
								$("#cbo_theme").select2();
							});
						</script>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
        </fieldset>
        <?php } ?>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
    </form>
	</div>
</div>