<?php
include("connect.php");
$chart_type = $_POST['chart_type'];

if($chart_type == "line") {
	$query = "SELECT YEAR(date_time) as y, MONTH(date_time) as m, DAY(date_time) as d, count(id) as crimes from crimes WHERE YEAR(date_time) != 0 GROUP BY YEAR(date_time), MONTH(date_time), DAY(date_time)";
}
else {
	$query = "SELECT race_description.description, count(id) as crimes from crimes INNER JOIN race_description on race_description.race = crimes.race GROUP BY race_description.description";
}

$res = $mysqli->query($query);
$res->data_seek(0);
$rows = array();
while ($row = $res->fetch_assoc()) {
	array_push($rows, $row);
}
echo json_encode($rows);
?>