<?php
$host = "localhost";
$username="root"; // Mysql username 
$password=""; // Mysql password
$db= "7line"; // Database name

	$connection = mysql_connect("$host", "$username", "$password")or die("Cannot connect"); 
	$database = mysql_select_db("$db")or die("Cannot select DB");
	 
	session_start();
	
	$user_check = $_SESSION['loggedin_user'];						//Storing the username
	
	$ses_query = mysql_query("SELECT username						
					FROM users
					WHERE username = '$user_check'");		//Checking to see if username exists in DB
	
					
	$row = mysql_fetch_assoc($ses_query);
	$user_session = $row['username'];						//Used for displaying username
					
	if(!isset($user_session))
	{
		mysql_close($connection);
		header('Location: home.php'); 
	}
	else 
	{
		$last_active = 	"UPDATE users 
						SET last_active = NOW(), loggedIn = 1
						WHERE username = '$user_session'";
					
		mysql_query($last_active);
	}   
	
?>