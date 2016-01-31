<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gamercard extends CI_Controller
{
	public function index()
	{
    /*
    * Load the models used in the home screen
    */
    $this->load->model('gamercard_model');
		/*
		* Load the curl connector class and factory
		*/
		$this->load->library(array("curl_factory", "gamercard_factory"));
    /*
    * Get gamertag passed from $_POST
    */
    $gamertag = $this->input->post("gamertag");
		$xuid = $this->input->post("xuid");
    /*
    * Query database for a single gamercard to determine action
    */
    $result = $this->db->get_where('gamercard', array('gamertag' => $gamertag), 1)->result();
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
      * Profile not found, query Microsoft to determine validity
      */
			$this->curl_factory->setParameters('https://xboxapi.com/v2/'.$xuid.'/gamercard');
			$curlResponse =  $this->curl_factory->makeRequest();
			/*
			* Interrogate microsoft response and determine action
			*/
			$curlResponse = json_decode($curlResponse);
			/*
			* Api returns gamertag to use as reference
			*/
			if(strtolower($curlResponse->gamertag) == strtolower($gamertag))
			{
				/*
				* Ensure recieved profile is correct
				*/
				$gamercard = $curlResponse;
				/*
				* Set model values with resulting information
				*/
				$this->gamercard_model->setGamertag($gamercard->gamertag);
				$this->gamercard_model->setName($gamercard->name);
				$this->gamercard_model->setLocation($gamercard->location);
				$this->gamercard_model->setBio($gamercard->bio);
				$this->gamercard_model->setGamerscore($gamercard->gamerscore);
				$this->gamercard_model->setTier($gamercard->tier);
				$this->gamercard_model->setMotto($gamercard->motto);
				$this->gamercard_model->setAvatarBodyImagePath($gamercard->avatarBodyImagePath);
				$this->gamercard_model->setGamerpicSmallImagePath($gamercard->gamerpicSmallImagePath);
				$this->gamercard_model->setGamerpicLargeImagePath($gamercard->gamerpicLargeImagePath);
				$this->gamercard_model->setGamerpicSmallSslImagePath($gamercard->gamerpicSmallSslImagePath);
				$this->gamercard_model->SetGamerpicLargeSslImagePath($gamercard->gamerpicLargeSslImagePath);
				$this->gamercard_model->setAvatarManifest($gamercard->avatarManifest);
				/*
				* Commit the model and set ID
				*/
				$this->gamercard_model->setId($this->gamercard_model->commit());
				/*
				* Send the model back as json
				*/
				$this->output->set_content_type('application/json');
				$this->output->set_output($this->gamercard_factory->toJSON($this->gamercard_model));
			}
			else
			{
				/*
				* Invalid gamercard response from microsoft
				*/
				# code...
			}
			$this->curl_factory->closeConnection();
    }
	}
}
