$(document).ready()
{
	/*
	* Setup the fade in background
	*/
	jqueryUIWrapper({'action': 'fadeToGreen'}, {'element': '.container'});
	/*
	* Set the hover events for button
	*/
	buttonManager({'action': 'setHoverListener'}, {'id': 'loginButton'});
	/*
	* Set up click listener
	*/
	buttonManager({'action': 'setClickListener'},
	{
		'id': 'loginButton',
		'function': 'checkLogin'
	});
}
