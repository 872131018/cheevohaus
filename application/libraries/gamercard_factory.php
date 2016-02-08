<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gamercard_factory
{
  private $_ci;

  function __construct()
  {
    /*
		*On construct get an instance of codeigniter so we can access it
		*/
		$gamercard_model->_ci =& get_instance();
    /*
    * Load the models used during the login process
    */
    $gamercard_model->_ci->load->model("gamercard_model");
  }
  /**
  * toJSON will convert the object to json representation for api use
  * @param the class will commit itself(), no params needed
  * @return the object representation as json string
  */
  public function toJSON($gamercard_model)
  {
    $data = array(
      'id' => $gamercard_model->getId(),
    	'gamertag' => $gamercard_model->getGamertag(),
    	'name' => $gamercard_model->getName(),
    	'location' => $gamercard_model->getLocation(),
    	'bio' => $gamercard_model->getBio(),
    	'gamerscore' => $gamercard_model->getGamerscore(),
    	'tier' => $gamercard_model->getTier(),
    	'motto' => $gamercard_model->getMotto(),
    	'avatarBodyImagePath' => $gamercard_model->getAvatarBodyImagePath(),
    	'gamerpicSmallImagePath' => $gamercard_model->getGamerpicSmallImagePath(),
    	'gamerpicLargeImagePath' => $gamercard_model->getGamerpicLargeImagePath(),
    	'gamerpicSmallSslImagePath' => $gamercard_model->getGamerpicSmallSslImagePath(),
    	'gamerpicLargeSslImagePath' => $gamercard_model->getGamerpicLargeSslImagePath(),
    	'avatarManifest' => $gamercard_model->getAvatarManifest()
    );
    return json_encode($data);
  }
}
