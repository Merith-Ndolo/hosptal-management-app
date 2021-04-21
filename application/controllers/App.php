<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

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
		$this->load->view('app/page-dashboard');
	
	}
	
	public function profil()
	{
		$this->load->view('app/page-profil-connect');
	
	}
	
	public function notifications()
	{
		$donnees = array("log_iSta"=>1);
		$this->md_rapport->updateRapport($donnees);
		$this->load->view('app/page-notifications');
	
	}
	
	public function listNotifications(){
		$notifications = $this->md_rapport->notifications();
		foreach($notifications AS $n){
			echo '<li>'; 
				if($n->log_iSta==0){
					$style="background:rgba(0,0,0,0.1)";
				}
				else{
					$style="";
				}
				echo '<a href="javascript:void(0);" style="'.$style.'">';
					if($n->log_sIcone == "nouveau membre"){
						echo '<div class="icon-circle bg-light-green"><i class="zmdi zmdi-account-add"></i></div>';
					}
					else if($n->log_sIcone == "achat"){
						echo '<div class="icon-circle bg-cyan"><i class="zmdi zmdi-shopping-cart-plus"></i></div>';
					}
					else if($n->log_sIcone == "suppression"){
						echo '<div class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>';
					}
					else if($n->log_sIcone == "modification"){
						echo '<div class="icon-circle bg-orange"><i class="zmdi zmdi-edit"></i></div>';
					}
					else if($n->log_sIcone == "commentaire post"){
						echo '<div class="icon-circle bg-blue-grey"><i class="zmdi zmdi-comment-alt-text"></i></div>';
					}
					else if($n->log_sIcone == "modification compte"){
						echo '<div class="icon-circle bg-light-green"><i class="zmdi zmdi-refresh-alt"></i></div>';
					}
					else if($n->log_sIcone == "connexion"){
						echo '<div class="icon-circle bg-light-green"><i class="fa fa-sign-in"></i></div>';
					}
					else if($n->log_sIcone == "déconnexion"){
						echo '<div class="icon-circle bg-orange"><i class="fa fa-power-off"></i></div>';
					}
					else if($n->log_sIcone == "connexion échouée"){
						echo '<div class="icon-circle bg-red"><i class="fa fa-home"></i></div>';
					}
					echo '<div class="menu-info" style="color:black">';
						echo '<h4  style="font-size:12px;"><b>'.$n->per_sNom.' '.$n->per_sPrenom.'</b> '.$n->log_sAction.'</h4>';
						echo '<p> <i class="fa fa-clock-o"></i> '.$this->md_config->affDateTimeFr($n->log_dDate).' </p>';
					echo '</div>';
				echo '</a>';
			echo '</li>';
		}
	}
	
	public function nbNotifications(){
		$nb = $this->md_rapport->nbNotifications();
		
		if(count($nb)==0){
			echo "";
		}
		else{
			echo count($nb);				
		}
	}
	
}
