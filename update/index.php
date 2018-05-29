<?php
if(!isset($_GET['deviceId'])){
    echo '{
   "error": {
      "message": "ID is missiong",
      "type": "InvalidRequestException",
      "code": 104
   }
}';
    http_response_code(401);
    exit();
}
include '../config/connection.php';
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d H:i:s");
$deviceId = $_GET['deviceId'];
$isSuccess = false;

if(isset($_GET['rHeight'])){
    $rHeight = $_GET['rHeight'];
    if(is_numeric($rHeight)){
        $rHeight = intval($rHeight);
        $con->query("INSERT INTO level(deviceId, time, data) VALUES ('$deviceId','$date','$rHeight')");
    }
}
if(isset($_GET['usage'])){
    $usage = $_GET['usage'];
    if(is_numeric($usage)){
        $rHeight = floatval($usage);
        $isSuccess = $con->query("INSERT INTO `usage`(deviceId, time, data) VALUES ('$deviceId','$date','$usage')");
    }
}
if($isSuccess){
    http_response_code(201);
}else{
    http_response_code(401);
}


