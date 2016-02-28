<?php
	$host = "localhost";
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$db= "7line"; // Database name
	
	$connection = mysql_connect($host, $username, $password)or die('could not connect to database');
	$database = mysql_select_db("$db")or die("Cannot select DB");
	
	$user = $_POST['user'];
	$subject = $_POST['subject'];
	$content = $_POST['content'];
	$bd_id = $_POST['board_id'];
	
	$new_thread = "INSERT INTO threads (subject, board_id, user_create, last_update, date_created)
					VALUES ('$subject', '$bd_id', '$user', NOW(), NOW())";
					
	mysql_query($new_thread);
	
	$thread_id = mysql_insert_id();
	
	$new_post = "INSERT INTO posts (thread_id, board_id, subject, content, user_create, date_created)
				VALUES ('$thread_id', '$bd_id', '$subject', '$content', '$user', NOW())";
	mysql_query($new_post);
	
	include('session.php');
	
	$_SESSION['thread_id'] = $thread_id;
	$_SESSION['thread_subj'] = $subject;
	
	header("Location: post.php");	
	die();
?>