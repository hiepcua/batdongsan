<?php
defined("ISHOME") or die("Can not acess this page, please come back!")
?>
<script language="javascript">
    function checkinput(){
            if($('#chk_user').val()=="0") {
                alert("Tên đăng nhập đã có trong hệ thống. Vui lòng nhập tên khác");
                $('#username_result').html('Tên đăng nhập không hợp lệ.');
                return false;
            }
            return true;
        }
        $(document).ready(function(){
            $('#frm_action').submit(function(){
                return checkinput();
            });

            $("#txt_username").blur(function() {
                var username = $('#txt_username').val();
                $.post("<?php echo ROOTHOST_ADMIN;?>"+"ajaxs/user/getuser.php", {username: username },function(result){
                    if(result=='0'){
                        $('#username_result').html('<img src="<?php echo ROOTHOST_ADMIN;?>images/icon_true.png" width="20" align="middle"/> Tên có thể sử dụng');  
                        $('#chk_user').val('1');
                        return true;
                    }else{
                        $('#username_result').html('<img src="<?php echo ROOTHOST_ADMIN;?>images/icon_false.png" width="20" align="middle"/> Tên đã tồn tại. Vui lòng nhập tên khác');  
                        $('#chk_user').val('0');
                        return false;
                    }  
                });  
            })
        });
</script>

<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li><a href="<?php echo ROOTHOST_ADMIN."user";?>">Danh sách người dùng</a></li>
        <li class="active">Thêm mới người dùng</li>
    </ol>
</div>
<h1>Thêm mới người dùng</h1>
<form id="frm_action" class="form-horizontal" name="frm_action" method="post" action="">
    <div class="form-group">
        <div class="has-success has-feedback col-md-6">
            <label>Username<small class="cred"> (*)</small></label>
            <input type="text" id="txt_username" name="txt_username" class="form-control" value="" placeholder="Tên đăng nhập">
            <input type="hidden" name="chk_user" id="chk_user" value="0"/>
            <span id="username_result" class="cred"></span>
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
            <select name="cbo_gid" id="cbo_gid" class="form-control" required>
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
            <label>Ngày sinh</label>
            <input type="date" id="txt_birthday" name="txt_birthday" class="form-control" value="" placeholder="Ngày sinh">
        </div>
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
    <input type="hidden" name="cmd_save">
    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
    <a href="<?php echo ROOTHOST_ADMIN.'user';?>" class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</a>
</form>
