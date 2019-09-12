<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
$id="";
if(isset($_GET["id"])) $id=trim($_GET["id"]);
$sql = "SELECT * FROM `tbl_slider` WHERE id=".$id." ORDER BY `slogan`";
$objmysql->Query($sql);
$row = $objmysql->Fetch_Assoc();
?>

<script language="javascript">
    function checkinput(){
        if($("#txtthumb").val()==""){
            $("#txt_thumb_err").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng chọn hình ảnh').fadeTo(900,1);
            });
            $("#txtthumb").focus();
            return false;
        }
        return true;
    }
</script>

<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li><a href="<?php echo ROOTHOST_ADMIN.COMS;?>">Danh sách banner</a></li>
        <li class="active">Sửa thông tin banner</li>
    </ol>
</div>

<div class="com_header color">
    <h1>Sửa thông tin banner</h1>
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

<form id="frm_action" name="frm_action" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
    <div class="col-md-6">
        <div class='form-group'>
            <label class="col-sm-2 form-control-label"><strong>Hình ảnh*</strong></label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-10">
                        <input id="txtthumb" name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'];?>" placeholder='' />
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-primary" href="#" onclick="OpenPopup('<?php echo ROOTHOST_ADMIN;?>extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                    </div>
                    <div id="txt_thumb_err" class="mes-error"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 form-control-label">link</label>
            <div class="col-sm-10">
                <input type="text" name="txt_link" class="form-control" id="txt_link" placeholder="" value="<?php echo $row['link'];?>">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 form-control-label">Slogan</label>
            <div class="col-sm-10">
                <input type="text" name="txt_slogan" class="form-control" id="txt_slogan" value="<?php echo $row['slogan'];?>">
                <div id="txt_slogan_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="text_inner">
        <label class="control-label">Mô tả</label>
        <textarea name="txt_intro" id="txt_intro" class="form-control"><?php echo $row['intro'];?></textarea>
    </div>
    <div class="clearfix"></div>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    <div class="text-center toolbar" style="margin-top: 30px;">
        <a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
    </div>
</form>