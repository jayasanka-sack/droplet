<?php
include "../../../../../../../config/connection.php";
include "../../../../../../../config/functions.php";
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
}elseif (!isset($_GET['month'])){
    echo '{
   "error": {
      "message": "Month is missing",
      "type": "InvalidRequestException",
      "code": 104
   }
}';
    http_response_code(400);
    exit();
}
$year = $_GET["year"];
$month = $_GET["month"];
$usage = 0;

$deviceId = $_GET['id'];
$result = $con->query("SELECT MONTH(time) AS month, SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' AND MONTH(time)='$month' AND YEAR(time) = '$year' GROUP BY month");
if(mysqli_num_rows($result) ==1){
    $r = mysqli_fetch_assoc($result);
    $usage = intval($r["data"]);
}
$data["id"] = $deviceId;
$data["year"] = $year;
$data["month"] = $month;
$data["usage"] = $usage;
echo json_encode($data,JSON_PRETTY_PRINT);

http_response_code(200);
