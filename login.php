<?php
$host = "localhost";
$username="root"; // Mysql username 
$password=""; // Mysql password
$db= "7line"; // Database name

	$user_check = $_SESSION['loggedin_user'];
	
	$query = 	"UPDATE users 
				SET last_active = NOW()
				WHERE username = '$user_check'";
	
	mysql_query($query);
	
	header("Location: user_home.php");
	die();

?>