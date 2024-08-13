<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller {

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
		check_permissions('service_view');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'All Services';
		$data['services'] = $this->model->services();
		load_view('index',$data,true);
	}
	public function add()
	{
		check_permissions('service_add');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('service',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Service added successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Service not added, please try again."));
		}
	}
	public function update()
	{
		check_permissions('patient_edit');
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$post['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('service_id',$id)
		->update('service',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Service updated successfully"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Service not updated, please try again."));
		}
	}
}
