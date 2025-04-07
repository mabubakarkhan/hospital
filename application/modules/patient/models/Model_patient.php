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
		    $where = "AND t.user_id = '".$user."'";
		}
		$resp['token'] = $this->get_results("
		    SELECT t.token_id AS id, t.at, t.status, t.type, s.name AS service, u.fname, u.lname 
		    FROM `token` AS t 
		    INNER JOIN `service` AS s ON t.service_id = s.service_id 
		    INNER JOIN `user` AS u ON t.user_id = u.user_id 
		    WHERE t.patient_id = '$patient' $where
		");
		$where = '';
		if ($type == 'own') {
		    $where = "AND ea.discharge_by = '".$user."'";
		}

		$resp['emergency'] = $this->get_results("
		    SELECT ea.emergency_admit_id AS id, ea.at, ea.status, u.fname, u.lname, s.name AS service, 'emergency' AS type
		    FROM `emergency_admit` AS ea 
		    LEFT JOIN `user` AS u ON ea.discharge_by = u.user_id 
		    INNER JOIN `service` AS s ON ea.service_id = s.service_id 
		    WHERE ea.patient_id = '$patient' $where
		");
		if ($resp['token'] == false) {
			return $resp['emergency'];
		}
		else if ($resp['emergency'] == false) {
			return $resp['token'];
		}
		else{
			$mergedResults = array_merge($resp['token'], $resp['emergency']);
			usort($mergedResults, function($a, $b) {
			    return strtotime($b['at']) - strtotime($a['at']);
			});
			return $mergedResults;
		}
	}
}
