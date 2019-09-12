<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id'])){
	$id=(int)$_GET['id'];
}
$sql = "UPDATE `tbl_mnuitems` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$id')";
$objmysql->Exec($sql);
var_dump(COMS);
// echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS.'/'.MNU_ID."'</script>";
?>