<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_patient extends CI_Model {
		
	protected $tablePat = "t_patients_pat";
	protected $tablePer = "t_personnel_per";
	protected $tableAnt = "t_antecedants_ant";
	protected $tablePec = "t_personnes_contacts_pec";
	protected $tableAcm = "t_acte_medical_acm";
	protected $tableLac = "t_liste_act_lac";
	protected $tableAss = "t_assureurs_ass";
	protected $tableCas = "t_couverture_assurance_cas";
	protected $tableTas = "t_type_assurance_tas";
	protected $tableDep = "t_departement_dep";
	protected $tableSer = "t_services_ser";
	protected $tableUni = "t_unite_uni";
	protected $tableFac = "t_facture_fac";
	protected $tableElf = "t_elements_facture_elf";
	protected $tableCon = "t_constante_con";
	protected $tableCsl = "t_consultation_csl";
	protected $tableSea = "t_sejour_acte_sea";
	protected $tableElo = "t_element_ordonnance_elo";
	protected $tableOrd = "t_ordonnance_ord";
	protected $tableSoi = "t_soins_infirmiers_soi";
	protected $tableFor = "t_forme_for";
	protected $tableFam = "t_famille_fam";
	protected $tableCat = "t_categories_cat";
	protected $tableMed = "t_medicament_med";
	protected $tableImg = "t_imagerie_img";
	protected $tableAci = "t_acte_imagerie_aci";
	protected $tableIai = "t_image_acte_imagerie_iai";
	protected $tableHos = "t_hospitalisation_hos";
	protected $tableCha = "t_chambre_cha";
	protected $tableLit = "t_lit_lit";
	protected $tableEfc = "t_exploration_fonctionnelle_efc";
	protected $tableAef = "t_acte_exploration_fonctionnelle_aef";
	protected $tableRee = "t_reeducation_ree";
	protected $tableSre = "t_seance_reeducation_sre";
	protected $tableNne = "t_nouveau_ne_nne";
	protected $tableDec = "t_deces_dec";
	protected $tableMal = "t_maladie_mal";
	protected $tableDia = "t_diagnostic_dia";
	protected $tableLab = "t_laboratoire_lab";
	protected $tableAla = "t_acte_laboratoire_ala";
	protected $tableInc = "t_information_complementaire_inc";
	
	
	public function ajout_diagnostic($data){
		return $this->db->insert($this->tableDia,$data);
	}
	
	public function maj_deces($data,$id){
		return $this->db->where("pat_id",$id)->update($this->tablePat,$data);
	}
	
	public function liste_maladie_actifs()
	{
		return $this->db
		->where("mal_iSta",1)
		->order_by("mal_sLibelle","asc")
		->get($this->tableMal)->result();
	}
	
	public function nouveau_cas_deces($data){
		return $this->db->insert($this->tableDec,$data);
	}	
	
	public function ajout_nouveau_ne($data){
		return $this->db->insert($this->tableNne,$data);
	}
	
	public function maj_statut_seance($data, $id){
		return $this->db->where("ree_id",$id)->update($this->tableRee,$data);
	}	
	
	public function maj_seance($data, $id){
		return $this->db->where("ree_id",$id)->update($this->tableRee,$data);
	}
	
	
	public function recup_seance($id){
		return $this->db
		// ->join($this->tableRee, $this->tableRee.'.ree_id ='.$this->tableSre.'.ree_id ','inner')
		// ->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableRee.'.acm_id ','inner')
		// ->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		// ->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		// ->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		// ->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableRee.".ree_id",$id)
		->get($this->tableRee)->row();
	}
	
	public function liste_seance_reeducation($id)
	{
		return $this->db
		->join($this->tableRee, $this->tableRee.'.ree_id ='.$this->tableSre.'.ree_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableRee.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableRee.".ree_id",$id)
		->get($this->tableSre)->result();
	}
	
	
	public function detail_patient_reeducation($id)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableRee.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableRee.".ree_id",$id)
		->get($this->tableRee)->row();
	}	
	
	
	public function medecin_prescripteur_reeducation($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableRee.'.sea_id ='.$this->tableSea.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAcm.'.per_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableRee.".sea_id",$id)
		->get($this->tableRee)->row();
	}
	
	
	public function liste_acm_reeducation($date,$inf)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableRee.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAcm.".acm_dDateExp >",$date)
		->where($this->tableSer.".ser_id",$inf)
		->where($this->tableRee.".ree_iSta",1)
		->get($this->tableRee)->result();
	}	
	
			
	public function diagnostic($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableDia.'.sea_id ','inner')
		->join($this->tableMal, $this->tableMal.'.mal_id ='.$this->tableDia.'.mal_id ','inner')
		->where($this->tableDia.".sea_id",$id)
		->order_by($this->tableDia.".dia_id","desc")
		->get($this->tableDia)->result();
	}			
		
		
	public function cas_deces($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableDec.'.sea_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableDec.'.uni_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableDec.".sea_id",$id)
		->order_by($this->tableDec.".dec_id","desc")
		->get($this->tableDec)->row();
	}			
	
	
	public function nouveau_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableNne.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableNne.".sea_id",$id)
		->order_by($this->tableNne.".nne_id","desc")
		->get($this->tableNne)->result();
	}		
	
			
	public function reeducation_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableRee.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableRee.'.acm_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableUni.'.ser_id ='.$this->tableSer.'.ser_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableRee.".sea_id",$id)
		->order_by($this->tableRee.".ree_id","desc")
		->get($this->tableRee)->result();
	}	
	
		
	public function ajout_reeducation($data){
		return $this->db->insert($this->tableSre,$data);
	}
	
	
	public function maj_assignation($data,$id){
		return $this->db->where("soi_id",$id)->update($this->tableSoi,$data);
	}
	
	
	public function detail_patient_assigne($id)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSoi.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableSoi.".soi_id",$id)
		->get($this->tableSoi)->row();
	}
	
	public function medecin_prescripteur($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSoi.'.sea_id ='.$this->tableSea.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAcm.'.per_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableSoi.".sea_id",$id)
		->get($this->tableSoi)->row();
	}
	
	public function medecin_prescripteur_exploration($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableEfc.'.sea_id ='.$this->tableSea.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAcm.'.per_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableEfc.".sea_id",$id)
		->get($this->tableEfc)->row();
	}
	
	public function medecin_prescripteur_imagerie($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableImg.'.sea_id ='.$this->tableSea.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAcm.'.per_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableImg.".sea_id",$id)
		->get($this->tableImg)->row();
	}
	
	
	/****** ************/
	public function liste_acm_encours($date,$per)
	{
		return $this->db
		// ->join($this->tableElf, $this->tableElf.'.acm_id ='.$this->tableAcm.'.acm_id ','inner')
		// ->join($this->tableFac, $this->tableFac.'.fac_id ='.$this->tableElf.'.fac_id ','inner')
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableAcm.'.pat_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		// ->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->where($this->tableAcm.".acm_dDateExp >=",$date)
		->where($this->tableAcm.".acm_iSta",2)
		->where($this->tableAcm.".per_id",$per)
		->get($this->tableAcm)->result();
	}	
	
	public function liste_acm_expire($date,$per)
	{
		return $this->db
		// ->join($this->tableElf, $this->tableElf.'.acm_id ='.$this->tableAcm.'.acm_id ','inner')
		// ->join($this->tableFac, $this->tableFac.'.fac_id ='.$this->tableElf.'.fac_id ','inner')
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableAcm.'.pat_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		// ->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->where($this->tableAcm.".acm_dDateExp <",$date)
		->where($this->tableAcm.".acm_iSta",2)
		->where($this->tableAcm.".per_id",$per)
		->get($this->tableAcm)->result();
	}	
	
	
	public function liste_acm_infirmerie($date,$inf)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSoi.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAcm.".acm_dDateExp >",$date)
		->where($this->tableSer.".ser_id",$inf)
		->where($this->tableSoi.".soi_iSta",1)
		->get($this->tableSoi)->result();
	}	
		
	public function liste_acm_laboratoire($date,$lab)
	{
		return $this->db
		->join($this->tableLab, $this->tableLab.'.lab_id ='.$this->tableAla.'.lab_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableLab.'.per_id ','inner')
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableLab.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAla.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAcm.".acm_dDateExp >",$date)
		->where($this->tableSer.".ser_id",$lab)
		->where($this->tableAla.".ala_iSta",1)
		->get($this->tableAla)->result();
	}	
	
		
	public function acm_laboratoire_unique($id)
	{
		return $this->db
		->join($this->tableLab, $this->tableLab.'.lab_id ='.$this->tableAla.'.lab_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableLab.'.per_id ','inner')
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableLab.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAla.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAla.".ala_id",$id)
		->get($this->tableAla)->row();
	}	
	

	public function liste_acm_infirmerie_hospitalisation($date,$inf)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSoi.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->join($this->tableHos, $this->tableHos.'.hos_id ='.$this->tableSoi.'.hos_id ','inner')
		->where($this->tableAcm.".acm_dDateExp >",$date)
		->where($this->tableSer.".ser_id",$inf)
		->where($this->tableSoi.".soi_iSta",3)
		->get($this->tableSoi)->result();
	}	
	
	public function liste_acm_imagerie($date,$inf)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAci.'.acm_id ','inner')
		->join($this->tableElf, $this->tableElf.'.acm_id ='.$this->tableAcm.'.acm_id ','inner')
		->join($this->tableFac, $this->tableElf.'.fac_id ='.$this->tableFac.'.fac_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAcm.".acm_dDateExp >",$date)
		->where($this->tableSer.".ser_id",$inf)
		->where($this->tableAci.".aci_iSta",1)
		->get($this->tableAci)->result();
	}	
		
	public function liste_acm_exploration($date,$inf)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAef.'.acm_id ','inner')
		->join($this->tableElf, $this->tableElf.'.acm_id ='.$this->tableAcm.'.acm_id ','inner')
		->join($this->tableFac, $this->tableElf.'.fac_id ='.$this->tableFac.'.fac_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAcm.".acm_dDateExp >",$date)
		->where($this->tableSer.".ser_id",$inf)
		->where($this->tableAef.".aef_iSta",1)
		->get($this->tableAef)->result();
	}	
		
	public function liste_acm_imagerie_fait($inf)
	{
		return $this->db
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAci.'.aci_iPer ','inner')
		->join($this->tableImg, $this->tableImg.'.img_id ='.$this->tableAci.'.img_id ','inner')
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableImg.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAci.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableSer.".ser_id",$inf)
		->where($this->tableAci.".aci_iSta",2)
		->get($this->tableAci)->result();
	}	
	
	public function liste_acm_exploration_fait($inf)
	{
		return $this->db
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAef.'.aef_iPer ','inner')
		->join($this->tableEfc, $this->tableEfc.'.efc_id ='.$this->tableAef.'.efc_id ','inner')
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableEfc.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAef.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableSer.".ser_id",$inf)
		->where($this->tableAef.".aef_iSta",2)
		->get($this->tableAef)->result();
	}	
		
	public function patient_imagerie($aci)
	{
		return $this->db
		->join($this->tableImg, $this->tableImg.'.img_id ='.$this->tableAci.'.img_id ','inner')
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableImg.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAci.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAci.".aci_id",$aci)
		->get($this->tableAci)->row();
	}	
		
	public function patient_exploration($aci)
	{
		return $this->db
		->join($this->tableEfc, $this->tableEfc.'.efc_id ='.$this->tableAef.'.efc_id ','inner')
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableEfc.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAef.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAef.".aef_id",$aci)
		->get($this->tableAef)->row();
	}	
	
	public function detail_patient_imagerie($date,$inf)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAci.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->where($this->tableAcm.".acm_dDateExp >",$date)
		->where($this->tableSer.".ser_id",$inf)
		// ->where($this->tableAci.".img_iSta",1)
		->get($this->tableAci)->result();
	}	
	
	public function liste_acm_infirmerie_fait($inf)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSoi.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePat, $this->tableAcm.'.pat_id ='.$this->tablePat.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableSoi.'.soi_iPersonnel ','inner')
		->where($this->tableSer.".ser_id",$inf)
		->where($this->tableSoi.".soi_iSta",2)
		->get($this->tableSoi)->result();
	}	
	
	
	public function acm_patient($id)
	{
		return $this->db
		->join($this->tableElf, $this->tableElf.'.acm_id ='.$this->tableAcm.'.acm_id ','inner')
		->join($this->tableFac, $this->tableFac.'.fac_id ='.$this->tableElf.'.fac_id ','inner')
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableAcm.'.pat_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableAcm.".acm_sStatut","en cours")
		->where($this->tableAcm.".acm_id",$id)
		->get($this->tableAcm)->row();
	}	
	/** Consultation */	
	public function verif_sejour($acm, $date)
	{
		return $this->db
		->where("acm_id",$acm)
		->where("sea_dDate",$date)
		->get($this->tableSea)->row();
	}	
	
				
	public function sejour_acm($id)
	{
		return $this->db
		->where("acm_id",$id)
		->get($this->tableSea)->result();
	}	
	
		
				
	public function sejour($id)
	{
		return $this->db
		->where("sea_id",$id)
		->get($this->tableSea)->row();
	}	
	
			
	public function constante($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableCon.'.sea_id ','inner')
		->where($this->tableSea.".acm_id",$id)
		->order_by($this->tableCon.".con_id","desc")
		->get($this->tableCon)->row();
	}	
					
	public function information($id)
	{
		return $this->db
		->where("pat_id",$id)
		->order_by("inc_id","desc")
		->get($this->tableInc)->row();
	}	
			
	public function constante_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableCon.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableCon.".sea_id",$id)
		->order_by($this->tableCon.".con_id","desc")
		->get($this->tableCon)->row();
	}		
			
	public function constante_sejour_hospitalise($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableCon.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableCon.".sea_id",$id)
		->order_by($this->tableCon.".con_id","desc")
		->get($this->tableCon)->result();
	}	
			
	public function hospitalisation_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableHos.'.sea_id ','inner')
		->join($this->tableLit, $this->tableLit.'.lit_id ='.$this->tableHos.'.lit_id ','inner')
		->join($this->tableCha, $this->tableCha.'.cha_id ='.$this->tableLit.'.cha_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableCha.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableHos.".sea_id",$id)
		->order_by($this->tableHos.".hos_id","desc")
		->get($this->tableHos)->row();
	}	
			
	public function liste_hospitalisation()
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableHos.'.sea_id ','inner')
		->join($this->tableLit, $this->tableLit.'.lit_id ='.$this->tableHos.'.lit_id ','inner')
		->join($this->tableCha, $this->tableCha.'.cha_id ='.$this->tableLit.'.cha_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableCha.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableHos.'.acm_id ','inner')
		->join($this->tableElf, $this->tableElf.'.acm_id ='.$this->tableAcm.'.acm_id ','inner')
		->join($this->tableFac, $this->tableElf.'.fac_id ='.$this->tableFac.'.fac_id ','inner')
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableAcm.'.pat_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableHos.".hos_iSta",1)
		->order_by($this->tableHos.".hos_dDate","desc")
		->get($this->tableHos)->result();
	}	
	
				
	public function hospitalisation($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableHos.'.sea_id ','inner')
		->join($this->tableLit, $this->tableLit.'.lit_id ='.$this->tableHos.'.lit_id ','inner')
		->join($this->tableCha, $this->tableCha.'.cha_id ='.$this->tableLit.'.cha_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableCha.'.uni_id ','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id ='.$this->tableUni.'.ser_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableHos.'.acm_id ','inner')
		->join($this->tableElf, $this->tableElf.'.acm_id ='.$this->tableAcm.'.acm_id ','inner')
		->join($this->tableFac, $this->tableElf.'.fac_id ='.$this->tableFac.'.fac_id ','inner')
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableAcm.'.pat_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableHos.".hos_id",$id)
		->get($this->tableHos)->row();
	}	
					
	public function rappel_hospitalisation($id,$date)
	{
		return $this->db
		->where("hos_id",$id)
		->where("hos_dDate < ",$date)
		->get($this->tableHos)->row();
	}	
	
			
	public function liste_constante($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableCon.'.sea_id ','inner')
		->where($this->tableSea.".acm_id",$id)
		->order_by($this->tableCon.".con_id","desc")
		->get($this->tableCon)->result();
	}	
					
	public function liste_information($id)
	{
		return $this->db
		->where("pat_id",$id)
		->order_by("inc_id","desc")
		->get($this->tableInc)->result();
	}	
			
	public function consultation($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableCsl.'.sea_id ','inner')
		->where($this->tableSea.".acm_id",$id)
		->order_by($this->tableCsl.".csl_id","desc")
		->get($this->tableCsl)->row();
	}	
	
			
	public function consultation_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableCsl.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSea.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableCsl.".sea_id",$id)
		->order_by($this->tableCsl.".csl_id","desc")
		->get($this->tableCsl)->row();
	}	
		
	
			
	public function liste_consultation($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableCsl.'.sea_id ','inner')
		->where($this->tableSea.".acm_id",$id)
		->order_by($this->tableCsl.".csl_id","desc")
		->get($this->tableCsl)->result();
	}	
	
				
	public function recup_ordonnance($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableOrd.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableSea.'.acm_id ='.$this->tableAcm.'.acm_id ','inner')
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableAcm.'.pat_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAcm.'.per_id ','inner')
		->where($this->tableOrd.".ord_id",$id)
		->get($this->tableOrd)->row();
	}
					
	public function ordonnance_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableOrd.'.sea_id ','inner')
		->where($this->tableOrd.".sea_id",$id)
		->order_by($this->tableOrd.".ord_id","desc")
		->get($this->tableOrd)->row();
	}
				
	public function element_ordonnance($id)
	{
		return $this->db
		// ->join($this->tableMed, $this->tableMed.'.med_id ='.$this->tableElo.'.med_id ','inner')
		// ->join($this->tableCat, $this->tableMed.'.cat_id='.$this->tableCat.'.cat_id','inner')
		// ->join($this->tableFam, $this->tableMed.'.fam_id='.$this->tableFam.'.fam_id','inner')
		// ->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->where($this->tableElo.".ord_id",$id)
		->get($this->tableElo)->result();
	}
	
	
			
	public function soins_infirmiers_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableSoi.'.sea_id ','inner')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableSoi.'.acm_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableUni.'.ser_id ='.$this->tableSer.'.ser_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableSoi.'.soi_iPersonnel ','LEFT')
		->where($this->tableSoi.".sea_id",$id)
		->order_by($this->tableSoi.".soi_id","desc")
		->get($this->tableSoi)->result();
	}
				
	public function imagerie_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableImg.'.sea_id ','inner')
		// ->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		// ->join($this->tableSer, $this->tableUni.'.ser_id ='.$this->tableSer.'.ser_id ','inner')
		// ->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableImg.".sea_id",$id)
		->order_by($this->tableImg.".img_id","desc")
		->get($this->tableImg)->row();
	}
				
	public function exploration_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableEfc.'.sea_id ','inner')
		// ->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		// ->join($this->tableSer, $this->tableUni.'.ser_id ='.$this->tableSer.'.ser_id ','inner')
		// ->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableEfc.".sea_id",$id)
		->order_by($this->tableEfc.".efc_id","desc")
		->get($this->tableEfc)->row();
	}
				
	public function laboratoire_sejour($id)
	{
		return $this->db
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableLab.'.sea_id ','inner')
		// ->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		// ->join($this->tableSer, $this->tableUni.'.ser_id ='.$this->tableSer.'.ser_id ','inner')
		// ->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableLab.".sea_id",$id)
		->order_by($this->tableLab.".lab_id","desc")
		->get($this->tableLab)->row();
	}
	
				
	public function acte_exploration_sejour($id)
	{
		return $this->db
		->join($this->tableEfc, $this->tableAef.'.efc_id ='.$this->tableEfc.'.efc_id ','inner')
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableEfc.'.sea_id ','left')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAef.'.acm_id ','left')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableUni.'.ser_id ='.$this->tableSer.'.ser_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAef.'.aef_iPer ','left')
		->where($this->tableAef.".efc_id",$id)
		->order_by($this->tableAef.".aef_dDate","asc")
		->get($this->tableAef)->result();
	}
				
	public function acte_imagerie_sejour($id)
	{
		return $this->db
		->join($this->tableImg, $this->tableAci.'.img_id ='.$this->tableImg.'.img_id ','inner')
		->join($this->tableSea, $this->tableSea.'.sea_id ='.$this->tableImg.'.sea_id ','left')
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableAci.'.acm_id ','left')
		->join($this->tableUni, $this->tableUni.'.uni_id ='.$this->tableAcm.'.uni_id ','inner')
		->join($this->tableSer, $this->tableUni.'.ser_id ='.$this->tableSer.'.ser_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->join($this->tablePer, $this->tablePer.'.per_id ='.$this->tableAci.'.aci_iPer ','left')
		->where($this->tableAci.".img_id",$id)
		->order_by($this->tableAci.".aci_dDate","asc")
		->get($this->tableAci)->result();
	}
	
	
	/****** ************/
	public function liste_allergie_actifs($id)
	{
		return $this->db
		->join($this->tableTal, $this->tableTal.'.tal_id ='.$this->tableAll.'.tal_id ','inner')
		->where($this->tableAll.".pat_id",$id)
		->get($this->tableAll)->result();
	}	
	
	public function element_facture($id)
	{
		return $this->db
		->join($this->tableAcm, $this->tableAcm.'.acm_id ='.$this->tableElf.'.acm_id ','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id ='.$this->tableAcm.'.lac_id ','inner')
		->where($this->tableElf.".fac_id",$id)
		->get($this->tableElf)->result();
	}	
	
	
	public function detail_facture($id)
	{
		return $this->db
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableFac.'.pat_id ','inner')
		->join($this->tableTas, $this->tableTas.'.tas_id='.$this->tableFac.'.tas_id','left')
		->join($this->tableAss, $this->tableAss.'.ass_id='.$this->tableFac.'.ass_id','left')
		->where($this->tableFac.".fac_id",$id)
		->get($this->tableFac)->row();
	}	
	
	
	public function liste_element_caisse()
	{
		return $this->db
		->join($this->tableLac, $this->tableLac.'.lac_id='.$this->tableAcm.'.lac_id','inner')
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableAcm.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where($this->tableAcm.".acm_iSta",1)
		->where($this->tableAcm.".acm_iHos ",0)
		->get($this->tableAcm)->result();
	}
	
	public function liste_element_caisse_hos()
	{
		return $this->db
		->join($this->tableLac, $this->tableLac.'.lac_id='.$this->tableAcm.'.lac_id','inner')
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableAcm.'.pat_id ','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where($this->tableAcm.".acm_iSta",1)
		->where($this->tableAcm.".acm_iHos ",1)
		->get($this->tableAcm)->result();
	}
	
	public function liste_facture()
	{
		return $this->db
		->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableFac.'.pat_id ','inner')
		->get($this->tableFac)->result();
	}
		
	public function recup_last_acte_medical()
	{
		return $this->db
		->order_by("acm_id","desc")
		->get($this->tableAcm)->row();
	}
	
	public function liste_element_caisse_ajax($id)
	{
		return $this->db
		->join($this->tableLac, $this->tableLac.'.lac_id='.$this->tableAcm.'.lac_id','inner')
		->where($this->tableAcm.'.acm_id',$id)
		->get($this->tableAcm)->row();
	}
	
	
	public function nb_patients()
	{
		return $this->db
					->where("pat_iSta",1)
					->get($this->tablePat)->result();
	}
	
	
	public function liste_patients($nb,$pageActuelle)
	{
		$articleParPage = $nb;
		$pageDepart = ($pageActuelle - 1)*$articleParPage;
		
			return $this->db
		->limit($articleParPage, $pageDepart)
		->order_by("pat_sNom","asc")
		->where("pat_iSta",1)
		->get($this->tablePat)->result();
	}
	
	public function liste_patients_supprimes()
	{
		return $this->db
		->where("pat_iSta",2)
		->get($this->tablePat)->result();
	}
	
	
	public function recup_patient($patId)
	{
		return $this->db
		->select("pat_id, pat_sNom, pat_sPrenom,pat_sSexe, pat_iSta, pat_sCivilite, pat_dDateNaiss, DATE_FORMAT(pat_dDateNaiss,'%W %d %M %Y') AS dateNaiss, pat_sAdresse, pat_sTel, pat_sSituationMat, pat_sProfession, pat_dDateEnreg, pat_sAvatar, pat_sMatricule")
		->where("pat_id",$patId)
		->get($this->tablePat)->row();
	}

	public function liste_antecedant($patId)
	{
		return $this->db
		->where("pat_id",$patId)
		->where("ant_iSta",1)
		->get($this->tableAnt)->result();
	}
	
	public function verif_antecedents($lib,$type,$patId)
	{
		return $this->db
		->where("ant_sLibelle",$lib)
		->where("ant_sType",$type)
		->where("pat_id",$patId)
		->where("ant_iSta",1)
		->get($this->tableAnt)->result();
	}
	
	public function verif_allergies($lib,$type,$patId)
	{
		return $this->db
		->where("all_sLibelle",$lib)
		->where("tal_id",$type)
		->where("pat_id",$patId)
		->where("all_iSta",1)
		->get($this->tableAll)->result();
	}
	
	public function liste_un_antecedant($patId)
	{
		return $this->db
		->limit(1)
		->where("pat_id",$patId)
		->where("ant_iSta",1)
		->get($this->tableAnt)->row();
	}

	public function liste_contacts($patId)
	{
		return $this->db
		->where("pat_id",$patId)
		->where("pec_iSta",1)
		->get($this->tablePec)->result();
	}

	
	public function verif_tel($tel)
	{
		return $this->db
		->where("pat_sTel",$tel)
		->get($this->tablePat)->row();
	}
	
	
	public function verif_tel_edit($tel,$id)
	{
		return $this->db
		->where("pat_sTel",$tel)
		->where("pat_id !=",$id)
		->get($this->tablePat)->row();
	}
	
	
	public function ajout_patient($data){
		date_default_timezone_set('Africa/Brazzaville');
		$this->db->insert($this->tablePat,$data);
		$pat = $this->db->order_by("pat_id","desc")->get($this->tablePat)->row();
		if(strlen($pat->pat_id)==1){
			$matricule="PAT-00".$pat->pat_id."/".date("m-Y");
		}
		else if(strlen($pat->pat_id)==2){
			$matricule="PAT-0".$pat->pat_id."/".date("m-Y");
		}
		else{
			$matricule="PAT-".$pat->pat_id."/".date("m-Y");
		}
		
		$this->db->where("pat_id",$pat->pat_id)->update($this->tablePat,array("pat_sMatricule"=>$matricule));
		return $pat->pat_id;
	}
	
	public function ajout_antecedents($data){
		return $this->db->insert($this->tableAnt,$data);
	}
		
	public function ajout_allergies($data){
		return $this->db->insert($this->tableAll,$data);
	}
		
	public function ajout_personnes_contact($data){
		return $this->db->insert($this->tablePec,$data);
	}
	
	public function maj_actes_caisse($data,$id){
		return $this->db->where("acm_id",$id)->update($this->tableAcm,$data);
	}
		
	public function maj_patient($data,$id){
		return $this->db->where("pat_id",$id)->update($this->tablePat,$data);
	}
	
		
	public function maj_acte_medical_imagerie($data,$id){
		return $this->db->where("aci_id",$id)->update($this->tableAci,$data);
	}
	
	
		
	public function maj_acte_medical_exploration($data,$id){
		return $this->db->where("aef_id",$id)->update($this->tableAef,$data);
	}
	
	
	public function insert_image_imagerie($data){
		return $this->db->insert($this->tableIai,$data);
	}
		
	public function ajout_prescription_hospitalisation($data){
		return $this->db->insert($this->tableHos,$data);
	}
	
	public function ajout_orientation($data){
		return $this->db->insert($this->tableAcm,$data);
	}
	
	public function ajout_elements_facture($data){
		return $this->db->insert($this->tableElf,$data);
	}
		
	public function ajout_constante($data){
		return $this->db->insert($this->tableCon,$data);
	}
		
	public function ajout_information($data){
		return $this->db->insert($this->tableInc,$data);
	}
		
	public function ajout_consultation($data){
		return $this->db->insert($this->tableCsl,$data);
	}
		
	public function ajout_sejour_acm($data){
		$this->db->insert($this->tableSea,$data);
		$recup = $this->db->order_by("sea_id","desc")->get($this->tableSea)->row();
		return $recup;
	}
			
	public function ajout_imagerie($data){
		$this->db->insert($this->tableImg,$data);
		$recup = $this->db->order_by("img_id","desc")->get($this->tableImg)->row();
		return $recup;
	}
				
	public function ajout_exploration($data){
		$this->db->insert($this->tableEfc,$data);
		$recup = $this->db->order_by("efc_id","desc")->get($this->tableEfc)->row();
		return $recup;
	}
				
	public function ajout_laboratoire($data){
		$this->db->insert($this->tableLab,$data);
		$recup = $this->db->order_by("lab_id","desc")->get($this->tableLab)->row();
		return $recup;
	}
		
	public function ajout_ordonnance($data){
		$this->db->insert($this->tableOrd,$data);
		$recup = $this->db->order_by("ord_id","desc")->get($this->tableOrd)->row();
		return $recup;
	}
	
	public function ajout_facture($data){
		$this->db->insert($this->tableFac,$data);
		$fac = $this->db->order_by("fac_id","desc")->get($this->tableFac)->row();
		if(strlen($fac->fac_id)==1){
			$numero="FAC-00".$fac->fac_id."/".date("m-Y");
		}
		else if(strlen($fac->fac_id)==2){
			$numero="FAC-0".$fac->fac_id."/".date("m-Y");
		}
		else{
			$numero="FAC-".$fac->fac_id."/".date("m-Y");
		}
		$this->db->where("fac_id",$fac->fac_id)->update($this->tableFac,array("fac_sNumero "=>$numero));
		return $fac->fac_id;
	}
	
	
	
		
	public function verif_element_ordonnance($med,$qte,$duree,$pos)
	{
		return $this->db
		->where("elo_sProduit",$med)
		->where("elo_iQuantite",$qte)
		->where("elo_iDuree",$duree)
		->where("elo_sPosologie",$pos)
		->get($this->tableElo)->row();
	}
	
	public function ajout_element_ordonnance($data){
		return $this->db->insert($this->tableElo,$data);
	}
	
	public function ajout_prescription_soins($data){
		return $this->db->insert($this->tableSoi,$data);
	}
	
	public function ajout_prescription_imagerie($data){
		return $this->db->insert($this->tableAci,$data);
	}
		
	public function ajout_prescription_exploration($data){
		return $this->db->insert($this->tableAef,$data);
	}
		
	public function ajout_prescription_laboratoire($data){
		return $this->db->insert($this->tableAla,$data);
	}
	
		
}
