$(document).ready(function() 
{	
	//STUFF TO MAKE BETTER
	//1. Upload profile picture
	function dateValid(str)
	{
 		return /(0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])/.test(str);
	}
	$("#edit_pro").click(function()
	{
		$(".hidden").css("display", "block");
		$(".edit").css("display", "none");
	});
	
	$("#save_pro").click(function()
	{
		var bday = $("#bday").val();
		var gender = $("#gender").val();
		var user = $("#username").val();
		
		if(dateValid(bday) == false)
		{
			$("#bday-result").html("Incorrect format");
			return;
		}
		if((bday.charAt(1) == 2) && (bday.charAt(3) == 3) && (bday.charAt(0) == 0))
		{
			$("#bday-result").html("Incorrect date");
			return;
		}
		if((bday.charAt(1) == 4) && (bday.charAt(4) == 1) || (bday.charAt(1) == 6) && (bday.charAt(4) == 1) || 
		(bday.charAt(1) == 9) && (bday.charAt(4) == 1) || (bday.charAt(1) == 1) && (bday.charAt(4) == 1) && (bday.charAt(0) == 1))
		{
			$("#bday-result").html("Incorrect date");
			return;
		}
		else
		{
			$.ajax
			({
	            type: "POST",
	            data: "user=" + user + "&bday=" + bday + "&gender=" + gender,
	            url: "update_user.php",
	            success: function(result) 
	            {
	            	window.location.href = "user_home.php";
	            	/*$("#bday-result").html("");
					$(".hidden").css("display", "none");
					$(".edit").css("display", "block");*/
					return false;
	           	}
      		});
		}
	});
	
	$("#bday").keyup(function()
	{
		var bday = $(this).val();
		$("#bday-result").html("");
		if(bday.length == 2)
		{
			$(this).val(bday + "/");
			return;
		}	
	});

	$("#bday").click(function()
	{
		$(this).val('');
	});
});