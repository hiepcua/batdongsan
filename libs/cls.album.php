<?php
class CLS_ALBUM{
	private $pro=array( 'ID'=>'-1',
						'Name'=>'',
						'IMG'=>'',
						'Intro'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_ALBUM(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ('Can not found $proname member');
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_album` where 1=1 ".$where.$limit;
		$this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	
	function listTable($strwhere="",$page=1){
		$sql="SELECT * FROM tbl_album ".$strwhere ;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$id=$rows['id'];
			$name=$rows['name'];
			$img=$rows['img'];
			if($img!='') { 
				$img = strpos($img,'http')!==false?$img:'http://'.$_SERVER['HTTP_HOST'].$img; 
				$img = '<img src="'.$img.'" height="100"/>'; 
			}
			$intro=$rows['intro'];
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$i</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td>$name</td>";
			echo '<td align="center">'.$img."</td>";
			echo "<td>$intro &nbsp;</td>";
			echo '<td align="center"><a href="index.php?com=gallery&amp;albumid='.$id.'">Xem tất cả ảnh</a></td>';
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
				showIconFun('edit','');
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		  	echo "</tr>";
		}
	}

    public function getCount($where=""){
        $sql="SELECT COUNT(*) as 'number' FROM `tbl_album` WHERE isactive=1 " . $where;
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $rows = $objdata->Fetch_Assoc();
        return $rows['number'];
    }

	function getChildID($parid) {
		$sql = "SELECT id FROM tbl_album WHERE par_id IN ('$parid')"; 
		$objdata = new CLS_MYSQL; 
		$this->result = $objdata->Query($sql);
		
		$ids='';
		if($objdata->Num_rows()>0) {
			while($r = $objdata->Fetch_Assoc()) {
				$ids.=$r['id']."','";
				$ids.=$this->getChildID($r['id']);
			}
		}
		return $ids;
	}
	public function updateView($id){
        if(!isset($_SESSION['VIEW-ALBUM-'.$id])){
            $sql="UPDATE `tbl_album` SET `visited`=`visited`+1 WHERE `id` ='$id'";
            $_SESSION['VIEW-ALBUM-'.$id]=1;
            return $this->objmysql->Exec($sql);
        }
    }
}
?>