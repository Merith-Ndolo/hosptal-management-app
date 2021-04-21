<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_pharmacie extends CI_Model {
		
	protected $tableFrs = "t_fournisseurs_frs";
	protected $tablePay = "t_pays_pay";
	protected $tableVil = "t_Ville_vil";
	protected $tableFor = "t_forme_for";
	protected $tableFam = "t_famille_fam";
	protected $tableCat = "t_categories_cat";
	protected $tableMed = "t_medicament_med";
	protected $tableAch = "t_achats_ach";
	protected $tableArm = "t_armoires_arm";
	protected $tableCel = "t_cellules_cel";
	protected $tableSal = "t_salles_sal";
	protected $tableDes = "t_destockage_des";
	protected $tableFac = "t_facture_fac";
	protected $tableElf = "t_elements_facture_elf";
	protected $tableClt = "t_client_clt";
	protected $tableBph = "t_bon_pharmacie_bph";
	protected $tableCmd = "t_commande_cmd";
	protected $tableDcm = "t_detail_commande_dcm";
	protected $tablePer = "t_personnel_per";
	protected $tableDac = "t_detail_achats_dac";
	protected $tablePro = "t_produits_pro";
	protected $tableFic = "	t_fictif_fic";
	
		
	public function maj_code($data,$code){
		return $this->db->where('pro_sCodeBarre',$code)->update($this->tablePro,$data);
	}	
		
		
	public function recup_code_barre($code){
		return $this->db->where("fic_sProd",$code)->get($this->tableFic)->result();
	}	
	
	public function maj_bon($donnees,$id){
		return $this->db->where("bph_id",$id)->update($this->tableBph,$donnees);
	}
	
	public function supprimer_fictif($prod){
		return $this->db->where("fic_sProd",$prod)->delete($this->tableFic);
	}
	
	public function recup_fictif(){
		return $this->db->select('fic_sProd, COUNT(fic_sProd) as total, fic_iPu, ach_id')
				->group_by('fic_sProd')
				// ->order_by('total', 'desc')
				->get($this->tableFic)->result();
	}	
	
	public function somme_fictif(){
		return $this->db->select(' SUM(fic_iPu) as som ')
				->get($this->tableFic)->row();
	}	
	
	
	public function ajout_fictif($donnees){
		return $this->db->insert($this->tableFic,$donnees);
	}
	
		
	
	public function verif_fictif($code){
		return $this->db->where("fic_sCode",$code)->get($this->tableFic)->row();
	}
		
	
	public function vide(){
		return $this->db->truncate($this->tableFic);
	}
	
	public function detecte_seuil(){
		
		return $this->db
		->where($this->tableAch.".ach_iQte <=".$this->tableAch.".ach_iSeuil")
		->get($this->tableAch)->result();
	}
	
	public function recup_detail_stock($id)
	{
		return $this->db
		->join($this->tableFrs, $this->tableFrs.'.frs_id='.$this->tableDac.'.frs_id','inner')
		->join($this->tablePay, $this->tablePay.'.pay_id='.$this->tableFrs.'.pay_id','inner')
		->join($this->tableVil, $this->tableVil.'.vil_id='.$this->tableFrs.'.vil_id','inner')
		->where($this->tableDac.".ach_id",$id)
		->order_by($this->tableDac.".dac_dDateAchat","desc")
		->get($this->tableDac)->result();
	}	
	
	public function liste_client_supprimes()
	{
		return $this->db
		->where("clt_iSta",2)
		->order_by("clt_sNom","asc")
		->get($this->tableClt)->result();
	}
	
	
	public function liste_fournisseur_pharmacie()
	{
		return $this->db
		->join($this->tablePay, $this->tablePay.'.pay_id='.$this->tableFrs.'.pay_id','inner')
		->join($this->tableVil, $this->tableVil.'.vil_id='.$this->tableFrs.'.vil_id','inner')
		->where("frs_iSta",1)
		->where("tfr_id",1)
		->order_by("frs_sEnseigne","asc")
		->get($this->tableFrs)->result();
	}
	
	
	
	public function liste_bon_commande()
	{
		return $this->db
		->join($this->tableFrs, $this->tableFrs.'.frs_id='.$this->tableCmd.'.frs_id','inner')
		->join($this->tablePer, $this->tablePer.'.per_id='.$this->tableCmd.'.per_id','inner')
		->join($this->tablePay, $this->tablePay.'.pay_id='.$this->tableFrs.'.pay_id','inner')
		->join($this->tableVil, $this->tableVil.'.vil_id='.$this->tableFrs.'.vil_id','inner')
		->where($this->tableCmd.".cmd_iSta",1)
		->order_by($this->tableCmd.".cmd_id","desc")
		->get($this->tableCmd)->result();
	}
	
	
	
	public function liste_detail_bon($cmd)
	{
		return $this->db
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableDcm.'.med_id','inner')
		->join($this->tableCat, $this->tableMed.'.cat_id='.$this->tableCat.'.cat_id','inner')
		->join($this->tableFam, $this->tableMed.'.fam_id='.$this->tableFam.'.fam_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->where($this->tableDcm.".cmd_id",$cmd)
		->order_by($this->tableDcm.".dcm_id","asc")
		->get($this->tableDcm)->result();
	}
	
	
	public function recup_client($id)
	{
		return $this->db
		->where("clt_id",$id)
		->get($this->tableClt)->row();
	}
	
	public function maj_client($donnees,$id){
		return $this->db->where("clt_id",$id)->update($this->tableClt,$donnees);
	}
	
	public function liste_client_pharmacie()
	{
		return $this->db
		->where("clt_iSta",1)
		->get($this->tableClt)->result();
	}	
	
	public function liste_bon_client($id)
	{
		return $this->db
		->where("bph_iSta",1)
		->where("clt_id",$id)
		->order_by("bph_id","desc")
		->get($this->tableBph)->result();
	}
	
	public function bilan_medicament_stock()
	{
		 
		return $this->db->select('med_id, COUNT(med_id) as total, SUM(ach_iPrixTotalAchat) as achat, SUM(ach_iQte) as quantite, SUM(ach_iPrixTotalVente) as vente')
				->group_by('med_id')
				->order_by('total', 'desc')
				->get($this->tableAch)->result();
	}	
		
	public function valuer_financiere_vente_stock()
	{
		 
		return $this->db->select('SUM(ach_iPrixTotalVente) as total')
				->get($this->tableAch)->row();
	}	
		
	public function somme_quantite_stock()
	{
		 
		return $this->db->select('SUM(ach_iQte) as total')
				->get($this->tableAch)->row();
	}	
	
	public function valuer_financiere_achat_stock()
	{
		 
		return $this->db->select('SUM(ach_iPrixTotalAchat) as total')
				->get($this->tableAch)->row();
	}	
	
	public function detail_recu($id)
	{
		return $this->db
		->where($this->tableFac.".fac_id",$id)
		->get($this->tableFac)->row();
	}

	public function liste_recu_caisse()
	{
		return $this->db
		// ->join($this->tablePat, $this->tablePat.'.pat_id ='.$this->tableFac.'.pat_id ','inner')
		->where("fac_sObjet","Vente médicament")
		->get($this->tableFac)->result();
	}
	
	
	public function element_facture($id)
	{
		return $this->db
		->join($this->tableAch, $this->tableAch.'.ach_id ='.$this->tableElf.'.ach_id ','inner')
		->join($this->tableMed, $this->tableAch.'.med_id ='.$this->tableMed.'.med_id ','inner')
		->join($this->tableFor, $this->tableFor.'.for_id='.$this->tableMed.'.for_id','inner')
		->join($this->tableFam, $this->tableFam.'.fam_id='.$this->tableMed.'.fam_id','inner')
		->join($this->tableCat, $this->tableCat.'.cat_id='.$this->tableMed.'.cat_id','inner')
		->where($this->tableElf.".fac_id",$id)
		->get($this->tableElf)->result();
	}	
	
	
	
	public function ajout_produit_stock($donnees){
		return $this->db->insert($this->tablePro,$donnees);
	}	
	
	public function ajout_destockage($donnees){
		return $this->db->insert($this->tableDes,$donnees);
	}	
	
	public function maj_vente($id,$data){
		return $this->db->where('ach_id',$id)->update($this->tableAch,$data);
	}	
	
	public function supprime_achat($id){
		return $this->db->where('ach_id',$id)->delete($this->tableAch);
	}
	
	public function liste_produit_sorties()
	{
		return $this->db
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableDes.'.med_id','inner')
		->join($this->tableFor, $this->tableFor.'.for_id='.$this->tableMed.'.for_id','inner')
		->get($this->tableDes)->result();
	}		
	
	public function liste_produit_destock()
	{
		return $this->db
		->join($this->tableAch, $this->tableAch.'.ach_id='.$this->tablePro.'.ach_id','inner')
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->where($this->tablePro.".pro_iSta",2)
		->get($this->tablePro)->result();
	}		
	
	public function liste_produit_perimes($date)
	{
		return $this->db
		->join($this->tableAch, $this->tableAch.'.ach_id='.$this->tablePro.'.ach_id','inner')
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->where($this->tablePro.".pro_dDateExpir <=",$date)
		->where($this->tablePro.".pro_iSta",1)
		->get($this->tablePro)->result();
	}		
	
	
	public function produit_perime($date,$id)
	{
		return $this->db
		->where("pro_dDateExpir <=",$date)
		->where("pro_id",$id)
		->get($this->tablePro)->row();
	}	

		
	public function destock_produit($data, $id){
		return $this->db->where("pro_id",$id)->update($this->tablePro,$data);
	}	
	
	public function destock_perimes($date,$data){
		return $this->db->where("pro_dDateExpir <=",$date)->update($this->tablePro,$data);
	}
	
	public function liste_salle_actifs()
	{
		return $this->db
		->where("sal_iSta",1)
		->order_by("sal_sLibelle","asc")
		->get($this->tableSal)->result();
	}	
	
	public function liste_salle_pharmacie_actifs()
	{
		return $this->db
		->where("sal_iSta",1)
		->where("sal_iType",1)
		->order_by("sal_sLibelle","asc")
		->get($this->tableSal)->result();
	}	
	
	public function liste_armoire_actifs()
	{
		return $this->db
		->where("arm_iSta",1)
		->order_by("arm_sLibelle","asc")
		->get($this->tableArm)->result();
	}	
	
	public function liste_cellule_actifs()
	{
		return $this->db
		->where("cel_iSta",1)
		->order_by("cel_sLibelle","asc")
		->get($this->tableCel)->result();
	}
	
	public function liste_entrees()
	{
		return $this->db
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->get($this->tableAch)->result();
	}		
	public function liste_entrees_code()
	{
		return $this->db
		->join($this->tableAch, $this->tableAch.'.ach_id='.$this->tablePro.'.ach_id','inner')
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->where($this->tablePro.".pro_iSta",1)
		->get($this->tablePro)->result();
	}	
	
	
	public function produit_code($code)
	{
		return $this->db
		->join($this->tableAch, $this->tableAch.'.ach_id='.$this->tablePro.'.ach_id','inner')
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->where($this->tablePro.".pro_iSta",1)
		->where($this->tablePro.".pro_sCodeBarre",$code)
		->get($this->tablePro)->row();
	}
	
	
	public function recup_bon($bon)
	{
		return $this->db
		->where("bph_iSta",1)
		->where("bph_sNumBon",$bon)
		->get($this->tableBph)->row();
	}
	
	public function produit_en_stock($id)
	{
		return $this->db
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->where($this->tableAch.".ach_id",$id)
		->get($this->tableAch)->row();
	}
	
	public function verif_achat($med)
	{
		return $this->db
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->where($this->tableAch.".med_id",$med)
		->get($this->tableAch)->row();
	}
	
	
	public function somme_produit($id)
	{
		return $this->db
		->select("SUM(ach.ach_iQte) AS somme, med.med_id,ach.ach_iPrixAchat,ach.ach_iPrixVente,ach.ach_iSeuil,ach.ach_dDateAchat,ach.ach_dDateExpir")
		->join($this->tableAch." ach", 'med.med_id='.'ach.med_id','inner')
		->where("med.med_id",$id)
		->get($this->tableMed." med")->row();
	}
	
	
	public function ajout_produit($donnees){
		return $this->db->insert($this->tableMed,$donnees);
	}		
	
		
	public function ajout_detail_commande($donnees){
		return $this->db->insert($this->tableDcm,$donnees);
	}		
	
			
	public function verif_commande($med,$cmd){
		return $this->db->where("med_id",$med)->where("cmd_id",$cmd)->get($this->tableDcm)->row();
	}		
	
			
	public function maj_detail_commande($donnees,$cmd){
		return $this->db->where("dcm_id",$cmd)->update($this->tableDcm,$donnees);
	}		
	
	
	public function maj_entree($donnees,$id){
		return $this->db->where("ach_id",$id)->update($this->tableAch,$donnees);
	}
	
	public function entree_stock($donnees){
		$this->db->insert($this->tableAch,$donnees);
		return $this->db
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->order_by($this->tableAch.".ach_id","desc")
		->get($this->tableAch)->row();
	}	
	
	public function entree_detail_stock($donnees){
		return $this->db->insert($this->tableDac,$donnees);
	}	
		
	public function maj_entree_stock($donnees,$id){
		return $this->db->where("ach_id",$id)->update($this->tableAch,$donnees);
	}	
	
	public function verif_produit($nc, $cat, $fam, $fors, $dos, $uni){
		return $this->db
		->where($this->tableMed.".med_sNc",$nc)
		->where($this->tableMed.".cat_id",$cat)
		->where($this->tableMed.".fam_id",$fam)
		->where($this->tableMed.".for_id",$fors)
		->where($this->tableMed.".med_iDosage",$dos)
		->where($this->tableMed.".med_sUnite",$uni)
		->get($this->tableMed)->row();
	}

	public function verif_produit_modif($nc, $cat, $fam, $fors, $dos, $uni, $id){
		return $this->db
		->where($this->tableMed.".med_sNc",$nc)
		->where($this->tableMed.".cat_id",$cat)
		->where($this->tableMed.".fam_id",$fam)
		->where($this->tableMed.".for_id",$fors)
		->where($this->tableMed.".med_iDosage",$dos)
		->where($this->tableMed.".med_sUnite",$uni)
		->where($this->tableMed.".med_id !=",$id)
		->get($this->tableMed)->row();
	}

	public function recup_produit($id)
	{
		return $this->db
		->join($this->tableCat, $this->tableMed.'.cat_id='.$this->tableCat.'.cat_id','inner')
		->join($this->tableFam, $this->tableMed.'.fam_id='.$this->tableFam.'.fam_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->where($this->tableMed.".med_id",$id)
		->get($this->tableMed)->row();
	}
	
	
	public function recup_entree($id)
	{
		return $this->db
		->join($this->tableCat, $this->tableMed.'.cat_id='.$this->tableCat.'.cat_id','inner')
		->join($this->tableFam, $this->tableMed.'.fam_id='.$this->tableFam.'.fam_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableAch, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->where($this->tableAch.".ach_id",$id)
		->get($this->tableMed)->row();
	}	
	
	
	public function liste_medicament()
	{
		return $this->db
		->join($this->tableCat, $this->tableMed.'.cat_id='.$this->tableCat.'.cat_id','inner')
		->join($this->tableFam, $this->tableMed.'.fam_id='.$this->tableFam.'.fam_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->where($this->tableMed.".med_iSta",1)
		->order_by($this->tableMed.".med_sNc","asc")
		->get($this->tableMed)->result();
	}	
	
	
	public function liste_medicament_actifs()
	{
		return $this->db
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableCat, $this->tableMed.'.cat_id='.$this->tableCat.'.cat_id','inner')
		->join($this->tableFam, $this->tableMed.'.fam_id='.$this->tableFam.'.fam_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->where($this->tableAch.".ach_iSta",1)
		->order_by($this->tableMed.".med_sNc","desc")
		->get($this->tableAch)->result();
	}
	
	public function recup_medicament_actifs($id)
	{
		return $this->db
		->join($this->tableMed, $this->tableMed.'.med_id='.$this->tableAch.'.med_id','inner')
		->join($this->tableCat, $this->tableMed.'.cat_id='.$this->tableCat.'.cat_id','inner')
		->join($this->tableFam, $this->tableMed.'.fam_id='.$this->tableFam.'.fam_id','inner')
		->join($this->tableFor, $this->tableMed.'.for_id='.$this->tableFor.'.for_id','inner')
		->join($this->tableCel, $this->tableAch.'.cel_id='.$this->tableCel.'.cel_id','inner')
		->join($this->tableArm, $this->tableCel.'.arm_id='.$this->tableArm.'.arm_id','inner')
		->join($this->tableSal, $this->tableArm.'.sal_id='.$this->tableSal.'.sal_id','inner')
		->where($this->tableAch.".ach_id",$id)
		->order_by($this->tableMed.".med_sNc","desc")
		->get($this->tableAch)->row();
	}
	
	
	
	public function verif_tel_client($tel){
		return $this->db->where("clt_sTel",$tel)->get($this->tableClt)->row();
	}
	
	public function verif_tel_client_modif($tel,$id){
		return $this->db->where("clt_sTel",$tel)->where("clt_id !=",$id)->get($this->tableClt)->row();
	}
	
	public function ajout_client($data){
		$this->db->insert($this->tableClt,$data);
		$recup = $this->db->order_by("clt_id","desc")->get($this->tableClt)->row();
		if(strlen($recup->clt_id)==1){
			$numero="CLT-00".$recup->clt_id."/".date("m-Y");
		}
		else if(strlen($recup->clt_id)==2){
			$numero="CLT-0".$recup->clt_id."/".date("m-Y");
		}
		else{
			$numero="CLT-".$recup->clt_id."/".date("m-Y");
		}
		
		$this->db->where("clt_id",$recup->clt_id)->update($this->tableClt,array("clt_sMatricule"=>$numero));
		return $this->db->where("clt_id",$recup->clt_id)->get($this->tableClt)->row();
	}
	
	public function ajout_bon_pharmacie($data){
		$this->db->insert($this->tableBph,$data);
		$recup = $this->db->order_by("bph_id","desc")->get($this->tableBph)->row();
		if(strlen($recup->bph_id)==1){
			$numero="BPH-00".$recup->bph_id."/".date("m-Y");
		}
		else if(strlen($recup->bph_id)==2){
			$numero="BPH-0".$recup->bph_id."/".date("m-Y");
		}
		else{
			$numero="BPH-".$recup->bph_id."/".date("m-Y");
		}
		
		$this->db->where("bph_id",$recup->bph_id)->update($this->tableBph,array("bph_sNumBon"=>$numero));
		return $this->db->where("bph_id",$recup->bph_id)->get($this->tableBph)->row();;
		
	}
	
	
	
	public function modifier_produit($data,$id){
		
		return $this->db->where("med_id",$id)->update($this->tableMed,$data);
		
	}
	
	public function cat_produit_courant($id)
	{
		return $this->db
		->where("cat_id",$id)
		->get($this->tableCat)->row();
	}	
	
	public function fam_produit_courant($id)
	{
		return $this->db
		->where("fam_id",$id)
		->get($this->tableFam)->row();
	}	
	
	public function for_produit_courant($id)
	{
		return $this->db
		->where("for_id",$id)
		->get($this->tableFor)->row();
	}
	
	public function maj_produit($donnees,$id){
		return $this->db->where("med_id",$id)->update($this->tableMed,$donnees);
	}
	
	/****** Fournisseur ************/
	
	public function maj_fournisseur($donnees,$id){
		return $this->db->where("frs_id",$id)->update($this->tableFrs,$donnees);
	}
	
	public function recup_fournisseur($id)
	{
		return $this->db
		->join($this->tablePay, $this->tablePay.'.pay_id='.$this->tableFrs.'.pay_id','inner')
		->join($this->tableVil, $this->tableVil.'.vil_id='.$this->tableFrs.'.vil_id','inner')
		->where($this->tableFrs.".frs_id",$id)
		->get($this->tableFrs)->row();
	}
	
	public function liste_fournisseur_actifs()
	{
		return $this->db
		->join($this->tablePay, $this->tablePay.'.pay_id='.$this->tableFrs.'.pay_id','inner')
		->join($this->tableVil, $this->tableVil.'.vil_id='.$this->tableFrs.'.vil_id','inner')
		->where("frs_iSta",1)
		->order_by("frs_id","desc")
		->get($this->tableFrs)->result();
	}	
	
	
	public function ajout_fournisseur($data){
		date_default_timezone_set('Africa/Brazzaville');
		$this->db->insert($this->tableFrs,$data);
		$frs = $this->db->order_by("frs_id","desc")->get($this->tableFrs)->row();
		if(strlen($frs->frs_id)==1){
			$matricule="FOUR-00".$frs->frs_id."/".date("m-Y");
		}
		else if(strlen($frs->frs_id)==2){
			$matricule="FOUR-0".$frs->frs_id."/".date("m-Y");
		}
		else{
			$matricule="FOUR-".$frs->frs_id."/".date("m-Y");
		}
		
		$this->db->where("frs_id",$frs->frs_id)->update($this->tableFrs,array("frs_sMatricule"=>$matricule));
		return $frs->frs_id;
	}	
	
	
	public function ajout_commande($data){
		$this->db->insert($this->tableCmd,$data);
		$cmd = $this->db->order_by("cmd_id","desc")->get($this->tableCmd)->row();
		if(strlen($cmd->cmd_id)==1){
			$matricule="BON-00".$cmd->cmd_id."/".date("m-Y");
		}
		else if(strlen($cmd->cmd_id)==2){
			$matricule="BON-0".$cmd->cmd_id."/".date("m-Y");
		}
		else{
			$matricule="BON-".$cmd->cmd_id."/".date("m-Y");
		}
		
		$this->db->where("cmd_id",$cmd->cmd_id)->update($this->tableCmd,array("cmd_sBonCmd"=>$matricule));
		return $cmd->cmd_id;
	}	
	
	public function modifier_fournisseur($data,$id){
		
		return $this->db->where("frs_id",$id)->update($this->tableFrs,$data);
		
	}
	
	public function verif_tel($tel)
	{
		return $this->db
		->where("frs_sTel_1",$tel)
		->get($this->tableFrs)->row();
	}		
	
	public function verif_tel_modif($tel,$id)
	{
		return $this->db
		->where("frs_sTel_1",$tel)
		->where("frs_id !=",$id)
		->get($this->tableFrs)->row();
	}	
	
	public function verif_mail($email)
	{
		return $this->db
		->where("frs_sEmail",$email)
		->get($this->tableFrs)->row();
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
		->where("pat_id",$patId)
		->get($this->tablePat)->row();
	}

	
	
	public function verif_tel_edit($tel,$id)
	{
		return $this->db
		->where("pat_sTel",$tel)
		->where("pat_id !=",$id)
		->get($this->tablePat)->row();
	}
	
		
}
