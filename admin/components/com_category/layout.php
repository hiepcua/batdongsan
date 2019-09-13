<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','category');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');

require_once('libs/cls.category.php');
$objmysql = new CLS_MYSQL();
$obj = new CLS_CATEGORY();

if(isset($_POST['cmdsave'])){
	$Par_Id=addslashes($_POST['cbo_cate']);
	$Name=addslashes($_POST['txt_name']);
	$Code=un_unicode(addslashes($_POST['txt_name']));
	$Intro=addslashes($_POST['txtintro']);
	if(isset($_POST["txtthumb"]))
		$Thumb=addslashes($_POST["txtthumb"]);
	$isActive=1;
	$Type=1;
	if(isset($_POST['txtid'])){
		$ID=(int)$_POST['txtid'];

		$sql = "UPDATE tbl_categories SET 
        `par_id`='".$Par_Id."',
        `name`='".$Name."',
        `code`='".$Code."',
        `thumb`='".$Thumb."',
        `intro`='".$Intro."'
        WHERE id='".$ID."'";
        $objmysql->Exec($sql);
	}else{
		$sql="INSERT INTO `tbl_categories`(`par_id`,`name`,`code`,`thumb`,`intro`,`isactive`) VALUES ('".$Par_Id."','".$Name."','".$Code."','".$Thumb."','".$Intro."','".$isActive."')";
		$objmysql->Exec($sql);
	}
	echo "<script language=\"javascript\">window.location.href='".ROOTHOST_ADMIN.COMS."'</script>";
}

if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=trim($_POST["txtids"]);
	if($ids!='')
		$ids = substr($ids,0,strlen($ids)-1);
	$ids=str_replace(",","','",$ids);
	switch ($_POST["txtaction"]){
		case "public": 
			$sql_active = "UPDATE `tbl_categories` SET `isactive`='1' WHERE `id` in ('$ids')";
			$objmysql->Exec($sql_active);
			break;
		case "unpublic":
			$sql_unactive = "UPDATE `tbl_categories` SET `isactive`='0' WHERE `id` in ('$ids')";
			$objmysql->Exec($sql_unactive);
			break;
		case "delete":
			$sql_del = "DELETE FROM `tbl_categories` WHERE `id` in ('$ids')";
	        $objmysql->Exec($sql_del);
	        break;
		case 'order':
			$sls = explode(',',$_POST['txtorders']); 
			$ids = explode(',',$_POST['txtids']);
			$n = count($ids);
			for($i=0;$i<$n;$i++){
				$sql_order = "UPDATE `tbl_categories` SET `order`='".$sls[$i]."' WHERE `id` = '".$ids[$i]."' ";
				$objmysql->Exec($sql_order);
			}
	}
	echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."'</script>";
}

$task='';
if(isset($_GET['task'])) $task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objlang); unset($ids);
?>