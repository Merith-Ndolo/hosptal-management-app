<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_connexion extends CI_Model {
		
	protected $tablePer = "t_personnel_per";
	protected $tableLog = "t_logs_log";
	protected $tableDep = "t_departement_dep";
	protected $tableFct = "t_fonctions_fct";
	protected $tablePst = "t_postes_pst";
	protected $tableSpt = "t_specialites_spt";
	
	public function se_connecter_email($login,$pwd)
	{
		return $this->db->where("per_sEmail",$login)->where("per_sPwd",$pwd)->where("per_iSta",1)->get($this->tablePer)->row();
	}
	
	public function se_connecter_tel($tel,$pwd)
	{
		return $this->db->where("per_sTel",$tel)->where("per_sPwd",$pwd)->where("per_iSta",1)->get($this->tablePer)->row();
	}
	
	
	public function mdp_oublie($email)
	{
		return $this->db->where("usr_sEmail",$email)->get($this->tableUser)->row();
	}
	
	public function personnel_connect()
	{
		return $this->db
		->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
		->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
		->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
		->where("per_id",$this->session->medicalis)->get($this->tablePer)->row();
	}
	
		
	public function rapport($log)
	{
		return $this->db->insert($this->tableLog,$log);
	}

}
