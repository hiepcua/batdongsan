<?php
defined("ISHOME") or die("Can not acess this page, please come back!")
?>
<script language="javascript">
    function checkinput(){
        return true;
    }
    $(document).ready(function(){
        $("#txt_username").blur(function(){
            $("#msgbox").removeClass().addClass('messagebox').text('Kiểm tra dữ liệu...').fadeIn("slow");
            $.post("user_availabity.php",{ user_name:$(this).val() } ,function(data){
                if($.trim(data)=='nodata' || $.trim(data)=='') {
                    $("#msgbox").fadeTo(200,0.1,function(){ 
                        /*add message and change the class of the box and start fading*/
                        $(this).html('Vui lòng nhập tên đăng nhập').addClass('messageboxerror').fadeTo(900,1);
                    });
                }
                else if($.trim(data)=='no'){
                    $("#msgbox").fadeTo(200,0.1,function(){ 
                        $(this).html('Tên đăng nhập này đã tồn tại. Vui lòng nhập tên đăng nhập khác').addClass('messageboxerror').fadeTo(900,1);
                    });     
                    document.getElementById("checkuser").value="false";
                }
                else {
                    $("#msgbox").fadeTo(200,0.1,function(){ 
                        $(this).html('Tên đăng nhập có thể sử dụng').addClass('messageboxok').fadeTo(900,1);    
                    });
                    document.getElementById("checkuser").value="true";
                }
            });
        });
    });
</script>
<div id="action">
    <div class="page">
        <div class="page-content">
            <div class='row'>
                <div class="com_header color">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><i class="fa fa-desktop" aria-hidden="true"></i><a href="<?php echo ROOTHOST_ADMIN;?>">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo ROOTHOST_ADMIN.'user';?>">Danh sách bài viết</a></li>
                            <li class="breadcrumb-item active">Thêm mới bài viết</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <h1>Thêm mới người dùng</h1>
            <form id="frm_action" class="form-horizontal" name="frm_action" method="post" action="">
                <div class="form-group">
                    <div class="has-success has-feedback col-md-6">
                        <label>Username<small class="cred"> (*)</small></label>
                        <input type="text" id="txt_username" name="txt_username" class="form-control" value="" placeholder="Tên đăng nhập">
                        <span id="user_success"></span>
                        <small id="er2" class="cred"></small>
                    </div>
                    <div class="col-md-6">
                        <label>Password<small class="cred"> (*)</small></label>
                        <input type="password" id="txt_password" name="txt_password" class="form-control" value="" placeholder="Mật khẩu">
                        <small id="er3" class="cred"></small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Nhóm người dùng<small class="cred"> (*)</small></label>
                        <select name="cbo_gid" id="cbo_gid" class="form-control">
                            <option value="0" style="font-weight:bold; background-color:#cccccc">Chọn nhóm quyền</option>
                            <?php
                            $sql="SELECT * FROM tbl_user_group WHERE `isactive`='1' ";
                            $objmysql = new CLS_MYSQL();
                            $objmysql->Query($sql);
                            if($objmysql->Num_rows()<=0) return;
                            while($rows = $objmysql->Fetch_Assoc()){
                                $id=$rows['id'];
                                $title=$rows['name'];
                                echo "<option value='$id'>$title</option>";
                            }
                            ?>
                        </select>
                        <small id="er4" class="cred"></small>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div class="col-md-6">
                        <label>Họ đệm<small class="cred"> (*)</small></label>
                        <input type="text" id="txt_lastname" name="txt_lastname" class="form-control" value="" placeholder="Họ đệm">
                        <small id="er0" class="cred"></small>
                    </div>
                    <div class="col-md-6">
                        <label>Tên<small class="cred"> (*)</small></label>
                        <input type="text" id="txt_firstname" name="txt_firstname" class="form-control" value="" placeholder="Tên">
                        <small id="er1" class="cred"></small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>CMTND<small class="cred"> (*)</small></label>
                        <input type="text" id="txt_cmtnd" name="txt_cmtnd" class="form-control" value="" placeholder="Chứng minh thư nhân dân">
                        <small id="er7" class="cred"></small>
                    </div>
                    <div class="col-md-6">
                        <label>Ngày sinh</label>
                        <input type="date" id="txt_birthday" name="txt_birthday" class="form-control" value="" placeholder="Ngày sinh">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Giới tính</label>
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" value="0" name="opt_gender" checked="">Nam</label>
                            <label class="radio-inline"><input type="radio" value="1" name="opt_gender">Nữ</label>
                        </div>
                    </div>
                </div>
                <br>

                <label class="title">Thông tin liên hệ</label><hr>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Phone<small class="cred"> (*)</small></label>
                        <input type="number" id="txt_phone" name="txt_phone" class="form-control" value="" placeholder="Số điện thoại">
                        <small id="er5" class="cred"></small>
                    </div>
                    <div class="col-md-6">
                        <label>Email<small class="cred"> (*)</small></label>
                        <input type="email" id="txt_email" name="txt_email" class="form-control" value="" placeholder="Email">
                        <small id="er6" class="cred"></small>
                    </div>
                </div>
                <label>Cơ quan</label>
                <textarea class="form-control" rows="1" id="txt_organ" name="txt_organ" placeholder="Cơ quan công tác"></textarea><br>
                <label>Địa chỉ</label>
                <textarea class="form-control" rows="3" id="txt_address" name="txt_address" placeholder="Địa chỉ của bạn"></textarea>
                <br>
                <div class="clearfix"></div><br>
                <button type="submit" class="btn btn-primary" name="cmd_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
                <button type="submit" class="btn btn-default" name="cmd_cancel"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</button>
            </form>
        </div>
    </div>
</div>