<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_factory
{
  private $_ci;

  function __construct()
  {
    /*
		*On construct get an instance of codeigniter so we can access it
		*/
		$this->_ci =& get_instance();
    /*
    * Load the models used during the login process
    */
    $this->_ci->load->model("user_model");
  }
	/*
	*Commit email to the database
	*@param email passed from url to controller
	*@param type passed from url to controller
	*@return true on successful commit
	*/
	public function saveUser($passedUsername="", $passedPassword="")
	{
		/*
		*Empty email model to create and commit
    *New comments wont have an id or a timestamp, database handles that
		*/
		$userModel = new User_model();
		/*
		*TODO: move all the set methods into the constructor of the model
		*TODO: find more elegant solution than hard coding sets
		*TODO: add error checking to the commit method
		*/
		$userModel->setUsername($passedUsername);
    /*
    * Save password as hash so increase security
    */
		$userModel->setPassword(hash("sha256", $passedPassword));
    /*
    * Commit the model to the database and send result back
    */
		return $userModel->commit();;
	}
}
