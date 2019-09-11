<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
$objmysql = new CLS_MYSQL();
$_ID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql="SELECT * FROM `tbl_user` WHERE id=".$_ID;
$objmysql->Query($sql);
$num_row = $objmysql->Num_rows();
$row = $objmysql->Fetch_Assoc();
?>
<div id="path">
    <ol class="breadcrumb">
        <li><a href="<?php echo ROOTHOST_ADMIN;?>">Admin</a></li>
        <li><a href="<?php echo ROOTHOST_ADMIN."user/add";?>">Danh sách người dùng</a></li>
        <li class="active">Sửa thông tin người dùng</li>
    </ol>
</div>
<h1>Sửa thông tin người dùng</h1>
<?php if($num_row >0){ ?>
<form id="frm_action" class="form-horizontal" name="frm_action" method="post" action="">
    <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
    <div class="form-group">
        <div class="has-success has-feedback col-md-6">
            <label>Username<small class="cred"> (*)</small></label>
            <input type="text" id="txt_username" name="txt_username" class="form-control" value="<?php echo $row['username'];?>" placeholder="Tên đăng nhập" readonly>
            <input type="hidden" name="chk_user" id="chk_user" value="0"/>
            <span id="username_result" class="cred"></span>
        </div>
        <div class="col-md-6">
            <label>Nhóm người dùng<small class="cred"> (*)</small></label>
            <select name="cbo_gid" id="cbo_gid" class="form-control" required>
                <option value="0" style="font-weight:bold; background-color:#cccccc">Chọn nhóm quyền</option>
                <?php
                $sql1="SELECT * FROM tbl_user_group WHERE `isactive`='1' ";
                $objmysql->Query($sql1);
                if($objmysql->Num_rows()<=0) return;
                while($rows = $objmysql->Fetch_Assoc()){
                    $id=$rows['id'];
                    $title=$rows['name'];
                    echo "<option value='$id'>$title</option>";
                }
                ?>
                <script language="javascript">
                    cbo_Selected('cbo_gid','<?php echo $row['gid'];?>');
                </script>
            </select>
            <small id="er4" class="cred"></small>
        </div>
    </div>
    <br>

    <div class="form-group">
        <div class="col-md-6">
            <label>Họ đệm<small class="cred"> (*)</small></label>
            <input type="text" id="txt_lastname" name="txt_lastname" class="form-control" value="<?php echo $row['lastname'];?>" placeholder="Họ đệm">
            <small id="er0" class="cred"></small>
        </div>
        <div class="col-md-6">
            <label>Tên<small class="cred"> (*)</small></label>
            <input type="text" id="txt_firstname" name="txt_firstname" class="form-control" value="<?php echo $row['firstname'];?>" placeholder="Tên">
            <small id="er1" class="cred"></small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
            <label>Ngày sinh</label>
            <input type="date" id="txt_birthday" name="txt_birthday" class="form-control" value="<?php echo date('Y-m-d', strtotime($row['birthday']));?>">
        </div>
        <div class="col-md-6">
            <label>Giới tính</label>
            <div class="radio">
                <label class="radio-inline"><input type="radio" value="0" name="opt_gender" <?php if($row['gender'] == '0') echo 'checked';?>>Nam</label>
                <label class="radio-inline"><input type="radio" value="1" name="opt_gender" <?php if($row['gender'] == '1') echo 'checked';?>>Nữ</label>
            </div>
        </div>
    </div>
    <br>

    <label class="title">Thông tin liên hệ</label><hr>
    <div class="form-group">
        <div class="col-md-6">
            <label>Phone<small class="cred"> (*)</small></label>
            <input type="number" id="txt_phone" name="txt_phone" class="form-control" value="<?php echo $row['phone'];?>" placeholder="Số điện thoại">
            <small id="er5" class="cred"></small>
        </div>
        <div class="col-md-6">
            <label>Email<small class="cred"> (*)</small></label>
            <input type="email" id="txt_email" name="txt_email" class="form-control" value="<?php echo $row['email'];?>" placeholder="Email">
            <small id="er6" class="cred"></small>
        </div>
    </div>
    <label>Cơ quan</label>
    <textarea class="form-control" rows="1" id="txt_organ" name="txt_organ" placeholder="Cơ quan công tác"><?php echo $row['organ'];?></textarea><br>
    <label>Địa chỉ</label>
    <textarea class="form-control" rows="3" id="txt_address" name="txt_address" placeholder="Địa chỉ của bạn"><?php echo $row['address'];?></textarea>
    <br>
    <div class="clearfix"></div><br>
    <input type="hidden" name="cmd_save">
    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
    <a href="<?php echo ROOTHOST_ADMIN.'user';?>" class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</a>
</form>
<?php }else{ ?>
    <p>Không tìm thấy thông tin người dùng</p>
<?php } ?>