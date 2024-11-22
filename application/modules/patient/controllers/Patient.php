<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends MY_Controller {

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
		check_permissions('patient');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'All Patients';
		$data['patients'] = $this->model->patients();
		load_view('index',$data);
	}
	public function add()
	{
		check_permissions('patient_add');
		$userLoginData = $this->userLoginData;
		$post['add_by'] = $userLoginData['user_id'];
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('patient',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Patient added successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Patient not added, please try again."));
		}
	}
	public function update()
	{
		check_permissions('patient_edit');
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$post['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('patient_id',$id)
		->update('patient',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Patient updated successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Patient not updated, please try again."));
		}
	}
	public function history($type,$patient,$user)
	{
		if ($type == 'all') {
			check_permissions('all_history_prescription_token');
		}
		else{
			check_permissions('own_history_prescription_token');
		}
		$data['userLoginData'] = $this->userLoginData;
		$data['history'] = $this->model->get_prescription_history($type,$patient,$user);
		$data['patient'] = $this->model->get_patient_byid($patient);
		load_view('history',$data);
	}
}
