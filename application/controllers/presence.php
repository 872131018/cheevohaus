<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presence extends CI_Controller
{
	public function index()
	{
    /*
    * Load the models used in the home screen
    */
    $this->load->model('presence_model');
		/*
		* Load the curl connector class and factory
		*/
		$this->load->library(array("curl_factory", "presence_factory"));
    /*
    * Get gamertag passed from $_POST
    */
    $gamertag = $this->input->post("gamertag");
		$xuid = $this->input->post("xuid");
    /*
    * Query database for a single gamercard to determine action
    */
    $result = $this->db->get_where('presence', array('xuid' => $xuid), 1)->result();
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
			$this->curl_factory->setParameters('https://xboxapi.com/v2/'.$xuid.'/presence');
			$curlResponse =  $this->curl_factory->makeRequest();
			/*
			* Interrogate microsoft response and determine action
			*/
			$curlResponse = json_decode($curlResponse);
			/*
			* Api returns gamertag to use as reference
			*/
			if($curlResponse->xuid == $xuid)
			{
				/*
				* Ensure recieved profile is correct
				*/
				$presence = $curlResponse;
				/*
				* Must have an active presence to update
				*/
				if(isset($presence->devices) && !empty($presence->devices))
				{
					/*
					* Set values that dont need to be flattened
					*/
					$this->presence_model->xuid = $presence->xuid;
					$this->presence_model->state = $presence->state;
					/*
					* Only worry about the first device in list to flatten
					*/
					$presence->devices = $presence->devices[0];
					/*
					* Set device type of model to flatten response
					*/
					$this->presence_model->deviceType = $presence->devices->type;
					/*
					* Search for the active title on the device
					*/
					foreach($presence->devices->titles as $title)
					{
						/*
						* Active state and is running in full screen
						*/
						if($title->state == "Active" && $title->placement == "Full")
						{
							/*
							* Set the model values from the data for a single title
							*/
							$this->presence_model->titleId = $title->id;
							$this->presence_model->name = $title->name;
							$this->presence_model->placement = $title->placement;
							$this->presence_model->stateOfApp = $title->state;
							$this->presence_model->lastModified = $title->lastModified;
							break;
						}
					}
				}
				/*
				* Commit the model and set ID
				*/
				$this->presence_model->id = $this->presence_model->commit();
				/*
				* Send the model back as json
				*/
				$this->output->set_content_type('application/json');
				$this->output->set_output($this->presence_factory->toJSON($this->presence_model));
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
