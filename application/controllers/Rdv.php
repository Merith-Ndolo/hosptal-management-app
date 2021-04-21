<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rdv extends CI_Controller {

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
	public function prendre()
	{
		$this->load->view('app/page-rdv');
	}
	
	public function listeRdv()
	{
		
		$this->load->view('app/page-Liste-rdv');
		
	}
	
	public function listeRdvAnnule()
	{
		
		$this->load->view('app/page-Liste-rdv-annuler');
		
	}
	
	public function listeRdvValide()
	{
		
		$this->load->view('app/page-Liste-rdv-valider');
		
	}
	
	public function mesRdv()
	{
		
		$this->load->view('app/page-gestion-rdv');
		
	}
	
	
	public function prendreRendezVous()
	{
		
		$data=$this->input->post();
		
		$dataDir=array(
			"dir_iSta"=>1,
			"dir_sNom "=>strtoupper(trim($data["nom"])),
			"dir_sPrenom"=>ucfirst(trim($data["prenom"])),
			"dir_sDestinataire"=>$data["vous_etes"],
			"dir_dDateEn"=>date("Y-m-d H:i:s"),
			"dir_dDate"=>$this->md_config->recupDateTime($data["date_rdv"]),
			"dir_tHeure"=>$data["heure_rdv"],
			"per_id"=>$this->session->medicalis,
			"dir_sObjet"=>strtoupper(trim($data["objet"]))
		);	
		$this->md_rdv->insert_rendez_vous($dataDir);
		echo "Rendez-vous enregistré!";
		
			
	}
	
	
	public function annulerRdv($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("rdv/listeRdv");
		}
		else{
			$donnees = array(
				"dir_iSta"=>2
			);
			$supprimer = $this->md_rdv->maj_rdv($donnees,$id);
				return redirect("rdv/listeRdv");
		}
	}
		
	public function validerRdv($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("rdv/listeRdv");
		}
		else{
			$donnees = array(
				"dir_iSta"=>0,
				"dir_tHeure_arrive"=>date("H:i:s")
			);
			$supprimer = $this->md_rdv->maj_rdv($donnees,$id);
				return redirect("rdv/listeRdv");
		}
	}
	
}
?>