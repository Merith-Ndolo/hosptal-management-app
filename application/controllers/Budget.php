<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget extends CI_Controller {

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
	public function creation()
	{
		$this->load->view('app/page-Lignes-budgetaires');
	}
	public function liste()
	{
		$this->load->view('app/page-Liste-budget');
	}
	public function ajoutLigneBudget()
	{
		$data=$this->input->post();
		$verif1=$this->md_budget->verif_ligne_budget(ucfirst(trim($data['lib'])));
		if(!$verif1){
			$dataLib=array(
				"lib_iSta"=>1,
				"lib_sLibelle"=>ucfirst(trim($data['lib'])),
				"lib_sObjectifs"=>ucfirst(trim($data['objectif'])),
				"lib_dDate_crea "=>date("Y-m-d"),
				"lib_dDate_exe"=>$this->md_config->recupDateTime($data['date']),
				"lib_iMontant"=>trim($data['montant']),
				"lib_iSeuil"=>trim($data['seuil']),
				"lib_iEtat"=>trim($data['etat'])
				
			);
			
			$lignes_budgetaires=$this->md_budget->insert_lignes_budget($dataLib);
			if($lignes_budgetaires){
				$dataHib=array(
					"lib_id"=>$lignes_budgetaires->lib_id,
					"hib_iMontant"=>trim($data['montant'])
				);
				
				$historique_budgetaire=$this->md_budget->insert_historique($dataHib);
				if($historique_budgetaire){
					for($i=0; $i<count($data['uni']);$i++){
						$verif=$this->md_budget->verif_budget_unite($data['uni'][$i],$lignes_budgetaires->lib_id);
						if(!$verif){
							$dataBun=array(
								"bun_iSta"=>1,
								"lib_id"=>$lignes_budgetaires->lib_id,
								"uni_id"=>$data['uni'][$i]
							);
							$this->md_budget->insert_unite_budgetaire($dataBun);
						}
					}
					echo "Ligne budgetaire enregistrée!";
				}
				
				
			}
		}
		
		
	}
	
	
	
	
	
}
