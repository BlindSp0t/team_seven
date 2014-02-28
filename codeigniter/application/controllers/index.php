<?php

class Index extends CI_Controller
{
	private $default_title;
	
	public function __construct()
	{
		//	Obligatory
		parent::__construct();
		
		//	This code will be executed each time this controller will be called
		$this->default_title = 'Team Seven';
		
	}
	
	public function index()
	{
		$this->accueil();
	}
		
	public function accueil()
	{
		$this->load->view('theme/header');
		$this->load->view('main');
		$this->load->view('theme/footer');
	}

	public function insertData()
	{
		$this->load->model('data','dMdl');

		$arr = json_decode(json_encode((array)simplexml_load_file("./assets/xml/testopta.xml")),1);
		$game_id = $arr['Game']['@attributes']['id'];
		$timestamp = $arr['Game']['@attributes']['game_date'];
		$period1 = $arr['Game']['@attributes']['period_1_start'];
		$period2 = $arr['Game']['@attributes']['period_2_start']; 
		$away_t_id = $arr['Game']['@attributes']['away_team_id'];
		$away_t_name = $arr['Game']['@attributes']['away_team_name'];
		$home_t_id = $arr['Game']['@attributes']['home_team_id'];
		$home_t_name = $arr['Game']['@attributes']['home_team_name'];
		

		// insert team
		$this->dMdl->insert_team($away_t_id,$away_t_name);
		$this->dMdl->insert_team($home_t_id,$home_t_name);

		// insert game
		$this->dMdl->insert_game($game_id,$away_t_id,$home_t_id,$timestamp,$period1,$period2);

		
		foreach($arr['Game']['Event'] as $id=>$event)
		{
			$id = $event['@attributes']['id'];
			$timestamp = $event['@attributes']['timestamp'];
			$min = $event['@attributes']['min'];
			$sec = $event['@attributes']['sec'];
			$x = $event['@attributes']['x'];
			$y = $event['@attributes']['y'];
			$player_id = 0;
			$team_id = $event['@attributes']['team_id'];
			$event_type = $event['@attributes']['type_id'];
			$this->dMdl->insert_event_type($event_type,"nolabel");
			$this->dMdl->insert_event($id,$timestamp,$min,$sec,$x,$y,$player_id,$team_id,$game_id,$event_type);
		}
		$this->finished();
	}

	public function finished()
	{
		$this->load->view('theme/header');
		$this->load->view('success');
		$this->load->view('theme/footer');
	}

	public function pageNotFound()
	{
		$this->output->set_status_header('404');
		$this->load->view('theme/header');
		$data['error'] = "404. Page not found.";
		$this->load->view('theme/error',$data);
		$this->load->view('theme/footer');
	}
}