<?php
class CLS_DOCUMENT{
	private $pro=array(
		'ID'=>'-1',
		'G_ID'=>'0',
		'Name'=>'',
		'Code'=>'0',
		'Intro'=>'',
		'Content'=>'',
		'Url'=>'',
		'Fullurl'=>'',
		'Author'=>'',
		'Filetype'=>'',
		'Filesize'=>'',
		'Date_issued'=>'',
		'Cdate'=>'',
		'Mdate'=>'',
		'Pages'=>'',
		'Views'=>'',
		'Downloads'=>'',
		'Order'=>'',
		'Mtitle'=>'',
		'Mkey'=>'',
		'Mdesc'=>'',
        "isHot"=>0,
		'IsActive'=>1);
	private $objmysql;
	public function CLS_DOCUMENT(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_DOCUMENT Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_DOCUMENT Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($strwhere="",$lagid=0){
		$sql=" SELECT * FROM tbl_document WHERE 1=1 $strwhere";
		// echo $sql;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}

	public function LoadGmem($cur_id=0,$par_id=0,$space){
		if($par_id!='0')	$space.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$char='';
		if($space!='') $char=$space.'|---';
		
		$sql="SELECT * FROM `tbl_gmember` WHERE par_id=$par_id";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{
			$modid=$rows['id'];
			$name=$rows['name'];
			if($cur_id==$modid)
				echo "<option value=\"$modid\" selected=\"selected\">$char$name</option>";
			else
				echo "<option value=\"$modid\">$char$name</option>";
			$this->LoadGmem($cur_id,$modid,$space);
		}
	}
	public function getTypeName($TypeID) {
		$sql="SELECT name from tbl_document_type where id='$TypeID'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()>0) {
			$r=$objdata->Fetch_Assoc();
			return $r['name'];
		}
	}
	public function listTable($strwhere="",$page){
		$star=0;
		if($page>1) $star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="	SELECT * FROM tbl_document WHERE 1=1 $strwhere ORDER BY id DESC LIMIT $star,$leng"; 
		 // echo $sql;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$i++;
			$ids=$rows['id'];
			$name=stripslashes($rows['name']);
			include_once('libs/cls.document_group.php');
			$obj_doctype = new CLS_DOCUMENT_TYPE();
			$doctype_name = $obj_doctype->getNameById($rows['g_id']);
			$link = ROOTHOST.'tai-lieu/'.$rows['code'].'/'.$rows['id'].'.html';
			$order=$rows['order'];
			if($rows['isactive']==1) 
                $icon_active="<i class='fa fa-check cgreen' aria-hidden='true'></i>";
            else $icon_active='<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';
			
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td align='center' width='10'><a href='".ROOTHOST_ADMIN.COMS."/delete/$ids' onclick=\" return confirm('Bạn có chắc muốn xóa ?')\"><i class='fa fa-trash cgray' aria-hidden='true'></i></a></td>";
			echo "<td>$name</td>";
			echo "<td>$link</td>";
			echo "<td align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";

			echo "<td align=\"center\">";

			echo "<a href='".ROOTHOST_ADMIN.COMS."/active/$ids'>";
			echo $icon_active; echo "</a>";
			echo "</td>";
			echo "<td align=\"center\">";

			echo "<a href='".ROOTHOST_ADMIN.COMS."/edit/$ids'>";
			echo "<i class='fa fa-edit' aria-hidden='true'></i>";
			echo "</a>";

			echo "</td>";
			echo "</tr>";
		}
	}

	public function Add_new(){
		$sql="INSERT INTO `tbl_document` (`g_id`,`name`,`code`,`intro`,`content`,
		`url`,`fullurl`,`author`,`filetype`,`filesize`,`cdate`,`date_issued`,`meta_title`,`meta_key`,`meta_desc`,`ishot`,`isactive`) VALUES ";
		$sql.="('".$this->G_ID."','".$this->Name."','".$this->Code."','".$this->Intro."','";
		$sql.=$this->Content."','".$this->Url."','".$this->Fullurl."','".$this->Author."','".$this->Filetype."','".$this->Filesize."','";
		$sql.=$this->Cdate."','".$this->Date_issued."','".$this->Mtitle."','".$this->Mkey."','".$this->Mdesc."','".$this->isHot."','".$this->IsActive."')";
		// echo $sql;die();
		return $this->objmysql->Exec($sql);
	}
	
	public function Update(){
		$sql="UPDATE `tbl_document` SET  
		`g_id`='".$this->G_ID."',
		`name`='".$this->Name."',
		`intro`='".$this->Intro."',									
		`content`='".$this->Content."',
		`url`='".$this->Url."',
		`fullurl`='".$this->Fullurl."',
		`author`='".$this->Author."',
		`filetype`='".$this->Filetype."',
		`filesize`='".$this->Filesize."',
		`mdate`='".$this->Mdate."',
		`date_issued`='".$this->Date_issued."',
		`meta_title`='".$this->Mtitle."',	
		`meta_key`='".$this->Mkey."',	
		`meta_desc`='".$this->Mdesc."',	
		`ishot`='".$this->isHot."',
		`isactive`='".$this->IsActive."' 
		WHERE `id`='".$this->ID."'";
//		 echo $sql;die();
		return $this->objmysql->Exec($sql);
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_document` WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_document` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_document` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Order($arr_id,$arr_quan){
		$n=count($arr_id); 
		for($i=0;$i<$n;$i++){
			$sql="UPDATE `tbl_document` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
			$this->objmysql->Exec($sql);
		}
	}
	public function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
	// -----------------
	

	public function LoadConten($lagid=0){
		$sql="SELECT * FROM `tbl_htx` WHERE lag_id='$lagid' AND isactive='1'";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc()){
			$ids=$rows['id'];
			$title=$rows['title'];
			echo "<option value=\"$ids\">$title</option>";
		}
	}
	

}
?>