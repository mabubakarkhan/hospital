<?php
class Model_laboratory extends CI_Model {

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
	public function cats($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `lab_test_cat` ORDER BY `title` ASC;");
		}
		else{
			return $this->get_results("SELECT * FROM `lab_test_cat` WHERE `status` = '$status' ORDER BY `title` ASC;");
		}
	}
	public function get_cat_byid($catId)
	{
		return $this->get_row("SELECT * FROM `lab_test_cat` WHERE `lab_test_cat_id` = '$catId';");
	}
	public function tests($catId,$status = 'all')
	{
		if ($catId == 0) {
			if ($status == 'all') {
				$where = '';
			}
			else{
				$where = "WHERE t.status = '".$status."'";
			}
		}
		else{
			if ($status == 'all') {
				$where = "WHERE t.lab_test_cat_id='".$catId."'";
			}
			else{
				$where = "WHERE t.status = '".$status."' AND t.lab_test_cat_id='".$catId."'";
			}
		}
		return $this->get_results("
			SELECT t.*, c.title AS catTitle 
			FROM `lab_test` AS t 
			INNER JOIN `lab_test_cat` AS c ON c.lab_test_cat_id = t.lab_test_cat_id 
			$where 
			ORDER BY t.title ASC 
		;");
	}
}
