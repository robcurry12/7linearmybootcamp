$(document).ready(function() 
{
	$("#upload").click(function()
	{
		if(isEmpty($("#file1").val()))
		{
			$("#photo-result").html('Please select file');
		}
		else
		{
			window.location.href="user_home.php";
			return false;
		}
	});
});
