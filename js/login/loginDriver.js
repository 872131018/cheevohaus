$(document).ready()
{
	/*
	* Setup the fade in background
	*/
	jqueryUIWrapper({'action': 'fadeToGreen'}, {'element': '.container'});
	/*
	* One off login button
	*/
	$('#inputDiv').children().first().append('<input type="button" id="loginButton" value="Get Gamertag!" class="btn">');
	$('#loginButton').removeClass('disabled');
	/*
	* Set the hover events for button
	*/
	buttonManager({'action': 'setHoverListener'}, {'id': 'loginButton'});
	/*
	* Set up click listener
	*/
	buttonManager({'action': 'setClickListener'}, {'id': 'loginButton', 'function': 'checkLogin'});
}
