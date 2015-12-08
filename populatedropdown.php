<?php
include("connect.php");
$table = "crime_rates_2010";
$query_string = "SELECT neighborhood from crime_rates_2010";
//echo $query_string;
$res = $mysqli->query($query_string);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
echo "<select id = 'select-hood'>";
$rows = array();
while ($row = $res->fetch_assoc()) {
	$value = $row['neighborhood'];
	if($value == "Oldtown/Middle East") {	
		echo "<option value='$value' selected> $value </option>";
	}
	else echo "<option value='$value'> $value </option>";
}
echo "</select>";
//echo json_encode($rows);
?>