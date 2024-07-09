<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Building extends MY_Controller {

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
		check_permissions('building_floor_view');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'All Floors';
		$data['floors'] = $this->model->floors();
		load_view('index',$data);
	}
	public function add_floor()
	{
		check_permissions('building_floor_add');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'Add New Floor';
		$data['page_title'] = 'Add New Floor';
		$data['mode'] = 'add';
		load_view('add_floor',$data);
	}
	public function post_floor()
	{
		check_permissions('building_floor_add');
		$resp = $this->db->insert('floor',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: floor created successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: floor not created, please try again.');
		}
        redirect('building/add-floor');
	}
	public function edit_floor()
	{
		check_permissions('building_floor_edit');
		$data['page_title'] = 'Edit Floor';
		$data['mode'] = 'edit';
		$data['editID'] = $_GET['id'];
		$data['q'] = $this->model->get_floor_byid($_GET['id']);
		load_view('add_floor',$data);
	}
	public function update_floor()
	{
		check_permissions('building_floor_edit');
		$id = $_POST['id'];unset($_POST['id']);
		$_POST['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('floor_id',$id)
		->update('floor',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: floor updated successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: floor not updated, please try again.');
		}
        redirect('building/edit-floor?id='.$id);
	}
	public function rooms($floorId = 0)
	{
		check_permissions('building_room_view');
		$data['userLoginData'] = $this->userLoginData;
		if ($floorId > 0) {
			$data['floor'] = $this->model->get_floor_byid($floorId);
			$data['page_title'] = $data['floor']['title'].' - Rooms';
			$data['meta_title'] = $data['floor']['title'].' - Rooms';
		}
		else{
			$data['floor'] = false;
			$data['page_title'] = 'All Rooms';
			$data['meta_title'] = 'All Rooms';
		}
		$data['floorId'] = $floorId;
		$data['rooms'] = $this->model->rooms($floorId);
		load_view('rooms',$data);
	}
	public function add_room($floorId = 0)
	{
		check_permissions('building_room_add');
		$data['userLoginData'] = $this->userLoginData;
		if ($floorId > 0) {
			$data['floor'] = $this->model->get_floor_byid($floorId);
			$data['page_title'] = 'Add Room - '.$data['floor']['title'];
			$data['meta_title'] = 'Add Room - '.$data['floor']['title'];
		}
		else{
			$data['floor'] = false;
			$data['page_title'] = 'Add Room';
			$data['meta_title'] = 'Add Room';
		}
		$data['mode'] = 'add';
		$data['floorId'] = $floorId;
		$data['floors'] = $this->model->floors();
		load_view('add_room',$data);
	}
	public function post_room()
	{
		check_permissions('building_room_add');
		$resp = $this->db->insert('room',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: room created successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: room not created, please try again.');
		}
        redirect('building/add-room/'.$_POST['floor_id']);
	}
	public function edit_room($floorId = 0)
	{
		check_permissions('building_room_edit');
		if ($floorId > 0) {
			$data['floor'] = $this->model->get_floor_byid($floorId);
			$data['page_title'] = 'Edit Room - '.$data['floor']['title'];
			$data['meta_title'] = 'Edit Room - '.$data['floor']['title'];
		}
		else{
			$data['floor'] = false;
			$data['page_title'] = 'Edit Room';
			$data['meta_title'] = 'Edit Room';
		}
		$data['mode'] = 'edit';
		$data['floorId'] = $floorId;
		$data['floors'] = $this->model->floors();
		$data['q'] = $this->model->get_room_byid($_GET['id']);
		$data['editID'] = $_GET['id'];
		load_view('add_room',$data);
	}
	public function update_room()
	{
		check_permissions('building_room_add');
		$id = $_POST['id'];unset($_POST['id']);
		$_POST['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('room_id',$id)
		->update('room',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: room created successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: room not created, please try again.');
		}
        redirect('building/edit-room/'.$_POST['floor_id'].'/?id='.$id);
	}
}
