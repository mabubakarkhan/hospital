<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergency extends MY_Controller {

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
	/**
	 * 
	 *  PATIENTS
	 * 
	 * **/
	public function index()
	{
		check_permissions('emergency_desk');
		$data['userLoginData'] = $this->userLoginData;
		$data['page_title'] = 'Emergency Desk';
		$data['meta_title'] = 'Emergency Desk';
		$data['setting'] = $this->model->setting();
		$data['services'] = $this->model->emergency_services();
		$patients['patients'] = $this->model->emergency_patients();
		$patients['discharge'] = false;
		$data['patients'] = $this->load->view('html/patients', $patients, TRUE);
		load_view('index',$data,true);
	}
	public function patients()
	{
		check_permissions('emergency');
		$data['userLoginData'] = $this->userLoginData;
		$data['page_title'] = 'Emergency Patients';
		$data['meta_title'] = 'Emergency Patients';
		$patients['patients'] = $this->model->emergency_patients();
		$patients['discharge'] = true;
		$data['patients'] = $this->load->view('html/patients', $patients, TRUE);
		load_view('patients',$data,false);
	}
	public function post_emergency_admit()
	{
		check_permissions('emergency_desk');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$post['created_by'] = $userLoginData['user_id'];
		$this->db->insert('emergency_admit',$post);
		$patients['patients'] = $this->model->emergency_patients();
		$patients['discharge'] = false;
		$html = $this->load->view('html/patients', $patients, TRUE);
		echo json_encode(array("status"=>true,"msg"=>"Patient admited successfully","html"=>$html));
	}
	public function discharge($emergency_admit_id)
	{
		check_permissions('emergency');
		$data['userLoginData'] = $this->userLoginData;
		$data['page_title'] = 'Emergency Discharge Patient';
		$data['meta_title'] = 'Emergency Discharge Patient';
		$data['q'] = $this->model->get_emergency_admit_detailed_byid($emergency_admit_id);
		$data['drugs'] = $this->model->drugs();
		load_view('discharge',$data,false);
	}
	/**
	 * 
	 *  SETTING
	 * 
	 * **/
	public function setting()
	{
		check_permissions('emergency_setting');
		$data['userLoginData'] = $this->userLoginData;
		$data['page_title'] = 'All Setting';
		$data['meta_title'] = 'All Setting';
		$data['q'] = $this->model->setting();
		$data['services'] = $this->model->services();
		$data['users'] = $this->model->users_services();
		$data['time_table'] = $this->model->time_table();
		load_view('setting',$data,true);
	}
	public function setting_update()
	{
		check_permissions('emergency_setting');
		parse_str($_POST['data'],$post);
		$resp = $this->db
		->where('emergency_setting_id',1)
		->update('emergency_setting',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Setting updated successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Setting not updated, please try again."));
		}
	}
	public function update_services()
	{
		check_permissions('emergency_setting');
		parse_str($_POST['data'],$post);
		$this->db
		->where('1', '1')
		->delete('emergency_time_table');
		foreach ($post['service_id'] as $key => $service) {
			$insert['service_id'] = $service;
			$insert['fee'] = $post['fee'][$key];

			$insert['monday_status'] = $post['monday_status'][$key];
			$insert['monday_open'] = $post['monday_open'][$key];
			$insert['monday_close'] = $post['monday_close'][$key];

			$insert['tuesday_status'] = $post['tuesday_status'][$key];
			$insert['tuesday_open'] = $post['tuesday_open'][$key];
			$insert['tuesday_close'] = $post['tuesday_close'][$key];

			$insert['wednesday_status'] = $post['wednesday_status'][$key];
			$insert['wednesday_open'] = $post['wednesday_open'][$key];
			$insert['wednesday_close'] = $post['wednesday_close'][$key];

			$insert['thursday_status'] = $post['thursday_status'][$key];
			$insert['thursday_open'] = $post['thursday_open'][$key];
			$insert['thursday_close'] = $post['thursday_close'][$key];

			$insert['friday_status'] = $post['friday_status'][$key];
			$insert['friday_open'] = $post['friday_open'][$key];
			$insert['friday_close'] = $post['friday_close'][$key];

			$insert['saturday_status'] = $post['saturday_status'][$key];
			$insert['saturday_open'] = $post['saturday_open'][$key];
			$insert['saturday_close'] = $post['saturday_close'][$key];

			$insert['sunday_status'] = $post['sunday_status'][$key];
			$insert['sunday_open'] = $post['sunday_open'][$key];
			$insert['sunday_close'] = $post['sunday_close'][$key];

			$users = explode(',', $post['formatted_user_id'][$key]);
			foreach ($users as $keyUser => $user) {
				$insert['user_id'] = $user;
				$this->db->insert('emergency_time_table',$insert);
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"Time table updated successfully"));
	}
}
