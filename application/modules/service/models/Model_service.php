<?php
class Model_service extends CI_Model {

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
	public function services()
	{
		return $this->get_results("SELECT * FROM `service` ORDER BY `name`;");
		
	}
	public function get_service_byid($id)
	{
		return $this->get_row("SELECT * FROM `service` WHERE `service_id` = '$id';");
	}
}
