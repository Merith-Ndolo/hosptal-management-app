<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

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
	public function nouveau()
	{
		$this->load->view('app/page-nouveau-patient');
	}
	
	
	public function liste()
	{
		$this->load->view('app/page-liste-patient');
	}
	
	
	public function complement($id)
	{
		$this->load->view('app/page-complement-patient',array("id"=>$id));
	}
	
	public function accueil($id)
	{
		$this->load->view('app/page-accueil-patient',array("id"=>$id));
	}
	
	public function voir($id)
	{
		$this->load->view('app/page-detail-patient',array("id"=>$id));
	}
	
	public function modifier($id)
	{
		$this->load->view('app/page-modifier-patient',array("id"=>$id));
	}
	
	
	public function ajoutPatient()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("patient/nouveau");
			// var_dump($data);
		}
		else{
			if(trim($data["prenom"]) == ""){
				$prenom=NULL;
			}
			else{
				$prenom=ucwords(trim($data["prenom"]));
			}
			
			if(trim($data["adresse"]) == ""){
				$adresse=NULL;
			}
			else{
				$adresse=trim($data["adresse"]);
			}
			
			if(trim($data["date_naiss"]) == ""){
				$date_naiss=NULL;
			}
			else{
				$date_naiss = $this->md_config->recupDateTime($data["date_naiss"]);
			}
			
			if(trim($data["profession"]) == ""){
				$data["profession"]=NULL;
			}
			
			if(trim($data["tel"]) !="" AND $_FILES["photo"]["name"]==""){
				if(!is_numeric($data["tel"])){
					echo "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone";
				}
				else{
					$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
					if($formatTel == false){
						echo "Ce numéro de téléphone n'est pas valable en république du Congo";
					}
					else{

						$verifPhone = $this->md_patient->verif_tel("+242".$formatTel);
						if(!$verifPhone){
								
							$donnees = array(
								"pat_iSta"=>1,
								"pat_sNom"=>strtoupper(trim($data["nom"])),
								"pat_sPrenom"=>$prenom,
								"pat_sAdresse"=>$adresse,
								"pat_sSexe"=>$data["genre"],
								"pat_sTel"=>"+242".$formatTel,
								"pat_sCivilite"=>$data["civilite"],
								"pat_sSituationMat"=>$data["situation"],
								"pat_sProfession"=>ucfirst(trim($data["profession"])),
								"pat_dDateNaiss"=>$date_naiss,
								"pat_sAvatar"=>"assets/images/patients/inconnu.jpg",
								"pat_dDateEnreg"=>date("Y-m-d H:i:s")
							);
							$ajout=$this->md_patient->ajout_patient($donnees);
						}
						else{
							echo "Ce numéro de téléphone est déja enregistré pour un membre du personnel";
						}
						
					}
				}
					
				
			}
			else if(trim($data["tel"]) !="" AND $_FILES["photo"]["name"]!=""){
				if(!is_numeric($data["tel"])){
					echo "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone";
				}
				else{
					$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
					if($formatTel == false){
						echo "Ce numéro de téléphone n'est pas valable en république du Congo";
					}
					else{

						$verifPhone = $this->md_patient->verif_tel("+242".$formatTel);
						if(!$verifPhone){
							$verifTaille = $this->md_config->sizeImage($_FILES["photo"],150);
							if(!$verifTaille){
								echo "La taille de l'image ne doit pas dépasser les 150 Ko";
							}
							else{
								$config["upload_path"] =  './assets/images/patients/';
								$config["allowed_types"] = 'jpg|png|jpeg';
								$nomImage= time()."-".$_FILES["photo"]["name"];
								$config["file_name"] = $nomImage; 
								$verifImage = $this->md_config->uploadImage($_FILES["photo"]);
								
								if(!$verifImage){
									echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
								}
								else{
									$this->load->library('upload',$config);
								
									if($this->upload->do_upload("photo")){
										$image=$this->upload->data();
										$data["photo"]="assets/images/patients/".$image['file_name'];
									}
									else{
										$data["photo"]="assets/images/patients/inconnu.jpg";
									}

									$donnees = array(
										"pat_iSta"=>1,
										"pat_sNom"=>strtoupper(trim($data["nom"])),
										"pat_sPrenom"=>$prenom,
										"pat_sAdresse"=>$adresse,
										"pat_sSexe"=>$data["genre"],
										"pat_sAvatar"=>$data["photo"],
										"pat_sTel"=>"+242".$formatTel,
										"pat_sCivilite"=>$data["civilite"],
										"pat_sSituationMat"=>$data["situation"],
										"pat_sProfession"=>ucfirst(trim($data["profession"])),
										"pat_dDateNaiss"=>$date_naiss,
										"pat_sAvatar"=>$data["photo"],
										"pat_dDateEnreg"=>date("Y-m-d H:i:s")
									);
									$ajout=$this->md_patient->ajout_patient($donnees);
								}
							}
						}
						else{
							echo "Ce numéro de téléphone est déja enregistré pour un membre du personnel";
						}
						
					}
				}
	
			}
			else if(trim($data["tel"]) =="" AND $_FILES["photo"]["name"]!=""){

				$verifTaille = $this->md_config->sizeImage($_FILES["photo"],150);
				if(!$verifTaille){
					echo "La taille de l'image ne doit pas dépasser les 150 Ko";
				}
				else{
					$config["upload_path"] =  './assets/images/patients/';
					$config["allowed_types"] = 'jpg|png|jpeg';
					$nomImage= time()."-".$_FILES["photo"]["name"];
					$config["file_name"] = $nomImage; 
					$verifImage = $this->md_config->uploadImage($_FILES["photo"]);
					
					if(!$verifImage){
						echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
					}
					else{
						$this->load->library('upload',$config);
					
						if($this->upload->do_upload("photo")){
							$image=$this->upload->data();
							$data["photo"]="assets/images/patients/".$image['file_name'];
						}
						else{
							$data["photo"]="assets/images/patients/inconnu.jpg";
						}

						$donnees = array(
							"pat_iSta"=>1,
							"pat_sNom"=>strtoupper(trim($data["nom"])),
							"pat_sPrenom"=>$prenom,
							"pat_sAdresse"=>$adresse,
							"pat_sSexe"=>$data["genre"],
							"pat_sAvatar"=>$data["photo"],
							"pat_sCivilite"=>$data["civilite"],
							"pat_sSituationMat"=>$data["situation"],
							"pat_sProfession"=>ucfirst(trim($data["profession"])),
							"pat_dDateNaiss"=>$date_naiss,
							"pat_sAvatar"=>$data["photo"],
							"pat_dDateEnreg"=>date("Y-m-d H:i:s")
						);
						$ajout=$this->md_patient->ajout_patient($donnees);
					}
				}
						
			}
			else{
				$donnees = array(
					"pat_iSta"=>1,
					"pat_sNom"=>strtoupper(trim($data["nom"])),
					"pat_sPrenom"=>$prenom,
					"pat_sAdresse"=>$adresse,
					"pat_sSexe"=>$data["genre"],
					"pat_sCivilite"=>$data["civilite"],
					"pat_sSituationMat"=>$data["situation"],
					"pat_sProfession"=>ucfirst(trim($data["profession"])),
					"pat_dDateNaiss"=>$date_naiss,
					"pat_sAvatar"=>"assets/images/patients/inconnu.jpg",
					"pat_dDateEnreg"=>date("Y-m-d H:i:s")
				);
				$ajout=$this->md_patient->ajout_patient($donnees);	
			}
			
			if($ajout){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_patients_pat",
					"log_sIcone"=>"nouveau membre",
					"log_sAction"=>"a ajouté un nouveau patient : ".strtoupper(trim($data["nom"]))." ".$prenom,
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				echo $ajout;
			}
			
		}
	}
	
	
	public function modifierPatient()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("patient/liste");
			// var_dump($data);
		}
		else{
			if(trim($data["prenom"]) == ""){
				$prenom=NULL;
			}
			else{
				$prenom=ucwords(trim($data["prenom"]));
			}
			
			if(trim($data["adresse"]) == ""){
				$adresse=NULL;
			}
			else{
				$adresse=trim($data["adresse"]);
			}
			
			if(trim($data["date_naiss"]) == ""){
				$date_naiss=NULL;
			}
			else{
				$date_naiss = $this->md_config->recupDateTime($data["date_naiss"]);
			}
			
			if(trim($data["tel"]) !="" AND $_FILES["photo"]["name"]==""){
				if(!is_numeric($data["tel"])){
					echo "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone";
				}
				else{
					$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
					if($formatTel == false){
						echo "Ce numéro de téléphone n'est pas valable en république du Congo";
					}
					else{

						$verifPhone = $this->md_patient->verif_tel_edit("+242".$formatTel,$data["id"]);
						if(!$verifPhone){
								
							$donnees = array(
								"pat_sNom"=>strtoupper(trim($data["nom"])),
								"pat_sPrenom"=>$prenom,
								"pat_sAdresse"=>$adresse,
								"pat_sSexe"=>$data["genre"],
								"pat_sTel"=>"+242".$formatTel,
								"pat_sCivilite"=>$data["civilite"],
								"pat_sSituationMat"=>$data["situation"],
								"pat_sProfession"=>ucfirst(trim($data["profession"])),
								"pat_dDateNaiss"=>$date_naiss
							);
							$modifier=$this->md_patient->maj_patient($donnees,$data["id"]);
						}
						else{
							echo "Ce numéro de téléphone est déja enregistré pour un membre du personnel";
						}
						
					}
				}
					
				
			}
			else if(trim($data["tel"]) !="" AND $_FILES["photo"]["name"]!=""){
				if(!is_numeric($data["tel"])){
					echo "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone";
				}
				else{
					$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
					if($formatTel == false){
						echo "Ce numéro de téléphone n'est pas valable en république du Congo";
					}
					else{

						$verifPhone = $this->md_patient->verif_tel_edit("+242".$formatTel,$data["id"]);
						if(!$verifPhone){
							$verifTaille = $this->md_config->sizeImage($_FILES["photo"],150);
							if(!$verifTaille){
								echo "La taille de l'image ne doit pas dépasser les 150 Ko";
							}
							else{
								$config["upload_path"] =  './assets/images/patients/';
								$config["allowed_types"] = 'jpg|png|jpeg';
								$nomImage= time()."-".$_FILES["photo"]["name"];
								$config["file_name"] = $nomImage; 
								$verifImage = $this->md_config->uploadImage($_FILES["photo"]);
								
								if(!$verifImage){
									echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
								}
								else{
									$this->load->library('upload',$config);
								
									if($this->upload->do_upload("photo")){
										$image=$this->upload->data();
										$data["photo"]="assets/images/patients/".$image['file_name'];
									}
									else{
										$data["photo"]=$data["photo2"];
									}

									$donnees = array(
										"pat_sNom"=>strtoupper(trim($data["nom"])),
										"pat_sPrenom"=>$prenom,
										"pat_sAdresse"=>$adresse,
										"pat_sSexe"=>$data["genre"],
										"pat_sAvatar"=>$data["photo"],
										"pat_sTel"=>"+242".$formatTel,
										"pat_sCivilite"=>$data["civilite"],
										"pat_sSituationMat"=>$data["situation"],
										"pat_sProfession"=>ucfirst(trim($data["profession"])),
										"pat_dDateNaiss"=>$date_naiss,
										"pat_sAvatar"=>$data["photo"]
									);
									$modifier=$this->md_patient->maj_patient($donnees,$data["id"]);
								}
							}
						}
						else{
							echo "Ce numéro de téléphone est déja enregistré pour un membre du personnel";
						}
						
					}
				}
	
			}
			else if(trim($data["tel"]) =="" AND $_FILES["photo"]["name"]!=""){

				$verifTaille = $this->md_config->sizeImage($_FILES["photo"],150);
				if(!$verifTaille){
					echo "La taille de l'image ne doit pas dépasser les 150 Ko";
				}
				else{
					$config["upload_path"] =  './assets/images/patients/';
					$config["allowed_types"] = 'jpg|png|jpeg';
					$nomImage= time()."-".$_FILES["photo"]["name"];
					$config["file_name"] = $nomImage; 
					$verifImage = $this->md_config->uploadImage($_FILES["photo"]);
					
					if(!$verifImage){
						echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
					}
					else{
						$this->load->library('upload',$config);
					
						if($this->upload->do_upload("photo")){
							$image=$this->upload->data();
							$data["photo"]="assets/images/patients/".$image['file_name'];
						}
						else{
							$data["photo"]=$data["photo2"];
						}

						$donnees = array(
							"pat_sNom"=>strtoupper(trim($data["nom"])),
							"pat_sPrenom"=>$prenom,
							"pat_sAdresse"=>$adresse,
							"pat_sSexe"=>$data["genre"],
							"pat_sAvatar"=>$data["photo"],
							"pat_sCivilite"=>$data["civilite"],
							"pat_sSituationMat"=>$data["situation"],
							"pat_sProfession"=>ucfirst(trim($data["profession"])),
							"pat_dDateNaiss"=>$date_naiss,
							"pat_sAvatar"=>$data["photo"]
						);
						$modifier=$this->md_patient->maj_patient($donnees,$data["id"]);
					}
				}
						
			}
			else{
				$donnees = array(
					"pat_sNom"=>strtoupper(trim($data["nom"])),
					"pat_sPrenom"=>$prenom,
					"pat_sAdresse"=>$adresse,
					"pat_sSexe"=>$data["genre"],
					"pat_sCivilite"=>$data["civilite"],
					"pat_sSituationMat"=>$data["situation"],
					"pat_sProfession"=>ucfirst(trim($data["profession"])),
					"pat_dDateNaiss"=>$date_naiss
				);
				$modifier=$this->md_patient->maj_patient($donnees,$data["id"]);	
			}
			
			if($modifier){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_patients_pat",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a modifié le patient : ".strtoupper(trim($data["nom"]))." ".$prenom,
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				echo "ok";
			}
			
		}
	}
	
	
	
	public function ajoutOrientation(){
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("patient/liste");
		}
		else{
			$fait = date("Y-m-d H:i:s");
			$maDate = strtotime($fait."+ 30 days");
			$delai = date("Y-m-d H:i:s",$maDate). "\n";

			$donnees = array(
				"acm_iSta "=>1,
				"lac_id"=>$data["acte"],
				"pat_id"=>$data["id"],
				"per_id"=>$data["per"],
				"uni_id"=>$data["uni"],
				"acm_dDate"=>$fait,
				"acm_dDateDelai"=>$delai
			);
			$insert = $this->md_patient->ajout_orientation($donnees);
			$patient = $this->md_patient->recup_patient($data["id"]);
			$acte = $this->md_parametre->recup_act($data["acte"]);
			if($insert){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_acte_medical_acm",
					"log_sIcone"=>"nouveau membre",
					"log_sAction"=>"a fait une orientation",
					"log_sActionDetail"=>"a orienté le patient vers un acte médical payant : <strong style='text-decoration:underline'>".$patient->pat_sNom." ".$patient->pat_sPrenom." (".$patient->pat_sMatricule.") - ".$acte->lac_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				echo number_format($acte->lac_iCout,2,",","."); 
			}
		}
	}
	
	
	
	public function supprimer_patient($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("patient/liste");
		}
		else{
			$donnees = array(
				"pat_iSta"=>2
			);
			$supprimer = $this->md_patient->maj_patient($donnees,$id);
			$patient = $this->md_patient->recup_patient($id);
			if($supprimer){
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
				return redirect("patient/liste");
			}
		}
	}
	
	
	public function ajoutComplement()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("patient/complement");
		}
		else{
			$patient = $this->md_patient->recup_patient($data["id"]);
			if($data["confirmAnt"]=="Oui"){
				for($i=0;$i<count($data['libAnt']) AND $i<count($data['typeAnt']);$i++){
					$verif = $this->md_patient->verif_antecedents(ucfirst(trim($data['libAnt'][$i])),$data['typeAnt'][$i],$data["id"]);
					if(!$verif){
						$donnees = array(
						"ant_sType"=>$data['typeAnt'][$i],
						"ant_sLibelle"=>ucfirst(trim($data['libAnt'][$i])),
						"pat_id"=>$data["id"],
						"ant_iSta"=>1
						);
						$this->md_patient->ajout_antecedents($donnees);
						$log = array(
							"log_iSta"=>0,
							"per_id"=>$this->session->medicalis,
							"log_sTable"=>"t_antecedants_ant",
							"log_sIcone"=>"nouveau membre",
							"log_sAction"=>"a ajouté un antécédent médical",
							"log_sActionDetail"=>"a ajouté un antécédent médical : <strong style='text-decoration:underline'>".ucfirst(trim($data['libAnt'][$i])).", de type : ".$data['typeAnt'][$i]." au patient ".$patient->pat_sNom." ".$patient->pat_sPrenom." (".$patient->pat_sMatricule.")</strong>",
							"log_dDate"=>date("Y-m-d H:i:s")
						);
						$this->md_connexion->rapport($log);
					}
				}
			}
			
			if($data["confirmAll"]=="Oui"){
				for($i=0;$i<count($data['libAll']) AND $i<count($data['typeAll']);$i++){
					$verif = $this->md_patient->verif_allergies(ucfirst(trim($data['libAll'][$i])),$data['typeAll'][$i],$data["id"]);
					if(!$verif){
						$donnees = array(
						"tal_id"=>$data['typeAll'][$i],
						"all_sLibelle"=>ucfirst(trim($data['libAll'][$i])),
						"pat_id"=>$data["id"],
						"all_iSta"=>1
						);
						$this->md_patient->ajout_allergies($donnees);
						$log = array(
							"log_iSta"=>0,
							"per_id"=>$this->session->medicalis,
							"log_sTable"=>"t_allergies_all",
							"log_sIcone"=>"nouveau membre",
							"log_sAction"=>"a ajouté une allergie",
							"log_sActionDetail"=>"a ajouté une allergie : <strong style='text-decoration:underline'>".ucfirst(trim($data['libAll'][$i])).", de type : ".$data['typeAll'][$i]." au patient ".$patient->pat_sNom." ".$patient->pat_sPrenom." (".$patient->pat_sMatricule.")</strong>",
							"log_dDate"=>date("Y-m-d H:i:s")
						);
						$this->md_connexion->rapport($log);
					}
				}
			}
			
			if($data["confirmPer"]=="Oui"){
				for($i=0;$i<count($data['nom']) AND $i<count($data['lien']) AND count($data['adresse']) AND $i<count($data['prenom'])  AND $i<count($data['tel']);$i++){
					// à  revoir
					$donnees = array(
					"pec_sAdresse"=>trim($data['adresse'][$i]),
					"pec_sTelephone"=>$data["tel"][$i],
					"pec_sLien"=>ucfirst(trim($data['lien'][$i])),
					"pec_sPrenom"=>ucfirst(trim($data['prenom'][$i])),
					"pec_sNom"=>strtoupper(trim($data['nom'][$i])),
					"pat_id"=>$data["id"],
					"pec_iSta "=>1
					);
					$this->md_patient->ajout_personnes_contact($donnees);
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_personnes_contacts_pec",
						"log_sIcone"=>"nouveau membre",
						"log_sAction"=>"a ajouté un contact pour le patient",
						"log_sActionDetail"=>"a ajouté une personne à  contacter en cas de problème : <strong style='text-decoration:underline'>".strtoupper(trim($data['nom'][$i]))." ".ucfirst(trim($data['prenom'][$i]))." - : ".$data['tel'][$i]." pour le patient ".$patient->pat_sNom." ".$patient->pat_sPrenom." (".$patient->pat_sMatricule.")</strong>",
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
				}
			}

			echo "ok";
			
		}
	
	}
	
	
	

	
	
}
