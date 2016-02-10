<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecentActivity extends CI_Controller
{
	public function index()
	{
    /*
    * Load the models used in the home screen
    */
    $this->load->model('recent_activity_model');
		/*
		* Load the curl connector class and factory
		*/
		$this->load->library(array("curl_factory", "recent_activity_factory"));
    /*
    * Get gamertag passed from $_POST
    */
    $gamertag = $this->input->post("gamertag");
		$xuid = $this->input->post("xuid");
    /*
    * Query database for a single use xuid to get the friends list
    */
    $result = $this->db->get_where('recentActivity', array('id' => $xuid))->result();
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
			$this->curl_factory->setParameters('https://xboxapi.com/v2/'.$xuid.'/activity/recent');
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
				$this->db->delete('recentActivity', array('id' => $xuid));
				/*
				* Set up variable to hold array of friends to commit
				*/
				$activity_to_commit = [];
				/*
				* Friends should be an array of friend objects
				*/
				$recent_activity = $curlResponse;
				/*
				* Commit each friend to the database
				*/
				foreach($recent_activity as $activity)
				{
					/*
					* Must add the id for each activity
					*/
					$activity->id = $xuid;
					/*
					* Set model values with resulting information
					*/
					foreach(get_object_vars($activity) as $property => $value)
					{
						/*
						* Profile returns xuid as id
						*/
						if($property == "activity" || $property == "authorInfo")
						{
							continue;
						}
						/*
						* Set the models values for each property in response
						*/
						$this->recent_activity_model->{$property} = $value;
					}
					/*
					* Push a clone of the model into an array for batch inserting
					*/
					array_push($activity_to_commit, clone $this->recent_activity_model);
				}
				/*
				* Insert the friends all at once for better performance
				*/
				$this->db->insert_batch('recentActivity', $activity_to_commit);
				/*
				* Pass the friends response through as json
				*/
				$this->output->set_content_type('application/json');
				$this->output->set_output($this->recent_activity_factory->toJSON($this->recent_activity_model));
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
