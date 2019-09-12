<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','mnuitem');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
$mnuid = isset($_GET['mnuid']) ? (int)$_GET['mnuid'] : 0;
define('MNU_ID', $mnuid);

$flag = false;
if(!isset($UserLogin)) $UserLogin = new CLS_USERS();
if($UserLogin->isLogin() == true){
	$flag = true;
}
if($flag == false){
	echo ('<div id="action" style="background-color:#fff"><h4>Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h4></div>');
	return false;
}

// Begin Toolbar
require_once('libs/cls.menuitem.php');
require_once('libs/cls.category.php');
require_once('libs/cls.contents.php');
require_once('libs/cls.menu.php');
$obj_cate = new CLS_CATEGORY();
$obj_con = new CLS_CONTENTS();
$obj_mnu = new CLS_MENU();
$objmysql = new CLS_MYSQL();

if(!isset($_SESSION['ids'])){
	$_SESSION['ids']="";
}
//------------------------------------------------
if(!isset($_SESSION['mnuid'])){
	$_SESSION['mnuid']='';
}
$mnuid='';
if(isset($_GET['mnuid']) && $_GET['mnuid']!='') {
	$_SESSION['mnuid']=(int)$_GET['mnuid'];
}
if($_GET['com']=='menus' && isset($_GET['id'])==true){
	$_SESSION['mnuid']=(int)$_GET['id'];
}
if(isset($_POST['cbo_menutype'])){
	$mnuid=(int)$_POST['cbo_menutype'];
	$_SESSION['mnuid']=$mnuid;
}
$mnuid=$_SESSION['mnuid'];
//----------------------------------------------
$obj=new CLS_MENUITEM();
if(isset($_POST['cmdsave'])){ 
	$obj->Par_ID=(int)$_POST['cbo_parid'];
	$level = $obj->getLevelChild($obj->Par_ID);
	$obj->Name=addslashes($_POST['txtname']);
	$obj->Code=addslashes(un_unicode($_POST['txtname']));
	$obj->Intro=addslashes($_POST['txtdesc']);
	$obj->Mnu_ID=(int)$mnuid; 
	$obj->Viewtype=addslashes($_POST['cbo_viewtype']);

	if($obj->Viewtype=='block'){
		$obj->Cate_ID=(int)$_POST['cbo_cate'];
	}
	else if($obj->Viewtype=='article'){		
		$obj->Con_ID=(int)$_POST['cbo_article'];
	}
	else{
		$obj->Link=addslashes($_POST['txtlink']);
	}
	
	$obj->Icon=addslashes($_POST['txticon']);
	$obj->Class=addslashes($_POST['txtclass']);
	$obj->isActive=(int)$_POST['optactive'];
	if(isset($_POST['txtid'])){
		$obj->ID=(int)$_POST['txtid'];
		$obj->Update();
	}else{
		$obj->Add_new();
	}
	echo '<script language="javascript">window.location="'.ROOTHOST_ADMIN.COMS.'/'.$mnuid.'"</script>';
}

if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=trim($_POST["txtids"]);
	if($ids!='')
		$ids = substr($ids,0,strlen($ids)-1);
	$ids=str_replace(",","','",$ids);
	switch ($_POST["txtaction"]){
		case "public": 
			$sql_active = "UPDATE `tbl_mnuitems` SET `isactive`='1' WHERE `id` in ('$ids')";
			$objmysql->Exec($sql_active);
			break;
		case "unpublic":
			$sql_unactive = "UPDATE `tbl_mnuitems` SET `isactive`='0' WHERE `id` in ('$ids')";
			$objmysql->Exec($sql_unactive);
			break;
		case "delete":
			$sql_del = "DELETE FROM `tbl_mnuitems` WHERE `id` in ('$ids')";
	        $objmysql->Exec($sql_del);
	        break;
		case 'order':
			$sls = explode(',',$_POST['txtorders']); 
			$ids = explode(',',$_POST['txtids']);
			$n = count($ids);
			for($i=0;$i<$n;$i++){
				$sql_order = "UPDATE `tbl_mnuitems` SET `order`='".$sls[$i]."' WHERE `id` = '".$ids[$i]."' ";
				$objmysql->Exec($sql_order);
			}
	}
	echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."'</script>";
}

$task='';
if(isset($_GET['task']))
	$task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($task); unset($ids); unset($obj); unset($objlang);
?>