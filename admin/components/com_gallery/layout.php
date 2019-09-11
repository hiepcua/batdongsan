<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','gallery');
define('OBJ','Thư viện ảnh');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
require_once('libs/cls.albumgallery.php');
$obj=new CLS_ALBUMGALLERY();
// End toolbar
if(isset($_POST["cmdsave"])){
	$obj->Name= addslashes(htmlentities($_POST['txt_name']));
	$obj->Thumb= addslashes($_POST['txtthumb']);
	$obj->Intro= addslashes(htmlentities($_POST['txt_intro']));
	$obj->Code= un_unicode($_POST['txt_name']);
	$obj->Cdate= date('Y-m-d H:i:s');
    if(isset($_POST['txtid'])){
		$obj->ID=$_POST['txtid'];
		$obj->Update();
	}else{
        $id=$obj->Add_new();
        if($id!=''){
             echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."/add_gallery/".$id."'</script>";
        }
	}
	echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."'</script>";
}

if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=$_POST["txtids"];
	$ids=str_replace(",","','",$ids);
	switch ($_POST["txtaction"]){
		case "public": 		$obj->setActive($ids,1); 		break;
		case "unpublic": 	$obj->setActive($ids,0); 		break;
		case "edit": 	
			$id=explode("','",$ids);
			echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."/edit/".$id[0]."'</script>";
			exit();
			break;
		case "order"	: include(THIS_COM_PATH."task/order.php"); break;
		case "delete": 		$obj->Delete($ids); 		break;
	}
	echo "<script language=\"javascript\">window.location.href='".ROOTHOST_ADMIN.COMS."'</script>";
}
$task='';
if(isset($_GET['task'])) $task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objlang); unset($ids);
?>