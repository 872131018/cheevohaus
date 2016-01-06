<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class validGamertag_model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  */
  private $_xuid;
  private $_gamertag;

  function __construct()
  {
    parent::__construct();
  }
	/*
  * Class Methods
  */
  /**
  * Commit will handle both inserts and updates
	*@param the class will commit itself, no params needed
	*@return true or false on query result
  */
  public function commit()
  {
    /*
		*TODO: try to pass the query $this to remove need for an array
		*/
    $fields = array(
      'xuid' => $this->_xuid,
			'gamertag' => $this->_gamertag,
    );
		/*
		*If the model has an xuid, then it already exists in the database
		*Else the model doesn't have an xuid and needs to be inserted
		*/
    if($this->xuid > 0)
		{
      /*
      * Generates UPDATE validGamertags SET {$fields} WHERE xuid={$ID}
      */
      if($this->db->update("validGamertags", $fields, array("xuid" => $this->_xuid)))
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
        return true;
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
	/*
  *SET's & GET's
  *Use functions because the variables are private
  */
	public function getXuid()
	{
		return $this->_xuid;
	}
	public function setXuid($value)
	{
		$this->_xuid = $value;
	}
	public function getGamertag()
	{
		return $this->_gamertag;
	}
	public function setGamertag($value)
	{
		$this->_gamertag = $value;
	}
}
