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
	            	window.location.href="post.php";
	  				return false;
	           }
      		});
		}
	});
	
	$("#like-1").click(function()
	{
		var like_count = $("#like_amount-1").val();
		var post_id = $("#post_id-1").val();
		var user = $("#user").val();
		var post_user = $("#quote_user1").val();
		
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-1").html(result);
	            	$("#like_amount-1").val(result);
	  				return;
	           }
      		});
	});
	$("#like-2").click(function()
	{
		var like_count = $("#like_amount-2").val();
		var post_id = $("#post_id-2").val();
		var user = $("#user").val();
		var post_user = $("#quote_user2").val();
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-2").html(result);
	            	$("#like_amount-2").val(result);
	  				return;
	           }
      		});
	});
	$("#like-3").click(function()
	{
		var like_count = $("#like_amount-3").val();
		var post_id = $("#post_id-3").val();
		var user = $("#user").val();
		var post_user = $("#quote_user3").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-3").html(result);
	            	$("#like_amount-3").val(result);
	  				return;
	           }
      		});
	});
	$("#like-4").click(function()
	{
		var like_count = $("#like_amount-4").val();
		var post_id = $("#post_id-4").val();
		var user = $("#user").val();
		var post_user = $("#quote_user4").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-4").html(result);
	            	$("#like_amount-4").val(result);
	  				return;
	           }
      		});
	});
	$("#like-5").click(function()
	{
		var like_count = $("#like_amount-5").val();
		var post_id = $("#post_id-5").val();
		var user = $("#user").val();
		var post_user = $("#quote_user5").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-5").html(result);
	            	$("#like_amount-5").val(result);
	  				return;
	           }
      		});
	});
	$("#like-6").click(function()
	{
		var like_count = $("#like_amount-6").val();
		var post_id = $("#post_id-6").val();
		var user = $("#user").val();
		var post_user = $("#quote_user6").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-6").html(result);
	            	$("#like_amount-6").val(result);
	  				return;
	           }
      		});
	});
	$("#like-7").click(function()
	{
		var like_count = $("#like_amount-7").val();
		var post_id = $("#post_id-7").val();
		var user = $("#user").val();
		var post_user = $("#quote_user7").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-7").html(result);
	            	$("#like_amount-7").val(result);
	  				return;
	           }
      		});
	});
	$("#like-8").click(function()
	{
		var like_count = $("#like_amount-8").val();
		var post_id = $("#post_id-8").val();
		var user = $("#user").val();
		var post_user = $("#quote_user8").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-8").html(result);
	            	$("#like_amount-8").val(result);
	  				return;
	           }
      		});
	});
	$("#like-9").click(function()
	{
		var like_count = $("#like_amount-9").val();
		var post_id = $("#post_id-9").val();
		var user = $("#user").val();
		var post_user = $("#quote_user9").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-9").html(result);
	            	$("#like_amount-9").val(result);
	  				return;
	           }
      		});
	});
	$("#like-10").click(function()
	{
		var like_count = $("#like_amount-10").val();
		var post_id = $("#post_id-10").val();
		var user = $("#user").val();
		var post_user = $("#quote_user10").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-10").html(result);
	            	$("#like_amount-10").val(result);
	  				return;
	           }
      		});
	});
	$("#like-11").click(function()
	{
		var like_count = $("#like_amount-11").val();
		var post_id = $("#post_id-11").val();
		var user = $("#user").val();
		var post_user = $("#quote_user11").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-11").html(result);
	            	$("#like_amount-11").val(result);
	  				return;
	           }
      		});
	});
	$("#like-12").click(function()
	{
		var like_count = $("#like_amount-12").val();
		var post_id = $("#post_id-12").val();
		var user = $("#user").val();
		var post_user = $("#quote_user12").val();
		 
		
		$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&post_id=" + post_id + "&like_count=" + like_count + "&post_user=" + post_user,
	            url: "increment_like.php",
	            success: function(result) 
	            {
	            	$("#like_ct-12").html(result);
	            	$("#like_amount-12").val(result);
	  				return;
	           }
      		});
	});
	
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
	
});