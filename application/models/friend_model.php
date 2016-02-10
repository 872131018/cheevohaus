<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend_model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  * @note had to remove  because of batch insert
  */
  var $id;
	var $xuid;
	var $hostId;
	var $Gamertag;
	var $GameDisplayName;
	var $AppDisplayName;
	var $Gamerscore;
	var $GameDisplayPicRaw;
	var $AppDisplayPicRaw;
	var $AccountTier;
	var $XboxOneRep;
	var $PreferredColor;
	var $TenureLevel;
	var $isSponsoredUser;

  function construct()
  {
    parent::construct();
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
    	'hostId' => $this->hostId,
    	'Gamertag' => $this->Gamertag,
    	'GameDisplayName' => $this->GameDisplayName,
    	'AppDisplayName' => $this->AppDisplayName,
    	'Gamerscore' => $this->Gamerscore,
    	'GameDisplayPicRaw' => $this->GameDisplayPicRaw,
    	'AppDisplayPicRaw' => $this->AppDisplayPicRaw,
    	'AccountTier' => $this->AccountTier,
    	'XboxOneRep' => $this->XboxOneRep,
    	'PreferredColor' => $this->PreferredColor,
    	'TenureLevel' => $this->TenureLevel,
    	'isSponsoredUser' => $this->isSponsoredUser
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
      if($this->db->update("friends", $fields, array("id" => $this->id)))
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
      if($this->db->insert("friends", $fields))
			{
        return $this->db->insertid();
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
