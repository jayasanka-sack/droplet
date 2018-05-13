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

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $date.'\n');
fclose($myfile);
