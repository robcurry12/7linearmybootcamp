$(document).ready(function() 
{	
	$("#new_thread").click(function()
	{
		$("#create_thread").css("display","block");
		$("#threads").css("display", "none");
		$(this).css("display", "none");
		$("#title").css("display","none");
	});
	
	$("#thread_exit").click(function()
	{
		$("#create_thread").css("display", "none");
		$("#threads").css("display", "");
		$("#title").css("display", "block");
		$("#new_thread").css("display", "block");
	});
	
	$("#post_thread").click(function()
	{
		var subject = $("#new_subj").val();
		var content = $("textarea#content").val();
		var board = $("#board_id").val();
		var user = $("#user").val();
		$("#subject-result").html('');
		$("#content-result").html('');
		$("#thread-result").html('');
		
		if(subject == "")
		{
			if(content == "")
			{
				$("#thread-result").html("Fields cannot be empty");
				return;
			}
			else
			{
				$("#subject-result").html("Cannot be empty");
				return;
			}
		}
		if(content == "")
		{
			$("#content-result").html("Cannot be empty");
			return;
		}
		else
		{
			$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&subject=" + subject + "&content=" + content + "&board_id=" + board,
	            url: "add_thread.php",
	            success: function(result) 
	            {
	  				window.location.href="threads.php";
	  				return false;
	           }
      		});
		}
	});
	
	$("#post_reply").click(function()
	{
		var content = $("textarea#content").val(); 
		var user = $("#user").val();
		var board = $("#board_id").val();
		var thread = $("#thread_id").val();
		var page_num = $("#page_num").val();
		var total_posts = $("#total_posts").val();
		
		if(content == "")
		{
			$("#reply_content-result").html("Cannot be empty");
			return;
		}
		else
		{
			
			$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&board_id=" + board + "&content=" + content + "&thread_id=" + thread + "&total_posts=" + total_posts,
	            url: "reply_thread.php",
	            success: function(result) 
	            {
	            	$("textarea#content").val('');
	            	window.location.href="post.php";
	  				return false;
	           }
      		});
		}
	});
	
});