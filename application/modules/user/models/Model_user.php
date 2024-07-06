<?php
class Model_user extends CI_Model {

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
	public function users()
	{
		return $this->get_results("
			SELECT u.*, r.title AS roleTitle 
			FROM `user` AS u 
			LEFT JOIN `role` AS r ON u.role_id = r.role_id 
			ORDER BY u.fname,u.lname ASC
		;");
	}
	public function get_user_byid($id)
	{
		return $this->get_row("SELECT * FROM `user` WHERE `user_id` = '$id';");
	}
	public function get_roles($status = 'all')
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `role` ORDER BY `title` ASC;");
		}
		return $this->get_results("SELECT * FROM `role` WHERE `status` = '$status' ORDER BY `title` ASC;");
	}
}
