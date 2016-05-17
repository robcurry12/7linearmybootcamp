<?php
	include('functions.php');
	
	$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
	$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
	
	$order_by = $_POST['order_by'];
	$order_board = $_POST['order_board'];
	
	if($order_board == 'users')
	{
		$db_users_q =	"SELECT *,
						(SELECT COUNT(p.post_id)
						FROM posts p
						WHERE p.user_create = u.username) as post_count
						FROM users u
						ORDER BY $order_by DESC";
		$db_users = mysqli_query($connection, $db_users_q);
		
		echo "<script src='admin.js'></script>
			  <table class='admin_db_tables' id='users_table'>
				<tr>
					<td class='ordering admin_table_headers' data-board-type='users' data-order-type='username' ><b>Username</b></td>
					<td class='ordering admin_table_headers' data-board-type='users' data-order-type='date_join'><b>Enlist Date</b></td>
					<td class='ordering admin_table_headers' data-board-type='users' data-order-type='gender'><b>Gender</b></td>
					<td class='ordering admin_table_headers' data-board-type='users' data-order-type='birthday'><b>Birthday</b></td>
					<td class='ordering admin_table_headers' data-board-type='users' data-order-type='post_count'><b>Number of Posts</b></td>
					<td class='ordering admin_table_headers' data-board-type='users' data-order-type='last_active'><b>Last Active</b></td>
					<td class='admin_table_headers' data-board-type='users' data-order-type=''><b>Total Violations</b></td>
					<td class='admin_table_headers'><b>Actions</b></td>
				</tr>";
				foreach ($db_users as $db_user) :
		echo		"<tr>
					<td class='admin_table_users_and_reports' id='"."user_name_".$db_user['username']."'>".$db_user['username']; 
																if(isAdmin($db_user['username']))
																{
																	echo "<img src='images/admin.png' alt='Admin' title='Admin' style='height: 20px' />";
																}
		echo														"</td>
					<td class='admin_table_users_and_reports'>".date_format(new DateTime($db_user['date_join']),'n/j/y')."</td>
					<td class='admin_table_users_and_reports'>".$db_user['gender']."</td>
					<td class='admin_table_users_and_reports'>".$db_user['birthday']."</td>
					<td class='admin_table_users_and_reports'>".$db_user['post_count']."</td>
					<td class='admin_table_users_and_reports'>".date_format(new DateTime($db_user['last_active']), 'n/j/y')."</td>
					<td class='admin_table_users_and_reports'>".'FUTURE UPDATE WILL HANDLE THIS'."</td>
					<td class='admin_table_users_and_reports'>	<img class='make_admin' src='images/admin.png' alt='Make Admin' title='Make Admin' data-user-type='".$db_user['username']."' style='height: 20px; cursor: pointer' />
																<img class='suspend' src='images/suspend.png' alt='Suspend' title='Suspend' style='height: 20px; cursor: pointer' />
																<img class='ban' src='images/ban.png' alt='Ban User' title='Ban User' style='height: 20px; cursor: pointer' /></td>
					<input type='hidden' id='alter_user' value='".$db_user['username']."' />
				</tr>";
			endforeach;
		echo "</table>";
	}
	if($order_board == 'reports')
	{
		$reports_q = "SELECT *, 
					(SELECT board_id
					FROM threads t 
					WHERE t.thread_id = r.thread_id) as board_id
					FROM reports r
					ORDER BY $order_by";
		$reports = mysqli_query($connection, $reports_q);
		
		echo "<script src='admin.js'></script>
			<table class='admin_db_tables' id='reports_table'>
			<tr>
				<td class='ordering admin_table_headers' data-board-type='reports' data-order-type='reported_user'><b>User Reported</b></td>
				<td class='ordering admin_table_headers' data-board-type='reports' data-order-type='reported_content'><b>Post Reported</b></td>
				<td class='ordering admin_table_headers' data-board-type='reports' data-order-type='date_reported'><b>Date Reported</b></td>
				<td class='ordering admin_table_headers' data-board-type='reports' data-order-type='reported_user'><b>User Reported</b></td>
				<td class='ordering admin_table_headers' data-board-type='reports' data-order-type='reason'><b>Reason</b></td>
			</tr>";
			foreach ($reports as $report) : 
			$post_link = 'post.php?board_id='.$report['board_id']. '&thread_id='.$report['thread_id']; //FIX THIS
			$report_content = $report['reported_content']; 
		echo	"<tr>
					<td class='admin_table_users_and_reports'><a class='post_links' href='".$post_link."'>".$report['reported_user']."</a>";
																if(isAdmin($report['reported_user']))
																	{
																		echo "<img src='images/admin.png' alt='Admin' title='Admin' style='height: 20px' />";
																	}
		echo														"</td>
					<td class='admin_table_users_and_reports'><a class='post_links' href='".$post_link."'>";
															 if(strlen($report_content) > 100)
															 {
															 	echo substr($report['reported_content'], 0, 100).'...';
															 }
															 else
															 {
																 echo $report_content;
															 }
		echo 													"</a></td>
					<td class='admin_table_users_and_reports'><a class='post_links' href='".$post_link."'>".date_format(new DateTime($report['date_reported']),'n/j/y')."</a></td>";
		echo		"<td class='admin_table_users_and_reports'><a class='post_links' href='".$post_link."'>".$report['reported_by']."</a>";
																if(isAdmin($report['reported_by']))
																{
																	echo "<img src='images/admin.png' alt='Admin' title='Admin' style='height: 20px' />";
																}
		echo													"</td>
					<td class='reason admin_table_users_and_reports'><a class='post_links' href='".$post_link."'>".$report['reason']."</a></td>
				</tr>";
				endforeach;
		echo "</table>";
		
	}
	if($order_board == 'admins')
	{
		$admins_q = "SELECT * FROM admins ORDER BY $order_by";
		$admins = mysqli_query($connection, $admins_q);
	
		echo "<script src='admin.js'></script>
			<table class='admin_db_tables' id='admins_table'>
				<tr>
					<td class='ordering admin_table_headers' data-order-type='username' data-board-type='admins'><b>Username</b></td>
					<td class='ordering admin_table_headers' data-order-type='became_admin' data-board-type='admins'><b>Became Admin</b></td>
					<td class='admin_table_headers'><b>Remove Admin</b></td>
				</tr>";
			foreach ($admins as $admin) :
		echo		"<tr>
					<td class='admin_table_users_and_reports'>".$admin['username']. "<img src='images/admin.png' alt='Admin' style='height: 20px'/></td>
					<td class='admin_table_users_and_reports'>".date_format(new DateTime($admin['became_admin']),'n/j/y')."</td>
					<td class='admin_table_users_and_reports'>
					<img class='remove_admin' data-user-type='".$admin['username']."' style='height: 20px; cursor: pointer' src='images/x.png' alt='Remove Admin' title='Remove Admin'/></td>			
				</tr>";
				endforeach;
		echo	"</table>";
	}
	if($order_board == 'threads')
	{
		$threads_q = "SELECT thread_id, subject, user_create, date_created, last_update, type, 
					(SELECT count(p.post_id)
					FROM posts p
				    WHERE p.thread_id = t.thread_id) as num_replies,
				    (SELECT board_name
				    FROM boards b
				    WHERE b.board_id = t.board_id) as board,
				    (SELECT board_id
					FROM boards b
					WHERE b.board_id = t.board_id) as board_id
				    FROM threads t
				    ORDER BY $order_by ";	
	
		$threads = mysqli_query($connection, $threads_q);
		
		$boards_q = "SELECT * FROM boards";
		$boards = mysqli_query($connection, $boards_q);
		
		echo	"<script src='admin.js'></script>
			<table class='admin_db_tables' id='threads_table'>
				<tr>
					<td class='ordering admin_table_headers' data-order-type='board' data-board-type='threads'><b>Board</b></td>
					<td class='ordering admin_table_headers' data-order-type='subject' data-board-type='threads'><b>Subject</b></td>
					<td class='ordering admin_table_headers' data-order-type='user_create' data-board-type='threads'><b>Created By</b></td>
					<td class='ordering admin_table_headers' data-order-type='date_created' data-board-type='threads'><b>Date Created</b></td>
					<td class='ordering admin_table_headers' data-order-type='last_update' data-board-type='threads'><b>Last Update</b></td>
					<td class='ordering admin_table_headers' data-order-type='num_replies' data-board-type='threads'><b>Replies</b></td>
					<td class='admin_table_headers'><b>Actions</b></td>
				</tr>";
				foreach ($threads as $thread):
		echo		"<tr>
						<td class='admin_table_users_and_reports'>".$thread['board']."</td>
						<td class='admin_table_users_and_reports' style='text-align: left; padding-left: 6px;'>";
												if(isSticky($thread['thread_id']))
												{
													echo "<img src='images/sticky.png' alt='Sticky Thread' style='height: 20px; margin-right: 2px' />";	
												}
												if(isLocked($thread['thread_id']))
												{
													echo "<img src='images/lock.png' alt='Locked' style='height: 20px; margin-right: 2px' />";
												}
												if($thread['type'] == 'poll')
												{
													echo "<img src='images/poll.png' alt='Poll' style='height: 20px; margin-right: 5px;' />";
												}
												
		echo			"<a href='post.php?board_id=".$thread['board_id']."&thread_id=".$thread['thread_id']."'>".$thread['subject']."</a></td>
						<td class='admin_table_users_and_reports'>".$thread['user_create'];
															if(isAdmin($thread['user_create']))
															{
																echo "<img src='images/admin.png' alt='Admin' title='Admin' style='height: 20px' />";
															}
		echo			"<td class='admin_table_users_and_reports'>".date_format(new DateTime($thread['date_created']), 'n/j/y')."</td>
						<td class='admin_table_users_and_reports'>".date_format(new DateTime($thread['last_update']), 'n/j/y')."</td>
						<td class='admin_table_users_and_reports'>".$thread['num_replies']."</td>
						<td class='admin_table_users_and_reports'>	<select id='move_thread' data-thread_id-type='".$thread['thread_id']."'>
																		<option selected='selected'>Move thread to</option>";
																	foreach ($boards as $board) :
		echo															"<option class='moving' value='".$board['board_id']."'>".$board['board_name']."</option>";
																	endforeach;																
		echo														"</select>
																	<img class='deleting' data-thread-type='".$thread['thread_id']."' style='height: 20px; cursor: pointer;' src='images/x.png' alt='Delete Thread' title='Delete Thread'/>";
																	if(isSticky($thread['thread_id']))
																	{
																		echo "<img class='stickying' data-thread-type='".$thread['thread_id']."' style='height: 20px; cursor: pointer;' src='images/remove_sticky.png' alt='Remove Sticky' title='Remove Sticky' data-board-type='".$thread['board_id']."'/>";	
																	}
																	else 
																	{
																		echo "<img class='stickying' data-thread-type='".$thread['thread_id']."' style='height: 20px; cursor: pointer;' src='images/sticky.png' alt='Make Sticky' title='Make Sticky' data-board-type='".$thread['board_id']."'/>";
																	}
																	if(isLocked($thread['thread_id']))
																	{
																		echo "<img class='locking' data-thread-type='".$thread['thread_id']."' style='height: 20px; cursor: pointer;' src='images/unlock.png' alt='Unlock Thread' title='Unlock Thread' data-board-type='".$thread['thread_id']."'/>";
																	}
																	else
																	{
																		echo "<img class='locking' data-thread-type='".$thread['thread_id']."' style='height: 20px; cursor: pointer;' src='images/lock.png' alt='Lock Thread' title='Lock Thread' data-board-type='".$thread['thread_id']."'/>";	
																	}
		echo 		"</td>																	
					</tr>";
				endforeach;
		echo	"</table>";	
	}
?>