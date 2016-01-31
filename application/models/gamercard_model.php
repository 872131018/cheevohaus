<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gamercard_model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  */
  var $_id;
	var $_gamertag;
	var $_name;
	var $_location;
	var $_bio;
	var $_gamerscore;
	var $_tier;
	var $_motto;
	var $_avatarBodyImagePath;
	var $_gamerpicSmallImagePath;
	var $_gamerpicLargeImagePath;
	var $_gamerpicSmallSslImagePath;
	var $_gamerpicLargeSslImagePath;
	var $_avatarManifest;

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
    	'gamertag' => $this->_gamertag,
    	'name' => $this->_name,
    	'location' => $this->_location,
    	'bio' => $this->_bio,
    	'gamerscore' => $this->_gamerscore,
    	'tier' => $this->_tier,
    	'motto' => $this->_motto,
    	'avatarBodyImagePath' => $this->_avatarBodyImagePath,
    	'gamerpicSmallImagePath' => $this->_gamerpicSmallImagePath,
    	'gamerpicLargeImagePath' => $this->_gamerpicLargeImagePath,
    	'gamerpicSmallSslImagePath' => $this->_gamerpicSmallSslImagePath,
    	'gamerpicLargeSslImagePath' => $this->_gamerpicLargeSslImagePath,
    	'avatarManifest' => $this->_avatarManifest
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
      if($this->db->update("gamercard", $fields, array("id" => $this->_id)))
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
      if($this->db->insert("gamercard", $fields))
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
  public function getGamertag()
	{
		return $this->_gamertag;
	}
	public function setGamertag($value)
	{
		$this->_gamertag = $value;
	}
  public function getName()
  {
    return $this->_name;
  }
  public function setName($value)
	{
		$this->_name = $value;
	}
  public function getLocation()
  {
    return $this->_location;
  }
  public function setLocation($value)
	{
		$this->_location = $value;
	}
  public function getBio()
  {
    return $this->_bio;
  }
  public function setBio($value)
	{
		$this->_bio = $value;
	}
  public function getGamerscore()
  {
    return $this->_gamerscore;
  }
  public function setGamerscore($value)
	{
		$this->_gamerscore = $value;
	}
  public function getTier()
  {
    return $this->_tier;
  }
  public function setTier($value)
	{
		$this->_tier = $value;
	}
  public function getMotto()
  {
    return $this->_motto;
  }
  public function setMotto($value)
	{
		$this->_motto = $value;
	}
  public function getAvatarBodyImagePath()
  {
    return $this->_avatarBodyImagePath;
  }
  public function setAvatarBodyImagePath($value)
	{
		$this->_avatarBodyImagePath = $value;
	}
  public function getGamerpicSmallImagePath()
  {
    return $this->_gamerpicSmallImagePath;
  }
  public function setGamerpicSmallImagePath($value)
	{
		$this->_gamerpicSmallImagePath = $value;
	}
  public function getGamerpicLargeImagePath()
  {
    return $this->_gamerpicSmallImagePath;
  }
  public function setGamerpicLargeImagePath($value)
	{
		$this->_gamerpicLargeImagePath = $value;
	}
  public function getGamerpicSmallSslImagePath()
  {
    return $this->_gamerpicSmallSslImagePath;
  }
  public function setGamerpicSmallSslImagePath($value)
	{
		$this->_gamerpicLargeSslImagePath = $value;
	}
  public function getGamerpicLargeSslImagePath()
  {
    return $this->_gamerpicSmallSslImagePath;
  }
  public function setGamerpicLargeSslImagePath($value)
	{
		$this->_gamerpicLargeSslImagePath = $value;
	}
  public function getAvatarManifest()
  {
    return $this->_avatarManifest;
  }
  public function setAvatarManifest($value)
	{
		$this->_avatarManifest = $value;
	}
}
