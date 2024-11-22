<?php
class Model_patient extends CI_Model {

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
	public function patients()
	{
		return $this->get_results("SELECT * FROM `patient` ORDER BY `fname`,`lname`,`mobile`;");
		
	}
	public function get_patient_byid($id)
	{
		return $this->get_row("SELECT * FROM `patient` WHERE `patient_id` = '$id';");
	}
	public function get_prescription_history($type,$patient,$user)
	{
		$where = '';
		if ($type == 'own') {
			$where  = "AND t.user_id = '".$user."'";
		}
		return $this->get_results("
			SELECT t.token_id,t.at,t.status,t.type,s.name AS service, u.fname, u.lname 
			FROM `token` AS t 
			INNER JOIN `service` AS s ON t.service_id = s.service_id 
			INNER JOIN `user` AS u ON t.user_id = u.user_id 
			WHERE t.patient_id = '$patient' $where 
			ORDER BY t.at DESC
		;");
	}
}
