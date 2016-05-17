<?php 
	include('connection_info.php');
	include('functions.php');
	
	$thread_id = $_POST['delete_thread'];
	
	$delete_t_1 = 	"DELETE FROM threads
					WHERE thread_id = '$thread_id'";
	
	$delete_t_2 = 	"DELETE FROM posts
					WHERE thread_id = '$thread_id'";
	
	mysqli_query($connection, $delete_t_1);
	mysqli_query($connection, $delete_t_2);
	
	die(printThreadsForAdmin());
	
?>