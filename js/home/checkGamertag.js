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
					/*
					$('#messageCenter').html("\
						<span>That gamertag couldn't be found!</span><br>\
						<span>Do you want to add this gamertag to account?</span>\
					");
					buttonManager({'action': 'replaceButton'}, {'idToRemove': 'loginButton',
																'idToAdd': 'addGamertagButton',
																'newValue': 'Validate Gamertag!'});
					buttonManager({'action': 'setHoverListener'}, {'id': 'addGamertagButton'});
					buttonManager({'action': 'setClickListener'}, {'id': 'addGamertagButton',
																	'function': 'addGamertagToAccount',
																	'xuid': curlResponse});
					*/
				}
				else
				{
					/*
					* Update the message center with a status
					*/
					$('#messageCenter').html("<span>What would you like to do?</span>");
					/*
					* Hidden field to hold the xuid once its available
					*/
					$("form").append("<input type='hidden' name='xuid' id='xuid' value='"+response.xuid+"'>");
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
						}
					);
					/*
					* Expose action tabs so they may be used
					*/
					$('#leftColumn').removeClass('disabled');
				}
			}
			else
			{
				console.log("server or request error!");
			}
		}
	);
}
