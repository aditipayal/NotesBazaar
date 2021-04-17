<?php 
session_start();
$con = mysqli_connect("localhost:3307","root","","adminusers");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/Notes app/');
define('SITE_PATH','http://127.0.0.1/php/Notes app/');
define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'/media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'/media/product/');
?>