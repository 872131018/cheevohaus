/*
* Send tbe login to the server to validation
*/
function checkLogin()
{
	/*
	* Consult the login driver for authentication
	*/
	$.post(window.location.href+"index.php/login/index",
	{
	  'username': $('#username').val(),
	  'password': $('#password').val()
	},
	function(response)
	{
		console.log(response)
		switch(response)
		{
			/*
			* @TODO: move to server, server will load view
			*/
			/*
			case 'loginSuccess':
				window.location = '/xboxWebsite/HTML/homepage.html';
				//this block loads page from server
				/*
				$.post('../PHP/loginDriver.php', {action: 'loadHomepage'},
					function(response)
					{
						document.open("text/html", true);
						document.write(response);
						document.close();
					});
				*/
				//break;
			case 'login_failure':
				$('#messageCenter').html('Wrong Username or Password!');
				break;
			case 'no_results':
				/*
				* Display a message
				*/
				$('#messageCenter').html('That user can not be found!');
				/*
				* Replace button on page
				*/
				buttonManager({'action': 'replaceButton'},
				{
					'idToRemove': 'loginButton',
					'idToAdd': 'addUserButton',
					'newValue': 'Sign Me Up!'
				});
				//set the hover events for button
				buttonManager({'action': 'setHoverListener'}, {'id': 'addUserButton'});
				//set up click listener
				buttonManager({'action': 'setClickListener'}, {'id': 'addUserButton', 'function': 'addUser'});
				break;
		}
	});
}

function addUser()
{
	$.post(window.location.href+"index.php/login/addUser",
	{
		'username': $('#username').val(),
		'password': $('#password').val()
	},
		function(response)
		{
			console.log(response)
			if(response == 'true')
			{
				$('#messageCenter').html('You have been added to the database!');
				buttonManager({'action': 'replaceButton'}, {'idToRemove': 'addUserButton',
															'idToAdd': 'loginButton',
															'newValue': 'Sign In!'});
				//set up click listener
				buttonManager({'action': 'setClickListener'}, {'id': 'loginButton', 'function': 'checkLogin'});
			}
		});
}
