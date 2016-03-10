<?php
$host = "localhost";
$username="root"; // Mysql username 
$password=""; // Mysql password
$db= "7line"; // Database name

//check if user exists in db already
if(isset($_POST["username"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die("He's dead Jim");
	}
	
	//try connect to db
	$connection = mysql_connect($host, $username, $password)or die('could not connect to database');
	$database = mysql_select_db("$db")or die("Cannot select DB");
	
	//trim and lowercase username
	$newuser =  strtolower(trim($_POST["username"])); 
	
	//sanitize username
	$newuser = filter_var($newuser, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check username in db
	$query = 	"SELECT username 
				FROM users 
				WHERE username = '$newuser'";
				
	$results = mysql_query($query);
	
	//return total count
	$user_exist = mysql_num_rows($results); //total records
	
	//if value is more than 0, username is not available
	if($user_exist == 1) 
	{
		die("<img src='images/not-available.png'/> Username not available");
	}
	else
	{
		die("<img src='images/available.png' /> Username available");
	}
	
	//close db connection
	mysql_close($connection);
}

//check if email exists in db already
if(isset($_POST["email"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die("He's dead Jim");
	}
	
	//try connect to db
	$connection = mysql_connect($host, $username, $password)or die('could not connect to database');
	$database = mysql_select_db("$db")or die("Cannot select DB");
	
	//trim and lowercase username
	$newemail =  strtolower(trim($_POST["email"])); 
	
	//sanitize username
	$newemail = filter_var($newemail, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check username in db
	$query = 	"SELECT email 
				FROM users 
				WHERE email = '$newemail'";
				
	$results = mysql_query($query);
	
	//return total count
	$email_exist = mysql_num_rows($results); //total records
	
	//if value is more than 0, username is not available
	if($email_exist >= 1) 
	{
		die("<img src='images/not-available.png'/> Email already in use");
	}
	else
	{
		die("<img src='images/available.png'/> Email available");
	}
	
	//close db connection
	mysql_close($connection);
}


//Signing in to make sure user exists before signing them in
//SIGNING IN FUNCTION IN HERE
if(isset($_POST['user_sign']) && isset($_POST['pass_sign']))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die("He's dead Jim");
	}
	
	//try connect to db
	$connection = mysql_connect($host, $username, $password)or die('could not connect to database');
	$database = mysql_select_db("$db")or die("Cannot select DB");

	$user_sign = $_POST['user_sign'];
	$pass_sign = $_POST['pass_sign'];
	
	//sanitize username
	$user_sign = filter_var($user_sign, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$pass_sign = filter_var($pass_sign, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	$pass_sign = md5($pass_sign);
	
	//check username in db
	$query = 	"SELECT username 
				FROM users 
				WHERE username = '$user_sign' AND password = '$pass_sign' ";
		
	$results = mysql_query($query);
	
	//return total count
	$profile_exist = mysql_num_rows($results); //total records

	//if value is more than 0, username is not available
	if($profile_exist == 1) 
	{
		session_start();
		$_SESSION['loggedin_user'] = $user_sign;
		die("");
	}
	else
	{
		mysql_close($connection);
		die("Invalid username and/or password!");
	}
}
?>
