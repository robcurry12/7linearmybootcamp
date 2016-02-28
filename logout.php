<?php
$host = "localhost";
$username="root"; // Mysql username 
$password=""; // Mysql password
$db= "7line"; // Database name

	session_start();
	$loggedout_user = $_SESSION['loggedin_user'];
	
	$connection = mysql_connect("$host", "$username", "$password")or die("Cannot connect"); 
	$database = mysql_select_db("$db")or die("Cannot select DB");
	
	$query = 	"UPDATE users 
				SET loggedIn = 0, 
					last_active = NOW() 
				WHERE username = '$loggedout_user'";
	
	mysql_query($query);
	session_destroy();
	mysql_close($connection);
	header("Location: home.php");
	
?>