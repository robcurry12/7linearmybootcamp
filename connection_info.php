<?php
$host = "localhost";
$username="root"; // Mysql username 
$password=""; // Mysql password
$db= "7line"; // Database name

	$connection = mysqli_connect("$host", "$username", "$password", "$db")or die("Cannot connect"); 
	$database = mysqli_select_db($connection,$db)or die("Cannot select DB");
?>