<?php
$serverAddr = "http://localhost/droplet";
$api = "/api/v1";
function sendCurl($url){
    global $serverAddr;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_URL => $serverAddr . $url
    ));
    $result = json_decode(curl_exec($curl));
    curl_close($curl);
    return $result;
}
function isValidDate($date) {
    $valid = false;
    if(preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $zdate, $matches))
    {
        if(checkdate($matches[2], $matches[3], $matches[1]))
        {
            $valid = true;
        }
    }
    return $valid;
}
