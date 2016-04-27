<?php 
	include('functions.php');
	include('connection_info.php');
	
	$which_table = $_POST['table'];
	
	if($which_table == "users")
	{
		$db_users_q =	"SELECT *,
				(SELECT COUNT(p.post_id)
				FROM posts p
				WHERE p.user_create = u.username) as post_count
				FROM users u
				ORDER BY date_join DESC";
		$db_users = mysqli_query($connection, $db_users_q);
	}
	if($which_table == "reports")
	{
		$reports_q = "SELECT *, 
					(SELECT board_id
					FROM threads t 
					WHERE t.thread_id = r.thread_id) as board_id
				FROM reports r";
		$reports = mysqli_query($connection, $reports_q);
	}
	if($which_table == "admins")
	{
		$admins_q = "SELECT * FROM admins";
		$admins = mysqli_query($connection, $admins_q);
		
		die(include("admins_table.php"));
	}
?>