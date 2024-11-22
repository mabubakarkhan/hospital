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
		$data['prescription_procedures'] = false;
		$data['prescription_lab_tests'] = false;
		$data['prescription_drugs'] = false;
		$data['prescription_radiology_tests'] = false;
		$data['investigations'] = false;
		if ($data['prescription']) {
			$data['prescription_procedures'] = $this->model->prescription_procedures($data['prescription']['prescription_id']);
			$data['prescription_drugs'] = $this->model->get_prescription_drugs($data['prescription']['prescription_id']);
			$prescription_lab_tests = $this->model->get_prescription_lab_tests($data['prescription']['prescription_id']);
			$data['prescription_lab_tests'] = explode(',', $prescription_lab_tests['ids']);
			$data['investigations'] = $this->model->get_investigations($data['prescription']['prescription_id']);
			$data['prescription_radiology_tests'] = $this->model->get_prescription_radiology_tests($data['prescription']['prescription_id']);
		}
		if (!($data['token'])) {
			redirect('logout');
		}
		$data['followUpDate'] = $this->model->get_row("SELECT `followup_date` FROM `token_followup` WHERE `token_id` = '".$data['token']['token_id']."'");
		$data['lab_test_cats'] = $this->model->lab_test_active_cats();
		$data['lab_active_tests'] = $this->model->lab_active_tests();
		$data['radiology_tests'] = $this->model->radiology_tests('active');
		$data['historyUrl'] = '';
		if (in_array('all_history_prescription_token', $data['userLoginData']['permissions'])) {
			$check = $this->model->get_row("SELECT `token_id` FROM `token` WHERE `patient_id` = '".$data['token']['patient_id']."' ORDER BY `token_id` DESC;");
			if ($check) {
				$data['historyUrl'] = ' - <small style="font-size:11px;"><a href="'.BASEURL.'patient/history/all/'.$data['token']['patient_id'].'/'.$data['token']['user_id'].'" target="_blank">history</a></small>';
			}
		}
		else if (in_array('own_history_prescription_token', $data['userLoginData']['permissions'])) {
			$check = $this->model->get_row("SELECT `token_id` FROM `token` WHERE `patient_id` = '".$data['token']['patient_id']."' AND `user_id` = '".$data['token']['user_id']."' ORDER BY `token_id` DESC;");
			if ($check) {
				$data['historyUrl'] = ' - <small style="font-size:11px;"><a href="'.BASEURL.'patient/history/own/'.$data['token']['patient_id'].'/'.$data['token']['user_id'].'" target="_blank">history</a></small>';
			}
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
			$procedureIds = array_unique($procedureIds);
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
	public function lab_test_submit()
	{
		check_permissions('add_prescription_token');
		parse_str($_POST['data'],$post);
		if (isset($post['prescription_id'])) {
			$prescriptionId = $post['prescription_id'];
		}
		else{
			$ins['token_id'] = $post['token_id'];
			$this->db->insert('prescription',$ins);
			$prescriptionId = $this->db->insert_id();
		}
		$this->db->where('prescription_id',$prescriptionId)->delete('prescription_lab_test');
		$testIds = $post['lab_test_id']; unset($post['lab_test_id']);
		foreach ($testIds as $key => $q) {
			if (isset($q) && strlen($q) > 0) {
				$insert['prescription_id'] = $prescriptionId;
				$insert['lab_test_id'] = $q;
				$this->db->insert('prescription_lab_test',$insert);
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"Lab test updated successfully."));
	}
	public function add_prescription_drug($value='')
	{
		check_permissions('add_prescription_token');
		parse_str($_POST['data'],$post);
		if ($post['prescription_id'] > '0') {
			$post['prescription_id'] = $post['prescription_id'];
		}
		else{
			$ins['token_id'] = $post['token_id'];
			$this->db->insert('prescription',$ins);
			$post['prescription_id'] = $this->db->insert_id();
		}
		$resp = $this->db->insert('prescription_drug',$post);
		if ($resp) {
			$prescription_drug = $this->model->get_prescription_drugs($post['prescription_id']);
			$html = '<ul class="prescriptionDrugListItemWrap">';
			foreach ($prescription_drug as $key => $pd) {
				$html .= '<li class="prescriptionDrugListItem">';
					$html .= '<span>'.$pd['name'].' '.$pd['type'].' '.$pd['strength_frequencey'].'</span>';
					$html .= '<small>';
						$html .= '<a href="javascript://" class="editPrescriptionDrugItem" data-id="'.$pd['prescription_drug_id'].'" data-prescription_id="'.$pd['prescription_id'].'" data-drug_id="'.$pd['drug_id'].'" data-name="'.$pd['name'].'" data-type="'.$pd['type'].'" data-generic_name="'.$pd['generic_name'].'" data-strength="'.$pd['strength'].'" data-strength_frequencey="'.$pd['strength_frequencey'].'" data-instruction="'.$pd['instruction'].'" data-duration="'.$pd['duration'].'" data-duration_type="'.$pd['duration_type'].'" data-frequency="'.$pd['frequency'].'" data-quantity="'.$pd['quantity'].'" data-quantity_type="'.$pd['quantity_type'].'" data-route="'.$pd['route'].'"><i class="icon-pencil-alt"></i></a> ';
						$html .= '<a href="javascript://" class="removePrescriptionDrugItem" data-id="'.$pd['prescription_drug_id'].'" style="color: red;"><i class="fa fa-trash-o"></i></a>';
					$html .= '</small>';
				$html .= '</li>';
			}
			$html .= '</ul>';
			echo json_encode(array("status"=>true,"prescription_id"=>$post['prescription_id'],"msg"=>"Drug added successfully.","html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"prescription_id"=>$post['prescription_id'],"msg"=>"Drug not added."));
		}
	}
	public function edit_prescription_drug($value='')
	{
		check_permissions('add_prescription_token');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$resp = $this->db
		->where('prescription_drug_id',$id)
		->where('user_id',$userLoginData['user_id'])
		->update('prescription_drug',$post);
		if ($resp) {
			$prescription_drug = $this->model->get_prescription_drugs($post['prescription_id']);
			$html = '<ul class="prescriptionDrugListItemWrap">';
			foreach ($prescription_drug as $key => $pd) {
				$html .= '<li class="prescriptionDrugListItem">';
					$html .= '<span>'.$pd['name'].' '.$pd['type'].' '.$pd['strength_frequencey'].'</span>';
					$html .= '<small>';
						$html .= '<a href="javascript://" class="editPrescriptionDrugItem" data-id="'.$pd['prescription_drug_id'].'" data-prescription_id="'.$pd['prescription_id'].'" data-drug_id="'.$pd['drug_id'].'" data-name="'.$pd['name'].'" data-type="'.$pd['type'].'" data-generic_name="'.$pd['generic_name'].'" data-strength="'.$pd['strength'].'" data-strength_frequencey="'.$pd['strength_frequencey'].'" data-instruction="'.$pd['instruction'].'" data-duration="'.$pd['duration'].'" data-duration_type="'.$pd['duration_type'].'" data-frequency="'.$pd['frequency'].'" data-quantity="'.$pd['quantity'].'" data-quantity_type="'.$pd['quantity_type'].'" data-route="'.$pd['route'].'"><i class="icon-pencil-alt"></i></a> ';
						$html .= '<a href="javascript://" class="removePrescriptionDrugItem" data-id="'.$pd['prescription_drug_id'].'" style="color: red;"><i class="fa fa-trash-o"></i></a>';
					$html .= '</small>';
				$html .= '</li>';
			}
			$html .= '</ul>';
			echo json_encode(array("status"=>true,"prescription_id"=>$post['prescription_id'],"msg"=>"Drug updated successfully.","html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"prescription_id"=>$post['prescription_id'],"msg"=>"Drug not update."));
		}
	}
	public function delete_prescription_drug()
	{
		check_permissions('add_prescription_token');
		$userLoginData = $this->userLoginData;
		$resp = $this->db
		->where('user_id',$userLoginData['user_id'])
		->where('prescription_drug_id',$_POST['id'])
		->delete('prescription_drug');
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Drug removed."));
		}
		else{
			echo json_encode(array("status"=>true,"msg"=>"Drug not removed."));
		}
	}
	public function post_investigation()
	{
		check_permissions('add_prescription_token');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		if ($post['prescription_id'] > '0') {
			$insert['prescription_id'] = $post['prescription_id'];
			$this->db->where('prescription_id',$insert['prescription_id'])->delete('investigation');
		}
		else{
			$ins['token_id'] = $post['token_id'];
			$this->db->insert('prescription',$ins);
			$insert['prescription_id'] = $this->db->insert_id();
		}
		$insert['user_id'] = $post['user_id'];
		$insert['token_id'] = $post['token_id'];
		foreach ($post['lab_test_id'] as $key => $q) {
			if (isset($q) && strlen($q) > 0) {
				$insert['lab_test_id'] = $q;
				$insert['result'] = $post['result'][$key];
				$insert['previous_result'] = $post['previous_result'][$key];
				$insert['previous_result_at'] = $post['previous_result_at'][$key];
				$insert['comment'] = $post['comment'][$key];
				$this->db->insert('investigation',$insert);
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"investigation updated successfully."));
	}
	public function post_radiology()
	{
		check_permissions('add_prescription_token');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		if ($post['prescription_id'] > '0') {
			$insert['prescription_id'] = $post['prescription_id'];
			$this->db->where('prescription_id',$insert['prescription_id'])->delete('prescription_radiology_test');
		}
		else{
			$ins['token_id'] = $post['token_id'];
			$this->db->insert('prescription',$ins);
			$insert['prescription_id'] = $this->db->insert_id();
		}
		$insert['user_id'] = $post['user_id'];
		$insert['token_id'] = $post['token_id'];
		foreach ($post['radiology_test_id'] as $key => $q) {
			if (isset($q) && strlen($q) > 0) {
				$insert['radiology_test_id'] = $q;
				$insert['priority'] = $post['priority'][$key];
				$this->db->insert('prescription_radiology_test',$insert);
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"Radiology Test updated successfully."));
	}
	public function submit_followup()
	{
		check_permissions('add_prescription_token');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$post['followup_date'] = date('Y-m-d H:i:s',strtotime($post['followup_date']));
		$this->db->insert('token_followup',$post);
		echo json_encode(array("status"=>true,"msg"=>"Followup added successfully."));
	}
}
