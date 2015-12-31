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
    * Get username and password from $_POST
    */
    $username = $this->input->post("username");
    $password = $this->input->post("password");
    /*
    * Query database for username and prepare result object
    */
    $this->db->select('username, password');
    $query = $this->db->get_where('registeredUsers', array('username' => $username), 1);
    $result = $query->result();
    if(!empty($result))
    {
      /*
      * Interrogate the username to determine if the password is correct
      */
      $result = $this->user_factory->saveUser($username, $password);
      var_dump($result);
      die('found login');
    }
    else
    {
      /*
      * @TODO: consider making this its own view and gather more information
      */
      echo 'no_results';
    }
    die;
  	switch($_POST['action'])
  	{
  		//check what function to do
  		case 'login':
  			//determine if the user is registered
  			$queryString = 'SELECT username, password ';
  			$queryString .= 'FROM registeredUsers WHERE username=';
  			$queryString .= '"'.$_POST['username'].'"';
  			$result = $connector -> doQuery($queryString);
  			if($result->num_rows > 0)
  			{
  				$result = $result -> fetch_assoc();
  				if($result['username'] == $_POST['username'] && $result['password'] == $_POST['password'])
  				{
  					$result = 'loginSuccess';
  					echo $result;
  				}
  				else
  				{
  					$result = 'loginFailure';
  					echo $result;
  				}
  			}
  			else
  			{
  				//user not in database must register them
  				$result = 'noResults';
  				echo $result;
  			}
  			break;

  		case 'addUser':
  			$queryString = 'INSERT INTO registeredUsers (username, password) ';
  			$queryString .= 'VALUES ('.'"'.$_POST['username'].'"'.', '.'"'.$_POST['password'].'"'.')';
  			$result = $connector -> doQuery($queryString);
  			if($result != 'true')
  			{
  				$result = 'false';
  				echo $result;
  			}
  			else
  			{
  				$result = 'true';
  				echo $result;
  			}
  			break;
  		case 'loadHomepage':
  			echo file_get_contents('../HTML/homepage.html');
  			break;
  	}
		$this->load->view('login');
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
