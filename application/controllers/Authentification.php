<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentification extends CI_Controller {

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
		if(isset($this->session->medicalis) AND $this->session->medicalis!=NULL){
			redirect("accueil");
		}
		else{
			$this->load->view('login/page-connexion');
		}
		
	}
		
	
	public function oublie()
	{
		if(isset($this->session->medicalis) AND $this->session->medicalis!=NULL){
			redirect("accueil");
		}
		else{
			$this->load->view('login/page-oublie');
		}
		
	}
	
	
	public function se_connecter()
	{
		$data = $this->input->post();
		if(empty($data)){
			return redirect();
		}
		else{
			date_default_timezone_set('Africa/Brazzaville');
			$login = trim(strtolower($data["login"]));
			$pwd = trim($this->md_config->cryptPass($data["pwd"]));
			
			if(!is_numeric($login)){
				$reponse=$this->md_config->verifMail($login);
				if($reponse){
					$reponse="";
				}
				else{
					$reponse='Format email incorrect';
				}
			}
			else{
				$reponse=$this->md_config->formatPhoneCongo($data["login"]);
				if($reponse){
					$reponse="";
					$login = "+242".$login;
				}
				else{
					$reponse='Ce numéro de téléphone n\'est pas un format reconnu au Congo';
				}
			}
			
			if($reponse !=""){
				echo $reponse;
			}
			else{
				$connectMail = $this->md_connexion->se_connecter_email($login,$pwd);
				$connectTel = $this->md_connexion->se_connecter_tel($login,$pwd);
				// var_dump($connect);
				if($connectMail AND !$connectTel){
					$this->session->set_userdata(array("medicalis"=>$connectMail->per_id));
					if($connectMail->per_sSexe == "F"){
						$user="connectée";
					}
					else{
						$user="connecté";
					}
					$log = array(
						"log_iSta"=>0,
						"log_iType"=>0,
						"per_id"=>$connectMail->per_id,
						"log_sTable"=>"t_personnel_per",
						"log_sIcone"=>"connexion",
						"log_sAction"=>"s'est ".$user,
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
					echo 'login';
				}
				else if(!$connectMail AND $connectTel){
					$this->session->set_userdata(array("medicalis"=>$connectTel->per_id));
					if($connectTel->per_sSexe == "F"){
						$user="connectée";
					}
					else{
						$user="connecté";
					}
					$log = array(
						"log_iSta"=>0,
						"log_iType"=>0,
						"per_id"=>$connectTel->per_id,
						"log_sTable"=>"t_personnel_per",
						"log_sIcone"=>"connexion",
						"log_sAction"=>"s'est ".$user,
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
					echo 'login';
				}
				else{
					$log = array(
						"log_iSta"=>0,
						"log_iType"=>0,
						"log_sTable"=>"t_personnel_per",
						"log_sIcone"=>"connexion échouée",
						"log_sAction"=>"Tentative de connexion",
						"log_sActionDetail"=>"Tentative de connexion avec l'identifiant: ".trim($data["login"])." ; et le mot de passe: ".trim($data["pwd"]),
						"log_dDate"=>date("Y-m-d H:i:s")
					);
					$this->md_connexion->rapport($log);
					echo 'Identifiant ou mot de passe incorrect';
				}
			}
			
		}
	}
	
	
	public function deconnexion()
	{	
		date_default_timezone_set('Africa/Brazzaville');
		$info = $this->md_connexion->personnel_connect();
		if($info->per_sSexe == "F"){
			$user="déconnectée";
		}
		else{
			$user="déconnecté";
		}
		$log = array(
			"log_iSta"=>0,
			"per_id"=>$this->session->medicalis,
			"log_sTable"=>"t_personnel_per",
			"log_sIcone"=>"déconnexion",
			"log_sAction"=>"s'est ".$user,
			"log_dDate"=>date("Y-m-d H:i:s")
		);
		$this->md_connexion->rapport($log);
		$this->session->sess_destroy();
		
		return redirect();
	}
	
}
