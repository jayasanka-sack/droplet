<?php
session_start();
$_SESSION['deviceId'] = 1;
header('Location: index.php');
exit();