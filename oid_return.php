<?php

//  oid_return.php

// Includes required files
require_once "Auth/OpenID/Consumer.php";
require_once "Auth/OpenID/FileStore.php";
require_once "Auth/OpenID/AX.php";

session_start();

// สร้าง file ไว้เก็บค่า OpenID 
$store = new Auth_OpenID_FileStore('./oid_store');

// สร้าง OpenID consumer
$consumer = new Auth_OpenID_Consumer($store);

// ตรวจสอบค่าที่ได้รับมา (input เป็น URL ที่ให้ Server ส่งค่ากลับมา)
$response = $consumer->complete('http://127.0.0.1:8090/OpenID/oid_return.php');


if ($response->status == Auth_OpenID_SUCCESS) {
    // Get registration informations
    $ax = new Auth_OpenID_AX_FetchResponse();
    $obj = $ax->fromSuccessResponse($response);

    // Print me raw
    echo '<pre>';
    print_r($obj->data);
    echo '</pre>';
    exit;
} 
if ($response->status == Auth_OpenID_CANCEL) {
	echo 'ผู้ใช้ยกเลิก';
}
if ($response->status == Auth_OpenID_FAILURE) {
	echo 'Login ล้มเหลว';
}
else {
  echo 'Unknow Error';
}

