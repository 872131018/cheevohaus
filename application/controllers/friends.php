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
				* First thing to do is to clear out the table
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
					$this->friend_model->setId($xuid);
					$this->friend_model->setXuid($friend->id);
					$this->friend_model->setHostId($friend->hostId);
					$this->friend_model->setGamertag($friend->Gamertag);
					$this->friend_model->setGameDisplayName($friend->GameDisplayName);
					$this->friend_model->setAppDisplayName($friend->AppDisplayName);
					$this->friend_model->setGamerscore($friend->Gamerscore);
					$this->friend_model->setGameDisplayPicRaw($friend->GameDisplayPicRaw);
					$this->friend_model->setAppDisplayPicRaw($friend->AppDisplayPicRaw);
					$this->friend_model->setAccountTier($friend->AccountTier);
					$this->friend_model->setXboxOneRep($friend->XboxOneRep);
					$this->friend_model->setPreferredColor($friend->PreferredColor);
					$this->friend_model->setTenureLevel($friend->TenureLevel);
					$this->friend_model->setIsSponsoredUser($friend->isSponsoredUser);
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
				$this->output->set_output($friends_to_commit);
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
