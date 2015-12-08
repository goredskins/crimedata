<?php
include("connect.php");
$date = $_POST['date'];
$date .= " ". "00:00:00";
$crime_code = $_POST['crime_code'];
$location = $_POST['location'];
$weapon = $_POST['weapon'];
$post = $_POST['post'];
$neighborhood = $_POST['neighborhood'];
$district = $_POST['district'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$insert_query = "INSERT INTO crimes (date_time, crime_code, location, weapon, post, neighborhood, district, latitude, longitude) VALUES ('$date', '$crime_code', '$location', '$weapon', '$post', '$neighborhood', '$distict', $latitude, $longitude)";

if ($mysqli->query($insert_query) === TRUE) {
    echo "New record created successfully";
    header("location:index.php");
} else {
    echo "Error: " . $insert_query . "<br>" . $mysqli->error;
}
?>