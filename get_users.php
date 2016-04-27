<?php
	include('session.php');
	include('functions.php');
	include('header.php');	
?>
	<div id="user_home">
		<div id="span_cont">
			<span style="background-color: #5BDA4D" class="admin_buttons" id="users_button"><a style="text-decoration: none; color: white" href="get_users.php">Users</a></span>
			<span class="admin_buttons" id="reports_button"><a style="text-decoration: none; color: white" href="get_reports.php">Reports</a></span>
			<span class="admin_buttons" id="admins_button"><a style="text-decoration: none; color: white" href="get_admins.php">Admins</a></span>
			<span class="admin_buttons" id="admins_button"><a style="text-decoration: none; color: white" href="get_threads.php">Threads</a></span>
		</div>
		<div id="users_reports_tables_div">
			<?php printUsersForAdmin(); ?>
		</div>
	</div>
</body>
</html>
