<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

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
		check_permissions('user');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'All Users';
		$data['users'] = $this->model->users();
		load_view('index',$data);
	}
	public function create()
	{
		check_permissions('user_add');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'Create New User';
		$data['page_title'] = 'Create New User';
		$data['mode'] = 'add';
		$data['roles'] = $this->model->get_roles('active');
		load_view('create',$data);
	}
	public function post()
	{
		check_permissions('user_add');
		$_POST['password_text'] = $_POST['password'];
		$_POST['password'] = md5($_POST['password']);

		$this->form_validation->set_rules('fname', 'First name', 'required');
		$this->form_validation->set_rules('lname', 'Last name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('phone', 'Phone', 'required');
	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

	    if ($this->form_validation->run() == FALSE) {
	        redirect('user/create');
	    }

		$checkUserId = $this->db
		->select('user_id')
		->where('username',$_POST['username'])
		->or_where('phone',$_POST['phone'])
		->or_where('email',$_POST['email'])
		->get('user')
		->row()
		->user_id;
		if ($checkUserId !== null) {
			$this->session->set_flashdata('error', 'Error: username/phone/email already in use');
			redirect('user/create');
		}
		if (isset($_FILES["img"]['name']) && !(empty($_FILES["img"]['name']))){
			$config['upload_path'] = 'uploads/user';
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
		else{
			$this->session->set_flashdata('error', 'Error: Profile pic missing');
			redirect('user/create');
		}
		if (isset($_FILES["cv"]['name']) && !(empty($_FILES["cv"]['name']))){
			$config['upload_path'] = 'uploads/user';
        	$config['allowed_types'] = 'pdf|PDF';
        	$config['encrypt_name'] = TRUE;
        	$ext = pathinfo($_FILES["cv"]['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES["cv"]['name']).'.'.$ext;
			$config['file_name'] = $new_name;
        	$resp = $this->load->library('upload', $config);
        	if ($resp) {
	        	$this->upload->do_upload('cv');
				$_POST['cv'] = $this->upload->data()['file_name'];
        	}
        	else{
				$this->session->set_flashdata('error', 'Error: CV must be a PDF file.');
				redirect('user/create');
        	}
		}
		$resp = $this->db->insert('user',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: user created successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: user not created, please try again.');
		}
        redirect('user/create');
	}
	public function edit()
	{
		check_permissions('user_edit');
		$data['userLoginData'] = $this->userLoginData;
		$data['page_title'] = 'Edit User';
		$data['mode'] = 'edit';
		$data['editID'] = $_GET['id'];
		$data['q'] = $this->model->get_user_byid($_GET['id']);
		$data['roles'] = $this->model->get_roles('active');
		load_view('create',$data);
	}
	public function update()
	{
		check_permissions('user_edit');
		$userId = $_POST['id'];unset($_POST['id']);
		$_POST['password_text'] = $_POST['password'];
		$_POST['password'] = md5($_POST['password']);
		$_POST['updated_at'] = date('Y-m-d H:i:s');

		$this->form_validation->set_rules('fname', 'First name', 'required');
		$this->form_validation->set_rules('lname', 'Last name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('phone', 'Phone', 'required');
	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

	    if ($this->form_validation->run() == FALSE) {
	        redirect('user/edit?id='.$userId);
	    }

		$checkUserId = $this->db
	    ->select('user_id')
	    ->where('user_id !=', $userId)
	    ->group_start()
	        ->where('username', $_POST['username'])
	        ->or_where('phone', $_POST['phone'])
	        ->or_where('email', $_POST['email'])
	    ->group_end()
	    ->get('user')
	    ->row()
	    ->user_id;
		if ($checkUserId !== null) {
			$this->session->set_flashdata('error', 'Error: username/phone/email already in use');
			redirect('user/edit?id='.$userId);
		}
		if (isset($_FILES["img"]['name']) && !(empty($_FILES["img"]['name']))){
			$config['upload_path'] = 'uploads/user';
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
				redirect('user/edit?id='.$userId);
        	}
		}
		if (isset($_FILES["cv"]['name']) && !(empty($_FILES["cv"]['name']))){
			$config['upload_path'] = 'uploads/user';
        	$config['allowed_types'] = 'pdf|PDF';
        	$config['encrypt_name'] = TRUE;
        	$ext = pathinfo($_FILES["cv"]['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES["cv"]['name']).'.'.$ext;
			$config['file_name'] = $new_name;
        	$resp = $this->load->library('upload', $config);
        	if ($resp) {
	        	$this->upload->do_upload('cv');
				$_POST['cv'] = $this->upload->data()['file_name'];
        	}
        	else{
				$this->session->set_flashdata('error', 'Error: CV must be a PDF file.');
				redirect('user/edit?id='.$userId);
        	}
		}
		$resp = $this->db
		->where('user_id',$userId)
		->update('user',$_POST);
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: user updated successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: user not updated, please try again.');
		}
        redirect('user/edit?id='.$userId);
	}
	public function room($userId)
	{
		check_permissions('assign_room_view');
		$data['userLoginData'] = $this->userLoginData;
		$data['user'] = $this->model->get_user_byid($userId);
		$data['role'] = $this->model->get_role_byid($data['user']['role_id']);
		$data['rooms'] = $this->model->get_user_rooms($userId);
		$data['buildings'] = $this->model->get_buildings();
		$data['meta_title'] = $data['user']['fname'].' '.$data['user']['lname'].' - rooms';
		load_view('room',$data,true);
	}
	public function get_floors()
	{
		check_permissions('assign_room_assign');
		$floors = $this->model->get_floors($_POST['id']);
		if ($floors) {
			$html = '<option value="">Select Floor</option>';
			foreach ($floors as $key => $q) {
				$html .= '<option value="'.$q['floor_id'].'">'.$q['title'].' (story - '.$q['story'].') '.'</option>';
			}
			echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"no floor found"));
		}
	}
	public function get_rooms()
	{
		check_permissions('assign_room_assign');
		$rooms = $this->model->get_rooms($_POST['id']);
		if ($rooms) {
			$html = '<option value="">Select Room</option>';
			foreach ($rooms as $key => $q) {
				$html .= '<option value="'.$q['room_id'].'">'.$q['title'].' ('.$q['room_number'].') '.'</option>';
			}
			echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"no room found"));
		}
	}
	public function post_user_room()
	{
		check_permissions('assign_room_assign');
		$data['userLoginData'] = $this->userLoginData;
		$_POST['adder_id'] = $data['userLoginData']['user_id'];
		$resp = $this->db->insert('user_room',$_POST);
		if ($resp) {
			$this->db
			->set('used', "used+1", FALSE)
			->where('room_id', $_POST['room_id'])
			->update('room');
			$this->session->set_flashdata('success', 'Success: room assigned successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: room not assigned, please try again.');
		}
		redirect('user/room/'.$_POST['user_id']);
	}
	public function edit_user_room()
	{
		check_permissions('assign_room_change');
		$data['userLoginData'] = $this->userLoginData;
		$userRoomId = $_GET['id'];
		$data['room'] = $this->model->get_user_room_byid($userRoomId);
		$data['user'] = $this->model->get_user_byid($data['room']['user_id']);
		$data['role'] = $this->model->get_role_byid($data['user']['role_id']);
		$data['buildings'] = $this->model->get_buildings();
		$data['floors'] = $this->model->get_floors($data['room']['building_id']);
		$data['rooms'] = $this->model->get_rooms($data['room']['floor_id']);
		$data['meta_title'] = 'Change Room For - '.$data['user']['fname'].' '.$data['user']['lname'];
		load_view('edit_user_room',$data,true);
	}
	public function update_user_room()
	{
		check_permissions('assign_room_change');
		$data['userLoginData'] = $this->userLoginData;
		$oldUserRoomId = $_POST['id'];unset($_POST['id']);
		$_POST['adder_id'] = $data['userLoginData']['user_id'];
		$oldRoom = $this->model->get_user_room_byid($oldUserRoomId);
		if ($oldRoom['room_id'] == $_POST['room_id']) {
			$this->session->set_flashdata('success', 'Success: room changed successfully.');
		}
		else{
			$resp = $this->db->insert('user_room',$_POST);
			if ($resp) {
				
				$this->db
				->set('status', "inactive")
				->where('user_room_id', $oldRoom['user_room_id'])
				->update('user_room');

				$this->db
				->set('used', "used-1", FALSE)
				->where('room_id', $oldRoom['room_id'])
				->update('room');

				$this->db
				->set('used', "used+1", FALSE)
				->where('room_id', $_POST['room_id'])
				->update('room');

				$this->session->set_flashdata('success', 'Success: room changed successfully.');
			}
			else{
				$this->session->set_flashdata('error', 'Error: room not changed, please try again.');
			}
		}
		redirect('user/room/'.$_POST['user_id']);
	}
	public function remove_user_room()
	{
		check_permissions('assign_room_remove');
		$data['userLoginData'] = $this->userLoginData;
		$oldRoom = $this->model->get_user_room_byid($_GET['id']);
				
		$this->db
		->set('status', "inactive")
		->where('user_room_id', $oldRoom['user_room_id'])
		->update('user_room');

		$this->db
		->set('used', "used-1", FALSE)
		->where('room_id', $oldRoom['room_id'])
		->update('room');

		$this->session->set_flashdata('success', 'Success: room removed successfully.');
		
		redirect('user/room/'.$oldRoom['user_id']);
	}
	public function user_room_time_table()
	{
		check_permissions('room_time_table_view');
		$data['userLoginData'] = $this->userLoginData;
		$userRoomId = $_GET['id'];
		$data['user_room'] = $this->model->get_user_room_byid($userRoomId);
		$data['user'] = $this->model->get_user_byid($data['user_room']['user_id']);
		$data['role'] = $this->model->get_role_byid($data['user']['role_id']);
		$data['room'] = $this->model->get_room_byid($data['user_room']['room_id']);
		$data['page_title'] = 'Time Table <br> Room: '.$data['room']['title'].'('.$data['room']['room_number'].') <br> Role: '.$data['role']['title'].' <br> User: '.$data['user']['fname'].' '.$data['user']['lname'];
		$data['meta_title'] = 'Time Table <br> Room: '.$data['room']['title'].'('.$data['room']['room_number'].') <br> Role: '.$data['role']['title'].' <br> User: '.$data['user']['fname'].' '.$data['user']['lname'];
		$data['slots'] = $this->model->get_user_time_table_by_user_room_id($userRoomId);
		load_view('user_room_time_table',$data,true);
	}
	public function post_user_room_time_table()
	{
		check_permissions('room_time_table_add');
		$data['userLoginData'] = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$resp = $this->db
	    ->where('user_room_id', $post['user_room_id'])
	    ->where('user_id', $post['user_id'])
	    ->where('room_id', $post['room_id'])
	    ->where('day_number', $post['day_number'])
	    ->where('status', 'active')
	    ->where("(
	        (time_from <= '{$post['time_from']}' AND time_to > '{$post['time_from']}') OR
	        (time_from < '{$post['time_to']}' AND time_to >= '{$post['time_to']}') OR
	        (time_from >= '{$post['time_from']}' AND time_to <= '{$post['time_to']}') OR
	        (time_from <= '{$post['time_from']}' AND time_to >= '{$post['time_to']}')
	    )")
	    ->get('user_room_time');
		if ($resp->num_rows() > 0) {
            echo json_encode(array("status"=>false,"msg"=>"Time conflict detected. Entry not added."));
        }
        else {
        	$post['day_name'] = day_name($post['day_number']);
            $this->db->insert('user_room_time',$post);
            echo json_encode(array("status"=>true,"msg"=>"Time slot saved successfully, will show in list after refresh this page."));
        }
	}
	public function remove_user_room_time_table()
	{
		ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
		check_permissions('room_time_table_remove');
		$data['userLoginData'] = $this->userLoginData;
		$resp = $this->db->where('user_room_time_id',$_GET['id'])->delete('user_room_time');
		if ($resp) {
			$this->session->set_flashdata('success', 'Success: time slot deleted successfully.');
		}
		else{
			$this->session->set_flashdata('error', 'Error: time slot not deleted, please try again.');
		}
		redirect_back();
	}
}
