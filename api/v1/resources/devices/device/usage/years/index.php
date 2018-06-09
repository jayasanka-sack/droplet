<?php
include "../../../../../config/connection.php";
include "../../../../../config/functions.php";
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

$data = array();
$usageData = array();
$deviceId = $_GET['id'];
$result = $con->query("SELECT YEAR(time) AS year, SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' GROUP BY year");
while($r = mysqli_fetch_assoc($result)){
    $usage['year'] = $r['year'];
    $usage['data'] = intval($r['data']);
    $usageData[] = $usage;
}
$data["id"] = $deviceId;
$data['usage_data'] = $usageData;
echo json_encode($data,JSON_PRETTY_PRINT);

http_response_code(200);
