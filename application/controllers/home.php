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
		$this->load->library(array("curl_factory", "gamertag_factory"));
    /*
    * Get gamertag passed from $_POST
    */
    $gamertag = $this->input->post("gamertag");
    /*
    * Query database for  a single gamertag to determine action
    */
    $result = $this->db->get_where('validGamertags', array('gamertag' => $gamertag), 1)->result();
    if(!empty($result))
    {
			/*
      * Gamertag is valid and is in database
      */
			$result = $result[0];
			/*
			* Send the model back as json
			*/
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($result));

    }
    else
    {
      /*
      * Gamertag not found, query Microsoft to determine validity
      */
			$this->curl_factory->setParameters('https://xboxapi.com/v2/xuid/'.$gamertag);
			$curlResponse =  $this->curl_factory->makeRequest();
			/*
			* Interrogate microsoft response and determine action
			*/
			$curlResponse = json_decode($curlResponse);
			if(gettype($curlResponse) == "integer")
			{
				/*
				* v2/xuid/{gamertag} returns xuid on valid request
				*/
				$xuid = $curlResponse;
				/*
				* Set model values with resulting information
				*/
				$this->validGamertag_model->setGamertag($gamertag);
				$this->validGamertag_model->setXuid($xuid);
				/*
				* Commit the model and set ID
				*/
				$this->validGamertag_model->setId($this->validGamertag_model->commit());
				/*
				* Send the model back as json
				*/
				$this->output->set_content_type('application/json');
				$this->output->set_output($this->gamertag_factory->toJSON($this->validGamertag_model));
			}
			else
			{
				/*
				* Invalid gamertag response from microsoft
				*/
				# code...
			}
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
