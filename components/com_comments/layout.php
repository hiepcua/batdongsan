<?php
	defined("ISHOME") or die("Can not acess this page, please come back!");
	define("COMS","products");
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	// Begin Toolbar
	require_once(LAG_PATH."vi/lang_products.php");
	require_once(libs_path.'cls.products.php');
	require_once(libs_path.'cls.catalogs.php');
    require_once(libs_path.'cls.salers.php');

	$objlang=new LANG_PRODUCTS;
	$obj=new CLS_PRODUCTS;
	$objdata=new CLS_MYSQL();
	$title_manager=$objlang->CONTENT_MANAGER;
	if(isset($_GET["task"]) && $_GET["task"]=="add")
		$title_manager = $objlang->CONTENT_MANAGER_ADD;
	if(isset($_GET["task"]) && $_GET["task"]=="edit")
		$title_manager = $objlang->CONTENT_MANAGER_EDIT;
		
	//require_once("includes/toolbar_khosim.php");
	// End toolbar
    $arr_sql= array();$dem=0;$kt=0;
    $Str_viettel="Insert into tbl_sim_test(`ncc`,`fist_number`,`number`,`price`,`total_nut`,`type`,`isdell`,`count_char`) Values ";
    $Str_vina="Insert into tbl_sim_test(`ncc`,`fist_number`,`number`,`price`,`total_nut`,`type`,`isdell`,`count_char`) Values ";
    $Str_mobile="Insert into tbl_sim_test(`ncc`,`fist_number`,`number`,`price`,`total_nut`,`type`,`isdell`,`count_char`) Values ";
    $Str_vietnam="Insert into tbl_sim_test(`ncc`,`fist_number`,`number`,`price`,`total_nut`,`type`,`isdell`,`count_char`) Values ";
    $Str_other="Insert into tbl_sim_test(`ncc`,`fist_number`,`number`,`price`,`total_nut`,`type`,`isdell`,`count_char`) Values ";
    $index=0;$count1=0;$count2=0;$count3=0;$count4=0;$count=0;
    
	if(isset($_POST['upload'])){
       $list_so=$_POST['list_so'];
       $arr_so=explode('
',$list_so);
       $index=count($arr_so);
       for($i=0;$i<$index;$i++){
            $line_of_text=uncode($arr_so[$i]);
	        $arr_value=explode(',',$line_of_text);
            $n=count($arr_value);
            $total_nut=tong_nut(trim($arr_value[1]));
            $type=phanloai($arr_value[1]);
            $fist_number=fist_number($arr_value[1]);
            $count_char=strlen($arr_value[1])+1;
            if($n==3){
                $table=getNetwork(trim($arr_value[1]));
                if($table=='tbl_sim_viettel'){
                    $Str_viettel.="('".$arr_value[0]."','".'0'.$fist_number."','".'0'.$arr_value[1]."','".$arr_value[2]."','".$total_nut."','".$type."','1','".$count_char."'),";
                    $count++;
                    if($count==1000){
                        $dem=strlen($Str_viettel);
                        $arr_sql[count($arr_sql)]=substr($Str_viettel,0,$dem-1);
                        $count=0;
                        $Str_viettel="Insert into tbl_sim_test(`ncc`,`fist_number`,`number`,`price`,`total_nut`,`type`,`isdell`,`count_char`) Values ";
                    }
                }
                if($table=='tbl_sim_vinaphone'){
                    $Str_vina.="('".$arr_value[0]."','".'0'.$fist_number."','".'0'.$arr_value[1]."','".$arr_value[2]."','".$total_nut."','".$type."','1','".$count_char."'),";
                    $count1++;
                    if($count1==1000){
                        $dem1=strlen($Str_vina);
                        $arr_sql[count($arr_sql)]=substr($Str_vina,0,$dem1-1);
                        $count1=0;
                        $Str_vina="Insert into tbl_sim_test(`ncc`,`fist_number`,`number`,`price`,`total_nut`,`type`,`isdell`,`count_char`) Values ";
                    }
                }
                if($table=='tbl_sim_vietnammobile'){
                    $Str_vietnam.="('".$arr_value[0]."','".'0'.$fist_number."','".'0'.$arr_value[1]."','".$arr_value[2]."','".$total_nut."','".$type."','1','".$count_char."'),";
                    $count2++;
                    if($count2==1000){
                        $dem2=strlen($Str_vietnam);
                        $arr_sql[count($arr_sql)]=substr($Str_vietnam,0,$dem2-1);
                        $count2=0;
                        $Str_vietnam="Insert into tbl_sim_test(`ncc`,`fist_number`,`number`,`price`,`total_nut`,`type`,`isdell`,`count_char`) Values ";
                    }
                }
                if($table=='tbl_sim_mobilefone'){
                    $Str_mobile.="('".$arr_value[0]."','".'0'.$fist_number."','".'0'.$arr_value[1]."','".$arr_value[2]."','".$total_nut."','".$type."','1','".$count_char."'),";
                    $count3++;
                    if($count3==1000){
                        $dem3=strlen($Str_mobile);
                        $arr_sql[count($arr_sql)]=substr($Str_mobile,0,$dem3-1);
                        $count3=0;
                        $Str_mobile="Insert into tbl_sim_test(`ncc`,`number`,`price`,`total_nut`,`type`) Values ";
                    }
                }
            }
            //print_r($arr_value);
       }
       
	   
       if($count>0){
        $dem=strlen($Str_viettel);
        $arr_sql[count($arr_sql)]=substr($Str_viettel,0,$dem-1);    
       }
       if($count1>0){
         $dem1=strlen($Str_vina);
         $arr_sql[count($arr_sql)]=substr($Str_vina,0,$dem1-1);
       }
       if($count2>0){
         $dem2=strlen($Str_vietnam);
         $arr_sql[count($arr_sql)]=substr($Str_vietnam,0,$dem2-1);
       }
       if($count3>0){
         $dem3=strlen($Str_mobile);
        $arr_sql[count($arr_sql)]=substr($Str_mobile,0,$dem3-1);
       }
       $n=count($arr_sql);
       print_r($arr_sql);
       die();
      // echo $n;die;
       for($i=0;$i<$n;$i++){
            $objdata->Exec($arr_sql[$i]);
       }

    }    
    
    
	if(isset($_POST["cmdsave"])){
        if(isset($_POST["cbo_cate"])){
    		$network=	(int)$_POST["cbo_cate"];
            if($network==31) $table="tbl_sim_viettel";
            if($network==32) $table="tbl_sim_vinaphone";
            if($network==33) $table="tbl_sim_mobilefone";
            if($network==35) $table="tbl_sim_viettnammobile";
            if($network==36) $table="tbl_sim_beeline";
            if($network==37) $table="tbl_sim_other";}
            
		$number=array();
        $price=array();
        $number[0]=$_POST["txt_number"][0];
        $number[1]=$_POST["txt_number"][1];
        $number[2]=$_POST["txt_number"][2];
        $number[3]=$_POST["txt_number"][3];
        $number[4]=$_POST["txt_number"][4];
        
        $price[0]=($_POST["txt_price"][0]);
        $price[1]=($_POST["txt_price"][1]);
        $price[2]=($_POST["txt_price"][2]);
        $price[3]=($_POST["txt_price"][3]);
        $price[4]=($_POST["txt_price"][4]);
        
        if(isset($_POST["txt_cdate"])){
			$txtjoindate=trim($_POST["txt_cdate"]);
			$joindate = mktime(0,0,0,substr($txtjoindate,3,2),substr($txtjoindate,0,2),substr($txtjoindate,6,4));
			$obj->Cdate = date("Y-m-d",$joindate);
		}
        if(isset($_POST["txt_mdate"])){
			$txtmdate=trim($_POST["txt_mdate"]);
			$mdate = mktime(0,0,0,substr($txtmdate,3,2),substr($txtmdate,0,2),substr($txtmdate,6,4));
			$obj->Mdate = date("Y-m-d",$mdate);
		}
        $obj->Ncc=	(int)$_POST["cbo_saler"]; 
        $obj->Createby=$_SESSION["IGFUSERLOGIN"];
        $obj->Number=$_POST['txt_number'];
        $obj->Price=$_POST['txt_price']; 
        $obj->Ncc=$_POST['cbo_saler'];
        $obj->Isdell=(int)$_POST["opt_isdell"];
        if(isset($_POST['txtid'])){
            $obj->ID=(int)$_POST["txtid"];
            $table=$_POST['txt_table'];
            $obj->Update($table);
        }
		 
        else {
            $sql="INSERT INTO $table (`fist_number`,`number`,`price`,`count_char`,`ncc`,`joindate`,`createby`) VALUES ";
            $tong=0;
            $count=count($number);
            for($i=0;$i<$count;$i++){
                if($number[$i]=='') 
                    break;
                else{
                    $num=$number[$i];
                    $k=strlen($number[$i]);
                    if($k==10){ $fist_number=substr($number[$i],0,3);$count_char=$k;
                        //for($i=0;$i<$k;$i++)
                           // $tong+=substr($num,$i,1);
                           // echo $tong;die();
                    }
                    else {$fist_number=substr($number[$i],0,4);$count_char=$k;
                       // for($i=0;$i<$k;$i++)
                        //    $tong+=substr($num,$i,1);
                    }           
                    $sql.="('".$fist_number."','".$number[$i]."','".$price[$i]."','".$count_char."','".$obj->Ncc."','".$obj->Cdate."','".$obj->Createby."'),";
                    //$tong=0;
                }
            }
            $n=strlen($sql);
            $sql=substr($sql,0,$n-1);
            //echo $sql;die();
            $objdata->Query($sql);           
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
       
	
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='ks_viettel';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	
	unset($obj); unset($task);	unset($objlang); unset($ids);
?>