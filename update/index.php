<?php
if(!isset($_GET['id']) || !isset($_GET['temp']) || !isset($_GET['hum'])){
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
$date = date("Y-m-d H:i:s")." temperature = ".$_GET['temp']."C  humidity = ".$_GET['hum']." \n ";
$myfile = file_put_contents('newfile.txt', $date.PHP_EOL , FILE_APPEND | LOCK_EX);

echo '{"message":"success"}';