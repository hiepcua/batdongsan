<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            $("#err_name").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng nhập tiêu đề').fadeTo(900,1);
            });
            return false;
        }

        if($("#txt_link").val()==""){
            $("#err_link").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng nhập liên kết').fadeTo(900,1);
            });
            return false;
        }
        return true;
    }
</script>

<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li><a href="<?php echo ROOTHOST_ADMIN.COMS;?>">Danh sách Meta SEO</a></li>
        <li class="active">Thêm mới Meta SEO</li>
    </ol>
</div>

<div class="com_header color">
    <h1>Thêm mới Meta SEO</h1>
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

<form id="frm_action" class="form-horizontal" name="frm_action" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-md-6 col-sm-6">
            <label>Tiêu đề<small class="cred"> (*)</small><span id="err_name" class="mes-error"></span></label>
            <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="Tên Meta SEO" required>
        </div>

        <div class="col-md-6 col-sm-6">
            <label>Link<small class="cred"> (*)</small><span id="err_link" class="mes-error"></span></label>
            <input type="text" name="txt_link" class="form-control" id="txt_link" placeholder="link" required>
        </div>
    </div>
    <div class='form-group'>
        <div class="col-md-6 col-sm-6">
            <label>Hình ảnh</label>
            <div class="row">
                <div class="col-sm-9 col-md-10">
                    <input name="txtthumb" type="text" id="file-thumb" class='form-control' value="" placeholder='' />
                </div>
                <div class="col-sm-3 col-md-2">
                    <a class="btn btn-success" href="#" onclick="OpenPopup('<?php echo ROOTHOST_ADMIN;?>extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                </div>
                <div id="txt_thumb_err" class="mes-error"></div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class='form-group'>
            <label><strong>Meta Title</strong></label>
            <input name="txt_metatitle" type="text" id="txt_metatitle" class='form-control' value="" placeholder='' />
        </div>

        <div class='form-group'>
            <label><strong>Meta Keyword</strong></label>
            <textarea class="form-control" name="txt_metakey" id="txt_metakey" rows="3"></textarea>
        </div>

        <div class='form-group'>
            <label><strong>Meta Description</strong></label>
            <textarea class="form-control" name="txt_metadesc" id="txt_metadesc" rows="5"></textarea>
        </div>
    </div>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    <div class="text-center toolbar">
        <div style="height: 20px;"></div>
        <a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
    </div>
</form>
