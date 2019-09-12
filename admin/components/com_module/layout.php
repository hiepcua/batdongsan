<?php
	defined('ISHOME') or die("Can't acess this page, please come back!");
	define('COMS','module');
	define("THIS_COM_PATH",COM_PATH."com_".COMS."/");
	
	$check_permission = $UserLogin->Permission(COMS);
	if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

	// Begin Toolbar
	include_once('libs/cls.module.php');
	include_once('libs/cls.menu.php');
	include_once('libs/cls.category.php');
	include_once('libs/cls.menuitem.php');
	
	$obj=new CLS_MODULE();
	$objmenu=new CLS_MENU();
	$objCate=new CLS_CATEGORY();
	$objmysql = new CLS_MYSQL();
	
	// End toolbar
	if(isset($_POST['cmdsave'])){
		$Cate_ID 	= isset($_POST['cbo_cate']) ? (int)$_POST['cbo_cate'] : 0;
		$Con_ID 	= isset($_POST['cbo_content']) ? (int)$_POST['cbo_content'] : 0;
		$MnuID 		= isset($_POST['cbo_menutype']) ? (int)$_POST['cbo_menutype'] : 0;
		$ViewTitle	= isset($_POST['optviewtitle']) ? (int)$_POST['optviewtitle'] : 0;
		$isActive	= isset($_POST['optactive']) ? (int)$_POST['optactive'] : 0;

		$Title 		= isset($_POST['txttitle']) ? addslashes($_POST['txttitle']) : '';
		$Type 		= isset($_POST['cbo_type']) ? addslashes($_POST['cbo_type']) : '';
		$Theme 		= isset($_POST['cbo_theme']) ? addslashes($_POST['cbo_theme']) : '';
		$HTML 		= isset($_POST['txtcontent']) ? addslashes($_POST['txtcontent']) : '';
		$Position	= isset($_POST['cbo_position']) ? addslashes($_POST['cbo_position']) : '';
		$Class		= isset($_POST['txtclass']) ? addslashes($_POST['txtclass']) : '';
		$Intro		= isset($_POST['txtintro']) ? addslashes($_POST['txtintro']) : '';
		
		if(isset($_POST['txtid'])){
			$ID = (int)$_POST['txtid'];
			$sql="UPDATE `tbl_modules` SET 
				`type`='".$Type."',
				`title`='".$Title."',
				`intro`='".$Intro."',
				`content`='".$HTML."',
				`viewtitle`='".$ViewTitle."',
				`menu_id`='".$MnuID."',
				`category_id`='".$Cate_ID."',
				`content_id`='".$Con_ID."',
				`theme`='".$Theme."',
				`position`='".$Position."',
				`class`='".$Class."',
				`isactive`='".$isActive."' 
				WHERE `id`='".$ID."'";
			$objmysql->Exec($sql);
		}else{
			$sql="INSERT INTO `tbl_modules` (`type`,`viewtitle`,`menu_id`,`category_id`,`content_id`,`theme`,`position`,`class`,`isactive`,`title`,`intro`,`content`) VALUES ('".$Type."','".$ViewTitle."','".$MnuID."','".$Cate_ID."','".$Con_ID."','".$Theme."','".$Position."','".$Class."','".$isActive."','".$Title."','".$Intro."','".$HTML."')";
			$objmysql->Exec($sql);
		}
		?>
		<script language="javascript">window.location='<?php echo ROOTHOST_ADMIN.COMS;?>'</script>
		<?php
	}

	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"]){
			case "public": 
				$sql_active = "UPDATE `tbl_modules` SET `isactive`='1' WHERE `id` in ('$ids')";
				$objmysql->Exec($sql_active);
				break;
			case "unpublic":
				$sql_unactive = "UPDATE `tbl_modules` SET `isactive`='0' WHERE `id` in ('$ids')";
				$objmysql->Exec($sql_unactive);
				break;
			case "delete":
				$sql="DELETE FROM `tbl_modules` WHERE `id` in ('$ids')";
				$objmysql->Exec('BEGIN');
				$result=$objmysql->Exec($sql);

				$sql="DELETE FROM `tbl_modules_text` WHERE `mod_id` in ('$ids')";
				$result1=$objmysql->Exec($sql);

				if($result && $result1 ){
					$objmysql->Exec('COMMIT');
				}else {
					$objmysql->Exec('ROLLBACK');
				}
		        break;
			case 'order':
				$sls = explode(',',$_POST['txtorders']); 
				$ids = explode(',',$_POST['txtids']);
				$n = count($ids);
				for($i=0;$i<$n;$i++){
					$sql_order = "UPDATE `tbl_modules` SET `order`='".$sls[$i]."' WHERE `id` = '".$ids[$i]."' ";
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
	unset($task);	unset($ids);	unset($obj);	unset($objlag);
?>