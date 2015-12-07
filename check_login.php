<?php

include("secret.php");

$global_dbh = mysql_connect($host, $username, $password)
	or die("Could not connect to database");

mysql_select_db($db)
	or die("Could not select database");


// Define $myusername and $mypassword 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM users WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
session_start();
$_SESSION['username'] = $myusername;
//session_register("mypassword"); 
$_SESSION['password'] = $mypassword;

echo $_SESSION['username'];
header("location:login_success.php");
}
else {
header("refresh:1; url=login.php");
echo "Wrong Username or Password, redirecting back to login...";
}
ob_end_flush();
?>