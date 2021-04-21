<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagerie extends CI_Controller {

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
		$this->load->view('app/page-imagerie-acte');
	}		
	
	public function clotures()
	{
		$this->load->view('app/page-imagerie-cloture');
	}	
	
	public function patient_en_examen($id)
	{
		$this->load->view('app/page-imagerie-patient',array("aci_id"=>$id));
	}
	
	public function ajoutCompteRendu(){
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		$config["upload_path"] =  './assets/images/imagerie/';
		$config["allowed_types"] = 'jpg|png|jpeg|pdf|docx|gif';
		$nomImage= time()."-".$_FILES["image"]["name"];
		$config["file_name"] = $nomImage; 
		$this->load->library('upload',$config);
		if($this->upload->do_upload("image")){
			$image=$this->upload->data();
			$photo="assets/images/imagerie/".$image['file_name'];
		}
		else{
			$photo=NULL;
		}
	
		$donnees = array(
			"aci_sCompteRendu"=>trim($data["compte"]),
			"aci_dDate"=>date("Y-m-d H:i:s"),
			"aci_iPer"=>$data["idPer"],
			"aci_sImage"=>$photo,
			"aci_iSta"=>2
		);
		
		$update = $this->md_patient->maj_acte_medical_imagerie($donnees,$data["id"]);
		echo "ok";
	}
	
	
}
