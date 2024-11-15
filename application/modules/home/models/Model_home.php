<?php
class Model_home extends CI_Model {

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
	public function get_opd_active_users($currentDayName)
	{
		return $this->get_results("
			SELECT urt.*, u.fname, u.lname, s.name AS serviceName, r.title AS roomTitle, r.room_number, f.title AS floorTitle, f.story AS floorStory
			FROM `user_room_time` AS urt
			INNER JOIN `user` AS u ON u.user_id = urt.user_id
			INNER JOIN `service` AS s ON s.service_id = urt.service_id
			INNER JOIN `room` AS r ON r.room_id = urt.room_id
			INNER JOIN `floor` AS f ON f.floor_id = r.floor_id
			WHERE (CURRENT_TIME() BETWEEN urt.time_from AND urt.time_to) AND urt.day_name = '$currentDayName' 
			AND urt.status = 'active'
			ORDER BY u.fname, u.lname ASC
		;");
	}
	public function patient_search_for_token_by_key($key)
	{
		$key = $this->db->escape_like_str($key);
		return $this->get_results("
			SELECT `patient_id`,`gender`,`mobile`,`fname`,`lname` 
			FROM `patient` 
			WHERE (`fname` LIKE '%$key%' OR `lname` LIKE '%$key%') OR (`mobile` LIKE '%$key%') 
			ORDER BY `fname`,`lname` ASC
		;");
	}
	public function get_patient_appointments($id)
	{
		return $this->get_results("
			SELECT tf.token_followup_id, urt.*, u.fname, u.lname, s.name AS serviceName, r.title AS roomTitle, r.room_number, f.title AS floorTitle, f.story AS floorStory
			FROM `token_followup` AS tf 
			INNER JOIN `token` AS t ON t.token_id = tf.token_id
			INNER JOIN `user_room_time` AS urt ON t.user_room_time_id = urt.user_room_time_id
			INNER JOIN `user` AS u ON u.user_id = urt.user_id
			INNER JOIN `service` AS s ON s.service_id = urt.service_id
			INNER JOIN `room` AS r ON r.room_id = urt.room_id
			INNER JOIN `floor` AS f ON f.floor_id = r.floor_id
			WHERE tf.patient_id = '$id' AND DATE(tf.followup_date) = CURDATE() 
			ORDER BY tf.followup_date ASC
		;");
	}
}