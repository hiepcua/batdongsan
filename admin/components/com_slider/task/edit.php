<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
$id="";
if(isset($_GET["id"]))
    $id=trim($_GET["id"]);
$obj->getList(" WHERE `id`='".$id."'");
$row=$obj->Fetch_Assoc();
?>
<div class="body">
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
	<div class="com_header color">
		<i class="fa fa-pencil-square" aria-hidden="true"></i> Cập nhật slide
		<div class="pull-right">
			<?php require_once("../global/libs/toolbar.php"); ?>
		</div>
    </div><br>
    <form id="frm_action" name="frm_action" class="form-horizontal" method="post" action=""  enctype="multipart/form-data">
        <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="info">
                <div class="col-md-6">
                    <div class='form-group'>
                        <label class="col-sm-2 form-control-label"><strong>Hình ảnh*</strong></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-10">
                                    <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'];?>" placeholder='' />
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
                        <label for="" class="col-sm-2 form-control-label">Slogan</label>
                        <div class="col-sm-10">
                            <input type="text" name="txt_slogan" class="form-control" id="txt_slogan" placeholder="" value="<?php echo $row['slogan'];?>">
                            <div id="txt_slogan_err" class="mes-error"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="text_inner">
                    <label class="control-label">Mô tả</label>
                    <textarea name="txt_intro" id="txt_intro" class="form-control"><?php echo $row['intro'];?></textarea>
                    <script language="javascript">
						var oEdit1=new InnovaEditor("oEdit1");
						oEdit1.width="100%";
						oEdit1.height="200";
						oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
						oEdit1.REPLACE("txt_intro");
						document.getElementById("idContentoEdit1").style.height="200px";
					</script>
                </div>
                <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
            </div>
        </div>
    </form>
</div>