<?php
class CLS_GALLERY{
	private $pro=array( 'ID'=>'-1',
						'AlbumID'=>'',
						'IMG'=>'',
						'Link'=>'',
						'Intro'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_GALLERY(){
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
		$sql="SELECT * FROM `tbl_gallery` where `isactive` = 1 ".$where.$limit;
		return $this->objmysql->Query($sql);
	}

    public function getListSliderPartner($where='',$limit=''){
        $sql="SELECT `tbl_gallery`.`img`, `tbl_gallery`.`name`, `tbl_gallery`.`album_id`, `tbl_gallery`.`link`, `tbl_gallery`.`id` FROM `tbl_gallery` LEFT JOIN `tbl_album` ON `tbl_gallery`.`album_id` = `tbl_album`.`id` where `tbl_gallery`.`isactive` = 1 ".$where.$limit;
        return $this->objmysql->Query($sql);
    }

    public function getCount($where=""){
        $sql="SELECT COUNT(*) as 'number' FROM `tbl_gallery` WHERE isactive=1 ".$where;
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $rows = $objdata->Fetch_Assoc();
        return $rows['number'];
    }

	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getNameById($id=0) {
		$sql="SELECT id,name FROM tbl_album WHERE isactive=1 AND id=$id";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rows=$objdata->Fetch_Assoc();
		return $rows['name'];
	}
	function ListAlbum($strwhere=""){
		$sql="SELECT * FROM tbl_album WHERE isactive=1 $strwhere ORDER BY id ASC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{	
			$id=$rows['id'];
			$ablum=stripslashes($rows['name']);
			$img=$rows['img'];
			if($img!='') { 
				$img = strpos($img,'http')!==false?$img:'http://'.$_SERVER['HTTP_HOST'].$img; 
			}
			$intro = stripslashes($rows['intro']);
			$url = ROOTHOST."index.php?com=gallery&viewtype=block&id=".$id;
			echo '<div class="item-gallery col-md-3 col-sm-6 col-xs-12">
					<a href="'.$url.'"><img src="'.$img.'" class="img-responsive"></a>
					<h3><a class="detail" href="'.$url.'">'.$ablum.'</a></h3>
				</div>';
		}
	}
	function ListGallery($strwhere="",$page=1){
		//$star=($page-1)*MAX_ROWS;
		//$leng=MAX_ROWS;
		$sql="SELECT g.*,a.name as ablum FROM tbl_gallery as g INNER JOIN tbl_album as a WHERE g.album_id = a.id ".$strwhere." ORDER BY `order` DESC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->num_rows()==0) {
			echo "<div class='col-md-12 padding-bottom-20'>Chưa có hình ảnh trong ablum</div>";
		}else {
			while($rows=$objdata->Fetch_Assoc())
			{	
				$id=$rows['id'];
				$ablum=$rows['ablum'];
				$img=$rows['img'];
				if($img!='') { 
					$img = strpos($img,'http')!==false?$img:'http://'.$SERVER['HTTP_HOST'].$img; 
				}
				$intro = stripslashes($rows['intro']);
				echo '<div class="item-gallery col-md-3 col-sm-6 col-xs-12">
				<a rel="example_group" title="'.$intro.'" href="'.$img.'" class="vlightbox">
				<img src="'.$img.'" class="img-responsive">
				<h2 class="txt_giapha">'.$rows['name'].'</2>
				</a></div>';
			}
		}
	}
	function SelecttAlbum($curid=0) {
		$sql="SELECT id,name FROM tbl_album WHERE isactive=1 ORDER BY id DESC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{
			if($rows['id']== $curid)
				echo '<option value="'.$rows['id'].'" selected="selected">'.$rows['name'].'</option>';
			else echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
		}
	}
	function listTable($strwhere="",$page=1){
		$star=0; if($page>1) $star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT g.*,a.name as ablum  FROM tbl_gallery as g INNER JOIN tbl_album as a WHERE g.album_id = a.id ".$strwhere." ORDER BY id DESC LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$id=$rows['id'];
			$ablum=$rows['ablum'];
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
			echo "<td>$ablum</td>";
			echo '<td align="center">'.$img."</td>";
			echo "<td>$intro &nbsp;</td>";
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
	function Add_new(){
		$sql=" INSERT INTO `tbl_gallery`(`album_id`,`IMG`,`intro`,`isactive`) VALUES";
		$sql.="('".$this->AlbumID."','".$this->IMG."','".$this->Intro."','".$this->isActive."')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Update(){
		$sql = "UPDATE tbl_gallery SET `IMG`='".$this->IMG."',`album_id`='".$this->AlbumID."',`intro`='".$this->Intro."',`isactive`='".$this->pro["isActive"]."' WHERE id='".$this->ID."'";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_gallery` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_gallery` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_gallery` WHERE `id` in ('$id')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
}
?>