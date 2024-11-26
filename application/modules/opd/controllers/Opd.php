<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opd extends MY_Controller {

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
		$this->load->database();
		$this->load->model('Model_'.strtolower(get_class()),'model');
	}

	public function index()
	{
		check_permissions('opd');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'OPD';
		$checkUserPermissions = unserialize($_SESSION['user']);
		if ($checkUserPermissions['permissions'] == 'all' || in_array('view_all_tokens', $checkUserPermissions['permissions'])) {
			$data['general_token_numbers'] = $this->model->get_row("SELECT GROUP_CONCAT(`token_number`) AS 'token_numbers' FROM `token` WHERE DATE(`at`) = CURRENT_DATE AND `type` = 'general';");
			load_view('index',$data,true);
		}
		elseif ($checkUserPermissions['permissions'] == 'all' || in_array('view_own_tokens', $checkUserPermissions['permissions'])) {
			$data['tokens'] = $this->model->get_current_tokens_by_user_id($data['userLoginData']['user_id'],'token');
			$data['general_tokens'] = $this->model->get_current_tokens_by_user_id($data['userLoginData']['user_id'],'general');
			load_view('opd_own',$data,true);
		}
		else{
			redirect('logout');
		}
	}
	public function create_token()
	{
		check_permissions('create_token');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('token',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Token created successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Token not created, please try again."));
		}
	}
	public function submit_token_status()
	{
		check_permissions('change_token_status');
		$userLoginData = $this->userLoginData;
		$resp = $this->db
		->where('token_id',$_POST['id'])
		->where('user_id',$userLoginData['user_id'])
		->set('status',$_POST['status'])
		->set('comment',$_POST['comment'])
		->update('token');
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Token updated successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Token not updated."));
		}
	}
	public function get_tokens()
	{
		check_permissions('opd');
		$data['userLoginData'] = $this->userLoginData;
		$data['currentDate'] = date('Y-m-d',strtotime($_POST['date']));
		$data['tokens'] = $this->model->get_tokens('token',$data['currentDate']);
		$data['general_tokens'] = $this->model->get_tokens('general',$data['currentDate']);

		//slots
		$data['token_numbers'] = $this->model->get_row("SELECT GROUP_CONCAT(`token_number`) AS 'token_numbers' FROM `token` WHERE DATE(`at`) = '".$data['currentDate']."' AND `type` = 'token';");
		$tokenOptions = $this->available_tokens($data['token_numbers']);

		//check current date
		$currentDate = new DateTime();
		$givenDate = new DateTime($data['currentDate']);
		$currentDate->setTime(0, 0);
		$givenDate->setTime(0, 0);
		$data['allowCreateTokenButton'] = false;
		if ($givenDate >= $currentDate) {
		    $data['allowCreateTokenButton'] = true;
		}

		echo json_encode(
			array(
				"status" => true,
				"html" => $this->load->view('html/tokens',$data,true),
				"allowCreateTokenButton" => $data['allowCreateTokenButton'],
				"currentDate" => $data['currentDate'],
				"tokenOptions" => $tokenOptions
			)
		);
	}
	protected function available_tokens($token_numbers)
	{
		$options = '<option value="">Select Token</option>';
		$tokenNumberKey = 0;
		$tokenNumberKeyTotal = 101;
		$token_numbers = explode(',', $token_numbers['token_numbers']);
		if (count($token_numbers) >= 101) {
			$tokenNumberKeyTotal = count($token_numbers) + 20;
		}
		for ($i=1; $i < $tokenNumberKeyTotal; $i++) {
			if (!(in_array($i, $token_numbers))):
				if ($tokenNumberKey == 0):
					$tokenNumberKey = 1;
					$options .= '<option value="'.$i.'" selected>'.$i.'</option>';
				else:
					$options .= '<option value="'.$i.'">'.$i.'</option>';
				endif;
			endif;
		}
		return $options;
	}
}
