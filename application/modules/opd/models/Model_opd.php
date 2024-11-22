<?php
class Model_opd extends CI_Model {

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
	public function services($status = 'active')
	{
		return $this->get_results("SELECT * FROM `service` WHERE `status` = '$status' ORDER BY `name`;");
		
	}
	public function get_service_byid($id)
	{
		return $this->get_row("SELECT * FROM `service` WHERE `service_id` = '$id';");
	}
	public function get_opd_active_users()
	{
		return $this->get_results("
			SELECT urt.*, u.fname, u.lname, s.name AS serviceName, r.title AS roomTitle, r.room_number, f.title AS floorTitle, f.story AS floorStory 
			FROM `user_room_time` AS urt
			INNER JOIN `user` AS u ON u.user_id = urt.user_id
			INNER JOIN `service` AS s ON s.service_id = urt.service_id
			INNER JOIN `room` AS r ON r.room_id = urt.room_id
			INNER JOIN `floor` AS f ON f.floor_id = r.floor_id
			WHERE (CURRENT_TIME() BETWEEN urt.time_from AND urt.time_to)
			AND urt.status = 'active'
			ORDER BY u.fname, u.lname
		;");
	}
	public function get_current_tokens_by_user_id($userId,$type)
	{
		return $this->get_results("
			SELECT t.*, p.fname AS patientFname, p.lname AS patientLname, p.mobile AS patientMobile 
			FROM `token` AS t 
			INNER JOIN `patient` AS p ON p.patient_id = t.patient_id 
			WHERE t.user_id = '$userId' AND DATE(t.at) = CURDATE() AND t.type = '$type' 
			ORDER BY t.token_number ASC 
		;");
	}
	public function get_current_tokens($type)
	{
		return $this->get_results("
			SELECT t.token_id, t.token_number, t.type, t.status, s.name AS serviceName, r.title AS roomTitle, r.room_number, f.title AS floorTitle, f.story AS floorStory, p.fname AS patientFname, p.lname AS patientLname 
			FROM `token` AS t 
			INNER JOIN `user_room_time` AS urt ON urt.user_room_time_id = t.user_room_time_id 
			INNER JOIN `service` AS s ON s.service_id = urt.service_id
			INNER JOIN `room` AS r ON r.room_id = urt.room_id
			INNER JOIN `floor` AS f ON f.floor_id = r.floor_id
			INNER JOIN `patient` AS p ON p.patient_id = t.patient_id 
			WHERE DATE(t.at) = CURDATE() AND t.type = '$type' 
			ORDER BY t.token_number ASC 
		;");
	}
}
