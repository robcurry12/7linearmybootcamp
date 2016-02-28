<?php
$host = "localhost";
$username="root"; // Mysql username 
$password=""; // Mysql password
$db= "7line"; // Database name

	$connection = mysql_connect("$host", "$username", "$password")or die("Cannot connect"); 
	$database = mysql_select_db("$db")or die("Cannot select DB");
	 
	 $user = $_POST['user'];
	 $bday = $_POST['bday'];
	 $gender = $_POST['gender'];
	 
	$update = 	"UPDATE users 
				SET birthday = '$bday', gender = '$gender' 
				WHERE username = '$user'";
				
	mysql_query($update);
	
?>