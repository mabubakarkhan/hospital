<?php
class Model_procedure extends CI_Model {

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
	public function procedures($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `procedure` ORDER BY `name`;");
		}
		else{
			return $this->get_results("SELECT * FROM `procedure` WHERE `status` = '$status' ORDER BY `name`;");
		}
	}
	public function get_procedure_byid($id)
	{
		return $this->get_row("SELECT * FROM `procedure` WHERE `procedure_id` = '$id';");
	}
}
