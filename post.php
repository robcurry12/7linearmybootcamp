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
	
	$thread_type = mysqli_query($connection, $type_query);
	$thread_type = mysqli_fetch_assoc($thread_type);

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
	
	//For paging vvvvv
	/*$query = "SELECT * FROM posts
			WHERE board_id = '$board_id' AND thread_id = '$thread_id'";
	$result = mysqli_query($connection, $query);
	$total_records = mysqli_num_rows($result);

	//Using ceil function to divide the total records on per page
	$total_pages = ceil($total_records / $per_page);*/
	
	$paging_query = "SELECT * FROM posts
				WHERE board_id = '$board_id' AND thread_id = '$thread_id'";
	
	function pageThis($max, $max_page_links, $query, $page_link)
	{
		$thread_id = $_SESSION['thread_id'];
		$board_id = $_SESSION['board_id'];
				
		$host = "localhost";
		$username="root"; // Mysql username 
		$password=""; // Mysql password
		$db= "7line"; // Database name		
	
		$connection = mysqli_connect("$host", "$username", "$password", "$db")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,$db)or die("Cannot select DB");
		
		$num_stuff= mysqli_num_rows(mysqli_query($connection, $query));//Getting the total possible rows
		if (isset($_GET['page'])&&$_GET['page']>0)
		{
		    	$start=intval($_GET['page'])-1;//Now the page number make more sense (page=1 is actually the first page)
		    	$current_page=intval($_GET['page']);//Some cleaning (SQL Injection prevention, and get rid of negative numbers)
		}
		//If no parameters passed.. just give the first page
		else 
		{
		    $current_page=1;
		    $start=0;
		}
		//If a large page number passed (more than there actually is) just give the last page
		if ($current_page>ceil($num_stuff/$max))
		{
		    	$current_page=ceil($num_stuff/$max);
		    	$start=ceil($num_stuff/$max)-1;
		}
		$start*=$max;//Which row to start with
		$get_stuff_query = $query." LIMIT '$start', '$max'";//Adding the limit
		//Preparing --End--
		//Actual paging --Start--
		if ($num_stuff>$max)
		{	//Is there any need for pagin?
			if ($current_page>1)
			{	//Making previous page & first page links when needed
		        $previous_page=$current_page-1;//previousious means -1
		        echo "<a href=\"".$page_link."?page=1\">|<</a>  ";	//First page is the page number.. you guessed it right.. 1
		        echo "<a href=\"".$page_link."?page=$previous_page\"><</a> ";
		            }
		            if ($current_page>$max_page_links/2)
		           	{	//Are we going far away from the first viewed page link?
		                if (ceil($num_stuff/$max)-$current_page<(($max_page_links/2)+1))
		                {	//Are we getting closer to last viewed page link?
		                    $start_counter=$current_page-($max_page_links-(ceil($num_stuff/$max)-$current_page));//Yes, Then we need to view more page links
		                    $end_counter=ceil($num_stuff/$max);//And no need to view page links more than the query can bring
		                }
		                else
		                {
		                    $start_counter=$current_page-(($max_page_links/2)-1);//No, then just view some links before the currentrent page
		                    $end_counter=$current_page+($max_page_links/2);//And some links after
		                }
		            }
		            else
		            {	//Still in the first pages?
		                $start_counter=1;//Start with page one
		                $end_counter=ceil($num_stuff/$max);//$max_page_links;//Show only enough links
		            }
		            for ($i=$start_counter;$i<=$end_counter;$i++)
		            {	//A loop for viewing the links
		                if ($i==$end_counter)
		                {	//Is this the last link?
		                    if ($i==$current_page)
		                    {	//Are we actually on the last page? Because we don't need the | after the link
		                        echo "<a style='color: black;'>".$i."</a>";//Then make it look like we're on that page
		                    }
		                    else
		                    {
		                        echo "<a href=\"".$page_link."?page=".$i."\">".$i."</a>";//Well yeah, it's the last link.. but we're not there yet.
		                    }
		                }
		                else
		                {	//Not the last page you say.. mmm.. then print normally (with | after the link)
		                    if ($i==$current_page)
		                    {//Are we vewing this page?
		                        echo "<a style='color: black;'>".$i."</a>   ";//Make us know it
		                    }
		                    else
		                    {	//Not viewing.. just a normal link (the most common case here)
		                        echo "<a href=\"".$page_link."?page=".$i."\">".$i."</a>   ";//Nothing to say
		                    }
		                }
		            }
		            if ($current_page<ceil($num_stuff/$max))
		            {	//Making the next and last page links
		                $next_page=$current_page+1;//Next means +1
		                $last_page=ceil($num_stuff/$max);//and the last page is the page.. whell.. it's the last one the query can bring
		                echo "  <a href=\"".$page_link."?page=$next_page\">></a>";
		                echo "  <a href=\"".$page_link."?page=$last_page\">>|</a>";
		            }
		}
	}
	

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
					<td class="user_info"><p id="author"><?php echo "<a class='profile_link' href='profile.php?profile=".$p_result['user_create']."'>". $p_result['user_create']."</a>"; ?></p>
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
		<div class="paging" id="p_paging">
		<?php
			pageThis($per_page, 4, $paging_query, 'post.php');
			/*if($total_pages < 2)
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
			}*/
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
			</form>
		</div>
	</div>
</body>
</html>