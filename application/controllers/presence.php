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
			if(strtolower($curlResponse->xuid) == strtolower($xuid))
			{
				/*
				* Ensure recieved profile is correct
				*/
				$presence = $curlResponse;
				/*
				* Presence devices could contain a variety of things
				*/
				if(isset($presence->devices) && !empty($presence->devices))
				{
					/*
					* Narrow down the device list to the first one returned
					*/
					$presence->deviceType = $presence->devices[0]->type;
					/*
					* Search for the active title on the device
					*/
					foreach($presence->devices[0]->titles as $title)
					{
						/*
						* Active state and is running in full screen
						*/
						if($title->state == "Active" && $title->placement == "Full")
						{
							/*
							* Set the model values from the data for a single title
							*/
							$presence->titleId = $title->id;
							$presence->name = $title->name;
							$presence->placement = $title->placement;
							$presence->stateOfApp = $title->state;
							$presence->lastModified = $title->lastModified;
							break;
						}
					}
				}
				/*
				* Set model values with resulting information
				*/
				$this->presence_model->setXuid($presence->xuid);
				$this->presence_model->setState($presence->state);
				$this->presence_model->setDeviceType($presence->deviceType);
				$this->presence_model->setTitleId($presence->titleId);
				$this->presence_model->setName($presence->name);
				$this->presence_model->setPlacement($presence->placement);
				$this->presence_model->setStateOfApp($presence->stateOfApp);
				$this->presence_model->setLastModified($presence->lastModified);
				/*
				* Commit the model and set ID
				*/
				$this->presence_model->setId($this->presence_model->commit());
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
