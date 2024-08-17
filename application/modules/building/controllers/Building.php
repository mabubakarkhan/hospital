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
		check_permissions('building_building_view');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'All Buildings';
		$data['buildings'] = $this->model->buildings();
		load_view('index',$data);
	}
	public function add_building()
	{
		check_permissions('building_building_add');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'Add New Building';
		$data['page_title'] = 'Add New Building';
		$data['mode'] = 'add';
		load_view('add_building',$data);
	}
	public function post_building()
	{
		check_permissions('building_building_add');
		if (isset($_FILES["img"]['name']) && !(empty($_FILES["img"]['name']))){
			$config['upload_path'] = 'uploads/building';
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
				$this->session->set_flashdata('error', 'Error: Image must be an image file.');
				redirect('building/add-building');
        	}
		}
		$resp = $this->db->insert('building',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: building created successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: building not created, please try again.');
		}
        redirect('building/add-building');
	}
	public function edit_building()
	{
		check_permissions('building_building_edit');
		$data['page_title'] = 'Edit Building';
		$data['mode'] = 'edit';
		$data['editID'] = $_GET['id'];
		$data['q'] = $this->model->get_building_byid($_GET['id']);
		load_view('add_building',$data);
	}
	public function update_building()
	{
		check_permissions('building_building_edit');
		$id = $_POST['id'];unset($_POST['id']);
		$_POST['updated_at'] = date('Y-m-d H:i:s');
		if (isset($_FILES["img"]['name']) && !(empty($_FILES["img"]['name']))){
			$config['upload_path'] = 'uploads/building';
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
				$this->session->set_flashdata('error', 'Error: Image must be an image file.');
				redirect('building/add-building');
        	}
		}
		$resp = $this->db
		->where('building_id',$id)
		->update('building',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: building updated successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: building not updated, please try again.');
		}
        redirect('building/edit-building?id='.$id);
	}
	public function floors($buildingId = 0)
	{
		check_permissions('building_floor_view');
		$data['userLoginData'] = $this->userLoginData;
		if ($buildingId > 0) {
			$data['building'] = $this->model->get_building_byid($buildingId);
			$data['page_title'] = $data['building']['title'].' - Floors';
			$data['meta_title'] = $data['building']['title'].' - Floors';
		}
		else{
			$data['building'] = false;
			$data['page_title'] = 'All Floors';
			$data['meta_title'] = 'All Floors';
		}
		$data['buildingId'] = $buildingId;
		$data['floors'] = $this->model->floors($buildingId);
		load_view('floors',$data);
	}
	public function add_floor($buildingId = 0)
	{
		check_permissions('building_floor_add');
		$data['userLoginData'] = $this->userLoginData;
		if ($buildingId > 0) {
			$data['building'] = $this->model->get_building_byid($buildingId);
			$data['page_title'] = $data['building']['title'].' - Add Floor';
			$data['meta_title'] = $data['building']['title'].' - Add Floor';
		}
		else{
			$data['building'] = false;
			$data['page_title'] = 'Add Floor';
			$data['meta_title'] = 'Add Floor';
		}
		$data['buildingId'] = $buildingId;
		$data['mode'] = 'add';
		$data['buildings'] = $this->model->buildings();
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
        redirect('building/add-floor/'.$_POST['building_id']);
	}
	public function edit_floor($buildingId = 0)
	{
		check_permissions('building_floor_edit');
		
		if ($buildingId > 0) {
			$data['building'] = $this->model->get_building_byid($buildingId);
			$data['page_title'] = 'Edit Floor - '.$data['building']['title'];
			$data['meta_title'] = 'Edit Floor - '.$data['building']['title'];
		}
		else{
			$data['building'] = false;
			$data['page_title'] = 'Edit Floor';
			$data['meta_title'] = 'Edit Floor';
		}
		$data['buildingId'] = $buildingId;

		$data['mode'] = 'edit';
		$data['editID'] = $_GET['id'];
		$data['q'] = $this->model->get_floor_byid($_GET['id']);
		$data['buildings'] = $this->model->buildings();
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
        redirect('building/edit-floor/'.$_POST['building_id'].'?id='.$id);
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
		load_view('rooms',$data, true);
	}
	public function add_room($floorId = 0)
	{
		die('here)';
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
		check_permissions('building_room_edit');
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
	public function get_room_facilities()
	{
		check_permissions('building_room_facilities_view');
		$room = $this->model->get_room_byid($_POST['id']);
		$roomFacilities = explode(',', $room['facilities']);
		$facilities = $this->model->facilities();
		if ($facilities) {
			$html = '<div class="show-modal-msg" style="display:none;"></div>';
			$html .= '<form>';
				$html .= '<input type="hidden" name="id" value="'.$_POST['id'].'">';
				$html .= '<div class="col">';
					$html .= '<div class="m-t-15 m-checkbox-inline">';
						foreach ($facilities as $key => $q) {
							$html .= '<div class="form-check form-check-inline checkbox checkbox-dark mb-0">';
								if (in_array($q['building_facility_id'], $roomFacilities)) {
									$html .= '<input class="form-check-input" id="building-inline-'.$key.'" type="checkbox" name="ids[]" value="'.$q['building_facility_id'].'" checked>';
								}
								else{
									$html .= '<input class="form-check-input" id="building-inline-'.$key.'" type="checkbox" name="ids[]" value="'.$q['building_facility_id'].'">';
								}
								$html .= '<label class="form-check-label" for="building-inline-'.$key.'">'.$q['name'].'</label>';
							$html .= '</div>';
						}
					$html .= '</div>';
              	$html .= '</div>';
				$html .= '<div class="col">';
					$html .= '<br><button type="submit" class="btn btn-success">Update</button>';
              	$html .= '</div>';
			$html .= '</form>';
			echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"no facility found, please add some."));
		}
	}
	public function save_room_facilities()
	{
		check_permissions('building_room_facilities_view');
		parse_str($_POST['data'],$post);
		$facilities = implode(',', $post['ids']);
		$resp = $this->db
		->where('room_id',$post['id'])
		->set('facilities',$facilities)
		->update('room');
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"updated successfully."));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not updated, please try again or reload your web page."));
		}
	}
}
