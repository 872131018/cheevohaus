function retrieveGamercard()
{
	/*
	* Get profile information from given xuid
	*/
	$.post(window.location.href+"index.php/gamercard/index", $("form").serialize(),
		function(response, status)
		{
			if(status == "success")
			{
				console.log(response)
				if(response.gamertag == '')
				{
					//stuff to do here
				}
				else
				{
					/*
					* Update the message center with a status
					*/
					var $message = $("<span>Great! Your gamercard has been updated!</span>");
					$('#messageCenter').append($message);
					/*
					* Fill gamercard tab contents from response
					*/
					var $table = $('<table class="table table-hover"></table>');
					/*
					* Iterate through gamercard properties
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
							case "avatarBodyImagePath":
							case "avatarManifest":
							case "gamerpicLargeImagePath":
							case "gamerpicLargeSslImagePath":
							case "gamerpicSmallImagePath":
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
								* Color is json object TODO
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
					$('#gamercard').append($table);
					/*
					* Hide sections of the profile that dont need to be displayed
					*/
					$("#id").hide();
					$('#gamerpicSmallImagePath').hide();
					$('#gamerpicLargeImagePath').hide();
					$('#gamerpicSmallSslImagePath').hide();
					$('#gamerpicLargeSslImagePath').hide();
					$('#avatarManifest').hide();
				}
			}
			else
			{
				console.log("server or request error!");
			}
		}
	);
}
