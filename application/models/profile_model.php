<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  */
  var $_id;
  var $_xuid;
  var $_hostId;
	var $_Gamertag;
	var $_GameDisplayName;
	var $_AppDisplayName;
	var $_Gamerscore;
	var $_GameDisplayPicRaw;
	var $_AppDisplayPicRaw;
	var $_AccountTier;
	var $_XboxOneRep;
	var $_PreferredColor;
	var $_TenureLevel;
	var $_isSponsoredUser;

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
      'AppDisplayName'  => $this->_AppDisplayName,
      'Gamertag'	=> $this->_Gamertag,
      'GameDisplayName'	=> $this->_GameDisplayName,
      'AppDisplayName'	=> $this->_AppDisplayName,
      'Gamerscore'	=> $this->_Gamerscore,
      'GameDisplayPicRaw'	=> $this->_GameDisplayPicRaw,
      'AppDisplayPicRaw'	=> $this->_AppDisplayPicRaw,
      'AccountTier'	=> $this->_AccountTier,
      'XboxOneRep'	=> $this->_XboxOneRep,
      'PreferredColor'	=> $this->_PreferredColor,
      'TenureLevel'	=> $this->_TenureLevel,
      'isSponsoredUser'	=> $this->_isSponsoredUser
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
      if($this->db->update("profile", $fields, array("id" => $this->_id)))
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
      if($this->db->insert("profile", $fields))
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
  public function getHostId()
  {
    return $this->_hostId;
  }
  public function setHostId($value)
	{
		$this->_hostId = $value;
	}
  public function getGamertag()
  {
    return $this->_Gamertag;
  }
  public function setGamertag($value)
	{
		$this->_Gamertag = $value;
	}
  public function getGameDisplayName()
  {
    return $this->_GamerDisplayName;
  }
  public function setGameDisplayName($value)
	{
		$this->_GamerDisplayName = $value;
	}
  public function getAppDisplayName()
  {
    return $this->_AppDisplayName;
  }
  public function setAppDisplayName($value)
	{
		$this->_AppDisplayName = $value;
	}
  public function getGamerscore()
  {
    return $this->_Gamerscore;
  }
  public function setGamerscore($value)
	{
		$this->_Gamerscore = $value;
	}
  public function getGameDisplayPicRaw()
  {
    return $this->_GameDisplayPicRaw;
  }
  public function setGameDisplayPicRaw($value)
	{
		$this->_GameDisplayPicRaw = $value;
	}
  public function getAppDisplayPicRaw()
  {
    return $this->_AppDisplayPicRaw;
  }
  public function setAppDisplayPicRaw($value)
	{
		$this->_AppDisplayPicRaw = $value;
	}
  public function getAccountTier()
  {
    return $this->_AccountTier;
  }
  public function setAccountTier($value)
	{
		$this->_AccountTier = $value;
	}
  public function getXboxOneRep()
  {
    return $this->_XboxOneRep;
  }
  public function setXboxOneRep($value)
	{
		$this->_XboxOneRep = $value;
	}
  public function getPreferredColor()
  {
    return $this->_PreferredColor;
  }
  public function setPreferredColor($value)
	{
		$this->_PreferredColor = $value;
	}
  public function getTenureLevel()
  {
    return $this->_TenureLevel;
  }
  public function setTenureLevel($value)
	{
		$this->_TenureLevel = $value;
	}
  public function getIsSponseredUser()
  {
    return $this->_IsSponseredUser;
  }
  public function setIsSponseredUser($value)
	{
		$this->_isSponseredUser = $value;
	}
}
