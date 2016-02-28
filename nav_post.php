<?php
	include("session.php");

	$_SESSION['thread_id'] = $_GET['t_id'];
	$_SESSION['thread_subj'] = $_GET['t_subj'];
	
	header("Location: post.php");	
	die();
?>