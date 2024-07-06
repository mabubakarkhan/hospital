<?php
class Model_login extends CI_Model {

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
	public function login($username,$password)
	{
		$resp = $this->get_row("SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password';");
		if ($resp) {
			if ($resp['type_zero'] != '1') {
				$roleId = $resp['role_id'];
				$permissions = $this->get_row("SELECT `permissions` FROM `role` WHERE `role_id` = '$roleId';");
				$resp['permissions'] = explode(',', $permissions['permissions']);
			}
			else{
				$resp['permissions'] = 'all';
			}
			return $resp;
		}
		else{
			return false;
		}
	}
}