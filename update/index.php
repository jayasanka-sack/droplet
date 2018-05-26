<?php
$data_str = file_get_contents('php://input');
$data = json_decode($data_str);
if(!property_exists($data,"deviceId")){
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
$deviceId = $data->deviceId;
$isSuccess = false;

if(property_exists($data,"rHeight")){
    $rHeight = $data->rHeight;
    if(is_numeric($rHeight)){
        $rHeight = intval($rHeight);
        $con->query("INSERT INTO level(deviceId, time, data) VALUES ('$deviceId','$date','$rHeight')");
        echo 1;
    }
}
if(property_exists($data,"usage")){
    $usage = $data->usage;
    if(is_numeric($usage)){
        $rHeight = floatval($usage);
        $isSuccess = $con->query("INSERT INTO `usage`(deviceId, time, data) VALUES ('$deviceId','$date','$usage')");
        echo 2;
    }
}
if($isSuccess){
    http_response_code(201);
}else{
    http_response_code(401);
}


