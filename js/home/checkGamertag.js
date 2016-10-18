function checkGamertag()
{
	/*
	* Send the gamertag to the server to for validation
	*/
	var url = window.location.href+"index.php/home/index";
	$.post(url, $("form").serialize(),
		function(response, status)
		{
			if(status == "success")
			{
				console.log(response)
				if(response.xuid == '')
				{
					//stuff to do here
				}
				else
				{
					/*
					* Update the message center with a status
					*/
					var $message = $("<span>What would you like to do?</span>");
					$('#messageCenter').append($message);
					/*
					* Hidden field to hold the xuid once its available
					*/
					var $xuid = $("<input type='hidden' name='xuid' id='xuid' value='"+response.xuid+"'>");
					$("form").append($xuid);
					/*
					* Set a delegate identifier for the profile row
					*/
					$("#Gamertag").parents(".row").attr("data-delegate", "profile");
				}
			}
			else
			{
				console.log("server or request error!");
			}
		});
}
