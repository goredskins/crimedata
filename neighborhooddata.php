<?php
include("connect.php");
$neighborhood = $_POST['neighborhood'];
$crime_rate_query = "SELECT * from crime_rates_2010 WHERE neighborhood = '$neighborhood'";
$hospital_query = "SELECT * from hospitals WHERE neighborhood = '$neighborhood'";
$courthouse_query = "SELECT * from courthouses WHERE neighborhood = '$neighborhood'";
$homeless_query = "SELECT * from homeless_shelters WHERE neighborhood = '$neighborhood'";

$variable_codebook_query = "SELECT variable, indicator FROM variable_codebook";
$census_query = "SELECT tpop10 as tpopXX, paa10 as paaXX, pwhite10 as pwhiteXX, pasi10 as pasiXX, p2more10 as p2moreXX, ppac10 as ppacXX, phisp10 as phispXX, racdiv10 as racdivXX, mhhi12 as mhhiXX, hh25inc12 as hh25incXX, hh40inc12 as hh40incXX, hh60inc12 as hh60incXX, hh75inc12 as hh75incXX, hhm7512 as hhm75XX, hhpov12 as hhpovXX, hhchpov12 as hhcpovXX FROM census WHERE neighborhood = '$neighborhood'";

//echo $census_query;
//echo $query_string;
$res = $mysqli->query($crime_rate_query);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
$crime_rates_string = "";
while ($row = $res->fetch_assoc()) {
	$crime_rates_string .= "<p>Domestic Violence: <strong> ". $row['domvio'] . "</strong> per 1000 people</p>";
	$crime_rates_string .= "<p>Crime: <strong> ". $row['crime'] . "</strong> per 1000 people</p>";
	$crime_rates_string .= "<p>Violence: <strong> ". $row['crime'] . "</strong> per 1000 people</p>";
}


$res = $mysqli->query($hospital_query);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
$hospital_string = "";
while ($row = $res->fetch_assoc()) {
	$hospital_string .= "<p>Name: <strong> ". $row['name'] . "</strong></p>";
}

$res = $mysqli->query($courthouse_query);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
$courthouse_string = "";
while ($row = $res->fetch_assoc()) {
	$courthouse_string .= "<p>Name: <strong> ". $row['name'] . "</strong></p>";
}


$res = $mysqli->query($homeless_query);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
$homeless_string = "";
while ($row = $res->fetch_assoc()) {
	$homeless_string .= "<p>Name: <strong> ". $row['name'] . "</strong></p>";
}

$res = $mysqli->query($homeless_query);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
$homeless_string = "";
while ($row = $res->fetch_assoc()) {
	$homeless_string .= "<p>Name: <strong> ". $row['name'] . "</strong></p>";
}

$indicators = array();
$res = $mysqli->query($variable_codebook_query);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
while ($row = $res->fetch_assoc()) {
	$indicators[$row['variable']] = $row['indicator'];
}
//var_dump($indicators);
$res = $mysqli->query($census_query);
$res->data_seek(0);
//echo json_encode($res->fetch_assoc());
$rows = array();
$census_string = "";
while ($row = $res->fetch_assoc()) {
	//var_dump($row);
	foreach($row as $key => $value) {
		if(array_key_exists($key, $indicators)) {
			$indicator_desc = $indicators[$key];
			$census_string .= "<p><strong>$indicator_desc</strong>: $value</p>";
		}
	}
}

?>

<h2><?php echo $neighborhood; ?></h2>
<h4> Crime Rates </h4>
<?php echo $crime_rates_string; 
if(strlen($hospital_string) > 0) {
	echo "<h3> Hospitals </h3>";
	echo $hospital_string; 
}
else {
	echo "<h3>No Hospitals </h3>";
}
if(strlen($courthouse_string) > 0) {
	echo "<h3> Courthouses </h3>";
	echo $courthouse_string; 
}
else {
	echo "<h3>No Courthouses </h3>";
}
if(strlen($homeless_string) > 0) {
	echo "<h3> Homeless Shelters </h3>";
	echo $homeless_string; 
}
else {
	echo "<h3>No Homeless Shelters </h3>";
}
if(strlen($census_string) > 0) {
	echo "<h3> Census Data </h3>";
	echo $census_string; 
}
else {
	echo "<h3>No Census Data </h3>";
}
?>