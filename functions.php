<?php
	/**
	 * pageThis pages the posts
	 * $max = the amount of posts per page (2)
	 * $max_page_links = the number of page links provided on the bottom of the page (3)
	 * $query = the MySQL query to retrieve the posts
	 * $page_link = link to the page the paging send you to
	 */
	function pagePosts($max, $max_page_links, $query, $page_link, $board_id)
	{			
		$host = "localhost";
		$username="root"; // Mysql username 
		$password=""; // Mysql password
		$db= "7line"; // Database name		
	
		$connection = mysqli_connect("$host", "$username", "$password", "$db")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,$db)or die("Cannot select DB");
		
		$num_posts = mysqli_num_rows(mysqli_query($connection, $query));			//Getting the total amount of posts
		$num_paging = ceil($num_posts/$max);										//Creates varible to determine the amount of pages to be created
		
		//If a non number is passed, Protects against URL manipulation, User is sent back to list of threads			
		if(isset($_GET['page'])&& !ctype_digit($_GET['page']))		
		{
			header('Location: threads.php?board_id='.$board_id);
		}
		//If a number smaller than 1 is passed user will be sent to first page
		else if (isset($_GET['page'])&& $_GET['page'] < 1)
		{
			$current_page = 1;
			$start = 0;
		}
		//If a number greater than there are pages is passed display last page
		else if (isset($_GET['page']) && $_GET['page'] > $num_paging)	
		{
			$current_page = $num_paging;
		    $start = $num_paging - 1;
		}
		//If a valid number is entered get starting and current page
		else if (isset($_GET['page'])&& $_GET['page'] > 0)
		{
		    	$start=intval($_GET['page'])-1;			
		    	$current_page=intval($_GET['page']);
		}
		//If no parameters passed.. just give the first page
		else 
		{
		    $current_page=1;
		    $start=0;
		}
		
		$start *= $max;													//Which row to start with
		$get_posts_query = $query." LIMIT '$start', '$max'";			//Adding the limit to the query
		//Preparing --End--
		
		//Actual paging --Start--
		//Do we need to page? //If the amount of posts we have exceeds the amount of posts per page ($max) then yes we need to page
		if ($num_posts > $max)
		{
			//If the page we are currently at is greater than 1, create previous pages buttons	
			if ($current_page > 1 /*$num_paging*/)
			{	
		        $previous_page = $current_page - 1;
		        echo "<a href=\"".$page_link."page=1\"> |< </a>";					//First page link					
		        echo "<a href=\"".$page_link."page=$previous_page\"> < </a> ";		//Previous page link
		    }
			//Are we going far away from the first viewed page link?
			//If the current_page is greater than half of the max number of paging links 
		    if ($current_page > ceil($max_page_links / 2)) 	
		    {	
		    	if ($num_paging - $current_page < (($max_page_links/2)+1)) //7 < 2 //Are we getting closer to last viewed page link?
		        {	
		        	$start_counter = $current_page - ($max_page_links - ($num_paging - $current_page)); //Yes, Then we need to view more page links
		        	if($start_counter == 0)
						$start_counter = 1;
		            $end_counter = $num_paging;		//And no need to view page links more than the query can bring
		        }
		        else
		        {
		        	$start_counter = $current_page - ceil(($max_page_links / 2) - 1 );  	//No, then just view some links before the currentrent page
		            $end_counter = $current_page + ceil(($max_page_links / 2));				//And some links after
		        }
		     }
		     //Still in the first pages?
		     else
		     {	
		     	$start_counter = 1;
				if($max_page_links > $num_paging)
					$end_counter = $num_paging;
				else								
		        	$end_counter = $max_page_links;
		     }
			 
			 //A loop for printing the links
		     for ($i = $start_counter; $i <= $end_counter; $i++)
		     {
		     	//Is this the last link?
		     	if ($i==$end_counter)
		        {
		        	//If i is equal to current page then stylize the link for the current page (black font)
		        	if ($i==$current_page)
		            {	
		            	echo "<a style='color: black;'>".$i."</a>";
		            }
					//i is not equal to current page so tylize link like usual (white font)
		            else
		            {
		            	echo "<a href=\"".$page_link."page=".$i."\">".$i."</a>";
		            }
		        }
		        //Print out links 
		        else
		        {
		        	//If i is equal to the current page then stylize the link for the current page
		        	if ($i==$current_page)
		            {
		            	//Current page link is black to signify we are on this page
		            	echo "<a style='color: black;'>".$i."</a>   ";			
		            }
		            //i is not equal to current page so stylize link like usual (white font)
		        	else
		            {	
		            	echo "<a href=\"".$page_link."page=".$i."\">".$i."</a>";
		            }
		        }
		     }
			 // If we are not at the end of the pages make the next and last page links
		     if ($current_page < $num_paging)
		     {	
		     	$next_page = $current_page + 1;
		        $last_page = $num_paging;
		        echo "<a href=\"".$page_link."page=$next_page\"> > </a>";
		        echo "<a href=\"".$page_link."page=$last_page\"> >| </a>";
		     }
		}
	} 

	/**
	 * pageThis pages the posts
	 * $max = the amount of posts per page (2)
	 * $max_page_links = the number of page links provided on the bottom of the page (3)
	 * $query = the MySQL query to retrieve the posts
	 * $page_link = link to the page the paging send you to
	 */
	function pageBoard($max, $max_page_links, $query, $page_link, $board_id)
	{			
		$host = "localhost";
		$username="root"; // Mysql username 
		$password=""; // Mysql password
		$db= "7line"; // Database name		
	
		$connection = mysqli_connect("$host", "$username", "$password", "$db")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,$db)or die("Cannot select DB");
		
		$num_posts = mysqli_num_rows(mysqli_query($connection, $query));			//Getting the total amount of posts
		$num_paging = ceil($num_posts/$max);										//Creates varible to determine the amount of pages to be created
		
		//If a non number is passed, Protects against URL manipulation, User is sent back to list of threads			
		if(isset($_GET['b_page'])&& !ctype_digit($_GET['b_page']))		
		{
			header('Location: threads.php?board_id='.$board_id);
		}
		//If a number smaller than 1 is passed user will be sent to first page
		else if (isset($_GET['b_page'])&& $_GET['b_page'] < 1)
		{
			$current_page = 1;
			$start = 0;
		}
		//If a number greater than there are pages is passed display last page
		else if (isset($_GET['b_page']) && $_GET['b_page'] > $num_paging)	
		{
			$current_page = $num_paging;
		    $start = $num_paging - 1;
		}
		//If a valid number is entered get starting and current page
		else if (isset($_GET['b_page'])&& $_GET['b_page'] > 0)
		{
		    	$start=intval($_GET['b_page'])-1;			
		    	$current_page=intval($_GET['b_page']);
		}
		//If no parameters passed.. just give the first page
		else 
		{
		    $current_page=1;
		    $start=0;
		}
		
		$start *= $max;													//Which row to start with
		$get_posts_query = $query." LIMIT '$start', '$max'";			//Adding the limit to the query
		//Preparing --End--
		
		//Actual paging --Start--
		//Do we need to page? //If the amount of posts we have exceeds the amount of posts per page ($max) then yes we need to page
		if ($num_posts > $max)
		{
			//If the page we are currently at is greater than 1, create previous pages buttons	
			if ($current_page > 1 /*$num_paging*/)
			{	
		        $previous_page = $current_page - 1;
		        echo "<a href=\"".$page_link."b_page=1\"> |< </a>";					//First page link					
		        echo "<a href=\"".$page_link."b_page=$previous_page\"> < </a> ";		//Previous page link
		    }
			//Are we going far away from the first viewed page link?
			//If the current_page is greater than half of the max number of paging links 
		    if ($current_page > ceil($max_page_links / 2)) 	
		    {	
		    	if ($num_paging - $current_page < (($max_page_links/2)+1)) //7 < 2 //Are we getting closer to last viewed page link?
		        {	
		        	$start_counter = $current_page - ($max_page_links - ($num_paging - $current_page)); //Yes, Then we need to view more page links
		        	if($start_counter == 0)
						$start_counter = 1;
		            $end_counter = $num_paging;		//And no need to view page links more than the query can bring
		        }
		        else
		        {
		        	$start_counter = $current_page - ceil(($max_page_links / 2) - 1 );  	//No, then just view some links before the currentrent page
		            $end_counter = $current_page + ceil(($max_page_links / 2));				//And some links after
		        }
		     }
		     //Still in the first pages?
		     else
		     {	
		     	$start_counter = 1;
				if($max_page_links > $num_paging)
					$end_counter = $num_paging;
				else								
		        	$end_counter = $max_page_links;					
		     }
			 
			 //A loop for printing the links
		     for ($i = $start_counter; $i <= $end_counter; $i++)
		     {
		     	//Is this the last link?
		     	if ($i==$end_counter)
		        {
		        	//If i is equal to current page then stylize the link for the current page (black font)
		        	if ($i==$current_page)
		            {	
		            	echo "<a style='color: black;'>".$i."</a>";
		            }
					//i is not equal to current page so tylize link like usual (white font)
		            else
		            {
		            	echo "<a href=\"".$page_link."b_page=".$i."\">".$i."</a>";
		            }
		        }
		        //Print out links 
		        else
		        {
		        	//If i is equal to the current page then stylize the link for the current page
		        	if ($i==$current_page)
		            {
		            	//Current page link is black to signify we are on this page
		            	echo "<a style='color: black;'>".$i."</a>   ";			
		            }
		            //i is not equal to current page so stylize link like usual (white font)
		        	else
		            {	
		            	echo "<a href=\"".$page_link."b_page=".$i."\">".$i."</a>";
		            }
		        }
		     }
			 // If we are not at the end of the pages make the next and last page links
		     if ($current_page < $num_paging)
		     {	
		     	$next_page = $current_page + 1;
		        $last_page = $num_paging;
		        echo "<a href=\"".$page_link."b_page=$next_page\"> > </a>";
		        echo "<a href=\"".$page_link."b_page=$last_page\"> >| </a>";
		     }
		}
	} 

	/**
	 * Determines whether or not a user is an admin
	 */
	 function isAdmin($username)
	 {
	 	$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
	 	$isAdmin_q = "SELECT username
	 				FROM admins
	 				WHERE username = '$username'";
		$isAdmin = mysqli_query($connection, $isAdmin_q);
		$_admin = mysqli_num_rows($isAdmin);
		if($_admin == 1)
			return true;
		else
			return false;
	 }
	
	/**
	 * Determines if a thread is stickied
	 */
	 function isSticky($thread_id)
	 {
	 	$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
	 	$isSticky_q = "SELECT * FROM stickys 
	 				WHERE thread_id = '$thread_id'";
					
		$isSticky = mysqli_query($connection, $isSticky_q);
		$_sticky = mysqli_num_rows($isSticky);
		if($_sticky == 1)
			return true;
		else
			return false;
	 }
	
	/**
	 * Determines if a thread is locked
	 */
	function isLocked($thread_id)
	{
		$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
	 	$isLocked_q = "SELECT * FROM locked 
	 				WHERE thread_id = '$thread_id'";
					
		$isLocked = mysqli_query($connection, $isLocked_q);
		$_locked = mysqli_num_rows($isLocked);
		if($_locked == 1)
			return true;
		else
			return false;
			
		
	}

	/**
	 * Prints out a table of all the users for the admin to look at
	 */
	function printUsersForAdmin()
	{
		$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
		
		$db_users_q =	"SELECT *,
						(SELECT COUNT(p.post_id)
						FROM posts p
						WHERE p.user_create = u.username) as post_count
						FROM users u
						ORDER BY date_join DESC";
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
					<td class=' admin_table_headers' data-board-type='users' data-order-type=''><b>Total Violations</b></td>
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
	
	/**
	 * Prints out all reports for the admin to look at
	 */
	function printReportsForAdmin()
	{
		$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
		
		$reports_q = "SELECT *, 
					(SELECT board_id
					FROM threads t 
					WHERE t.thread_id = r.thread_id) as board_id
				FROM reports r";
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

	/**
	 * Prints out all admins for the admin to look at
	 */
	function printAdminsForAdmin()
	{
		$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
		
		$admins_q = "SELECT * FROM admins";
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

	/**
	 * Prints out all threads for admin
	 */
	function printThreadsForAdmin()
	{
		$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
		
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
				    ORDER BY date_created";	
	
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

	/**
	 * Prints dropdown of all 
	 */
	function printBoardsInDropDown()
	{
		$connection = mysqli_connect("localhost", "root", "", "7line")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,"7line")or die("Cannot select DB");
		
		$boards_q =	"SELECT * FROM boards";
		$boards = mysqli_query($connection, $boards_q);
		
		foreach ($boards as $board) :
			echo "<option value='".$board['board_id']."'>".$board['board_name']."</option>";
		endforeach;
	}
?>