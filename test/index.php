<?php
if(!isset($_GET['id'])){
    echo '{
   "error": {
      "message": "ID is missiong",
      "type": "InvalidRequestException",
      "code": 104
   }
}';
    exit();
}

date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d H:i:s");
foreach ($_GET as $key => $value) {
    $date .= " ".$key." = ".$value;
    }
    $date.=" \n ";
$myfile = file_put_contents('testData.txt', $date.PHP_EOL , FILE_APPEND | LOCK_EX);

echo '{"message":"success"}';