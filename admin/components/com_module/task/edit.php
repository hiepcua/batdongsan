<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id'])) $id=(int)$_GET['id'];

$sql = "SELECT * FROM `tbl_modules` WHERE id = ".$id;
$objmysql->Query($sql);
$row = $objmysql->Fetch_Assoc();
$viewtype = $row['type'];
if(isset($_POST["txt_type"])){
    $viewtype = addslashes($_POST["txt_type"]);
}
?>

<script language="javascript">
    function checkinput(){
        if($('#txttitle').val()=="") {
            $("#err2").fadeTo(200,0.1,function(){ 
                $(this).html('Mời bạn nhập tiêu đề Module').fadeTo(900,1);
            });
            $('#txttitle').focus();
            return false;
        }
        if( $('#cbo_type').val()=="mainmenu") {
            if($('#cbo_menutype').val()=="") {
                $("#err3").fadeTo(200,0.1,function(){ 
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
                $("#err2").fadeTo(200,0.1,function(){ 
                    $(this).html('Mời bạn nhập tiêu đề Module').fadeTo(900,1);
                });
            }
        })
    });
</script>

<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li><a href="<?php echo ROOTHOST_ADMIN.COMS;?>">Danh sách module</a></li>
        <li class="active">Cập nhật module</li>
    </ol>
</div>

<div class="com_header color">
    <i class="fa fa-pencil-square" aria-hidden="true"></i> Cập nhật Module
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

<form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
    <label>
        <input type="text" name="txt_type" id="txt_type" />
    </label>
</form>

<form id="frm_action" class="form-horizontal" name="frm_action" method="post" action="">
    <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['id'];?>" />
    <fieldset>
        <legend><strong>Chi tiết:</strong></legend>
        <p>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</p>

        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <label>Kiểu hiển thị<small class="cred"> (*)</small><span id="err1" class="mes-error"></span></label>
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
            <div class="col-md-6 col-sm-6">
                <label>Tiêu đề<small class="cred"> (*)</small><span id="err2" class="mes-error"></span></label>
                <input name="txttitle" type="text" id="txttitle" class="form-control" value="<?php echo stripslashes($row['title']);?>">
            </div>
            <div class="clearfix"></div>
        </div>
            
		<?php $arr_type=array('html','news');
		if(in_array($viewtype,$arr_type)){ ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <label>Mô tả</label>
                    <textarea name="txtintro" class="form-control" rows="5"><?php echo stripslashes($row['intro']);?></textarea>
                </div>
            </div>
		<?php } ?>

        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <label>Vị trí</label>
                <select name="cbo_position" class="form-control" id="cbo_position" style="width: 100%;">
                    <?php LoadPosition();?>
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#cbo_position").select2();
                        cbo_Selected('cbo_position','<?php echo $row['position'];?>');
                    });
                </script>
            </div>
            <div class="col-md-6 col-sm-6">
                <label>Class</label>
                <input type="text" name="txtclass" id="txtclass" class="form-control" value="<?php echo $row['class'];?>" />
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <label>Hiển thị tiêu đề</label>
                <div>
                    <label class="radio-inline"><input type="radio" name="optviewtitle" value="1" <?php if($row['viewtitle']==1) echo "checked";?>>Có</label>
                    <label class="radio-inline"><input type="radio" name="optviewtitle" value="0" <?php if($row['viewtitle']==0) echo "checked";?>>Không</label>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <label>Hiển thị</label>
                <div>
                    <label class="radio-inline"><input type="radio" name="optactive" value="1" <?php if($row['isactive']==1) echo "checked";?>>Có</label>
                    <label class="radio-inline"><input type="radio" name="optactive" value="0" <?php if($row['isactive']==0) echo "checked";?>>Không</label>
                </div>
            </div>
        </div>
    </fieldset>

    <?php 
    $arr_type = array('mainmenu','html','news','slide', 'partner', 'content');
    if(in_array($viewtype,$arr_type)){ ?>
    <fieldset>
        <legend><strong><?php echo "Parameter";?>:</strong></legend>
        <?php if($viewtype == "mainmenu"){ ?>
            <div class="form-group">
                <div class="col-md-6 col-sm-6">
                    <label>Menu<small class="cred"> (*)</small><span id="err3" class="mes-error"></span></label>
                    <select name="cbo_menutype" class="form-control" id="cbo_menutype">
                        <option value="all">Chọn một kiểu menu</option>
                        <?php echo $objmenu->getListmenu("option"); ?>
                        <script language="javascript">
                            cbo_Selected('cbo_menutype','<?php echo $row['menu_id'];?>');
                        </script>
                    </select>

                    <span id="menutype_err" class="check_error"></span>
                </div>
            </div>

        <?php }else if($viewtype=="news"){ ?>
            <div class="form-group">
                <div class="col-md-6 col-sm-6">
                    <label>Nhóm tin</label>
                    <select name="cbo_cate" class="form-control" id="cbo_cate" style="width: 100%;">
                        <option value="0">Chọn một nhóm tin</option>
                        <?php
                        if(!isset($objCate)) $objCate = new CLS_CATEGORY();
                        $objCate->getListCate(0,0);
                        ?>
                    </select>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            cbo_Selected('cbo_cate','<?php echo $row['category_id'];?>');
                            $("#cbo_cate").select2();
                            
                        });
                    </script>
                </div>
            </div>

        <?php }else if($viewtype=="content"){ ?>
            <div class="form-group">
                <div class="col-md-6 col-sm-6">
                    <label>Bài tin</label>
                    <select name="cbo_content" class="form-control" id="cbo_content" style="width: 100%;">
                        <option value="0">Chọn một bài tin</option>
                        <?php
                        $sql_con = "SELECT * FROM tbl_contents WHERE isactive = 1";
                        $objmysql->Query($sql_con);

                        while ($r = $objmysql->Fetch_Assoc()) {
                            if($r['id'] == $row['content_id']){
                                echo '<option value="'.$r['id'].'" selected>'.$r['title'].'</option>';
                            }else{
                                echo '<option value="'.$r['id'].'">'.$r['title'].'</option>';
                            }
                        }
                        ?>
                    </select>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#cbo_content").select2();
                        });
                    </script>
                </div>
            </div>

        <?php }else if($viewtype=="html"){?>
            <div class="form-group">
                <div class="col-xs-12">
                    <textarea name="txtcontent" id="txtcontent" class="form-control"><?php echo stripslashes($row['content']);?></textarea>
                </div>
            </div>
        
        <?php } ?>
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <label>Giao diện</label>
                <select name="cbo_theme" class="form-control" id="cbo_theme" style="width: 100%;">
                    <option value="">Chọn một giao diện</option>
                    <?php LoadModBrow("mod_".$viewtype);?>
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        cbo_Selected('cbo_theme','<?php echo $row['theme'];?>');
                        $("#cbo_theme").select2();
                    });
                </script>
            </div>
        </div>
    </fieldset>
    <?php }?>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
    <div class="text-center toolbar">
        <div style="height: 20px;"></div>
        <a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
    </div>
</form>