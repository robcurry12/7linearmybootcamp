<?php
	include("session.php"); 
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
	$board_query = 	"SELECT board_id, board_name, description, 
					(SELECT COUNT(t.thread_id)
					FROM threads t 
					WHERE t.board_id = b.board_id) as num_threads 
					FROM boards b";
			
	$results = $db->query($board_query);
	$i = 1;
	
	include('header.php');
?>
	<div id="bd_home">
		<h3>Headquarters</h3>
		<ul id="bd_list">
			<?php foreach ($results as $result) : ?>	
			<?php $board_link = 'threads.php?board_id='.$result['board_id']; ?>
				<li><div class="board_divs" id="<?php echo "boards".$i; ?>">
					<a class="bd_name link_btn" href="<?php echo $board_link;?>"><?php echo $result['board_name']; ?></a>
					<a class="bd_thrd_ct link_btn" href="<?php echo $board_link;?>"><?php echo $result['num_threads']; ?> Threads</a>
					<a class="bd_desc link_btn" href="<?php echo $board_link;?>"><?php echo $result['description']; ?></a>
				</div></li>
			<?php $i= $i+1; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	
</body>
</html>
