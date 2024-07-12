<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facility extends MY_Controller {

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
		check_permissions('building_facilities_view');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'All Facilities';
		$data['facilities'] = $this->model->Facilities();
		load_view('index',$data);
	}
	public function add()
	{
		check_permissions('building_facilities_add');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'Create Facility';
		$data['page_title'] = 'Create Facility';
		$data['mode'] = 'add';
		load_view('create',$data);
	}
	public function post()
	{
		check_permissions('building_facilities_add');
		if (isset($_FILES["img"]['name']) && !(empty($_FILES["img"]['name']))){
			$config['upload_path'] = 'uploads/facility';
        	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
        	$config['encrypt_name'] = TRUE;
        	$ext = pathinfo($_FILES["img"]['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES["img"]['name']).'.'.$ext;
			$config['file_name'] = $new_name;
        	$resp = $this->load->library('upload', $config);
        	if ($resp) {
	        	$this->upload->do_upload('img');
				$_POST['img'] = $this->upload->data()['file_name'];
        	}
        	else{
				$this->session->set_flashdata('error', 'Error: Profile pic must be an image file.');
				redirect('user/create');
        	}
		}
		$resp = $this->db->insert('building_facility',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: Facility created successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: Facility not created, please try again.');
		}
        redirect('facility/add');
	}
	public function edit()
	{
		check_permissions('building_facilities_edit');
		$data['page_title'] = 'Edit Facility';
		$data['mode'] = 'edit';
		$data['editID'] = $_GET['id'];
		$data['q'] = $this->model->get_facility_byid($_GET['id']);
		load_view('create',$data);
	}
	public function update()
	{
		check_permissions('building_facilities_edit');
		$building_facility_id = $_POST['id'];unset($_POST['id']);
		if (isset($_FILES["img"]['name']) && !(empty($_FILES["img"]['name']))){
			$config['upload_path'] = 'uploads/facility';
        	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
        	$config['encrypt_name'] = TRUE;
        	$ext = pathinfo($_FILES["img"]['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES["img"]['name']).'.'.$ext;
			$config['file_name'] = $new_name;
        	$resp = $this->load->library('upload', $config);
        	if ($resp) {
	        	$this->upload->do_upload('img');
				$_POST['img'] = $this->upload->data()['file_name'];
        	}
        	else{
				$this->session->set_flashdata('error', 'Error: Profile pic must be an image file.');
				redirect('user/create');
        	}
		}
		$resp = $this->db
		->where('building_facility_id',$building_facility_id)
		->update('building_facility',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: Facility updated successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: Facility not updated, please try again.');
		}
        redirect('facility/edit?id='.$building_facility_id);
	}
}
