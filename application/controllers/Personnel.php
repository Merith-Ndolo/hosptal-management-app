<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personnel extends CI_Controller {

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
		$this->load->view('app/page-nouveau-personnel');
	}
	
	
	public function liste()
	{
		$this->load->view('app/page-liste-personnel');
	}
	
	
	public function tout()
	{
		$this->load->view('app/page-liste-personnel-complet');
	}
	
	
	
	public function direction()
	{
		$this->load->view('app/page-affectation-direction');
	}
	
	
	public function service($id)
	{
		$this->load->view('app/page-affectation-service',array("direction"=>$id));
	}
	
	public function unite($id)
	{
		$this->load->view('app/page-affectation-unite',array("service"=>$id));
	}
	
	public function affectation($id)
	{
		$this->load->view('app/page-affectation-liste',array("unite"=>$id));
	}
	
	
	public function afficheStatut()
	{
		$data = $this->input->post();
		// var_dump($data);
		if(!empty($data)){
			$donnees = array(
				"per_sStatut"=>$data["statut"]
			);
			$this->md_personnel->modifier_personnel($donnees,$this->session->medicalis);
			$user = $this->md_connexion->personnel_connect();
			if($user->per_sStatut == "Présent(e)"){
				echo '<span class="" style="width:13px;height:13px;border-radius:100%;background:green;display:block;margin:auto;margin-bottom:10px"></span>';
			} else if($user->per_sStatut == "Absent(e)"){ 
				echo '<span class="" style="width:13px;height:13px;border-radius:100%;background:red;display:block;margin:auto;margin-bottom:10px"></span>';
			} 
			echo '<i>'.$user->per_sStatut.'</i>';
		}
		
	}
	
	
	
	public function listeSpecialitePoste()
	{
		$data = $this->input->post();
		// var_dump($data);
		if(empty($data)){
			echo "<option value=''>-- Spécialité * --</option>";	
		}
		else{
			if($data['idPst']==""){
				echo "<option value=''>-- Spécialité * --</option>";	
			}
			else{
				$res = $this->md_parametre->liste_specialites_poste_actifs($data['idPst']);
				if(empty($res)){
					echo "<option value=''>Choisissiez la spécialité du personnel</option>";	
				}
				else{
					echo "<option value=''>-- Spécialité * --</option>";
					foreach($res as $key=>$resultat){
						echo "<option value='".$resultat->spt_id."'>".$resultat->spt_sLibelle."</option>";
					}
				}
			}
		}
		
	}
	
	
	
	public function listeFonctionPoste()
	{
		$data = $this->input->post();
		if(empty($data)){
			echo "<option value=''>-- Poste occupé au sein de l'hopital * --</option>";	
		}
		else{
			if($data['idPst']==""){
				echo "<option value=''>-- Poste occupé au sein de l'hopital * --</option>";	
			}
			else{
				$res = $this->md_parametre->liste_fonction_poste_actifs($data['idPst']);
				if(empty($res)){
					echo "<option value=''>-- Poste occupé au sein de l'hopital * --</option>";		
				}
				else{
					echo "<option value=''>-- Poste occupé au sein de l'hopital * --</option>";	
					foreach($res as $key=>$resultat){
						echo "<option value='".$resultat->fct_id."'>".$resultat->fct_sLibelle."</option>";
					}
				}
			}
		}
		
	}
	
	
	
	public function ajoutPersonnel()
	{
		$data = $this->input->post();
		if(empty($data)){
			return redirect("personnel/nouveau");
			// var_dump($data);
		}
		else{

			if(trim($data["pass"]) == trim($data["cpass"])){
				if(!$this->md_config->verifMail($data["email"])){
					echo "Le format de l'email est incorrect";
				} 
				else{
					if(!is_numeric($data["tel"])){
						echo "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone";
					}
					else{
						$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
						if($formatTel == false){
							echo "Ce numéro de téléphone n'est pas valable en république du Congo";
						}
						else{

							$verifPhone = $this->md_personnel->verif_tel("+242".$formatTel);
							if(!$verifPhone){
								$verifMail = $this->md_personnel->verif_mail(trim($data["email"]));
								if($verifMail){
									echo "Cet email est déjà utilisé par un autre utilisateur";
								}
								else{
									
									if(trim($data["pass"])==""){
										$alea  = $this->md_config->uniqidReal();
									}
									else{
										$alea = trim($data["pass"]);
									}
									$pass = $this->md_config->cryptPass($alea);
									
									
									if(trim($data["maladie"]) == ""){
										$maladie=NULL;
									}
									else{
										$maladie=ucfirst(trim($data["maladie"]));
									}
									
									if(trim($data["prenom"]) == ""){
										$prenom=NULL;
									}
									else{
										$prenom=ucfirst(trim($data["prenom"]));
									}
									
									if(trim($data["autres_noms"]) == ""){
										$autres_noms=NULL;
									}
									else{
										$autres_noms=strtoupper(trim($data["autres_noms"]));
									}
									
									if(trim($data["autres_prenoms"]) == ""){
										$autres_prenoms=NULL;
									}
									else{
										$autres_prenoms=ucwords(trim($data["autres_prenoms"]));
									}
									
									if(trim($data["titre"]) == "pdt"){
										$data["titre"]=NULL;
									}
									
									if($data["genre"]=="F"){
										$avatar = "assets/images/personnel/random-avatar6.jpg";
									}
									else{
										$avatar = "assets/images/personnel/random-avatar4.jpg";
									}
									$date_naiss = $this->md_config->recupDateTime($data["date_naiss"]);
									$date_recru = $this->md_config->recupDateTime($data["date_recru"]);
									date_default_timezone_set('Africa/Brazzaville');
									
									$dataPass = array(
										"pap_sPWD"=>$alea
									);
									$donnees = array(
										"per_iSta"=>0,
										"per_sTel"=>"+242".$formatTel,
										"pst_id"=>$data["poste"],
										"spt_id"=>$data["specialite"],
										"dep_id"=>$data["departement"],
										"per_sNom"=>strtoupper(trim($data["nom"])),
										"per_sPrenom"=>$prenom,
										"per_sAutresNoms"=>$autres_noms,
										"per_sAutresPrenoms"=>$autres_prenoms,
										"per_sSexe"=>$data["genre"],
										"per_dDateNaiss"=>$date_naiss,
										"per_sEmail"=>trim($data["email"]),
										"per_sPwd"=>$pass,
										"per_sToken"=>$this->md_config->cryptPass(uniqid()),
										"per_sAdresse"=>trim($data["adresse"]),
										"per_sSituation"=>$data["situation"],
										"per_iNombreEnf"=>trim($data["nb_enfant"]),
										"per_sPathologie"=>trim($data["pathologie"]),
										"per_sLibellePatho"=>$maladie,
										"per_sTitre"=>trim($data["titre"]),
										"per_sAvatar"=>$avatar,
										"per_dDateRecrut"=>$date_recru,
										"per_dDateEnreg"=>date("Y-m-d H:i:s"),
										"per_sStatut"=>"Absent(e)"
									);
									
									
									$ajout=$this->md_personnel->ajout_personnel($donnees,$dataPass);
									// var_dump($ajout);
									
									if($ajout){
										$log = array(
											"log_iSta"=>0,
											"per_id"=>$this->session->medicalis,
											"log_sTable"=>"t_personnel_per",
											"log_sIcone"=>"nouveau membre",
											"log_sAction"=>"a crée un nouveau membre du personnel : ".strtoupper(trim($data["nom"]))." ".$prenom,
											"log_dDate"=>date("Y-m-d H:i:s")
										);
										$this->md_connexion->rapport($log);
										echo "Employé ajouté avec succès";
									}
								}
							}
							else{
								echo "Ce numéro de téléphone est déja enregistré pour un membre du personnel";
							}
							
						}
					}
					
				}
			}
			else{
				echo "Les mots de passe ne sont pas identiques";
			}
			
			
		}
	}
	
	
	public function editAvatarPersonnel(){
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("app/profil");
		}
		else{
			$verifTaille = $this->md_config->sizeImage($_FILES["photo"],150);
			if(!$verifTaille){
				echo "La taille de l'image ne doit pas dépasser les 150 Ko";
			}
			else{
				$config["upload_path"] =  './assets/images/personnel/';
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
						$data["photo"]="assets/images/personnel/".$image['file_name'];
					}
					else{
						$data["photo"]=$data["photoActuelle"];
					}
					
					$donnees = array(
						"per_sAvatar"=>$data["photo"]
					);
					
					$modif=$this->md_personnel->modifier_personnel($donnees,$data["id"]);
					if($modif){
						
						$log = array(
							"log_iSta"=>0,
							"per_id"=>$this->session->medicalis,
							"log_sTable"=>"t_personnel_per",
							"log_sIcone"=>"modification",
							"log_sAction"=>"a modifié son profil",
							"log_sActionDetail"=>"a modifié sa photo de profil",
							"log_dDate"=>date("Y-m-d H:i:s")
						);
						$this->md_connexion->rapport($log);
						echo "ok";
					}
				}
			}
		}
	}
	
	
	public function editComptePersonnel()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("app/profil");
		}
		else{
			
			if(trim($data["cpass"]) == ""){
				if(!$this->md_config->verifMail($data["email"])){
					echo "Le format de l'email est incorrect";
				}
				else{
					if(!is_numeric($data["tel"])){
						echo "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone";
					}
					else{
						$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
						if($formatTel == false){
							echo "Ce numéro de téléphone n'est pas valable en république du Congo";
						}
						else{
							$verifPhone = $this->md_personnel->verif_tel_edit("+242".$formatTel,$data["id"]);
							if(!$verifPhone){
								$verifMail = $this->md_personnel->verif_mail_edit(trim($data["email"]),$data["id"]);
								if($verifMail){
									echo "Cet email est déjà utilisé par un autre utilisateur";
								}
								else{
									$donnees = array(
										"per_sEmail"=>trim($data["email"]),
										"per_sTel"=>"+242".$formatTel
									);
									$modif=$this->md_personnel->modifier_personnel($donnees,$data["id"]);
									if($modif){
										
										$log = array(
											"log_iSta"=>0,
											"per_id"=>$this->session->medicalis,
											"log_sTable"=>"t_personnel_per",
											"log_sIcone"=>"modification",
											"log_sAction"=>"a modifié son profil",
											"log_sActionDetail"=>"a modifié ses identifiants de connexion : email et téléphone",
											"log_dDate"=>date("Y-m-d H:i:s")
										);
										$this->md_connexion->rapport($log);
										echo "Données modifiées avec succès";
									}
									}
								}
							else{
								echo "Ce numéro de téléphone est déja enregistré pour un membre du personnel";
							}
						}
					}
				}				
			}
			else{
				if(trim($data["npass"]) == trim($data["cpass"])){
					if(!$this->md_config->verifMail($data["email"])){
						echo "Le format de l'email est incorrect";
					}
					else{
						if(!is_numeric($data["tel"])){
							echo "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone";
						}
						else{
							$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
							if($formatTel == false){
								echo "Ce numéro de téléphone n'est pas valable en république du Congo";
							}
							else{
								$verifPhone = $this->md_personnel->verif_tel_edit("+242".$formatTel,$data["id"]);
								if(!$verifPhone){
									$verifMail = $this->md_personnel->verif_mail_edit(trim($data["email"]),$data["id"]);
									if($verifMail){
										echo "Cet email est déjà utilisé par un autre utilisateur";
									}
									else{
										$Ancpass = $this->md_config->cryptPass(trim($data["apass"]));
										$verifPass = $this->md_personnel->verif_pass_edit($Ancpass,$data["id"]);
										if(!$verifPass){
											echo "L'ancien mot de passe est incorrect";
										}
										else{
											$pass = $this->md_config->cryptPass(trim($data["npass"]));
											$donnees = array(
												"per_sEmail"=>trim($data["email"]),
												"per_sTel"=>"+242".$formatTel,
												"per_sPwd"=>$pass
											);
											$modif=$this->md_personnel->modifier_personnel($donnees,$data["id"]);
											if($modif){
												
												$log = array(
													"log_iSta"=>0,
													"per_id"=>$this->session->medicalis,
													"log_sTable"=>"t_personnel_per",
													"log_sIcone"=>"modification",
													"log_sAction"=>"a modifié son profil",
													"log_sActionDetail"=>"a modifié ses identifiants de connexion : email, téléphone et mot de passe",
													"log_dDate"=>date("Y-m-d H:i:s")
												);
												$this->md_connexion->rapport($log);
												echo "Données modifiées avec succès";
											}
										}
									}
								}
								else{
									echo "Ce numéro de téléphone est déja enregistré pour un membre du personnel";
								}
							}
						}
					}	
				}
				else{
					echo "Les mots de passe doivent être identiques";
				}
			}
			
		}
	}
	
	
	
	public function supprimer($id){
		if(!isset($id)){
			return redirect("personnel/tout");
		}
		else{
			$donnees = array(
				"per_iSta"=>2
			);
			$supprimer = $this->md_personnel->modifier_personnel($donnees,$id);
			$per = $this->md_personnel->recup_personnel($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_personnel_per",
					"log_sIcone"=>"suppression",
					"log_sAction"=>"a supprimé un employé",
					"log_sActionDetail"=>"a supprimé un membre du personnel : ".$per->per_sNom." ".$per->per_sPrenom,
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("personnel/tout");
			}
		}
	}
	
	
	
	public function ajoutAffectation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(!empty($data)){
			

			for($i=0;$i<count($data['per']) AND count($data['fct']);$i++){
				$verif = $this->md_personnel->verif_affectation(ucfirst(trim($data['per'][$i])),$data['uni']);
				if(!$verif){
					$donnees = array(
					"per_id"=>trim($data['per'][$i]),
					"fct_id"=>$data['fct'][$i],
					"uni_id"=>$data['uni'],
					"aft_iSta"=>1
					);
					$this->md_personnel->ajout_affectation($donnees);
					$this->md_personnel->modifier_personnel(array("per_iTypeCompte"=>$data["profile"],"per_iSta"=>1),trim($data['per'][$i]));
					$recup = $this->md_parametre->recup_unite($data['uni']);
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_affectation_aft",
						"log_sIcone"=>"nouveau membre",
						"log_sAction"=>"a affecté un employé",
						"log_sActionDetail"=>"a affecté  l'employé : <strong style='text-decoration:underline'>".ucfirst(trim($data['lib'][$i]))."</strong> dans l'unité ".$recup->uni_sLibelle." au service ".$recup->ser_sLibelle,
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
				}
				else{
					
					$delete = $this->md_personnel->maj_affectation(array("aft_iSta"=>2),$verif->aft_id);
					$donnees = array(
					"per_id"=>ucfirst(trim($data['per'][$i])),
					"fct_id"=>$data['fct'][$i],
					"uni_id"=>$data['uni'],
					"aft_iSta"=>1
					);
					$this->md_personnel->ajout_affectation($donnees);
					$recup = $this->md_parametre->recup_unite($data['uni']);
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_affectation_aft",
						"log_sIcone"=>"nouveau membre",
						"log_sAction"=>"a affecté un employé",
						"log_sActionDetail"=>"a affecté  l'employé : <strong style='text-decoration:underline'>".ucfirst(trim($data['lib'][$i]))."</strong> dans l'unité ".$recup->uni_sLibelle." au service ".$recup->ser_sLibelle,
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
				}
			}
			echo "ok";
			
		}
	
	}
	
	public function supprimer_affectation($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("personnel/direction");
		}
		else{
			$donnees = array(
				"aft_iSta"=>2
			);
			$supprimer = $this->md_personnel->maj_affectation($donnees,$id);
			$affectation = $this->md_personnel->recup_affectation($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_affectation_aft",
					"log_sIcone"=>"suppression",
					"log_sAction"=>"a enlevé un employé à une unité",
					"log_sActionDetail"=>"a enlevé un employé à une unité : <strong style='text-decoration:underline'>".$affectation->per_sMatricule." de l'unité ".$affectation->uni_sLibelle." au servive ".$affectation->ser_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("personnel/affectation/".$affectation->uni_id);
			}
		}
	}
	
}
