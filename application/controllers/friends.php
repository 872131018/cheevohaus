<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friends extends CI_Controller
{
	public function index()
	{
    /*
    * Load the models used in the home screen
    */
    $this->load->model('friend_model');
		/*
		* Load the curl connector class and factory
		*/
		$this->load->library(array("curl_factory", "friend_factory"));
    /*
    * Get gamertag passed from $_POST
    */
    $gamertag = $this->input->post("gamertag");
		$xuid = $this->input->post("xuid");
    /*
    * Query database for a single use xuid to get the friends list
    */
    $result = $this->db->get_where('friends', array('id' => $xuid))->result();
    if(!empty($result))
    {
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
			$this->curl_factory->setParameters('https://xboxapi.com/v2/'.$xuid.'/friends');
			$curlResponse =  $this->curl_factory->makeRequest();
			/*
			* Interrogate microsoft response and determine action
			*/
			$curlResponse = json_decode($curlResponse);
			/*
			* Api returns array of friends on success
			*/
			if(!empty($curlResponse))
			{
				/*
				* Clear out the table for the current user
				*/
				$this->db->delete('friends', array('id' => $xuid));
				/*
				* Set up variable to hold array of friends to commit
				*/
				$friends_to_commit = [];
				/*
				* Friends should be an array of friend objects
				*/
				$friends = $curlResponse;
				/*
				* Commit each friend to the database
				*/
				foreach($friends as $friend)
				{
					/*
					* Set model values with resulting information
					*/
					$this->friend_model->id = $xuid;
					$this->friend_model->xuid = $friend->id;
					$this->friend_model->hostId = $friend->hostId;
					$this->friend_model->Gamertag = $friend->Gamertag;
					$this->friend_model->GameDisplayName = $friend->GameDisplayName;
					$this->friend_model->AppDisplayName = $friend->AppDisplayName;
					$this->friend_model->Gamerscore = $friend->Gamerscore;
					$this->friend_model->GameDisplayPicRaw = $friend->GameDisplayPicRaw;
					$this->friend_model->AppDisplayPicRaw = $friend->AppDisplayPicRaw;
					$this->friend_model->AccountTier = $friend->AccountTier;
					$this->friend_model->XboxOneRep = $friend->XboxOneRep;
					$this->friend_model->PreferredColor = $friend->PreferredColor;
					$this->friend_model->TenureLevel = $friend->TenureLevel;
					$this->friend_model->isSponsoredUser = $friend->isSponsoredUser;
					/*
					* Push a clone of the model into an array for batch inserting
					*/
					array_push($friends_to_commit, clone $this->friend_model);
				}
				/*
				* Insert the friends all at once for better performance
				*/
				$this->db->insert_batch('friends', $friends_to_commit);
				/*
				* Pass the friends response through as json
				*/
				$this->output->set_content_type('application/json');
				$this->output->set_output($this->friend_factory->toJSON($this->friend_model));
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
