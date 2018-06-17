<?php
include "../../config/connection.php";
$res = $con->query("SELECT * FROM device");
$data = array();
$devices = array();
while ($device = mysqli_fetch_assoc($res)){
    $devices[] = $device;
}
http_response_code(200);
$data["devices"] = $devices;
echo json_encode($data,JSON_PRETTY_PRINT);
