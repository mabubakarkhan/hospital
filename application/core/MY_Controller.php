<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{	

	function __construct() 
	{
		parent::__construct();
		$checkModule = $this->router->fetch_module();
		if ($checkModule == 'login') {
			$this->load->helper(array('form', 'url'));
			$this->_hmvc_fixes();
		}
		else{
			$this->load->helper(array('form', 'url', 'template_helper','session_helper'));
			$this->_hmvc_fixes();
			check_login();
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
