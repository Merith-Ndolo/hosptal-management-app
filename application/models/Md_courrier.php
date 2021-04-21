<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_courrier extends CI_Model {
		
	protected $tableTco = "	t_type_courrier_tco";
	protected $tableTce = "	t_courrier_entrant_tce";
	protected $tableTcs = "	t_courrier_sortant_tcs";
	
	public function insert_types_courrier($data){
		return $this->db->insert($this->tableTco,$data);
	} 
	
	public function insert_courrier_entrant($data){
		return $this->db->insert($this->tableTce,$data);
	} 
	
	
	public function insert_courrier($data){
		return $this->db->insert($this->tableTce,$data);
	} 
	
	
	public function verif_types_courrier($tco){
		return $this->db
			->where("tco_sType",$tco)
			->get($this->tableTco)
			->row();
	} 
	
	public function verif_courrier_entrant($tco){
		return $this->db
			->where("tco_sType",$tco)
			->get($this->tableTco)
			->row();
	} 
    
	public function verif_courrier_sortrant($tcs){
		return $this->db
			->where("tcs_sExpediteur",$tcs)
			->get($this->tableTcs)
			->row();
	} 

	public function verif_courrier($tce){
		return $this->db
			->where("tce_sEnvoyeur",$tce)
			->get($this->tableTce)
			->row();
	} 

	
	public function verif_types_courrier_modif($tco,$id){
		return $this->db
			->where("tco_sType",$tco)
			->where("tco_id !=",$id)
			->get($this->tableTco)
			->row();
	} 
	
   public function verif_courrier_corriger($tcs,$id){
		return $this->db
			->where("tcs_id !=",$id)
			->get($this->tableTcs)
			->row();
	} 
	

	public function recup_types_courrier($tco){
		return $this->db
			->where("tco_id",$tco)
			->get($this->tableTco)
			->row();
	}
	
	public function recup_courrier_entrant()
	{
		return $this->db->where($this->tableTce.".tce_iSta",1)->order_by("tce_id","asc")->get($this->tableTce)->result();
	} 
	
	public function recup_courrier_sortant()
	{
		return $this->db
		->join($this->tableTco, $this->tableTcs.'.tco_id='.$this->tableTco.'.tco_id','left')
		->where("tcs_iSta",1)
		->order_by($this->tableTcs.".tcs_sExpediteur ","asc")
		->get($this->tableTcs)
		->result();
	} 
	
	public function recup_courrier_sortant_a_envoye()
	{
		return $this->db
		->join($this->tableTco, $this->tableTcs.'.tco_id='.$this->tableTco.'.tco_id','left')
		->where("tcs_iSta",0)
		->order_by($this->tableTcs.".tcs_sExpediteur ","asc")
		->get($this->tableTcs)
		->result();
	} 
	
	public function recup_courrier_sortant_envoye($id)
	{
		return $this->db
		->join($this->tableTco, $this->tableTcs.'.tco_id='.$this->tableTco.'.tco_id','left')
		->where("tcs_id",$id)
		->get($this->tableTcs)
		->row();
	} 
	
	public function insert_courrier_sortant($data)
	{
		return $this->db->insert($this->tableTcs,$data);

	} 
	
	public function recup_archive_courrier()
	{
		return $this->db->where($this->tableTce.".tce_iSta",3)->order_by("tce_id","asc")->get($this->tableTce)->result();
	} 

	public function maj_courrier($donnees,$id){
		return $this->db->where("tco_id",$id)->update($this->tableTco,$donnees);
	}
	
	public function maj_courrier_entrant($donnees,$id){
		return $this->db->where("tce_id",$id)->update($this->tableTce,$donnees);
	}
	
	public function modification_courrier($data,$tco_id){
		return $this->db->where("tco_id",$tco_id)->update($this->tableTco,$data);
	}
	
	public function corriger_courrier_envoye($data,$tcs_id){
		return $this->db->where("tcs_id",$tcs_id)->update($this->tableTcs,$data);
	}
	
	
}
?>