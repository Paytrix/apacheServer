<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: *');

include "/home/pi/reactServer/energymanagementserver/src/php_code/modbusSendData.php";
ini_set("allow_url_fopen", true);
ini_set("short_open_tag",true);

$json_str = file_get_contents('php://input');
$json_array = json_decode($json_str, true);
switch ($json_array['postdata']) {
    case false:
        $json_array['postdata'] = array(false);
        break;
    case true:
        $json_array['postdata'] = array(true);
        break;
    default:
        $json_array['postdata'] = array(false);
    break;
}
if($json_array['postdata'])
    sendModbusData($json_array['slaveID'],$json_array['register'],$json_array['postdata']);
var_dump ($json_array['slaveID'],$json_array['register'],$json_array['postdata']);

