<?php
class Model_emergency extends CI_Model {

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
	public function setting()
	{
		return $this->get_row("SELECT * FROM `emergency_setting` WHERE `emergency_setting_id` = 1;");
	}
	public function emergency_services()
	{
		return $this->get_results("
			SELECT DISTINCT(us.service_id) AS service_id, s.name 
			FROM `user_service` AS us 
			INNER JOIN `service` AS s ON us.service_id = s.service_id 
			ORDER BY s.name ASC;
		");
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
	public function users_services()
	{
		return $this->get_results("
			SELECT DISTINCT us.*, u.fname, u.lname, r.title AS roleTitle 
			FROM `user_service` AS us 
			INNER JOIN `user` AS u ON us.user_id = u.user_id 
			INNER JOIN `role` AS r ON u.role_id = r.role_id 
			WHERE u.emergency_service = 'yes' 
			ORDER BY u.fname, u.lname ASC
		");
	}
	public function time_table()
	{
		return $this->get_results("SELECT * FROM `emergency_time_table`;");
	}
	public function emergency_patients()
	{
		return $this->get_results("
			SELECT ea.*, p.fname, p.lname, p.mobile, s.name AS serviceTitle 
			FROM `emergency_admit` AS ea 
			INNER JOIN `patient` AS p ON ea.patient_id = p.patient_id 
			INNER JOIN `service` AS s ON ea.service_id = s.service_id 
			WHERE (ea.at >= NOW() - INTERVAL 1 DAY) AND ea.status = 'admit' 
			ORDER BY ea.at ASC
		;");
	}
	public function get_emergency_admit_detailed_byid($emergency_admit_id)
	{
		$resp = $this->get_row("SELECT * FROM `emergency_admit` WHERE `emergency_admit_id` = '$emergency_admit_id';");	
		$resp['patient'] = $this->get_row("SELECT * FROM `patient` WHERE `patient_id` = '".$resp['patient_id']."';");
		$resp['service'] = $this->get_row("SELECT * FROM `service` WHERE `service_id` = '".$resp['service_id']."';");
	}
	public function drugs($status = 'active')
	{
		return $this->get_results("SELECT * FROM `drug` WHERE `status` = '$status' ORDER BY `name`;");
	}
}
