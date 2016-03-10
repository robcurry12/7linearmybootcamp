<?php
	$host = "localhost";
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$db= "7line"; // Database name
	
	$connection = mysql_connect($host, $username, $password)or die('could not connect to database');
	$database = mysql_select_db("$db")or die("Cannot select DB");
	
	$user = $_POST['user'];
	$post_id = $_POST['post_id'];
	$increment = $_POST['like_count'];	
	
	$add_like = "INSERT INTO likes (post_id, user)
				VALUES ('$post_id', '$user')";
				
	$like_success = mysql_query($add_like);
	
	$increment_query = "SELECT COUNT(*) AS likes
					FROM likes
    				WHERE post_id = '$post_id'";
					
    $increment_result = mysql_query($increment_query);
	$increment_array = mysql_fetch_assoc($increment_result);
	$increment = $increment_array['likes'];
	
	die($increment);

?>