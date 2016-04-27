<?php
	include("session.php");
	
	$thread_id = $_GET['thread_id'];
	
	$post_query = 	"SELECT thread_id, subject, board_id,
					(SELECT board_name
					FROM boards b
					WHERE b.board_id = t.board_id) as board_name
					FROM threads t
					WHERE thread_id = '$thread_id'";
	
	$post = mysqli_fetch_assoc(mysqli_query($connection, $post_query));
	

	$_SESSION['thread_id'] = $post['thread_id'];
	$_SESSION['thread_subj'] = $post['subject'];
	$_SESSION['board_id'] = $post['board_id'];
	$_SESSION['board_name'] = $post['board_name'];
	
	header("Location: post.php");	
	die();



?>