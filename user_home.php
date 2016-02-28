<?php
	include("session.php"); 
	$user = $_SESSION['loggedin_user'];
	
	//REVISE LATER TO INCLUDE NUMBER OF POSTS
	$info_query = 	"SELECT DATE_FORMAT(date_join, '%c/%e/%y') AS date_join,
							 birthday, gender, image 
					FROM users 
					WHERE username = '$user'";
	
	$results = mysql_query($info_query);
	$user_info = mysql_fetch_assoc($results);
	
	$num_posts_query = 	"SELECT COUNT(post_id) as num_posts
						FROM posts
						WHERE user_create = '$user'";
						
	$npq_results = mysql_query($num_posts_query);
	$num_posts = mysql_fetch_assoc($npq_results);
	
	//Prevents NULL being displayed for gender
	if($user_info['birthday'] == NULL)
	{
		$user_info['birthday'] = "MM/DD";
	}
	
	//Prevents NULL being displayed for gender
	if($user_info['gender'] == NULL)
	{
		$user_info['gender'] = "Not specified";
	}
	
	//Default profile picture
	if($user_info['image'] == NULL)
	{
		$user_info['image'] = "images/defaultpro.jpg";
	}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel='shortcut icon' type='favicon.png' href='images/favicon.png'/ >
	<title><?php echo ucfirst($user)."'s Home Base"; ?></title>
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
		<li><a href="logout.php">Log Out</a></li>
	</ul>

	<div id="user_home">
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
		
		<div>
			
		</div>
		
	</div>
</body>
</html>