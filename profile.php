<?php 
	include("session.php"); 
	$user = $_GET['profile'];

	$info_query = 	"SELECT DATE_FORMAT(date_join, '%c/%e/%y') AS date_join,
							 birthday, gender, image, last_active 
					FROM users 
					WHERE username = '$user'";
	
	$results = mysqli_query($connection, $info_query);
	$user_info = mysqli_fetch_assoc($results);
	
	$num_posts_query = 	"SELECT COUNT(post_id) as num_posts
						FROM posts
						WHERE user_create = '$user'";
						
	$npq_results = mysqli_query($connection, $num_posts_query);
	$num_posts = mysqli_fetch_assoc($npq_results);
	
	$num_likes_query = "SELECT COUNT(*) as num_likes
						FROM likes
						WHERE post_user = '$user' AND user != post_user";
	
	$nlq_results = mysqli_query($connection, $num_likes_query);
	$num_likes = mysqli_fetch_assoc($nlq_results);		
	
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
	
	$right_now = date('n/j/y g:i A');
	$last_active = date('n/j/y g:i A', strtotime($user_info['last_active']));
	//*************************
	//*  Date formatting code *
	//*************************
	//date('Y', strtotime('2011-01-01')
	if(date('y', strtotime($right_now)) == date('y', strtotime($last_active)))										//Year
	{
		if(date('n', strtotime($right_now)) == date('n' , strtotime($last_active)))								//Month
		{
			if(date('j', strtotime($right_now)) == date('j' , strtotime($last_active)))								//Day
			{
				$date_format = 'g:i A';
			}
			else 														
			{
				$date_format = 'n/j g:i A';
			}
		}
		else 
		{
				$date_format = 'n/j g:i A';
		}
	}
	else 
	{
		$date_format = 'n/j/y g:i A';
	}	
	
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel='shortcut icon' type='favicon.png' href='images/favicon.png'/ >
	<title><?php echo ucfirst($user)."'s Camp "; ?></title>
	<link rel="stylesheet" href="css/t7l.css" type="text/css">
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="user.js"></script>
	<script src="upload.js"></script>
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

	<div id="user_home">
		<div id="profile_info">
				<img id="home_propic" src="<?php echo 'profile_pics/'.$user_info['image']; ?>" alt="<?php echo $user; ?>">
				
				<h3><?php echo $user; ?></h3>
				<h4>Last Active: <?php echo date_format(new DateTime($user_info['last_active']), $date_format); ?></h4>
				<h4>Enlisted since: <?php echo $user_info['date_join']; ?></h4>
				<h4 class="edit"><?php echo ucfirst($user_info['gender']); ?></h4>
				<h4 class="edit"><b>Birthday:</b> <?php echo $user_info['birthday']; ?></h4>	
				<h4>Number of posts: <?php echo $num_posts['num_posts']; ?></h4>
				<h4>Post Likes: <?php echo $num_likes['num_likes']; ?></h4>
		</div>
	</div>
</body>
</html>