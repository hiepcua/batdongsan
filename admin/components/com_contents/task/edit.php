<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id = isset($_GET['id']) ? (int)$_GET["id"] : 0;

$sql = "SELECT * FROM tbl_contents WHERE id = ".$id;
$objmysql->Query($sql);
$row = $objmysql->Fetch_Assoc();

$sql2 = "SELECT * FROM tbl_categories WHERE id = ".$row['category_id'];
$objmysql->Query($sql2);
$row2 = $objmysql->Fetch_Assoc();

$seo_link   = ROOTHOST.$row2['code'].'/'.$row['code'].'.html';
$sql_seo    = "SELECT * FROM tbl_seo WHERE link = '".$seo_link."'";
$objmysql->Query($sql_seo);
$row_seo    = $objmysql->Fetch_Assoc();
?>
<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            $("#err_name").fadeTo(200,0.1,function(){
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
        <li><a href="<?php echo ROOTHOST_ADMIN.COMS;?>">Danh sách tin đất đai</a></li>
        <li class="active">Cập nhật tin đất đai</li>
    </ol>
</div>

<div class="com_header color">
    <h1>Cập nhật tin đất đai</h1>
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

<div class="box-tabs">
    <ul class="nav nav-tabs" role="tablist">
        <li class="active">
            <a href="#info" role="tab" data-toggle="tab">
                Thông tin
            </a>
        </li>
        <li>
            <a href="#seo" role="tab" data-toggle="tab">
                Meta header
            </a>
        </li>
    </ul><br>

    <form id="frm_action" class="form-horizontal" name="frm_action" method="post" enctype="multipart/form-data">
        <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
        <input type="hidden" name="txt_seo_link" value="<?php echo $seo_link;?>">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="info">
                <div class='form-group'>
                    <div class="col-sm-6 col-md-6">
                        <label>Danh mục đất đai<small class="cred"> (*)</small><span id="err_cate" class="mes-error"></span></label>
                        <select class="form-control" id="cbo_cata" name="cbo_cata" style="width: 100%" required>
                            <option value="">Root</option>
                            <?php $obj_cate->getListCate(0,0); ?>
                        </select>
                        <script type="text/javascript">
                            cbo_Selected('cbo_cata','<?php echo $row['category_id'];?>');
                        </script>
                    </div>
                    
                    <div class="col-sm-6 col-md-6">
                        <label>Tiêu đề<small class="cred"> (*)</small><span id="err_name" class="mes-error"></span></label>
                        <input type="text" name="txt_name" class="form-control" id="txt_name" value="<?php echo $row['title'];?>" placeholder="Tiêu đề bài viết" required>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class='form-group'>
                    <div class="col-sm-6 col-md-6">
                        <label>Loại hình đất đai<small class="cred"> (*)</small><span id="err_type_of_land" class="mes-error"></span></label>
                        <select class="form-control" id="cbo_type_of_land" name="cbo_type_of_land" style="width: 100%" required>
                            <option value="">Root</option>
                            <?php
                            $sql_tol = "SELECT * FROM tbl_type_of_land WHERE isactive = 1";
                            $objmysql->Query($sql_tol);

                            while ($r_tol = $objmysql->Fetch_Assoc()) {
                                echo '<option value="'.$r_tol['id'].'">'.$r_tol['title'].'</option>';
                            }
                            ?>
                        </select>
                        <script type="text/javascript">
                            cbo_Selected('cbo_type_of_land','<?php echo $row['type_of_land_id'];?>');
                        </script>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <label>Ảnh đại diện</label>
                        <div class="row">
                            <div class="col-sm-9 col-md-10">
                                <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'];?>" placeholder='' />
                            </div>
                            <div class="col-sm-3 col-md-2">
                                <a class="btn btn-primary" href="#" onclick="OpenPopup('<?php echo ROOTHOST_ADMIN;?>extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                            </div>
                            <div id="txt_thumb_err" class="mes-error"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="form-group">
                    <div class="col-sm-6 col-md-6">
                        <label>Diện tích (m2)<small class="cred"> (*)</small><span id="err_area" class="mes-error"></span></label>
                        <input type="number" name="txt_area" value="<?php echo $row['area'];?>" class="form-control" id="txt_area" placeholder="Diện tích đất">
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <label>Giá (VNĐ)<small class="cred"> (*)</small><span id="err_price" class="mes-error"></span></label>
                        <input type="number" name="txt_price" value="<?php echo $row['price'];?>" class="form-control" id="txt_price" placeholder="Giá">
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="form-group">
                    <div class="col-sm-6 col-md-6">
                        <label>Tác giả <span class="cred">*</span></label>
                        <input type="text" name="txt_author" value="<?php echo $row['author'];?>" class="form-control" id="txt_author" readonly placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Hiển thị</label>
                    <div class="col-sm-4">
                        <label class="radio-inline"><input type="radio" value="1" name="opt_isactive" <?php if($row['isactive']==1) echo 'checked';?>>Có</label>
                        <label class="radio-inline"><input type="radio" value="0" name="opt_isactive" <?php if($row['isactive']==0) echo 'checked';?>>Không</label>
                    </div>

                    <label class="col-sm-2 control-label">Nổi bật</label>
                    <div class="col-sm-4">
                        <label class="radio-inline"><input type="radio" value="1" name="opt_ishot" <?php if($row['ishot']==1) echo 'checked';?>>Có</label>
                        <label class="radio-inline"><input type="radio" value="0" name="opt_ishot" <?php if($row['ishot']==0) echo 'checked';?>>Không</label>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="control-label col-md-12">Sapo</label>
                    <div class="text_inner">
                        <textarea name="txt_intro" id="txt_intro" class="form-control" rows="5"><?php echo $row['intro'];?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12"> Nội dung</label>
                    <div class="text_inner">
                        <textarea name="txt_fulltext" id="txt_fulltext" class="form-control"><?php echo $row['fulltext'];?></textarea>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="seo">
                <div class="col-xs-12">
                    <div class='form-group'>
                        <label><strong>Meta Title</strong></label>
                        <input name="txt_metatitle" type="text" id="txt_metatitle" class='form-control' value="<?php echo $row_seo['meta_title'];?>" placeholder='' />
                    </div>

                    <div class='form-group'>
                        <label><strong>Meta Keyword</strong></label>
                        <textarea class="form-control" name="txt_metakey" id="txt_metakey" rows="3"><?php echo $row_seo['meta_key'];?></textarea>
                    </div>

                    <div class='form-group'>
                        <label><strong>Meta Description</strong></label>
                        <textarea class="form-control" name="txt_metadesc" id="txt_metadesc" rows="5"><?php echo $row_seo['meta_desc'];?></textarea>
                    </div>
                </div>
            </div>
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
            <div class="text-center toolbar">
                <div style="height: 20px;"></div>
                <a class="save btn btn-success" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu thông tin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        tinymce.init({selector:'#txt_intro'});
        tinymce.init({selector:'#txt_fulltext'});
        
        $("#cbo_cata").select2();
        $("#cbo_type_of_land").select2();
    });
</script>