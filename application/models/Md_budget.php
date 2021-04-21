<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_budget extends CI_Model {
		
	protected $tableLib = "t_lignes_budgetaires_lib";
	protected $tableBun = "t_budget_unite_bun";
	protected $tableHib = "t_historique_budgetaire_hib";
	protected $tableUni = "t_unite_uni";
	
	public function insert_lignes_budget($data){
		$this->db->insert($this->tableLib,$data);
		return $this->db->order_by("lib_id","desc")->get($this->tableLib)->row();
	} 
		
	public function lignes_budget_actives(){
		return $this->db->where("lib_iSta",1)->get($this->tableLib)->result();
	} 
		
	public function lignes_budget_unite($lib){
		return $this->db->join($this->tableUni, $this->tableUni.".uni_id=".$this->tableBun.".uni_id","inner")
		->where($this->tableBun.".lib_id",$lib)->get($this->tableBun)->result();
	} 
	
	public function verif_budget_unite($uni,$lib){
		return $this->db
			->where("lib_id",$lib)
			->where("uni_id",$uni)
			->get($this->tableBun)
			->row();
	} 

	public function verif_ligne_budget($lib){
		return $this->db
			->where("lib_sLibelle",$lib)
			->get($this->tableLib)
			->row();
	} 

	public function insert_historique($data){
		return $this->db->insert($this->tableHib,$data);
	}
	
	public function insert_unite_budgetaire($data){
		return $this->db->insert($this->tableBun,$data);
	}
}
