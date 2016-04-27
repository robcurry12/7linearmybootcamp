<?php
	include("session.php");
	$user = $_SESSION['loggedin_user'];
	
	//REVISE LATER TO INCLUDE NUMBER OF POSTS
	$info_query = 	"SELECT DATE_FORMAT(date_join, '%c/%e/%y') AS date_join,
							 birthday, gender, image 
					FROM users 
					WHERE username = '$user'";
	
	$results = mysqli_query($connection, $info_query);
	$user_info = mysqli_fetch_assoc($results);
	
	$num_posts_query = 	"SELECT COUNT(post_id) as num_posts
						FROM posts
						WHERE user_create = '$user'";
						
	$npq_results = mysqli_query($connection, $num_posts_query);
	$num_posts = mysqli_fetch_assoc($npq_results);
	
	//Prevents NULL being displayed for gender
	if($user_info['birthday'] == NULL)
	{
		$user_info['birthday'] = "MM/DD";
	}
	
	//Prevents NULL being displayed for gender
	if($user_info['gender'] == NULL)
	{
		$user_info['gender'] = "Gender: Not specified";
	}
	
	//Default profile picture
	if($user_info['image'] == NULL)
	{
		$user_info['image'] = "images/defaultpro.jpg";
	}
	
	// Populating polls and tickets
	$polls_query =	"SELECT poll_id, question, thread_id, 
						(SELECT COUNT(v.vote_id) votes
						FROM votes v
						WHERE v.poll_id = p.poll_id) as votes
					FROM polls p
					ORDER BY date_created DESC
					LIMIT 5";
	
	$poll_results = mysqli_query($connection, $polls_query);
	
	
	//Populating my recent posts and recent posts
	$my_recent_q = 	"SELECT board_id, thread_id, date_created, post_id,
					(SELECT subject
					FROM threads t
					WHERE t.thread_id = p.thread_id) as subject
					FROM posts p
					WHERE user_create = '$user'
					ORDER BY date_created DESC
					LIMIT 5";
	$my_recents = mysqli_query($connection, $my_recent_q);
	
	$recent_q = 	"SELECT board_id, thread_id, date_created, post_id,
					(SELECT subject
					FROM threads t
					WHERE t.thread_id = p.thread_id) as subject
					FROM posts p
					ORDER BY date_created DESC
					LIMIT 5";				
	$recents = mysqli_query($connection, $recent_q);
	
	$events_q =		"SELECT *
					FROM outings
					WHERE date > NOW()
					ORDER BY date ASC
					LIMIT 5";
	$events = mysqli_query($connection, $events_q);
	
	function time_difference($date_of_post)
	{
		
		$date_of_post = new DateTime ($date_of_post);
		$now = new DateTime(date("Y-m-d H:i:s"));
		$interval = $date_of_post->diff($now);
		
		$days = $interval->format('%d');
		$hours = $interval->format('%h');
		$minutes = $interval->format('%i');
		$seconds = $interval->format('%s');
		
		if($days > 0)
			$post_diff = $days."d ago";
		else if($hours > 0)
			$post_diff = $hours."h ago";
		else if($minutes > 0)
			$post_diff = $minutes."m ago";
		else if($seconds > 0)
			$post_diff = $seconds."s ago";
		return $post_diff;
	}
	
	//Admin data population
	$reports_q = "SELECT *, 
					(SELECT board_id
					FROM threads t 
					WHERE t.thread_id = r.thread_id) as board_id
				FROM reports r";
	$reports = mysqli_query($connection, $reports_q);
	
	$db_users_q =	"SELECT *,
				(SELECT COUNT(p.post_id)
				FROM posts p
				WHERE p.user_create = u.username) as post_count
				FROM users u
				ORDER BY date_join DESC
				LIMIT 10";
	$db_users = mysqli_query($connection, $db_users_q);
	
	include('header.php');
