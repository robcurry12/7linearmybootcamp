<?php
	$user = $_POST['user'];
	$board_id = $_POST['board_id'];
	$thread_id = $_POST['thread_id'];
	$content = $_POST['content'];
	$total_posts = $_POST['total_posts'];
	
	$content = stripslashes($content);
	
	$host = "localhost";
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$db= "7line"; // Database name
	
	$connection = mysql_connect($host, $username, $password)or die('could not connect to database');
	$database = mysql_select_db("$db")or die("Cannot select DB");
	
	$new_post = "INSERT INTO posts (content, board_id, thread_id, user_create, date_created)
					VALUES ('$content', '$board_id', '$thread_id', '$user', NOW())";
			
	$post_id = mysql_insert_id();	
	$timestamp = date("Y-m-d H:i:s");
	mysql_query($new_post); 
	$page_num = ceil($total_posts / 12);

	header("Location: post.php?page=$page_num");
	die();	
?>