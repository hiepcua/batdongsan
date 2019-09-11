<?php
class CLS_MENU{
	private $pro=array(
		'ID'=>'-1',
		'Code'=>'',
		'Name'=>'',
		'Desc'=>'',
		'LangID'=>'0',
		'isActive'=>1
		);
	private $objmysql=NULL;
	public function CLS_MENU(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_MENU class ' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_MENU Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	function getList($where='',$limit=''){
		$sql='SELECT * FROM `tbl_menus` '.$where.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getListmenu($type){
		$this->getList(' WHERE isactive=1','');
		$str='';
		while($rows=$this->Fetch_Assoc()){
			if($type=='list')
				$str.="<li><a href=\"".ROOTHOST_ADMIN."mnuitem/".$rows["id"]."\"><i class=\"fa fa-bars\" aria-hidden=\"true\"></i>".$rows["name"]."</a></li>";
			else if($type=="option")
				$str.="<option value=\"".$rows["id"]."\">".$rows["name"]."</option>";
			else 
				$str.=$rows['name'];
		}
		return $str;
	}
	function Add_new(){
		$sql="INSERT INTO `tbl_menus`(`name`,`code`,`desc`,`isactive`) VALUES ";
		$sql.=" ('".$this->Name."','".$this->Code."','".$this->Desc."','".$this->isActive."') ";
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql="UPDATE `tbl_menus` SET `code`='".$this->Code."',
		`desc`='".$this->Desc."',`name`='".$this->Name."',`isactive`='".$this->isActive."' ";
		$sql.=" WHERE `id`='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	function Delete($ids){
		$sql="DELETE FROM `tbl_menus` WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_menus` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_menus` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
}
?>