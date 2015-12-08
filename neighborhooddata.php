<?php
include("connect.php");
$neighborhood = $_POST['neighborhood'];
$crime_rate_query = "SELECT * from crime_rates_2010 WHERE neighborhood = '$neighborhood'";
//echo $query_string;
$res = $mysqli->query($crime_rate_query);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
while ($row = $res->fetch_assoc()) {
	echo $row;
}
?>