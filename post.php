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
	
	/*$post_query = 	"SELECT user_create, date_created, content, post_id, likes 
					FROM posts
					WHERE board_id = '$board_id' AND thread_id = '$thread_id'
					LIMIT $start_from, $per_page";*/
					
	$post_query = 	"SELECT user_create, date_created, content, post_id, type,
					(SELECT COUNT(l.post_id) AS likes
					FROM likes l
    				WHERE p.post_id = l.post_id) AS likes
					FROM posts p
					WHERE board_id = '$board_id' AND thread_id = '$thread_id'
					LIMIT $start_from, $per_page";				
	
	$type_query = 	"SELECT type
					FROM posts
					WHERE board_id = '$board_id' AND thread_id = '$thread_id'";

	$post_results = $db->query($post_query);
	
	$thread_type = mysql_query($type_query);
	$thread_type = mysql_fetch_assoc($thread_type);

	if($thread_type['type'] == 'poll')
	{
		$poll_query =	"SELECT poll_id, question, option1, option2, option3, option4
						FROM polls
						WHERE thread_id = '$thread_id'";
		$poll_results = mysql_query($poll_query);
		$poll_results = mysql_fetch_assoc($poll_results);
		
		$poll_id = $poll_results['poll_id'];
		////////////////////////////////////////////////////////
		$count_opt1 = 	"SELECT COUNT(*) AS votes
						FROM votes
						WHERE poll_id = '$poll_id' AND voted_for = 1";
	 	$opt1_total = mysql_query($count_opt1);
		$opt1_total = mysql_fetch_assoc($opt1_total);
		///////////////////////////////////////////////////////
		$count_opt2 =	"SELECT COUNT(*) AS votes
						FROM votes
						WHERE poll_id = '$poll_id' AND voted_for = 2";
	 	$opt2_total = mysql_query($count_opt2);
		$opt2_total = mysql_fetch_assoc($opt2_total);
		///////////////////////////////////////////////////////
		$count_opt3 = 	"SELECT COUNT(*) AS votes
						FROM votes
						WHERE poll_id = '$poll_id' AND voted_for = 3";
	 	$opt3_total = mysql_query($count_opt3);
		$opt3_total = mysql_fetch_assoc($opt3_total);
		////////////////////////////////////////////////////////
		$count_opt4 = 	"SELECT COUNT(*) AS votes
						FROM votes
						WHERE poll_id = '$poll_id' AND voted_for = 4";
	 	$opt4_total = mysql_query($count_opt4);
		$opt4_total = mysql_fetch_assoc($opt4_total);
	}
	
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
		<li><a href="the7line.com/shop">Shop</a></li>
		<li><a href="logout.php">Log Out</a></li>
	</ul>	
		
		
	<div id="board_posts">	
		<h1><?php echo $th_subject; ?></h1>
		<?php if($thread_type['type'] == 'poll')
			  {
			  		echo "<div id='poll'> <h4 id='poll_title'>".$poll_results['question']."</h4><ul id='poll_options'>"; 
			  		echo "<li id='poll_opt1'>".$poll_results['option1']."<input id='opt1_vote' type='hidden' value='".$poll_results['option1'].
			  		"'/><span class='vote_tot' id='opt1-result'>".$opt1_total['votes']."</span></li>";
					echo "<li id='poll_opt2'>".$poll_results['option2']."<input id='opt2_vote' type='hidden' value='".$poll_results['option2']."'/>
					<span class='vote_tot' id='opt2-result'>".$opt2_total['votes']."</span></li>";
					
					if($poll_results['option3'] != "")
					{
						echo "<li id='poll_opt3'>".$poll_results['option3']."<input id='opt3_vote' type='hidden' value='".$poll_results['option3']."'/>
						<span class='vote_tot' id='opt3-result'>".$opt3_total['votes']."</span></li>";
					}
					if($poll_results['option4'] != "")
					{
						echo "<li id='poll_opt4'>".$poll_results['option4']."<input id='opt4_vote' type='hidden' value='".$poll_results['option4']."'/>
						<span class='vote_tot' id='opt4-result'>".$opt4_total['votes']."</span></li>";
					}
			  		echo "</ul></div>";
					echo "<input type='hidden' id='poll_id' value='".$poll_results['poll_id']."'/>";
					echo "<input type='hidden' id='voter' value='".$user."'/>";
			  }
		?>
		<table id="thread_posts">
			<?php $i = 1; ?>
			<?php foreach ($post_results as $p_result) : ?>	
				<tr>
					<td class="user_info"><p id="author"><?php echo $p_result['user_create']; ?></p>
						<img class="pro_pic" src="<?php echo "profile_pics/".$p_result['user_create'].'.jpg'; ?>" alt="<?php echo $p_result['user_create']; ?>">
						
						<img class="like" id="<?php echo 'like-'.$i; ?>" src="images/up.png"><br>
						<span id="<?php echo 'like_ct-'.$i; ?>"><?php echo $p_result['likes']; ?></span>
					</td>
					<td><div id="content_cell">
							<p id="timestamp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php echo date_format(new DateTime($p_result['date_created']), 'n/j/y g:i A'); ?></p>
						</div>
						<p id="thrd_content"><?php echo $p_result['content']; ?></p>
					</td>
					<input type="hidden" id="<?php echo 'post_id-'.$i; ?>" value="<?php echo $p_result['post_id']; ?>" />
					<input type="hidden" id="<?php echo 'like_amount-'.$i; ?>" value="<?php echo $p_result['likes']; ?>" />
					
					<input type="hidden" id="<?php echo 'quote_content'.$i; ?>" value="<?php echo $p_result['content']; ?>" />
					<input type="hidden" id="<?php echo 'quote_user'.$i; ?>" value="<?php echo $p_result['user_create']; ?>" />
					<input type="hidden" id="<?php echo 'quote_time'.$i; ?>" value="<?php echo date_format(new DateTime($p_result['date_created']), 'n/j/y g:i A'); ?>"
				</tr>
				<?php $i++; ?>
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
			<form enctype="multipart/form-data">
				<h4>Post Reply <input type="submit" id="post_reply" value="Reply"/></h4>
				<span id="reply-result"></span>
				<textarea rows="8" cols="70" id="content"></textarea><span id="reply_content-result"></span><br>
				<input class="browse" type="file" id="attachment" name="attach[]" multiple="multiple"/>
				<label for="file1" id="upload_btn">Choose a file</label>
			
				<input type="hidden" id="user" value="<?php echo $user; ?>"/>
				<input type="hidden" id="board_id" value="<?php echo $board_id; ?>"/>
				<input type="hidden" id="thread_id" value="<?php echo $thread_id; ?>"/>
				<input type="hidden" value="<?php echo $page; ?>" id="page_num" />
				<input type="hidden" value="<?php echo $total_records; ?>" id="total_posts" /> 
			</form>
		</div>
	</div>
</body>
</html>