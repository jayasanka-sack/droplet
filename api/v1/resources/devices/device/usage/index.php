<?php
include "../../../../config/connection.php";
if (!isset($_GET['id'])) {
    echo '{
   "error": {
      "message": "ID is missing",
      "type": "InvalidRequestException",
      "code": 104
   }
}';
    http_response_code(400);
    exit();
}
http_response_code(200);
$deviceId = $_GET['id'];
$data = array();
$usages = array();
$result = $con->query("SELECT time,data FROM `usage` WHERE deviceId='$deviceId'");
while ($r = mysqli_fetch_assoc($result)){
    $usage = array();
    $usage["time"] =$r["time"];
    $usage["data"] = intval($r["data"]);
    $usages[] = $usage;
}
$data["usage_data"] = $usages;
echo json_encode($data,JSON_PRETTY_PRINT);