<?php
	include('connection_info.php');
	include('functions.php');
	
	$thread_id = $_POST['sticky_thread'];
	$board_id = $_POST['board_id'];
	
	$sticky_q = 	"INSERT INTO stickys (board_id, thread_id, date_stickied)
					VALUES ('$board_id','$thread_id',NOW())";
					
	$sticky_success = mysqli_query($connection, $sticky_q);
	
	if($sticky_success == false)
	{
		$remove_sticky = 	"DELETE FROM stickys
							WHERE thread_id = '$thread_id'";
		mysqli_query($connection, $remove_sticky);
	}
	
	die(printThreadsForAdmin());
?>