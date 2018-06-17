<?php
include "../../../../../../../config/connection.php";
include "../../../../../../../config/functions.php";
header('Content-Type: application/json');
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
$result = $con->query("SELECT DAY(time) AS day, SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' AND YEAR(time)='$year' AND MONTH(time)='$month' GROUP BY day ORDER BY day".$limit);
while($r = mysqli_fetch_assoc($result)){
    $usage['day'] = $r['day'];
    $usage['usage'] = intval($r['data']);
    $usageData[] = $usage;
}
$data["id"] = $deviceId;
$data["year"] = $year;
$data["month"] = $month;
$data['days'] = $usageData;
echo json_encode($data,JSON_PRETTY_PRINT);
http_response_code(200);
