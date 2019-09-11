<?php 
session_start();
include_once("../global/libs/gfinit.php");
include_once("../global/libs/gfconfig.php");
include_once("../libs/cls.mysql.php");
include_once("../libs/cls.document.php");
if(isset($_POST['doc_id'])) {
	$doc_id = (int)$_POST['doc_id'];
	$objdoc = new CLS_DOCUMENT();
	$objdoc->updateDownload($doc_id);
} ?>