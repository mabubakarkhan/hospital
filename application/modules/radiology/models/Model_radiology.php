<?php
class Model_radiology extends CI_Model {

	public function get_results($sql){
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0)
		{
			return $res->result_array();
		}
		else
		{
			return false;
		}
	}
	public function get_row($sql){
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0)
		{
			$resp = $res->result_array();
			return $resp[0];
		}
		else
		{
			return false;
		}
	}
	public function radiology_tests($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `radiology_test` ORDER BY `title`;");
		}
		else{
			return $this->get_results("SELECT * FROM `radiology_test` WHERE `status` = '$status' ORDER BY `title`;");
		}
	}
	public function get_radiology_test_byid($id)
	{
		return $this->get_row("SELECT * FROM `radiology_test` WHERE `radiology_test_id` = '$id';");
	}
}
