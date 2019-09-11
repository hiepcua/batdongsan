<?php
class CLS_DOCUMENT{
	var $obj=array(
				  "ID"=>"-1",
				  "TypeID"=>"0",
				  "Name"=>"0",
				  "Code"=>"",
				  "Intro"=>"",
				  "Content"=>"",
				  "Url"=>"",
				  "Author"=>"",
				  "FileType"=>"",
				  "FileSize"=>"",
				  "CDate"=>"",
				  "Pages"=>0,
				  "Views"=>0,
				  "Downloads"=>0,
				  "isHot"=>0,
				  "isActive"=>1
				  );
	private $objmysql=null;
	function CLS_DOCUMENT(){$this->objmysql=new CLS_MYSQL;}	
	function getURL ($docid) {
		$sql="SELECT code,g_id FROM `tbl_document` WHERE `id`='$docid'";
		//echo $sql;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		
		$url='';
		
		if($objdata->Numrows()>0)
		{
			$rows=$objdata->FetchArray();
			$url.=$rows["code"]."/";
			$url=$this->getURL($rows["g_id"]).$url;
		}
		
		return $url;
	}
	
	function getList($where=""){
		$sql="SELECT * FROM `tbl_document` WHERE 1=1 ".$where;
		//echo $sql;
		return $this->objmysql->Query($sql);
	}
	function getCount($where=""){
		$sql="SELECT count(id) AS  total FROM `tbl_document` WHERE 1=1 ".$where;
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql); 
        $row=$objdata->Fetch_Assoc();
        return $row['total'];
	}
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_document`  WHERE isactive=1 AND `id` = '$id'"; 
		// echo $sql;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	public function getNameByCode($code){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_document`  WHERE isactive=1 AND `code` = '$code'"; 
		// echo $sql;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	public function getIDByCode($code){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `id` FROM `tbl_document`  WHERE isactive=1 AND `code` = '$code'"; 
		// echo $sql;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['id'];
	}
	public function getCodeById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `code` FROM `tbl_document`  WHERE isactive=1 AND `id` = '$id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['code'];
	}

    public function updateCodeSearch($id, $val) {
        $sql='UPDATE `tbl_document` SET `code_search` = ' . $val . ' where `id` = ' . $id;
        $objdata=new CLS_MYSQL();
        if($objdata->Query($sql))
            return true;
        else return false;
    }

	function getListDoc($g_id=0,$level=0,$select='')
	{
		$sql="SELECT * FROM `tbl_document` WHERE `g_id`='$g_id'";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level>0)
		{
			for($i=0;$i<$level;$i++)
				$char.=".....";
				$char.="";
		}
		while($rows=$objdata->FetchArray())
		{
			$catid=$rows["id"];
			$name=$rows["name"];
			if($rows["id"]==$select)
				echo "<option value=\"$catid\" selected=\"selected\">$char$name</option>";
			else echo "<option value=\"$catid\">$char$name</option>";
			$this->getListDoc($catid,$level+1,$select);
		}
	}
	
	function getURLdoc($id) {
		$sql="SELECT urlfile FROM `tbl_document` WHERE `id`='$id'";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$str='';
		$rows=$objdata->FetchArray();
		$str=$rows["urlfile"];

		return $str;
	}
	function haveChild($id) {
		$sql="SELECT id FROM `tbl_document` WHERE `g_id`='$id'"; //echo $sql;die;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Numrows()>0)
			return $objdata->Numrows();
		else 
			return 0;
	}
	function getCode($code) {
		$sql="SELECT code FROM `tbl_document` WHERE `code`='$code'"; //echo $sql;die;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Numrows()>0)
			return $objdata->Numrows();
		else 
			return 0;
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getFileSize($size, $retstring = null)
	{
		$sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		if ($retstring === null) { $retstring = '%01.2f %s'; }
		$lastsizestring = end($sizes);
		foreach ($sizes as $sizestring) {
				if ($size < 1024) { break; }
				if ($sizestring != $lastsizestring) { $size /= 1024; }
		}
		if ($sizestring == $sizes[0]) { $retstring = '%01d %s'; } // Bytes aren't normally fractional
		return sprintf($retstring, $size, $sizestring);
	}
	function getFileType($file="") {
		
		// get file name 
		$filearray = explode("/", $file);
		$filename = array_pop($filearray);
		
		// condition : if no file extension, return
		if(strpos($filename, ".") === false) return false;
		
		// get file extension
		$filenamearray = explode(".", $filename);
		$extension = $filenamearray[(count($filenamearray) - 1)];
		return $extension;
	
	}

	function fileName($id,$HOST_URL){
		$sql = "SELECT loai,code,urlfile FROM `tbl_document` WHERE `id`=$id";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rows=$objdata->FetchArray();
		
		//loai=1: kieu thu muc, loai=0: kieu tep tin
		$dirname = $HOST_URL.$rows["urlfile"].$rows["code"];
		return $dirname;
	}
	public function updateView($id){
        if(!isset($_SESSION['VIEW-DOCUMENT-'.$id])){
            $sql="UPDATE `tbl_document` SET `views`=`views`+1 WHERE `id` ='$id'";
            $_SESSION['VIEW-DOCUMENT-'.$id]=1;
            return $this->objmysql->Exec($sql);
        }
    }
	public function updateDownload($id){
		$sql="UPDATE `tbl_document` SET `downloads`=`downloads`+1 WHERE `id` ='$id'";
        return $this->objmysql->Exec($sql);
    }
}
?>