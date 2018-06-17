<?php
include "../../../config/connection.php";
header('Content-Type: application/json');
if(!isset($_GET['id'])){
    echo '{
   "error": {
      "message": "ID is missiong",
      "type": "InvalidRequestException",
      "code": 104
   }
}';
    http_response_code(400);
    exit();
}
$deviceId = $_GET['id'];
$res = $con->query("SELECT * FROM device WHERE deviceId='$deviceId'");
$data = array();
if(mysqli_num_rows($res)==0){
    http_response_code(204);
}else{
    while ($device = mysqli_fetch_assoc($res)){
        $data = $device;
    }
    http_response_code(200);
    echo json_encode($data,JSON_PRETTY_PRINT);
}
