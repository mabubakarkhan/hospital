<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

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
		$this->load->model('Model_home','model');
	}

	public function index()
	{
		$data['meta_title'] = 'Dashboard';
		load_view('index');
	}

	//Token Related
	public function get_current_active_doctors_for_opd()
	{
		check_permissions('create_token');
		$currentDayName = strtolower(date('l'));
		$resp = $this->model->get_opd_active_users($currentDayName);
		if ($resp) {
			$html = '<option value="">Select Doctor</option>';
			foreach ($resp as $key => $q) {
				$html .= '<option value="'.$q['user_id'].'" data-service_id="'.$q['service_id'].'" data-user_room_time_id="'.$q['user_room_time_id'].'" data-room_id="'.$q['room_id'].'" data-user_commission="'.$q['user_commission'].'" data-fee="'.$q['fee'].'">'.$q['fname'].' '.$q['lname'].' - '.$q['serviceName'].' ('.$q['roomTitle'].' - '.$q['floorTitle'].') </option>';
			}
			echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"html"=>"<option value=''>No Doctor Found</option>"));
		}
	}
	public function patient_search_for_token()
	{
		check_permissions('create_token');
		$resp = $this->model->patient_search_for_token_by_key($_POST['key']);
		if ($resp) {
			$html = '';
			foreach ($resp as $key => $q) {
				$html .= '<a href="javascript://" class="selectPatientBtn" data-id="'.$q['patient_id'].'" data-title="'.$q['fname'].' '.$q['lname'].' - '.$q['mobile'].'">'.$q['fname'].' '.$q['lname'].'<br><small>'.$q['mobile'].'</small></a>';
			}
			$html .= '<hr><a href="javascript://" class="addPatientBtn" style="color: blue;">+ Add Patient</a>';
		}
		else{
			$html = '<a href="javascript://" class="addPatientBtn" style="color: blue;">+ Add Patient</a>';
		}
		echo json_encode(array("status"=>true,"html"=>$html));
	}
}
