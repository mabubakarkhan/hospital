<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->database();
		$this->load->model('Model_'.strtolower(get_class()),'model');
		if (isset($_SESSION['user']) && $_SESSION['user']) {
			redirect('home');
		}
	}
	public function logout()
	{
		unset($_SESSION['user']);
		redirect('login');
	}
	public function index()
	{
		$data['page_title'] = 'Login';
		$this->load->view('index',$data);
	}
	public function submit()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']) {
			echo json_encode(array("status"=>true));
		}
		else{
			parse_str($_POST['data'],$post);
			$resp = $this->model->login($post['username'],md5($post['password']));
			if ($resp) {
				$_SESSION['user'] = serialize($resp);
				echo json_encode(array("status"=>true));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"username/password incorrect."));

			}
		}
	}
}
