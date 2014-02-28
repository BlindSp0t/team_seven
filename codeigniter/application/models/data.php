<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Model
{
	// insert game
	public function insert_game($id,$away_t_id,$home_t_id,$timestamp,$period1,$period2)
	{
		$sql = "INSERT IGNORE INTO `game` (`game_id`,`timestamp`,`period_1_start`,`period_2_start`,`home_team`,`away_team`)
				VALUES(?,?,?,?,?,?);";
		
		$data = array($id,$timestamp,$period1,$period2,$home_t_id,$away_t_id);
		
		$query = $this->db->query($sql, $data);
		
		return true;
	}


	// insert team
	public function insert_team($id,$name)
	{
		$sql = "INSERT IGNORE INTO `team` (`team_id`,`name`)
				VALUES(?,?);";
		
		$data = array($id,$name);
		
		$query = $this->db->query($sql, $data);
		
		return true;
	}

	// insert event types
	public function insert_event_type($id,$lib)
	{
		$sql = "INSERT IGNORE INTO `event_type` (`event_type_id`,`label`)
				VALUES(?,?);";
		
		$data = array($id,$lib);
		
		$query = $this->db->query($sql, $data);
		
		return true;
	}

	// insert event
	public function insert_event($id,$timestamp,$min,$sec,$x,$y,$player_id,$team_id,$game_id,$event_type)
	{
		$sql = "INSERT IGNORE INTO `event` (`event_id`,`timestamp`,`min`,`sec`,`coord_x`,`coord_y`,`player_id`,`team_id`,`game_id`,`event_type_id`)
				VALUES(?,?,?,?,?,?,?,?,?,?);";
		
		$data = array($id,$timestamp,$min,$sec,$x,$y,$player_id,$team_id,$game_id,$event_type);
		
		$query = $this->db->query($sql, $data);
		
		return true;
	}
	
}
/* End of file data.php */
/* Location: ./application/models/data.php */