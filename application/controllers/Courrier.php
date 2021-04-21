<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courrier extends CI_Controller {

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

	public function ajoutTypeCourrier()
	{
		
		$data=$this->input->post();
		$verif1=$this->md_courrier->verif_types_courrier(ucfirst(trim($data['titre'])));
		// var_dump($verif1);
		if(!$verif1){
			$dataTco=array(
				"tco_iSta"=>1,
				"tco_sType"=>ucfirst(trim($data['titre'])),
				"tco_sContenu"=>($data['contenu'])
				
			);
			
			$types_courrier=$this->md_courrier->insert_types_courrier($dataTco);
			echo "Type de courrier enregistrée!";
		}
			
	}
	
	public function ajoutCourrierSortant()
	{
		
		$data=$this->input->post();
		// var_dump($verif1);
			
			if($data["type"]=="autre"){
				$autre = ucfirst(trim($data['autreType']));
				$type=NULL;
			}
			else{
				$autre=NULL;
				$type=$data["type"];
			}
			$dataTcs=array(
				"tcs_iSta"=>1,
				"tcs_sExpediteur"=>ucfirst(trim($data['expediteur'])),
				"tcs_sDestinataire"=>ucfirst(trim($data['beneficiaire'])),
				"tco_id"=>$type,
				"tcs_sAutreType"=>$autre,
				"tcs_dDate"=>date("Y-m-d H:i:s"),
				"tcs_sContenu"=>$data['contenu']
				
			);
			
			$nouveau_courrier=$this->md_courrier->insert_courrier_sortant($dataTcs);
			echo "Nouveau courrier enregistrée!";
		
			
	}
	
	
	public function ajoutCourrier()
	{
		$data=$this->input->post();
		$verif1=$this->md_courrier->verif_courrier(ucfirst(trim($data['expediteur'])));
		// var_dump($verif1);
		if(!$verif1){
		
			$config["upload_path"] =  './assets/courrier/entrant/';
			$config["allowed_types"] = 'gif|jpg|png|jpeg|txt|pdf';
			$config["overwrite"] = TRUE;
			$nomFichier= $this->md_config->forUrl(time()."_".$_FILES["contenu"]["name"]);
			$config["file_name"] = $nomFichier; 
			
			$this->load->library('upload',$config);
			
			if($this->upload->do_upload("contenu")){
				$tce_sContenu=$this->upload->data();
				$image='assets/courrier/entrant/'.$tce_sContenu['file_name'];
			}
			
			$dataTce=array(
				"tce_iSta"=>1,
				"tce_sEnvoyeur"=>ucfirst(trim($data['expediteur'])),
				"tce_sDestinataire"=>ucfirst(trim($data['beneficiaire'])),
				"tce_sObjet"=>ucfirst(trim($data['objet'])),
				"tce_dDate"=>date("Y-m-d H:i:s"),
				"tce_sContenu"=>$image
			);
			$ajout_courrier=$this->md_courrier->insert_courrier($dataTce);
			echo " Courrier ajouté!";
		}
			
	}
	
	public function supprimer_type_courrier($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("parametre/type_courrier");
		}
		else{
			$donnees = array(
				"tco_iSta"=>2
			);
			$supprimer = $this->md_courrier->maj_courrier($donnees,$id);
				return redirect("parametre/type_courrier");
		}
	}
	
	public function archiver_courrier_entrant($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("courrier/courrierEntrant");
		}
		else{
			$donnees = array(
				"tce_iSta"=>3
			);
			$supprimer = $this->md_courrier->maj_courrier_entrant($donnees,$id);
				return redirect("courrier/courrierEntrant");
		}
	}
	
	public function modifier_courrier($id)
	{
		$this->load->view('app/modification_courrier');
		
	}
	
	public function recupCourrier()
	{
		$data=$this->input->post();
		$id=$data["id"];
		$recup=$this->md_courrier->recup_types_courrier($id);
		// var_dump($recup);
		echo '<form id="form-edit-tco">
			<div class="col-sm-12 retour"></div>
			<div class="row clearfix">
				
				<div class="col-sm-12">
					
					<div class="row clearfix" id="riverain">
						<div class="col-sm-12">
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="titre" class="form-control obligatoire" placeholder="titre *" value="'.$recup->tco_sType.'">
									<input type="hidden" name="id" value="'.$recup->tco_id.'">
								</div>
							</div>
						</div>
						<div class="col-sm-12">
						<label>Contenu du modèle</label>
							<textarea id="edit'.$id.'" name="contenu" class="form-control obligatoire">'.$recup->tco_sContenu.'</textarea>
						
						</div>
					</div>
					
				</div>
			</div>
		</form>';
		
		
		
		echo " <script>
				(function () {
				   new FroalaEditor('#edit".$id."');
				})()
			  </script>";
	}
	
	public function recupCourrierEnvoye()
	{
		$data=$this->input->post();
		$id=$data["id"];
		$recup=$this->md_courrier->recup_courrier_sortant_envoye($id);
		// var_dump($recup);
		echo '<form id="form-edit-tcs">
			<div class="col-sm-12 retour"></div>
			<div class="row clearfix">
				
				<div class="col-sm-12">
					
					<div class="row clearfix">
						<div class="col-sm-12">
							<div class="form-group">
								<div class="form-line">';
								
									if(is_null($recup->tco_sType)) {
										echo '<input type="text" name="titre" class="form-control obligatoire" placeholder="titre *" value="'.$recup->tcs_sAutreType.'">';
									 }
									 else
									{ 
										echo '<input type="text" name="titre" class="form-control obligatoire" placeholder="titre *" value="'.$recup->tco_sType.'">';
									}
							
									echo '<input type="hidden" name="id" value="'.$recup->tcs_id.'">
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<label>Contenu du modèle</label>
							<textarea id="edit'.$id.'" name="contenu" class="form-control obligatoire">'.$recup->tcs_sContenu.'</textarea>
						
						</div>
					</div>
					
				</div>
			</div>
		</form>';

		echo " <script>
				(function () {
				   new FroalaEditor('#edit".$id."');
				})()
			  </script>";
	}
	
	public function editTypeCourrier()
	{
		
		$data=$this->input->post();
		$verif1=$this->md_courrier->verif_types_courrier_modif(ucfirst(trim($data['titre'])),$data['id']);
		// var_dump($verif1);
		if(!$verif1){
			$dataTco=array(
				"tco_sType"=>ucfirst(trim($data['titre'])),
				"tco_sContenu"=>$data['contenu']
				
			);
			
			$types_courrier=$this->md_courrier->modification_courrier($dataTco,$data['id']);
			echo "Modification enregistrée!";
		}
			
	}
	
	public function courrierEntrant()
	{
		$this->load->view('app/page-courrier-entrant');
	}
	
	public function archivage()
	{
		$this->load->view('app/page-archive-courrier');
	}
	
	public function courrierSortant()
	{
		$this->load->view('app/page-courrier-sortant');
	}
	
	
	
	public function exempleContenuType()
	{
		$data = $this->input->post();
		// var_dump($data);
				$choixType = $this->md_parametre->liste_types_courrier($data['idType']);
				foreach($hoixType as $key=>$resultat){
					echo "<textarea>".$resultat->tco_id." ".$resultat->tco_sContenu."</textarea>";
		     	}

		
	}
	
	public function nouveauCourrier()
	{
		$this->load->view('app/page-courrier-nouveau');
	}
	
	public function listeTypeCourrier()
	{
		$data = $this->input->post();
		$id=$data["id"];
		if($id!= "autre"){
		$recup=$this->md_courrier->recup_types_courrier($id);
		echo'<label>Contenu du courrier</label>';
			echo '<textarea id="edit'.$id.'" name="contenu" class="form-control obligatoire">'.$recup->tco_sContenu.'</textarea>';
				echo " <script>
				(function () {
				   new FroalaEditor('#edit".$id."');
				})()
			  </script>";
	
			 }else {
				 	echo'<label>Contenu du courrier</label>';
			echo '<textarea id="edit'.$id.'" name="contenu" class="form-control obligatoire"></textarea>';
				echo " <script>
				(function () {
				   new FroalaEditor('#edit".$id."');
				})()
			  </script>";
			 }
			  

	}
	
	public function editCourrierEnvoye()
	{
		$data=$this->input->post();
		// var_dump($verif1)
			$dataTcs=array(
				"tcs_iSta"=>0,
				"tcs_sContenu"=>$data['contenu']	
			);
			$correction_courrier=$this->md_courrier->corriger_courrier_envoye($dataTcs,$data['id']);
			echo "Modification enregistrée!";
			
	}
	
	
}
?>






