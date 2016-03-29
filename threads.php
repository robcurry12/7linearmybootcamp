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
						
	function pageThis($max, $max_page_links, $query, $page_link)
	{
		//max = 12
		//max page links = 2
		$board_id = $_SESSION['board_id'];
				
		$host = "localhost";
		$username="root"; // Mysql username 
		$password=""; // Mysql password
		$db= "7line"; // Database name		
	
		$connection = mysqli_connect("$host", "$username", "$password", "$db")or die("Cannot connect"); 
		$database = mysqli_select_db($connection,$db)or die("Cannot select DB");
		
		$num_stuff= mysqli_num_rows(mysqli_query($connection, $query));//Getting the total possible rows
		if (isset($_GET['b_page'])&&$_GET['b_page']>0)
		{
		    	$start=intval($_GET['b_page'])-1;//Now the page number make more sense (page=1 is actually the first page)
		    	$current_page=intval($_GET['b_page']);//Some cleaning (SQL Injection prevention, and get rid of negative numbers)
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
		if ($num_stuff>$max) //Is there any need for paging?
		{
			if ($current_page>1) //Yes and we are not at the first page --> Creating previos + first page links
			{	
		        $previous_page=  $current_page - 1;	//previous means -1
		        echo "<a href=\"".$page_link."?b_page=1\">|<</a>  ";	//First page is the page number.. you guessed it right.. 1
		        echo "<a href=\"".$page_link."?b_page=$previous_page\"><</a> ";
		    }
		    if ($current_page > $max_page_links / 2)//Are we going far away from the first viewed page link?
		    {	
		    	if (ceil($num_stuff / $max) - $current_page <(($max_page_links / 2) + 1)) //Are we getting closer to last viewed page link?
		        {
		        	$start_counter=$current_page-($max_page_links-(ceil($num_stuff/$max)-$current_page)); //Yes, Then we need to view more page links
		            $end_counter=ceil($num_stuff/$max);	//And no need to view page links more than the query can bring
		            $poop = "I came here second iff";
		        }
		        else
		 	    {
		    	    $start_counter=$current_page-(($max_page_links/2)-1);//No, then just view some links before the current page
		    	   	$poop = "I came here";
		            $end_counter=$current_page+($max_page_links/2);//And some links after
		        }
		     }
		     else //Still in the first pages?
		     {	
		     	$start_counter=1; //Start with page one
		        $end_counter=ceil($num_stuff/$max);  //$max_page_links;//Show only enough links
		        $poop = "I came here why"; 
		     }
			 if($start_counter <= 0)
			 {
			 	$start_counter = 1;
			 }
		     for ($i=$start_counter; $i<=$end_counter; $i++)
		     {	//A loop for viewing the links
		     	if ($i==$end_counter)
		        {	//Is this the last link?
		        	if ($i==$current_page)
		            {	//Are we actually on the last page? Because we don't need the | after the link
		            	echo "<a style='color: black;'>".$i."</a>";//Then make it look like we're on that page
		            }
		            else
		            {	//Issue with 0 being printed
		            	echo "<a href=\"".$page_link."?b_page=".$i."\">".$i."</a>";//Well yeah, it's the last link.. but we're not there yet.
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
		            	echo "<a href=\"".$page_link."?b_page=".$i."\">".$i."</a>   ";//Nothing to say
		            }
		      	  }
		      }
		      if ($current_page<ceil($num_stuff/$max))
		      {	//Making the next and last page links
		      	$next_page=$current_page+1;//Next means +1
		      	$last_page=ceil($num_stuff/$max);//and the last page is the page.. whell.. it's the last one the query can bring
		      	echo "  <a href=\"".$page_link."?b_page=$next_page\">></a>";
		      	echo "  <a href=\"".$page_link."?b_page=$last_page\">>|</a>";
		      }
		}
	}
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
				<tr class="thread_row">
					<td class="thds subject">	<?php if($result['type'] == "poll") echo "<img class='poll_thread' style='height: 15px' src='images/poll.png'>"; ?>
												<?php if($result['type'] == "sticky") echo "<img class='poll_thread' style='height: 15px' src='images/sticky.png'>"; ?>
						<input class="link_btn" type="submit" value="<?php echo $result['subject']; ?>"/><br>
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
		
		<div class="paging thread_page" id="p_paging">
			<?php pageThis($per_page, 3, $board_paging_query, 'threads.php');?>
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