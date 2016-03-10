<?php
	include('session.php');
	$user = $_SESSION['loggedin_user'];
	if(isset($_SESSION['thread_id']) || (isset($_SESSION['thread_subj'])))
	{
		unset($_SESSION['thread_id']);
		unset($_SESSION['thread_subj']);
	}
	
	$board_id = $_SESSION['board_id'];
	$board_name = $_SESSION['board_name'];
	
	$dsn = 'mysql:host=localhost;dbname=7line';
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	
	try {
     $db = new PDO($dsn, $username, $password);
    } 
    catch (PDOException $e) 
    {
        die("Cannot select DB");
        exit();
    }
	
	$thread_query = "SELECT thread_id, subject, user_create, last_update,
					(SELECT COUNT(p.post_id) posts
					FROM posts p
					WHERE t.thread_id = p.thread_id) AS post_count
					FROM threads t
					WHERE board_id = '$board_id'
					ORDER BY last_update DESC";
					
	$results = $db->query($thread_query);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel='shortcut icon' type='favicon.png' href='images/favicon.png'/ >
	<title>Threads</title>
	<link rel="stylesheet" href="css/t7l.css" type="text/css">
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="posting.js"></script>
</head>
<body>
	<header>
		<img src="images/headerfinal.png" alt="The 7 Line Army Bootcamp">
	</header>

	<ul id="nav">
		<li><a href="user_home.php">Home</a></li> <!-- Username, member title, profile, number of posts -->
		<li><a href="board_home.php">Forum</a></li> <!--- List all of the discussion posts --->
		<li>Messages</li>
		<li><a href="the7line.com/shop">Shop</a></li>
		<li><a href="logout.php">Log Out</a></li>
	</ul>


	<div id="bd_home">
		<h3 id="title"><?php echo $board_name; ?></h3>
		<table id="threads">
			<tr>
				<td class="top"><b>Subject</b></td>
				<td class="top"><b>Author</b></td>
				<td class="top"><b>Latest Activity</b></td>
				<td class="top"><b>Posts</b></td>
			</tr>
			<?php foreach ($results as $result) : ?>
				<form id="board_nav" action="nav_post.php" method="get">	
				<tr>
					<td class="thds subject"><input class="link_btn" type="submit" value="<?php echo $result['subject']; ?>"/><br>
					</td>
					<td class="thds threads"><input class="link_btn" type="submit" value="<?php echo $result['user_create']; ?>"/></td>
					<td class="thds threads"><input class="link_btn" type="submit" value="<?php echo date_format(new DateTime($result['last_update']), 'n/j/y g:i A'); ?>"</td>
					<td class="thds threads"><input class="link_btn" type="submit" value="<?php echo $result['post_count']; ?>" /></td>
					<input type="hidden" value="<?php echo $result['thread_id']; ?>" name="t_id" />
					<input type="hidden" value="<?php echo $result['subject']; ?>" name="t_subj" />
				</tr>
				</form>
			<?php endforeach ?>
		</table>
		<div id="create_thread">
			<a id="thread_exit">&#10005;</a>
			<h1 id="create">Create Thread</h1>
			<h4 id="board_name_new_thread"><?php echo $board_name; ?></h4>
			<ul id="thread-result">
				
			</ul><br>
			<input type="checkbox" id="poll_post" class="polling" value="poll"/> 
			<label for="poll_post" id="poll_label" class="polling">Poll post?</label> <br>
			
			<label id="poll_question_label" for="poll_question" style="display: none"><b>Question:</b></label>
			<input type="text" id="poll_question" style="display: none"/>
			
			<input id="2opt" class="radio_opt rbtns" type="radio" name="num_options" style="display: none" value="2"> 
				<label class="radio_opt" for="2opt" style="display: none">2</label> 
			<input id="3opt" class="radio_opt rbtns" type="radio" name="num_options" style="display: none" value="3"> 
				<label class="radio_opt" for="3opt" style="display: none">3</label>
			<input id="4opt" class="radio_opt rbtns" type="radio" name="num_options" style="display: none" value="4"> 
				<label class="radio_opt" for="4opt" style="display: none">4</label><br>

			<span id="options"></span>
			
			<label style="vertical-align: sub"><b>Subject: </b></label> <input maxlength="60" id="new_subj" class="new_thrd" type="text" /><br>
			<label id="content"><b>Content: </b></label> <textarea class="new_thrd" rows="8" cols="70" id="content_ta"></textarea><br>
			<input type="hidden" id="user" value="<?php echo $user; ?>"/>
			<input type="hidden" id="board_id" value="<?php echo $board_id; ?>"/>
			<input class="t7l_btn"type="submit" id="post_thread" value="Post Thread"/>
		</div>
		<input class="t7l_btn" type="button" value="New Thread" id="new_thread" />
	</div>
	
	
</body>
</html>