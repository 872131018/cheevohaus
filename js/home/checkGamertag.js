function checkGamertag()
{
	/*
	* Send the gamertag to the server to validation
	*/
	$.post(window.location.href+"/home/index", $("form").serialize(),
		function(response, status)
		{
			if(status == "success")
			{
				console.log(response)
				var resultArray = response.split('>');
				var result = resultArray[0];
				var curlResponse = resultArray[1];
				console.log(resultArray);
				if(result == 'noGamertag')
				{
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
				}
				else if(result == 'foundGamertag')
				{
					//update the message center
					$('#messageCenter').html("\
						<span>That gamertag has been found!</span><br>\
						<span>What would you like to do?</span>\
					");
					//var returnedXuid = curlResponse;
					tabCollection = $('#leftColumn').children().each(
						function()
						{
							buttonManager(
							{
								'action': 'addClickListener'
							},
							{
								'id': $(this).attr('id'),
								'function': 'retrieve'+$(this).text().replace(/ /g,''),
								'xuid': curlResponse
							});
						}
					);
					$('#leftColumn').removeClass('disabled');
				}
				else
				{
					alert(result);
				}
			}
			else
			{
				console.log("server or request error!");
			}
		}
	);
}
