<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div class="body">
	<div class='col-md-12 body_col_right'>
        <div class='row'>
            <div class="com_header color">
                <i class="fa fa-list" aria-hidden="true"></i> Thêm mới đối tác
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
        </div><br>
	</div>
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <div class="tab-content">
                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Tên đối tác*</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="">
                                    <div id="txt_name_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>


                        <div class="col-md-8">
                            <div class='form-group'>
                                <label class="col-sm-3 control-label">Hình ảnh*</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
                                        </div>
                                        <div class="col-sm-3">
                                            <a class="btn btn-success" href="#" onclick="OpenPopup('<?php echo ROOTHOST_ADMIN;?>extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                                        </div>
                                        <div id="txt_thumb_err" class="mes-error"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                            <div class="clearfix"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Link</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_link" class="form-control" id="txt_link" placeholder="">
                                    <div id="txt_name_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
</div>
<script>
function checkinput(){
	if($("#txt_name").val()==""){
		$("#txt_name_err").fadeTo(200,0.1,function(){
			$(this).html('Vui lòng nhập tên nhóm').fadeTo(900,1);
		});
		$("#txt_name").focus();
		return false;
	}
	return true;
}</script>
