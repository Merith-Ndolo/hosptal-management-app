<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infirmerie extends CI_Controller {

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
	public function assignation()
	{
		$this->load->view('app/page-infirmerie-assignation');
	}		
	
	public function patient_traite()
	{
		$this->load->view('app/page-infirmerie-traite');
	}	
	
	public function patient_assigne($id)
	{
		$this->load->view('app/page-patient-assigne',array("soi_id"=>$id));
	}
	
	public function traiter(){
		date_default_timezone_set('Africa/Brazzaville');
			
			$data = $this->input->post();
			
			if($data['textarea']==""){
				$text = NULL;
			}else{
				$text = $data['textarea'];
			}
			
			$donnees = array(
				"soi_iSta"=>2,
				"soi_sObservation"=>$data['textarea'],
				"soi_iPersonnel"=>$data['idPer'],
				"soi_dDateFait"=>date("Y-m-d H:i:s")
			);
			$update = $this->md_patient->maj_assignation($donnees,$data['id']);
			$patient = $this->md_patient->recup_patient($id);
			if($update){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_patients_pat",
					"log_sIcone"=>"suppression",
					"log_sAction"=>"a supprimé un patient",
					"log_sActionDetail"=>"a supprimé le patient : <strong style='text-decoration:underline'>".$patient->pat_sNom." ".$patient->pat_sPrenom." (".$patient->pat_sMatricule.")</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				echo "ok";
			}
		}
	
	
}