?>

	<div id="user_home">
		<?php if($admin_loggedIn == 1){ echo "<input type='button' id='admin_switch' value='Admin'/>";} ?>
		<div id="user_info">
		<form enctype="multipart/form-data" action="upload.php" method="post">
				<img id="home_propic" src="<?php echo 'profile_pics/'.$user_info['image']; ?>" alt="<?php echo $user; ?>">
				<input class="browse" type="file" id="file1" name="file1"/>
				<label for="file1" id="upload_btn">Choose a file</label>
				<span id="photo-result"></span>
				<input class="profilepic" type="submit" id="upload" value="Change profile picture">
				<input name="user" type="hidden" value="<?php echo $user ?>" />
		</form>
				<h3><?php echo $user; ?></h3>
				<h4>Enlisted since: <?php echo $user_info['date_join']; ?></h4>
				<h4 class="edit"><?php echo ucfirst($user_info['gender']); ?></h4>
				<select class="hidden jq_edit" id="gender">
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
				<h4 class="edit"><b>Birthday:</b> <?php echo $user_info['birthday']; ?></h4>	
				<h4 class="hidden"><input type="text" class="hidden jq_edit" id="bday" value="<?php echo $user_info['birthday']; ?>" maxlength="5" /></h4>	
				<span id="bday-result"></span>
				<h4>Number of posts: <?php echo $num_posts['num_posts']; ?></h4>
				<input id="edit_pro" type="button" value="Edit Profile" class="edit edit_pro" />
				<input id="save_pro" type="button" value="Save Changes" class="hidden edit_pro" />
			<input id="username" type="hidden" value="<?php echo $user ?>" />
		</div>
		
		<div id="home_panel">
			<div class="home_panel_divs leftmost" id="polls">
				<h3>Poll Posts</h3>
				<table>
					<tr>
						<td><b>Poll Question</b></td>
						<td><b>Votes</b></td>
					</tr>
					<?php foreach ($poll_results as $poll_result) : ?>
					<form action="nav_poll.php" method="get">	
					<tr>
						<td><input class="link_btn home_tabs left_align" type="submit" value="<?php echo substr($poll_result['question'], 0, 32);?>"/></td>
						<td><input class="link_btn home_tabs" type="submit" value="<?php echo $poll_result['votes']; ?>"/></td>
						<input type="hidden" name="thread_id" value="<?php echo $poll_result['thread_id']; ?>"/>
					</tr>
					</form>
					<?php endforeach ?>
				</table>
			</div>
			<div class="home_panel_divs" id="tix">
				<h3>Available Tickets</h3>
				
				<table>
					<tr>
						<td><b>Game</b></td>
						<td><b>Date</b></td>
					</tr>
				</table>
				
			</div>
			<div class="home_panel_divs leftmost" id="my_recent">
				<h3>My Recent Posts</h3>
				
				<table>
					<tr>
						<td><b>Subject</b></td>
						<td><b>Date</b></td>
					</tr>
					<?php foreach($my_recents as $my_recent) : ?>
					<form action="nav_poll.php" method="get">
					<tr>
						<td><input type="submit" class="link_btn home_tabs left_align" value="<?php echo substr($my_recent['subject'], 0, 30);?>" /></td>
						<td><input type="submit" class="link_btn home_tabs" value="<?php echo time_difference($my_recent['date_created']); ?>" /></td>
						<input type="hidden" name="thread_id" value="<?php echo $my_recent['thread_id']; ?>"/>
					</tr>
					</form>
					<?php endforeach ?>
				</table>
			</div>
			<div class="home_panel_divs" id="recent_posts">
				<h3>Recent Posts</h3>
				
				<table>
					<tr>
						<td><b>Subject</b></td>
						<td><b>Date</b></td>
					</tr>
					
					<?php foreach($recents as $recent) : ?>
					<form action="nav_poll.php" method="get">
					<tr>
						<td><input type="submit" class="link_btn home_tabs left_align" value="<?php echo substr($recent['subject'], 0, 30);?>" /></td>
						<td><input type="submit" class="link_btn home_tabs" value="<?php echo time_difference($recent['date_created']); ?>" /></td>
						<input type="hidden" name="thread_id" value="<?php echo $recent['thread_id']; ?>"/>
					</tr>
					</form>
					<?php endforeach ?>
				</table>
			</div>
			<div class="leftmost" id="upcoming_outings">
				<h3>Upcoming  </h3> <img src="images/favicon.png" style='height: 30px; vertical-align: middle;' alt="T7L"/><h3>  Outings</h3>
				
				<table>
					<tr>
						<td><b>Location</b></td>
						<td><b>Opponent</b></td>
						<td><b>Date</b></td>
					</tr>
					<?php foreach($events as $event) : ?>
					<form action="" method="get">
					<tr>
						<td><a class="outings" href="http://the7line.com/pages/the-7-line-army"><?php echo $event['location'];?></a></td>
						<td><a class="outings" href="http://the7line.com/pages/the-7-line-army"><?php echo $event['opponent']; ?></a></td>
						<td><a class="outings" href="http://the7line.com/pages/the-7-line-army"><?php echo date_format(new DateTime($event['date']), 'n/j/y g:i A'); ?></a></td>
					</tr>
					</form>
					<?php endforeach ?>
				</table>
				<span id="see_all"><a class="outings" href="http://the7line.com/pages/the-7-line-army">See All</a></span>
			</div>
		</div>
		<div id="twitter">
			<a class="twitter-timeline" href="https://twitter.com/The7Line" data-widget-id="717750063703965696">Tweets by @The7Line</a>
			<script>
				!function(d,s,id)
				{
					var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
					if(!d.getElementById(id))
					{
						js=d.createElement(s);
						js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);
					}
				}
				(document,"script","twitter-wjs");
				</script>
		</div>
		
		<div id="admin_panel">
			<div class="home_panel_divs" id="reports">
				<h3 id="top_h3">Reports</h3>
				<div class="admin_tables">
				<table>
					<tr>
						<td><b>User Reported</b></td>
						<td><b>Post Reported</b></td>
						<td><b>Date Reported</b></td>
						<td><b>User Reported</b></td>
						<td><b>Reason</b></td>
					</tr>
					<?php foreach ($reports as $report) : ?>
					<?php $post_link = 'post.php?board_id='.$report['board_id']. '&thread_id='.$report['thread_id']; ?> <!--FIX THIS -->
					<?php $report_content = $report['reported_content']; ?>
					<tr>
						<td><a class="post_links" href="<?php echo $post_link; ?>"><?php echo $report['reported_user']; ?></a></td>
						<td><a class="post_links" href="<?php echo $post_link; ?>"><?php if(strlen($report_content) > 18){ echo substr($report['reported_content'], 0, 20).'...';}
								else{ echo $report_content;} ?></a></td>
						<td><a class="post_links" href="<?php echo $post_link; ?>"><?php echo date_format(new DateTime($report['date_reported']),'n/j/y'); ?></a></td>
						<td><a class="post_links" href="<?php echo $post_link; ?>"><?php echo $report['reported_by']; ?></a></td>I
						<td class="reason"><a class="post_links" href="<?php echo $post_link; ?>"><?php echo $report['reason']; ?></a></td>
					</tr>
					<?php endforeach ?>
				</table>
				<span class="see_all"><a id="see_all_reports" href="get_reports.php" class="outings">See All</a></span>
				</div>
			</div>
			<div class="home_panel_divs">
				<h3>Soldiers Database</h3>
				<div class="admin_tables">
				<table>
					<tr>
						<td><b>Username</b></td>
						<td><b>Enlist Date</b></td>
						<td><b>Number of Posts</b></td>
						<td><b>Last Active</b></td>
						<td><b>Total Violations</b></td>
					</tr>
					<?php foreach ($db_users as $db_user) : ?>
					<tr>
						<td> <?php echo $db_user['username']; ?></td>
						<td> <?php echo date_format(new DateTime($db_user['date_join']),'n/j/y'); ?></td>
						<td> <?php echo $db_user['post_count']; ?></td>
						<td> <?php echo date_format(new DateTime($db_user['last_active']), 'n/j/y'); ?></td>
						<td> <?php echo 'FUTURE UPDATE WILL HANDLE THIS'; ?></td>		
					</tr>
					<?php endforeach ?>
				</table>
				<span class="see_all"><a id="see_all_users" href="get_users.php" class="outings">See All</a></span>
				</div>
			</div>
		</div>
	</div>
</body>
</html>