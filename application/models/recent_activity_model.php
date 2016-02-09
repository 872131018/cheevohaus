<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recent_activity_model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  * @note had to remove  because of batch insert
  */
  var $id;
	var $startTime;
	var $endTime;
	var $sessionDurationInMinutes;
	var $contentImageUri;
	var $bingId;
	var $contentTitle;
	var $vuiDisplayName;
	var $platform;
	var $titleId;
	var $description;
	var $date;
	var $hasUgc;
	var $activityItemType;
	var $contentType;
	var $shortDescription;
	var $itemText;
	var $itemImage;
	var $shareRoot;
	var $feedItemId;
	var $itemRoot;
	var $hasLiked;
	var $gamertag;
	var $realName;
	var $displayName;
	var $userImageUri;
	var $userXuid;

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
    	'startTime' => $this->startTime,
    	'endTime' => $this->endTime,
    	'sessionDurationInMinutes' => $this->sessionDurationInMinutes,
    	'contentImageUri' => $this->contentImageUri,
    	'bingId' =>$this->bingId,
    	'contentTitle' => $this->contentTitle,
    	'vuiDisplayName' => $this->vuiDisplayName,
    	'platform' => $this->platform,
    	'titleId' => $this->titleId,
    	'description' => $this->description,
    	'date' => $this->date,
    	'hasUgc' => $this->hasUgc,
    	'activityItemType' => $this->activityItemType,
    	'contentType' => $this->contentType,
    	'shortDescription' => $this->shortDescription,
    	'itemText' => $this->itemText,
    	'itemImage' => $this->itemImage,
    	'shareRoot' => $this->shareRoot,
    	'feedItemId' => $this->feedItemId,
    	'itemRoot' => $this->itemRoot,
    	'hasLiked' => $this->hasLiked,
    	'gamertag' => $this->gamertag,
    	'realName' => $this->realName,
    	'displayName' => $this->displayName,
    	'userImageUri' => $this->userImageUri,
    	'userXuid' => $this->userXuid
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
      if($this->db->update("recentActivity", $fields, array("id" => $this->id)))
			{
        return true;
      }
			else
			{
				/*
				*There was an error with the update retrieve and show error
				*TODO: handle error properly
				*/
				vardump($this->db->error());
				die;
			}
    }
		else
		{
      if($this->db->insert("recentActivity", $fields))
			{
        return $this->db->insertid();
      }
			else
			{
				/*
				*There was an error with the insert retrieve and show error
				*TODO: handle error properly
				*/
				vardump($this->db->error());
				die;
			}
    }
		/*
		*If the function is this far it has failed
		*/
    return false;
  }
}
