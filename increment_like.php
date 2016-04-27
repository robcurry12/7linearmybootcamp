<?php
	include('connection_info.php');
	
	$user = $_POST['user'];
	$post_id = $_POST['post_id'];	
	$post_user = $_POST['post_user'];
	
	$add_like = "INSERT INTO likes (post_id, user, post_user, time_liked)
				VALUES ('$post_id', '$user', '$post_user', NOW())";
				
	$like_success = mysqli_query($connection, $add_like);
	//Add disliking feature
	
	if($like_success == false)
	{
		$delete_like = "DELETE FROM likes
						WHERE post_id = '$post_id' AND user = '$user'";
		
		mysqli_query($connection, $delete_like);
	}
	
	$increment_query = "SELECT COUNT(*) AS likes
					FROM likes
    				WHERE post_id = '$post_id'";
					
    $increment_result = mysqli_query($connection, $increment_query);
	$increment_array = mysqli_fetch_assoc($increment_result);
	$increment = $increment_array['likes'];
	
	die($increment);

?>