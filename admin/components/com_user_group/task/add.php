<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<style type="text/css">
    .form-horizontal .control-label{text-align: left;}
</style>
<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            $("#txt_name_err").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng nhập tên nhóm người dùng').fadeTo(900,1);
            });
            $("#txt_name").focus();
            return false;
        }
        return true;
    }
</script>
<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li><a href="<?php echo ROOTHOST_ADMIN.COMS;?>">Danh sách nhóm người dùng</a></li>
        <li class="active">Thêm mới nhóm người dùng</li>
    </ol>
</div>

<div class="com_header color">
    <h1>Thêm mới nhóm người dùng</h1>
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
            <label>Tên nhóm<small class="cred"> (*)</small><span id="txt_name_err" class="mes-error"></span></label>
            <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="Tên nhóm người dùng" required>
        </div>
        <div class="col-md-6 col-sm-6">
            <label>Nhóm cha</label>
            <select name="cbo_parent" class="form-control" id="cbo_parent" style="width: 100%;">
                <option value="0" title="Top">Root</option>
                <?php $obj->getOption(0,0); ?>
            </select>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#cbo_parent").select2();
                });
            </script>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <label class="form-control-label">Mô tả</label>
            <textarea name="txtintro" id="txtintro" rows="5"></textarea>
        </div>
    </div>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    <div class="text-center toolbar">
        <a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
    </div>
</form>
