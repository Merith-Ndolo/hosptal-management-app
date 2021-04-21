<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacie extends CI_Controller {

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
	 
	 
	public function compte_client()
	{
		$this->load->view('app/page-compte-client');
	}		
	
	public function nouveau_bon()
	{
		$this->load->view('app/page-bon-commande');
	}		
	
	public function statistique_stock()
	{
		$this->load->view('app/page-statistique-stock');
	}		
	
	public function liste_sorties()
	{
		$this->load->view('app/page-liste-sorties');
	}		
	
	public function vente_produit()
	{
		$this->load->view('app/page-vente-produit');
	}		
	
		
	public function detail_recu($id)
	{
		$this->load->view('app/page-detail-recu',array("id"=>$id));
	}
	
	public function recu_caisse()
	{
		$this->load->view('app/page-recu-caisse');
	}			
	
	public function liste_produit_perimes()
	{
		$this->load->view('app/page-liste-produit-perimes');
	}		
	
	public function destock()
	{
		$this->load->view('app/page-produit-destocke');
	}		
	
	public function stock()
	{
		$this->load->view('app/page-stock');
	}	
	
	public function entree()
	{
		$this->load->view('app/page-entree');
	}		
	
	public function modifier_entree($id)
	{
		$this->load->view('app/page-modifier-entree',array("id"=>$id));
	}		
	
	public function liste_entrees()
	{
		$this->load->view('app/page-liste-entrees');
	}	
	
	public function liste_produit()
	{
		$this->load->view('app/page-liste-produit');
	}
	
	
	public function liste_produits()
	{
		$this->load->view('app/page-liste-produits');
	}
	
	public function produits()
	{
		$this->load->view('app/page-produit');
	}
	
	
	public function liste_fournisseur()
	{
		$this->load->view('app/page-liste-fournisseur');
	}	
	
	public function nouveau_fournisseur()
	{
		$this->load->view('app/page-nouveau-fournisseur');
	}	
	
	public function modifier_fournisseur($id)
	{
		$this->load->view('app/page-modifier-fournisseur',array("frs_id"=>$id));
	}	
	
	public function detail_fournisseur($id)
	{
		$this->load->view('app/page-detail-fournisseur',array("frs_id"=>$id));
	}
	
	public function detail_produit($id)
	{
		$this->load->view('app/page-detail-produit',array("med_id"=>$id));
	}
	
	public function modifier_produit($id)
	{
		$this->load->view('app/page-modifier-produit',array("med_id"=>$id));
	}
	
	
	public function ajoutFournisseur()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("pharmacie/nouveau_fournisseur");
			// var_dump($data);
		}
		else{
			if(trim($data["tel2"]) == ""){
				$tel2=NULL;
			}else{
				$tel2 = trim($data["tel2"]);
			}
			
			if(trim($data["web"]) == ""){
				$web=NULL;
			}else{
				$web = trim($data["web"]);
			}
			
			if($_FILES["photo"]["name"]==""){

					$verifPhone = $this->md_pharmacie->verif_tel($data['tel1']);
					if(!$verifPhone){
					$verifEmail = $this->md_config->verifMail($data['email']);
					if(!$verifEmail){
						echo "Format adresse mail incorrect";
					}
					else{
						$donnees = array(
							"frs_iSta"=>1,
							"frs_sEnseigne"=>trim($data["nom"]),
							"frs_sAdresse"=>$data["adresse"],
							"frs_sEmail"=>$data["email"],
							"frs_sTel_1"=>$data['tel1'],
							"frs_sTel_2"=>$tel2,
							"vil_id"=>$data["ville"],
							"pay_id"=>$data["pays"],
							"tfr_id"=>$data["type"],
							"frs_sWeb"=>$web,
							"frs_sLogo"=>"assets/images/inconnu.jpg",
							"frs_dDateEnreg"=>date("Y-m-d H:i:s")
						);
						$ajout=$this->md_pharmacie->ajout_fournisseur($donnees);
						if($ajout){
							$log = array(
								"log_iSta"=>0,
								"per_id"=>$this->session->medicalis,
								"log_sTable"=>"t_fournisseurs_frs",
								"log_sIcone"=>"nouveau membre",
								"log_sAction"=>"a ajouté un nouveau fournisseur : ".strtoupper(trim($data["nom"])),
								"log_dDate"=>date("Y-m-d H:i:s")
							);
							$this->md_connexion->rapport($log);
							echo $ajout;
						}
					}
				}
				else{
					echo "Ce numéro de téléphone est déja enregistré pour un fournisseur";
				}
					
				
			}
			else{
				$verifPhone = $this->md_pharmacie->verif_tel($data['tel1']);
				if(!$verifPhone){
					$verifEmail = $this->md_config->verifMail($data['email']);
					if(!$verifEmail){
						echo "Format adresse mail incorrect";
					}
					else{
						$verifTaille = $this->md_config->sizeImage($_FILES["photo"],150);
						if(!$verifTaille){
							echo "La taille de l'image ne doit pas dépasser les 150 Ko";
						}
						else{
							$config["upload_path"] =  './assets/images/';
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
									$data["photo"]="assets/images/".$image['file_name'];
								}
								else{
									$data["photo"]="assets/images/inconnu.jpg";
								}

								$donnees = array(
									"frs_iSta"=>1,
									"frs_sEnseigne"=>trim($data["nom"]),
									"frs_sAdresse"=>$data["adresse"],
									"frs_sEmail"=>$data["email"],
									"frs_sTel_1"=>$data['tel1'],
									"frs_sTel_2"=>$tel2,
									"vil_id"=>$data["ville"],
									"pay_id"=>$data["pays"],
									"tfr_id"=>$data["type"],
									"frs_sWeb"=>$web,
									"frs_sLogo"=>$data["photo"],
									"frs_dDateEnreg"=>date("Y-m-d H:i:s")
								);
								$ajout=$this->md_pharmacie->ajout_fournisseur($donnees);
								
								if($ajout){
									$log = array(
										"log_iSta"=>0,
										"per_id"=>$this->session->medicalis,
										"log_sTable"=>"t_fournisseurs_frs",
										"log_sIcone"=>"nouveau membre",
										"log_sAction"=>"a ajouté un nouveau fournisseur : ".strtoupper(trim($data["nom"])),
										"log_dDate"=>date("Y-m-d H:i:s")
									);
									$this->md_connexion->rapport($log);
									echo $ajout;
								}
							}
						}
					}
				}
				else{
					echo "Ce numéro de téléphone est déja enregistré pour un fournisseur";
				}	
			}
			
		}
	}	
	
	
	public function modifFournisseur()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("pharmacie/modifier_fournisseur");
			// var_dump($data);
		}
		else{
			if(trim($data["tel2"]) == ""){
				$tel2=NULL;
			}else{
				$tel2 = trim($data["tel2"]);
			}
			
			if(trim($data["web"]) == ""){
				$web=NULL;
			}else{
				$web = trim($data["web"]);
			}
			
			if($_FILES["photo"]["name"]==""){
						$verifPhone = $this->md_pharmacie->verif_tel_modif($data['tel1'],$data['id']);
						if(!$verifPhone){
							$verifEmail = $this->md_config->verifMail($data['email']);
							if(!$verifEmail){
								echo "Format adresse mail incorrect";
							}
							else{
								$donnees = array(
									"frs_iSta"=>1,
									"frs_sEnseigne"=>trim($data["nom"]),
									"frs_sAdresse"=>$data["adresse"],
									"frs_sEmail"=>$data["email"],
									"frs_sTel_1"=>trim($data["tel1"]),
									"frs_sTel_2"=>$tel2,
									"vil_id"=>$data["ville"],
									"pay_id"=>$data["pays"],
									"tfr_id"=>$data["type"],
									"frs_sWeb"=>$web
								);
								$modif=$this->md_pharmacie->modifier_fournisseur($donnees,$data['id']);
								if($modif){
									$log = array(
										"log_iSta"=>0,
										"per_id"=>$this->session->medicalis,
										"log_sTable"=>"t_fournisseurs_frs",
										"log_sIcone"=>"nouveau membre",
										"log_sAction"=>"a modifié un fournisseur : ".strtoupper(trim($data["nom"])),
										"log_dDate"=>date("Y-m-d H:i:s")
									);
									$this->md_connexion->rapport($log);
									echo $modif;
								}
							}
						}
						else{
							echo "Ce numéro de téléphone est déja enregistré pour un fournisseur";
						}
						
					
				
			}
			else{
				$verifPhone = $this->md_pharmacie->verif_tel_modif($data['tel1'],$data['id']);
				if(!$verifPhone){
					$verifEmail = $this->md_config->verifMail($data['email']);
					if(!$verifEmail){
						echo "Format adresse mail incorrect";
					}
					else{
						$verifTaille = $this->md_config->sizeImage($_FILES["photo"],150);
						if(!$verifTaille){
							echo "La taille de l'image ne doit pas dépasser les 150 Ko";
						}
						else{
							$config["upload_path"] =  './assets/images/';
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
									$data["photo"]="assets/images/".$image['file_name'];
								}
								else{
									$data["photo"]="assets/images/inconnu.jpg";
								}

								$donnees = array(
									"frs_iSta"=>1,
									"frs_sEnseigne"=>trim($data["nom"]),
									"frs_sAdresse"=>$data["adresse"],
									"frs_sEmail"=>$data["email"],
									"frs_sTel_1"=>$data['tel1'],
									"frs_sTel_2"=>$tel2,
									"vil_id"=>$data["ville"],
									"pay_id"=>$data["pays"],
									"tfr_id"=>$data["type"],
									"frs_sWeb"=>$web,
									"frs_sLogo"=>$data["photo"]
								);
								$modif=$this->md_pharmacie->modifier_fournisseur($donnees,$data['id']);
								
								if($modif){
									$log = array(
										"log_iSta"=>0,
										"per_id"=>$this->session->medicalis,
										"log_sTable"=>"t_fournisseurs_frs",
										"log_sIcone"=>"nouveau membre",
										"log_sAction"=>"a modifié un fournisseur : ".strtoupper(trim($data["nom"])),
										"log_dDate"=>date("Y-m-d H:i:s")
									);
									$this->md_connexion->rapport($log);
									echo $modif;
								}
							}
						}
					}
				}
				else{
					echo "Ce numéro de téléphone est déja enregistré pour un fournisseur";
				}
	
			}
			
		}
	}
	
	public function supprimer_fournisseur($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("pharmacie/liste_fournisseur");
		}
		else{
			$donnees = array(
				"frs_iSta"=>2
			);
			$supprimer = $this->md_pharmacie->maj_fournisseur($donnees,$id);
			$fournisseur = $this->md_pharmacie->recup_fournisseur($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_fonctions_fct",
					"log_sIcone"=>"suppression",
					"log_sAction"=>"a supprimé un fournisseur",
					"log_sActionDetail"=>"a supprimé le fournisseur : <strong style='text-decoration:underline'>".$fournisseur->frs_sLibelle."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("pharmacie/liste_fournisseur");
			}
		}
	}
	
	
	public function modifierFournisseur()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		$verif = $this->md_parametre->verif_categorie_produit_modif(ucfirst(trim($data['lib'])),$data['id']);
		if(!$verif){
			$donnees = array(
				"cat_sLibelle"=>ucfirst(trim($data['lib']))
			);
			$supprimer = $this->md_parametre->maj_categorie_produit($donnees,$data['id']);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_fournisseurs_frs",
					"log_sIcone"=>"modification",
					"log_sAction"=>"a modifié un fournisseur",
					"log_sActionDetail"=>"a modifié le nom du fournisseur :(<strong style='text-decoration:underline'>".$data['nom']."</strong>) Par (<strong style='text-decoration:underline'>".ucfirst(trim($data['lib']))."</strong>)",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				echo ucfirst(trim($data['lib']));
			}
		}
		else{
			echo "echec";
		}
	}
	
	
		/*********** Produit *************/
	public function ajoutProduit()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("pharmacie/categorie_produit");
		}
		else{
			
			if(trim($data['ns']) == ""){
				$ns=NULL;
			}
			else{
				$ns=ucfirst(trim($data['ns']));
			}
			
			$verif = $this->md_pharmacie->verif_produit(ucfirst(trim($data['nc'])),$data['cat'],$data['fam'],$data['fors'],trim($data['dos']),trim($data['uni']));
			if(!$verif){
				$donnees = array(
				"med_sNc"=>ucfirst(trim($data['nc'])),
				"med_sNs"=>$ns,
				"cat_id"=>trim($data['cat']),
				"fam_id"=>trim($data['fam']),
				"for_id"=>trim($data['fors']),
				"med_iDosage"=>trim($data['dos']),
				"med_sUnite"=>ucfirst(trim($data['uni'])),
				"med_iSta"=>1
				);
				$this->md_pharmacie->ajout_produit($donnees);
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_medicaments_med",
					"log_sIcone"=>"nouveau membre",
					"log_sAction"=>"a ajouté un produit",
					"log_sActionDetail"=>"a ajouté un nouveau produit : <strong style='text-decoration:underline'>".ucfirst(trim($data['nc']))."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
			}
			
		}
	
	}
	
	
	public function modifProduit()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("pharmacie/modifier_produit");
			// var_dump($data);
		}
		else{
			if(trim($data["ns"]) == ""){
				$ns=NULL;
			}else{
				$ns = ucfirst(trim($data["ns"]));
			}
			
			$verif = $this->md_pharmacie->verif_produit_modif(ucfirst(trim($data['nc'])),trim($data['cat']),trim($data['fam']),trim($data['fors']),trim($data['dos']),trim($data['uni']),trim($data['id']));
			if(!$verif){
				$donnees = array(
					"med_sNc"=>ucfirst(trim($data["nc"])),
					"med_sNs"=>$ns,
					"cat_id"=>trim($data["cat"]),
					"fam_id"=>trim($data["fam"]),
					"for_id"=>trim($data["for"]),
					"med_iDosage"=>trim($data["dos"]),
					"med_sUnite"=>trim($data["uni"])
				);
				$modif=$this->md_pharmacie->modifier_produit($donnees,$data['id']);
				if($modif){
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_medicament_med",
						"log_sIcone"=>"nouveau membre",
						"log_sAction"=>"a modifié un produit : ".strtoupper(trim($data["nc"])),
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
					echo $modif;
				}
				
			}
			else{
				return "erreur";
			}
		}
	}
		
	public function supprimer_produit($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("pharmacie/liste_produit");
		}
		else{
			$donnees = array(
				"med_iSta"=>2
			);
			$supprimer = $this->md_pharmacie->maj_produit($donnees,$id);
			$produit = $this->md_pharmacie->recup_produit($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_medicament_med",
					"log_sIcone"=>"suppression",
					"log_sAction"=>"a supprimé un produit",
					"log_sActionDetail"=>"a supprimé le produit : <strong style='text-decoration:underline'>".$produit->med_sNc."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("pharmacie/liste_produit");
			}
		}
	}

	
	public function entreeStock()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("pharmacie/entree_stock");
		}
		else{
			$verif = $this->md_pharmacie->verif_achat(trim($data['pro']));
			if(!$verif){
				$donnees = array(
				"ach_iQte"=>trim($data['qte']),
				"med_id"=>trim($data['pro']),
				"ach_iPrixVente"=>trim($data['pv']),
				"ach_iSeuil"=>trim($data['seuil']),
				"cel_id"=>trim($data['cellule']),
				"ach_iPrixTotalAchat"=>$data['pa']*$data['qte'],
				"ach_iPrixTotalVente"=>$data['pv']*$data['qte'],
				"ach_dDateEnreg"=>date("Y-m-d H:i:s")
				);
				$insert = $this->md_pharmacie->entree_stock($donnees);
				
				if($insert){
					$donneesDetails = array(
						"ach_id"=>$insert->ach_id,
						"dac_iSta"=>1,
						"frs_id"=>trim($data['four']),
						"dac_iQte"=>trim($data['qte']),
						"dac_dDateAchat"=>$this->md_config->recupDateTime($data["da"]),
						"dac_dDateExpiration"=>$this->md_config->recupDateTime($data["de"]),
						"dac_iPrixAchat"=>$data['pa'],
						"dac_iPrixTotalAchat"=>$data['pa']*$data['qte'],
						"dac_dDateEnreg"=>date("Y-m-d H:i:s")
					);
					$insertDetail = $this->md_pharmacie->entree_detail_stock($donneesDetails);
					
					if($insertDetail){
						
						for($i=0;$i<$data['qte'];$i++){
							$code = $this->md_config->genereCodeBarre("PHR","pharmacie",$insert->med_sNc.' '.$insert->for_sLibelle.' '.$insert->med_iDosage.''.$insert->med_sUnite);
							$valeurBarre = explode("--//--",$code);
							$donneesProd = array(
								"ach_id"=>$insert->ach_id,
								"pro_iSta "=>1,
								"frs_id"=>trim($data['four']),
								"pro_sCodeBarre"=>$valeurBarre[0],
								"pro_dDateAchat"=>$this->md_config->recupDateTime($data["da"]),
								"pro_dDateExpir"=>$this->md_config->recupDateTime($data["de"]),
								"pro_sImage"=>$valeurBarre[1],
								"pro_iPrixAchat"=>$data['pa'],
								"pro_dDateEnreg"=>date("Y-m-d H:i:s")
							);
							
							$this->md_pharmacie->ajout_produit_stock($donneesProd);
						}
						
						
						$log = array(
							"log_iSta"=>0,
							"per_id"=>$this->session->medicalis,
							"log_sTable"=>"t_achats_ach",
							"log_sIcone"=>"nouveau membre",
							"log_sAction"=>"a effectué une nouvelle entrée",
							"log_sActionDetail"=>"quantité entrée : <strong style='text-decoration:underline'>".ucfirst(trim($data['qte']))."</strong>",
							"log_dDate"=>date("Y-m-d H:i:s")
						);
						$this->md_connexion->rapport($log);		
					}
				}				
					
			}
			else{
				$donnees = array(
					"ach_iQte"=>$data['qte']+$verif->ach_iQte,
					"ach_iPrixVente"=>trim($data['pv']),
					"ach_iSeuil"=>trim($data['seuil']),
					"cel_id"=>trim($data['cellule']),
					"ach_iPrixTotalAchat"=>($data['pa']*$data['qte'])+$verif->ach_iPrixTotalAchat,
					"ach_iPrixTotalVente"=>($data['qte']+$verif->ach_iQte)*$data['pv']
				);
				$update = $this->md_pharmacie->maj_entree_stock($donnees,$verif->ach_id);
				
				if($update){
					$donneesDetails = array(
						"ach_id"=>$verif->ach_id,
						"dac_iSta"=>1,
						"frs_id"=>trim($data['four']),
						"dac_iQte"=>trim($data['qte']),
						"dac_dDateAchat"=>$this->md_config->recupDateTime($data["da"]),
						"dac_dDateExpiration"=>$this->md_config->recupDateTime($data["de"]),
						"dac_iPrixAchat"=>$data['pa'],
						"dac_iPrixTotalAchat"=>$data['pa']*$data['qte'],
						"dac_dDateEnreg"=>date("Y-m-d H:i:s")
					);
					$insertDetail = $this->md_pharmacie->entree_detail_stock($donneesDetails);
					
					if($insertDetail){
						for($i=0;$i<$data['qte'];$i++){
							$code = $this->md_config->genereCodeBarre("PHR","pharmacie",$verif->med_sNc.' '.$verif->for_sLibelle.' '.$verif->med_iDosage.''.$verif->med_sUnite);
							$valeurBarre = explode("--//--",$code);
							$donneesProd = array(
								"ach_id"=>$verif->ach_id,
								"pro_iSta "=>1,
								"frs_id"=>trim($data['four']),
								"pro_sCodeBarre"=>$valeurBarre[0],
								"pro_dDateAchat"=>$this->md_config->recupDateTime($data["da"]),
								"pro_dDateExpir"=>$this->md_config->recupDateTime($data["de"]),
								"pro_sImage"=>$valeurBarre[1],
								"pro_iPrixAchat"=>$data['pa'],
								"pro_dDateEnreg"=>date("Y-m-d H:i:s")
							);
							
							$this->md_pharmacie->ajout_produit_stock($donneesProd);
						}
						
						$log = array(
							"log_iSta"=>0,
							"per_id"=>$this->session->medicalis,
							"log_sTable"=>"t_achats_ach",
							"log_sIcone"=>"nouveau membre",
							"log_sAction"=>"a effectué une nouvelle entrée",
							"log_sActionDetail"=>"quantité entrée : <strong style='text-decoration:underline'>".ucfirst(trim($data['qte']))."</strong>",
							"log_dDate"=>date("Y-m-d H:i:s")
						);
						$this->md_connexion->rapport($log);		
					}
				}
			}
		}
	
	}
	
	
	public function entreeStock_2()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			$verif = $this->md_pharmacie->produit_en_stock($data['id']);
			$donnees = array(
				"ach_iQte"=>$data['qte']+$verif->ach_iQte,
				"ach_iPrixTotalAchat"=>($data['pa']*$data['qte'])+$verif->ach_iPrixTotalAchat,
				"ach_iPrixTotalVente"=>($data['qte']+$verif->ach_iQte)*$verif->ach_iPrixVente
			);
			$update = $this->md_pharmacie->maj_entree_stock($donnees,$verif->ach_id);
			
			if($update){
				$donneesDetails = array(
					"ach_id"=>$verif->ach_id,
					"dac_iSta"=>1,
					"frs_id"=>trim($data['four']),
					"dac_iQte"=>trim($data['qte']),
					"dac_dDateAchat"=>$this->md_config->recupDateTime($data["da"]),
					"dac_dDateExpiration"=>$this->md_config->recupDateTime($data["de"]),
					"dac_iPrixAchat"=>$data['pa'],
					"dac_iPrixTotalAchat"=>$data['pa']*$data['qte'],
					"dac_dDateEnreg"=>date("Y-m-d H:i:s")
				);
				$insertDetail = $this->md_pharmacie->entree_detail_stock($donneesDetails);
				
				if($insertDetail){
					for($i=0;$i<$data['qte'];$i++){
						$code = $this->md_config->genereCodeBarre("PHR","pharmacie",$verif->med_sNc.' '.$verif->for_sLibelle.' '.$verif->med_iDosage.''.$verif->med_sUnite);
						$valeurBarre = explode("--//--",$code);
						$donneesProd = array(
							"ach_id"=>$verif->ach_id,
							"pro_iSta "=>1,
							"frs_id"=>trim($data['four']),
							"pro_sCodeBarre"=>$valeurBarre[0],
							"pro_dDateAchat"=>$this->md_config->recupDateTime($data["da"]),
							"pro_dDateExpir"=>$this->md_config->recupDateTime($data["de"]),
							"pro_sImage"=>$valeurBarre[1],
							"pro_iPrixAchat"=>$data['pa'],
							"pro_dDateEnreg"=>date("Y-m-d H:i:s")
						);
						
						$this->md_pharmacie->ajout_produit_stock($donneesProd);
					}
					
					
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_achats_ach",
						"log_sIcone"=>"nouveau membre",
						"log_sAction"=>"a effectué une nouvelle entrée",
						"log_sActionDetail"=>"quantité entrée : <strong style='text-decoration:underline'>".ucfirst(trim($data['qte']))."</strong>",
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
					$recup = $this->md_pharmacie->produit_en_stock($data['id']);
					echo $recup->ach_iQte;
				}
			}
		}
	}
	
	

	
	public function destockage()
	{
		date_default_timezone_set('Africa/Brazzaville');
		
		$data = $this->input->post();
		for($i=0;$i<count($data['ach']) AND $i<count($data['id']);$i++){
			$donnees = array(
				"pro_sMotif"=>$data['motif'],
				"pro_iSta"=>2,
				"pro_dDateDestock"=>date("Y-m-d")
			);
			$update = $this->md_pharmacie->destock_produit($donnees,$data['id'][$i]);
			
			if($update){
				$recup = $this->md_pharmacie->produit_en_stock($data['ach'][$i]);
				$qte = $recup->ach_iQte - 1;
				$ptv = $recup->ach_iPrixVente * $qte;
				
				$donn = array(
					"ach_iQte"=>$qte,
					"ach_iPrixTotalVente"=>$ptv
				);
				
				$updat = $this->md_pharmacie->maj_entree_stock($donn, $recup->ach_id);
			}
		}
	}
	
	
	public function effectuerVente()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();

		$this->md_pharmacie->vide();
		
		if($data['typePaie']=='comptant'){
			$tas = NULL;
			$ass= NULL;
			$bph= NULL;
			$reste= 0;
			$montantAss = NULL;
		}
		elseif($data['typePaie']=='bonpharmacie'){
			$tas = NULL;
			$ass= NULL;
			$bn = $this->md_pharmacie->recup_bon($data['bon']);
			$bph = $bn->bph_id;
			$montantBon = $bn->bph_iMontant;
			$resultat = $montantBon-$data['montantTotal'];
			$don = array('fac_iMontant'=>$resultat);
			$update = $this->md_pharmacie->maj_bon($don, $bph);
			$reste = 0;
			$montantAss = NULL;
			
		}elseif($data['typePaie']=='assurance'){
			$tas = $data['tas'];
			$ass= $data['ass'];
			$bph= NULL;
			$reste= 0;
			$montantAss = $data['montantAss'];
		}
		
		$donnees = array(
			'per_id'=>$this->session->medicalis,
			'fac_iSta'=>1,
			'bph_id'=>$bph,
			'fac_sObjet'=>'Vente médicament',
			'fac_iMontant'=>$data['montantTotal'],
			'fac_iMontantPaye'=>$data['montantTotal'],
			'fac_iMontantAss'=>$montantAss,
			'fac_iReste'=>$reste,
			'tas_id'=>$tas,
			'ass_id'=>$ass,
			'fac_dDatePaie'=>date("Y-m-d")
		);
		$insert = $this->md_patient->ajout_facture($donnees);
		
		
		for($i=0; $i<count($data['qte']) AND $i<count($data['idAch']);$i++){
			
			$tabDonnees = array(
				'fac_id'=>$insert,
				'ach_id'=>$data['idAch'][$i],
				'elf_iQte'=>$data['qte'][$i],
				'elf_iRemise'=>0
			);
			
			$in = $this->md_patient->ajout_elements_facture($tabDonnees);
			if($in){
				$recup = $this->md_pharmacie->recup_medicament_actifs($data['idAch'][$i]);
				
				$modif = $recup->ach_iQte - $data['qte'][$i];
				$dataUpdate = array('ach_iQte'=>$modif);
				$update = $this->md_pharmacie->maj_vente($data['idAch'][$i],$dataUpdate);
				
			}
			
			
		}
		for($k=0; $k<count($data['code']);$k++){			
				
			$donn = array(
				'pro_iSta'=>2,
				'pro_dDateDestock'=>date("Y-m-d"),
				'pro_sMotif'=>'Produit(s) vendu(s)'
			);
			$this->md_pharmacie->maj_code($donn,$data['code'][$k]);
			
		}
		
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_facture_fac",
				"log_sIcone"=>"nouveau membre",
				"log_sAction"=>"a effectué une vente",
				"log_sActionDetail"=>"montant total de la vente : <strong style='text-decoration:underline'>".$data['montantTotal']."</strong>",
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);	
		
	}
	
	
	
	public function ajoutClient()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			if(trim($data["prenom"]) == ""){
				$prenom=NULL;
			}
			else{
				$prenom=ucwords(trim($data["prenom"]));
			}
			
			if(!is_numeric($data["tel"])){
				echo "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone";
			}
			else{
				$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
				if($formatTel == false){
					echo "Ce numéro de téléphone n'est pas valable en république du Congo";
				}
				else{

					$verifPhone = $this->md_pharmacie->verif_tel_client("+242".$formatTel);
					if(!$verifPhone){
							
						$donnees = array(
							"clt_iSta"=>1,
							"clt_sNom"=>strtoupper(trim($data["nom"])),
							"clt_sPrenom"=>$prenom,
							"clt_sAdresse"=>$data["adresse"],
							"clt_sTel "=>"+242".$formatTel,
							"clt_dDateCreation"=>date("Y-m-d")
						);
						$ajout=$this->md_pharmacie->ajout_client($donnees);
						if($ajout){
							$aujourdhui = date("Y-m-d H:i:s");
							$maDate = strtotime($aujourdhui."+ 360 days");
							$expiration = date("Y-m-d H:i:s",$maDate). "\n";
							$donneesBon = array(
								"bph_iSta"=>1,
								"clt_id "=>$ajout->clt_id,
								"bph_iMontant"=>trim($data["montant"]),
								"bph_iReste"=>trim($data["montant"]),
								"bph_iMontantConso"=>0,
								"bph_dDateEtablis"=>$aujourdhui,
								"bph_dDateExpir"=>$expiration
							);
							
							$insert_bon = $this->md_pharmacie->ajout_bon_pharmacie($donneesBon);
							if($insert_bon){
								$log = array(
									"log_iSta"=>0,
									"per_id"=>$this->session->medicalis,
									"log_sTable"=>"t_client_clt",
									"log_sIcone"=>"nouveau membre",
									"log_sAction"=>"a ajouté un nouveau client : ".strtoupper(trim($data["nom"]))." ".$prenom." pour le bon de pharmacie ".$insert_bon->bph_iMontant,
									"log_dDate"=>date("Y-m-d H:i:s")
								);
								$this->md_connexion->rapport($log);
								
								echo "Client crée avec succès <br> <br>
									Référence : <b>".strtoupper(trim($data["nom"]))." ".$prenom."</b><span class='pull-right'>N° de compte : <b>".$ajout->clt_sMatricule."</b><span><br>";
								echo "Bon de pharmacie établit le ".$this->md_config->affDateTimeFr($insert_bon->bph_dDateEtablis)." d'un montant de ".$insert_bon->bph_iMontant." <small>Fcfa</small> qui expirera le ".$this->md_config->affDateFrNum($insert_bon->bph_dDateExpir)." <span class='pull-right'>N° de bon : <b>".$insert_bon->bph_sNumBon."</b></span>";
							}
							
						}
						else{
							echo "erreur";
						}
					}
					else{
						echo "Ce numéro de téléphone est déja enregistré pour un autre client";
					}
					
				}
			}
			
		}
	}
		
	public function ajoutBon()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			
			$aujourdhui = date("Y-m-d H:i:s");
			$maDate = strtotime($aujourdhui."+ 360 days");
			$expiration = date("Y-m-d H:i:s",$maDate). "\n";
			$donneesBon = array(
				"bph_iSta"=>1,
				"clt_id "=>$data["client"],
				"bph_iMontant"=>trim($data["montant"]),
				"bph_iReste"=>trim($data["montant"]),
				"bph_iMontantConso"=>0,
				"bph_dDateEtablis"=>$aujourdhui,
				"bph_dDateExpir"=>$expiration
			);
			
			$insert_bon = $this->md_pharmacie->ajout_bon_pharmacie($donneesBon);
			if($insert_bon){
				$client = $this->md_pharmacie->recup_client($data["client"]);
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_bon_pharmacie_bph",
					"log_sIcone"=>"nouveau membre",
					"log_sAction"=>"a ajouté un bon de pharmacie pour le client : ".$client->clt_sNom." ".$client->clt_sPrenom." pour le bon de pharmacie ".$insert_bon->bph_iMontant,
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				
				echo "ok";
			}
							
		}
	}
	
	public function supprimer_client($id){
		date_default_timezone_set('Africa/Brazzaville');
		if(!isset($id)){
			return redirect("pharmacie/compte_client");
		}
		else{
			$donnees = array(
				"clt_iSta"=>2
			);
			$supprimer = $this->md_pharmacie->maj_client($donnees,$id);
			$client = $this->md_pharmacie->recup_client($id);
			if($supprimer){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_client_clt",
					"log_sIcone"=>"suppression",
					"log_sAction"=>"a supprimé un client",
					"log_sActionDetail"=>"a supprimé le client : <strong style='text-decoration:underline'>".$client->clt_sNom.' '.$client->clt_sPrenom."</strong>",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				return redirect("pharmacie/compte_client");
			}
		}
	}
	
	public function modifierClient()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		
		if(trim($data["prenom"]) == ""){
			$prenom=NULL;
		}
		else{
			$prenom=ucwords(trim($data["prenom"]));
		}
		
		$formatTel = $this->md_config->formatPhoneCongo(trim($data["tel"]));
		if($formatTel == false){
			echo "Ce numéro de téléphone n'est pas valable en république du Congo";
		}
		else{
			$verifPhone = $this->md_pharmacie->verif_tel_client_modif("+242".$formatTel,$data["id"]);
			if(!$verifPhone){
					
				$donnees = array(
					"clt_sNom"=>strtoupper(trim($data["nom"])),
					"clt_sPrenom"=>$prenom,
					"clt_sAdresse"=>$data["adresse"],
					"clt_sTel "=>"+242".$formatTel
				);
				$maj = $this->md_pharmacie->maj_client($donnees,$data["id"]);
				$client = $this->md_pharmacie->recup_client($data["id"]);
				if($maj){
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_client_clt",
						"log_sIcone"=>"modification",
						"log_sAction"=>"a modifié un client",
						"log_sActionDetail"=>"a modifié le client : <strong style='text-decoration:underline'>".$client->clt_sNom.' '.$client->clt_sPrenom."</strong>",
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					echo "Nom(s) : <strong>".$client->clt_sNom."</strong><br>
						Prénom(s) : <strong>".$client->clt_sPrenom."</strong><br>
						Adresse : <strong>".$client->clt_sAdresse."</strong><br>
						Matricule : <strong>".$client->clt_sMatricule."</strong><br>
						Téléphone : <strong>".$client->clt_sTel."</strong><br>
						";
				}
			}
			else{
				echo "Ce numéro de téléphone est déja enregistré pour un autre client";
			}
		}
	}
	
	public function recupProduit()
	{
		$data = $this->input->post();
		$recup = $this->md_pharmacie->produit_code($data['code']);
		if($recup){
			echo $recup->ach_iPrixVente."-/-".$recup->med_sNc." ".$recup->for_sLibelle." ".$recup->med_iDosage.''.$recup->med_sUnite.'-/-'.$recup->ach_iSeuil.'-/-'.$recup->ach_id;
		}else{
			echo 'echec';
		}
	}	
	
	public function vide()
	{
		var_dump($this->md_pharmacie->vide());
	}
	
	
	public function recupBon()
	{
		$data = $this->input->post();
		$recup = $this->md_pharmacie->recup_bon($data['bon']);
		if($recup){
			echo "réussit";
		}else{
			echo 'echec';
		}
	}	
	
	
	public function recupFictif()
	{
		$data = $this->input->post();
		$verif=$this->md_pharmacie->verif_fictif($data['code']);
		if(!$verif){
			$donnees = array(
				'fic_sCode'=>$data['code'],
				'fic_sProd'=>$data['prod'],
				'ach_id'=>$data['ach'],
				'fic_iPu'=>$data['pu']
			);
			$insert = $this->md_pharmacie->ajout_fictif($donnees);
			$liste = $this->md_pharmacie->recup_fictif();
			foreach($liste AS $l){
				$listeCode = $this->md_pharmacie->recup_code_barre($l->fic_sProd);
				
				echo '<tr>';
					echo '<td>' ;
					echo $l->fic_sProd;
					foreach($listeCode AS $ls){
						echo '<input type="hidden" name="code[]" value="'.$ls->fic_sCode.'"/>';
					}
					echo '</td>';
					echo '<td>'.  $l->fic_iPu . ' Fcfa</td>';
					echo '<td><input type="hidden" name="qte[]" value="'.$l->total.'"  />'.$l->total.' <input type="hidden" name="idAch[]" value="'.$ls->ach_id.'"/></td>';
					$sous = $l->total* $l->fic_iPu;
					echo '<td><input type="hidden" name="sousMontant[]" value="'.$sous.'"/>' .$sous. ' Fcfa</td>';
					echo '<td class="text-center"><a href="javascript:(); " rel="'.$l->fic_sProd.'" class="delete suppList" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
				echo '</tr>';
				
			}
			// echo '<script src="'.base_url('assets/plugins/jquery/jquery-3.1.0.min.js').'"></script>';
			echo '<script src="'.base_url('assets/js/fictif.js').'"></script>';
			echo "-//-";
			$somme = $this->md_pharmacie->somme_fictif();
			echo $somme->som;
			
			
			
			
		}
		else{
			echo "ce produit est déjà ajouté";
		}
	
		
		
	}
	
	
	public function suppFictif()
	{
		$data = $this->input->post();
		$supp = $this->md_pharmacie->supprimer_fictif($data["prod"]);
		$liste = $this->md_pharmacie->recup_fictif();
		foreach($liste AS $l){
			$listeCode = $this->md_pharmacie->recup_code_barre($l->fic_sProd);
			echo '<tr>';
				echo '<td>' ;
				echo $l->fic_sProd;
				foreach($listeCode AS $ls){
					echo '<input type="hidden" name="code[]" value="'.$ls->fic_sCode.'"/>';
						echo '<input type="hidden" name="idAch[]" value="'.$ls->ach_id.'"/>';
				}
				echo '</td>';
				echo '<td>' .$l->fic_sProd .'</td>';
				echo '<td>'.  $l->fic_iPu . ' Fcfa</td>';
				echo '<td><input type="hidden" name="qte[]" value="'.$l->total.'"  />'.$l->total.' <input type="hidden" name="idAch[]" value="'.$ls->ach_id.'"/></td>';
				$sous = $l->total* $l->fic_iPu;
				echo '<td><input type="hidden" name="sousMontant[]" value="'.$sous.'"/>' .$sous. ' Fcfa</td>';
				echo '<td class="text-center"><a href="javascript:(); " rel="'.$l->fic_sProd.'" class="delete suppList" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
			echo '</tr>';
		}
		echo '<script src="'.base_url('assets/js/fictif.js').'"></script>';
		echo '-//-';
		$somme = $this->md_pharmacie->somme_fictif();
		echo $somme->som;
		
		
	}
	
	
	public function effectuerCommnde()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		
		
		$donnees = array(
			'per_id'=>$this->session->medicalis,
			'cmd_iSta'=>1,
			'frs_id'=>$data['four'],
			'cmd_dDate'=>date("Y-m-d")
		);
		$insert = $this->md_pharmacie->ajout_commande($donnees);
		
		for($i=0; $i<count($data['qte']) AND $i<count($data['lib']);$i++){
			$verif=$this->md_pharmacie->verif_commande($data['lib'][$i],$insert);
			if(!$verif){
				$tabDonnees = array(
					'cmd_id'=>$insert,
					'med_id'=>$data['lib'][$i],
					'dcm_iQte'=>$data['qte'][$i]
				);
				
				$in = $this->md_pharmacie->ajout_detail_commande($tabDonnees);
				if($in){
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_commande_cmd",
						"log_sIcone"=>"nouveau membre",
						"log_sAction"=>"a effectué une vente",
						"log_sActionDetail"=>"a fait un bon decomande",
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);	
				}
			}
			else{
				$tabDonnees = array(
					'dcm_iQte'=>$data['qte'][$i]
				);
				
				$in = $this->md_pharmacie->maj_detail_commande($tabDonnees,$verif->dcm_id);
				if($in){
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_commande_cmd",
						"log_sIcone"=>"modification",
						"log_sAction"=>"a augmenté la quanté d'un commande",
						"log_sActionDetail"=>"a augmenté la quanté d'un commande",
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);	
				}
			}

		}		
	}
	
	
	public function editEntreeStock(){
		$data = $this->input->post();
		$verif = $this->md_pharmacie->produit_en_stock($data['id']);
		$donnees = array(
			'cel_id'=>$data['cellule'],
			'ach_iPrixVente'=>$data['pv'],
			'ach_iPrixTotalVente'=>$data['pv']*$verif->ach_iQte,
			'ach_iSeuil'=>$data['seuil']
		);
		
		$update = $this->md_pharmacie->maj_entree_stock($donnees, $data['id']);
		
		if($update){
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_achats_ach",
				"log_sIcone"=>"modification",
				"log_sAction"=>"a modifier une entrée en stock",
				"log_sActionDetail"=>"a modifier une entrée en stock",
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);	
			
			$recup = $this->md_pharmacie->produit_en_stock($data['id']);
			
			echo $recup->sal_sLibelle.'-/-'.$recup->arm_sLibelle.'-/-'.$recup->cel_sLibelle.'-/-'.number_format($recup->ach_iPrixVente,2,",",".").' Fcfa-/-'.$recup->sal_id."-/-".$recup->arm_id."-/-".$recup->cel_id."-/-".$recup->ach_iPrixVente."-/-".$recup->ach_iSeuil;
		}
	}
	
	
	
	
	
	
	public function recupDetailStock(){
		$data = $this->input->post();
		$recup = $this->md_pharmacie->recup_detail_stock($data['ach_id']);
		
		echo '<div class="body table-responsive"> 
				<table class="table table-bordered table-striped table-hover">
				   
					<thead>
						<tr>
							<th>Date achat</th>
							<th>Date expiration</th>
							<th>Fournisseur</th>
							<th>Quantité</th>
							<th>Prix d\'achat</th>
							<th  class="text-right">Total</th>
						</tr>
					</thead>
					<tbody id="tbody">';
				
					foreach($recup AS $r){
						 echo '<tr>';
							echo '<td>Le '.$this->md_config->affDateFrNum($r->dac_dDateAchat).'</td>';
							echo '<td>'.$this->md_config->affDateFrNum($r->dac_dDateExpiration).'</td>';
							echo '<td>'.$r->frs_sEnseigne.'</td>';
							echo '<td>'.$r->dac_iQte.'</td>';
							echo '<td>'.number_format($r->dac_iPrixAchat,2,",",".").' Fcfa</td>';
							echo '<td class="text-right">'.number_format($r->dac_iPrixTotalAchat,2,",",".").' Fcfa</td>';
						 echo '</tr>';
						
					}
		
			echo '</tbody>
			</table>
		</div>';
	}
	
	
	public function destockPerimes(){
			
		$perime = $this->md_pharmacie->liste_produit_perimes(date("Y-m-d"));
		
		for($i=0; $i<count($perime) ;$i++){
			$recup = $this->md_pharmacie->produit_en_stock($perime[$i]->ach_id);
			$qte = $recup->ach_iQte-1;
			$ptv = $recup->ach_iPrixVente*$qte;
			
			$donnees = array(
				"ach_iQte"=>$qte,
				"ach_iPrixTotalVente"=>$ptv
			);
			
			// var_dump($donnees);
			$update = $this->md_pharmacie->maj_entree_stock($donnees, $recup->ach_id);
			// var_dump($update);
		}
		
		$don = array(
			"pro_dDateDestock"=>date("Y-m-d"),
			"pro_iSta"=>2,
			"pro_sMotif"=>"Date du prouit arrivée à expiration"
		);
		$destock = $this->md_pharmacie->destock_perimes(date("Y-m-d"),$don);
		if($destock){
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_produits_pro",
				"log_sIcone"=>"suppression",
				"log_sAction"=>"a destocké des produits",
				"log_sActionDetail"=>"a destocké des produits",
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);	
			return redirect("pharmacie/produits");
		}
				
		
	}
	
	
	
	
	
	
	
	
	
	public function recupSalle(){
		$data = $this->input->post();
		$listeSalle = $this->md_pharmacie->liste_salle_pharmacie_actifs();
		 foreach($listeSalle  AS $salle ){
	?>
		<option value="<?=$salle->sal_id;?>" <?php if($salle->sal_id==$data["sal"]){echo 'selected="selected"';}?>><?php echo $salle->sal_sLibelle?></option>
<?php 
		} 
		
	}

	public function recupArmoir(){
		$data = $this->input->post();
		$listeArm = $this->md_parametre->liste_armoire_salle_actifs($data["sal"]); 
		foreach($listeArm  AS $a ){ 
	?>
		<option value="<?php echo $a->arm_id;?>" <?php if($a->arm_id==$data["arm"]){echo 'selected="selected"';} ?>><?php echo $a->arm_sLibelle;?></option>
<?php 
		 }
	}

	public function recupCellule(){
		$data = $this->input->post();
		$listeCel = $this->md_parametre->liste_cellule_armoire_actifs($data["arm"]);
		foreach($listeCel  AS $c ){ 
	?>

		<option value="<?php echo $c->cel_id;?>" <?php if($c->cel_id==$data["cel"]){echo 'selected="selected"';};?>><?php echo $c->cel_sLibelle;?></option>
<?php
		 }
		
	}

}
	
	