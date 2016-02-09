$(document).ready()
{
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
