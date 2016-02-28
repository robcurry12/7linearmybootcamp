<?php
	include("session.php");

	$_SESSION['board_id'] = $_GET['bd_id'];
	$_SESSION['board_name'] = $_GET['bd_name'];
	
	header("Location: threads.php");	
	die();
	
?>