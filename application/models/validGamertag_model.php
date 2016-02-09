<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class validGamertag_model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  */
  var $id;
  var $xuid;
  var $gamertag;

  function __construct()
  {
    parent::__construct();
  }
	/*
  * Class Methods
  */
  /**
  * Commit will handle both inserts and updates
	* @param the class will commit itself, no params needed
	* @return true or false on query result
  */
  public function commit()
  {
    /*
		*TODO: try to pass the query $this to remove need for an array
		*/
    $fields = array(
      'id' => $this->id,
      'xuid' => $this->xuid,
			'gamertag' => $this->gamertag,
    );
		/*
		*If the model has an xuid, then it already exists in the database
		*Else the model doesn't have an xuid and needs to be inserted
		*/
    if(isset($this->id))
		{
      /*
      * Generates UPDATE validGamertags SET {$fields} WHERE xuid={$ID}
      */
      if($this->db->update("validGamertags", $fields, array("id" => $this->id)))
			{
        return true;
      }
			else
			{
				/*
				*There was an error with the update retrieve and show error
				*TODO: handle error properly
				*/
				var_dump($this->db->error());
				die;
			}
    }
		else
		{
      if($this->db->insert("validGamertags", $fields))
			{
        return $this->db->insert_id();
      }
			else
			{
				/*
				*There was an error with the insert retrieve and show error
				*TODO: handle error properly
				*/
				var_dump($this->db->error());
				die;
			}
    }
		/*
		*If the function is this far it has failed
		*/
    return false;
  }
}
