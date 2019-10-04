<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','contents');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');

require_once('libs/cls.category.php');
$obj_cate 	= new CLS_CATEGORY();
$objmysql 	= new CLS_MYSQL();

if(isset($_POST["cmdsave"])){
	$obj_images = array();
	$txt_images = isset($_POST['txt_images']) ? addslashes($_POST['txt_images']) : '';
	
	if($txt_images !== ''){
		foreach ($_POST['txt_images'] as $k => $val) {
			$tmp = (object)array();
			$tmp->url = $val;
			$tmp->alt = $_POST['txt_alt'][$k];
			array_push($obj_images, $tmp);
		}
	}

	$CategoryID 	= isset($_POST['cbo_cata']) ? (int)$_POST['cbo_cata'] : 0;
	$Type_of_land 	= isset($_POST['cbo_type_of_land']) ? (int)$_POST['cbo_type_of_land'] : 0;
	$isActive 		= isset($_POST['opt_isactive']) ? (int)$_POST['opt_isactive'] : 0;
	$isHot 			= isset($_POST['opt_ishot']) ? (int)$_POST['opt_ishot'] : 0;
	$Price 			= isset($_POST['txt_price']) ? (int)$_POST['txt_price'] : 0;
	$Area 			= isset($_POST['txt_area']) ? (int)$_POST['txt_area'] : 0;

	$Title 			= isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$Code 			= un_unicode($_POST['txt_name']);
	$Author 		= $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']['username'];
	$Sapo 			= isset($_POST['txt_sapo']) ? addslashes(htmlentities($_POST['txt_sapo'])) : '';
	$Intro 			= isset($_POST['txt_intro']) ? addslashes($_POST['txt_intro']) : '';
	$Fulltext 		= isset($_POST['txt_fulltext']) ? addslashes($_POST['txt_fulltext']) : '';
	$Thumb 			= isset($_POST['txtthumb']) ? addslashes($_POST['txtthumb']) : '';
	$Images 		= json_encode($obj_images);
	$Images = mysql_real_escape_string($Images );
	$date 			= time();

	$Meta_title 	= isset($_POST['txt_metatitle']) ? addslashes(htmlentities($_POST['txt_metatitle'])) : '';
	$Meta_key 		= isset($_POST['txt_metakey']) ? addslashes(htmlentities($_POST['txt_metakey'])) : '';
	$Meta_desc 		= isset($_POST['txt_metadesc']) ? addslashes(htmlentities($_POST['txt_metadesc'])) : '';
	$seo_link 		= isset($_POST['txt_seo_link']) ? $_POST['txt_seo_link'] : '';

	$sql_cate 		= "SELECT * FROM tbl_categories WHERE id = ".$CategoryID;
	$objmysql->Query($sql_cate);
	$r_cate 		= $objmysql->Fetch_Assoc();
	$Link 			= ROOTHOST.$r_cate['code'].'/'.$Code.'.html';

	if(isset($_POST['txtid'])){
		$Mdate = $date;
		$ID = $_POST['txtid'];

		$objmysql->Query("BEGIN");
		$sql = "UPDATE tbl_contents SET 
		`category_id` = '".$CategoryID."', 
		`code` 		= '".$Code."',
		`thumb` 	= '".$Thumb."',
		`images` 	= '".$Images."',
		`mdate` 	= '".$Mdate."',
		`author` 	= '".$Author."',
		`ishot` 	= '".$isHot."',
		`isactive` 	= '".$isActive."',
		`title` 	= '".$Title."',
		`intro` 	= '".$Intro."',
		`sapo` 		= '".$Sapo."',
		`fulltext` 	= '".$Fulltext."',
		`type_of_land_id` = '".$Type_of_land."',
		`area` 		= '".$Area."',
		`price` 	= '".$Price."'
		WHERE `id` 	= '".$ID."'";
		$result = $objmysql->Exec($sql);

		$sql2 = "UPDATE tbl_seo SET 
		`title` = '".$Title."', 
		`link` = '".$Link."',
		`image` = '".$Thumb."',
		`meta_title` = '".$Meta_title."',
		`meta_key` = '".$Meta_key."',
		`meta_desc` = '".$Meta_desc."'
		WHERE `link` = '".$seo_link."'";
		$result2 = $objmysql->Exec($sql2);

		if($result && $result2){
			$objmysql->Exec('COMMIT');
		}
		else
			$objmysql->Exec('ROLLBACK');
	}else{
		$Cdate = $date;

		$objmysql->Exec("BEGIN");
		$sql = "INSERT INTO tbl_contents (`category_id`,`code`,`thumb`,`images`,`cdate`,`author`,`ishot`,`isactive`,`title`,`sapo`,`intro`,`fulltext`,`type_of_land_id`,`area`,`price`) VALUES ('".$CategoryID."','".$Code."','".$Thumb."','$Images','".$Cdate."','".$Author."','".$isHot."','".$isActive."','".$Title."','".$Sapo."', '".$Intro."', '".$Fulltext."','".$Type_of_land."','".$Area."', '".$Price."')";
		$result = $objmysql->Exec($sql);

		$sql2 = "INSERT INTO tbl_seo (`title`,`link`,`image`,`meta_title`,`meta_key`,`meta_desc`) VALUES ('".$Title."','".$Link."','".$Thumb."','".$Meta_title."','".$Meta_key."','".$Meta_desc."')";
		$result2 = $objmysql->Exec($sql2);

		if($result && $result2){
			$objmysql->Exec('COMMIT');
		}else{
			$objmysql->Exec('ROLLBACK');
		}
	}
	echo "<script language=\"javascript\">window.location='".ROOTHOST_ADMIN.COMS."'</script>";
}

if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=trim($_POST["txtids"]);
	if($ids!='')
		$ids = substr($ids,0,strlen($ids)-1);
	$ids=str_replace(",","','",$ids);
	switch ($_POST["txtaction"]){
		case "public": 
			$sql_active = "UPDATE `tbl_contents` SET `isactive`='1' WHERE `id` in ('$ids')";
			$objmysql->Exec($sql_active);
			break;
		case "unpublic":
			$sql_unactive = "UPDATE `tbl_contents` SET `isactive`='0' WHERE `id` in ('$ids')";
			$objmysql->Exec($sql_unactive);
			break;
		case "delete":
			$sql_del = "DELETE FROM `tbl_contents` WHERE `id` in ('$ids')";
	        $objmysql->Exec($sql_del);
	        break;
		case 'order':
			$sls = explode(',',$_POST['txtorders']); 
			$ids = explode(',',$_POST['txtids']);
			$n = count($ids);
			for($i=0;$i<$n;$i++){
				$sql_order = "UPDATE `tbl_contents` SET `order`='".$sls[$i]."' WHERE `id` = '".$ids[$i]."' ";
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
