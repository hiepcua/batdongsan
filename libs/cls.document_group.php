<?php
class CLS_DOCUMENT_TYPE {
	private $objmysql=null;
	public function CLS_DOCUMENT_TYPE(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where='',$lag_id=0){
		$sql="SELECT * FROM `tbl_document_group`  WHERE isactive=1 ".$where;
//		  echo $sql;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getIdByCode($code){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `id` FROM `tbl_document_group`  WHERE isactive=1 AND `code` = '$code'";
		// echo $sql;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['id'];
	}
	public function getNameById($ids){
		$sql = "SELECT name FROM tbl_document_group WHERE id IN ('$ids')";
		$objdata = new CLS_MYSQL; 
		$objdata->Query($sql);
		$row = $objdata->Fetch_Assoc();
		return $row['name'];
	}

    public function getCodeById($id){
        $sql = "SELECT `code` FROM tbl_document_group WHERE id = " . $id;
        $objdata = new CLS_MYSQL;
        $objdata->Query($sql);
        $row = $objdata->Fetch_Assoc();
        return $row['code'];
    }

	public function getNameByCode($code){
		$sql = "SELECT name FROM tbl_document_group WHERE `code` = '$code'";
		$objdata = new CLS_MYSQL; 
		$objdata->Query($sql);
		$row = $objdata->Fetch_Assoc();
		return $row['name'];
	}
	public function getNameAndCodeById($id){
		$sql = "SELECT name,code FROM tbl_document_group WHERE `id` = '$id'";
		// echo $sql;
		$objdata = new CLS_MYSQL; 
		$objdata->Query($sql);
		$row = $objdata->Fetch_Assoc();
		return $row;
	}
	public function getChildID($parid) {
		$sql = "SELECT id FROM tbl_document_group WHERE `par_id` IN ('$parid')";
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

    public function getListDocumentGroup($par_id = 0) {
        $sql = " SELECT * FROM `tbl_document_group` WHERE `par_id` = " . $par_id;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        $str = '<ul>';
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $code = $this->getNameAndCodeById($id)['code'];
            $url = ROOTHOST . 'tai-lieu/' . $code . '/' . $id;
            $str .= "<li><a href='" . $url . "' title='".$rows['name']."'><i class='fa fa-caret-right' aria-hidden='true'></i>".$rows['name']."</a></li>";
            $str .= $this->getListDocumentGroup($id);
        }
        $str .= '</ul>';
        return $str;
    }
}
?>