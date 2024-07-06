<?php
class Model_role extends CI_Model {

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
	public function roles()
	{
		return $this->get_results("SELECT * FROM `role` ORDER BY `title` ASC;");
	}
	public function get_roles($status)
	{
		return $this->get_results("SELECT * FROM `role` WHERE `status` = '$status' ORDER BY `title` ASC;");
	}
	public function get_role_byid($id)
	{
		return $this->get_row("SELECT * FROM `role` WHERE `role_id` = '$id';");
	}
}
