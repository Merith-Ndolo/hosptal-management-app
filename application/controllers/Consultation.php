<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultation extends CI_Controller {

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
		$this->load->view('app/page-liste-consultation');
	}
	
	public function faire($id)
	{
		$this->load->view('app/page-consultation',array("acm_id"=>$id));
	}
	
	public function rapport_consultation($id)
	{
		$this->load->view('app/rapport-consultation',array("acm_id"=>$id));
	}
	
	
	
	public function ajoutInformation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			
			if(trim($data["antecedent"]) == "" AND trim($data["allergie"]) == "" AND trim($data["prof"])=="" AND trim($data["quotidien"])==""){
				echo "Vérifiez vos valeurs";
			}else{
				
				if(trim($data["antecedent"]) == ""){
					$antecedent=NULL;
				}
				else{
					$antecedent = trim($data["antecedent"]);
				}
				
				if(trim($data["allergie"]) == ""){
					$allergie=NULL;
				}
				else{
					$allergie = trim($data["allergie"]);
				}
				
				if(trim($data["prof"]) == ""){
					$prof=NULL;
				}
				else{
					$prof =  trim($data["prof"]);
				}
				
				if(trim($data["quotidien"]) == ""){
					$quotidien=NULL;
				}
				else{
					$quotidien = trim($data["quotidien"]);
				}	
				
				$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
				if(!$verif){
					$donneesSejour = array(
						"acm_id"=>$data["id"],
						"sea_dDate"=>date("Y-m-d")
					);
					$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
				}
				else{
					$sejour = $verif;
				}
				
				$donnees = array(
					"inc_dDate"=>date("Y-m-d H:i:s"),
					"inc_sActQ"=>$quotidien,
					"inc_sAll"=>$allergie,
					"inc_sActPro"=>$prof,
					"inc_sAnt"=>$antecedent,
					"inc_iSta"=>1,
					"pat_id "=>$data["pat"]
				);
				$ajout = $this->md_patient->ajout_information($donnees);
				if($ajout){
					$acm = $this->md_patient->acm_patient($data["id"]);
					$patient = $this->md_patient->recup_patient($acm->pat_id);
					$log = array(
						"log_iSta"=>0,
						"per_id"=>$this->session->medicalis,
						"log_sTable"=>"t_information_complementaire_inc",
						"log_sIcone"=>"nouveau membre",
						"log_sAction"=>"les informations complémentaires du patient ont été mise à jour : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.")",
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
					echo "ok";
	
				}
			}
		}
	}
	
	
		
	public function recupInformation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->information($data["id"]);
			echo '<div class="post-box">
					<h3>Infirmation complémentaires <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Prises le '.$this->md_config->affDateTimeFr($c->inc_dDate).'</small></h3>                                        
					<br>
				</div>';
				
			echo '
				<div class="row clearfix">
					<div class="col-md-12">
						
							<h4 class="media-heading col-blue-grey" style="text-decoration:underline">Antécédents personnels et familiaux</h4>
							<p>'; 
								if(is_null($c->inc_sAnt )){echo "<i class='text-danger'>Non renseigné</i>";}else{echo $c->inc_sAnt ;}
					  echo '</p>
					</div>
				
					<div class="col-md-12">
						
							<h4 class="media-heading col-blue-grey" style="text-decoration:underline">Allergies connues</h4>
							<p> '; 
								if(is_null($c->inc_sAll)){echo "<i class='text-danger'>Non renseigné</i>";}else{echo $c->inc_sAll;} 
					 echo '</p>
						
					</div>
					
					<div class="col-md-12">
					
							<h4 class="media-heading col-blue-grey" style="text-decoration:underline">Activités professionnelles</h4>
							<p> '; 
								if(is_null($c->inc_sActPro)){echo "<i class='text-danger'>Non renseigné</i>";}else{echo $c->inc_sActPro;}
					  echo '</p>
					  
					</div>
					
					<div class="col-md-12">
						
							<h4 class="media-heading col-blue-grey" style="text-decoration:underline">Activités quotidiennes</h4>
							<p> '; 
								if(is_null($c->inc_sActQ)){echo "<i class='text-danger'>Non renseigné</i>";}else{echo $c->inc_sActQ;} 
					 echo '</p>
						
					</div>
				</div>
			';
			
		}
	}
	
	
	
	
	public function ajoutConstante()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			
			
			if(trim($data["temperature"]) == "" AND trim($data["sys"]) == "" AND trim($data["dia"]) == "" AND trim($data["taille"])=="" AND trim($data["poids"])==""){
				echo "Vérifiez vos valeurs";
			}else{
				
				if(trim($data["temperature"]) == ""){
					$temperature=NULL;
				}
				else{
					$temperature = $this->md_config->formatNombreVirgule(trim($data["temperature"]));
				}
				
				if(trim($data["taille"]) == ""){
					$taille=NULL;
				}
				else{
					$taille = $this->md_config->formatNombreVirgule(trim($data["taille"]));
				}
				
				if(trim($data["poids"]) == ""){
					$poids=NULL;
				}
				else{
					$poids =  $this->md_config->formatNombreVirgule(trim($data["poids"]));
				}
				
				if(trim($data["sys"]) == ""){
					$sys=NULL;
				}
				else{
					$sys =  $this->md_config->formatNombreVirgule(trim($data["sys"]));
				}
				
				if(trim($data["dia"]) == ""){
					$dia=NULL;
				}
				else{
					$dia =  $this->md_config->formatNombreVirgule(trim($data["dia"]));
				}
				
				
				
				if($temperature=="erreur"){
					echo "temperature";
				}
				else{
		
					if($taille=="erreur"){
						echo "taille";
					}
					else{
						if($poids=="erreur"){
							echo "poids";
						}
						else{
							if($sys=="erreur"){
								echo "sys";
							}
							else{
								if($dia=="erreur"){
									echo "dia";
								}
								else{
									$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
									if(!$verif){
										$donneesSejour = array(
											"acm_id"=>$data["id"],
											"sea_dDate"=>date("Y-m-d")
										);
										$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
									}
									else{
										$sejour = $verif;
									}
									
									$donnees = array(
										"con_dDate"=>date("Y-m-d H:i:s"),
										"con_fPoids"=>$poids,
										"con_fTaille"=>$taille,
										"con_iTensionSys"=>$sys,
										"con_iTensionDia"=>$dia,
										"con_iTemperature"=>$temperature,
										"sea_id"=>$sejour->sea_id
									);
									$ajout = $this->md_patient->ajout_constante($donnees);
									if($ajout){
										$acm = $this->md_patient->acm_patient($data["id"]);
										$patient = $this->md_patient->recup_patient($acm->pat_id);
										$log = array(
											"log_iSta"=>0,
											"per_id"=>$this->session->medicalis,
											"log_sTable"=>"t_constante_con",
											"log_sIcone"=>"nouveau membre",
											"log_sAction"=>"les constantes du patient ont été mise à jour : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.")",
											"log_dDate"=>date("Y-m-d H:i:s")
										);
										$this->md_connexion->rapport($log);
										echo "ok";
									}

								}
							}
						}
					}
				
				}
			}
		}
	}
	
	
	public function recupConstante()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->constante_sejour($data["id"]);
			echo '<div class="post-box">
					<h3>Constante vitale <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateTimeFr($c->con_dDate).'</small></h3>                                        
					<div class="body p-l-0 p-r-0">
						<div class="row clearfix" style="margin-bottom:12px">	
							<div class="col-sm-6">
								<label style="color:#000"><span>Température - </span>'; 
									if(!is_null($c->con_iTemperature)){echo '<b>'.$c->con_iTemperature.' °C</b>';}else{echo '<i><br>Non renseignée</i>';} 
							echo '</label>
							</div>
							<div class="col-sm-6">
								<label style="color:#000"><span>Tension arterielle - </span>';
									if(!is_null($c->con_iTensionSys) AND !is_null($c->con_iTensionDia)){echo '<b>'.$c->con_iTensionSys.'/'.$c->con_iTensionDia.' mmHg</b>';}else{echo '<i><br>Non renseignée</i>';}
							echo '</label>
							</div>
							<div class="col-sm-6">
								<label style="color:#000"><span>Poids - </span>';
									if(!is_null($c->con_fPoids)){echo '<b>'.$c->con_fPoids.' Kg</b>';}else{echo '<i><br>Non renseigné</i>';}
							echo '</label>
							</div>
							<div class="col-sm-6">
								<label style="color:#000"><span>Taille - </span>';
									if(!is_null($c->con_fTaille)){echo '<b>'.$c->con_fTaille.' cm</b>';}else{echo '<i><br>Non renseigné</i>';}
							echo '</label>
							</div>
						</div>
					</div>
				</div>';
			
		}
	}
	
	
	public function ajoutHospitalisation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			$recup = $this->md_parametre->recup_act_hospitalisation($data["uni"],"Hospitalisation");
			if($recup){
				$duree = $recup->lac_iDure;
				$lac= $recup->lac_id;
			}
			else{
				$duree = 365;
				$lac = 64;
			}
			
			$aujourdhui = date("Y-m-d H:i:s");
			$maDate = strtotime($aujourdhui."+ ".$duree." days");
			$expiration = date("Y-m-d H:i:s",$maDate). "\n";
			
			$maDatedelai = strtotime($aujourdhui."+ 2 days");
			$delai = date("Y-m-d H:i:s",$maDatedelai). "\n";
			$donnees = array(
				"acm_iSta "=>1,
				"lac_id"=>$lac,
				"pat_id"=>$data["pat"],
				"uni_id"=>$data['uni'],
				"acm_dDate"=>$aujourdhui,
				"acm_dDateDelai"=>$delai,
				"acm_dDateExp"=>$expiration,
				"acm_sStatut "=>"en attente"                                                                                  
			);
									
			$insert = $this->md_patient->ajout_orientation($donnees);
			if($insert){
				$recupAct = $this->md_patient->recup_last_acte_medical();
				$donneeHos = array(
					"hos_iSta"=>1,
					"acm_id"=>$recupAct->acm_id,
					"sea_id"=>$sejour->sea_id,
					"lit_id"=>$data["lit"],
					"hos_sType"=>$data["type"],
					"hos_sMotif"=>$data["motif"],
					"hos_dDate"=>$aujourdhui
				);
				
				$ajout = $this->md_patient->ajout_prescription_hospitalisation($donneeHos);
				if($ajout){
					$donneesLit = array("lit_iOccupe"=>1);
					$maj = $this->md_parametre->maj_lit($donneesLit,$data["lit"]);
				}
			}
		
		}
		
		echo $data["id"];
	}
	
	
	public function recupHospitalisation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->hospitalisation_sejour($data["id"]);
			echo '<div class="post-box">
					<h3>Prescription d\'hospitalisation  <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateTimeFr($c->hos_dDate).'</small></h3>                                        
					<div class="body p-l-0 p-r-0">
						<div class="row clearfix" style="margin-bottom:12px">	
							<div class="col-sm-3">
								<label style="color:#000"><span>Service : </span>'; 
									echo '<b>'.$c->ser_sLibelle.'</b>';
							echo '</label>
							</div>
							<div class="col-sm-3">
								<label style="color:#000"><span>Unité : </span>';
									echo '<b>'.$c->uni_sLibelle.'</b>';
							echo '</label>
							</div>
							<div class="col-sm-3">
								<label style="color:#000"><span>Chambre : </span>';
									echo '<b>'.$c->cha_sLibelle.'</b>';
							echo '</label>
							</div>
							<div class="col-sm-3">
								<label style="color:#000"><span>Lit : </span>';
									echo '<b>'.$c->lit_sLibelle.'</b>';
							echo '</label>
							</div>
						</div>
						
						<div class="row clearfix" style="margin-bottom:12px">	
							<div class="col-sm-3">
								<label style="color:#000"><span>Disposition : </span>'; 
									echo '<b>'.$c->hos_sType.'</b>';
							echo '</label>
							</div>
							<div class="col-sm-9">
								<label style="color:#000"><span>Motif : </span>';
									echo '<b>'.$c->hos_sMotif.'</b>';
							echo '</label>
							</div>
							
						</div>
					</div>
				</div>';
			
		}
	}
	
	
	
	
	public function ajoutConsultation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			
			if(trim($data["obs"]) == ""){
				$obs=NULL;
			}
			else{
				$obs = trim($data["obs"]);
			}	
			
			if(trim($data["an"]) == ""){
				$an=NULL;
			}
			else{
				$an=trim($data["an"]);
			}
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			
			$donnees = array(
				"csl_dDate"=>date("Y-m-d H:i:s"),
				"csl_sAnamnese"=>$an,
				"csl_sMotif"=>trim($data["motif"]),
				"csl_sObservation"=>$obs,
				"csl_iSta"=>1,
				"sea_id"=>$sejour->sea_id
			);
			$ajout = $this->md_patient->ajout_consultation($donnees);
			if($ajout){
				$acm = $this->md_patient->acm_patient($data["id"]);
				$patient = $this->md_patient->recup_patient($acm->pat_id);
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_consultation_csl",
					"log_sIcone"=>"nouveau membre",
					"log_sAction"=>"la médecin a établi une consultation pour le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.")",
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
				echo "ok";
			}	
		
		}
	}
	
		
	public function recupConsultation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->consultation_sejour($data["id"]);
			echo '<div class="post-box">
					<h3>Consultation <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateTimeFr($c->csl_dDate).'</small></h3>                                        
					<br>
				</div>';
				
			echo '
				<div class="row clearfix">
					<div class="col-md-4">
						
							<h4 class="media-heading col-blue-grey">Motif de consultation</h4>
							<p>'; 
								if(is_null($c->csl_sMotif)){echo "<i class='text-danger'>Non renseigné</i>";}else{echo $c->csl_sMotif;}
					  echo '</p>
					</div>
					<div class="col-md-4">
					
							<h4 class="media-heading col-blue-grey">Examen clinique</h4>
							<p> '; 
								if(is_null($c->csl_sObservation)){echo "<i class='text-danger'>Non renseigné</i>";}else{echo $c->csl_sObservation;}
					  echo '</p>
					  
					</div>
					<div class="col-md-4">
						
							<h4 class="media-heading col-blue-grey">Anamnèse</h4>
							<p> '; 
								if(is_null($c->csl_sAnamnese)){echo "<i class='text-danger'>Non renseigné</i>";}else{echo $c->csl_sAnamnese;} 
					 echo '</p>
						
					</div>
				</div>
			';
			
		}
	}
	
	
	
	public function ajoutOrdonnance()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			
			$donnees = array(
				"ord_dDate"=>date("Y-m-d H:i:s"),
				"sea_id"=>$sejour->sea_id
			);
			$ajout = $this->md_patient->ajout_ordonnance($donnees);
			
			for($i=0;$i<count($data['med']) AND $i< count($data['qte']) AND $i< count($data['duree']) AND $i< count($data['pos']);$i++){
				$verif = $this->md_patient->verif_element_ordonnance($ajout->ord_id,$data['med'][$i],$data['qte'][$i],$data['duree'][$i],$data['pos'][$i]);
				if(!$verif){
					$donnees = array(
					"elo_sProduit"=>$data['med'][$i],
					"elo_sPosologie"=>$data['pos'][$i],
					"elo_iDuree"=>$data['duree'][$i],
					"ord_id"=>$ajout->ord_id,
					"elo_iQuantite"=>$data['qte'][$i]
					);
					$this->md_patient->ajout_element_ordonnance($donnees);
				}
			}
			$acm = $this->md_patient->acm_patient($data["id"]);
			$patient = $this->md_patient->recup_patient($acm->pat_id);
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_ordonnance_ord",
				"log_sIcone"=>"nouveau membre",
				"log_sAction"=>"a ajouté une ordonnance",
				"log_sActionDetail"=>"a prescrit une ordonnance pour le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.")",
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);				
			
			$this->load->view('impression/ordonnance', array("id"=>$ajout->ord_id));
		
			//chargement de HTML
			$html=$this->output->get_output();
			
			//chargement de la librairie pdf
			$this->load->library('pdf');
			
			//chargement du contenu HTML
			$this->dompdf->loadHTML($html);
			
			//setup paper size and orientation
			// $this->dompdf->setPaper('A7', 'portrait');//recu_pharmacie
			// $this->dompdf->setPaper('A4', 'portrait');//courrier;dossier_medical;fiche_personnel;laboratoire;liste-inventaire-stock;hospitalisation
			$this->dompdf->setPaper('A5', 'portrait');//ordonnance;acte_de_deces;acte_de_naissance;consultation;imagerie
			// $this->dompdf->setPaper('A5', 'portrait');//acte_de_naissance
			
			//render HTML as PDF
			$this->dompdf->render();
			
			//output PDF
			$this->dompdf->stream("ordonnance_".$ajout->ord_id.".pdf",array('attachment'=>0));
			
			return redirect("consultation/faire/".$data["id"]);
			
		}
	
	}
	
		
	public function imprime_ordonnance($id)
	{
		$c = $this->md_patient->ordonnance_sejour($id);
		$this->load->view('impression/ordonnance', array("id"=>$c->ord_id));
		
			//chargement de HTML
			$html=$this->output->get_output();
			
			//chargement de la librairie pdf
			$this->load->library('pdf');
			
			//chargement du contenu HTML
			$this->dompdf->loadHTML($html);
			
			//setup paper size and orientation
			// $this->dompdf->setPaper('A7', 'portrait');//recu_pharmacie
			// $this->dompdf->setPaper('A4', 'portrait');//courrier;dossier_medical;fiche_personnel;laboratoire;liste-inventaire-stock;hospitalisation
			$this->dompdf->setPaper('A5', 'portrait');//ordonnance;acte_de_deces;acte_de_naissance;consultation;imagerie
			// $this->dompdf->setPaper('A5', 'portrait');//acte_de_naissance
			
			//render HTML as PDF
			$this->dompdf->render();
			
			//output PDF
			$this->dompdf->stream("ordonnance_".$c->ord_id.".pdf",array('attachment'=>0));
			return redirect("consultation/faire/".$c->acm_id);
	}
	
		
	public function recupOrdonnance()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->ordonnance_sejour($data["id"]);
			$element = $this->md_patient->element_ordonnance($c->ord_id);
			echo '<div class="post-box">
					<h3>Ordonnance <a href="'.site_url("consultation/imprime_ordonnance/".$data["id"]).'"><i class="fa fa-download"></i></a><small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateTimeFr($c->ord_dDate).'</small></h3>                                        
					<br>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Produit prescript</th>
									<th>Quantité</th>
									<th>Posologie</th>
									<th>Durée</th>
								</tr>
							</thead>
							<tbody>';
							foreach($element AS $e){
							if($e->elo_iDuree >1){
								$jour="jours";
							}
							else{
								$jour="jour";
							}
							echo '<tr>
									<td>'.$e->elo_sProduit.'</td>
									<td>X '.$e->elo_iQuantite.'</td>
									<td>'.$e->elo_sPosologie.'</td>
									<td>Pendant '.$e->elo_iDuree.' '.$jour.'</td>
								</tr>';
							}
						echo' </tbody>
						</table>
					</div>';
			
		}
	}
	
	
	public function ajoutActeImagerie()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			
			if($data['indication'] == ""){
				$data['indication']=NULL;
			}
			
			$don = array(
				"img_iSta"=>1,
				"img_sDescription"=>$data['indication'],
				"img_dDate"=>date("Y-m-d H:i:s"),
				"sea_id"=>$sejour->sea_id
			);
			$insertImg = $this->md_patient->ajout_imagerie($don);
			for($i=0;$i<count($data['act_imagerie']) AND $i< count($data['duree_imagerie']) AND $i< count($data['uni_imagerie']);$i++){
				$aujourdhui = date("Y-m-d H:i:s");
				$maDate = strtotime($aujourdhui."+ ".$data["duree_imagerie"][$i]." days");
				$expiration = date("Y-m-d H:i:s",$maDate). "\n";
				
				$maDatedelai = strtotime($aujourdhui."+ 30 days");
				$delai = date("Y-m-d H:i:s",$maDatedelai). "\n";
				$donnees = array(
					"acm_iSta "=>1,
					"lac_id"=>$data['act_imagerie'][$i],
					"pat_id"=>$data["pat_imagerie"],
					"uni_id"=>$data['uni_imagerie'][$i],
					"acm_dDate"=>$aujourdhui,
					"acm_dDateDelai"=>$delai,
					"acm_dDateExp"=>$expiration,
					"acm_sStatut "=>"en attente"                                                                                  
				);
										
				$insert = $this->md_patient->ajout_orientation($donnees);
				if($insert){
					$recupAct = $this->md_patient->recup_last_acte_medical();
					$donneeImagerie = array(
						"acm_id"=>$recupAct->acm_id,
						"img_id"=>$insertImg->img_id,
						"aci_iSta"=>1
					);
					
					$this->md_patient->ajout_prescription_imagerie($donneeImagerie);
				}
				$acte = $this->md_parametre->recup_act($data['act_imagerie'][$i]);
			}
			$patient = $this->md_patient->recup_patient($data["pat_imagerie"]);
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_soins_infirmiers_soi",
				"log_sIcone"=>"nouveau membre",
				"log_sAction"=>"a fait une prescription",
				"log_sActionDetail"=>"a prescrit  en exament imagerie le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);
			echo "ok";
			
		}
	
	}
	
	
		
	public function recupActeImagerie()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->sejour($data["id"]);
			$element = $this->md_patient->imagerie_sejour($data["id"]);
			$elmt = $this->md_patient->acte_imagerie_sejour($element->img_id);
			// var_dump($elmt);
			echo '<div class="post-box">
					<h3>Prescription en imagerie <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateFrNum($c->sea_dDate).'</small></h3>                                        
					<br>
					<div class="col-md-6"><b style="text-decoration:underline">Indication</b>'.nl2br($element->img_sDescription).'</div>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Acte imagerie</th>
									<th>Le médecin radiologue</th>
									<th>image jointe</th>
									<th>Date réalisation</th>
									<th>Compte rendu</th>
								</tr>
							</thead>
							<tbody>';
							foreach($elmt AS $e){
							echo '<tr>
									<td>'.$e->lac_sLibelle.'</td>
									<td class="text-center">'; if(!is_null($e->aci_iPer)){echo "<img src='".base_url($e->per_sAvatar)."' width='80' height='80'/><br><b>".$e->per_sNom.'</b> '.$e->per_sPrenom." <br>(".$e->per_sMatricule.")";}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
									<td class="text-center">'; if(!is_null($e->aci_sImage)){echo "<a href='".base_url($e->aci_sImage)."' target='_blank'><i class='fa fa-download'></i> Voir le fchier joint</a>";}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
									<td class="">'; if(!is_null($e->aci_dDate)){echo $this->md_config->affDateTimeFr($e->aci_dDate);}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
									<td class="">'; if(!is_null($e->aci_sCompteRendu)){echo nl2br($e->aci_sCompteRendu);}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
								</tr>';
							}
						echo' </tbody>
						</table>
					</div>';
			
		}
	}
		
	
	public function ajoutActeExp()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			
			if($data['indication'] == ""){
				$data['indication']=NULL;
			}
			
			$don = array(
				"efc_iSta"=>1,
				"efc_sDescription"=>$data['indication'],
				"efc_dDate"=>date("Y-m-d H:i:s"),
				"sea_id"=>$sejour->sea_id
			);
			$insertEfc = $this->md_patient->ajout_exploration($don);
			for($i=0;$i<count($data['act_exp']) AND $i< count($data['duree']) AND $i< count($data['uni']);$i++){
				$aujourdhui = date("Y-m-d H:i:s");
				$maDate = strtotime($aujourdhui."+ ".$data["duree"][$i]." days");
				$expiration = date("Y-m-d H:i:s",$maDate). "\n";
				
				$maDatedelai = strtotime($aujourdhui."+ 30 days");
				$delai = date("Y-m-d H:i:s",$maDatedelai). "\n";
				$donnees = array(
					"acm_iSta "=>1,
					"lac_id"=>$data['act_exp'][$i],
					"pat_id"=>$data["pat"],
					"uni_id"=>$data['uni'][$i],
					"acm_dDate"=>$aujourdhui,
					"acm_dDateDelai"=>$delai,
					"acm_dDateExp"=>$expiration,
					"acm_sStatut "=>"en attente"                                                                                  
				);
										
				$insert = $this->md_patient->ajout_orientation($donnees);
				if($insert){
					$recupAct = $this->md_patient->recup_last_acte_medical();
					$donneeExp = array(
						"acm_id"=>$recupAct->acm_id,
						"efc_id"=>$insertEfc->efc_id,
						"aef_iSta"=>1
					);
					
					// var_dump($donneeExp);
					
					$this->md_patient->ajout_prescription_exploration($donneeExp);
				}
				$acte = $this->md_parametre->recup_act($data['act'][$i]);
			}
			$patient = $this->md_patient->recup_patient($data["pat"]);
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_exploration_fonctionnelle",
				"log_sIcone"=>"nouveau membre",
				"log_sAction"=>"a fait une prescription",
				"log_sActionDetail"=>"a prescrit  en examen d'exploration fonctionnelle le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);
			echo "ok";
			
		}
	
	}
	
	
		
	public function recupActeExp()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->sejour($data["id"]);
			$element = $this->md_patient->exploration_sejour($data["id"]);
			$elmt = $this->md_patient->acte_exploration_sejour($element->efc_id);
			// var_dump($elmt);
			echo '<div class="post-box">
					<h3>Prescription en exploration fonctionnelle <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateFrNum($c->sea_dDate).'</small></h3>                                        
					<br>
					<div class="col-md-6"><b style="text-decoration:underline">Indication</b>'.nl2br($element->efc_sDescription).'</div>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Acte exploration fonctionnelle</th>
									<th>Le médecin exameminateur</th>
									<th>image jointe</th>
									<th>Date réalisation</th>
									<th>Compte rendu</th>
								</tr>
							</thead>
							<tbody>';
							foreach($elmt AS $e){
							echo '<tr>
									<td>'.$e->lac_sLibelle.'</td>
									<td class="text-center">'; if(!is_null($e->aef_iPer)){echo "<img src='".base_url($e->per_sAvatar)."' width='80' height='80'/><br><b>".$e->per_sNom.'</b> '.$e->per_sPrenom." <br>(".$e->per_sMatricule.")";}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
									<td class="text-center">'; if(!is_null($e->aef_sImage)){echo "<a href='".base_url($e->aef_sImage)."' target='_blank'><i class='fa fa-download'></i> Voir le fchier joint</a>";}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
									<td class="">'; if(!is_null($e->aef_dDate)){echo $this->md_config->affDateTimeFr($e->aef_dDate);}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
									<td class="">'; if(!is_null($e->aef_sCompteRendu)){echo nl2br($e->aef_sCompteRendu);}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
								</tr>';
							}
						echo' </tbody>
						</table>
					</div>';
			
		}
	}
		
	
	public function ajoutActeInfirmier()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			
			for($i=0;$i<count($data['act_soins']) AND $i< count($data['cons']) AND  $i< count($data['qte_soins']) AND $i< count($data['heure_soins']) AND $i< count($data['duree_soins']) AND $i< count($data['uni_soins']);$i++){
				$aujourdhui = date("Y-m-d H:i:s");
				$maDate = strtotime($aujourdhui."+ ".$data["duree_soins"][$i]." days");
				$expiration = date("Y-m-d H:i:s",$maDate). "\n";
				
				$maDatedelai = strtotime($aujourdhui."+ 30 days");
				$delai = date("Y-m-d H:i:s",$maDatedelai). "\n";
				
				for($j=0; $j<$data['qte_soins'][$i]; $j++){
					$donnees = array(
						"acm_iSta "=>1,
						"lac_id"=>$data['act_soins'][$i],
						"pat_id"=>$data["pat_soins"],
						"uni_id"=>$data['uni_soins'][$i],
						"acm_dDate"=>$aujourdhui,
						"acm_dDateDelai"=>$delai,
						"acm_dDateExp"=>$expiration,
						"acm_sStatut "=>"en attente"                                                                                  
					);
					$insert = $this->md_patient->ajout_orientation($donnees);
					if($insert){
						$recupAct = $this->md_patient->recup_last_acte_medical();
						$donneeSoins = array(
							"soi_iSta"=>1,
							"acm_id"=>$recupAct->acm_id,
							"sea_id"=>$sejour->sea_id,
							"soi_tHeureDem"=>$data['heure_soins'][$i],
							"soi_sConsigne"=>$data['cons'][$i],
							"soi_dDtatePres"=>$aujourdhui
						);
						
						$this->md_patient->ajout_prescription_soins($donneeSoins);
					}
					
				}
				$acte = $this->md_parametre->recup_act($data['act_soins'][$i]);
				$patient = $this->md_patient->recup_patient($data["pat_soins"]);
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_soins_infirmiers_soi",
					"log_sIcone"=>"nouveau membre",
					"log_sAction"=>"a fait une prescription",
					"log_sActionDetail"=>"a prescrit  en soins infirmier le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);
			}
			
			echo "ok";
			
		}
	
	}
	
	
		
	public function recupSoinsInfim()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->sejour($data["id"]);
			$element = $this->md_patient->soins_infirmiers_sejour($data["id"]);
			echo '<div class="post-box">
					<h3>Prescription des soins infirmiers <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateFrNum($c->sea_dDate).'</small></h3>                                        
					<br>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Acte des soins</th>
									<th>Service/unité</th>
									<th>Heure</th>
									<th>Consigne</th>
									<th style="width:60px">Situation</th>
									<th style="width:18%" class="text-center">Infirmier(ère) traitant</th>
									<th>Observation</th>
								</tr>
							</thead>
							<tbody>';
							foreach($element AS $e){
							echo '<tr>
									<td>'.$e->lac_sLibelle.'</td>
									<td>'.$e->ser_sLibelle.' / '.$e->uni_sLibelle.'</td>
									<td class="text-center">à <br>'.$e->soi_tHeureDem.'</td>
									<td>'.nl2br($e->soi_sConsigne).' j</td>
									<td>'; if(!is_null($e->soi_dDateFait)){echo "fait ".$this->md_config->affDateTimeFr($e->soi_dDateFait);}else{echo "<span style='color:red'>Soins en attente de confirmation</span>";} echo '</td>
									<td class="text-center">'; if(!is_null($e->soi_iPersonnel)){echo "<img src='".base_url($e->per_sAvatar)."' width='100' height='100'/><br><b>".$e->per_sNom.'</b> '.$e->per_sPrenom." <br>(".$e->per_sMatricule.")";}else{echo "<span style='color:red'>pas encore renseigné</span>";} echo '</td>
									<td>'.nl2br($e->soi_sObservation).'</td>
								</tr>';
							}
						echo' </tbody>
						</table>
					</div>';
			
		}
	}
	
	
	
		public function recupReeducat()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->sejour($data["id"]);
			$element = $this->md_patient->reeducation_sejour($data["id"]);
			echo '<div class="post-box">
					<h3>Prescription en rééducation <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateFrNum($c->sea_dDate).'</small></h3>                                        
					<br>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Acte de rééducation</th>
									<th>Nombre de seance</th>
									<th>Statut</th>
								</tr>
							</thead>
							<tbody>';
							foreach($element AS $e){
							echo '<tr>
									<td>'.$e->lac_sLibelle.'</td>
									<td>'.$e->ree_iNbPrinscrit.'</td>
									<td>';
									if($e->ree_iNombre==0){
										echo '<span style="color:green"><strong>Seance(s) terminée(s)</strong></span>';
									}elseif($e->ree_iNombre==$e->ree_iNbPrinscrit){
										echo '<span style="color:green"><strong>Seance(s) en attente(s)</strong></span>';
										}elseif($e->ree_iNombre!=$e->ree_iNbPrinscrit){
											echo '<span style="color:green"><strong>Seance(s) en cours</strong></span>';
										}
									echo'</td>
								</tr>';
							}
						echo' </tbody>
						</table>
					</div>';
			
		}
	}		
	
	
	public function recupNouveau()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->sejour($data["id"]);
			$elt = $this->md_patient->nouveau_sejour($data["id"]);
			echo '<div class="post-box">
					<h3>Nouvelle naissance <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateFrNum($c->sea_dDate).'</small></h3>                                        
					<br>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Date naissance</th>
									<th>heure naissance</th>
									<th>Sexe</th>
								</tr>
							</thead>
							<tbody>';
							foreach($elt AS $e){
							echo '<tr>
									<td>'.$this->md_config->affDateFrNum($e->nne_dDateNaiss).'</td>
									<td>'.$e->nne_tHeureNaiss.'</td>
									<td>'.$e->nne_sSexe.'</td>
									<td>';
					
									echo'</td>
								</tr>';
							}
						echo' </tbody>
						</table>
					</div>';
			
		}
	}	
	
	
	
	
	public function ajoutActeReeducation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			
			for($i=0;$i<count($data['nombre']) AND $i<count($data['duree_reeducation']) AND $i< count($data['uni_reeducation']) AND $i<count($data['act_reeducation']);$i++){
				$aujourdhui = date("Y-m-d H:i:s");
				$maDate = strtotime($aujourdhui."+ ".$data["duree_reeducation"][$i]." days");
				$expiration = date("Y-m-d H:i:s",$maDate). "\n";	
				$maDatedelai = strtotime($aujourdhui."+ 30 days");
				$delai = date("Y-m-d H:i:s",$maDatedelai). "\n";
				$donnees = array(
					"acm_iSta "=>1,
					"lac_id"=>$data['act_reeducation'][$i],
					"pat_id"=>$data["pat_soins"],
					"uni_id"=>$data['uni_reeducation'][$i],
					"acm_dDate"=>$aujourdhui,
					"acm_dDateExp"=>$expiration,
					"acm_dDateDelai"=>$delai,
					"acm_sStatut "=>"en attente"
				);
				$insert = $this->md_patient->ajout_orientation($donnees);
				if($insert){
					$recupAct = $this->md_patient->recup_last_acte_medical();
					$donneeReeducation = array(
						"ree_iSta"=>1,
						"per_id"=>$this->session->medicalis,
						"acm_id"=>$recupAct->acm_id,
						"sea_id"=>$sejour->sea_id,
						"ree_iNombre"=>$data['nombre'][$i],
						"ree_iNbPrinscrit"=>$data['nombre'][$i],
						"ree_dDate"=>$aujourdhui
					);
					
					$this->md_patient->ajout_reeducation($donneeReeducation);
				}
				$acte = $this->md_parametre->recup_act($data['act_reeducation'][$i]);
			}
			$patient = $this->md_patient->recup_patient($data["pat_soins"]);
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_reeducation_ree",
				"log_sIcone"=>"nouveau membre",
				"log_sAction"=>"a fait une prescription",
				"log_sActionDetail"=>"a prescrit  en réeducation le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);
			echo "ok";
			
		}
	
	}
	
	
	
	public function nouveauNe()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}

			$donnees = array(
					"nne_iSta "=>1,
					"pat_id"=>$data['pat_soins'],
					"sea_id"=>$sejour->sea_id,
					"nne_sSexe"=>$data['sexe'],
					"nne_dDateNaiss"=>$this->md_config->recupDateTime($data['datenaiss']),
					"nne_tHeureNaiss"=>$data['heureDate']
				);
				$insert = $this->md_patient->ajout_nouveau_ne($donnees);
				
				
			$patient = $this->md_patient->recup_patient($data["pat_soins"]);
			if($insert){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_nouveau_ne_nne",
					"log_sIcone"=>"nouveau né",
					"log_sAction"=>"a enregistré un nouveau né",
					"log_sActionDetail"=>"a enregistré un nouveau né pour : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);			
			}
		}	
		
		
	
	public function casDeces()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}

			$donnees = array(
					"dec_iSta "=>0,
					"pat_id"=>$data['pat_soins'],
					"sea_id"=>$sejour->sea_id,
					"uni_id"=>$data['unite'],
					"dec_sCause"=>$data['cause'],
					"dec_dDateDeces"=>$this->md_config->recupDateTime($data['datedeces']),
					"dec_tHeureDeces"=>$data['heuredeces']
				);
				$insert = $this->md_patient->nouveau_cas_deces($donnees);
				
				$donn = array("pat_iSta"=>2);
				$this->md_patient->maj_deces($donn, $data['pat_soins']);
				
			$patient = $this->md_patient->recup_patient($data["pat_soins"]);
			if($insert){
				$log = array(
					"log_iSta"=>0,
					"per_id"=>$this->session->medicalis,
					"log_sTable"=>"t_nouveau_ne_nne",
					"log_sIcone"=>"nouveau né",
					"log_sAction"=>"a enregistré un nouveau né",
					"log_sActionDetail"=>"a enregistré un nouveau né pour : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
					"log_dDate"=>date("Y-m-d H:i:s")
				);
				$this->md_connexion->rapport($log);			
			}
	}
		
		
	public function recupDeces()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->sejour($data["id"]);
			$e = $this->md_patient->cas_deces($data["id"]);
			echo '<div class="post-box">
					<h3>Cas de décès <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateFrNum($c->sea_dDate).'</small></h3>                                        
					<br>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Date décès</th>
									<th>heure décès</th>
									<th>Unité</th>
								</tr>
							</thead>
							<tbody>';
							echo '<tr>
									<td>'.$this->md_config->affDateFrNum($e->dec_dDateDeces).'</td>
									<td>'.$e->dec_tHeureDeces.'</td>
									<td>'.$e->uni_sLibelle.'</td>
								
								</tr>';
						
						echo' </tbody>
								<thead>
								<tr>
									<th colspan="3">Cause</th>
								</tr>
							</thead>
							<tbody>';
							echo '<tr>
									<td colspan="4">'.$e->dec_sCause.'</td>
		
								</tr>';
						
						echo' </tbody>
						</table>
					</div>';
			
		}
	}	
	
	
	
	public function ajoutMaladie()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			
			for($i=0;$i<count($data['nom']);$i++){

				
					$donnees = array(
						"dia_iSta"=>1,
						"sea_id"=>$sejour->sea_id,
						"mal_id"=>$data['nom'][$i]
					);
					
					$this->md_patient->ajout_diagnostic($donnees);

			}
			$patient = $this->md_patient->recup_patient($data["pat_soins"]);
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_diagnostic_dia",
				"log_sIcone"=>"nouvelle diagnostique",
				"log_sAction"=>"a ajouté une nouvelle diagnostique",
				"log_sActionDetail"=>"a ajouté une nouvelle diagnostique pour le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);
			
		}
	
	}
	
	
	public function recupDiagnostic()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->sejour($data["id"]);
			$elt = $this->md_patient->diagnostic($data["id"]);
			echo '<div class="post-box">
					<h3>Diagnostic <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Fait '.$this->md_config->affDateFrNum($c->sea_dDate).'</small></h3>                                        
					<br>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Maladie</th>
								</tr>
							</thead>
							<tbody>';
							foreach($elt AS $e){
							echo '<tr>
									<td>'.$e->mal_sLibelle.'</td>
									<td>';
					
									echo'</td>
								</tr>';
							}
						echo' </tbody>
						</table>
					</div>';
			
		}
	}
	
	
	public function ajoutLabo()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			
			$verif = $this->md_patient->verif_sejour($data["id"],date("Y-m-d"));
			if(!$verif){
				$donneesSejour = array(
					"acm_id"=>$data["id"],
					"sea_dDate"=>date("Y-m-d")
				);
				$sejour = $this->md_patient->ajout_sejour_acm($donneesSejour);
			}
			else{
				$sejour = $verif;
			}
			
			$don = array(
				"lab_iSta"=>1,
				"lab_dDate"=>date("Y-m-d H:i:s"),
				"per_id"=>$this->session->medicalis,
				"sea_id"=>$sejour->sea_id
			);
			$insertLab = $this->md_patient->ajout_laboratoire($don);
			for($i=0;$i<count($data['act_labo']) AND $i< count($data['duree']) AND $i< count($data['uni']);$i++){
				$aujourdhui = date("Y-m-d H:i:s");
				$maDate = strtotime($aujourdhui."+ ".$data["duree"][$i]." days");
				$expiration = date("Y-m-d H:i:s",$maDate). "\n";
				
				$maDatedelai = strtotime($aujourdhui."+ 30 days");
				$delai = date("Y-m-d H:i:s",$maDatedelai). "\n";
				$donnees = array(
					"acm_iSta "=>1,
					"lac_id"=>$data['act_labo'][$i],
					"pat_id"=>$data["pat"],
					"uni_id"=>$data['uni'][$i],
					"acm_dDate"=>$aujourdhui,
					"acm_dDateDelai"=>$delai,
					"acm_dDateExp"=>$expiration,
					"acm_sStatut "=>"en attente"                                                                                  
				);
										
				$insert = $this->md_patient->ajout_orientation($donnees);
				if($insert){
					$recupAct = $this->md_patient->recup_last_acte_medical();
					$donneeExp = array(
						"acm_id"=>$recupAct->acm_id,
						"lab_id"=>$insertLab->lab_id,
						"ala_iSta"=>1
					);
					
					$this->md_patient->ajout_prescription_laboratoire($donneeExp);
				}
				$acte = $this->md_parametre->recup_act($data['act'][$i]);
			}
			$patient = $this->md_patient->recup_patient($data["pat"]);
			$log = array(
				"log_iSta"=>0,
				"per_id"=>$this->session->medicalis,
				"log_sTable"=>"t_laboratoire_lab",
				"log_sIcone"=>"nouveau membre",
				"log_sAction"=>"a fait une prescription",
				"log_sActionDetail"=>"a prescrit  en laboratoire le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
				"log_dDate"=>date("Y-m-d H:i:s")
			);
			$this->md_connexion->rapport($log);
			echo "ok";
			
		}
	
	}
	
	
	public function recupLaboratoire()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
			// var_dump($data);
		}
		else{
			$c = $this->md_patient->sejour($data["id"]);
			$elt = $this->md_patient->laboratoire_sejour($data["id"]);
			echo '<div class="post-box">
					<h3>Examen laboratoire <small class="text-success pull-right" style="font-size:14px"><i class="fa fa-calendar"></i> Prescrit le '.$this->md_config->affDateFrNum($c->sea_dDate).'</small></h3>                                        
					<br>
				</div>';
			echo ' <div class="table-responsive">
						<table id="mainTable" class="table table-striped" style="cursor: pointer;">
							<thead>
								<tr>
									<th>Maladie</th>
								</tr>
							</thead>
							<tbody>';
							// foreach($elt AS $e){
							// echo '<tr>
									// <td>'.$e->mal_sLibelle.'</td>
									// <td>';
					
									// echo'</td>
								// </tr>';
							// }
						echo' </tbody>
						</table>
					</div>';
			
		}
	}
	
	
	
}
