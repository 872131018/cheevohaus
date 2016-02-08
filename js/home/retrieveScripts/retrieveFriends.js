function retrieveFriends()
{
	/*
	* Get profile information from given xuid
	*/
	$.post(window.location.href+"index.php/friends/index", $("form").serialize(),
		function(response, status)
		{
			if(status == "success")
			{
				console.log(response)
				/*
				* Response should be an array of friends
				*/
				if(typeof response != 'object')
				{
					//stuff to do here
				}
				else
				{
					/*
					* Update the message center with a status
					*/
					var $message = $("<span>Great! Your friends has been updated!</span>");
					$('#messageCenter').append($message);
					/*
					* Fill gamercard tab contents from response
					*/
					var $table = $('<table class="table table-hover"></table>');
					for(var friend in response)
					{
						friend = response[friend];
						/*
						* Iterate through friend properties
						*/
						for(var property in friend)
						{
							/*
							* Ignore empty or false responses
							*/
							if(friend[property] == null || friend[property] == false)
							{
								continue;
							}
							/*
							* Save get the value of each property
							*/
							var property_value = friend[property];
							/*
							* Create the row to add to the table
							*/
							var $row = $('<tr id='+property+'></tr>');
							/*
							* Each row will have a cell that displays the property
							*/
							var $cell = $('<td>'+property+'</td>');
							$row.append($cell);
							/*
							* Corner case properties get handled here
							*/
							switch(property)
							{
								default:
									/*
									* By default display the value in a cell
									*/
									$cell = $('<td>'+property_value+'</td>');
									$row.append($cell);
									/*
									* Add the completed row to the table
									*/
									$table.append($row)
									break;
							}
						}
					}
					$('#friends').append($table);
					/*
					* Hide sections of the profile that dont need to be displayed
					*/
					$('#id').hide();
					$('#GameDisplayName').hide();
					$('#AppDisplayPicRaw').hide();
					$('#AppDisplayName').hide();
				}
			}
			else
			{
				console.log("server or request error!");
			}
		});
}

/*
function displayFriends(passedFriends)
{
	$('#friends').html('<div id="gamerFriendsAccordion" class="well accordion disabled, active: false">'+friendsToAccordion(passedFriends)+'</div>');
	$('#gamerFriendsAccordion').accordion({'heightStyle': 'content', 'collapsible': true, 'active': false});
	$('#gamerFriendsAccordion').removeClass('disabled');

	var friendsObject = $.parseJSON(passedFriends);
	for(var currentFriend in friendsObject)
	{
		buttonManager(
		{
			'action': 'addClickListener'
		},
		{
			'id': friendsObject[currentFriend]['Gamertag'].replace(/\W/g, ''),
			'function': 'displayProfile',
			'profile': currentFriend
		});
	}

	//reset the striping
	$('#gamerFriendsAccordion').removeClass('table-striped');
	$('#gamerFriendsAccordion').addClass('table-striped');
}

function friendsToAccordion(passedFriends)
{
	var returnAccordion = '';
	var friendsObject = $.parseJSON(passedFriends);
	for(var currentFriend in friendsObject)
	{
		//get a unique identifier for an id
		returnAccordion += '<h3 id="'+friendsObject[currentFriend]['Gamertag'].replace(/\W/g, '')+'">'+friendsObject[currentFriend]['Gamertag']+'</h3>';
		returnAccordion += '<div>';
		returnAccordion += '<table class="table table-striped table-condensed">';
		var currentFriendId = friendsObject[currentFriend]['id'];
		currentFriend = friendsObject[currentFriend];
		for(var friendProperty in currentFriend)
		{
			//if current row empty skip it
			if(currentFriend[friendProperty]== null || currentFriend[friendProperty] == false)
			{
				continue;
			}
			//some of the data might be from source
			var objectProperty = currentFriend[friendProperty].toString().trim();
			var isHttp = objectProperty.slice(0,4);
			if(isHttp == 'http')
			{
				var isJson = objectProperty.slice(objectProperty.length - 4, objectProperty.length);
				if(isJson == 'json')
				{
					//set up a container to fill after ajax
					returnAccordion += '<tr class='+currentFriend+'row>\
										<td id=primaryColor'+currentFriendId+'>Primary</td>\
										<td id=secondaryColor'+currentFriendId+'>Secondary</td>\
										<td id=tertiaryColor'+currentFriendId+'>Tertiary</td>\
			               			</tr>';
				    //server will figure out the colors
					$.get('/xboxWebsite/PHP/homepage/homepageDriver.php',
						{
							'url': objectProperty,
							'id': currentFriendId,
							'action': 'lookupColor'
						},
						function(response)
						{
							var resultArray = response.split('>');
							var result = resultArray[0];
							var curlResponse = resultArray[1];
							var bookmarkedId = resultArray[2];
							var colorObject = $.parseJSON(curlResponse);
							$('#primaryColor'+bookmarkedId).css('background-color', '#'+colorObject['primaryColor']);
							$('#secondaryColor'+bookmarkedId).css('background-color', '#'+colorObject['secondaryColor']);
							$('#tertiaryColor'+bookmarkedId).css('background-color', '#'+colorObject['tertiaryColor']);
						}
					);
				}
				else
				{
					returnAccordion += '<tr class='+friendProperty+'Row>\
										<td>\
											'+friendProperty+'\
										</td>\
										<td>\
											<img src='+objectProperty+' height="64" width="64">\
										</td>\
				               		</tr>';
				}
			}
			else
			{
				returnAccordion += '<tr class='+friendProperty+'Row>\
									<td>\
										'+friendProperty+'\
									</td>\
									<td>\
										'+objectProperty+'\
						            </td>\
					            </tr>';
			}
		}
		returnAccordion += '</table>';
		returnAccordion += '</div>';
	}
	return returnAccordion;
}
*/
