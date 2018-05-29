<?php
include "../../../config/connection.php";
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

date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
$deviceId = $_GET['id'];
$summery = array();
$usage = array();
$level = array();
$usage["day"] = 0;
$usage["month"] = 0;
$level["percentage"] = 0;
$level["volume"] = 0;
$usageTodayRes = $con->query("SELECT SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' AND DATE(time) = DATE('$date')");
if (mysqli_num_rows($usageTodayRes) == 1) {
    $usageTodayRow = mysqli_fetch_assoc($usageTodayRes);
    $usage["day"] = (int)$usageTodayRow["data"];
}
$usageMonthRes = $con->query("SELECT SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId' AND MONTH(time) = MONTH('$date') AND YEAR(time)= YEAR('$date')");
if (mysqli_num_rows($usageMonthRes) == 1) {
    $usageMonthRow = mysqli_fetch_assoc($usageMonthRes);
    $usage["month"] = (int)$usageMonthRow["data"];
}

$levelRes = $con->query("SELECT data FROM level WHERE deviceId='$deviceId' ORDER BY levelId DESC LIMIT 1");
if (mysqli_num_rows($levelRes) == 1) {
    $levelRow = mysqli_fetch_assoc($levelRes);
    $rHight = $levelRow["data"];
//    $serverPrefix = "http://localhost/droplet/";
    $serverPrefix = "http://139.59.81.23/apis/droplet/";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_URL => $serverPrefix . 'devices/device/?id=' . $deviceId
    ));
    $device = json_decode(curl_exec($curl));
    curl_close($curl);
    $height = ($device->height)-$rHight;
    $percentage = $height/($device->height);
    $volume = ($device->capacity)*$percentage;
    $level["percentage"] = $percentage*100;
    $level["volume"] = $volume;
}
$summery["usage"] = $usage;
$summery["level"] = $level;
echo json_encode($summery, JSON_PRETTY_PRINT);