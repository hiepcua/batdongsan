<?php
class CLS_CONFIG{
    private $pro=array(
        'Id'=>1,
        'Title'=>'',
        'Meta_key'=>'',
        'Meta_desc'=>'',
        'Logo'=>'',
        'Img'=>'',

        /*company*/
        'CompanyName'=>'',
        'Phone'=>'',
        'Tel'=>'',
        'Fax'=>'',
        'Email'=>'',
        'Address'=>'',
        'Skype1'=>'',
        'Skype2'=>'',

        'Contact'=>'',
        'Footer'=>'',
        'Twitter'=>'',
        'Gplus'=>'',
        'Facebook'=>'',
        'Youtube'=>'',
        'Nich_yahoo'=>'',
        'Name_yahoo'=>''
    );
    private $objmysql=null;
    public function CLS_CONFIG(){
        $this->objmysql = new CLS_MYSQL;
        $this->objmysql->Query("SELECT * FROM tbl_configsite");
        $row = $this->objmysql->Fetch_Assoc();
        $this->Title        = ($row['title']!="")?$row['title']:SITE_TITLE;
        $this->Meta_desc    = ($row['meta_descript']!="")?$row['meta_descript']:SITE_DESC;
        $this->Meta_key     = ($row['meta_keyword']!="")?$row['meta_keyword']:SITE_KEY;
        $this->Contact      = ($row['contact']!="")?$row['contact']:COM_CONTACT;
        $this->Footer       = $row['footer'];
        $this->Address      = $row['address'];
        $this->Email        = $row['email'];
        $this->CompanyName  = $row['company_name'];
        $this->Phone        = $row['phone'];
        $this->Tel          = $row['tel'];
        $this->Skype1       = $row['skype1'];
        $this->Skype2       = $row['skype2'];
        $this->Fax          = $row['fax'];
        $this->Nich_yahoo   = $row['nick_yahoo'];
        $this->Name_yahoo   = $row['name_yahoo'];
        $this->Logo         = $row['logo'];
        $this->Twitter      = $row['twitter'];
        $this->Facebook     = $row['facebook'];
        $this->Gplus        = $row['gplus'];
        $this->Youtube      = $row['youtube'];
        $this->Img          = '';
    }
    // property set value
    function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo "Error set: $proname không phải là thành viên của class configsite"; return;
        }
        $this->pro[$proname]=$value;
    }
    function __get($proname){
        if(!isset($this->pro[$proname])){
            echo ("Error get:$proname không phải là thành viên của class configsite" ); return;
        }
        return $this->pro[$proname];
    }
    public function getList($where=''){
        $sql="SELECT * FROM `tbl_configsite` where 1=1 ".$where;
        // echo $sql;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }

    public function load_config(){
        $com        = isset($_GET['com']) ? addslashes($_GET['com']) : '';
        $viewtype   = isset($_GET['viewtype']) ? addslashes($_GET['viewtype']) : '';
        $code       = isset($_GET['code']) ? addslashes($_GET['code']) : '';

        if($com=='contents'):
            if($viewtype == 'detail'){
                $sql = "SELECT * FROM tbl_contents WHERE isactive = 1 AND `code`='".$code."'";
                $objmysql->Query($sql);
                $r_con = $objmysql->Fetch_Assoc();

                if($r_con['meta_title']!='')
                    $this->Title    = stripslashes($r_con['meta_title']);
                else
                    $this->Title    = stripslashes($r_con['title']);
                $this->Img          = stripslashes($r_con['thumb']);
                $this->Meta_key     = stripslashes($r_con['meta_key']);
                $this->Meta_desc    = stripslashes($r_con['meta_desc']);
            }
			if($viewtype=='tag'){
                $sql = "SELECT * FROM tbl_tags WHERE isactive = 1 AND `code`='".$code."'";
                $objmysql->Query($sql);
                $r_con = $objmysql->Fetch_Assoc();

                if($r_con['meta_title'] != '')
                    $this->Title    = stripslashes($r_con['meta_title']);
                else
                    $this->Title    = stripslashes($r_con['title']);
                // $this->Img          = stripslashes($r_con['thumb']);
                // $this->Meta_key     = stripslashes($r_con['meta_key']);
                $this->Meta_desc    = stripslashes($r_con['meta_desc']);
            }
            elseif($viewtype == 'search'){
                $key = '';
                if(isset($_GET['keyword']))
                    $key = $_GET['keyword'];
                $this->Title        = "Tìm kiếm sản phẩm với từ khóa \"$key\"";
                $this->Meta_desc    = "";
            }else{}
        endif;
    }
}
?>