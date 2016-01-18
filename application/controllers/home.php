<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
    /*
    * Load the models used in the home screen
    */
    $this->load->model('validGamertag_model');
		/*
		* Load the curl connector class
		*/
		$this->load->library("curl_factory");
    /*
    * Get gamertag passed from $_POST
    */
    $gamertag = $this->input->post("gamertag");
    /*
    * Query database for  a single gamertag to determine action
    */
    $this->db->select('xuid, gamertag');
    $result = $this->db->get_where('validGamertags', array('gamertag' => $gamertag), 1)->result();
		//$result = $result[0];
    if(!empty($result))
    {
      /*
      * Gamertag is valid and is in database
      */
			//do something here
    }
    else
    {
      /*
      * Make a call to microsoft to see if its a valid gamertag
      */
			$this->curl_factory->setParameters('https://xboxapi.com/v2/xuid/'.$gamertag);
			$curlResponse =  $this->curl_factory->makeRequest();
			var_dump($curlResponse); die;
			$this->curl_factory->closeConnection();
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
