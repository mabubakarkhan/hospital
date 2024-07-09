<?php
class Model_building extends CI_Model {

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
	public function floors()
	{
		return $this->get_results("SELECT * FROM `floor` ORDER BY `story` ASC;");
	}
	public function get_floor_byid($id)
	{
		return $this->get_row("SELECT * FROM `floor` WHERE `floor_id` = '$id';");
	}
	public function rooms($floor_id)
	{
		if ($floor_id > 0) {
			return $this->get_results("
				SELECT r.*, f.title AS floorTitle 
				FROM `room` AS r 
				INNER JOIN `floor` AS f ON r.floor_id = f.floor_id 
				WHERE r.floor_id = '$floor_id' 
				ORDER BY r.room_number ASC
			;");
		}
		else{
			return $this->get_results("
				SELECT r.*, f.title AS floorTitle 
				FROM `room` AS r 
				INNER JOIN `floor` AS f ON r.floor_id = f.floor_id 
				ORDER BY r.room_number ASC
			;");
		}
	}
	public function get_room_byid($id)
	{
		return $this->get_row("SELECT * FROM `room` WHERE `room_id` = '$id';");
	}
}
