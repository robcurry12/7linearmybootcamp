<?php
	include("session.php"); 
	if(isset($_SESSION['board_id']) || (isset($_SESSION['board_name'])))
	{
		unset($_SESSION['board_id']);
		unset($_SESSION['board_name']);
	}
	$user = $_SESSION['loggedin_user'];
	
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
	$board_query = 	"SELECT board_id, board_name, description, icon 
					FROM boards";
				
	/*$t_ct = mysql_query($thread_count);
	$t_ct = mysql_fetch_assoc($t_ct);*/
	$results = $db->query($board_query);
	$i = 1;
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel='shortcut icon' type='favicon.png' href='images/favicon.png'/ >
	<title>Boards</title>
	<link rel="stylesheet" href="css/t7l.css" type="text/css">
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
		<h3>Headquarters</h3>
		<ul id="bd_list">
			<?php foreach ($results as $result) : ?>	
			<form action="nav_thread.php" method="get">	
				<li><div id="board_divs" class="<?php echo "boards".$i; ?>">
					<input class="link_btn bd_link" id="bd_name" type="submit" value="<?php echo $result['board_name']; ?>"/><br>
					<input class="link_btn bd_link" id="bd_desc" type="submit" value="<?php echo $result['description']; ?>"/>
					<input type="hidden" value="<?php echo $result['board_id']; ?>" name="bd_id" />
					<input type="hidden" value="<?php echo $result['board_name']; ?>" name="bd_name" />
				</div></li>
			</form>
			<?php $i= $i+1; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	
</body>
</html>
