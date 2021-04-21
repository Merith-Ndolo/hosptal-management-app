<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_personnel extends CI_Model {
		
	protected $tablePer = "t_personnel_per";
	protected $tablePap = "t_passe_personnel_pap";
	protected $tableDep = "t_departement_dep";
	protected $tableFct = "t_fonctions_fct";
	protected $tablePst = "t_postes_pst";
	protected $tableSpt = "t_specialites_spt";
	protected $tableAft = "t_affectation_aft";
	protected $tableTpe = "t_type_personnel_tpe";
	protected $tableUni = "t_unite_uni";
	
	/**********         Affectation           *************/
	public function liste_affectation_personnel_unite($uni)
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableAft.'.uni_id','inner')
		->join($this->tablePer, $this->tablePer.'.per_id='.$this->tableAft.'.per_id','inner')
		->join($this->tableFct, $this->tableFct.'.fct_id='.$this->tableAft.'.fct_id','inner')
		->join($this->tableSpt, $this->tableSpt.'.spt_id='.$this->tablePer.'.spt_id','inner')
		->where($this->tableAft.".uni_id",$uni)
		->where($this->tableAft.".aft_iSta",1)
		->get($this->tableAft)->result();
	}
	
	public function recup_affectation($id)
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableAft.'.uni_id','inner')
		->join($this->tablePer, $this->tablePer.'.per_id='.$this->tableAft.'.per_id','inner')
		->join($this->tableFct, $this->tableFct.'.fct_id='.$this->tableAft.'.fct_id','inner')
		->join($this->tableSpt, $this->tableSpt.'.spt_id='.$this->tablePer.'.spt_id','inner')
		->where($this->tableAft.".aft_id",$id)
		->get($this->tableAft)->row();
	}
	
	public function verif_affectation($per,$uni)
	{
		return $this->db
		->where("per_id",$per)
		->where("uni_id",$uni)
		->where("aft_iSta",1)
		->get($this->tableAft)->row();
	}
	
	public function ajout_affectation($donnees){
		return $this->db->insert($this->tableAft,$donnees);
	}
	
	public function maj_affectation($donnees,$id){
		return $this->db->where("aft_id",$id)->update($this->tableAft,$donnees);
	}
	
	
	
	/********** 		Personnel			************/
	public function recup_personnel($id)
	{
		return $this->db
		->where("per_id",$id)
		->get($this->tablePer)->row();
	}
	
	public function liste_personnel_departement($id)
	{
		return $this->db
		->where("dep_id",$id)
		->get($this->tablePer)->result();
	}
	
	
	public function personnel_par_direction($dep)
	{
		return $this->db
		->where("per_iSta !=",2)
		->where("dep_id",$dep)
		->get($this->tablePer)->result();
	}
	
	
	public function liste_personnels_supprimes()
	{
		return $this->db
						->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
						->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
						->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
						->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
						->where($this->tablePer.".per_iSta",2)
						->get($this->tablePer)->result();
	}
	
	
	public function nb_complete_personnel()
	{
		return $this->db
						->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
						->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
						->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
						->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
						->where($this->tablePer.".per_iSta !=",2)
						->get($this->tablePer)->result();
	}
	
	
	
	public function nb_personnel_medical()
	{
		return $this->db
						->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
						->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
						->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
						->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
						->where($this->tablePer.".per_iSta !=",2)
						->where($this->tablePst.".tpe_id",1)
						->get($this->tablePer)->result();
	}
	
	
	public function nb_personnel_non_medical()
	{
		return $this->db
						->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
						->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
						->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
						->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
						->where($this->tablePer.".per_iSta !=",2)
						->where($this->tablePst.".tpe_id",2)
						->get($this->tablePer)->result();
	}
	
	
	
	public function nb_complete_medico_technique()
	{
		return $this->db
						->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
						->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
						->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
						->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
						->where($this->tablePer.".per_iSta !=",2)
						->where($this->tablePst.".tpe_id",3)
						->get($this->tablePer)->result();
	}
	
	
	public function liste_complete_personnel($nb,$pageActuelle)
	{
		$articleParPage = $nb;
		$pageDepart = ($pageActuelle - 1)*$articleParPage;
		
		return $this->db
		->limit($articleParPage, $pageDepart)
		->order_by($this->tablePer.".per_sNom","asc")
		->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
		->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
		->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
		->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
		->where($this->tablePer.".per_iSta !=",2)
		->get($this->tablePer)->result();
	}
	
	
	
	public function liste_personnel_medical($nb,$pageActuelle)
	{
		$articleParPage = $nb;
		$pageDepart = ($pageActuelle - 1)*$articleParPage;
		
			return $this->db
		->limit($articleParPage, $pageDepart)
		->order_by($this->tablePer.".per_sNom","asc")
		->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
		->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
		->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
		->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
		->where($this->tablePer.".per_iSta !=",2)
		->where($this->tablePst.".tpe_id",1)->get($this->tablePer)->result();
	}
	
	public function liste_personnel_non_medical($nb,$pageActuelle)
	{
		$articleParPage = $nb;
		$pageDepart = ($pageActuelle - 1)*$articleParPage;
		
		return $this->db
		->limit($articleParPage, $pageDepart)
		->order_by($this->tablePer.".per_sNom","asc")
		->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
		->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
		->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
		->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
		->where($this->tablePer.".per_iSta !=",2)
		->where($this->tablePst.".tpe_id",2)->get($this->tablePer)->result();
	}
	
	public function liste_personnel_medical_technique($nb,$pageActuelle)
	{
		$articleParPage = $nb;
		$pageDepart = ($pageActuelle - 1)*$articleParPage;
		
		return $this->db
		->limit($articleParPage, $pageDepart)
		->order_by($this->tablePer.".per_sNom","asc")
		->join($this->tableDep, $this->tableDep.".dep_id=".$this->tablePer.".dep_id", "inner")
		->join($this->tablePst, $this->tablePst.".pst_id=".$this->tablePer.".pst_id", "inner")
		->join($this->tableSpt, $this->tableSpt.".spt_id=".$this->tablePer.".spt_id", "inner")
		->join($this->tableTpe, $this->tableTpe.".tpe_id=".$this->tablePst.".tpe_id", "inner")
		->where($this->tablePer.".per_iSta !=",2)
		->where($this->tablePst.".tpe_id",3)->get($this->tablePer)->result();
	}
	
	public function liste_departements_actifs()
	{
		return $this->db
		->where("dep_iSta",1)
		->order_by("dep_sLibelle","asc")
		->get($this->tableDep)->result();
	}
	
	public function verif_mail($email)
	{
		return $this->db
		->where("per_sEmail",$email)
		->get($this->tablePer)->row();
	}
	
	public function verif_tel($tel)
	{
		return $this->db
		->where("per_sTel",$tel)
		->get($this->tablePer)->row();
	}
	
	
	public function verif_mail_edit($email,$id)
	{
		return $this->db
		->where("per_sEmail",$email)
		->where("per_id !=",$id)
		->get($this->tablePer)->row();
	}
	
	public function verif_tel_edit($tel,$id)
	{
		return $this->db
		->where("per_sTel",$tel)
		->where("per_id !=",$id)
		->get($this->tablePer)->row();
	}
	
	public function verif_pass_edit($pass,$id)
	{
		return $this->db
		->where("per_sPwd",$pass)
		->where("per_id",$id)
		->get($this->tablePer)->row();
	}
	
	
	public function ajout_personnel($data,$dataPass){
		$this->db->insert($this->tablePer,$data);
		$per = $this->db->order_by("per_id","desc")->get($this->tablePer)->row();
		$dataPass["per_id"]=$per->per_id;
		if(strlen($per->per_id)==1){
			$matricule="PH-00".$per->per_id."/".date("m-Y");
		}
		else if(strlen($per->per_id)==2){
			$matricule="PH-0".$per->per_id."/".date("m-Y");
		}
		else{
			$matricule="PH-".$per->per_id."/".date("m-Y");
		}
		$this->db->where("per_id",$per->per_id)->update($this->tablePer,array("per_sMatricule"=>$matricule));
		return $this->db->insert($this->tablePap,$dataPass);
	}
	
	public function modifier_personnel($data,$id){
		return $this->db->where("per_id",$id)->update($this->tablePer,$data);
	}
	
	
}
