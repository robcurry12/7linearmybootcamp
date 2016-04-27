$(document).ready(function() 
{	
	$("#new_thread").click(function()
	{
		$("#create_thread").css("display","block");
		$("#threads").css("display", "none");
		$(this).css("display", "none");
		$("#title").css("display","none");
		$("#p_paging").css("display", "none");
	});
	
	$("#thread_exit").click(function()
	{
		$("#create_thread").css("display", "none");
		$("#threads").css("display", "");
		$("#title").css("display", "block");
		$("#new_thread").css("display", "block");
		$("#poll_post").attr("checked", false);
		$("#p_paging").css("display", "block");
	});
	
	
	//Includes poll posting
	$("#post_thread").click(function()
	{
		var subject = $("#new_subj").val();
		var content = $("textarea#content_ta").val();
		var board = $("#board_id").val();
		var user = $("#user").val();
		
		$("#thread-result").html('');
		var errors = 0;
	
		if($("#poll_post").is(':checked'))
		{
			if($("#poll_question").val() == '')
			{
				$("#thread-result").append('<li>Enter in a poll question</li>');
				errors++;
				
				if($("#2opt").is(':checked') && ($("#2opt1").val() == "") || ($("#2opt2").val() == ""))
				{
					$("#thread-result").append('<li>Fill out both options</li>');
					errors++;
				}
				if($("#3opt").is(':checked') && ($("#3opt1").val() == "") || ($("#3opt2").val() == "") || ($("#3opt3").val() == ""))
				{
					$("#thread-result").append('<li>Fill out all three options</li>');
					errors++;
				}
				if($("#4opt").is(':checked') && ($("#4opt1").val() == "") || ($("#4opt2").val() == "") || ($("#4opt3").val() == "") || ($("#4opt4").val() == ""))
				{
					$("#thread-result").append('<li>Fill out all four options</li>');
					errors++;
				}
			}
		}
		if(subject == "")
		{
			$("#thread-result").append('<li>Subject cannot be empty</li>');
			errors++;
		}
		if((content == "") || (content == undefined)) 
		{
			$("#thread-result").append('<li>Content cannot be empty</li>');
			errors++;
		}
		if(errors > 0)
		{
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			return;
		}
		else
		{
			if($("#poll_post").is(':checked'))
			{
				var thread_type = "poll";
				var poll_question = $("#poll_question").val();
				if($("#2opt").is(':checked'))
				{
					var opt1 = $("#2opt1").val();
					var opt2 = $("#2opt2").val();
					$.ajax
					({
		            	type: "POST",
		            	data: "user=" + user + "&subject=" + subject + "&content=" + content + "&board_id=" + board + "&type=" + thread_type 
		            	+ "&poll_q=" + poll_question + "&opt1=" + opt1+ "&opt2=" + opt2,
		            	url: "add_thread.php",
		            	success: function(result) 
		            	{
		  					window.location.href="threads.php";
		  					return false;
		          	 	}
	      			});
				}
				if($("#3opt").is(':checked'))
				{
					var opt1 = $("#3opt1").val();
					var opt2 = $("#3opt2").val();
					var opt3 = $("#3opt3").val();
					$.ajax
					({
		            	type: "POST",
		            	data: "user=" + user + "&subject=" + subject + "&content=" + content + "&board_id=" + board + "&type=" + thread_type 
		            	+ "&poll_q=" + poll_question + "&opt1=" + opt1+ "&opt2=" + opt2+ "&opt3=" + opt3,
		            	url: "add_thread.php",
		            	success: function(result) 
		            	{
		  					window.location.href="threads.php";
		  					return false;
		          	 	}
	      			});
				}
				if($("#4opt").is(':checked'))
				{
					var opt1 = $("#4opt1").val();
					var opt2 = $("#4opt2").val();
					var opt3 = $("#4opt3").val();
					var opt4 = $("#4opt4").val();
					$.ajax
					({
		            	type: "POST",
		            	data: "user=" + user + "&subject=" + subject + "&content=" + content + "&board_id=" + board + "&type=" + thread_type 
		            	+ "&poll_q=" + poll_question + "&opt1=" + opt1+ "&opt2=" + opt2+ "&opt3=" + opt3+ "&opt4=" + opt4,
		            	url: "add_thread.php",
		            	success: function(result) 
		            	{
		  					window.location.href="threads.php";
		  					return false;
		          	 	}
	      			});
				}

			}
			else
			{
				var thread_type = "";
				$.ajax
				({
		            type: "POST",
		            data: "user=" + user + "&subject=" + subject + "&content=" + content + "&board_id=" + board + "&type=" + thread_type,
		            url: "add_thread.php",
		            success: function(result) 
		            {
		  				window.location.href="threads.php";
		  				return false;
		           }
	      		});
	      	}
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
			$("#reply_content-result").html("<b>Cannot be empty</b>");
			return false;
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
	           		window.location.href="post.php?board_id=" + board + "&thread_id=" + thread;
	  				return;
	           }
      		});
		}
	});
	
	$(".like").click(function()
	{
		var post_id = $(this).attr('data-postId-type');
		var post_user = $(this).attr('data-userCreate-type');
		var user = $("#user").val();
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-" + post_id).html(result);
	  				return;
	           }
      		});
	});
	//Polling START
	$("#poll_post").click(function()
	{
		if($("#poll_post").is(':checked'))
		{
			$("#poll_question").css("display","block");
			$("#poll_question_label").css("display", "block");	
			$(".radio_opt").css("display", "inline-block");
			$("#options").css("display", "block");
			$(".radio_opt").removeAttr("checked");	
			$("#post_thread").attr("disabled", 'true');
		}
		else
		{
			$("#poll_question").css("display","none");
			$("#poll_question_label").css("display", "none");
			$(".radio_opt").css("display", "none");
			$("#options").css("display", "none");
			$("#options").html('');
			$("#post_thread").removeAttr("disabled");
			$("#poll_question").val('');
		}
	});
	
	$("#2opt").click(function()
	{
		$("#options").html('<label for="2opt1"><b>Option 1:</b></label><input type="text" id="2opt1" value=""/><br>' + 
							'<label for="2opt2"><b>Option 2:</b></label><input type="text" class="bottom" id="2opt2" value=""/><br>');
		$("#post_thread").removeAttr("disabled");
							
	});
	$("#3opt").click(function()
	{
		$("#options").html('<label for="3opt1"><b>Option 1:</b></label><input type="text" id="3opt1" value=""/><br>' + 
							'<label for="3opt2"><b>Option 2:</b></label><input type="text" id="3opt2" value=""/><br>' +
							'<label for="3opt3"><b>Option 3:</b></label><input type="text" class="bottom" id="3opt3" value=""/><br>');
		$("#post_thread").removeAttr("disabled");
	});
	$("#4opt").click(function()
	{
		$("#options").html('<label for="4opt1"><b>Option 1:</b></label><input type="text" id="4opt1" value=""/><br>' + 
							'<label for="4opt2"><b>Option 2:</b></label><input type="text" id="4opt2" value=""/><br>' +
							'<label for="4opt3"><b>Option 3:</b></label><input type="text" id="4opt3" value=""/><br>' + 
							'<label for="4opt4"><b>Option 4:</b></label><input type="text" class="bottom" id="4opt4" value=""/><br>');
		$("#post_thread").removeAttr("disabled");
	});
	
	//Voting in poll
	$("#poll_opt1").click(function()
	{
		var user = $("#voter").val();
		var poll_id = $("#poll_id").val();
		var voted_for = 1;
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&poll_id=" + poll_id + "&voted_for=" + voted_for,
	            url: "cast_vote.php",
	            success: function(result) 
	            {
	            	$("#opt1-result").html(result);
	            	$(".vote_tot").css("display", "inline-block");
	  				return;
	           }
      		});
	})
	$("#poll_opt2").click(function()
	{
		var user = $("#voter").val();
		var poll_id = $("#poll_id").val();
		var voted_for = 2;
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&poll_id=" + poll_id + "&voted_for=" + voted_for,
	            url: "cast_vote.php",
	            success: function(result) 
	            {
	            	$("#opt2-result").html(result);
	            	$(".vote_tot").css("display", "block");
	  				return;
	           }
      		});
	})
	$("#poll_opt3").click(function()
	{
		var user = $("#voter").val();
		var poll_id = $("#poll_id").val();
		var voted_for = 3;
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&poll_id=" + poll_id + "&voted_for=" + voted_for,
	            url: "cast_vote.php",
	            success: function(result) 
	            {
	            	$("#opt3-result").html(result);
	            	$(".vote_tot").css("display", "block");
	  				return;
	           }
      		});
	})
	$("#poll_opt4").click(function()
	{
		var user = $("#voter").val();
		var poll_id = $("#poll_id").val();
		var voted_for = 4;
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&poll_id=" + poll_id + "&voted_for=" + voted_for,
	            url: "cast_vote.php",
	            success: function(result) 
	            {
	            	$("#opt4-result").html(result);
	            	$(".vote_tot").css("display", "block");
	  				return;
	           }
      		});
	})
	//Polling END
	
	//Reporting START
	$(".flag").click(function()
	{
		var reported_user = $(this).attr('data-reportedUser-type');
		var post_id = $(this).attr('data-postId-type');
		var reported_content = $("#content" + post_id).val()
		var post_type = $(this).attr('data-postType-type');
		var user_reported = $("#user").val();
		var thread_id = $("#post_thread_id").val();
		var board_id = $("#post_board_id").val();
		
		$("#report_post").css('display', 'inline-block');
		$("#thread_posts").css('display', 'none');
		$('#reply_post').css('display', 'none');
		$('#thread_subject').css('display', 'none');
		$("#poll").css('display', 'none');
		$("#report_exit").css('display', 'block');
		$("#p_paging").css('display', 'none');
		$("#bold_user").html(reported_user);
		$("#report_content").html(reported_content);
		$("#reported_user").val(reported_user);
		$("#reported_content").val(reported_content);
		$("#reporter").val(user_reported);
		$("#r_thread_id").val(thread_id);
		$("#r_board_id").val(board_id);
		$("#r_post_id").val(post_id);
		
	});
	$("#submit_report").click(function()
	{
		var reported_user = $("#reported_user").val();
		var reported_content = $("#reported_content").val();
		var user = $("#reporter").val();
		var thread_id = $("#r_thread_id").val();
		var board_id = $("#r_board_id").val();
		var post_id = $("#r_post_id").val();
		
		var reason = "";
		var selected = $("input[type='radio'][name='reporting']:checked");
		if (selected.length > 0) 
		{
    		reason = selected.val();
		}
		else
		{
			$("#report_error").html('Please select a reason for reporting this post');
			return;
		}
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&reported_user=" + reported_user + "&reported_content=" + reported_content + "&thread_id=" + thread_id + 
	            "&board_id=" + board_id + "&post_id=" + post_id + "&reason=" + reason,
	            url: "send_report.php",
	            success: function(result) 
	            {
	            	window.location.href="post.php?board_id=" + board_id + "&thread_id=" + thread_id;
	  				return;
	           }
      		});
	});
	$("#report_exit").click(function()
	{
		$("#report_post").css('display', 'none');
		$("#thread_posts").css('display', 'block');
		$('#reply_post').css('display', 'block');
		$('#thread_subject').css('display', 'block');
		$("#poll").css('display', 'block');
		$("#report_exit").css('display', 'none');
		$(".report").prop('checked', false);
	});
	//Reporting END
});


