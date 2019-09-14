<?php
ini_set('display_errors',1);
include_once('global/libs/gfinit.php');
require_once('global/libs/gfconfig.php');
include_once('libs/cls.mysql.php');
$objmysql = new CLS_MYSQL();
$objdata  = new CLS_MYSQL();

$count=1;
$data='<?xml version="1.0" encoding="UTF-8"?>';
$data.='<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
//----------CREAT SITE MAP FOR HOME---------------/			
$data.='<url>';
$data.='<loc>'.ROOTHOST.'</loc>';
$data.='<changefreq>daily</changefreq>';
$data.="</url>\n";
//----------CREAT SITE MAP FOR CATEGORY---------------/
$sql_cate = "SELECT * FROM tbl_categories WHERE isactive = 1";
$objmysql->Query($sql_cate);
while($r = $objmysql->Fetch_Assoc()){
	$count++;
	$link = ROOTHOST.$r['code'].'/';
	$data.='<url>';
	$data.='<loc>'.$link.'</loc>';
	$data.='<changefreq>daily</changefreq>';
	$data.="</url>\n";
}
//----------CREAT SITE MAP FOR CONTENT---------------/
$sql_con = "SELECT * FROM tbl_contents WHERE isactive = 1 ORDER BY title ASC";
$objmysql->Query($sql_con);

while($r = $objmysql->Fetch_Assoc()){
	$sql_cate = "SELECT * FROM tbl_categories WHERE isactive = 1 AND id = ".$r['category_id'];
	$objdata->Query($sql_cate);
	$r_cate = $objdata->Fetch_Assoc();

	$count++;
	$link = ROOTHOST.$r_cate['code'].'/'.$r['code'].'.html';
	$data.='<url>';
	$data.='<loc>'.$link.'</loc>';
	$data.='<changefreq>never</changefreq>';
	$data.="</url>\n";
}

$data.='</urlset>';
echo "<p align='center'><h3>Create sitemap.xml success! </h3><h4>Update: $count links</h4></p>";
file_put_contents("sitemap.xml", $data);
?>