<?php
$host = "localhost";
$username="root"; // Mysql username 
$password=""; // Mysql password
$db= "7line"; // Database name

	$reg_user = $_POST['username'];
	$reg_email = $_POST['email'];
	$reg_pass = $_POST['pass'];
	
	$reg_user = mysql_real_escape_string($reg_user);
	$reg_email = mysql_real_escape_string($reg_email);
	$reg_pass = mysql_real_escape_string($reg_pass);
	$reg_user = stripslashes($reg_user);
	$reg_email = stripslashes($reg_email);
	$reg_pass = md5($reg_pass);
	$reg_image = $reg_user.".jpg";
	
	//$players = array('MattHarvey', 'JacobDeGrom', 'NoahSyndergaard', 'Steven Matz', 'DavidWright', 'YoenisCespedes',
	//'TerryCollins', 'MikePiazza', 'TomSeaver', 'JohanSantana', 'SandyAlderson', 'The7LineArmy', 'BartoloColon', 
	//'Ruben Tejada', 'TravisdArnaud', 'LucasDuda', 'ZackWheeler');
	
	//$email_code = rand(0,1000).rand(1001,10000).str_shuffle($players[rand(0,16)]);
	//$message = "Thank you for signing up at The 7 Line Army Bootcamp! Here is your activation code!".$email_code;
	
		$connection = mysql_connect("$host", "$username", "$password")or die("Cannot connect"); 
		mysql_select_db("$db")or die("Cannot select DB");
		
		$query = 	"INSERT INTO users (username, email, password, image, last_active, date_join, loggedIN) 
					VALUES ('$reg_user', '$reg_email', '$reg_pass', '$reg_image', NOW(), CURDATE(), 1 )";		

		mysql_query($query);
		//mail($reg_email, 'Activation Code', $message);
		
		copy('images/defaultpro.jpg', 'profile_pics/'.$reg_user.'.jpg');
		
		session_start();
		$_SESSION['loggedin_user'] = $reg_user;
		exit();

?>