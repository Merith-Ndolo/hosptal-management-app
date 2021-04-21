<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratoire extends CI_Controller {

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
	 
	 
	 
	public function sortie_reactif()
	{
		$this->load->view('app/page-sortie-reactif');
	}
	
	public function destock_reactif()
	{
		$this->load->view('app/page-destock-reactif');
	}	
	
	public function stock_reactif()
	{
		$this->load->view('app/page-stock-reactif');
	}		
	
	public function historique_reactif()
	{
		$this->load->view('app/page-historique-reactif');
	}	
	
	public function entree_reactif()
	{
		$this->load->view('app/page-entree-reactif');
	}		
	
	
	
	public function liste_sortie_accessoire()
	{
		$this->load->view('app/liste-sortie-accessoire');
	}	
	
	public function sortir_accessoire($id)
	{
		$this->load->view('app/page-sortir-accessoire',array("sac_id"=>$id));
	}
	 
	public function stock_accessoires()
	{
		$this->load->view('app/page-accessoire-enstock');
	}		
	
	public function entree_accessoire()
	{
		$this->load->view('app/page-entree-accessoire');
	}		
	
	public function stock_accessoire()
	{
		$this->load->view('app/page-stock-accessoire');
	}	
	
	
	public function prevelements()
	{
		$this->load->view('app/page-laboratoire-prevelements');
	}		
	
	public function examens()
	{
		$this->load->view('app/page-laboratoire-examens');
	}	
		
	public function examens_faites()
	{
		$this->load->view('app/page-laboratoire-examens-faits');
	}	
	
	public function patient_en_examen($id)
	{
		$this->load->view('app/page-exploration-patient',array("aef_id"=>$id));
	}
	
	public function prelevement_tube($id)
	{
		$recup = $this->md_patient->acm_laboratoire_unique($id);
		$element = $this->md_parametre->element_analyse_actifs($recup->lac_id);
		// var_dump($element);
		foreach($element AS $e){
			$dataTube = array(
				"tan_iSta"=>1,
				"ala_id"=>$id,
				"ela_id"=>$e->ela_id
			);
			
		}
	}
	
	public function remettre_reactif($id)
	{
		$donnees = array(
			"res_dDateRetour"=>date("Y-m-d"),
			"sor_iSta"=>2
		);
		$this->md_parametre->maj_sortie($donnees,$id);
		return redirect("laboratoire/sortie_reactif");
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
	
		/*********** accessoire  ***************************/
			
			
	public function entreeAccessoire()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("pharmacie/entree_stock");
		}
		else{
		for($i=0;$i<count($data['dep']) AND $i<count($data['lib']) AND $i<count($data['seuil']);$i++){
			$verif = $this->md_laboratoire->verif_entree_accessoire(trim($data['dep'][$i]));
			$donnees = array(
				"eac_iQte"=>ucfirst(trim($data['lib'][$i])),
				"acc_id"=>$data['dep'][$i],
				"eac_dDateEntree"=>date("Y-m-d H:i:s"),
				"eac_iSta"=>1
			);
			$insert = $this->md_laboratoire->entree_accessoire($donnees);
			if(!$verif){
				$donneesDetails = array(
					"acc_id"=>$data['dep'][$i],
					"sac_iSta"=>1,
					"sac_iQte"=>trim($data['lib'][$i]),
					"sac_iSeuil"=>trim($data['seuil'][$i])
				);
				$insertDetail = $this->md_laboratoire->entree_stock_accessoire($donneesDetails);				
			}
			else{
				$donnees = array(
					"sac_iQte"=>$data['lib'][$i]+$verif->sac_iQte,
					"sac_iSta"=>1,
					"sac_iSeuil"=>trim($data['seuil'][$i])
				);
				$update = $this->md_laboratoire->maj_entree_accessoire($donnees,$verif->sac_id);
			}
		}
	
	}		
	}		
			
	public function sortirAccessoire()
	{
		date_default_timezone_set('Africa/Brazzaville');
		
		$data = $this->input->post();
		
			$recup = $this->md_laboratoire->recup_accessoire($data['id']);
			$qte = $recup->sac_iQte - $data['qte'];
		
			if($qte < 0){
			echo 'La quantité saisie est supérieure à la quantité en stock';}else{
			$donnees = array(
				"acs_iSta"=>1,
				"per_iAutorisant"=>$this->session->medicalis,
				"per_iBenef"=>$data['benef'],
				"acs_iQte"=>$data['qte'],
				"sac_id"=>$data['id'],
				"acs_dDateSorti"=>$this->md_config->recupDateTime($data['date'])
			);
			$insert = $this->md_laboratoire->sortir_accessoire($donnees);
			
			if($insert){
				$recup = $this->md_laboratoire->recup_accessoire($data['id']);
				$qte = $recup->sac_iQte - $data['qte'];
				
				$donn = array(
					"sac_iQte"=>$qte
					);
				
				$updat = $this->md_laboratoire->maj_sortir_accessoire($donn, $recup->sac_id);
			}
			}
	}
	
	public function entreeReac()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			return redirect("pharmacie/entree_stock");
		}
		else{
			for($j=0; $j<count($data['dep']) AND $j<count($data['qte']) AND $j<count($data['seuil']);$j++){
				$verif = $this->md_parametre->verif_entree_reactif($data['dep'][$j]);
				if(!$verif){
					$donnees = array(
					"ere_iSta"=>1,
					"rea_id"=>$data['dep'][$j],
					"ere_iQte"=>trim($data['qte'][$j]),
					"ere_iSeuil"=>trim($data['seuil'][$j]),
					"ere_dDate"=>date("Y-m-d")
					);
					$insert = $this->md_parametre->entree_stock_reactif($donnees);
					
					if($insert){
						$donneesDetails = array(
							"ere_id"=>$insert->ere_id,
							"hre_iQte"=>trim($data['qte'][$j]),
							"hre_dDateEntree"=>date("Y-m-d")
						);
						$insertDetail = $this->md_parametre->entree_detail_stock($donneesDetails);
						
						if($insertDetail){
							$recup = $this->md_parametre->recup_reactif_actifs($data['dep'][$j]);
							for($i=0;$i<$data['qte'][$j];$i++){
								$code = $this->md_config->genereCodeBarre("REA","reactif",$insert->rea_sLibelle);
								$valeurBarre = explode("--//--",$code);
								$donneesProd = array(
									"ere_id"=>$insert->ere_id,
									"res_iSta "=>1,
									"res_sCode"=>$valeurBarre[0],
									"res_iNb"=>$recup->rea_iNb,
									"res_sImg"=>$valeurBarre[1]
								);
								
								$this->md_parametre->ajout_entree_reactif($donneesProd);
							}
							
							// $log = array(
								// "log_iSta"=>0,
								// "per_id"=>$this->session->medicalis,
								// "log_sTable"=>"t_achats_ach",
								// "log_sIcone"=>"nouveau membre",
								// "log_sAction"=>"a effectué une nouvelle entrée",
								// "log_sActionDetail"=>"quantité entrée : <strong style='text-decoration:underline'>".ucfirst(trim($data['qte']))."</strong>",
								// "log_dDate"=>date("Y-m-d H:i:s")
							// );
							// $this->md_connexion->rapport($log);		
						}
					}				
						
				}
				else{
					$donnees = array(
						"ere_iQte"=>trim($data['qte'][$j])+$verif->ere_iQte,
						"ere_iSeuil"=>trim($data['seuil'][$j])
					);
					$update = $this->md_parametre->maj_entree_stock_reactif($donnees,$verif->ere_id);
					
					if($update){
						$donneesDetails = array(
							"ere_id"=>$verif->ere_id,
							"hre_iQte"=>trim($data['qte'][$j]),
							"hre_dDateEntree"=>date("Y-m-d")
						);
						$insertDetail = $this->md_parametre->entree_detail_stock($donneesDetails);
						
						if($insertDetail){
							$recup = $this->md_parametre->recup_reactif_actifs($data['dep'][$j]);
							for($i=0;$i<$data['qte'][$j];$i++){
								$code = $this->md_config->genereCodeBarre("REA","reactif",$verif->rea_sLibelle);
								$valeurBarre = explode("--//--",$code);
								$donneesProd = array(
									"ere_id"=>$verif->ere_id,
									"res_iSta "=>1,
									"res_sCode"=>$valeurBarre[0],
									"res_iNb"=>$recup->rea_iNb,
									"res_sImg"=>$valeurBarre[1]
									
								);
								
								$this->md_parametre->ajout_entree_reactif($donneesProd);
							}
							
							// $log = array(
								// "log_iSta"=>0,
								// "per_id"=>$this->session->medicalis,
								// "log_sTable"=>"t_achats_ach",
								// "log_sIcone"=>"nouveau membre",
								// "log_sAction"=>"a effectué une nouvelle entrée",
								// "log_sActionDetail"=>"quantité entrée : <strong style='text-decoration:underline'>".ucfirst(trim($data['qte']))."</strong>",
								// "log_dDate"=>date("Y-m-d H:i:s")
							// );
							// $this->md_connexion->rapport($log);		
						}
					}
				}
			}		
		}		
	}

	
	
	public function destockageReactif()
	{
		date_default_timezone_set('Africa/Brazzaville');
		
		$data = $this->input->post();
		for($i=0;$i<count($data['ere']) AND $i<count($data['id']);$i++){
			$donnees = array(
				"res_sMotif"=>$data['motif'],
				"res_iSta"=>2,
				"res_dDateDestockage"=>date("Y-m-d")
			);
			$update = $this->md_parametre->destock_reactif($donnees,$data['id'][$i]);
			
			if($update){
				$recup = $this->md_parametre->reactif_en_stock($data['ere'][$i]);
				$qte = $recup->ere_iQte - 1;
				
				$donn = array(
					"ere_iQte"=>$qte
				);
				
				$updat = $this->md_parametre->maj_entree_stock_reactif($donn, $recup->ere_id);
			}
		}
	}
	
	public function ensembleSortie()
	{
		date_default_timezone_set('Africa/Brazzaville');
		
		$data = $this->input->post();
		echo '
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
					   
						<thead>
							<tr>
								<th>Réactif</th>
								<th>Code à barre</th>
								<th>Examen à faire</th>
								<th>Bénéficiaire</th>
							</tr>
						</thead>
					   
						<tbody>';
				$l = $this->md_parametre->liste_stock_reactif_selection($data['id']);
				$per = $this->md_personnel->nb_complete_personnel();
				echo '<tr>	
						
						<td>
							'.$l->rea_sLibelle.'
						</td>
						<td>
							<input type="hidden" name="idRes" value="'.$l->res_id.'"/>
							'.$l->res_sCode.'
						</td>									
															
						<td>
							
							<ul>';
								
									$reactif = $this->md_parametre->liste_examen_reactif_actifs($l->rea_id);
									if(empty($reactif)){
										echo "<i class='text-danger' style='font-size:12px'>Pas d'examens liés à ce réactif</i>";
									}
									else{
										echo "<ul style='list-style-type:none;padding:0'>";
										foreach($reactif AS $r){
											$verif=$this->md_parametre->liste_examen_reactif_nu_actifs($r->tex_id,$l->res_id);
											if(!$verif){
												echo "<li><input name='tex[]' type='checkbox' id='remember_me".$r->rex_id."' class='filled-in obligatoire' value='".$r->tex_id."'><label for='remember_me".$r->rex_id."'>".$r->tex_sLibelle."</label></li>";
											}
										} 
										echo "</ul>";
									}
								
						echo '</ul>
						
						</td>
						<td>
							<select class="obligatoire" name="per" ><option value="">--- Choisissiez la personne qui rétire ---</option>';
							
							foreach($per AS $p){
								echo '<option value="'.$p->per_id.'">'.$p->per_sNom.' '.$p->per_sPrenom.' ('.$p->per_sMatricule.')</option>';
							}
					  echo '</select>
						</td>
						
					</tr>';
		echo '</tbody>
			</table>';
	}
	
	
	public function sortieReactif()
	{
		date_default_timezone_set('Africa/Brazzaville');
		
		$data = $this->input->post();
		
		$nb = count($data['tex']);
		$res = $this->md_parametre->liste_stock_reactif_selection($data['idRes']);
		// var_dump($res);
		$reste= $res->res_iNb-$nb;
		if($reste==0){
			$sta=2;
			$motif="a atteint la limite d\'utilisation";
			$date=date("Y-m-d");
			$recup = $this->md_parametre->reactif_en_stock($res->ere_id);
			$qte = $recup->ere_iQte - 1;
			$donn = array(
				"ere_iQte"=>$qte
			);
			
			$updat = $this->md_parametre->maj_entree_stock_reactif($donn, $recup->ere_id);
		}
		else{
			$sta=1;
			$motif=NULL;
			$date=NULL;
		}
		$donneesD = array(
			"res_sMotif"=>$motif,
			"res_iSta"=>$sta,
			"res_iNb"=>$reste,
			"res_dDateDestockage"=>$date
		);
		$update = $this->md_parametre->destock_reactif($donneesD,$data['idRes']);
		
		if($update){
			for($i=0;$i<count($data['tex']);$i++){
				
				$donnees = array(
					"sor_iSta"=>1,
					"res_id"=>$data['idRes'],
					"tex_id"=>$data['tex'][$i],
					"res_iDon"=>$this->session->medicalis,
					"res_iDest"=>$data['per'],
					"res_dDateSortie"=>date("Y-m-d")
				);
				$insert = $this->md_parametre->sortie_reactif($donnees);
			}
		}
		
	}
}
