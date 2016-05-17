<?php 
	include('connection_info.php');
	include('functions.php');
	
	$move_to_board = $_POST['move_to_board'];
	$thread_id = $_POST['thread_id'];
	
	$moving_q_1 = 	"UPDATE threads
					SET board_id = '$move_to_board'
					WHERE thread_id = '$thread_id'";
	
	$moving_q_2 = 	"UPDATE posts
					SET board_id = '$move_to_board'
					WHERE thread_id = '$thread_id'";
	
	mysqli_query($connection, $moving_q_1);
	mysqli_query($connection, $moving_q_2);
	
	die(printThreadsForAdmin());
	
?>