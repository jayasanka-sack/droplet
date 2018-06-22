<?php
include "../../../../../../config/connection.php";
include "../../../../../../config/functions.php";
header('Content-Type: application/json');

$data = array();
$usageData = array();
$deviceId = $_GET['id'];

$limit = 7;
$arr = array();
$newArr = array(0,0,0,0,0,0,0);
for ($i = 7; $i >= 0; $i--) {
    array_push($arr,date("d", strtotime($i . " days ago")));
}
$result = $con->query("SELECT DAY(time) AS day, SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' AND DATE_SUB(CURDATE(),INTERVAL {$limit} DAY) <= time GROUP BY day ORDER BY day");
while($r = mysqli_fetch_assoc($result)){
    $newArr[array_search($r['day'], $arr)] = $r['data'];
}
for($i = 0; $i <= 7; $i++){
    $usage = array();
    $usage['day'] = $arr[$i];
    $usage['usage'] = intval($newArr[$i]);
    $usageData[] = $usage;
}
$data["id"] = $deviceId;
$data["days"] = $usageData;
echo json_encode($data,JSON_PRETTY_PRINT);
http_response_code(200);