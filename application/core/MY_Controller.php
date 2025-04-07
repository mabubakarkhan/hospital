<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{	
	public $userLoginData = false;
	function __construct() 
	{
		parent::__construct();
		$checkModule = $this->router->fetch_module();
		if ($checkModule == 'login') {
			$this->load->library(array('session','form_validation'));
			$this->load->helper(array('form','url','dal_helper'));
			$this->_hmvc_fixes();
		}
		else{
			$this->load->library(array('session','form_validation'));
			$this->load->helper(array('form','url','dal_helper','template_helper','session_helper','access_helper'));
			$this->_hmvc_fixes();
			$this->userLoginData = check_login();
			if (isset($this->userLoginData['emergency_service'])) {
				define('EMERGENCY_SERVICE', $this->userLoginData['emergency_service']);
			}
		}
			// $this->_hmvc_fixes();
	}
	
	function _hmvc_fixes()
	{		
		//fix callback form_validation		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
