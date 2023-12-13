<?php
header ('Content-type: text/html; charset=utf-8');
ob_start();
// สรอ. OpenID Provider
$OpenIdProviderUrl = 'http://testopenid.ega.or.th/';  
//หน้าที่จะให้ส่งกลับ
$eServiceUrl = "http://127.0.0.1:8090/OpenID/"; 
include "common.php";


// include files
require_once "Auth/OpenID/Consumer.php";
require_once "Auth/OpenID/FileStore.php";
require_once "Auth/OpenID/AX.php";  
  
session_start();

// สร้าง file ไว้เก็บค่า OpenID 
$store = new Auth_OpenID_FileStore('./oid_store');  

// create OpenID consumer
$consumer = new Auth_OpenID_Consumer($store);    
  
// เริ่มต้นทำ Single Sign On
// เริ่มสร้าง OpenID Request
$auth = $consumer->begin($OpenIdProviderUrl);	
if (!$auth) {
	die("ERROR: Please enter a valid OpenID.");
}  

//ค่าที่ต้องการได้คืนมา
// วิธีใช้:  make($type_uri, $count=1, $required=false, $alias=null)
$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://axschema.org/contact/email', 1, 1, 'alias1');
$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://axschema.org/namePerson', 1, 1, 'alias2');
$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://axschema.org/namePerson/friendly', 1, 1, 'alias3');
$attribute[] = Auth_OpenID_AX_AttrInfo::make('http://www.egov.go.th/2012/identifier/citizenid', 1, 1, 'alias4');

// Create AX fetch request
$ax = new Auth_OpenID_AX_FetchRequest; 
if (!$ax) {
    die("ERROR: Unable to build AX");
}
// เพิ่ม attributes to AX fetch request
foreach($attribute as $attr){
    $ax->add($attr);
}

//เพิ่ม AX เข้าไปใน OpenID Request
$auth->addExtension($ax);

//ส่ง openID request
$url = $auth->redirectURL($eServiceUrl, $eServiceUrl.'oid_return.php');
//echo $url."x";
header('Location: ' . $url);

?>    
