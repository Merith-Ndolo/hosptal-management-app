<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corbeille extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('app/page-corbeille');
	}
	
	public function client()
	{
		$this->load->view('app/page-corbeille-client');
	}		
	
	public function famille_produit()
	{
		$this->load->view('app/page-corbeille-famille-produit');
	}	
	
	public function type_fournisseur()
	{
		$this->load->view('app/page-corbeille-type-fournisseur');
	}	
	
	public function categorie_produit()
	{
		$this->load->view('app/page-corbeille-categorie-produit');
	}	
	
	public function forme_produit()
	{
		$this->load->view('app/page-corbeille-forme-produit');
	}		
	
	public function salle()
	{
		$this->load->view('app/page-corbeille-salle');
	}	
	
	public function armoire()
	{
		$this->load->view('app/page-corbeille-armoire');
	}		
	
	public function fournisseur()
	{
		$this->load->view('app/page-corbeille-fournisseur');
	}	
	
	
	public function employe()
	{
		$this->load->view('app/page-corbeille-employe');
	}
	
	public function assureur()
	{
		$this->load->view('app/page-corbeille-assureurs');
	}
	
	public function patient()
	{
		$this->load->view('app/page-corbeille-patient');
	}
	
	public function personnel()
	{
		$this->load->view('app/page-corbeille-personnel');
	}
	
	public function direction()
	{
		$this->load->view('app/page-corbeille-departement');
	}
	
	
	public function service()
	{
		$this->load->view('app/page-corbeille-service');
	}
	
	
	public function unite()
	{
		$this->load->view('app/page-corbeille-unite');
	}
	
	
	public function domaine()
	{
		$this->load->view('app/page-corbeille-domaine');
	}
	
	
	public function specialite()
	{
		$this->load->view('app/page-corbeille-specialite');
	}
	
	
	public function poste()
	{
		$this->load->view('app/page-corbeille-poste');
	}
	
	public function acte_medical()
	{
		$this->load->view('app/page-corbeille-act-medical');
	}
	
	public function type_couverture()
	{
		$this->load->view('app/page-corbeille-type-couverture-assurance');
	}
	
	
	/*********************************************************************/
	public function restaure_direction($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/direction");
		}
		else{
			$donnees = array(
				"fct_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_fonction($donnees,$id);
			$fonction = $this->md_parametre->recup_fonction($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_departement_dep",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré une direction",
					"log_sActionDetail"=>"a restauré la direction : <strong style='text-decoration:underline'>".$fonction->fct_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/direction");
			}
		}
	}
	
	
	public function restaure_fonction($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/poste");
		}
		else{
			$donnees = array(
				"fct_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_fonction($donnees,$id);
			$fonction = $this->md_parametre->recup_fonction($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_fonctions_fct",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un poste",
					"log_sActionDetail"=>"a restauré le poste : <strong style='text-decoration:underline'>".$fonction->fct_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/poste");
			}
		}
	}
	
	
	public function restaure_specialite($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/specialite");
		}
		else{
			$donnees = array(
				"spt_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_specialite($donnees,$id);
			$specialite = $this->md_parametre->recup_specialite($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_specialites_spt",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré une spécialité",
					"log_sActionDetail"=>"a restauré la spécialité : <strong style='text-decoration:underline'>".$specialite->spt_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/specialite");
			}
		}
	}
	
	
	public function restaure_domaine($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/domaine");
		}
		else{
			$donnees = array(
				"pst_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_poste($donnees,$id);
			$poste = $this->md_parametre->recup_poste($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_postes_pst",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un domaine",
					"log_sActionDetail"=>"a restauré le domaine : <strong style='text-decoration:underline'>".$poste->pst_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/domaine");
			}
		}
	}
	
	
	public function restaure_unite($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/unite");
		}
		else{
			$donnees = array(
				"uni_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_unite($donnees,$id);
			$unite = $this->md_parametre->recup_unite($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_unite_uni",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré une unite",
					"log_sActionDetail"=>"a restauré l'unite : <strong style='text-decoration:underline'>".$unite->uni_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/unite");
			}
		}
	}
	
	
	public function restaure_service($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/service");
		}
		else{
			$donnees = array(
				"ser_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_service($donnees,$id);
			$service = $this->md_parametre->recup_service($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_services_ser",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un service",
					"log_sActionDetail"=>"a restauré le service : <strong style='text-decoration:underline'>".$service->ser_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/service");
			}
		}
	}
	
	public function restaure_patient($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/patient");
		}
		else{
			$donnees = array(
				"pat_iSta"=>1
			);
			$supprimer = $this->md_patient->maj_patient($donnees,$id);
			$patient = $this->md_patient->recup_patient($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_patients_pat",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un patient",
					"log_sActionDetail"=>"a restauré le patient : <strong style='text-decoration:underline'>".$patient->pat_sNom." ".$patient->pat_sPrenom." (".$patient->pat_sMatricule.")</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/patient");
			}
		}
	}
	
	
	public function restaure_act($id){
		if(!isset($id)){
			return redirect("corbeille/acte_medical");
		}
		else{
			$donnees = array(
				"lac_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_act($donnees,$id);
			$act = $this->md_parametre->recup_act($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_liste_act_lac",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un acte médical",
					"log_sActionDetail"=>"a restauré l'acte médical : <strong style='text-decoration:underline'>".$act->lac_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/acte_medical");
			}
		}
	}
	
	
	public function restaure_assureur($id){
		if(!isset($id)){
			return redirect("corbeille/assureur");
		}
		else{
			$donnees = array(
				"ass_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_assureur($donnees,$id);
			$assureur = $this->md_parametre->recup_assureur($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_assureurs_ass",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un assureur",
					"log_sActionDetail"=>"a restauré l'assureur : <strong style='text-decoration:underline'>".$assureur->ass_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/assureur");
			}
		}
	}
	
	
	public function restaure_type_assurance($id){
		if(!isset($id)){
			return redirect("corbeille/type_couverture");
		}
		else{
			$donnees = array(
				"tas_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_type_assurance($donnees,$id);
			$type = $this->md_parametre->recup_type_assurance($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_type_assurance_tas",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un un type d'assurance",
					"log_sActionDetail"=>"a restauré le type d'assureur : <strong style='text-decoration:underline'>".$type->tas_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/type_couverture");
			}
		}
	}
	
	
	
	public function restaure_personnel($id){
		if(!isset($id)){
			return redirect("corbeille/personnel");
		}
		else{
			$donnees = array(
				"per_iSta"=>1
			);
			$restaure = $this->md_personnel->modifier_personnel($donnees,$id);
			$per = $this->md_personnel->recup_personnel($id);
			if($restaure){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_personnel_per",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un employé",
					"log_sActionDetail"=>"a restauré un membre du personnel : ".$per->per_sNom." ".$per->per_sPrenom,
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/personnel");
			}
		}
	}
	
	
	
	public function restaure_categorie_produit($id){
		if(!isset($id)){
			return redirect("corbeille/categorie_produit");
		}
		else{
			$donnees = array(
				"cat_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_categorie_produit($donnees,$id);
			$type = $this->md_parametre->recup_categorie_produit($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_categories_cat",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré une catégorie",
					"log_sActionDetail"=>"a restauré une catégorie de produits : <strong style='text-decoration:underline'>".$type->cat_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/categorie_produit");
			}
		}
	}
	
	
		public function restaure_famille_produit($id){
		if(!isset($id)){
			return redirect("corbeille/famille_produit");
		}
		else{
			$donnees = array(
				"fam_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_famille_produit($donnees,$id);
			$type = $this->md_parametre->recup_famille_produit($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_famille_cat",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré une famille",
					"log_sActionDetail"=>"a restauré une famille de produits : <strong style='text-decoration:underline'>".$type->fam_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/famille_produit");
			}
		}
	}

	
		public function restaure_forme_produit($id){
		if(!isset($id)){
			return redirect("corbeille/forme_produit");
		}
		else{
			$donnees = array(
				"for_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_forme_produit($donnees,$id);
			$type = $this->md_parametre->recup_forme_produit($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_forme_for",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré une forme",
					"log_sActionDetail"=>"a restauré une forme de produits : <strong style='text-decoration:underline'>".$type->for_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/forme_produit");
			}
		}
	}		
	
	
	public function restaure_type_fournisseur($id){
		if(!isset($id)){
			return redirect("corbeille/type_fournisseur");
		}
		else{
			$donnees = array(
				"tfr_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_type_fournisseur($donnees,$id);
			$type = $this->md_parametre->recup_type_fournisseur($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_type_fournisseur_tfr",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un type de fournisseur",
					"log_sActionDetail"=>"a restauré un type de fournisseur : <strong style='text-decoration:underline'>".$type->tfr_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/type_fournisseur");
			}
		}
	}	
	
	public function restaure_salle($id){
		if(!isset($id)){
			return redirect("corbeille/salle");
		}
		else{
			$donnees = array(
				"sal_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_salle($donnees,$id);
			$type = $this->md_parametre->recup_salle($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_salles_sal",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré une salle",
					"log_sActionDetail"=>"a restauré une salle : <strong style='text-decoration:underline'>".$type->sal_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/salle");
			}
		}
	}
	
	
	public function restaure_armoire($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/armoire");
		}
		else{
			$donnees = array(
				"arm_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_armoire($donnees,$id);
			$armoire = $this->md_parametre->recup_armoire($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_armoires_arm",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré une armoire",
					"log_sActionDetail"=>"a restauré l\'armoire : <strong style='text-decoration:underline'>".$armoire->arm_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/armoire");
			}
		}
	}	
	
	public function restaure_fournisseur($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/fournisseur");
		}
		else{
			$donnees = array(
				"frs_iSta"=>1
			);
			$supprimer = $this->md_parametre->maj_fournisseur($donnees,$id);
			$fournisseur = $this->md_parametre->recup_fournisseur($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_fournisseurs_frs",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un fournisseur",
					"log_sActionDetail"=>"a restauré le fournisseur : <strong style='text-decoration:underline'>".$fournisseur->frs_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/fournisseur");
			}
		}
	}


	public function restaure_client($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("corbeille/client");
		}
		else{
			$donnees = array(
				"clt_iSta"=>1
			);
			$supprimer = $this->md_pharmacie->maj_client($donnees,$id);
			$client = $this->md_pharmacie->recup_client($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_client_clt",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a restauré un client",
					"log_sActionDetail"=>"a restauré le client : <strong style='text-decoration:underline'>".$client->clt_sNom."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("corbeille/client");
			}
		}
	}
	
}
