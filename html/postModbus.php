<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: application/json');

include "/home/pi/reactServer/energymanagementserver/src/php_code/modbusSendData.php";

$json_str = file_get_contents('php://input');
var_dump ($json_str);