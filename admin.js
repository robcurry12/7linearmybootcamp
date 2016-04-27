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
	
	/*$("#users_button").click(function()
	{
		$(this).css('background-color', '#5BDA4D');
		$("#reports_button").css('background-color', 'rgb(200, 200, 200)');
		$("#admins_button").css('background-color', 'rgb(200, 200, 200)');
		$.ajax
			({
	            url: "get_users.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	            	return;
	           	}
      		});
	});
	
	$("#reports_button").click(function()
	{
		$(this).css('background-color', '#5BDA4D');
		$("#users_button").css('background-color', 'rgb(200, 200, 200)');
		$("#admins_button").css('background-color', 'rgb(200, 200, 200)');
		/*$.ajax
			({
	            url: "get_reports.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	            	return;
	           	}
      		});
	});
	
	$("#admins_button").click(function()
	{
		$(this).css('background-color','#5BDA4D');
		$("#users_button").css('background-color', 'rgb(200, 200, 200)');
		$("#reports_button").css('background-color', 'rgb(200, 200, 200)');
		$.ajax
			({
	            url: "get_admins.php",
	            success: function(result) 
	            {
	            	$("#users_reports_tables_div").html(result);
	            	return;
	           	}
      		});
		
	});*/
	
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
		var user = $("#current_user").val();
		alert(remove_admin);
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
});