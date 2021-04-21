<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caisse extends CI_Controller {

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
		$this->load->view('app/page-liste-caisse');
	}
	
		
	public function ensembleFacture()
	{
		$data = $this->input->post();
		$cout = array();
		$patient = $this->md_patient->recup_patient($data["pat"]);
		echo '
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card all-patients">
						<div class="body">
							<div class="row">
								<div class="col-md-9 col-sm-9 m-b-0">
									<h5 class="m-b-0">'.$patient->pat_sNom.' '.$patient->pat_sPrenom.'</h5> 
								</div>
								<div class="col-md-3 col-sm-3 m-b-0">
									<address class="m-b-0">
										<abbr title="Numéro matricule patient">ID: '.$patient->pat_sMatricule.'</abbr>
								   </address>               
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		';
		$nombre = count($data["id"]);
		echo '
			<table class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
						<th>Acte médical</th>
						<th>Coût de l\'acte</th>
						<th colspan="2">Date</th>
					</tr>
				</thead>
			   
				<tbody>';
					for($i=0;$i<$nombre;$i++){
						$l = $this->md_patient->liste_element_caisse_ajax($data["id"][$i]);
						$cout[] = $l->lac_iCout;
						echo '<tr>
								<td>
									'.$l->lac_sLibelle.'
									<input type="hidden" name="lac[]" value="'.$l->lac_id.'"/>
									<input type="hidden" name="somme[]" value="'.$l->lac_iCout.'"/>
									<input type="hidden" name="duree[]" value="'.$l->lac_iDure.'"/>
									<input type="hidden" name="acm[]" value="'.$data["id"][$i].'"/>
								</td>
								<td>
									'.number_format($l->lac_iCout,2,",",".").' <small>FCFA</small>
								</td>
							
								<td>
									'.$this->md_config->affDateTimeFr($l->acm_dDate).'
								</td>
								<td>
									<i class="fa fa-check text-success" style="font-size:22px"></i>
								</td>
							</tr>';
					 }
				echo '</tbody>
					  <tfooter>
							<tr>
								<th>
									
								</th>
								<th colspan="2" class="text-right">
									<span class="pull-left">Total à payer</span>
									<span class="pull-right">'.number_format(array_sum($cout),2,",",".").' <small>FCFA<small></span>
									<input name="total" type="hidden" value="'.array_sum($cout).'" id="clientPaie"/>
								</th>
								<th></th>
							</tr>
					  </tfooter>
			</table>';
			
		echo '
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card all-patients">
						<div class="body">
							<div class="row" style="margin-bottom:10px">
								<div class="col-md-3 col-sm-3 m-b-0">
									<p>Assurance ? </p> 
								</div>
								<div class="col-md-7 col-sm-7 m-b-0">
									<select id="ass" name="choix" style="width:100%;padding:5px">
										<option value="Non">Non</option>
										<option value="Oui">Oui</option>
									</select>              
								</div>
								<br>
							</div>
							<div class="row cacher" id="assureur" style="margin-bottom:10px">
								<div class="col-md-3 col-sm-3 m-b-0">
									<p>Nom de l\'assureur *</p> 
								</div>
								<div class="col-md-7 col-sm-7 m-b-0">
									<select id="selectAssureur" name="ass" style="width:100%;padding:5px">
										<option value="">---- Choisissez l\'assureur * ----</option>
							';
								$assureur=$this->md_parametre->liste_assureurs_actifs();
								foreach($assureur AS $a){
									echo '<option value="'.$a->ass_id.'">'.$a->ass_sLibelle.'</option>';
								}
							echo '
									</select>              
								</div>
								<br>
							</div>
							<div class="row cacher" id="assurance"  style="margin-bottom:10px">
								<div class="col-md-3 col-sm-3 m-b-0">
									<p>Type d\'assureur *</p> 
								</div>
								<div class="col-md-7 col-sm-7 m-b-0">
									<select id="selectAssurance" name="tas" style="width:100%;padding:5px">
										<option value="">---- Choisissez le type d\'assurance * ----</option>
								';
								$type=$this->md_parametre->liste_type_couverture_assurance_actifs();
								foreach($type AS $t){
									echo '<option value="'.$t->tas_id.'">'.$t->tas_sLibelle.'</option>';
								}
							echo '
									</select>              
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 m-b-0" id="retourCharge">
									<input type="hidden" value="'.array_sum($cout).'" name="montant" />
							
								</div>
							</div>
							<input type="hidden" name="patient" value="'.$data["pat"].'"/>
								
						</div>
					</div>
				</div>
			</div>';

			echo '<script src="'.base_url('assets/js/caisse.js').'"></script>';
	}
	
	
	
	public function chargeAssurance()
	{
		$data = $this->input->post();
			
		if(!empty($data)){
			if($data['tas']!=""){
				// var_dump($data["lac"]);
				$total_charge = array();
				for($i=0;$i<count($data["lac"]) AND count($data["somme"]);$i++){
					$recup = $this->md_parametre->recup_acte_couvert($data["lac"][$i],$data["tas"]);
					// var_dump($recup);
					if($recup){
						$total_charge[] = ($data["somme"][$i]*$recup->tas_iTaux)/100;
					}
					
				}
				$reste = $data["total"] - array_sum($total_charge);
					echo '<p>
							L\'assureur supporte <b style="font-size:16px">'.number_format(array_sum($total_charge),2,",",".").'</b> <small>FCFA</small>, 
							le client paie <b style="font-size:16px">'.number_format($reste,2,",",".").'</b> <small>FCFA</small><br><br>
							<input type="hidden" name="charge" value="'.array_sum($total_charge).'"/>
							<input type="text" value="'.$reste.'" class="obligatoire" name="montant" style="width:88%;padding:2px" />
						  </p>';
			}
		}
		
	}
	
	public function ajoutFactureCaisse()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		
		for($i=0;$i<count($data["acm"]) AND count($data["duree"]);$i++){
			$aujourdhui = date("Y-m-d H:i:s");
			$maDate = strtotime($aujourdhui."+ ".$data["duree"][$i]." days");
			$expiration = date("Y-m-d H:i:s",$maDate). "\n";
			
			$donneesAcm = array("acm_iSta"=>2,"acm_dDateDelai"=>NULL,"acm_dDateExp"=>$expiration,"acm_sStatut"=>"en cours");
			$this->md_patient->maj_actes_caisse($donneesAcm,$data["acm"][$i]);
		}
		
		if($data["choix"]=="Non"){
			$data["ass"]=NULL;
			$data["tas"]=NULL;
		}
		
		if(!isset($data["charge"])){
			$data["charge"]=0;
		}
		
		$donneeFac = array(
			"fac_iSta"=>1,
			"pat_id"=>$data["patient"],
			"per_id"=>$this->session->medicalis,
			"fac_sObjet"=>"Paiement des actes médicaux",
			"fac_iMontantPaye"=>$data["montant"],
			"fac_iMontant"=>$data["total"],
			"fac_iMontantAss"=>$data["charge"],
			"fac_iReste"=>$data["total"]-($data["charge"]+$data["montant"]),
			"fac_dDatePaie"=>date("Y-m-d"),
			"ass_id"=>$data["ass"],
			"tas_id"=>$data["tas"]
		);
		
		$insertFac = $this->md_patient->ajout_facture($donneeFac);
		$patient = $this->md_patient->recup_patient($data["patient"]);
		$log = array(
			"log_iSta"=>0,
			"per_id"=>$this->session->medicalis,
			"log_sTable"=>"t_facture_fac",
			"log_sIcone"=>"nouveau membre",
			"log_sAction"=>"a fait une facture",
			"log_sActionDetail"=>"a facture au patient : <strong style='text-decoration:underline'>".$patient->pat_sNom." ".$patient->pat_sPrenom." (".$patient->pat_sMatricule.")</strong>",
			"log_dDate"=>date("Y-m-d H:i:s")
		);
		$this->md_connexion->rapport($log);
		
		for($i=0;$i<count($data["acm"]);$i++){
			$donneesElt = array("acm_id"=>$data["acm"][$i],"fac_id"=>$insertFac);
			$this->md_patient->ajout_elements_facture($donneesElt);
		}
			 
		$this->load->view('impression/recu_caisse', array("id"=>$insertFac));
	
		//chargement de HTML
		$html=$this->output->get_output();
		
		//chargement de la librairie pdf
		$this->load->library('pdf');
		
		//chargement du contenu HTML
		$this->dompdf->loadHTML($html);
		
		//setup paper size and orientation
		$this->dompdf->setPaper('A7', 'portrait');//recu_pharmacie
		// $this->dompdf->setPaper('A4', 'portrait');//courrier;dossier_medical;fiche_personnel;laboratoire;liste-inventaire-stock;hospitalisation
		// $this->dompdf->setPaper('A5', 'portrait');//ordonnance;acte_de_deces;acte_de_naissance;consultation;imagerie
		// $this->dompdf->setPaper('A5', 'portrait');//acte_de_naissance
		
		//render HTML as PDF
		$this->dompdf->render();
		
		//output PDF
		$this->dompdf->stream("reçu_de_caisse_".$insertFac.".pdf",array('attachment'=>0));
		return redirect('caisse');	

		
	}
	
}
