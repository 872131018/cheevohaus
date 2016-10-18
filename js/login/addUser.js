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
