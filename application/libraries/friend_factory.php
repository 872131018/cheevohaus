<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend_factory
{
  private $_ci;

  function __construct()
  {
    /*
		*On construct get an instance of codeigniter so we can access it
		*/
		$friend_model->_ci =& get_instance();
    /*
    * Load the models used during the login process
    */
    $friend_model->_ci->load->model("friend_model");
  }
  /**
  * toJSON will convert the object to json representation for api use
  * @param the class will commit itself(), no params needed
  * @return the object representation as json string
  */
  public function toJSON($friend_model)
  {
    $data = array(
      'id' => $friend_model->getId(),
    	'xuid' => $friend_model->getXuid(),
    	'hostId' => $friend_model->getHostId(),
    	'Gamertag' => $friend_model->getGamertag(),
    	'GameDisplayName' => $friend_model->getGameDisplayName(),
    	'AppDisplayName' => $friend_model->getAppDisplayName(),
    	'Gamerscore' => $friend_model->getGamerscore(),
    	'GameDisplayPicRaw' => $friend_model->getGameDisplayPicRaw(),
    	'AppDisplayPicRaw' => $friend_model->getAppDisplayPicRaw(),
    	'AccountTier' => $friend_model->getAccountTier(),
    	'XboxOneRep' => $friend_model->getXboxOneRep(),
    	'PreferredColor' => $friend_model->getPreferredColor(),
    	'TenureLevel' => $friend_model->getTenureLevel(),
    	'isSponsoredUsers' => $friend_model->getIsSponsoredUsers()
    );
    return json_encode($data);
  }
}
