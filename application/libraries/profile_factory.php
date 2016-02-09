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
    return json_encode($profile_model);
  }
}
