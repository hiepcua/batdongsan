<?php
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
	$isSecure = true;
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	$isSecure = true;
}
$REQUEST_PROTOCOL = $isSecure ? 'https://' : 'http://';

// define('ROOTHOST',$REQUEST_PROTOCOL.$_SERVER['HTTP_HOST'].'/mydinhTHC/');
define('ROOTHOST','http://localhost/batdongsan/');
define('ROOTHOST_ADMIN',ROOTHOST.'admin/');
define('WEBSITE',$REQUEST_PROTOCOL.$_SERVER['HTTP_HOST'].'/batdongsan/');
define('BASEVIRTUAL0',ROOTHOST.'images/');
define('IMG_DEFAULT','imgs/no-image.png');
define('THUMB_DEFAULT','imgs/no-image.png');
define('PATH_GALLERY','images/gallery/');
define('PATH_GALLERY_REVIEW','images/gallery/');
define('UPLOAD_PATH',$_SERVER['DOCUMENT_ROOT'].'/batdongsan/');

define('APP_ID','1663061363962371');
define('APP_SECRET','dd0b6d3fb803ca2a51601145a74fd9a8');

define('ROOT_PATH',''); 
define('TEM_PATH',ROOT_PATH.'templates/');
define('COM_PATH',ROOT_PATH.'components/');
define('MOD_PATH',ROOT_PATH.'modules/');
define('INC_PATH',ROOT_PATH.'includes/');
define('LAG_PATH',ROOT_PATH.'languages/');
define('EXT_PATH',ROOT_PATH.'extensions/');
define('EDI_PATH',EXT_PATH.'editor/');
define('DOC_PATH',ROOT_PATH.'documents/');
define('DAT_PATH',ROOT_PATH.'databases/');
define('IMG_PATH',ROOT_PATH.'images/');
define('MED_PATH',ROOT_PATH.'media/');
define('LIB_PATH',ROOT_PATH.'libs/');
define('JSC_PATH',ROOT_PATH.'js/');
define('LOG_PATH',ROOT_PATH.'logs/');

define('MAX_ROWS','20');
define('MAX_ROWS_ADMIN','10');
define('TIMEOUT_LOGIN','60');
define('URL_REWRITE','1');
define('MAX_ROWS_INDEX',40);

define('SMTP_SERVER','smtp.gmail.com');
define('SMTP_PORT','465');
define('SMTP_USER','hoangtucoc321@gmail.com');
define('SMTP_PASS','nsn2651984');
define('SMTP_MAIL','hoangtucoc321@gmail.com');
define('IGF_LICENSE','77667050813dd94a49756d59de5cea88');

define('SHOP_CODE','TD');//hàng tiêu dùng
define('SITE_NAME','seogoogle.com');
define('SITE_TITLE','');
define('SITE_DESC','');
define('SITE_KEY','');
define('COM_NAME','Copyright &copy; by IGF');
define('COM_CONTACT','Trung tâm kỹ thuật ô tô Mỹ Đình THC');
?>