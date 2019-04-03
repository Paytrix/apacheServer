<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: application/json');

$mysqli = new mysqli("localhost", "pi", "raspberry", "smartone");
if($mysqli->connect_errno){
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$getRuecklauf = $mysqli->query("SELECT value,date FROM RuecklauftemperaturSolar WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getRuecklauf->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = null;
    $dataRuecklauf[] = [$time, $value];
}

$getVorlauf = $mysqli->query("SELECT value,date FROM VorlauftemperaturSolar WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getVorlauf->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = null;
    $dataVorlauf[] = [$time, $value];
}

$getPV1 = $mysqli->query("SELECT value,date FROM PV1 WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getPV1->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = null;
    $dataPV1[] = [$time, $value];
}

$getPV2 = $mysqli->query("SELECT value,date FROM PV2 WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getPV2->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = null;
    $dataPV2[] = [$time, $value];
}

$response = array (
    'results' => 
      array (
        $dataRuecklauf,
        $dataVorlauf,
        $dataPV1,
        $dataPV2
      )
  );
echo json_encode($response);