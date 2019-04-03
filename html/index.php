<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: application/json');

include "/home/pi/reactServer/energymanagementserver/src/php_code/modbusGetData.php";

$response = array (
  'results' => 
    array (
        'SmartOneRaumtemperatur' => array (
            getModbusData(1,20000,2)
        ),
        'SmartOnePv1' => array (
            getModbusData(1,20100,2)
        ),
        'PuffertemperaturOben' => array (
            getModbusData(2,20000,2,"°C")
        ),
        'PuffertemperaturMitteOben' => array (
            getModbusData(2,20002,2,"°C")
        ),
        'PuffertemperaturMitte' => array (
            getModbusData(2,20004,2,"°C")
        ),
        'PuffertemperaturMitteUnten' => array (
            getModbusData(2,20006,2,"°C")
        ),
        'PuffertemperaturUnten' => array (
            getModbusData(2,20008,2,"°C")
        ),
        'Waermepumpenzaehler' => array (
            getModbusData(2,20010,2,"kW")
        ),
        'Raumtemperatur' => array(
            getModbusData(2,20024,2,"°C")
        ),
        'GesThermEnergie' => array (
            getModbusData(2,20030,2)
        ),
        'RuecklauftempSolar' => array (
            getModbusData(2,20028,2,"°C")
        ),
    )
);
echo json_encode($response);
