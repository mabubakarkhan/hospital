<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drug extends MY_Controller {

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
		check_permissions('drug_view');
		$data['userLoginData'] = $this->userLoginData;
		$data['meta_title'] = 'Drugs';
		$data['drugs'] = $this->model->drugs('all');
		load_view('index',$data);
	}
	public function add()
	{
		check_permissions('drug_add');
		$userLoginData = $this->userLoginData;
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('drug',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Drug added successfully, will appear after page reload."));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Drug not added, please try again."));
		}
	}
	public function update()
	{
		check_permissions('drug_edit');
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$post['updated_at'] = date('Y-m-d H:i:s');
		$resp = $this->db
		->where('drug_id',$id)
		->update('drug',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Drug updated successfully, changes will appear after page reload."));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Drug not updated, please try again."));
		}
	}
	public function drug_search_by_key()
	{
		check_permissions('drug_view');
		$resp = $this->model->drug_search_by_key($_POST['key']);
		if ($resp) {
			$html = '';
			foreach ($resp as $key => $q) {
				$html .= '<a href="javascript://" class="selectDrugBtn" data-id="'.$q['drug_id'].'" data-name="'.$q['name'].'" data-generic_name="'.$q['generic_name'].'" data-type="'.$q['type'].'" data-strength="'.$q['strength'].'" data-strength_frequencey="'.$q['strength_frequencey'].'">'.$q['name'].' ('.$q['type'].')<br><small>'.$q['strength'].' '.$q['strength_frequencey'].'</small></a>';
			}
			$html .= '<hr><a href="javascript://" class="createDrugBtn" style="color: blue;">+ Add New Drug</a>';
		}
		else{
			$html = '<hr><a href="javascript://" class="createDrugBtn" style="color: blue;">+ Add New Drug</a>';
		}
		echo json_encode(array("status"=>true,"html"=>$html));
	}
}
