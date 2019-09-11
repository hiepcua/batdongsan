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
    public function getList($where='',$limit=''){
        $sql="SELECT * FROM `tbl_partner` ".$where.' ORDER BY `name` '.$limit;
        // echo $sql;die();
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
        $sql="SELECT * FROM tbl_partner $strwhere ORDER BY `id` DESC LIMIT $star,$leng";
        // echo $sql;die();
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id'];
            $img=$rows['images']!=''?"<img src='".$rows['images']."' height='80'/>":'';
            $title=Substring(stripslashes($rows['name']),0,10);
			if($rows['isactive']==1) 
                $icon_active="<i class='fa fa-check cgreen' aria-hidden='true'></i>";
            else $icon_active='<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';
			
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
			echo "<td align='center' width='10'><a href='".ROOTHOST_ADMIN.COMS."/delete/$ids' onclick=\" return confirm('Bạn chắc chắn muốn xóa ?')\"><i class='fa fa-trash cgray' aria-hidden='true'></i></a></td>";
            echo "<td title=''>$title</td>";
            echo "<td>$img</td>";
            $order=$rows['order'];
            echo "<td align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
            echo "<td align=\"center\">";
            echo "<a href=\"".ROOTHOST_ADMIN."partner/active/$ids\">";
            echo $icon_active;
            echo "</a></td>";
            echo "<td align=\"center\">";
			echo "<a href=\"".ROOTHOST_ADMIN."partner/edit/$ids\">";
            echo "<i class='fa fa-edit' aria-hidden='true'></i>";
            echo "</a></td>";
            echo "</tr>";
        }
    }
    public function getNameById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_partner`  WHERE isactive=1 AND `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }



    public function Add_new(){
        $sql=" INSERT INTO `tbl_partner`(`name`,`images`,`link`,`isactive`) VALUES";
        $sql.="('".$this->Name."','".$this->Images."','".$this->Link."','".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_partner SET `name`='".$this->Name."',`images`='".$this->Images."',`link`='".$this->Link."',`isactive`='".$this->pro["isActive"]."' WHERE id='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_partner` WHERE `id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_partner` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_partner` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        echo $sql;
		return $this->objmysql->Exec($sql);
    }
    public function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_partner` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
            $this->objmysql->Exec($sql);
        }
    }
    /* combo box*/
    function getListCbItem($getId='', $swhere=''){
        $sql="SELECT id, name, code FROM tbl_partner ".$swhere." ORDER BY `name` ASC";
        // echo $sql;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if(isset($getId) && $getId==$id) echo "selected";?>><?php echo $name;?></option>
        <?php
        }
    }


}
?>