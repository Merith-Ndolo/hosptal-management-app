<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_parametre extends CI_Model {
		
	protected $tableDep = "t_departement_dep";
	protected $tablePst = "t_postes_pst";
	protected $tableSpt = "t_specialites_spt";
	protected $tableFct = "t_fonctions_fct";
	protected $tableSer = "t_services_ser";
	protected $tableUni = "t_unite_uni";
	protected $tableTpe = "t_type_personnel_tpe";
	protected $tableLac = "t_liste_act_lac";
	protected $tableAcm = "t_acte_medical_acm";
	protected $tableAss = "t_assureurs_ass";
	protected $tableTas = "t_type_assurance_tas";
	protected $tableCas = "t_couverture_assurance_cas";
	protected $tableStr = "t_structure_str";
	protected $tableCat = "t_categories_cat";
	protected $tableFam = "t_famille_fam";
	protected $tableFor = "t_forme_for";
	protected $tableTfr = "t_type_fournisseur_tfr";
	protected $tableSal = "t_salles_sal";
	protected $tableArm = "t_armoires_arm";
	protected $tableLig = "t_lignes_lig";
	protected $tableCol = "t_colonnes_col";
	protected $tableCel = "t_cellules_cel";
	protected $tablePay = "t_pays_pay";
	protected $tableVil = "t_ville_vil";
	protected $tableFrs = "t_fournisseurs_frs";
	protected $tableCha = "t_chambre_cha";
	protected $tableLit = "t_lit_lit";
	protected $tableTir = "t_titre_rapport_tir";
	protected $tableSot = "t_sous_titre_sot";
	protected $tableNul = "t_numero_liste_nul";
	protected $tableTex = "t_type_examen_tex";
	protected $tableEla = "t_element_analyse_ela";
	protected $tableAcc = "t_accessoire_acc";
	protected $tableRea = "t_reactif_rea";
	protected $tableRex= "t_reactif_examen_rex";
	protected $tableEre= "t_entree_reactif_ere";
	protected $tableHre= "t_historique_reactif_hre";
	protected $tableRes= "t_reactif_stock_res";
	protected $tableSor= "t_sortie_reactif_sor";
	protected $tablePer= "t_personnel_per";
	protected $tableTco = "t_type_courrier_tco";
	
	
	public function sortie_reactif($donnees){
		return $this->db->insert($this->tableSor,$donnees);
	}
	
	public function liste_destock_reactif(){
		return $this->db
		->join($this->tableEre, $this->tableEre.'.ere_id='.$this->tableRes.'.ere_id','inner')
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		->where($this->tableRes.".res_iSta",2)
		->get($this->tableRes)->result();
	}
	
	public function destock_reactif($data, $id){
		return $this->db->where("res_id",$id)->update($this->tableRes,$data);
	}
	
	
	public function liste_stock_reactif(){
		return $this->db
		->join($this->tableEre, $this->tableEre.'.ere_id='.$this->tableRes.'.ere_id','inner')
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		// ->where($this->tableRea.".rea_iSta",1)
		->where($this->tableRes.".res_iSta",1)
		->get($this->tableRes)->result();
	}		
	
	public function liste_stock_reactif_selection($id){
		return $this->db
		->join($this->tableEre, $this->tableEre.'.ere_id='.$this->tableRes.'.ere_id','inner')
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		->where($this->tableRes.".res_id",$id)
		->get($this->tableRes)->row();
	}		
	
	
	public function liste_historique_reactif(){
		return $this->db
		->join($this->tableEre, $this->tableEre.'.ere_id='.$this->tableHre.'.ere_id','inner')
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		->where($this->tableRea.".rea_iSta",1)
		->get($this->tableHre)->result();
	}		
	
	
	public function liste_entree_reactif(){
		return $this->db
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		->where($this->tableRea.".rea_iSta",1)
		->where($this->tableEre.".ere_iSta",1)
		->get($this->tableEre)->result();
	}	
	
	public function ajout_entree_reactif($donnees){
		return $this->db->insert($this->tableRes,$donnees);
	}	
	
	public function entree_detail_stock($donnees){
		return $this->db->insert($this->tableHre,$donnees);
	}
	
	
	public function entree_stock_reactif($donnees){
		$this->db->insert($this->tableEre,$donnees);
		return $this->db
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		->order_by($this->tableEre.".ere_id","desc")
		->get($this->tableEre)->row();
	}	
	
	
	public function verif_entree_reactif($id)
	{
		return $this->db
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		->where($this->tableEre.".rea_id",$id)
		->get($this->tableEre)->row();
	}
	
	public function reactif_en_stock($id)
	{
		return $this->db
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		->where($this->tableEre.".ere_id",$id)
		->get($this->tableEre)->row();
	}
	
	public function verif_reactif($rea)
	{
		return $this->db
		->where("rea_sLibelle",$rea)
		->get($this->tableRea)->row();
	}
	
	public function ajout_reactif($donnees){
		$this->db->insert($this->tableRea,$donnees);
		return  $this->db->order_by("rea_id","desc")->get($this->tableRea)->row();
	}
	
	
	public function verif_existe_reactif($rea,$tex)
	{
		return $this->db
		->where("rea_id",$rea)
		->where("tex_id",$tex)
		->get($this->tableRex)->row();
	}
	
	public function ajout_reactif_examen($donnees){
		return $this->db->insert($this->tableRex,$donnees);
	}
	
	public function recup_reactif_actifs($id)
	{
		return $this->db
		->where("rea_id",$id)
		->get($this->tableRea)->row();
	}	
	
	public function liste_reactif_actifs()
	{
		return $this->db
		->where("rea_iSta",1)
		->order_by("rea_sLibelle","asc")
		->get($this->tableRea)->result();
	}
	
	
	public function liste_examen_reactif_actifs($rea)
	{
		return $this->db
		->join($this->tableTex, $this->tableTex.'.tex_id='.$this->tableRex.'.tex_id','inner')
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableRex.'.rea_id','inner')
		->order_by($this->tableTex.".tex_sLibelle","asc")
		->where($this->tableRex.".rea_id",$rea)
		->get($this->tableRex)->result();
	}	
		
	
	public function liste_examen_reactif_nu_actifs($tex,$res)
	{
		return $this->db
		->join($this->tableTex, $this->tableTex.'.tex_id='.$this->tableSor.'.tex_id','inner')
		->where($this->tableSor.".tex_id",$tex)
		->where($this->tableSor.".res_id",$res)
		->get($this->tableSor)->row();
	}
	
	public function liste_examen_reactif_sortie($res)
	{
		return $this->db
		->where($this->tableSor.".res_id",$res)
		->where($this->tableSor.".res_dDateRetour IS NOT NULL")
		->order_by($this->tableSor.".sor_id","desc")
		->get($this->tableSor)->row();
	}
	
	public function liste_sorties_reactif()
	{
		return $this->db
		->join($this->tableTex, $this->tableTex.'.tex_id='.$this->tableSor.'.tex_id','inner')
		->join($this->tableRes, $this->tableRes.'.res_id='.$this->tableSor.'.res_id','inner')
		->join($this->tableEre, $this->tableEre.'.ere_id='.$this->tableRes.'.ere_id','inner')
		->join($this->tableRea, $this->tableRea.'.rea_id='.$this->tableEre.'.rea_id','inner')
		->join($this->tablePer, $this->tablePer.'.per_id='.$this->tableSor.'.res_iDest','inner')
		->get($this->tableSor)->result();
	}
	
	public function maj_reactif($donnees,$id){
		return $this->db->where("rea_id",$id)->update($this->tableRea,$donnees);
	}
	
	public function recup_reactif($id)
	{
		return $this->db
		->where("rea_id",$id)
		->get($this->tableRea)->row();
	}
	
	
	public function liste_accessoire_actifs()
	{
		return $this->db
		->where("acc_iSta",1)
		->order_by("acc_sLibelle","asc")
		->get($this->tableAcc)->result();
	}
	
	public function ajout_accessoire($donnees){
		return $this->db->insert($this->tableAcc,$donnees);
	}
	
	public function maj_accessoire($donnees,$id){
		return $this->db->where("acc_id",$id)->update($this->tableAcc,$donnees);
	}
	
	public function recup_accessoire($id)
	{
		return $this->db
		->where("acc_id",$id)
		->get($this->tableAcc)->row();
	}
	
	
	public function ajout_element_analyse($donnees){
		return $this->db->insert($this->tableEla,$donnees);
	}	
	
	public function ajout_type_examen($donnees){
		return $this->db->insert($this->tableTex,$donnees);
	}
	
	public function maj_element_analyse($donnees,$id){
		return $this->db->where("ela_id",$id)->update($this->tableEla,$donnees);
	}	
	
	public function maj_type_examen($donnees,$id){
		return $this->db->where("tex_id",$id)->update($this->tableTex,$donnees);
	}
	
	public function recup_type_examen($id)
	{
		// return $this->db
		// ->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		// ->where($this->tableSer.".ser_id",$id)
		// ->get($this->tableSer)->row();
	}	
	
	public function recup_element_analyse($id)
	{
		// return $this->db
		// ->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		// ->where($this->tableSer.".ser_id",$id)
		// ->get($this->tableSer)->row();
	}
	
	public function maj_type_exam($donnees,$id){
		return $this->db->where("tex_id",$id)->update($this->tableTex,$donnees);
	}
	
	public function liste_element_analyse_actifs()
	{
		return $this->db
		->join($this->tableTex, $this->tableEla.'.tex_id='.$this->tableTex.'.tex_id','inner')
		->where($this->tableEla.".ela_iSta",1)
		->order_by($this->tableEla.".ela_sLibelle","asc")
		->get($this->tableEla)->result();
	}
	
	
	public function liste_types_courrier()
	{
		return $this->db->where($this->tableTco.".tco_iSta",1)->order_by("tco_id","asc")->get($this->tableTco)->result();
	}
	
	
	public function element_analyse_actifs($lac)
	{
		return $this->db
		->join($this->tableTex, $this->tableTex.'.tex_id='.$this->tableEla.'.tex_id','inner')
		->join($this->tableLac, $this->tableLac.'.lac_id='.$this->tableTex.'.lac_id','inner')
		->where($this->tableEla.".ela_iSta",1)
		->where($this->tableTex.".lac_id",$lac)
		->order_by($this->tableEla.".ela_sLibelle","asc")
		->get($this->tableEla)->result();
	}
	
	
	public function liste_type_examen_actifs()
	{
		return $this->db
		->join($this->tableLac, $this->tableLac.'.lac_id='.$this->tableTex.'.lac_id','inner')
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where($this->tableTex.".tex_iSta",1)
		->order_by($this->tableTex.".tex_sLibelle","asc")
		->get($this->tableTex)->result();
	}
	
	
	
	
	public function liste_chambre_supprimes()
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableCha.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where($this->tableCha.".cha_iSta",2)
		->order_by($this->tableCha.".cha_sLibelle","asc")
		->get($this->tableCha)->result();
	}	
	
	public function maj_chambre($donnees,$id){
		return $this->db->where("cha_id",$id)->update($this->tableCha,$donnees);
	}
	
	public function recup_chambre($id)
	{
		return $this->db
		->where("cha_id",$id)
		->get($this->tableCha)->row();
	}
	
	
	public function ajout_lit($donnees){
		$this->db->insert($this->tableLit,$donnees);
	}	
	
	public function ajout_chambre($donnees){
		$this->db->insert($this->tableCha,$donnees);
		$recup = $this->db->order_by("cha_id","desc")->get($this->tableCha)->row();
		return $recup->cha_id;
	}
	
	
	public function liste_chambre_unite($id)
	{
		$recup = $this->db->where("uni_id",$id)->order_by("uni_sLibelle","asc")->get($this->tableUni)->row();
		return $recup->uni_sLibelle;
	}	
	
	public function liste_unite_service($id)
	{
		$recup = $this->db->where("ser_id",$id)->order_by("ser_sLibelle","asc")->get($this->tableSer)->row();
		return $recup->ser_sLibelle;
	}	
	
	public function liste_lit_chambre($id)
	{
		return $this->db
		->where("cha_id",$id)
		->order_by("lit_sLibelle","asc")
		->get($this->tableLit)->result();
	}
	
	public function liste_chambre_actifs()
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableCha.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where($this->tableCha.".cha_iSta",1)
		->order_by($this->tableCha.".cha_sLibelle","asc")
		->get($this->tableCha)->result();
	}
		
	public function liste_chambre_unite_dispo($id)
	{
		return $this->db
		->where($this->tableCha.".uni_id",$id)
		->where($this->tableCha.".cha_iSta",1)
		->order_by($this->tableCha.".cha_sLibelle","asc")
		->get($this->tableCha)->result();
	}
			
	public function liste_lit_chambre_dispo($id)
	{
		return $this->db
		->where($this->tableLit.".cha_id",$id)
		->where($this->tableLit.".lit_iOccupe",0)
		->order_by($this->tableLit.".lit_sLibelle","asc")
		->get($this->tableLit)->result();
	}
		
	public function verif_chambre($lib,$id)
	{
		return $this->db
		->where("cha_sLibelle",$lib)
		->where("uni_id",$id)
		->get($this->tableCha)->row();
	}
	
	
	public function info_structure()
	{
		return $this->db
		->get($this->tableStr)->row();
	}
	
	public function liste_type_personnel()
	{
		return $this->db
		->order_by("tpe_sLibelle","asc")
		->get($this->tableTpe)->result();
	}
	
	
	/***** Assureur *********/
	public function liste_assureurs_actifs()
	{
		return $this->db
		->where("ass_iSta",1)
		->order_by("ass_sLibelle","asc")
		->get($this->tableAss)->result();
	}
	
	public function liste_assureurs_supprimes()
	{
		return $this->db
		->where("ass_iSta",2)
		->order_by("ass_sLibelle","asc")
		->get($this->tableAss)->result();
	}
	
	
	public function verif_assureur($ass)
	{
		return $this->db
		->where("ass_sLibelle",$ass)
		->get($this->tableAss)->row();
	}
	
	public function recup_assureur($id)
	{
		return $this->db
		->where("ass_id",$id)
		->get($this->tableAss)->row();
	}
	
	public function verif_assureur_modif($ass,$id)
	{
		return $this->db
		->where("ass_sLibelle",$ass)
		->where("ass_id !=",$id)
		->get($this->tableAss)->row();
	}	
	
	public function ajout_assureur($donnees){
		return $this->db->insert($this->tableAss,$donnees);
	}
	
	public function maj_assureur($donnees,$id){
		return $this->db->where("ass_id",$id)->update($this->tableAss,$donnees);
	}
	
	/***** Type couverture d'assurance *********/
	public function liste_type_couverture_assurance_actifs()
	{
		return $this->db
		->where("tas_iSta",1)
		->order_by("tas_sLibelle","asc")
		->get($this->tableTas)->result();
	}
	
	public function liste_type_assurance_supprimes()
	{
		return $this->db
		->where("tas_iSta",2)
		->order_by("tas_sLibelle","asc")
		->get($this->tableTas)->result();
	}
	
	
	public function verif_type_assurance($tas)
	{
		return $this->db
		->where("tas_sLibelle",$tas)
		->get($this->tableTas)->row();
	}
	
	public function recup_type_assurance($id)
	{
		return $this->db
		->where("tas_id",$id)
		->get($this->tableTas)->row();
	}
	
	public function recup_acte_couvert($lac,$tas)
	{
		return $this->db
		->join($this->tableLac, $this->tableLac.'.lac_id='.$this->tableCas.'.lac_id','inner')
		->join($this->tableTas, $this->tableTas.'.tas_id='.$this->tableCas.'.tas_id','inner')
		->where($this->tableCas.".tas_id",$tas)
		->where($this->tableCas.".lac_id",$lac)
		->get($this->tableCas)->row();
	}
	
	public function verif_type_assurance_modif($tas,$id)
	{
		return $this->db
		->where("tas_sLibelle",$tas)
		->where("tas_id !=",$id)
		->get($this->tableTas)->row();
	}	
	
	public function ajout_type_assurance($donnees){
		$this->db->insert($this->tableTas,$donnees);
		return  $this->db->order_by("tas_id","desc")->get($this->tableTas)->row();
	}
	
	public function maj_type_assurance($donnees,$id){
		return $this->db->where("tas_id",$id)->update($this->tableTas,$donnees);
	}
	
	
	/***** couverture d'assurance *********/
	public function liste_couverture_assurance_actifs($tas)
	{
		return $this->db
		->join($this->tableLac, $this->tableLac.'.lac_id='.$this->tableCas.'.lac_id','inner')
		->join($this->tableTas, $this->tableTas.'.tas_id='.$this->tableCas.'.tas_id','inner')
		->order_by($this->tableLac.".lac_sLibelle","asc")
		->where($this->tableCas.".tas_id",$tas)
		->get($this->tableCas)->result();
	}
	
	
	public function verif_couverture_assurance($tas,$lac)
	{
		return $this->db
		->where("tas_id",$tas)
		->where("lac_id",$lac)
		->get($this->tableCas)->row();
	}
	
	public function recup_couverture_assurance($id)
	{
		return $this->db
		->join($this->tableLac, $this->tableLac.'.lac_id='.$this->tableCas.'.lac_id','inner')
		->join($this->tableTas, $this->tableTas.'.tas_id='.$this->tableCas.'.tas_id','inner')
		->where($this->tableCas.".cas_id",$id)
		->get($this->tableCas)->row();
	}
	
	public function verif_couverture_assurance_modif($tas,$lac,$id)
	{
		return $this->db
		->where("tas_id",$tas)
		->where("lac_id",$lac)
		->where("cas_id !=",$id)
		->get($this->tableCas)->row();
	}	
	
	public function ajout_couverture_assurance($donnees){
		return $this->db->insert($this->tableCas,$donnees);
	}
	
	public function maj_couverture_assurance($donnees,$id){
		return $this->db->where("cas_id",$id)->update($this->tableCas,$donnees);
	}
	
	
	/***** Direction *********/
	public function liste_departements_actifs()
	{
		return $this->db
		->where("dep_iSta",1)
		->order_by("dep_sLibelle","asc")
		->get($this->tableDep)->result();
	}
	
	public function liste_departements_supprimes()
	{
		return $this->db
		->where("dep_iSta",2)
		->order_by("dep_sLibelle","asc")
		->get($this->tableDep)->result();
	}
	
	
	public function verif_departement($dep)
	{
		return $this->db
		->where("dep_sLibelle",$dep)
		->get($this->tableDep)->row();
	}
	
	public function recup_direction($id)
	{
		return $this->db
		->where("dep_id",$id)
		->get($this->tableDep)->row();
	}
	
	public function verif_departement_modif($dep,$id)
	{
		return $this->db
		->where("dep_sLibelle",$dep)
		->where("dep_id !=",$id)
		->get($this->tableDep)->row();
	}	
	
	public function ajout_departement($donnees){
		return $this->db->insert($this->tableDep,$donnees);
	}
	
	public function maj_direction($donnees,$id){
		return $this->db->where("dep_id",$id)->update($this->tableDep,$donnees);
	}
	
	
	/*********** Service **********/
	public function liste_services_actifs()
	{
		return $this->db
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where("ser_iSta",1)
		->order_by($this->tableSer.".ser_sLibelle","asc")
		->get($this->tableSer)->result();
	}
	
	public function liste_services_supprimes()
	{
		return $this->db
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where("ser_iSta",2)
		->order_by($this->tableSer.".ser_sLibelle","asc")
		->get($this->tableSer)->result();
	}
	
	public function liste_services_direction_actifs($dir)
	{
		return $this->db
		// ->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where("ser_iSta",1)
		->where("dep_id",$dir)
		->order_by("ser_sLibelle","asc")
		->get($this->tableSer)->result();
	}
	
	public function verif_service($ser,$dep)
	{
		return $this->db
		->where("ser_sLibelle",$ser)
		->where("dep_id",$dep)
		->get($this->tableSer)->row();
	}
	
	public function recup_service($id)
	{
		return $this->db
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where($this->tableSer.".ser_id",$id)
		->get($this->tableSer)->row();
	}
	
	public function verif_service_modif($ser,$dep,$id)
	{
		return $this->db
		->where("ser_sLibelle",$ser)
		->where("dep_id",$dep)
		->where("ser_id !=",$id)
		->get($this->tableSer)->row();
	}
	
	
	public function ajout_service($donnees){
		return $this->db->insert($this->tableSer,$donnees);
	}
	
	public function maj_service($donnees,$id){
		return $this->db->where("ser_id",$id)->update($this->tableSer,$donnees);
	}
	
	
	
	/*********** Unité **********/
	public function liste_unites_actifs()
	{
		return $this->db
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where("uni_iSta",1)
		->order_by($this->tableUni.".uni_sLibelle","asc")
		->get($this->tableUni)->result();
	}
	
	public function liste_unite_services_actifs($ser)
	{
		return $this->db
		->where("uni_iSta",1)
		->where("ser_id",$ser)
		->order_by($this->tableUni.".uni_sLibelle","asc")
		->get($this->tableUni)->result();
	}
	
	public function liste_unites_supprimees()
	{
		return $this->db
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where("uni_iSta",2)
		->order_by($this->tableUni.".uni_sLibelle","asc")
		->get($this->tableUni)->result();
	}
	
	public function verif_unite($uni,$ser)
	{
		return $this->db
		->where("uni_sLibelle",$uni)
		->where("ser_id",$ser)
		->get($this->tableUni)->row();
	}
	
	public function recup_unite($id)
	{
		return $this->db
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where($this->tableUni.".uni_id",$id)
		->get($this->tableUni)->row();
	}
	
	public function verif_unite_modif($uni,$ser,$id)
	{
		return $this->db
		->where("uni_sLibelle",$uni)
		->where("ser_id",$ser)
		->where("uni_id !=",$id)
		->get($this->tableUni)->row();
	}
	
	
	public function ajout_unite($donnees){
		return $this->db->insert($this->tableUni,$donnees);
	}
	
	public function maj_unite($donnees,$id){
		return $this->db->where("uni_id",$id)->update($this->tableUni,$donnees);
	}
	
	
	/********* Domaine **********************/
	public function liste_postes_actifs()
	{
		return $this->db
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where("pst_iSta",1)
		->order_by("pst_sLibelle","asc")
		->get($this->tablePst)->result();
	}
	
	public function liste_postes_supprimes()
	{
		return $this->db
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where("pst_iSta",2)
		->order_by("pst_sLibelle","asc")
		->get($this->tablePst)->result();
	}
	
	
	public function liste_domaine_type_actifs($tpe)
	{
		return $this->db
		->where("pst_iSta",1)
		->where("tpe_id",$tpe)
		->order_by("pst_sLibelle","asc")
		->get($this->tablePst)->result();
	}
	
	
	public function verif_poste($pst,$tpe)
	{
		return $this->db
		->where("pst_sLibelle",$pst)
		->where("tpe_id",$tpe)
		->get($this->tablePst)->row();
	}
	
	public function recup_poste($id)
	{
		return $this->db
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where($this->tablePst.".pst_id",$id)
		->get($this->tablePst)->row();
	}
	
	public function verif_poste_modif($pst,$tpe,$id)
	{
		return $this->db
		->where("pst_sLibelle",$pst)
		->where("tpe_id",$tpe)
		->where("pst_id !=",$id)
		->get($this->tablePst)->row();
	}
	
	
	public function ajout_poste($donnees){
		return $this->db->insert($this->tablePst,$donnees);
	}
	
	public function maj_poste($donnees,$id){
		return $this->db->where("pst_id",$id)->update($this->tablePst,$donnees);
	}
	
	
	/********* specialités **********************/
	public function liste_specialites_actifs()
	{
		return $this->db
		->join($this->tablePst, $this->tablePst.'.pst_id='.$this->tableSpt.'.pst_id','inner')
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where("spt_iSta",1)
		->order_by("spt_sLibelle","asc")
		->get($this->tableSpt)->result();
	}
		
	public function liste_specialites_supprimees()
	{
		return $this->db
		->join($this->tablePst, $this->tablePst.'.pst_id='.$this->tableSpt.'.pst_id','inner')
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where("spt_iSta",2)
		->order_by("spt_sLibelle","asc")
		->get($this->tableSpt)->result();
	}
	
	public function liste_poste_type_actifs($tpe)
	{
		return $this->db
		->where("pst_iSta",1)
		->where("tpe_id",$tpe)
		->order_by("pst_sLibelle","asc")
		->get($this->tablePst)->result();
	}
	
	
	public function liste_specialites_poste_actifs($pos)
	{
		return $this->db
		->where("spt_iSta",1)
		->where("pst_id",$pos)
		->order_by("spt_sLibelle","asc")
		->get($this->tableSpt)->result();
	}
	
	
	public function verif_specialite($spt,$pst)
	{
		return $this->db
		->where("spt_sLibelle",$spt)
		->where("pst_id",$pst)
		->get($this->tableSpt)->row();
	}
	
	public function recup_specialite($id)
	{
		return $this->db
		->join($this->tablePst, $this->tablePst.'.pst_id='.$this->tableSpt.'.pst_id','inner')
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where($this->tableSpt.".spt_id",$id)
		->get($this->tableSpt)->row();
	}
	
	public function verif_specialite_modif($spt,$pst,$id)
	{
		return $this->db
		->where("spt_sLibelle",$spt)
		->where("pst_id",$pst)
		->where("spt_id !=",$id)
		->get($this->tableSpt)->row();
	}
	
	
	public function ajout_specialite($donnees){
		return $this->db->insert($this->tableSpt,$donnees);
	}
	
	public function maj_specialite($donnees,$id){
		return $this->db->where("spt_id",$id)->update($this->tableSpt,$donnees);
	}
	
	
	/********* fonctions **********************/
	public function liste_fonctions_actifs()
	{
		return $this->db
		->join($this->tablePst, $this->tablePst.'.pst_id='.$this->tableFct.'.pst_id','inner')
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where("fct_iSta",1)
		->order_by("fct_sLibelle","asc")
		->get($this->tableFct)->result();
	}	
	
	public function liste_fonctions_supprimees()
	{
		return $this->db
		->join($this->tablePst, $this->tablePst.'.pst_id='.$this->tableFct.'.pst_id','inner')
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where("fct_iSta",2)
		->order_by("fct_sLibelle","asc")
		->get($this->tableFct)->result();
	}
	
	public function liste_fonction_poste_actifs($pst)
	{
		return $this->db
		->where("fct_iSta",1)
		->where("pst_id",$pst)
		->order_by("fct_sLibelle","asc")
		->get($this->tableFct)->result();
	}
	
	
	public function verif_fonction($fct,$pst)
	{
		return $this->db
		->where("fct_sLibelle",$fct)
		->where("pst_id",$pst)
		->get($this->tableFct)->row();
	}
	
	public function recup_fonction($id)
	{
		return $this->db
		->join($this->tablePst, $this->tablePst.'.pst_id='.$this->tableFct.'.pst_id','inner')
		->join($this->tableTpe, $this->tableTpe.'.tpe_id='.$this->tablePst.'.tpe_id','inner')
		->where($this->tableFct.".fct_id",$id)
		->get($this->tableFct)->row();
	}
	
	public function verif_fonction_modif($fct,$pst,$id)
	{
		return $this->db
		->where("fct_sLibelle",$fct)
		->where("pst_id",$pst)
		->where("fct_id !=",$id)
		->get($this->tableFct)->row();
	}
	
	
	public function ajout_fonction($donnees){
		return $this->db->insert($this->tableFct,$donnees);
	}
	
	public function maj_fonction($donnees,$id){
		return $this->db->where("fct_id",$id)->update($this->tableFct,$donnees);
	}	
	
	public function modif_structure($donnees,$id){
		return $this->db->where("str_id",$id)->update($this->tableStr,$donnees);
	}
	
	
	/********* Actes médicaux **********************/
	public function liste_acts_actifs()
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where($this->tableLac.".lac_iSta",1)
		->order_by($this->tableLac.".lac_sLibelle","asc")
		->get($this->tableLac)->result();
	}
	
	public function liste_acts_laboratoires_actifs()
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where($this->tableLac.".lac_iSta",1)
		->where($this->tableSer.".ser_id",27)
		->order_by($this->tableLac.".lac_sLibelle","asc")
		->get($this->tableLac)->result();
	}	
	
	public function liste_unite_acte($acte)
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->join($this->tableDep, $this->tableDep.'.dep_id='.$this->tableSer.'.dep_id','inner')
		->where($this->tableLac.".lac_id",$acte)
		->get($this->tableLac)->row();
	}	
	
	public function liste_prescription($ser)
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where($this->tableSer.".ser_id",$ser)
		->get($this->tableLac)->result();
	}	
	
	public function liste_prescription_exploration($valeur1,$valeur2)
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where($this->tableUni.".uni_id='$valeur1' OR ".$this->tableUni.".uni_id = '$valeur2'")
		->get($this->tableLac)->result();
	}	
	
	public function liste_acts_supprimees()
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where("lac_iSta",2)
		->order_by("lac_sLibelle","asc")
		->get($this->tableLac)->result();
	}
	
	
	public function verif_act($act,$uni)
	{
		return $this->db
		->where("lac_sLibelle",$act)
		->where("uni_id",$uni)
		->get($this->tableLac)->row();
	}
	
	public function recup_act($id)
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableLac.'.uni_id','inner')
		->join($this->tableSer, $this->tableSer.'.ser_id='.$this->tableUni.'.ser_id','inner')
		->where($this->tableLac.".lac_id",$id)
		->get($this->tableLac)->row();
	}

	
	public function recup_act_hospitalisation($id,$nom)
	{
		return $this->db
		->where($this->tableLac.".lac_sLibelle",$nom)
		->where($this->tableLac.".uni_id",$id)
		->get($this->tableLac)->row();
	}

	
	public function verif_act_modif($act,$uni,$id)
	{
		return $this->db
		->where("lac_sLibelle",$act)
		->where("uni_id",$uni)
		->where("lac_id !=",$id)
		->get($this->tableLac)->row();
	}
	
	
	public function ajout_act($donnees){
		return $this->db->insert($this->tableLac,$donnees);
	}
	
	public function maj_act($donnees,$id){
		return $this->db->where("lac_id",$id)->update($this->tableLac,$donnees);
	}
	
	
	
	/**** Catégorie produit*****/

	public function liste_categorie_produit_actifs()
	{
		return $this->db
		->where("cat_iSta",1)
		->order_by("cat_id","desc")
		->get($this->tableCat)->result();
	}	
		
	
	public function liste_categories_produits_supprimes()
	{
		return $this->db
		->where("cat_iSta",2)
		->order_by("cat_sLibelle","asc")
		->get($this->tableCat)->result();
	}
	
	
	public function verif_categorie_produit($cat)
	{
		return $this->db
		->where("cat_sLibelle",$cat)
		->get($this->tableCat)->row();
	}
	
	public function recup_categorie_produit($id)
	{
		return $this->db
		->where("cat_id",$id)
		->get($this->tableCat)->row();
	}
	
	public function verif_categorie_produit_modif($cat,$id)
	{
		return $this->db
		->where("cat_sLibelle",$cat)
		->where("cat_id !=",$id)
		->get($this->tableCat)->row();
	}	
	
	public function ajout_categorie_produit($donnees){
		return $this->db->insert($this->tableCat,$donnees);
	}
	
	public function maj_categorie_produit($donnees,$id){
		return $this->db->where("cat_id",$id)->update($this->tableCat,$donnees);
	}	
	
	
	/**** famille produit*****/
	
	public function liste_famille_produit_actifs()
	{
		return $this->db
		->where("fam_iSta",1)
		->order_by("fam_id","desc")
		->get($this->tableFam)->result();
	}
	
	public function liste_familles_produits_supprimes()
	{
		return $this->db
		->where("fam_iSta",2)
		->order_by("fam_sLibelle","asc")
		->get($this->tableFam)->result();
	}
	
	
	public function verif_famille_produit($fam)
	{
		return $this->db
		->where("fam_sLibelle",$fam)
		->get($this->tableFam)->row();
	}
	
	public function recup_famille_produit($id)
	{
		return $this->db
		->where("fam_id",$id)
		->get($this->tableFam)->row();
	}
	
	public function verif_famille_produit_modif($fam,$id)
	{
		return $this->db
		->where("fam_sLibelle",$fam)
		->where("fam_id !=",$id)
		->get($this->tableFam)->row();
	}	
	
	public function ajout_famille_produit($donnees){
		return $this->db->insert($this->tableFam,$donnees);
	}
	
	public function maj_famille_produit($donnees,$id){
		return $this->db->where("fam_id",$id)->update($this->tableFam,$donnees);
	}
	
	
	
	/**** forme produit*****/
	
	public function liste_forme_produit_actifs()
	{
		return $this->db
		->where("for_iSta",1)
		->order_by("for_id","desc")
		->get($this->tableFor)->result();
	}
	
	public function liste_formes_produits_supprimes()
	{
		return $this->db
		->where("for_iSta",2)
		->order_by("for_sLibelle","asc")
		->get($this->tableFor)->result();
	}
	
	
	public function verif_forme_produit($for)
	{
		return $this->db
		->where("for_sLibelle",$for)
		->get($this->tableFor)->row();
	}
	
	public function recup_forme_produit($id)
	{
		return $this->db
		->where("for_id",$id)
		->get($this->tableFor)->row();
	}
	
	public function verif_forme_produit_modif($for,$id)
	{
		return $this->db
		->where("for_sLibelle",$for)
		->where("for_id !=",$id)
		->get($this->tableFor)->row();
	}	
	
	public function ajout_forme_produit($donnees){
		return $this->db->insert($this->tableFor,$donnees);
	}
	
	public function maj_forme_produit($donnees,$id){
		return $this->db->where("for_id",$id)->update($this->tableFor,$donnees);
	}	
	
	
	/**** type fournisseur*****/
	
	public function liste_type_fournisseur_actifs()
	{
		return $this->db
		->where("tfr_iSta",1)
		->order_by("tfr_id","desc")
		->get($this->tableTfr)->result();
	}
	
	public function liste_types_fournisseurs_supprimes()
	{
		return $this->db
		->where("tfr_iSta",2)
		->order_by("tfr_sLibelle","asc")
		->get($this->tableTfr)->result();
	}
	
	
	public function verif_type_fournisseur($tfr)
	{
		return $this->db
		->where("tfr_sLibelle",$tfr)
		->get($this->tableTfr)->row();
	}
	
	public function recup_type_fournisseur($id)
	{
		return $this->db
		->where("tfr_id",$id)
		->get($this->tableTfr)->row();
	}
	
	public function verif_type_fournisseur_modif($tfr,$id)
	{
		return $this->db
		->where("tfr_sLibelle",$tfr)
		->where("tfr_id !=",$id)
		->get($this->tableTfr)->row();
	}	
	
	public function ajout_type_fournisseur($donnees){
		return $this->db->insert($this->tableTfr,$donnees);
	}
	
	public function maj_type_fournisseur($donnees,$id){
		return $this->db->where("tfr_id",$id)->update($this->tableTfr,$donnees);
	}
	
	
	/**** salle *****/
	
	public function liste_salle_actifs()
	{
		return $this->db
		->where("sal_iSta",1)
		->order_by("sal_id","desc")
		->get($this->tableSal)->result();
	}
	
	public function liste_salle_supprimes()
	{
		return $this->db
		->where("sal_iSta",2)
		->order_by("sal_sLibelle","asc")
		->get($this->tableSal)->result();
	}
	
	
	public function verif_salle($sal)
	{
		return $this->db
		->where("sal_sLibelle",$sal)
		->get($this->tableSal)->row();
	}
	
	public function recup_salle($id)
	{
		return $this->db
		->where("sal_id",$id)
		->get($this->tableSal)->row();
	}
	
	public function verif_salle_modif($sal,$id)
	{
		return $this->db
		->where("sal_sLibelle",$sal)
		->where("sal_id !=",$id)
		->get($this->tableSal)->row();
	}	
	
	public function ajout_salle($donnees){
		return $this->db->insert($this->tableSal,$donnees);
	}
	
	public function maj_salle($donnees,$id){
		return $this->db->where("sal_id",$id)->update($this->tableSal,$donnees);
	}
	
	/**** armoire *****/
	
	public function liste_rapport_actifs()
	{
		return $this->db
		->join($this->tableUni, $this->tableUni.'.uni_id='.$this->tableTir.'.uni_id','inner')
		->where("tir_iSta",1)
		->order_by($this->tableTir.".tir_sLibelle","asc")
		->get($this->tableTir)->result();
	}
		
	public function liste_armoire_actifs()
	{
		return $this->db
		->join($this->tableSal, $this->tableSal.'.sal_id='.$this->tableArm.'.sal_id','inner')
		->where("arm_iSta",1)
		->order_by($this->tableArm.".arm_sLibelle","asc")
		->get($this->tableArm)->result();
	}
	
	public function liste_armoire_supprimes()
	{
		return $this->db
		->join($this->tableSal, $this->tableSal.'.sal_id='.$this->tableArm.'.sal_id','inner')
		->where("arm_iSta",2)
		->order_by($this->tableArm.".arm_sLibelle","asc")
		->get($this->tableArm)->result();
	}	
	
	public function liste_fournisseurs_supprimes()
	{
		return $this->db
		->where("frs_iSta",2)
		->get($this->tableFrs)->result();
	}
	
	
	public function liste_armoire_salle($sal)
	{
		return $this->db
		->join($this->tableSal, $this->tableSal.'.sal_id='.$this->tableArm.'.sal_id','inner')
		->where($this->tableArm.".arm_iSta",1)
		->where($this->tableArm.".sal_id",$sal)
		->order_by($this->tableArm.".arm_sLibelle","asc")
		->get($this->tableArm)->result();
	}
	
	
	public function liste_ligne_armoire($arm)
	{
		return $this->db
		->where("arm_id",$arm)
		->get($this->tableLig)->result();
	}	
	
	public function liste_colonne_armoire($arm)
	{
		return $this->db
		->where("arm_id",$arm)
		->get($this->tableCol)->result();
	}
	
	public function liste_cellule_armoire($arm)
	{
		return $this->db
		->where("arm_id",$arm)
		->get($this->tableCel)->result();
	}
	
	
	public function verif_armoire($arm,$sal)
	{
		return $this->db
		->where("arm_sLibelle",$arm)
		->where("sal_id",$sal)
		->get($this->tableArm)->row();
	}
	
	public function recup_armoire($id)
	{
		return $this->db
		->where("arm_id",$id)
		->get($this->tableArm)->row();
	}	
	
	public function recup_fournisseur($id)
	{
		return $this->db
		->where("frs_id",$id)
		->get($this->tableFrs)->row();
	}
	
	public function verif_armoire_modif($arm,$sal,$id)
	{
		return $this->db
		->where("arm_sLibelle",$arm)
		->where("sal_id",$sal)
		->where("arm_id !=",$id)
		->get($this->tableArm)->row();
	}	
	
	public function ajout_armoire($donnees){
		$this->db->insert($this->tableArm,$donnees);
		return $this->db->order_by("arm_id","desc")->get($this->tableArm)->row();
	}
	
	public function ajout_ligne($donnees){
		$this->db->insert($this->tableLig,$donnees);
		$recup = $this->db->order_by("lig_id","desc")->get($this->tableLig)->row();
		return $recup->lig_sLibelle;
	}
	
	public function ajout_colonne($donnees){
		$this->db->insert($this->tableCol,$donnees);
		$recup = $this->db->order_by("col_id","desc")->get($this->tableCol)->row();
		return $recup->col_sLibelle;
	}
	public function ajout_cellule($donnees){
		$this->db->insert($this->tableCel,$donnees);
	}
	
	public function maj_armoire($donnees,$id){
		return $this->db->where("arm_id",$id)->update($this->tableArm,$donnees);
	}	
	
	public function maj_fournisseur($donnees,$id){
		return $this->db->where("frs_id",$id)->update($this->tableFrs,$donnees);
	}
	
	public function maj_lit($donnees,$id){
		return $this->db->where("lit_id",$id)->update($this->tableLit,$donnees);
	}
	
	public function maj_entree_stock_reactif($donnees,$id){
		return $this->db->where("ere_id",$id)->update($this->tableEre,$donnees);
	}
	
	public function maj_sortie($donnees,$id){
		return $this->db->where("sor_id",$id)->update($this->tableSor,$donnees);
	}
	
	public function delete_ligne($id){
		return $this->db->where("arm_id",$id)->delete($this->tableLig);
	}	
	
	public function delete_colonne($id){
		return $this->db->where("arm_id",$id)->delete($this->tableCol);
	}	
	
	public function delete_cellule($id){
		return $this->db->where("arm_id",$id)->delete($this->tableCel);
	}
	
	public function liste_pays_actifs()
	{
		return $this->db
		->where("pay_iSta",1)
		->order_by("pay_sLib","asc")
		->get($this->tablePay)->result();
	}	
	
	public function liste_ville_actifs($id)
	{
		return $this->db
		->where("pay_id",$id)
		->order_by("vil_sLib","asc")
		->get($this->tableVil)->result();
	}		
	
	public function type_fournisseur_courant($id)
	{
		return $this->db
		->where("tfr_id",$id)
		->get($this->tableTfr)->row();
	}	
	
	public function liste_cellule_armoire_actifs($id)
	{
		return $this->db
		->where("arm_id",$id)
		->order_by("cel_sLibelle","asc") 
		->get($this->tableCel)->result();
	}		
	
	
	public function liste_armoire_salle_actifs($id)
	{
		return $this->db
		->where("arm_iSta",1)
		->where("sal_id",$id)
		->order_by("arm_sLibelle","asc")
		->get($this->tableArm)->result();
	}		
	
	
	public function liste_ville_pays_actifs($id)
	{
		return $this->db
		->where("vil_iSta",1)
		->where("pay_id",$id)
		->order_by("vil_sLib","asc")
		->get($this->tableVil)->result();
	}
	
}
