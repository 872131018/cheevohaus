function retrieveRecentActivity()
{
	/*
	* Get profile information from given xuid
	*/
	$.post(window.location.href+"index.php/recentActivity/index", $("form").serialize(),
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
function retrieveRecentActivity(passedXUID)
{
	$.get('/xboxWebsite/PHP/homepage/homepageDriver.php',
		{
			'xuid': passedXUID,
			'action': 'getRecentActivity'
		},
		function(response)
		{
			//if get ok build profile table and show it
			var resultArray = response.split('>');
			var result = resultArray[0];
			var curlResponse = resultArray[1];
			console.log(resultArray);
			if(result == 'insertedRecentActivity')
			{
				$('#messageCenter').html("\
					<span>Recent Activity has been updated!</span><br>\
					<span>Do you want to display your activity?</span>\
				");
				displayRecentActivity(curlResponse, passedXUID);
			}
			else
			{
				alert(result);
			}
		}
	);
}

function displayRecentActivity(passedRecentActivity, passedXUID)
{
	$('#recentActivity').html('<div id="gamerRecentActivityAccordion" class="well accordion disabled, active: false">'+recentActivityToAccordion(passedRecentActivity)+'</div>');
	$('#gamerRecentActivityAccordion').accordion({'heightStyle': 'content', 'collapsible': true, 'active': false});
	$('#gamerRecentActivityAccordion').removeClass('disabled');

	var recentActivityObject = $.parseJSON(passedRecentActivity);
	for(var currentActivity in recentActivityObject)
	{
		buttonManager(
		{
			'action': 'addClickListener'
		},
		{
			'id': recentActivityObject[currentActivity]['contentTitle'].replace(/\W/g, ''),
			'function': 'retrieveAchievements',
			'recentActivity': recentActivityObject[currentActivity],
			'xuid': passedXUID
		});
	}

	//clean up sections you don't want to display
	$('.startTimerow').hide();
	$('.sessionDurationInMinutesrow').hide();
	$('.contentImageUrirow').hide();
	$('.bingIdrow').hide();
	$('.vuiDisplayNamerow').hide();
	$('.titleIdrow').hide();
	$('.activityItemTyperow').hide();
	$('.contentTyperow').hide();
	$('.shortDescriptionrow').hide();
	$('.itemTextrow').hide();
	$('.shareRootrow').hide();
	$('.feedItemIdrow').hide();
	$('.itemRootrow').hide();
	$('.gamertagrow').hide();
	$('.displayNamerow').hide();
	$('.userImageUrirow').hide();
	$('.userXuidrow').hide();
	$('.endTimerow').hide();

	//reset the striping
	$('#gamerRecentActivityAccordion').removeClass('table-striped');
	$('#gamerRecentActivityAccordion').addClass('table-striped');
}

function recentActivityToAccordion(passedRecentActivity)
{
	var returnAccordion = '';
	var recentActivityObject = $.parseJSON(passedRecentActivity);
	for(var currentActivity in recentActivityObject)
	{
		returnAccordion += '<h3 id="'+recentActivityObject[currentActivity]['contentTitle'].replace(/\W/g, '')+'">'+recentActivityObject[currentActivity]['contentTitle']+'</h3>';
		returnAccordion += '<div>';
		returnAccordion += '<table class="table table-striped table-condensed">';
		currentActivity = recentActivityObject[currentActivity];
		for(var currentProperty in currentActivity)
		{
			//if current row empty skip it
			if(currentActivity[currentProperty] == null || currentActivity[currentProperty] == false ||
			   currentProperty == 'activity' || currentProperty == 'authorInfo')
			{
				continue;
			}

			//some of the data might be from source
			var objectProperty = currentActivity[currentProperty].toString().trim();
			var isHttp = objectProperty.slice(0,4);
			if(isHttp == 'http')
			{
				returnAccordion += '<tr class='+currentProperty+'row>\
									<td>\
										'+currentProperty+'\
									</td>\
									<td>\
										<img src='+ objectProperty+' width="64" height="64">\
									</td>\
			               		</tr>';
			}
			else
			{
				returnAccordion += '<tr class='+currentProperty+'row>\
									<td>\
										'+currentProperty+'\
									</td>\
									<td>\
										'+ objectProperty+'\
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
