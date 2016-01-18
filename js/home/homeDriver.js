$(document).ready()
{
	/*
	* Setup the fade in background
	*/
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
	/*
	* Set up the buttons for the accordion
	*/
	buttonManager({'action': 'init'}, gamerAccordion);
	/*
	* Set the hover events for button
	*/
	buttonManager({'action': 'setHoverListener'}, {'id': 'loginButton'});
	/*
	* Set the hover events for button
	*/
	buttonManager({'action': 'setClickListener'}, {'id': 'loginButton', 'function': 'checkGamertag'});
}
