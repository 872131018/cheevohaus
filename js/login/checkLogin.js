function checkLogin()
{
	/*
	* Send the login to the server to validation
	*/
	var url = window.location.href+"index.php/login/index";
	$.post(url, $("form").serialize(), function(response, status)
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
