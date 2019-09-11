<?php
class CLS_PARTNER{
    private $pro=array( 
        'ID'=>'-1',
        'Name'=>'',
        'Images'=>'',
        'Link'=>'',
        'Position'=>'',
        'Order'=>'',
        'isActive'=>1);
    private $objmysql=NULL;
    public function CLS_PARTNER(){
        $this->objmysql=new CLS_MYSQL;
    }
    // property set value
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ("Can not found $proname member");
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
    public function getList($where=''){
        $sql="SELECT * FROM `tbl_partner` WHERE 1=1 ".$where;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getNameById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_partner`  WHERE isactive=1 AND `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
}
?>