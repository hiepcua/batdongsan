<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','MNUITEM');
$keyword='';$strwhere='';$action='';
// Khai báo SESSION
if(isset($_POST['txtkeyword'])){
  $keyword=trim($_POST['txtkeyword']);
  $_SESSION['KEY_MNUITEM']=$keyword;
}
if(isset($_POST['cbo_active']))
    $_SESSION['ACT_MNUITEM']=addslashes($_POST['cbo_active']);
if(isset($_SESSION['KEY_MNUITEM']))
    $keyword=$_SESSION['KEY_MNUITEM'];
else
    $keyword='';
$action=isset($_SESSION['ACT_MNUITEM']) ? $_SESSION['ACT_MNUITEM']:'';

// Gán strwhere
if($keyword!='')
    $strwhere.=" AND ( `name` like '%$keyword%' )";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}
if($mnuid!='' && $mnuid!='all')
    $strwhere.=" AND `menu_id` = '$mnuid' ";

// Pagging
if(!isset($_SESSION['CUR_PAGE_MNUITEM']))
    $_SESSION['CUR_PAGE_MNUITEM']=1;
if(isset($_POST['txtCurnpage'])){
    $_SESSION['CUR_PAGE_MNUITEM']=(int)$_POST['txtCurnpage'];
}
$obj->getList($strwhere,'');
$total_rows=$obj->Num_rows();
// End pagging
?>
<div class="body">
    <script language="javascript">
        function checkinput(){
            var strids=document.getElementById("txtids");
            if(strids.value==""){
                alert('You are select once record to action');
                return false;
            }
            return true;
        }
    </script>
	<div class="com_header color">
		<i class="fa fa-list" aria-hidden="true"></i> Menu chi tiết
		<div class="pull-right">
			<div id="menus" class="toolbars">
				<form id="frm_menu" name="frm_menu" method="post" action="">
					<input type="hidden" name="txtorders" id="txtorders" />
					<input type="hidden" name="txtids" id="txtids" />
					<input type="hidden" name="txtaction" id="txtaction" />

					<ul class="list-inline">
						<li><a class="btn btn-default" onclick="dosubmitAction('frm_menu','public');"><i class="fa fa-check-circle-o cgreen" aria-hidden="true"></i> Hiển thị</a></li>

						<li><a class="btn btn-default" onclick="dosubmitAction('frm_menu','unpublic');"><i class="fa fa-times-circle-o cred" aria-hidden="true"></i> Ẩn</a></li>

						<li><a class="addnew btn btn-default" href="<?php echo ROOTHOST_ADMIN.COMS;?>/add" title="Thêm mới"><i class="fa fa-plus-circle cgreen" aria-hidden="true"></i> Thêm mới</a></li>

						<li><a class="delete btn btn-default" href="#" onclick="javascript:if(confirm('Bạn có chắc chắn muốn xóa thông tin này không?')){dosubmitAction('frm_menu','delete'); }" title="Xóa"><i class="fa fa-times-circle cred" aria-hidden="true"></i> Xóa</a></li>
					</ul>
				</form>
			</div>
		</div>
    </div><br>
	<div class="user_list col-md-12">
    <form id="frm_list" name="frm_list" method="post" action="">
        <div class="table-responsive">
			<table class="table table-bordered">
            <tr>
                <td><div class="col-md-6"><input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="" class="form-control"/></div>
					<input type="submit" name="button" id="button" value="Tìm kiếm" class="btn btn-primary" />
				</td>
                <td align="right">
                    <label class="col-md-6 pull-left">
					<select name="cbo_menutype" id="cbo_menutype" onchange="document.frm_list.submit();" class="form-control">
						<option value="all">Tất cả menu</option>
						<?php 
						$str=$obj_mnu->getListmenu("option");
						echo $str;
						?>
						<script language="javascript">
							cbo_Selected('cbo_menutype','<?php echo $mnuid;?>');
						</script>
					</select></label>
					<div class="col-md-6 pull-left">
                    <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();" class="form-control">
                        <option value="all">Tất cả</option>
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                        <script language="javascript">
                            cbo_Selected('cbo_active','<?php echo $action;?>');
                        </script>
                    </select></div>
                </td>
            </tr>
        </table></div>
        <div style="clear:both;height:10px;"></div>
        <div class="table-responsive">
			<table class="table table-bordered">
            <tr class="header">
                <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
                <th width="50" align="center">Parent ID</th>
                <th align="center">Tên</th>
                <th align="center">Mã</th>
                <th width="100" align="center">Kiểu hiển thị</th>
                <th width="70" style="text-align: center;">Sắp xếp
                    <a href="javascript:saveOrder()">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </a>
                </th>
                <th colspan="3"></th>
            </tr>
            <?php $obj->listTableItemMenu($strwhere,0,0); ?>
        </table></div>
    </form>
</div>
<?php //----------------------------------------------?>