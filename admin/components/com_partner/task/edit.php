<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))  $id=trim($_GET["id"]);
$sql = "SELECT * FROM `tbl_partner` WHERE id=".$id." ORDER BY `name`";
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
                $(this).html('Vui lòng nhập tên đối tác').fadeTo(900,1);
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
        <li><a href="<?php echo ROOTHOST_ADMIN.COMS;?>">Danh sách đối tác</a></li>
        <li class="active">Cập nhật đối tác</li>
    </ol>
</div>

<div class="com_header color">
    <i class="fa fa-list" aria-hidden="true"></i> Cập nhật đối tác
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

<form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
    <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Tên đối tác *</label>
                <div class="col-sm-9">
                    <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="" value="<?php echo stripslashes($row['name']);?>">
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
                            <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="<?php echo stripslashes($row['images']);?>" placeholder='' />
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
                    <input type="text" name="txt_link" class="form-control" id="txt_link" placeholder="" value="<?php echo stripslashes($row['link']);?>">
                    <div id="txt_name_err" class="mes-error"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;"/>
    <div class="text-center toolbar">
        <a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
    </div>
</form>


<script language="javascript">
	function checkinput(){
		if($("#txt_name").val()==""){
			$("#txt_name_err").fadeTo(200,0.1,function(){
				$(this).html('Vui lòng nhập tên nhóm').fadeTo(900,1);
			});
			$("#txt_name").focus();
			return false;
		}
		return true;
	}
</script>
