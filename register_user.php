<?php
include("connect.php");
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($mysqli->query($insert_query) === TRUE) {
    echo "New record created successfully";
    header("location:login.php");
} else {
    echo "Error: " . $insert_query . "<br>" . $mysqli->error;
}
?>