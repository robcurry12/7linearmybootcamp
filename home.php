<?php
	if(isset($_SESSION['loggedIn']))
		header('Location: loggedIn.php');

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel='shortcut icon' type='favicon.png' href='images/favicon.png'/ >
	<title>The 7 Line Army Bootcamp</title>
	<link rel="stylesheet" href="css/t7l.css">
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="ajaxloginsignup.js"></script>
</head>

<body>
	<header>
		<img src="images/headerfinal.png" alt="The 7 Line Army Bootcamp">
	</header>
	
	<div class="home" id="login">
		<span id="signin-result"></span>
		<h1>Sign In</h1>
		<form class="noenter" method="post">
			
			<label>Username: </label>
			<input class="text" type="text" id="sign_in_user" name="username"/> <span id="user-result"></span><br>
			
			<label>Password: </label>
			<input class="text" type="password" id="sign_in_pass" name="password"/> <span id="pass-result"></span> <br>
			
			<input class="homepage" type="submit" id="sign_in" value="Sign In"/>
			
		</form>
		<h4>Not a member? <a id="register_popup" href="#">Register here!</a></h4>
	</div>
	
	<div class="hidden home" id="register">
		<a href="#" id="register_exit">&#10005;</a>
		<h1>Register</h1>
		<span id="register-result"></span>
		
		<form class="noenter" method="post">
			<label>Username: </label>
			<input class="text" id="newuser" type="text" name="newuser" maxlength="20"/> <span id="newuser-result"></span><br>
			
			<!--- Stylize HTML error message --->
			<label>Email: </label>
			<input class="text" id="newemail" type="email" name="newemail1"/> <span id="newemail-result"></span> <br>
			
			<label>Confirm Email: </label>
			<input class="text" id="confirmemail" type="email" name="newemail2"/><span id="confirmemail-result"></span><br>
			
			<label>Password: </label>
			<input class="text" type="password" id="newpass1" name="newpass1"/><span id="newpass-result"></span><br>
			
			<label>Confirm Password: </label>
			<input class="text" type="password" id="newpass2" name="newpass2" /><span id="con_pass-result"></span><br>

			<input class="homepage" type="submit" id="new_acc" value="Register" />
		</form>
	</div>
	
</body>
</html>