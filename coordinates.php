<?php
include("connect.php");
$limit = 500;
if(isset($_POST['limit'])) {
	$limit = $_POST['limit'];
}
$res = $mysqli->query("SELECT latitude, longitude FROM crimes WHERE latitude IS NOT NULL AND longitude IS NOT NULL LIMIT $limit");
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
while ($row = $res->fetch_assoc()) {
	array_push($rows, $row);
}
echo json_encode($rows);
?>