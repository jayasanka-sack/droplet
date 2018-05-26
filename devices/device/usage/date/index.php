<?php
include "../../../../config/connection.php";
include "../../../../config/functions.php";
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
$filters = "";
if(isset($_GET['date'])){
    $date = $_GET['date'];
    if(isValidDate($date)){
        $filters = " AND DATE(time) = DATE('$date')";
    }else{
        echo '{
   "error": {
      "message": "Invalid Date format",
      "type": "InvalidDateFormatException",
      "code": 104
   }
}';
        exit();
    }
}else {
    echo '{
   "error": {
      "message": "Date is missing",
      "type": "MissingFieldsException",
      "code": 104
   }   
}';
    exit();
}
$deviceId = $_GET['id'];
$result = $con->query("SELECT SUM(data) AS data FROM `usage` WHERE deviceId='$deviceId'".$filters);
if(mysqli_num_rows($result)==1){
    $r = mysqli_fetch_assoc($result);
    $usage['data'] = intval($r['data']);
}else{
    $usage['data'] = 0;
}
echo json_encode($usage,JSON_PRETTY_PRINT);

http_response_code(200);
