<?php
ini_set('display_errors', 1);
class CLS_SLIDER{
	private $pro=array(
			'ID'=>'-1',
			'Slogan'=>'',
			'Intro'=>'',
			'Link'=>'',
			'Thumb'=>'',
			'Type'=>'0',
			'Order'=>'0',
			'isActive'=>'1');
	private $objmysql;
	public function CLS_SLIDER(){
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
		$sql=" SELECT * FROM tbl_slider $strwhere";
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
		$sql="SELECT tbl_slider.* FROM tbl_slider $strwhere ORDER BY `order` ASC LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);	$i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$i++;
			$ids=$rows['id'];
            $link=$rows['link'];
            $intro= Substring($rows['intro'], 0, 10);
            $slogan= Substring($rows['slogan'], 0, 10);
            $img=$rows['thumb'];
            $order=$rows['order'];
			if($rows['isactive']==1) 
				$icon_active="<i class='fa fa-check cgreen' aria-hidden='true'></i>";
			else $icon_active='<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';
			
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";

			echo "<td width=\"30\" align=\"center\"><input type=\"checkbox\" name=\"chk\" id=\"chk\" onclick=\"docheckonce('chk');\" value=\"$ids\"/></td>";

			echo "<td><img src='$img' class='img-obj pull-left' width='250px'> $link</td>";
			echo "<td>$slogan</td>";
			echo "<td>$intro</td>";
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
    /* combo box*/
    public function getListCbItem($getId='', $swhere='', $arrId=''){
        $sql="SELECT id, name, code FROM tbl_slider WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            if(!$arrId){
                ?>
                <option value='<?php echo $rows['id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
            }else{?>
                <option value='<?php echo $id;?>' <?php if(isset($arrId) and in_array($id, $arrId)) echo "selected";?>><?php echo $name;?></option>
            <?php
            }
            ?>


        <?php
        }
    }
}
?>