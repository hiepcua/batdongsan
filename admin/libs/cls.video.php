<?php
class CLS_VIDEO{
    private $pro=array( 'ID'=>'-1',
        'VideoID'=>'',
        'Name'=>'','Code'=>'',
        'Link'=>'','Thumb'=>'',
        'Intro'=>'','Content'=>'',
        'isHot'=>'','Order'=>'',
        'Cdate'=>'','Mdate'=>'',
        'isActive'=>1);
    private $objmysql=NULL;
    public function CLS_VIDEO(){
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
        $sql="SELECT * FROM `tbl_video` ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }

    function getListCate($parid=0,$level=0){
        $sql="SELECT * FROM tbl_video WHERE `par_id`='$parid' AND `isactive`='1' ";
        // echo $sql;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $char="";
        if($level!=0){
            $char.="&nbsp;&nbsp;&nbsp;";
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

    public function listTable($strwhere="",$page){
        $star=($page-1)*MAX_ROWS;
        $leng=MAX_ROWS;
        $sql="SELECT * FROM tbl_video $strwhere ORDER BY `id` DESC LIMIT $star,$leng";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id']; $cdate=date("d/m/Y H:i:s",strtotime($rows['cdate']));
            $order=$rows['order']; $visited=$rows['visited'];
            $title=stripslashes($rows['name']);
			$img = $rows['thumb'];
			if($img!='') $img = "<img src='$img' height='100'/>";
			if($rows['isactive']==1) 
                $icon_active="<i class='fa fa-check cgreen' aria-hidden='true'></i>";
            else $icon_active='<i class="fa fa-times-circle-o cred" aria-hidden="true"></i>';
			
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
			echo "<td align=\"center\">";
            echo "<a href='".ROOTHOST_ADMIN.COMS."/delete/$ids' onclick=\" return confirm('Bạn có chắc muốn xóa ?')\"><i class='fa fa-trash cgray' aria-hidden='true'></i></a>";
            echo "</td>";
            echo "<td>$img</td>";
            echo "<td title=''><a href='".ROOTHOST_ADMIN.COMS."/edit/$ids'>$title</a></td>";
            echo "<td>$cdate</td>";
            echo "<td align='center'>$visited</td>";
			echo "<td width=\"50\" align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
            echo "<td align=\"center\">";
            echo "<a href=\"".ROOTHOST_ADMIN.COMS."/hot/$ids\">";
            showIconFun('publish',$rows['ishot']);
            echo "</a></td>";
			echo "<td align=\"center\">";
            echo "<a href=\"".ROOTHOST_ADMIN.COMS."/active/$ids\">";
            echo $icon_active;
            echo "</a></td>";
            echo "<td align=\"center\">";
            echo "<a href=\"".ROOTHOST_ADMIN.COMS."/edit/$ids\">";
            echo "<i class='fa fa-edit' aria-hidden='true'></i>";
            echo "</a></td>";
            echo "</tr>";
        }
    }
    public function getNameById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_video`  WHERE isactive=1 AND `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
    public function Add_new(){
        $sql=" INSERT INTO `tbl_video`(`name`,`code`,`video_id`,`link`,`thumb`,
		`intro`,`content`,`cdate`,`isactive`) VALUES";
        $sql.="('".$this->Name."','".$this->Code."','".$this->VideoID."',
			'".$this->Link."','".$this->Thumb."','".$this->Intro."',
			'".$this->Content."','".date('Y/m/d H:i:s')."','".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_video SET `name`='".$this->Name."',`code`='".$this->Code."',
		`video_id`='".$this->VideoID."',`link`='".$this->Link."',
		`thumb`='".$this->Thumb."',`intro`='".$this->Intro."',
		`content`='".$this->Content."',`mdate`='".date('Y/m/d H:i:s')."'
		WHERE id='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function setHot($ids){ 
        $sql="UPDATE `tbl_video` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_video` WHERE `id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_video` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_video` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_video` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
            $this->objmysql->Exec($sql);
        }
    }
    /* combo box*/
    function getListCbItem($getId='', $swhere=''){
        $sql="SELECT id, name, code FROM tbl_video ".$swhere." ORDER BY `name` ASC";
        echo $sql;
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

    /* get info video*/
    public function youtube_image($id) {
        $resolution = array (
            'mqdefault',
            'maxresdefault',
            'sddefault',
            'hqdefault'
            /*'default'*/
        );
        $url='';
        for ($x = 0; $x < sizeof($resolution); $x++) {
            $img=$resolution[$x];
            $url = 'http://img.youtube.com/vi/' . $id . '/' . $resolution[$x] . '.jpg';
            /* if (get_headers($url)[0] == 'HTTP/1.0 200 OK') {
                 break;
             }*/
        }
        return $url;
    }
    public function getTitle($id){
        $content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id);
        parse_str($content, $ytarr);
        return $ytarr['title'];
    }
}
?>