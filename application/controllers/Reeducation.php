<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reeducation extends CI_Controller {

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
	public function seance($id)
	{
		$this->load->view('app/page-seance-reeducation',array('id'=>$id));
	}		
	
	public function assignation()
	{
		$this->load->view('app/page-reeducation-assignation');
	}		
	
	public function patient_traite()
	{
		$this->load->view('app/page-infirmerie-traite');
	}

	public function ajoutReeducation()
	{
		date_default_timezone_set('Africa/Brazzaville');
		$data = $this->input->post();
		if(empty($data)){
			echo "erreur";
		}
		else{
			$recup = $this->md_patient->recup_seance($data['idReeducation']);
			$nbSeanceRestant = $recup->ree_iNombre - 1;
			$donn = array(
				"ree_iNombre"=>$nbSeanceRestant
			);
			$this->md_patient->maj_seance($donn,$data['idReeducation']);
			
			$donnees = array(
				"sre_iPersonnel"=>$data['idSession'],
				"ree_id"=>$data['idReeducation'],
				"sre_sObservation"=>$data['observation'],
				"sre_tHeureDebut"=>$data['hd'],
				"sre_tHeureFin"=>$data['hf'],
				"sre_dJour"=>$this->md_config->recupDateTime($data['jour'])
			);

			$insert = $this->md_patient->ajout_reeducation($donnees);
			
			// if($insert){
			// $log = array(
				// "log_iSta"=>0,
				// "per_id"=>$this->session->medicalis,
				// "log_sTable"=>"t_seance_reeducation_sre",
				// "log_sIcone"=>"nouvelle seance de réeducation",
				// "log_sAction"=>"a ajouté une nouvelle seance de réeducation",
				// "log_sActionDetail"=>"a prescrit  en soins infirmier le patient : ".$patient->pat_sNom." ".$patient->pat_sPrenom."(".$patient->pat_sMatricule.") pour l'acte de soins : ".$acte->lac_sLibelle,
				// "log_dDate"=>date("Y-m-d H:i:s")
			// );
			// $this->md_connexion->rapport($log);
			// }
			$recup = $this->md_patient->recup_seance($data['idReeducation']);
			
			if($recup->ree_iNombre!=0){
				$listeSeance = $this->md_patient->liste_seance_reeducation($data['idReeducation']);
				foreach($listeSeance AS $ls){ 
					echo'<tr>
						<td>
							'.$this->md_config->affDateFrNum($ls->sre_dJour).'
						</td>									
						<td>
							'.$ls->sre_tHeureDebut.'
						</td>									
						<td>
							'.$ls->sre_tHeureFin.'
						</td>					
						<td>
							'.$ls->sre_sObservation.'
						</td>					
					</tr>';
					}
			
				echo '-//-';
				echo $recup->ree_iNombre;
			}else{
				$donna = array("ree_iSta"=>2);
				$this->md_patient->maj_statut_seance($donna, $data['idReeducation']);
				echo "fin-//-'";
				$listeSeance = $this->md_patient->liste_seance_reeducation($data['idReeducation']);
				foreach($listeSeance AS $ls){ 
					echo'<tr>
						<td>
							'.$this->md_config->affDateFrNum($ls->sre_dJour).'
						</td>									
						<td>
							'.$ls->sre_tHeureDebut.'
						</td>									
						<td>
							'.$ls->sre_tHeureFin.'
						</td>					
						<td>
							'.$ls->sre_sObservation.'
						</td>					
					</tr>';
					}
			
				echo '-//-';
				echo $recup->ree_iNombre;
			}
		}
	
	}	
	
}
