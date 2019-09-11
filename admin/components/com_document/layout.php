<?php 
	defined("ISHOME") or die("Can not acess this page, please come back!");
	define("COMS","document");
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	// Begin Toolbar
	require_once('libs/cls.document.php');
	require_once('libs/cls.document_group.php');
	$obj=new CLS_DOCUMENT();
	global $UserLogin;
	$username = $UserLogin->getInfo('username');
	if(isset($_POST["cmdsave"])){
		$obj->G_ID	=(int)$_POST["cbo_group"];
		$obj->Name		=addslashes($_POST["txttitle"]);
		$obj->Code		=un_unicode($obj->Name);
		$obj->Intro		=addslashes($_POST["txtintro"]);
		$obj->Content	=addslashes($_POST['txtdesc']);
		$obj->Author	=$username;
		// url
		if(isset($_POST["txturl"])){
			$file=addslashes($_POST["txturl"]);
			$pathinfo = pathinfo($file); 
			$obj->Url=$pathinfo['basename'];
			$obj->Fullurl=$file;
			$obj->Filetype=$pathinfo['extension'];
		}
		$obj->Filesize=$_POST["filesize"];
		$obj->Cdate = date("Y/m/d H:i:s");
		$obj->Date_issued = date("Y/m/d H:i:s",strtotime($_POST['txtdate_issued']));
		$obj->Mtitle	=addslashes($_POST['txtmetatitle']);
		$obj->Mkey	=addslashes($_POST['txtmetakey']);
		$obj->Mdesc	=addslashes($_POST['textmetadesc']);
        $obj->isHot	    =(int)$_POST["opthot"];
		$obj->IsActive	=(int)$_POST["optactive"];
		if(isset($_POST["txtid"])){
			$obj->ID	=(int)$_POST["txtid"];
			$obj->Mdate	= date("Y/m/d H:i:s");
			$obj->Date_issued =$_POST['txtdate_issued'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
        echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}

	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
		$ids=$_POST["txtids"];
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"]){
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "edit": 	
				$id=explode("','",$ids);
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
				exit();
				break;
			case 'order':
				$sls=explode(',',$_POST['txtorders']); $ids=explode(',',$_POST['txtids']);
				$obj->Orders($ids,$sls); 	break;	
			case "delete": 		$obj->Delete($ids); 		break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	$task='';
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($obj); unset($task);	unset($objlang); unset($ids);
?>