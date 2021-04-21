<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_chirurgie extends CI_Model {
		
	protected $tablePop = "t_planning_operation_pop";
	protected $tableEte = "t_equipe_technique_ete";
	
	public function verif_planning_operation($a,$b,$c,$d)
	{
		return $this->db
		->where("lac_id",$a)
		->where("pat_id",$b)
		->where("pop_dDate",$c)
		->where("pop_tHeureDebut",$d)
		->get($this->tablePop)
		->row();
	}
	
	public function insert_operation($data)
	{
		$this->db->insert($this->tablePop,$data);
		return $this->db->order_by("pop_id", "desc")->get($this->tablePop)->row();
	}
	
	public function insert_equipe($data)
	{
		$this->db->insert($this->tableEte,$data);
	}
	
	
	public function verif_equipier($per,$pop){
		return $this->db
			->where("per_id",$per)
			->where("pop_id",$pop)
			->get($this->tableEte)
			->row();
	} 
	
}
?>