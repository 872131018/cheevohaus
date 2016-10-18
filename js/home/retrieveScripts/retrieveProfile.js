function retrieveProfile()
{
	/*
	* Get profile information from given xuid
	*/
	var url = window.location.href+"index.php/profile/index";
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
					var $message = $("<span>Great! Your profile has been updated!</span>");
					$('#messageCenter').html($message);
					/*
					* Set and append gamertag
					*/
					var $Gamertag = $('<h3>'+response.Gamertag+'</h3>');
					$('#Gamertag').append($Gamertag);
					/*
					* Set and append profile pic
					*/
					var $GameDisplayPicRaw = $('<img height="80" width="80" src='+response.GameDisplayPicRaw+'>');
					$('#GameDisplayPicRaw').append($GameDisplayPicRaw);
					/*
					* Set and append gamerscore
					*/
					var $Gamerscore = $('<h3>'+response.Gamerscore+'</h3>');
					$('#Gamerscore').append($Gamerscore);
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
