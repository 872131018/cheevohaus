<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presence_model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  */
  var $_id;
	var $_xuid;
	var $_state;
	var $_deviceType;
	var $_titleId;
	var $_name;
	var $_placement;
	var $_stateOfApp;
	var $_lastModified;

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
      'id' => $this->_id,
      'xuid' => $this->_xuid,
      'state' => $this->_state,
      'deviceType' => $this->_deviceType,
      'titleId' => $this->_titleId,
      'name' => $this->_name,
      'placement' => $this->_placement,
      'stateOfApp' => $this->_stateOfApp,
      'lastModified' => $this->_lastModified
    );
		/*
		*If the model has an xuid, then it already exists in the database
		*Else the model doesn't have an xuid and needs to be inserted
		*/
    if(isset($this->_id))
		{
      /*
      * Generates UPDATE validGamertags SET {$fields} WHERE xuid={$ID}
      */
      if($this->db->update("presence", $fields, array("id" => $this->_id)))
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
      if($this->db->insert("presence", $fields))
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
	/*
  *SET's & GET's
  *Use functions because the variables are private
  */
  public function getId()
	{
		return $this->_id;
	}
	public function setId($value)
	{
		$this->_id = $value;
	}
  public function getXuid()
	{
		return $this->_xuid;
	}
	public function setXuid($value)
	{
		$this->_xuid = $value;
	}
  public function getState()
	{
		return $this->_state;
	}
	public function setState($value)
	{
		$this->_state = $value;
	}
  public function getDeviceType()
	{
		return $this->_deviceType;
	}
	public function setDeviceType($value)
	{
		$this->_deviceType = $value;
	}
  public function getTitleId()
	{
		return $this->_titleId;
	}
	public function setTitleId($value)
	{
		$this->_titleId = $value;
	}
  public function getName()
	{
		return $this->_name;
	}
	public function setName($value)
	{
		$this->_name = $value;
	}
  public function getPlacement()
	{
		return $this->_placement;
	}
	public function setPlacement($value)
	{
		$this->_placement = $value;
	}
  public function getStateOfApp()
	{
		return $this->_stateOfApp;
	}
	public function setStateOfApp($value)
	{
		$this->_stateOfApp = $value;
	}
  public function getLastModified()
	{
		return $this->_lastModified;
	}
	public function setLastModified($value)
	{
		$this->_lastModified = $value;
	}
}
