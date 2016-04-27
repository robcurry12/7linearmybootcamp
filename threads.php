<?php
	include('session.php');
	include('functions.php');
	$user = $_SESSION['loggedin_user'];
	
	if (isset($_GET['board_id'])) 
	{
		$board_id = $_GET['board_id'];
		if(($board_id > 4) || (!ctype_digit($board_id))|| ($board_id < 1))	//Protects against altering of URL
			header('Location: board_home.php');
		
		$_SESSION['board_id'] = $board_id;
		$board_query = 	"SELECT board_name FROM boards WHERE board_id = '$board_id'";
		$board_result = mysqli_query($connection, $board_query);
		$board_result = mysqli_fetch_assoc($board_result);
		$board_name = $board_result['board_name']; 
	}
	else 
	{
		header('Location: board_home.php');
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
	
	$per_page = 12;
	if (isset($_GET["b_page"])) 
	{
		$page = $_GET["b_page"];
	}
	else 
	{
		$page=1;
	}
	$start_from = ($page-1) * $per_page;	
	$threads_query = "SELECT thread_id, subject, user_create, last_update, type,
					(SELECT COUNT(p.post_id) posts
					FROM posts p
					WHERE t.thread_id = p.thread_id) AS post_count
					FROM threads t
					WHERE board_id = '$board_id'
					ORDER BY (type = 'sticky') DESC, last_update DESC
					LIMIT $start_from, $per_page";
					
	$results = $db->query($threads_query);
	
	
	$board_paging_query = 	"SELECT thread_id, subject, user_create, last_update, type,
							(SELECT COUNT(p.post_id) posts
							FROM posts p
							WHERE t.thread_id = p.thread_id) AS post_count
							FROM threads t
							WHERE board_id = '$board_id'
							ORDER BY last_update DESC";
							
	include('header.php');
?>

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
			<?php $thread_link = "post.php?board_id=".$board_id."&thread_id=".$result['thread_id']; ?>	
				<tr class="thread_row">
					<td class="thds subject">	<?php if($result['type'] == "poll") echo "<img class='poll_thread' style='height: 15px' src='images/poll.png'>"; ?>
												<?php if($result['type'] == "sticky") echo "<img class='poll_thread' style='height: 15px' src='images/sticky.png'>"; ?>
						<a class="link_btn" href="<?php echo $thread_link; ?>"><?php echo $result['subject']; ?></a></td>
					<td class="thds threads"><a class="link_btn thread_link" href="<?php echo $thread_link; ?>"> <?php echo $result['user_create']; ?></a></td>
					<td class="thds threads"><a class="link_btn thread_link" href="<?php echo $thread_link; ?>"> <?php echo date_format(new DateTime($result['last_update']), 'n/j/y g:i A'); ?></a></td>
					<td class="thds threads"><a class="link_btn thread_link" href="<?php echo $thread_link; ?>"> <?php echo $result['post_count']; ?> </a></td>
				</tr>
			<?php endforeach ?>
		</table>
		
		<div class="paging thread_page" id="p_paging">
			<?php	$paging = 'threads.php?board_id='.$board_id.'&'; 
				pageBoard($per_page, 3, $board_paging_query, $paging, $board_id);?>
		</div>
		
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