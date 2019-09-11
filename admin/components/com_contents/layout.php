<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','contents');
define('OBJ','Tin tức');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
require_once('libs/cls.category.php');
require_once('libs/cls.contents.php');
require_once('libs/cls.user.php');
//require_once('libs/cls.tag.php');
$obj_cate=new CLS_CATEGORY();
$obj_user=new CLS_USER();
//$obj_tags=new CLS_TAG();
$obj=new CLS_CONTENTS();

if(isset($_POST["cmdsave"])){	
	$obj->CategoryID=(int)$_POST['cbo_cata'];
	$obj->Title= addslashes(htmlentities($_POST['txt_name']));
	$obj->Code= un_unicode($_POST['txt_name']);
	$obj->Author = $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']['username'];
	$obj->Intro=addslashes(htmlentities($_POST['txt_intro']));
	$obj->Fulltext=	addslashes(htmlentities($_POST['txt_fulltext']));
	$obj->Meta_title=addslashes($_POST['txt_metatitle']);	
	$obj->Meta_key=addslashes($_POST['txt_metakey']);	
	$obj->Meta_desc=addslashes($_POST['txt_metadesc']);
	//$obj->Tags=str_replace(',',"','",$_POST["txt_tags"]);
	$obj->isActive=(int)$_POST['opt_isactive'];
	$date=date('Y-m-d H:i:s');
	if(isset($_POST["txtthumb"]))
		$obj->Thumb=addslashes($_POST["txtthumb"]);

	if(isset($_POST['txtid'])){
		$obj->Mdate=$date;
		$obj->ID=$_POST['txtid'];
		$obj->Update();
	}else{
		$obj->Cdate=$date;
		$obj->addNew();
	}
	echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."'</script>";
}

if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=$_POST["txtids"];
	$ids=str_replace(",","','",$ids);
	switch ($_POST["txtaction"]){
		case "public": 		$obj->setActive($ids,1); 		break;
		case "unpublic": 	$obj->setActive($ids,0); 		break;
		case "delete": 		$obj->Delete($ids); 		break;
		case "edit": 	
		$id=explode("','",$ids);
		echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."/edit/id=".$id[0]."'</script>";
		break;
		case 'order':
		$sls=explode(',',$_POST['txtorders']); $ids=explode(',',$_POST['txtids']);
		$obj->Order($ids,$sls); 	break;
	}
	echo "<script language=\"javascript\">window.location.href='".ROOTHOST_ADMIN.COMS."'</script>";
}


$task=$group_name='';
if(isset($_GET['task'])) $task=$_GET['task'];


$id=isset($_GET['cate'])?(int)$_GET['cate']:0;
if($id==0){
	if(isset($_SESSION['CONTENT_ID_SELECTED']) && $task!='')
		$id=(int)$_SESSION['CONTENT_ID_SELECTED'];
	else unset($_SESSION['CONTENT_ID_SELECTED']);
}else $_SESSION['CONTENT_ID_SELECTED']=$id;
?>
<div class="body">
	<div class='col-md-12 body_col_right'>
		<div id="list_content">
			<?php 
			if($task!='' && is_file(THIS_COM_PATH.'task/'.$task.'.php'))
				include_once(THIS_COM_PATH.'task/'.$task.'.php');
			else if($id==0) include_once(THIS_COM_PATH.'task/list.php');
			?>
		</div>
	</div>
</div>