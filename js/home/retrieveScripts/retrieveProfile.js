function retrieveProfile()
{
	/*
	* Get profile information from given xuid
	*/
	$.post(window.location.href+"index.php/profile/index", $("form").serialize(),
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
					var $message = $("<span>Great! Your profile has been updated!</span>");
					$('#messageCenter').append($message);
					/*
					* Fill profile tab contents from response
					*/
					var $table = $('<table class="table table-hover"></table>');
					/*
					* Iterate through profile properties
					*/
					for(var property in response)
					{
						/*
						* Ignore empty or false responses
						*/
						if(response[property] == null || response[property] == false)
						{
							continue;
						}
						/*
						* Save get the value of each property
						*/
						var property_value = response[property];
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
							case "AppDisplayPicRaw":
							case "GameDisplayPicRaw":
								/*
								* Value is a url to an image
								*/
								$cell = $('<img height="150" width="150" src='+property_value+'>');
								$row.append($cell);
								/*
								* Add the completed row to the table
								*/
								$table.append($row)
								break;
							case "PreferredColor":
								/*
								* Ask server to get data
								*/
								break;
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
					$('#profile').append($table);
					/*
					* Hide sections of the profile that dont need to be displayed
					*/
					$('#id').hide();
					$('#xuid').hide();
					$('#GameDisplayName').hide();
					$('#AppDisplayName').hide();
					$('#AppDisplayPicRaw').hide();
					$('#AccountTier').hide();
					$('#XboxOneRep').hide();
					$('#TenureLevel').hide();
				}
			}
			else
			{
				console.log("server or request error!");
			}
		});
}

/*
		//set up a container to fill after ajax
		returnTable += '<tr class='+currentProperty+'Row>\
							<td id=primaryColor>Primary</td>\
							<td id=secondaryColor>Secondary</td>\
							<td id=tertiaryColor>Tertiary</td>\
               			</tr>';
	    //server will figure out the colors
		$.get('/xboxWebsite/PHP/homepage/homepageDriver.php',
			{
				'url': objectProperty,
				'action': 'lookupColor'
			},
			function(response)
			{
				var resultArray = response.split('>');
				var result = resultArray[0];
				var curlResponse = resultArray[1];
				var colorObject = $.parseJSON(curlResponse);
				$('#primaryColor').css('background-color', '#'+colorObject['primaryColor']);
				$('#secondaryColor').css('background-color', '#'+colorObject['secondaryColor']);
				$('#tertiaryColor').css('background-color', '#'+colorObject['tertiaryColor']);
			}
		);
	}
	*/
