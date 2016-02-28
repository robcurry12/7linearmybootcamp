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
	
	$thread_query = "SELECT thread_id, subject, user_create, last_update 
					FROM threads
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
		<li><a href="logout.php">Log Out</a></li>
	</ul>


	<div id="bd_home">
		<h3 id="title"><?php echo $board_name; ?></h3>
		<table id="threads">
			<tr>
				<td class="top"><b>Subject</b></td>
				<td class="top"><b>Author</b></td>
				<td class="top"><b>Latest Activity</b></td>
			</tr>
			<?php foreach ($results as $result) : ?>
				<form id="board_nav" action="nav_post.php" method="get">	
				<tr>
					<td class="thds"><input class="link_btn" type="submit" value="<?php echo $result['subject']; ?>"/><br>
					</td>
					<td class="thds"><input class="link_btn" type="submit" value="<?php echo $result['user_create']; ?>"/></td>
					<td class="thds"><input class="link_btn" type="submit" value="<?php echo date_format(new DateTime($result['last_update']), 'n/j/y g:i A'); ?>"</td>
					<input type="hidden" value="<?php echo $result['thread_id']; ?>" name="t_id" />
					<input type="hidden" value="<?php echo $result['subject']; ?>" name="t_subj" />
				</tr>
				</form>
			<?php endforeach ?>
		</table>
		<div id="create_thread">
			<a id="thread_exit">&#10005;</a>
			<h1 id="create">Create Thread</h1>
			<span id="thread-result"></span>
			<label><b>Subject: </b></label> <input maxlength="60" id="new_subj" class="new_thrd" type="text" /><span id="subject-result"></span><br>
			<label id="content"><b>Content: </b></label> <textarea class="new_thrd" rows="8" cols="70" id="content"></textarea><span id="content-result"></span><br>
			<input type="hidden" id="user" value="<?php echo $user; ?>"/>
			<input type="hidden" id="board_id" value="<?php echo $board_id; ?>"/>
			<input class="t7l_btn"type="submit" id="post_thread" value="Post Thread"/>
		</div>
		<input class="t7l_btn" type="button" value="New Thread" id="new_thread" />
	</div>
	
	
</body>
</html>