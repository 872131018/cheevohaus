function checkGamertag()
{
	/*
	* Send the gamertag to the server to for validation
	*/
	$.post(window.location.href+"index.php/home/index", $("form").serialize(),
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
					* Iterate each of the action tabs and set map
					*/
					$('#leftColumn').children().each(
						function()
						{
							/*
							* Add a click listener to each of the action tabs
							*/
							buttonManager({'action': 'addClickListener'},
							{
								'id': $(this).attr('id'),
								'function': 'retrieve'+$(this).text().replace(/ /g,'')
							});
						});
				}
			}
			else
			{
				console.log("server or request error!");
			}
		});
}
