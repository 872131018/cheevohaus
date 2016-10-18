$(document).ready()
{
	/*
  * Delegate all clicks to the document
  */
  $(document).on('click', '[data-delegate=gamertag]', function(event)
  {
		/*
		* Check the users login when the button is clicked
		*/
		checkGamertag();
	});
  /*
  * Delegate all clicks to the document
  */
  $(document).on('click', '[data-delegate=profile]', function(event)
  {
		/*
		* Check the users login when the button is clicked
		*/
		retrieveProfile();
    console.log(event.target)
	});
}
