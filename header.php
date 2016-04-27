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
	<script src="admin.js"></script>
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
		<li><a href="logout.php">Log Out  <span id="loggedIn_user">(<?php echo $user; ?>)</span></a></li>
	</ul>