$(document).ready(function() 
{		
	//Change view to and from admin view
	$("#admin_switch").click(function()
	{
		var color = $(this).css('background-color');
		if(color == 'rgb(200, 200, 200)')						//Switching to Admin Mode
		{
			$(this).css('background-color', '#5BDA4D');
			$("#home_panel").css('display','none');
			$("#twitter").css('display','none');
			$("#admin_panel").css('display','inline-block');
			
		}	
		else		
		{											//Exiting Admin Mode
			$(this).css('background-color', '#C8C8C8');
			$("#home_panel").css('display','inline-block');
			$("#twitter").css('display','inline-block');
			$("#admin_panel").css('display','none');
		}
		return;
		
	});
	
	//Make user admin
	$("#users_table").on('click', '.make_admin', function()
	{
		var new_admin = $(this).attr('data-user-type');
		$.ajax
			({
	            type: "POST",
	            data: "new_admin=" + new_admin,
	            url: "new_admin.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	            	return;
	           	}
      		});
	});
	
	//Removing admin capabilities
	$("#admins_table").on('click', '.remove_admin', function()
	{
		var remove_admin = $(this).attr('data-user-type');
		var current_user = $("#protect_against_self_remove").val();
		
		if(current_user.toLowerCase() == remove_admin.toLowerCase())
		{
			alert("You cannot remove yourself as admin!");
			return;
		}
		var user = $("#current_user").val();
		$.ajax
			({
	            type: "POST",
	            data: "remove_admin=" + remove_admin + "&user=" + user,
	            url: "remove_admin.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	           	}
      		});
	});

	//Moving threads
	$('select').on('change', function()
	{
		var move_to_board = $(this).val();
		var thread_id = $(this).attr('data-thread_id-type');
		$.ajax
			({
	            type: "POST",
	            data: "move_to_board=" + move_to_board + "&thread_id=" + thread_id,
	            url: "move_thread.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	           	}
      		});
		
	});
		
	//Deleting threads from admin section
	$("#threads_table").on('click', '.deleting', function()
	{
		var delete_thread_id = $(this).attr('data-thread-type');
		$.ajax
			({
	            type: "POST",
	            data: "delete_thread=" + delete_thread_id,
	            url: "delete_thread.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	           	}
      		});
	});

	//Make threads sticky from admin section
	$("#threads_table").on('click', '.stickying', function()
	{
		var sticky_thread = $(this).attr('data-thread-type');
		var board_id = $(this).attr('data-board-type');
		$.ajax
			({
	            type: "POST",
	            data: "sticky_thread=" + sticky_thread + "&board_id=" + board_id,
	            url: "sticky_thread.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	           	}
      		});
	});
	
	//Lock threads from admin section
	$("#threads_table").on('click', '.locking', function()
	{
		var lock_thread = $(this).attr('data-thread-type');
		var board_id = $(this).attr('data-board-type');
		$.ajax
			({
	            type: "POST",
	            data: "lock_thread=" + lock_thread + "&board_id=" + board_id,
	            url: "lock_thread.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	           	}
      		});
		
	});
	
	$(".admin_db_tables").on('click', '.ordering', function()
	{
		var order_by = $(this).attr('data-order-type');
		var order_board = $(this).attr('data-board-type');
		alert(order_by);
		$.ajax
			({
	            type: "POST",
	            data: "order_by=" + order_by + "&order_board=" + order_board,
	            url: "order_tables.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);	
	           	}
      		});
      		$(this).append("<img style='height: 15px' src='images/triangle.png'/>");
	})
});