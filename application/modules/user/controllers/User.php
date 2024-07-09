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
}
