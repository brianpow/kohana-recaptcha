<?php defined('SYSPATH') or die('No direct script access.');
/**
 * reCAPTCHA module 
 *
 * @package    Helper
 */

class Kohana_Recaptcha {
	protected $_config;
	protected $_error = NULL;
	public function __construct($config = NULL)
	{
		include_once Kohana::find_file('vendor', 'recaptcha/recaptchalib');
		$this->_config= Kohana::$config->load('recaptcha');		

		if(is_array($config))
			$this->_config = Arr::overwrite($this->_config,$config);
		return $this;
	}
	public function check($answers,$fields=array("recaptcha_challenge_field","recaptcha_response_field"))
	{
		$recaptcha_resp = recaptcha_check_answer($this->_config['private_key'],
									$_SERVER['REMOTE_ADDR'],
									$answers[$fields[0]],
									$answers[$fields[1]]);

		$this->_error=$recaptcha_resp->error;
		return $recaptcha_resp->is_valid;
	}
	public function error()
	{
		return $this->_error;
	}
	public function html()
	{
		return recaptcha_get_html($this->_config['public_key'], $this->_error);
	}
}