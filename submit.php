<?php
include "secret.php";
$user = $_POST['username'];
$pw = $_POST['password'];
if($user&&$pw)
{
	
  $connect = mysql_connect($host, $username, $password) or die("Error"); 
  mysql_select_db("flashcater") or die("error");
  $result = mysql_query("SELECT * FROM users WHERE username='$user'");
  $numrows = mysql_num_rows($result);

  if($numrows!=0)
  {
	echo("Logged In as: ".$user);
	header("Location: index.html");
	exit();
  }
  else 
    die("That user doesn't exist!");

}
else
 die("ERROR");
?>