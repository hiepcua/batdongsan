<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','video');
define('OBJ','Video');
require_once('libs/cls.video.php');
$title_manager="Danh sách ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='add')
    $title_manager = "Thêm mới ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='edit')
    $title_manager = "Sửa ".OBJ;
?>
<?php
	$obj=new CLS_VIDEO();
	if(isset($_POST['cmdsave'])){
		$obj->Name=addslashes(htmlentities($_POST['txt_name']));
		$obj->Code=un_unicode($_POST['txt_name']);
		$obj->isActive=1;
		$obj->Link=addslashes($_POST['txt_link']);
		$video_id = explode("?v=",$obj->Link);
		$obj->VideoID=$video_id[1];
		$obj->Thumb=addslashes($_POST['txtthumb']);
		$obj->Intro=addslashes(htmlentities($_POST['txt_intro']));
		$obj->Content=addslashes(htmlentities($_POST['txt_content']));
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location.href='".ROOTHOST_ADMIN.COMS."'</script>";
	}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"]){
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "delete": 		$obj->Delete($ids); 			break;
			case 'order':
			$sls=explode(',',$_POST['txtorders']); $ids=explode(',',$_POST['txtids']);
			$obj->Order($ids,$sls); 	break;
		}
		echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."'</script>";
	}
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	$task = '';
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($task); unset($ids); unset($obj); unset($objlang);
?>