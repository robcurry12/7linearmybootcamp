<?php
	$host = "localhost";
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$db= "7line"; // Database name
	
	$connection = mysqli_connect($host, $username, $password, $db)or die('could not connect to database');
	$database = mysqli_select_db($connection, $db)or die("Cannot select DB");

	$user = $_POST['user'];
	$reported_user = $_POST['reported_user'];
	$reported_content = $_POST['reported_content'];
	$thread_id = $_POST['thread_id'];
	$post_id = $_POST['post_id'];
	$board_id = $_POST['board_id'];
	$reason = $_POST['reason'];
	
	$send_report = "INSERT INTO reports (reported_by, reported_user, reported_content, thread_id, post_id, date_reported, reason)
					VALUES ('$user', '$reported_user', '$reported_content', '$thread_id', '$post_id', NOW(), '$reason')";
	
	mysqli_query($connection, $send_report);
?>