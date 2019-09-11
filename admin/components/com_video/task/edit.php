<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
    $id=trim($_GET["id"]);
$obj->getList(" WHERE `id`='".$id."'");
$row=$obj->Fetch_Assoc();
$title=stripslashes($row['name']);
$intro=stripslashes($row['intro']);
$content=stripslashes($row['content']);
$url=$row['link'];
$thumb=$row['thumb'];
?>
<div id="action">
	<div class="com_header color">
		<i class="fa fa-list" aria-hidden="true"></i> Cập nhật Video
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
	</div><br>
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <div class="tab-content">
				<div class='form-group'>
					<label class="col-sm-2 control-label"><strong>Link Video</strong></label>
					<div class="col-sm-6">
						<input name="txt_link" type="text" id="txt_link" size="45" class='form-control' value="<?php echo $url;?>" placeholder='Url video from youtube.com' />
						<div id="txt_link_err" class="mes-error"></div>
						<span class="msg-notic " id="msg_link"></span>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-primary" id="btn-video">Check Video</button>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class='form-group'>
					<label class="col-sm-2"></label>
					<div class="col-sm-8">
						<p>Lưu ý: Sau khi pase link video từ youtube, cần "Check video" để kiểm tra video trả về từ Youtube là chính xác hay không</p>
					</div><div class="clearfix"></div>
				</div>
				<div class='form-group'>
					<label class="col-sm-2"></label>
					<div class="col-sm-8">
						<div class="respon" id="respon-video"></div>
						<div class="respon" id="respon-info"></div>
					</div><div class="clearfix"></div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 form-control-label">Tên Video</label>
					<div class="col-sm-6">
						<input type="hidden" name="txtid" id="txtid" value="<?php echo $id;?>">
						<input type="text" name="txt_name" class="form-control" id="txt_name" value="<?php echo $title;?>">
						<div id="txt_name_err" class="mes-error"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class='form-group'>
                    <label class="col-sm-2 control-label">Ảnh đại diện</label>
                    <div class="col-sm-6">
                        <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="<?php echo $thumb;?>" placeholder='' />
                    </div>
                    <div class="col-sm-3">
                        <a class="btn btn-primary" href="#" onclick="OpenPopup('<?php echo ROOTHOST_ADMIN;?>extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                    </div>
					<div id="txt_thumb_err" class="mes-error"></div>
                    <div class="clearfix"></div>
                </div>
				<div class="form-group">
					<label for="" class="col-sm-2 form-control-label">Tóm tắt</label>
					<div class="col-sm-10">
						<textarea name="txt_intro" class="form-control" id="txt_intro" rows="3"><?php echo $intro;?></textarea>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
					<label for="" class="col-sm-2 form-control-label">Nội dung</label>
					<div class="col-sm-10">
						<textarea name="txt_content" class="form-control" id="txt_content"><?php echo $content;?></textarea>
						<script language="javascript">
						var oEdit2=new InnovaEditor("oEdit2");
						oEdit2.width="100%";
						oEdit2.height="200";
						oEdit2.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
						oEdit2.REPLACE("txt_content");
						document.getElementById("idContentoEdit2").style.height="200px";
					</script>
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
				$(this).html('Vui lòng nhập tên video').fadeTo(900,1);
			});
			$("#txt_name").focus();
			return false;
		}
		if($("#txt_link").val()==""){
			$("#txt_link_err").fadeTo(200,0.1,function(){
				$(this).html('Vui lòng nhập Url video').fadeTo(900,1);
			});
			$("#txt_link").focus();
			return false;
		}
		return true;
	}
    $('document').ready(function(){
        var url='<?php echo $url;?>';
        getVideo(url);
        var mes='';
        return false;
    })
    $('#btn-video').click(function(){
        var url=$('#txt_link').val();
        var formatStrUrlYoutube = url.toLowerCase().indexOf("youtube");
        if (url!="" && formatStrUrlYoutube >= 0){
            getVideo(url);
        } else {
            mes='Vui lòng nhập đường dẫn chính xác';
            $('#msg_link').html(mes);
            return false;
        }
        return false;
    })
	function getVideo(url) {
		var formatStrUrlYoutube = url.toLowerCase().indexOf("youtube");
        var videoId = url.substring(url.indexOf("?v=") + 3);
        $.post('<?php echo ROOTHOST;?>ajaxs/get_info_video.php',{videoId, url},function(response_data){
			//console.log(response_data);	
			var json = JSON.parse(response_data);		
			var info = "<div class='name'>Tên Video: "+json.title+"</div>";
			info += "<div class='img_src'>Ảnh Video: "+json.thumbnail_url+"</div>";
			$('#respon-video').html(json.html);
            $('#respon-video').toggleClass('show');
			$('#respon-info').html(info);
            $('#respon-info').toggleClass('show');
            $('#msg_link').html('');
            $('#txt_link_err').html('');
        });
	}
</script>