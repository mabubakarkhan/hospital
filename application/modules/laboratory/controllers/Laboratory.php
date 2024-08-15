<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratory extends MY_Controller {

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
		$this->cats();
	}
	public function cats()
	{
		check_permissions('lab_test_category_view');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'All Lab Test Categories';
		$data['page_title'] = 'All Lab Test Categories';
		$data['cats'] = $this->model->cats('all');
		load_view('cats',$data,true);
	}
	public function add_cat()
	{
		check_permissions('lab_test_category_add');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('lab_test_cat',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Lab test category added successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Lab test category not added, please try again."));
		}
	}
	public function update_cat()
	{
		check_permissions('lab_test_category_edit');
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$post['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('lab_test_cat_id',$id)
		->update('lab_test_cat',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Lab test category updated successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Lab test category not updated, please try again."));
		}
	}
	public function tests($catId = 0)
	{
		check_permissions('lab_test_category_view');
		$data['userLoginData'] = $this->userLoginData;
		if ($catId == 0) {
			$data['cat'] = false;
			$data['meta_title'] = 'All Lab Tests';
			$data['page_title'] = 'All Lab Tests';
		}
		else{
			$data['cat'] = $this->model->get_cat_byid($catId);
			$data['meta_title'] = $data['cat']['title'].' - Lab Tests';
			$data['page_title'] = $data['cat']['title'].' - Lab Tests';
		}
		$data['cats'] = $this->model->cats('all');
		$data['tests'] = $this->model->tests($catId,'all');
		load_view('tests',$data,true);
	}
	public function add_test()
	{
		check_permissions('lab_test_add');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('lab_test',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Lab test added successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Lab test not added, please try again."));
		}
	}
	public function update_test()
	{
		check_permissions('lab_test_edit');
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$post['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('lab_test_id',$id)
		->update('lab_test',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Lab test updated successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Lab test not updated, please try again."));
		}
	}
}
