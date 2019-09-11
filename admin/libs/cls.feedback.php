<?php
ini_set('display_errors', 1);
class CLS_FEEDBACK{
	private $pro=array(
			'ID'=>'-1',
			'Name'=>'',
			'Comment'=>'',
			'Career'=>'',
			'Avatar'=>'',
			'Order'=>'0',
			'isActive'=>'1');
	private $objmysql;
	public function CLS_FEEDBACK(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($strwhere=""){
		$sql=" SELECT * FROM tbl_feedback $strwhere";
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function listTable($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT tbl_feedback.* FROM tbl_feedback $strwhere LIMIT $star,$leng";

		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);	$i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$i++;
			$ids=$rows['id'];
            $name=$rows['name'];
            $img=$rows['avatar'];
            $comment=$rows['comment'];
            $order=$rows['order'];
			if($rows['isactive']==1) 
				$icon_active="<i class='fa fa-check cgreen' aria-hidden='true'></i>";
			else $icon_active='<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';
			
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";

			echo "<td width=\"30\" align=\"center\"><input type=\"checkbox\" name=\"chk\" id=\"chk\" onclick=\"docheckonce('chk');\" value=\"$ids\"/></td>";

			echo "<td><img src='".$img."' align='' class='df_thumb'></td>";
			echo "<td>".$name."</td>";
			echo "<td>".$comment."</td>";

            echo "<td width=\"50\" align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" class=\"order\"></td>";
			echo "<td align=\"center\">";
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$ids\">";
			echo $icon_active;
			echo "</a>";
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"".ROOTHOST_ADMIN.COMS."/edit/$ids\">";
			echo "<i class='fa fa-edit' aria-hidden='true'></i>";
			echo "</a>";
		
			echo "</td>";
			
			echo "<td align='center' width='10'><a href='".ROOTHOST_ADMIN.COMS."/delete/$ids' onclick=\" return confirm('Bạn có chắc muốn xóa ?')\">";
			echo "<i class='fa fa-times-circle cred' aria-hidden='true'></i></a></td>";

			echo "</tr>";
		}
	}
	public function Add_new(){
		$sql="INSERT INTO `tbl_feedback` ( `name`, `comment`, `career`, `avatar`, `isactive`) VALUES ";
		$sql.="('".$this->Name."', '".$this->Comment."','".$this->Career."', '".$this->Avatar."', '".$this->isActive."')";
		return $this->objmysql->Exec($sql);
	}
	public function Update(){
		$sql="UPDATE `tbl_feedback` SET  
				`name`='".$this->Name."',
				`comment`='".$this->Comment."',
				`career`='".$this->Career."',
				`avatar`='".$this->Avatar."'
		        WHERE `id`='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_feedback` WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setHot($ids){
		$sql="UPDATE `tbl_feedback` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_feedback` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_feedback` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function Order($ids,$order){
		$sql="UPDATE tbl_feedback SET `order`='".$order."' WHERE `id`='".$ids."'";	
		return $this->objmysql->Exec($sql);
	}
	public function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
}
?>