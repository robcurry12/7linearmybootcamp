<?php
	include("session.php");
	include("functions.php");
	$user = $_SESSION['loggedin_user'];
	
	//Validating the board_id in the URL
	if (isset($_GET['board_id'])) 
	{
		$board_id = $_GET['board_id'];
		if(($board_id > 4) || (!ctype_digit($board_id))|| ($board_id < 1))	//Protects against altering of URL
			header('Location: board_home.php');
	}
	else 
	{
		header('Location: board_home.php');
	}
	
	//Validating the thread_id in the URL
	if (isset($_GET["thread_id"])) 
	{
		$thread_id = $_GET["thread_id"];
		if(is_nan($thread_id))
			header('Location: threads.php?board_id='.$board_id);
		else
		{
			$_SESSION['thread_id'] = $thread_id;
			$thread_query = "SELECT subject FROM threads WHERE board_id = '$board_id' AND thread_id = '$thread_id'";
			$thread_result = mysqli_query($connection, $thread_query);
			if(mysqli_num_rows($thread_result) == 0)
			{
				header('Location: threads.php?board_id='.$board_id);
			}
			else
			{
				$thread_result = mysqli_fetch_assoc($thread_result);
				$th_subject = $thread_result['subject'];
			}
		}
	}
	else 
	{
		header('Location: threads.php?board_id='.$board_id);
	}
	
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
	
	//paging
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
	$post_query = 	"SELECT user_create, board_id, thread_id, date_created, content, post_id, type,
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
	
	$thread_type = mysqli_query($connection, $type_query);
	$thread_type = mysqli_fetch_assoc($thread_type);

	//Getting information for poll posts
	if($thread_type['type'] == 'poll')
	{
		$poll_query =	"SELECT poll_id, question, option1, option2, option3, option4
						FROM polls
						WHERE thread_id = '$thread_id'";
		$poll_results = mysqli_query($connection, $poll_query);
		$poll_results = mysqli_fetch_assoc($poll_results);
		
		$poll_id = $poll_results['poll_id'];
		////////////////////////////////////////////////////////
		$count_opt1 = 	"SELECT COUNT(*) AS votes
						FROM votes
						WHERE poll_id = '$poll_id' AND voted_for = 1";
	 	$opt1_total = mysqli_query($connection, $count_opt1);
		$opt1_total = mysqli_fetch_assoc($opt1_total);
		///////////////////////////////////////////////////////
		$count_opt2 =	"SELECT COUNT(*) AS votes
						FROM votes
						WHERE poll_id = '$poll_id' AND voted_for = 2";
	 	$opt2_total = mysqli_query($connection, $count_opt2);
		$opt2_total = mysqli_fetch_assoc($opt2_total);
		///////////////////////////////////////////////////////
		$count_opt3 = 	"SELECT COUNT(*) AS votes
						FROM votes
						WHERE poll_id = '$poll_id' AND voted_for = 3";
	 	$opt3_total = mysqli_query($connection, $count_opt3);
		$opt3_total = mysqli_fetch_assoc($opt3_total);
		////////////////////////////////////////////////////////
		$count_opt4 = 	"SELECT COUNT(*) AS votes
						FROM votes
						WHERE poll_id = '$poll_id' AND voted_for = 4";
	 	$opt4_total = mysqli_query($connection, $count_opt4);
		$opt4_total = mysqli_fetch_assoc($opt4_total);
	}

	//Used in pageThis function
	$paging_query = "SELECT * FROM posts
				WHERE board_id = '$board_id' AND thread_id = '$thread_id'";
	
	include('header.php');
?>
		
	<div id="board_posts">	
		<h1 id="thread_subject"><?php echo $th_subject; ?></h1>
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
					<td class="user_info"><p id="author"><?php echo "<a class='profile_link' href='profile.php?profile=".$p_result['user_create']."'>". $p_result['user_create']."</a>"; ?></p>
						<img class="pro_pic" src="<?php echo "profile_pics/".$p_result['user_create'].'.jpg'; ?>" alt="<?php echo $p_result['user_create']; ?>">
						
						<img class="like" src="images/up.png" data-postId-type="<?php echo $p_result['post_id']; ?>"
							data-userCreate-type="<?php echo $p_result['user_create']; ?>"><br>
						<span id="<?php echo 'like_ct-'.$p_result['post_id']; ?>"><?php echo $p_result['likes']; ?></span>
					</td>
					<td><div id="content_cell">
							<p id="timestamp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php echo date_format(new DateTime($p_result['date_created']), 'n/j/y g:i A'); ?></p>
							<p><?php if($admin_loggedIn == 0) echo "<img class='flag' src='images/flag.png' alt='Report post' style='height: 20px'
									data-postId-type=".$p_result['post_id']." 
									data-reportContent-type=".$p_result['content']." 
									data-reportedUser-type=".$p_result['user_create']." 
									data-postType-type=".$p_result['type']; ?></p>
						</div>
						<p id="thrd_content"><?php echo $p_result['content']; ?></p>
					</td>
					
					<input type="hidden" id="<?php echo 'content'.$p_result['post_id']; ?>" value="<?php echo $p_result['content']; ?>" />
				</tr>
				<?php $i++; ?>
			<?php endforeach ?>
		</table>
		
		<div id="report_post">
			<a id="report_exit">&#10005;</a>
			<h1>Report Post</h1>
			<span id="report_error"></span>
			<p><b id="bold_user"></b>: "<i id="report_content"></i>"</p><br>
			<label id="what_wrong"><b>What is wrong with this post?</b></label><br>
			<input id="report_spam" name="reporting" class="radio_opt rbtns report" type="radio" value="Spam"> 
				<label class="radio_opt" for="report_spam">Spam post</label> <br>
				
			<input id="report_inapprop" name="reporting" class="radio_opt rbtns report" type="radio" value="Inappropriate"> 
				<label class="radio_opt" for="report_inapprop">Inappropriate content</label><br>
				
			<input id="report_abuse" name="reporting" class="radio_opt rbtns report" type="radio" value="Abusive/Harmful"> 
				<label class="radio_opt" for="report_abuse">Abusive or harmful</label><br>
			
			<input id="submit_report" class="t7l_btn" type="submit" value="Send Report" >
			<input type="hidden" id="reported_user" value="">
			<input type="hidden" id="reported_content" value="">
			<input type="hidden" id="reporter" value="">
			<input type="hidden" id="r_thread_id" value="">
			<input type="hidden" id="r_post_id" value="">
			<input type="hidden" id="r_board_id" value="">
		</div>
		
		<div class="paging" id="p_paging">
			<?php $paging = 'post.php?board_id='.$board_id.'&thread_id='.$thread_id.'&'; ?>
			<?php  pagePosts($per_page, 3, $paging_query, $paging, $board_id); ?>
		</div>
		<div id="reply_post">
				<h4>Post Reply <input type="submit" id="post_reply" value="Reply"/></h4>
				<span id="reply-result"></span>
				<textarea rows="8" cols="70" id="content"></textarea><span id="reply_content-result"></span><br>
			
				<input type="hidden" id="user" value="<?php echo $user; ?>"/>
				<input type="hidden" id="board_id" value="<?php echo $board_id; ?>"/>
				<input type="hidden" id="thread_id" value="<?php echo $thread_id; ?>"/>
				<input type="hidden" value="<?php echo $page; ?>" id="page_num" />
			</form>
		</div>
	</div>
</body>
</html>