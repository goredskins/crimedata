<?php
include("connect.php");
$limit = 500;
if(isset($_POST['limit'])) {
	$limit = $_POST['limit'];
}
$table = "crimes";
if(isset($_POST['table'])) {
	$table = $_POST['table'];
}
if($table == 'crimes') {
	$query_string = "SELECT latitude, longitude FROM $table WHERE latitude IS NOT NULL AND longitude IS NOT NULL LIMIT $limit";
	$date = null;
	if(isset($_POST['date'])) {
		$date = $_POST['date'];
		$datetime1 = $_POST['date'] . " 00:00:00";
		$datetime2 = $_POST['date'] . " 23:59:59";
		$query_string = "SELECT latitude, longitude FROM $table WHERE latitude IS NOT NULL AND longitude IS NOT NULL AND date_time BETWEEN '$datetime1' AND '$datetime2' LIMIT $limit";
	}
}
else {
	$query_string = "SELECT location FROM $table";
}
//echo $query_string;
$res = $mysqli->query($query_string);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
while ($row = $res->fetch_assoc()) {
	array_push($rows, $row);
}
echo json_encode($rows);
?>