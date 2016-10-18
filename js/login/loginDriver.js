$(document).ready()
{
	/*
  * Delegate all clicks to the document
  */
  $(document).on('click', '[id=login]', function(event)
  {
		/*
		* Check the users login when the button is clicked
		*/
		checkLogin();
	});
}
