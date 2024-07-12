<?php
class Model_facility extends CI_Model {

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
	public function facilities()
	{
		return $this->get_results("SELECT * FROM `building_facility` ORDER BY `name` ASC;");;
	}
	public function get_facility_byid($id)
	{
		return $this->get_row("SELECT * FROM `building_facility` WHERE `building_facility_id` = '$id';");
	}
}
