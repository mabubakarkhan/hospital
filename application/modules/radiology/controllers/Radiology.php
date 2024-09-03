<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Radiology extends MY_Controller {

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
		check_permissions('radiology_test_view');
		$this->tests();
	}
	public function tests()
	{
		check_permissions('radiology_test_view');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'Radiology Test';
		$data['radiology_tests'] = $this->model->radiology_tests('all');
		load_view('index',$data,true);
	}
	public function add_test()
	{
		check_permissions('radiology_test_add');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('radiology_test',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Radiology Test added successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Radiology Test not added, please try again."));
		}
	}
	public function update_test()
	{
		check_permissions('radiology_test_edit');
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$post['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('radiology_test_id',$id)
		->update('radiology_test',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Radiology Test updated successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Radiology Test not updated, please try again."));
		}
	}
}
