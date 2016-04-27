<?php
	include('session.php');
	include('functions.php');
	
	$remove_admin = $_POST['remove_admin'];
	
	$remove_admin_q =	"DELETE FROM admins
						WHERE username = '$remove_admin'";
	mysqli_query($connection, $remove_admin_q);
	
	die(printAdminsForAdmin());
?>