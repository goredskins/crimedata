<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
session_start();
var_dump($_SESSION);
echo $_SESSION['username'];
$bool = isset($_SESSION['username']);
echo $bool;
var_dump($bool);
if($bool) {
	header("location:index.php");
}
else {
	header("location:login.php");
}
?>

<html>
<body>
Login Successful
</body>
</html>