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
		return $this->get_results("
			SELECT s.*, d.name AS departmentName, d.status AS departmentStatus 
			FROM `service` AS s 
			INNER JOIN `department` AS d ON s.department_id = d.department_id 
			ORDER BY s.name
		;");
		
	}
	public function get_service_byid($id)
	{
		return $this->get_row("SELECT * FROM `service` WHERE `service_id` = '$id';");
	}
	public function departments()
	{
		return $this->get_results("SELECT `department_id`,`name`,`status` FROM `department` ORDER BY `name`;");
	}
}
