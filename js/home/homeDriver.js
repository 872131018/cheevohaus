$(document).ready()
{
	//set up the fade in background
	jqueryUIWrapper({'action': 'fadeToGreen'}, {'element': '.container'});
	/*
	* Define the buttons that will be in accordion
	*/
	var gamerAccordion =
	{
		'profile': 'Profile',
		'gamercard': 'Gamercard',
		'presence': 'Presence',
		'friends': 'Friends',
		'recentActivity': 'Recent Activity',
		'xbox360Games': 'Xbox 360 Games'
	}
	//gives scripts a chance to load
	setTimeout(function()
	{
		//setup the buttons
		buttonManager({'action': 'init'}, gamerAccordion);
		//set the hover events for button
		buttonManager({'action': 'setHoverListener'}, {'id': 'loginButton'});
		//set up click listener
		buttonManager({'action': 'setClickListener'}, {'id': 'loginButton', 'function': 'checkGamertag'});
	}, 500);
}
