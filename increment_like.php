<?php
	$host = "localhost";
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$db= "7line"; // Database name
	
	$connection = mysqli_connect($host, $username, $password, $db)or die('could not connect to database');
	$database = mysqli_select_db($connection, $db)or die("Cannot select DB");
	
	$user = $_POST['user'];
	$post_id = $_POST['post_id'];
	$increment = $_POST['like_count'];	
	$post_user = $_POST['post_user'];
	
	$add_like = "INSERT INTO likes (post_id, user, post_user, time_liked)
				VALUES ('$post_id', '$user', '$post_user', NOW())";
				
	$like_success = mysqli_query($connection, $add_like);
	//Add disliking feature
	
	if($like_success == false)
	{
		$delete_like = "DELETE FROM likes
						WHERE post_id = '$post_id' AND user = '$user'";
		
		mysqli_query($connection, $delete_like);
	}
	
	$increment_query = "SELECT COUNT(*) AS likes
					FROM likes
    				WHERE post_id = '$post_id'";
					
    $increment_result = mysqli_query($connection, $increment_query);
	$increment_array = mysqli_fetch_assoc($increment_result);
	$increment = $increment_array['likes'];
	
	die($increment);

?>