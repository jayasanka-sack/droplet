<?php
include "../../../../../../config/connection.php";
include "../../../../../../config/functions.php";
if (!isset($_GET['id']) || !isset($_GET['year'])) {
    echo '{
   "error": {
      "message": "ID or year is missing",
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
$limit = (isset($_GET['limit']))?" LIMIT ".intval($_GET['limit']):"";
$result = $con->query("SELECT MONTH(time) AS month, SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' AND YEAR(time)='$year' GROUP BY month ORDER BY month".$limit);
while($r = mysqli_fetch_assoc($result)){
    $usage['month'] = $r['month'];
    $usage['usage'] = intval($r['data']);
    $usageData[] = $usage;
}
$data["id"] = $deviceId;
$data["year"] = $year;
$data['years'] = $usageData;
echo json_encode($data,JSON_PRETTY_PRINT);
http_response_code(200);
