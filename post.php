<?php
	include("session.php");
	
	$user = $_SESSION['loggedin_user'];
	$th_subject = $_SESSION['thread_subj'];
	$thread_id = $_SESSION['thread_id'];
	$board_id = $_SESSION['board_id'];
	
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
	
	$per_page = 12;
	if (isset($_GET["page"])) 
	{
		$page = $_GET["page"];
	}
	else 
	{
		$page=1;
	}
	$start_from = ($page-1) * $per_page;
	
	$post_query = 	"SELECT user_create, date_created, content, post_id 
					FROM posts
					WHERE board_id = '$board_id' AND thread_id = '$thread_id'
					LIMIT $start_from, $per_page";
	
	$post_results = $db->query($post_query);
	
	//For paging vvvvv
	$query = "SELECT * FROM posts
			WHERE board_id = '$board_id' AND thread_id = '$thread_id'";
	$result = mysql_query($query);
	$total_records = mysql_num_rows($result);

	//Using ceil function to divide the total records on per page
	$total_pages = ceil($total_records / $per_page);
	

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel='shortcut icon' type='favicon.png' href='images/favicon.png'/ >
	<title>Forum Home</title>
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
		
		
	<div id="board_posts">	
		<h1><?php echo $th_subject; ?></h1>
		<table id="thread_posts">
			<?php foreach ($post_results as $p_result) : ?>	
				<tr>
					<td class="user_info"><p><?php echo $p_result['user_create']; ?></p>
						<img class="pro_pic" src="<?php echo "profile_pics/".$p_result['user_create'].'.jpg'; ?>" alt="<?php echo $p_result['user_create']; ?>">
					</td>
					<td><div id="content_cell"><p id="timestamp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date_format(new DateTime($p_result['date_created']), 'n/j/y g:i A'); ?></p>
						<p id="thrd_content"><?php echo $p_result['content']; ?></p></div></td>

					<input type="hidden" value="<?php echo $p_result['post_id']; ?>" name="post_id" />
				</tr>
			<?php endforeach ?>
		</table>
		<div id="paging">
		<?php
			if($total_pages < 2)
			{}
			else 
			{
				echo "<a href='post.php?page=1'>".'|<'."</a>";
				for ($i=1; $i<=$total_pages; $i++) 
				{
					echo "<a href='post.php?page=".$i."'>".$i."</a>";
				};
				// Going to last page
				echo "<a href='post.php?page=$total_pages'>".'>|'."</a></center>";
			}
		?>
		</div>
		<div id="reply_post">
			<h4>Post Reply <input type="submit" id="post_reply" value="Reply"/></h4>
			<span id="reply-result"></span>
			<textarea rows="8" cols="70" id="content"></textarea><span id="reply_content-result"></span><br>
			<input type="hidden" id="user" value="<?php echo $user; ?>"/>
			<input type="hidden" id="board_id" value="<?php echo $board_id; ?>"/>
			<input type="hidden" id="thread_id" value="<?php echo $thread_id; ?>"/>
			<input type="hidden" value="<?php echo $page; ?>" id="page_num" />
			<input type="hidden" value="<?php echo $total_records; ?>" id="total_posts" /> 
		</div>
	</div>
</body>
</html>