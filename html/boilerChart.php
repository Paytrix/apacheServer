<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: application/json');

$mysqli = new mysqli("localhost", "pi", "raspberry", "smartone");
if($mysqli->connect_errno){
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$getTempTop = $mysqli->query("SELECT value,date FROM tempPufferOben WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getTempTop->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = "null";
    $dataTempTop[] = [$time, $value];
}

$getTempMiddleTop = $mysqli->query("SELECT value,date FROM tempPufferMitteOben WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getTempMiddleTop->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = "null";
    $dataTempMiddleTop[] = [$time, $value];
}

$getTempMiddle = $mysqli->query("SELECT value,date FROM tempPufferMitte WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getTempMiddle->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = "null";
    $dataTempMiddle[] = [$time, $value];
}

$getTempMiddleBottom = $mysqli->query("SELECT value,date FROM tempPufferMitteUnten WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getTempMiddleBottom->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = "null";
    $dataTempMiddleBottom[] = [$time, $value];
}

$getTempBottom = $mysqli->query("SELECT value,date FROM tempPufferUnten WHERE DATE(date) = CURDATE() ORDER BY date");
while($row = $getTempBottom->fetch_array()){
    $time = strtotime($row["date"])*1000;
    $value = floatval(number_format($row["value"],1));
    if($value == 0.0)
        $value = "null";
    $dataTempBottom[] = [$time, $value];
}

$response = array (
    'results' => 
      array (
          $dataTempTop,
          $dataTempMiddleTop,
          $dataTempMiddle,
          $dataTempMiddleBottom,
          $dataTempBottom
      )
  );
echo json_encode($response);
/*
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: application/json');

$mysqli = new mysqli("localhost", "pi", "raspberry", "smartone");
if($mysqli->connect_errno){
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$getTempTop = $mysqli->query("SELECT value,HOUR(date) FROM tempPufferOben WHERE DATE(date) = CURDATE() GROUP BY HOUR(date)");
while($row = $getTempTop->fetch_array()){
    $time = $row["HOUR(date)"];
    $value = number_format($row["value"],1);
    if($value == "0.0")
        $value = "null";
    $dataTempTop[] = $value;
}

$getTempMiddleTop = $mysqli->query("SELECT value,HOUR(date) FROM tempPufferMitteOben WHERE DATE(date) = CURDATE() GROUP BY HOUR(date)");
while($row = $getTempMiddleTop->fetch_array()){
    $time = $row["HOUR(date)"];
    $value = number_format($row["value"],1);
    if($value == "0.0")
        $value = "null";
    $dataTempMiddleTop[] = $value;
}

$getTempMiddle = $mysqli->query("SELECT value,HOUR(date) FROM tempPufferMitte WHERE DATE(date) = CURDATE() GROUP BY HOUR(date)");
while($row = $getTempMiddle->fetch_array()){
    $time = $row["HOUR(date)"];
    $value = number_format($row["value"],1);
    if($value == "0.0")
        $value = "null";
    $dataTempMiddle[] = $value;
}

$getTempMiddleBottom = $mysqli->query("SELECT value,HOUR(date) FROM tempPufferMitteUnten WHERE DATE(date) = CURDATE() GROUP BY HOUR(date)");
while($row = $getTempMiddleBottom->fetch_array()){
    $time = $row["HOUR(date)"];
    $value = number_format($row["value"],1);
    if($value == "0.0")
        $value = "null";
    $dataTempMiddleBottom[] = $value;
}

$getTempBottom = $mysqli->query("SELECT value,HOUR(date) FROM tempPufferUnten WHERE DATE(date) = CURDATE() GROUP BY HOUR(date)");
while($row = $getTempBottom->fetch_array()){
    $time = $row["HOUR(date)"];
    $value = number_format($row["value"],1);
    if($value == "0.0")
        $value = "null";
    $dataTempBottom[] = $value;
}

$response = array (
    'results' => 
      array (
          $dataTempTop,
          $dataTempMiddleTop,
          $dataTempMiddle,
          $dataTempMiddleBottom,
          $dataTempBottom
      )
  );
echo json_encode($response);
*/