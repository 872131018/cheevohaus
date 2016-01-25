<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_factory
{
  private $_ci;

  function __construct()
  {
    /*
		*On construct get an instance of codeigniter so we can access it
		*/
		$profile_model->_ci =& get_instance();
    /*
    * Load the models used during the login process
    */
    $profile_model->_ci->load->model("profile_model");
  }
  /**
  * toJSON will convert the object to json representation for api use
  * @param the class will commit itself(), no params needed
  * @return the object representation as json string
  */
  public function toJSON($profile_model)
  {
    $data = array(
      'id' => $profile_model->getId(),
      'xuid' => $profile_model->getXuid(),
      'hostId'  => $profile_model->getHostId(),
      'Gamertag'	=> $profile_model->getGamertag(),
      'GameDisplayName'	=> $profile_model->getGameDisplayName(),
      'AppDisplayName'	=> $profile_model->getAppDisplayName(),
      'Gamerscore'	=> $profile_model->getGamerscore(),
      'GameDisplayPicRaw'	=> $profile_model->getGameDisplayPicRaw(),
      'AppDisplayPicRaw'	=> $profile_model->getAppDisplayPicRaw(),
      'AccountTier'	=> $profile_model->getAccountTier(),
      'XboxOneRep'	=> $profile_model->getXboxOneRep(),
      'PreferredColor'	=> $profile_model->getPreferredColor(),
      'TenureLevel'	=> $profile_model->getTenureLevel(),
      'isSponsoredUser'	=> $profile_model->getIsSponsoredUser()
    );
    return json_encode($data);
  }
}
