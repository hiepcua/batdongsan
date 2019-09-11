<?php
ini_set('display_errors',1);
include_once('../global/libs/gfinit.php');
require_once('../global/libs/gfconfig.php');
include_once('libs/cls.mysql.php');
include_once('libs/cls.category.php');
include_once('libs/cls.contents.php');
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
$objcat=new CLS_CATEGORY;
$objcat->getList();
while($r=$objcat->Fetch_Assoc()){
	$count++;
	$link=ROOTHOST.$r['code'].'/';
	$data.='<url>';
	$data.='<loc>'.$link.'</loc>';
	$data.='<changefreq>daily</changefreq>';
	$data.="</url>\n";
}
//----------CREAT SITE MAP FOR CONTENT---------------/
$objcon=new CLS_CONTENTS;
$objcon->getList(' ', 'ORDER BY `id` ASC');
while($r=$objcon->Fetch_Assoc()){
	$count++;
	$link=ROOTHOST.$r['code'].'.html';
	$name=$r['meta_desc']!=''?$r['meta_desc']:$r['title'];
	$data.='<url>';
	$data.='<loc>'.$link;
	/*$data.='<news:news>
			  <news:publication>
				<news:name>'.$name.'</news:name>
				<news:language>vi</news:language>
			  </news:publication>
			  <news:genres>Press release, blog</news:genres>
			  <news:publication_date>'.date("Y-m-d",strtotime($r['cdate'])).'</news:publication_date>
			  <news:title>'.$r['title'].'</news:title>
			  <news:keywords>'.$r['meta_key'].'</news:keywords>
			</news:news>';*/
	$data.='</loc>';
	$data.='<changefreq>never</changefreq>';
	$data.="</url>\n";
}

$data.='</urlset>';
echo "<p align='center'><h3>Create sitemap.xml success! </h3><h4>Update: $count links</h4></p>";
file_put_contents("../sitemap.xml",$data);
?>