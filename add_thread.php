<?php
	$host = "localhost";
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$db= "7line"; // Database name
	
	$connection = mysqli_connect($host, $username, $password, $db)or die('could not connect to database');
	$database = mysqli_select_db($connection, $db)or die("Cannot select DB");
	
	$user = $_POST['user'];
	$subject = $_POST['subject'];
	$content = $_POST['content'];
	$bd_id = $_POST['board_id'];
	$thrd_type = $_POST['type'];
	
	$new_thread = "INSERT INTO threads (subject, board_id, user_create, last_update, date_created, type)
					VALUES ('$subject', '$bd_id', '$user', NOW(), NOW(), '$thrd_type')";
					
	mysqli_query($connection, $new_thread);
	
	$thread_id = mysqli_insert_id($connection);
	
	$new_post = "INSERT INTO posts (thread_id, board_id, subject, content, user_create, date_created, type)
				VALUES ('$thread_id', '$bd_id', '$subject', '$content', '$user', NOW(), '$thrd_type')";
	mysqli_query($connection, $new_post);
	
	if($thrd_type == 'poll')
	{
		$poll_question = $_POST['poll_q'];
		
		$opt1 = $_POST['opt1'];
		$opt2 = $_POST['opt2'];
		
		if(isset($_POST['opt3']))
		{
			$opt3 = $_POST['opt3'];
			if(isset($_POST['opt4']))
			{
				$opt4 = $_POST['opt4'];
				$new_poll = "INSERT INTO polls (thread_id, user, question, option1, option2, option3, option4, date_created)
						VALUES ('$thread_id', '$user', '$poll_question', '$opt1', '$opt2', '$opt3', '$opt4', NOW())";
				mysqli_query($connection, $new_poll);
			}
			else 
			{
				$new_poll = "INSERT INTO polls (thread_id, user, question, option1, option2, option3, date_created)
						VALUES ('$thread_id', '$user', '$poll_question', '$opt1', '$opt2', '$opt3', NOW())";
				mysqli_query($connection, $new_poll);
			}	
		}
		else
		{	
			$new_poll = "INSERT INTO polls (thread_id, user, question, option1, option2, date_created)
						VALUES ('$thread_id', '$user', '$poll_question', '$opt1', '$opt2', NOW())";
			mysqli_query($connection, $new_poll);
		}	
	}
	
	
	include('session.php');
	
	$_SESSION['thread_id'] = $thread_id;
	$_SESSION['thread_subj'] = $subject;
	
	header("Location: post.php");	
	die();
?>