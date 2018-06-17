<?php
include "../../../../../../../config/connection.php";
include "../../../../../../../config/functions.php";
if (!isset($_GET['id'])) {
    echo '{
   "error": {
      "message": "ID or year is missing",
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
$data = array();
$usageData = array();
$deviceId = $_GET['id'];
$year = $_GET['year'];
$month = $_GET["month"];

$limit = (isset($_GET['limit']))?" LIMIT ".intval($_GET['limit']):"";
$result = $con->query("SELECT DAY(time) AS date, SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' AND YEAR(time)='$year' AND MONTH(time)='$month' GROUP BY date ORDER BY date".$limit);
while($r = mysqli_fetch_assoc($result)){
    $usage['date'] = $r['date'];
    $usage['usage'] = intval($r['data']);
    $usageData[] = $usage;
}
$data["id"] = $deviceId;
$data["year"] = $year;
$data["month"] = $month;
$data['dates'] = $usageData;
echo json_encode($data,JSON_PRETTY_PRINT);
http_response_code(200);
