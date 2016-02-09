$(document).ready()
{
	/*
	* Define the buttons that will be in accordion
	*/
	var accordion = {
		profile: 'Profile',
		gamercard: 'Gamercard',
		presence: 'Presence',
		friends: 'Friends',
		recentActivity: 'Recent Activity',
		xbox360Games: 'Xbox 360 Games'
	}
	/*
	* Iteration to add buttons to left column
	*/
	for(tab in accordion)
	{
		var $header = $('<h3>'+accordion[tab]+'</h3>');
		var $content = $('<div id='+tab+'></div>');
		$('#leftColumn').append($header);
		$('#leftColumn').append($content);
	}
	/*
	* Init the accordion
	*/
	$('.accordion').accordion({
		heightStyle: 'content',
		collapsible: true,
		active: false
	});
	/*
	* Set the hover events for button
	*/
	buttonManager({action: 'setHoverListener'}, {id: 'loginButton'});
	/*
	* Set the hover events for button
	*/
	buttonManager({action: 'setClickListener'}, {id: 'loginButton', function: 'checkGamertag'});
}
