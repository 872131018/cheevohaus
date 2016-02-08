function retrievePresence()
{
	/*
	* Get profile information from given xuid
	*/
	$.post(window.location.href+"index.php/presence/index", $("form").serialize(),
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
					var $message = $("<span>Great! Your presence has been updated!</span>");
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
					$('#presence').append($table);
					/*
					* Hide sections of the profile that dont need to be displayed
					*/
					$('#id').hide();
					$('#xuid').hide();
					$('#titleId').hide();
					$('#placement').hide();
					$('#stateOfApp').hide();
					$('#lastModified').hide();
					$('#titlePlacement').hide();
					$('#titleState').hide();
				}
			}
			else
			{
				console.log("server or request error!");
			}
		});
}
