<?php
class Model_department extends CI_Model {

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
	public function departments()
	{
		return $this->get_results("SELECT * FROM `department` ORDER BY `name`;");
		
	}
	public function get_department_byid($id)
	{
		return $this->get_row("SELECT * FROM `department` WHERE `department_id` = '$id';");
	}
}
