<?php
	$host = "localhost";
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$db= "7line"; // Database name
	
	$connection = mysql_connect($host, $username, $password)or die('could not connect to database');
	$database = mysql_select_db("$db")or die("Cannot select DB");
	
	$user = $_POST['user'];
	$poll_id = $_POST['poll_id'];
	$voted_for = $_POST['voted_for'];
	
	$voting_query =	"INSERT INTO votes (poll_id, user, voted_for, date_voted)
					VALUES ('$poll_id', '$user', '$voted_for', NOW())";
	mysql_query($voting_query);
	
	$update_polls = "SELECT COUNT(*) AS total_votes
					FROM votes
					WHERE poll_id = '$poll_id' AND voted_for = '$voted_for'";
	$update_polls_result = mysql_query($update_polls);
	$polls_array = mysql_fetch_assoc($update_polls_result);
	$updated_votes = $polls_array['total_votes'];
	
	die($updated_votes);
?>