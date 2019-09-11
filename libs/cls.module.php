<?php
//ini_set('display_errors', '1');
class CLS_MODULE{
	private $pro=array(
		'ID'=>'-1',
		'Title'=>'',
		'Type'=>'menu',
		'ViewTitle'=>'1',
		'MnuID'=>'0',
		'category_id'=>'0',
		'Cata_ID'=>'0',
		'Gdoc_ID'=>'0',
		'Album'=>'0',
		'Theme'=>'',
		'HTML'=>'',
		'Position'=>'',
		'Class'=>'',
		'LangID'=>'0',
		'Order'=>'',
		'isActive'=>1
		);
	private $objmysql=NULL;
	public function CLS_MODULE(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in module class';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in module class';
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_modules` WHERE isactive=1 ".$where." ORDER BY `position` ASC, `order` ASC ".$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getPosition(){
		$sql='SELECT DISTINCT `position` FROM `tbl_moduless`';
		$this->objmysql->Query($sql);
		while($rows=$this->objmysql->Fetch_Assoc()){
			$pos=$rows['position'];
			echo "<option value=\"$pos\">$pos</option>";
		}
	}
	public function LoadModType(){
		$sql='SELECT * FROM `tbl_modtype` ';
		$this->objmysql->Query($sql);
		while($rows=$this->objmysql->Fetch_Assoc()){
			$code=$rows['code'];
			$name=$rows['name'];
			echo "<option value=\"$code\">$name</option>";
		}
	}
	public function getListMod($strwhere)
	{
		$sql='SELECT * FROM `tbl_moduless` '.strwhere;
		$this->objmysql->Query($sql);
		while($rows=$this->objmysql->Fetch_Assoc()){
			$id=$rows['id'];
			$name=$rows['title'];
			echo "<option value=\"$id\">$title</option>";
		}
	}
}
?>