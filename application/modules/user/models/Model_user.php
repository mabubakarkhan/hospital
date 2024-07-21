<?php
class Model_user extends CI_Model {

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
	public function users()
	{
		return $this->get_results("
			SELECT u.*, r.title AS roleTitle, r.room_allocation 
			FROM `user` AS u 
			LEFT JOIN `role` AS r ON u.role_id = r.role_id 
			ORDER BY u.fname,u.lname ASC
		;");
	}
	public function get_user_byid($id)
	{
		return $this->get_row("SELECT * FROM `user` WHERE `user_id` = '$id';");
	}
	public function get_roles($status = 'all')
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `role` ORDER BY `title` ASC;");
		}
		return $this->get_results("SELECT * FROM `role` WHERE `status` = '$status' ORDER BY `title` ASC;");
	}
	public function get_role_byid($id)
	{
		return $this->get_row("SELECT * FROM `role` WHERE `role_id` = '$id';");
	}
	public function get_user_rooms($userId)
	{
		return $this->get_results("
			SELECT ur.*, r.title AS roomTitle, r.room_number, f.title AS floorTitle, f.story, b.name AS buildingName 
			FROM `user_room` AS ur 
			LEFT JOIN `building` AS b ON ur.building_id = b.building_id 
			LEFT JOIN `floor` AS f ON ur.floor_id = f.floor_id 
			LEFT JOIN `room` AS r ON ur.room_id = r.room_id 
			WHERE ur.user_id = '$userId' AND ur.status = 'active' 
			ORDER BY r.room_number 
		;");
	}
	public function get_user_room_byid($id)
	{
		return $this->get_row("SELECT * FROM `user_room` WHERE `user_room_id` = '$id';");
	}
	public function get_buildings()
	{
		return $this->get_results("SELECT * FROM `building` WHERE `status` = 'active' ORDER BY `name` ASC;");
	}
	public function get_floors($buildingId)
	{
		return $this->get_results("SELECT * FROM `floor` WHERE `building_id` = '$buildingId' ORDER BY `story` ASC;");
	}
	public function get_rooms($floorId)
	{
		return $this->get_results("SELECT * FROM `room` WHERE `capacity` > `used` AND `floor_id` = '$floorId' ORDER BY `room_number` ASC;");
	}
}
