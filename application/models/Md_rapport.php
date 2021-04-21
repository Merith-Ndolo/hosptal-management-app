<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_rapport extends CI_Model {
		
	protected $tablePer = "t_personnel_per";
	protected $tableLog = "t_logs_log";
	
	
	public function notifications()
	{
		return $this->db
		->join($this->tablePer, $this->tablePer.".per_id=".$this->tableLog.".per_id", "left	")
		->limit(7)
		->order_by("log_dDate","desc")
		->get($this->tableLog)->result();
	}
	
	public function listNotifications()
	{
		return $this->db
		->join($this->tablePer, $this->tablePer.".per_id=".$this->tableLog.".per_id", "left	")
		->order_by("log_dDate","desc")
		->get($this->tableLog)->result();
	}
	
	
	public function nbNotifications()
	{
		return $this->db->where("log_iSta",0)->get($this->tableLog)->result();
	}
	
	public function updateRapport($donnees){
		return $this->db->update($this->tableLog,$donnees);
	}
}
