<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  */
  private $_id;
  private $_username;
	private $_password;
	private $_joinedOn;

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
      'id' => $this->_id,
			'username' => $this->_username,
			'password' => $this->_password,
			'joinedOn' => $this->_joinedOn
    );
		/*
		*If the model has an id, then it already exists in the database
		*Else the model doesn't have an id and needs to be inserted
		*/
    if($this->_id > 0)
		{
      /*
      * Generates UPDATE registeredUsers SET {$fields} WHERE id={$ID}
      */
      if($this->db->update("registeredUsers", $fields, array("id" => $this->_id)))
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
      if($this->db->insert("registeredUsers", $fields))
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
	public function getId()
	{
		return $this->_id;
	}
	public function setId($value)
	{
		$this->_id = $value;
	}
	public function getUsername()
	{
		return $this->_username;
	}
	public function setUsername($value)
	{
		$this->_username = $value;
	}
	public function getPassword()
	{
		return $this->_password;
	}
	public function setPassword($value)
	{
		$this->_password = $value;
	}
	public function getJoinedOn()
	{
		return $this->_joinedOn;
	}
	public function setJoinedOn($value)
	{
		$this->_joinedOn = $value;
	}
}
