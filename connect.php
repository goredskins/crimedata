<?php
include("secret.php");
$mysqli = new mysqli("stardock.cs.virginia.edu", "cs4750nkt7hr", "fall2015", "cs4750nkt7hr", 3306);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";
?>