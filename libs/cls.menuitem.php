<?php
//ini_set('display_error',1);
class CLS_MENUITEM{
	private $objmysql=NULL;
	public function CLS_MENUITEM(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_mnuitems` ".$where.' ORDER BY `order` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getListMenuItem($mnuid,$par_id,$level){
		$sql="SELECT * FROM `tbl_mnuitems` WHERE `par_id`='$par_id' AND `menu_id`='$mnuid' AND`isactive`='1' ";
		$objdata = new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0)
			return;
		$strspace="";
		if($level!=0){
			for($i=0;$i<$level;$i++)
				$strspace.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$strspace.="|---";
		}
		$str="";
		while($rows=$objdata->Fetch_Assoc()){
			$str.="<option onclick=\"getIDs();\" value=\"".$rows["id"]."\" >".$strspace.$rows["name"]."</option>";
			$nextlevel=$level+1;
			$str.=$this->getListMenuItem($mnuid,$rows["id"],$nextlevel);
		}
		return $str;
	}
	public function getLevelChild($parid,$level=1){
		$sql=" SELECT * FROM tbl_mnuitems WHERE id= $parid AND isactive=1 ";
		$objdata = new CLS_MYSQL();
		$objdata->Query($sql); 
		if($objdata->Num_rows()>0){
			$number = $level++;
			$rows = $objdata->Fetch_Assoc();
			$this->getLevelChild($rows['par_id'],$number);
		}
		return $level;
	}
	public function getChildID($parid) {
		$sql = "SELECT id FROM tbl_mnuitem WHERE par_id IN ('$parid')"; 
		$this->objmysql->Query($sql);
		$ids='';
		if($this->objmysql->Num_rows()>0) {
			while($r = $this->objmysql->Fetch_Assoc()) {
				$ids.=$r[0]."','";
				$ids.=$this->getChildID($r[0]);
			}
		}
		return $ids;
	}
	public function ListMenuItem($mnuid=0,$par_id=0,$level=0,$url=''){
		$sql="SELECT * FROM `tbl_mnuitems` WHERE `par_id`='$par_id' AND `menu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		$objdata = new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows() <= 0)
			return;
		$style="";$str='';
		if($level>=1) $str.="<ul class=\"dropdown-menu\">";
		else $str="<ul class='nav navbar-nav'>";
		$i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$urllink="";
			$title = stripslashes($rows['name']);
			$name = stripslashes($rows['name']);
			if($rows['icon']!='') $name = '<i class="'.stripslashes($rows['icon']).'"></i>';
			$cls='';
			$cls.=$rows['class'];
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}
			}
			else if($rows['viewtype'] == 'article'){
				$sql = "SELECT * FROM tbl_contents WHERE isactive = 1 AND `id`='".$rows['content_id']."'";
                $this->objmysql->Query($sql);
                $row = $this->objmysql->Fetch_Assoc();

                $sql = "SELECT * FROM tbl_categories WHERE isactive = 1 AND `id`='".$rows['category_id']."'";
                $this->objmysql->Query($sql);
                $row_cate = $this->objmysql->Fetch_Assoc();
				
				$url_cat = ROOTHOST.$row_cate['code'].'/';
				$urllink = $url_cat.$row['code'].'.html';
			}
			else if($rows['viewtype'] == 'block'){
				$sql = "SELECT * FROM tbl_categories WHERE isactive = 1 AND `id`='".$rows['category_id']."'";
                $this->objmysql->Query($sql);
                $row_cate = $this->objmysql->Fetch_Assoc();
				
				$urllink = ROOTHOST.$row_cate['code'].'/';
				if(strpos($url, $urllink)!==false) $cls.=" active";
			}

			$child = $this->ListMenuItem($mnuid,$rows["id"],$level+1,$url);
			if($url == $urllink) $cls.=" active";
			$cls = $cls!=''?"class='".$cls."'":'';

			$str.="<li $cls>";
			if(!$child)
				$str.="<a href='".$urllink."' title='".$title."'><span>".$name."</span></a>";
			else {
				$str.="<a class='dropdown-toggle' role='button' aria-haspopup='true'  aria-expanded='false' href='".$urllink."' title='".$title."'><span>".$name."</span> <i class='fa fa-caret-down'></i></a>";
				$str.="<span class='bulet-dropdown'></span>";
				$str.=$child;
			}
			$str.='</li>';
		}
		$str.='</ul>';
		return $str;
	}

	public function ListMenuFooter($mnuid=0,$par_id=0,$level=0){
		$sql="SELECT * FROM `tbl_mnuitems` WHERE `par_id`='$par_id' AND `menu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0)
			return;
		$style="";$str='';
		if($level>=1) $str.="<ul class=\"dropdown-menu\">";
		else {
			$str="
			<ul>";
			}
			$i=0;
			while($rows=$objdata->Fetch_Assoc()){
				$urllink="";
				if($rows['viewtype']=='link'){
					if(trim($rows['link'])!=''){
						$urllink=$rows['link'];
					}else{
						$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["id"].".html";
					}
				}
				else if($rows['viewtype']=='article'){
					$sql = "SELECT * FROM tbl_contents WHERE isactive = 1 AND `id`='".$rows['content_id']."'";
					$this->objmysql->Query($sql);
					$row = $this->objmysql->Fetch_Assoc();
					$urllink = ROOTHOST.LINK_NEWS.'/'.$row['code'].'.html';
				}
				else if($rows['viewtype']=='block'){
					$sql = "SELECT * FROM tbl_categories WHERE isactive = 1 AND `id`='".$rows['category_id']."'";
					$this->objmysql->Query($sql);
					$row_cate = $this->objmysql->Fetch_Assoc();
					$urllink = ROOTHOST.LINK_NEWS.'/'.$row_cate['code'].'/';
				}

				$cls = '';
				$cls.= $rows['class'];
				$child = $this->ListMenuFooter($mnuid,$rows["id"],$level+1);
				$cls = $cls != '' ? "class='".$cls."'" : '';

				$str.= "<li $cls>";
				if(!$child)
					$str.= "<a href='".$urllink."' title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
				else {
					$str.= "<a class='dropdown-toggle' role='button' aria-haspopup='true'  aria-expanded='false' href='".$urllink."' title='".$rows['name']."'><span>".$rows["name"]."</span><span class='arrow_down'></span></a>";
					$str.= "<span class='bulet-dropdown'></span>";
					$str.= $child;
				}
				$str.= '</li>';
			}
			$str.='
		</ul>';
		return $str;
	}
}
?>