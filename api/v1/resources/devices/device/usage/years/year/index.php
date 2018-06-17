<?php
include "../../../../../../config/connection.php";
include "../../../../../../config/functions.php";
header('Content-Type: application/json');
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
}elseif (!isset($_GET['year'])){
    echo '{
   "error": {
      "message": "Year is missing",
      "type": "InvalidRequestException",
      "code": 104
   }
}';
    http_response_code(400);
    exit();
}
$year = $_GET["year"];
$usage = 0;

$deviceId = $_GET['id'];
$result = $con->query("SELECT YEAR(time) AS year, SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' AND YEAR(time) = '$year' GROUP BY year");
if(mysqli_num_rows($result) ==1){
    $r = mysqli_fetch_assoc($result);
    $usage = intval($r["data"]);
}
$data["id"] = $deviceId;
$data["year"] = $year;
$data["usage"] = $usage;
echo json_encode($data,JSON_PRETTY_PRINT);

http_response_code(200);
