<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
    /*
    * Load the models used during the login process
    */
    $this->load->model('user_model');
		/*
    *The factory is where you put the models to work and manages them
    */
    $this->load->library("user_factory");
    /*
    * Get username and password from $_POST
    */
    $username = $this->input->post("username");
    $password = $this->input->post("password");
		/*
		* Send results to factory for processing
		*/
		$result = $this->user_factory->checkUser($username, $password);
		switch($result)
		{
			/*
			* Username and password are correct load homepage view
			*/
			case 'success':
				$this->load->view('home');
				break;
			case 'failure':
				echo 'login_failure';
				break;
			case 'empty':
				echo 'no_results';
				break;

		}
	}

  public function addUser()
  {
    /*
    *The factory is where you put the models to work and manages them
    */
    $this->load->library("user_factory");
    /*
    * Get username and password from $_POST
    */
    $username = $this->input->post("username");
    $password = $this->input->post("password");
    /*
    * Query the database for usernames to check for availability
    */
    $this->db->select('username');
    $query = $this->db->get_where('registeredUsers', array('username' => $username), 1);
    /*
    * The username must be available for it to be taken
    */
    if(empty($query->result()))
    {
      $result = $this->user_factory->saveUser($username, $password);
      //$data = array("result" => $result);
      /*
      * true seems to get thrown around as 1
      */
      if($result === 1 || $result === true)
      {
          echo $result;
      }
    }
    else
    {
      die('username taken');
    }
    die;
  }
}
