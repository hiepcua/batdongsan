<?php
$COM='video';
$obj=new CLS_VIDEO();
$viewtype='list';
if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}
if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php')) {
	include('tem/'.$viewtype.'.php'); 
}
unset($viewtype); unset($obj); unset($COM);
?>