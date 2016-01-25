<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curl_factory
{
	private $_ci;
	private $_url;
	private $_curl;

	function __construct()
  {
    /*
		*On construct get an instance of codeigniter so we can access it
		*/
		$this->_ci =& get_instance();
  }

	public function setParameters($passedURL)
	{
		$this->_url = $passedURL;
		$this->_curl = curl_init($this->_url);
		curl_setopt_array($this->_curl,
		array(
  			CURLOPT_HTTPHEADER=>array('X-AUTH: 065223134e612f5ed678a606b4b97ecdab0a1f6a'),
  			CURLOPT_RETURNTRANSFER=>TRUE,
  			CURLOPT_FOLLOWLOCATION=>TRUE
  		));
	}

	public function makeRequest()
	{
		$result = curl_exec($this->_curl);
		if($result === FALSE)
		{
  			return curl_error($this->_curl);
		}
		else
		{
			return $result;
		}
	}

	public function closeConnection()
	{
		curl_close($this->_curl);
	}
}
?>
