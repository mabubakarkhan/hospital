<?php
class Model_prescription extends CI_Model {

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
	public function get_prescription_by_token_id($tokenId)
	{
		return $this->get_row("SELECT * FROM `prescription` WHERE `token_id` = '$tokenId';");
	}
	public function get_token_detail_byid($tokenId)
	{
		return $this->get_row("
			SELECT t.*, p.fname AS patientFname, p.lname AS patientLname, p.mobile AS patientMobile, p.age AS patientAge, p.gender AS patientGender, s.name AS serviceName 
			FROM `token` AS t 
			INNER JOIN `patient` AS p ON p.patient_id = t.patient_id 
			INNER JOIN `service` AS s ON s.service_id = t.service_id 
			WHERE t.token_id = '$tokenId' 
		;");
	}
	public function procedures($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `procedure` ORDER BY `name`;");
		}
		else{
			return $this->get_results("SELECT * FROM `procedure` WHERE `status` = '$status' ORDER BY `name`;");
		}
	}
	public function prescription_procedures($prescriptionId)
	{
		return $this->get_results("
			SELECT pp.*, p.name 
			FROM `prescription_procedure` AS pp 
			INNER JOIN `procedure` AS p ON p.procedure_id = pp.procedure_id 
			WHERE pp.prescription_id = '$prescriptionId' 
		;");
	}
	public function lab_test_active_cats()
	{
		return $this->get_results("SELECT * FROM `lab_test_cat` WHERE `status` = 'active' ORDER BY `title` ASC;");
	}
	public function lab_active_tests()
	{
		return $this->get_results("SELECT * FROM `lab_test` WHERE `status` = 'active' ORDER BY `title` ASC;");
	}
	public function get_prescription_lab_tests($prescriptionId)
	{
		return $this->get_row("SELECT GROUP_CONCAT(lab_test_id) AS ids FROM `prescription_lab_test` WHERE `prescription_id` = '$prescriptionId';");
	}
	public function get_prescription_drugs($prescriptionId)
	{
		return $this->get_results("SELECT * FROM `prescription_drug` WHERE `prescription_id` = '$prescriptionId' ORDER BY `name` ASC;");
	}
}
