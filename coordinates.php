<?php
include("connect.php");
$res = $mysqli->query("SELECT latitude, longitude FROM crimes LIMIT 50");
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
while ($row = $res->fetch_assoc()) {
	array_push($rows, $row);
}
echo json_encode($rows);
?>