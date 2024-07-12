<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {

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
		check_permissions('role');
		$data['meta_title'] = 'All Roles';
		$data['roles'] = $this->model->roles();
		load_view('index',$data);
	}
	public function create()
	{
		check_permissions('role_add');
		$data['meta_title'] = 'Create Role';
		$data['page_title'] = 'Create New Role';
		$data['mode'] = 'add';
		load_view('create',$data,true);
	}
	public function post()
	{
		check_permissions('role_add');
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('role',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"role created successfully."));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"role not created, please try again."));
		}
	}
	public function edit()
	{
		check_permissions('role_edit');
		$data['meta_title'] = 'Edit Role';
		$data['page_title'] = 'Edit Role';
		$data['mode'] = 'edit';
		$data['editID'] = $_GET['id'];
		$data['q'] = $this->model->get_role_byid($_GET['id']);
		load_view('create',$data,'edit');
	}
	public function update()
	{
		check_permissions('role_edit');
		parse_str($_POST['data'],$post);
		$_POST['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('role_id',$post['id'])
		->set('title',$post['title'])
		->update('role');
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"role updated successfully."));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"role not updated, please try again."));
		}
	}
	public function permissions()
	{
		check_permissions('role_permissions');
		$data['editID'] = $_GET['id'];
		$data['meta_title'] = 'Update Permissions';
		$data['q'] = $this->model->get_role_byid($_GET['id']);
		$data['page_title'] = $data['q']['title']." - Permissions";
		if (!(empty($data['q']['permissions']))) {
			$data['permissionsArr'] = explode(',', $data['q']['permissions']);
		}
		else{
			$data['permissionsArr'] = false;
		}
		$data['room_allocation'] = $data['q']['room_allocation'];
		load_view('permissions',$data,'permissions');
	}
	public function update_permissions()
	{
		check_permissions('role_permissions');
		parse_str($_POST['data'],$post);
		$permissions = implode(',', $post['title']);
		if (isset($post['room_allocation']) && $post['room_allocation'] == '1') {
			$room_allocation = 1;
		}
		else{
			$room_allocation = 0;
		}
		$resp = $this->db
		->where('role_id',$post['id'])
		->set('permissions',$permissions)
		->set('room_allocation',$room_allocation)
		->set('updated_at',date('Y-m-d H:i:s'))
		->update('role');
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"permissions updated successfully."));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"permissions not updated, please try again."));
		}
	}
}
