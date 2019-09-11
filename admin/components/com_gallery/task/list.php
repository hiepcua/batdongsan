<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
    define('OBJ_PAGE','GALLERY');
    $keyword='';
	if(isset($_POST['txtkeyword'])){
		$keyword=trim($_POST['txtkeyword']);
		$_SESSION['KEY_'.OBJ_PAGE]=$keyword;
	}
    $strwhere=' WHERE 1=1';
    if(isset($_POST['cbo_active']))
        $_SESSION['ACT'.OBJ_PAGE]=addslashes($_POST['cbo_active']);
    if(isset($_SESSION['KEY_'.OBJ_PAGE]) && $keyword!='')
        $keyword=$_SESSION['KEY_'.OBJ_PAGE];
    else
        $keyword='';
    $action=isset($_SESSION['ACT'.OBJ_PAGE]) ? $_SESSION['ACT'.OBJ_PAGE]:'';
    if($keyword!='')
        $strwhere.=" AND(`name` like '%$keyword%')";

    if($action!='' && $action!='all' ){
        $strwhere.=" AND `isactive` = '$action'";
    }
    $obj->getListAlbum($strwhere);
    $total_rows=$obj->Num_rows();
    $cur_page=isset($_POST['txtCurnpage'])? (int)$_POST['txtCurnpage']:'1';
?>
<script language="javascript">
  function checkinput()
  {
	  var strids=document.getElementById("txtids");
	  if(strids.value=="")
	  {
		  alert('You are select once record to action');
		  return false;
	  }
	  return true;
  }
</script>
<div class=''>
    <div class="com_header color">
        <i class="fa fa-list" aria-hidden="true"></i> Thư viện ảnh
        <div class="pull-right">
            <div id="menus" class="toolbars">
                <form id="frm_menu" name="frm_menu" method="post" action="">
                    <input type="hidden" name="txtorders" id="txtorders" />
                    <input type="hidden" name="txtids" id="txtids" />
                    <input type="hidden" name="txtaction" id="txtaction" />
                    <ul class="list-inline">
                        <li><button class="btn btn-default" onclick="dosubmitAction('frm_menu','public');"><i class="fa fa-check-circle-o cgreen" aria-hidden="true"></i> Hiển thị</button></li>
                        <li><button class="btn btn-default" onclick="dosubmitAction('frm_menu','unpublic');"><i class="fa fa-times-circle-o cred" aria-hidden="true"></i> Ẩn</button></li>
                        <li><a class="addnew btn btn-default" href="<?php echo ROOTHOST_ADMIN.COMS;?>/add" title="Thêm mới"><i class="fa fa-plus-circle cgreen" aria-hidden="true"></i> Thêm mới</a></li>
                        <li><a class="delete btn btn-default" href="#" onclick="javascript:if(confirm('Bạn có chắc chắn muốn xóa thông tin này không?')){dosubmitAction('frm_menu','delete'); }" title="Xóa"><i class="fa fa-times-circle cred" aria-hidden="true"></i> Xóa</a></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div><br>
<div class='col-md-12 user_list'>
	<div class="table-responsive">
		<table class="table table-bordered">
			<tr class="header">
			<th width="30" align="center">#</th>
			<th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
			<th width="30" align="center">Xóa</th>
			<th align="center" width="140">Hình ảnh</th>
			<th align="center">Tên album</th>
			<th align="center">Mô tả</th>
			  <td width="80" align="center">Sắp xếp
				  <a href="javascript:saveOrder()"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
			  </td>
			<th width="70" align="center">Hiện/Ẩn</th>
			<th width="30" align="center">Sửa</th>
		  </tr>
		  <?php 
		  $obj->listTable($strwhere,$cur_page);
		  ?>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
			<tr>
				<td align="center">
					<?php
					paging($total_rows,MAX_ROWS,$cur_page);
					?>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php //----------------------------------------------?>
