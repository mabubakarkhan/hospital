<?php
class Model_drug extends CI_Model {

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
	public function drugs($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `drug` ORDER BY `name`;");
		}
		else{
			return $this->get_results("SELECT * FROM `drug` WHERE `status` = '$status' ORDER BY `name`;");
		}
	}
	public function get_drug_byid($id)
	{
		return $this->get_row("SELECT * FROM `drug` WHERE `drug_id` = '$id';");
	}
	public function drug_search_by_key($key)
	{
		$key = $this->db->escape_like_str($key);
		return $this->get_results("
			SELECT * 
			FROM `drug` 
			WHERE (`name` LIKE '%$key%' OR `generic_name` LIKE '%$key%') AND `status` = 'active' 
			ORDER BY `name`,`generic_name` ASC
		;");
	}
}
