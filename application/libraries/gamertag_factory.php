<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gamertag_factory
{
  private $_ci;

  function __construct()
  {
    /*
		*On construct get an instance of codeigniter so we can access it
		*/
		$this->_ci =& get_instance();
    /*
    * Load the models used during the login process
    */
    $this->_ci->load->model("validGamertag_model");
  }
  /**
  * toJSON will convert the object to json representation for api use
  * @param the class will commit itself, no params needed
  * @return the object representation as json string
  */
  public function toJSON($validGamertag_model)
  {
    $data = array(
      "id" => $validGamertag_model->id,
      "xuid" => $validGamertag_model->xuid,
      "gamertag" => $validGamertag_model->gamertag
    );
    return json_encode($data);
  }
}
