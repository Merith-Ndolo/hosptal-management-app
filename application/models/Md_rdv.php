<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_rdv extends CI_Model {
		
	protected $tableDir = "t_disponibilite_rdv_dir";
	protected $tablePer = "t_personnel_per";
	
	
	public function insert_rendez_vous($data){
		$this->db->insert($this->tableDir,$data);
	} 
	
	
	public function liste_des_rdv($date){
		return $this->db
		->join($this->tablePer,$this->tablePer.".per_id=".$this->tableDir.".dir_sDestinataire")
		->where($this->tableDir.".dir_iSta",1)
		->where($this->tableDir.".dir_dDate >= ",$date)
		->get($this->tableDir)
		->result();
		
	}
	public function liste_de_mes_rdv(){
		return $this->db
		->join($this->tablePer,$this->tablePer.".per_id=".$this->tableDir.".dir_sDestinataire")
		->where($this->tableDir.".dir_iSta !=",2)
		->where($this->tableDir.".dir_sDestinataire",$this->session->medicalis)
		->get($this->tableDir)
		->result();
		
	}
	public function liste_des_rdv_annules($date){
		return $this->db
		->join($this->tablePer,$this->tablePer.".per_id=".$this->tableDir.".dir_sDestinataire")
		->where($this->tableDir.".dir_iSta",0)
		->where($this->tableDir.".dir_dDate >= ",$date)
		->get($this->tableDir)
		->result();
		
	}
	public function liste_des_rdv_valides($date){
		return $this->db
		->join($this->tablePer,$this->tablePer.".per_id=".$this->tableDir.".dir_sDestinataire")
		->where($this->tableDir.".dir_iSta",2)
		->where($this->tableDir.".dir_dDate >= ",$date)
		->get($this->tableDir)
		->result();
		
	}
	
	
	public function annulerRdv($dir_id) 
	{ 
		return $this->db->where('dir_id',$dir_id)->delete($this->tableDir); 
	}
	
	
	public function maj_rdv($donnees,$id){
		return $this->db->where("dir_id",$id)->update($this->tableDir,$donnees);
	}	
}

?>