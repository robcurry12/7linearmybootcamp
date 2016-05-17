<?php
 	include('connection_info.php');
	include('functions.php');
	
	$thread_id = $_POST['lock_thread'];
	$board_id = $_POST['board_id'];
	
	$locked_q = 	"INSERT INTO locked (board_id, thread_id, date_locked)
					VALUES ('$board_id','$thread_id',NOW())";
					
	$locked_success = mysqli_query($connection, $locked_q);
	
	if($locked_success == false)
	{
		$unlock		 = 	"DELETE FROM locked
						WHERE thread_id = '$thread_id'";
		mysqli_query($connection, $unlock);
	}
	
	die(printThreadsForAdmin());
?>