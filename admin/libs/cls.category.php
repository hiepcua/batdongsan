<?php
class CLS_CATEGORY{
    private $pro=array( 'ID'=>'-1',
        'Par_Id'=>"",
        'Name'=>'',
        'Thumb'=>'',
        'Intro'=>'',
        'Code'=>'',
        'Type'=>'',
        'Order'=>'',
        'isActive'=>1);
    private $objmysql=NULL;
    public function CLS_CATEGORY(){
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
        $sql="SELECT * FROM `tbl_categories` ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function getInfo($where='',$limit=''){
        $sql="SELECT * FROM `tbl_categories` WHERE 1=1 ".$where.' ORDER BY `name` '.$limit;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row = $objdata->Fetch_Assoc();
        return $row;
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }

    function getListCate($parid=0,$level=0){
        $sql="SELECT * FROM tbl_categories WHERE `par_id`='$parid' AND `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $char="";
        if($level!=0){
            for($i=0;$i<$level;$i++)
                $char.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
            $char.="|---";
        }
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $parid=$rows['par_id'];
            $title=$rows['name'];
            echo "<option value='$id'>$char $title</option>";
            $nextlevel=$level+1;
            $this->getListCate($id,$nextlevel);
        }
    }
    public function listTable($strwhere="",$parid=0,$level=0,$rowcount){
        $sql="SELECT * FROM tbl_categories WHERE 1=1 $strwhere AND par_id=$parid ORDER BY `order` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $str_space="";
        if($level!=0){  
			$str_space.="|";
            for($i=0;$i<$level;$i++)
                $str_space.="--- "; 
        }
        while($rows=$objdata->Fetch_Assoc()){
            $rowcount++;
            $ids=$rows['id'];
            $title=Substring(stripslashes($rows['name']),0,10);
			if($rows['isactive']==1) 
                $icon_active="<i class='fa fa-check cgreen' aria-hidden='true'></i>";
            else $icon_active='<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';
			
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$rowcount</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\"   onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
			echo "<td align='center' width='10'><a href='".ROOTHOST_ADMIN.COMS."/delete/$ids' onclick=\" return confirm('Bạn có chắc muốn xóa ?')\"><i class='fa fa-trash cgray red' aria-hidden='true'></i></a></td>";
            echo "<td title=''>$str_space$title</td>";
            $order=$rows['order'];
            echo "<td width=\"50\" align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
            echo "<td align=\"center\">";
            echo "<a href=\"".ROOTHOST_ADMIN."category/active/$ids\">";
            echo $icon_active;
            echo "</a></td>";
            echo "<td align=\"center\">";
            echo "<a href=\"".ROOTHOST_ADMIN."category/edit/$ids\">";
            echo "<i class='fa fa-edit' aria-hidden='true'></i>";
            echo "</a></td>";
            echo "</tr>";
            $nextlevel=$level+1;
            $this->listTable($strwhere,$ids,$nextlevel,$rowcount);
        }
    }
    public function getNameById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_categories`  WHERE isactive=1 AND `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
    /* combo box*/
    public function getListCbItem($getId='', $swhere=''){
        $sql="SELECT id, name, code FROM tbl_categories ".$swhere." ORDER BY `name` ASC";
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
    public function getListCategory($parid=0,$level=0,$cls='menu'){
        $sql="SELECT * FROM `tbl_categories` WHERE `par_id`='$parid' AND `isactive`=1 ORDER BY `order` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $char="";
        if($level!=0){
            $char.="|";
			for($i=0;$i<$level;$i++)
                $char.="--- "; 
        }
        if($objdata->Num_rows()>0){
            echo "<ul class='".$cls."'>";
            while($r=$objdata->Fetch_Assoc()){
                $id=$r["id"];
                $name=$r["name"];
                echo"<li data-id='$id'><a href='".ROOTHOST_ADMIN."contents/category/$id'>$char $name</a></li>";
                $nextlevel=$level+1;
                $this->getListCategory($id,$nextlevel);
            }
            echo "</ul>";
        }
    }
	public function getMenuCategory($parid=0,$cls='menu'){
        $sql="SELECT * FROM `tbl_categories` WHERE `par_id`='$parid' AND `isactive`=1 ORDER BY `order` ASC,id ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()>0){
            echo "<ul class='".$cls."'>";
            while($r=$objdata->Fetch_Assoc()){
                $id=$r["id"];
                $name=$r["name"];
				$icon = '';
				if($this->getchildCategory($id)>0) $icon ="<i class='fa fa-angle-right pull-right'></i>";
                echo "<li data-id='$id'><a href='".ROOTHOST_ADMIN."contents/category/$id'>$name $icon</a>";
                $this->getMenuCategory($id);
				echo "</li>";
            }
            echo "</ul>";
        }
    }
	public function getchildCategory($parid=0){
		$sql = "SELECT count(id) AS total FROM tbl_categories WHERE `par_id`='$parid' AND `isactive`=1";
		$objdata=new CLS_MYSQL();
        $objdata->Query($sql);
		$r=$objdata->Fetch_Assoc();
		return $r['total']+0;
	}
}
?>