<?php
$objmysql = new CLS_MYSQL();
$sql="SELECT * FROM tbl_personnel WHERE isactive=1 ORDER BY `order` ASC LIMIT 0,6";
$objmysql->Query($sql);
?>
<h3>ĐỘI NGŨ NHÂN SỰ <span class="i-color">THC</span></h3>
<div class="line-bottom"><img src="<?= ROOTHOST ?>images/hinh-anh/icon-1.png"/></div>
<div class="section-intro">Chúng tôi hiểu bạn đang cần gì và tự tin sẽ phục vụ Quý khách tốt nhất</div>
<div id="owl6" class="owl-carousel owl-theme">
    <?php
    while($row = $objmysql->Fetch_Assoc())
    {
        $name = stripcslashes($row['name']);
        $position = stripcslashes($row['position']);
        $avatar = stripcslashes($row['avatar']);
        ?>
        <div class="item">
            <div class="thumb"><img src="<?= $avatar ?>" class="img-responsive"></div>
            <div class="content">
                <p class="name"><?= $name ?></p>
                <div class="position"><?= $position ?></div>
            </div>
        </div>
        <?php
    }
    ?>
</div>