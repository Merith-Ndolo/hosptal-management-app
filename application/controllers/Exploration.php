<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exploration extends CI_Controller {

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
	public function acte_recu()
	{
		$this->load->view('app/page-exploration-acte');
	}		
	
	public function clotures()
	{
		$this->load->view('app/page-exploration-cloture');
	}	
	
	public function patient_en_examen($id)
	{
		$this->load->view('app/page-exploration-patient',array("aef_id"=>$id));
	}
	
	public function ajoutCompteRendu(){
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		$config["upload_path"] =  './assets/images/exploration/';
		$config["allowed_types"] = 'jpg|png|jpeg|pdf|docx|gif';
		$nomImage= time()."-".$_FILES["image"]["name"];
		$config["file_name"] = $nomImage; 
		$this->load->library('upload',$config);
		if($this->upload->do_upload("image")){
			$image=$this->upload->data();
			$photo="assets/images/exploration/".$image['file_name'];
		}
		else{
			$photo=NULL;
		}
	
		$donnees = array(
			"aef_sCompteRendu"=>trim($data["compte"]),
			"aef_dDate"=>date("Y-m-d H:i:s"),
			"aef_iPer"=>$data["idPer"],
			"aef_sImage"=>$photo,
			"aef_iSta"=>2
		);
		
		$update = $this->md_patient->maj_acte_medical_exploration($donnees,$data["id"]);
		echo "ok";
	}
	
	
}
