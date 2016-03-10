$(document).ready(function() 
{	
	//Testing password pattern
	function isValid(str)
	{
 		return !/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
	
	//Registration
	var user_good = false;
	var email_good = false;
	var pass_good = false;
	var email_match = false;
	var pass_match = false;
	
	//Prohibts enter key submitting values TEMPORARY
	$('.noenter').submit(function() 
	{
  		return false;
 	});

	//LIST OF FEATURES TO CODE
	// 1. Stylize Error Messages
	// 4. Making sure email is correct format
	// 5. Make border of input box red when username/email is taken already

	//Check if user exists in database already		//Stylize message
	$("#newuser").focusout(function (e) 
	{
		//removes spaces
		var newuser = $(this).val();
		newuser = newuser.replace(/\s/g, '');
		if(!isValid(newuser))
		{		
			$("#newuser-result").html('Usernames cannot contain special characters');
			return;
		}	
		if(newuser.length < 3)
		{
			$("#newuser-result").html('Username must be at least 3 characters long');
			return;
		}
		if(newuser.length >= 3)
		{
			//$("#newuser-result").html('<img src="images/ajax-loader.gif" />');
			$.post('check_user.php', {'username':newuser}, function(data) 
			{
			  $("#newuser-result").html(data);	// Stylize this message
			  $("#newuser-result").find("img").each(function () 
				{
    				var src = $(this).attr("src"); 
    				if(src == "images/available.png")
    				{
    					user_good = true;
    				}
    				else
    				{
    					user_good = false;
    				}
    			});	
			});
			return;
		}
	});
	
	//Check if email exists in database		//Stylize message
	$("#newemail").focusout(function (e) 
	{
		//removes spaces
		var newemail = $(this).val();
		newemail = newemail.replace(/\s/g, '');
		if(newemail.length < 3)
		{
			$("#newemail-result").html('');
			return;
		}
		if(newemail.length >= 3)
		{
			$.post('check_user.php', {'email':newemail}, function(data) 
			{
			  $("#newemail-result").html(data); //Stylize message
			  $("#newemail-result").find("img").each(function () 
				{
    				var src = $(this).attr("src"); 
    				if(src == "images/available.png")
    				{
    					email_good = true;
    					$(this).val().toLowerCase();
    				}
    				else
    				{
    					email_good = false;
    				}
    			});	
			});		
			return;
		}
	});
	
	//Confirming email
	$("#confirmemail").focusout(function (e) 
	{
		//removes spaces
		var confirmemail = $(this).val();
		var firstemail = $("#newemail").val();
		if(confirmemail.length < 2)
		{
			$("#confirmemail-result").html('');
			return;
		}
		else if(confirmemail.length < firstemail.length)
		{
			$("#confirmemail-result").html('Emails do not match!');
			return;
		}
		if(confirmemail.toLowerCase() == firstemail.toLowerCase())
		{
			$("#confirmemail-result").html('Emails match!');
			email_match = true;
			$(this).val().toLowerCase();
			return;
		}
	});

	//Checking password
	$("#newpass1").focusout(function(e)
	{
		var password = $("#newpass1").val();
		if(password.length >= 6)
		{
			if(!isValid(password))
			{
				$("#newpass-result").html('Password cannot contain special characters');
				return;
			}
			else
			{
				pass_good = true;
				return;
			}
		}
	});
	
	$("#newpass2").focusout(function(e)
	{
		var password = $("#newpass1").val();
		var confirm = $("#newpass2").val();
		if(password == confirm)
		{
			$("#con_pass-result").html('Passwords match!');
			pass_match = true;
		}
		else
		{
			$("#con_pass-result").html('Passwords do not match!');
		}
	});
	
	//Preventing bad username/email/password entering
	$("#new_acc").click(function()
	{
		if((user_good == true) && (email_good == true) && (pass_good == true) && (email_match == true) && 
			(pass_match == true))
		{
			var reg_user = $("#newuser").val();
			var reg_email = $("#newemail").val();
			var reg_pass = $("#newpass1").val();
			
			$.ajax
			({
	            type: "POST",
	            data: "username=" + reg_user + "&email=" + reg_email + "&pass=" + reg_pass,
	            url: "add_user.php",
	            success: function() {
	                window.location.href="user_home.php";
	                return false;
	                //$("#email_activate").css('display', 'block');
	            }
        	});			
		}
		else
			$("#register-result").html('Please correctly fill in the fields below');
	});
	
	//Sign In 
	$("#sign_in").click(function()
	{		
		var username = $("#sign_in_user").val();
		var password = $("#sign_in_pass").val()
		
		if((username.length == 0) || (password.length == 0))
		{
			$("#login-result").html('All fields are required');
			return;
		}
		else
		{
			$.ajax
			({
	            type: "POST",
	            data: "user_sign=" + username + "&pass_sign=" + password,
	            url: "check_user.php",
	            success: function(result) 
	            {
	                $("#login-result").html(result);
	            
	            
		            if($("#login-result").html().length == 0) 
		            {
	  					window.location.href="login.php";
	  					return false;
					}
	            	return false;
	           }
      		});
		}	
	});

	$("#register_popup").click(function()
	{
		$("#register").css("display", "block");
		$("#login").css("display", "none");
		$("#signin-result").html('');
	});
	
	$("#register_exit").click(function()
	{
		$("#register").css("display", "none");
		$('#login').css("display", "block");
		$("#newuser-result").html('');
		$("#newemail-result").html('');
		$("#confirmemail-result").html('');
		$("#newpass-result").html('');
		$("#con_pass-result").html('');
		$(".text").val('');	
	});
});