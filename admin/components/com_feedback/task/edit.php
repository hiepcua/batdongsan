<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
    $id = trim($_GET["id"]);

$sql = "SELECT * FROM tbl_feedback WHERE id = ".$id;
$objmysql->Query($sql);
$row = $objmysql->Fetch_Assoc();
?>

<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            $("#txt_name_err").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng nhập tên nhóm tin').fadeTo(900,1);
            });
            $("#txt_name").focus();
            return false;
        }

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
        <li><a href="<?php echo ROOTHOST_ADMIN.COMS;?>">Danh sách cảm nhận</a></li>
        <li class="active">Cập nhật cảm nhận khách hàng</li>
    </ol>
</div>

<div class="com_header color">
    <h1>Cập nhật cảm nhận khách hàng</h1>
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
    <div class="tab-content">
        <div class="tab-pane fade active in" id="info">
            <div class="form-group">
                <div class="col-md-6">
                    <label>Tên khách hàng<small class="cred"> (*)</small><span id="txt_name_err" class="mes-error"></span></label>
                    <input type="text" name="txt_name" class="form-control" placeholder="Tên khách hàng" value="<?php echo $row['name'];?>" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <label>Avatar<small class="cred"> (*)</small><span id="txt_thumb_err" class="mes-error"></span></label>
                    <div class="row">
                        <div class="col-sm-10">
                            <input name="txtthumb" type="text" id="file-thumb" class='form-control' value="<?php echo $row['avatar'];?>" placeholder='Avatar' />
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-primary" href="#" onclick="OpenPopup('<?php echo ROOTHOST_ADMIN;?>extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <label>Chức vụ</label>
                    <input type="text" name="txt_career" class="form-control" id="txt_career" placeholder="Chức vụ" value="<?= $row['career'];?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label>Comment</label>
                    <textarea class="form-control" name="txt_comment" placeholder="Nội dung comment"><?= $row['comment'];?></textarea>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        <div class="text-center toolbar">
            <div style="height: 20px;"></div>
            <a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
        </div>
    </div>
</form>
