<?php
	//Finds file extension
	function getExtension($str) 
	{
         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
	}
	
	$user = $_POST['user'];
	
	$userpic = $user.".jpg";
	
	
	$tmp_name = $_FILES['file1']['tmp_name'];
	$path = getcwd() . DIRECTORY_SEPARATOR . 'profile_pics';
	$name = $path . DIRECTORY_SEPARATOR . $userpic;
	$success = move_uploaded_file($tmp_name, $name);
	
	$width = 200;
	$height = 200;
	
	list($width_orig, $height_orig) = getimagesize($name);
	$ratio_orig = $width_orig/$height_orig;

	if ($width/$height > $ratio_orig) 
	{
   		$width = $height*$ratio_orig;
	} 
	else 
	{
   		$height = $width/$ratio_orig;
	}

	// Resample
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($name);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	imagejpeg($image_p, $name, 100);
	
	
	$host = "localhost";
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$db= "7line"; // Database name
	$connection = mysql_connect("$host", "$username", "$password")or die("Cannot connect"); 
	$database = mysql_select_db("$db")or die("Cannot select DB");
	 
	$update = 	"UPDATE users 
				SET image = '$userpic' 
				WHERE username = '$user'";	
	
	mysql_query($update);
	
	header('Location: user_home.php');
	die();	 
?>