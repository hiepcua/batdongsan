<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))  $id=trim($_GET["id"]);
$sql = "SELECT * FROM `tbl_categories` WHERE id=".$id." ORDER BY `name`";
$objmysql->Query($sql);
$row = $objmysql->Fetch_Assoc();
?>
<style type="text/css">
    .form-horizontal .control-label{text-align: left;}
</style>
<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            $("#txt_name_err").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
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
        <li><a href="<?php echo ROOTHOST_ADMIN.'category';?>">Danh sách nhóm tin</a></li>
        <li class="active">Sửa nhóm bài viết</li>
    </ol>
</div>

<div class="com_header color">
    <h1>Sửa nhóm bài viết</h1>
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
    <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
    <div class="form-group">
        <div class="col-md-6 col-sm-6">
            <label>Tên nhóm<small class="cred"> (*)</small><span id="txt_name_err" class="mes-error"></span></label>
            <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="Tên nhóm tin" value="<?php echo $row['name'];?>" required>
        </div>
        <div class="col-md-6 col-sm-6">
            <label>Nhóm cha</label>
            <select name="cbo_cate" class="form-control" id="cbo_cate" style="width: 100%;">
                <option value="0" title="Top">Root</option>
                <?php $obj->getListCate(0,0); ?>
            </select>
            <script type="text/javascript">
                $(document).ready(function() {
                    cbo_Selected('cbo_cate','<?php echo $row['par_id'];?>');
                    $("#cbo_cate").select2();
                });
            </script>
        </div>
    </div>
    <div class='form-group'>
        <div class="col-md-6 col-sm-6">
            <label>Ảnh đại diện</label>
            <div class="row">
                <div class="col-sm-9 col-md-10">
                    <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'];?>" placeholder='' />
                </div>
                <div class="col-sm-3 col-md-2">
                    <a class="btn btn-success" href="#" onclick="OpenPopup('<?php echo ROOTHOST_ADMIN;?>extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                </div>
                <div id="txt_thumb_err" class="mes-error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <label class="form-control-label">Mô tả</label>
            <textarea name="txtintro" id="txtintro" rows="5"><?php echo $row['intro'];?></textarea>
        </div>
    </div>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    <div class="text-center toolbar">
        <div style="height: 20px;"></div>
        <a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
    </div>
</form>