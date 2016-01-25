<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function index()
	{
    /*
    * Load the models used in the home screen
    */
    $this->load->model('profile_model');
		/*
		* Load the curl connector class
		*/
		$this->load->library(array("curl_factory", "profile_factory"));
    /*
    * Get gamertag passed from $_POST
    */
    $gamertag = $this->input->post("gamertag");
		$xuid = $this->input->post("xuid");
    /*
    * Query database for  a single gamertag to determine action
    */
    $result = $this->db->get_where('profile', array('xuid' => $xuid), 1)->result();
    if(!empty($result))
    {
			/*
      * Gamertag is valid and is in database
      */
			$result = $result[0];
      /*
      * Gamertag is valid and is in database
      */
			/*
			* Send the model back as json
			*/
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($result));
    }
    else
    {
      /*
      * Profile not found, query Microsoft to determine validity
      */
			$this->curl_factory->setParameters('https://xboxapi.com/v2/'.$xuid.'/profile');
			$curlResponse =  $this->curl_factory->makeRequest();
			/*
			* Interrogate microsoft response and determine action
			*/
			$curlResponse = json_decode($curlResponse);
			/*
			* Api returns id as a reference to xuid
			*/
			if($curlResponse->id == $xuid)
			{
				/*
				* Ensure recieved profile is correct
				*/
				$profile = $curlResponse;
				/*
				* Set model values with resulting information
				*/
				$this->profile_model->setXuid($profile->id);
				$this->profile_model->setHostId($profile->hostId);
				$this->profile_model->setGamertag($profile->Gamertag);
				$this->profile_model->setGameDisplayName($profile->GameDisplayName);
				$this->profile_model->setAppDisplayName($profile->AppDisplayName);
				$this->profile_model->setGamerscore($profile->Gamerscore);
				$this->profile_model->setGameDisplayPicRaw($profile->GameDisplayPicRaw);
				$this->profile_model->setAppDisplayPicRaw($profile->AppDisplayPicRaw);
				$this->profile_model->setAccountTier($profile->AccountTier);
				$this->profile_model->setXboxOneRep($profile->XboxOneRep);
				$this->profile_model->setPreferredColor($profile->PreferredColor);
				$this->profile_model->setTenureLevel($profile->TenureLevel);
				$this->profile_model->setIsSponseredUser($profile->isSponsoredUser);
				/*
				* Commit the model and set ID
				*/
				$this->profile_model->setId($this->profile_model->commit());
				/*
				* Send the model back as json
				*/
				$this->output->set_content_type('application/json');
				$this->output->set_output($this->profile_factory->toJSON($this->profile_model));
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
