<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_laboratoire extends CI_Model {
		
	protected $tableEac = "t_entree_accessoire_eac";
	protected $tableAcc = "t_accessoire_acc";
	protected $tableSac = "t_stock_accessoire_sac";
	protected $tableAcs = "t_accessoire_acs";
	protected $tablePer = "t_personnel_per";
		
		
	public function entree_accessoire($donnees){
		$this->db->insert($this->tableEac,$donnees);
	}	
	
	public function liste_entree_accessoire(){
		return $this->db
		->join($this->tableAcc, $this->tableAcc.'.acc_id='.$this->tableEac.'.acc_id','inner')
		->where($this->tableEac.".eac_iSta",1)
		->where($this->tableAcc.".acc_iSta",1)
		->get($this->tableEac)->result();
	}	
	
	
	public function liste_accessoire_enstock(){
		return $this->db
		->join($this->tableAcc, $this->tableAcc.'.acc_id='.$this->tableSac.'.acc_id','inner')
		->where($this->tableSac.".sac_iSta",1)
		->where($this->tableAcc.".acc_iSta",1)
		->get($this->tableSac)->result();
	}
	
	public function entree_stock_accessoire($donnees){
		return $this->db->insert($this->tableSac,$donnees);
	}	
	
	public function maj_entree_accessoire($donnees,$id){
		return $this->db->where("sac_id",$id)->update($this->tableSac,$donnees);
	}	
	
	
	public function verif_entree_accessoire($id)
	{
		return $this->db
		->where("acc_id",$id)
		->get($this->tableSac)->row();
	}
	
	public function recup_accessoire($id)
	{
		return $this->db
		->join($this->tableAcc, $this->tableAcc.'.acc_id='.$this->tableSac.'.acc_id','inner')
		// ->where($this->tableSac.".sac_iSta",1)
		// ->where($this->tableAcc.".acc_iSta",1)
		->where($this->tableSac.".sac_id",$id)
		->get($this->tableSac)->row();
	}
	
	public function sortir_accessoire($donnees){
		return $this->db->insert($this->tableAcs,$donnees);
	}	
	
	public function maj_sortir_accessoire($donnees,$id){
		return $this->db->where("sac_id",$id)->update($this->tableSac,$donnees);
	}	
	
	
	public function liste_sortie_accessoire()
	{
		return $this->db
		->join($this->tableSac, $this->tableSac.'.sac_id='.$this->tableAcs.'.sac_id','inner')
		->join($this->tableAcc, $this->tableSac.'.acc_id='.$this->tableAcc.'.acc_id','inner')
		->join($this->tablePer, $this->tablePer.'.per_id='.$this->tableAcs.'.per_iBenef','inner')
		// ->join($this->tablePer, $this->tablePer.'.per_id='.$this->tableAcs.'.per_iAutorisant','inner')
		->get($this->tableAcs)->result();
	}
	
	
	public function recup_magasinier($id)
	{
		return $this->db
		->where("per_id",$id)
		->get($this->tablePer)->row();
	}
}
