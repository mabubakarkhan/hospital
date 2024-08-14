<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prescription extends MY_Controller {

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
		redirect('logout');
	}
	public function new()
	{
		check_permissions('add_prescription_token');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'Prescription';
		$data['token'] = $this->model->get_token_detail_byid($_GET['id']);
		$data['prescription'] = $this->model->get_prescription_by_token_id($data['token']['token_id']);
		$data['procedures'] = $this->model->procedures('active');
		if ($data['prescription']) {
			$data['prescription_procedures'] = $this->model->prescription_procedures($data['prescription']['prescription_id']);
		}
		else{
			$data['prescription_procedures'] = false;
		}
		if (!($data['token'])) {
			redirect('logout');
		}
		load_view('new',$data,true);
	}
	public function submit()
	{
		check_permissions('add_prescription_token');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$procedureIds = $post['procedure_id']; unset($post['procedure_id']);
		if ($userLoginData['user_id'] == $post['user_id']) {
			unset($post['user_id']);
			if (isset($post['prescription_id'])) {
				$prescriptionId = $post['prescription_id'];
				$this->db
				->where('prescription_id',$prescriptionId)
				->update('prescription',$post);
			}
			else{
				$resp = $this->db->insert('prescription',$post);
				$prescriptionId = $this->db->insert_id();
			}
			$this->db->where('prescription_id',$prescriptionId)->delete('prescription_procedure');
			foreach ($procedureIds as $key => $q) {
				if (isset($q) && strlen($q) > 0) {
					$insert['prescription_id'] = $prescriptionId;
					$insert['procedure_id'] = $q;
					$this->db->insert('prescription_procedure',$insert);
				}
			}
			echo json_encode(array("status"=>true,"msg"=>"Record updated successfully."));
		}
		else{
			redirect('logout');
			echo json_encode(array("status"=>false,"msg"=>"dew to some reasons you are logout."));
		}
	}
}
