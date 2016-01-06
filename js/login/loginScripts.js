function checkLogin()
{
	/*
	* Send the login to the server to validation
	*/
	$.post(window.location.href+"/login/index", $("form").serialize(),
	function(response, status)
	{
		if(status == "success")
		{
			switch(response)
			{
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
					/*
					* Set the hover events for button
					*/
					buttonManager({'action': 'setHoverListener'}, {'id': 'addUserButton'});
					/*
					* Set up click listener
					*/
					buttonManager({'action': 'setClickListener'}, {'id': 'addUserButton', 'function': 'addUser'});
					break;
				default:
					/*
					* Default case is to treat response as new page
					*/
					$('html').html(response);
					break;

			}
		}
		else
		{
			console.log("server or request error!");
		}
	});
}

function addUser()
{
	$.post(window.location.href+"index.php/login/addUser", $("form").serialize(),
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
