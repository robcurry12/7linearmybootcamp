<?php
	include('session.php');
	include('functions.php');
	
	$new_admin = $_POST['new_admin'];
	
	$new_admin_q = 		"INSERT INTO admins (username, became_admin)
						VALUE ('$new_admin', NOW())";
	$new_admin_created = mysqli_query($connection, $new_admin_q);
	die(printUsersForAdmin());

?>