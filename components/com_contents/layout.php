<?php
$COM='contents';
$objmysql = new CLS_MYSQL();
$objdata = new CLS_MYSQL();
$viewtype='';
if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}
if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
	include('tem/'.$viewtype.'.php');
unset($viewtype); unset($obj); unset($COM);
?>
<div class='clearfix'></div>