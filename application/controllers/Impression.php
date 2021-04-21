<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impression extends CI_Controller {
	
	public function equipement($id)
	{
		if(!isset($id)){
			return redirect();
		}
		else{
			$equip = $this->md_client->equipement_detail($id);
			//load the view and saved it into $html variable
			$html=$this->load->view('impression/equipement', array("e"=>$equip), true);

			//this the the PDF filename that user will get to download
			$pdfFilePath = "equipement.pdf";

			//load mPDF library
			$this->load->library('m_pdf');

		   //generate the PDF from the given html
			$this->m_pdf->pdf->WriteHTML($html);

			//download it.
			$this->m_pdf->pdf->Output($pdfFilePath, 'D','A4');
		}
	}
	
	public function offre($id)
	{
		if(!isset($id)){
			return redirect();
		}
		else{
			$offre = $this->md_client->offre_detail($id);
			//load the view and saved it into $html variable
			$html=$this->load->view('impression/ote', array("o"=>$offre), true);

			//this the the PDF filename that user will get to download
			$pdfFilePath = "offre_technique_".$offre->ote_sNumero.".pdf";

			//load mPDF library
			$this->load->library('m_pdf');

		   //generate the PDF from the given html
			$this->m_pdf->pdf->WriteHTML($html);

			//download it.
			$this->m_pdf->pdf->Output($pdfFilePath, 'D','A4');
		}
	}
	
	
	public function aro($id)
	{
		if(!isset($id)){
			return redirect();
		}
		else{
			$aro = $this->md_client->detail_aro($id);
			$etape = $this->md_client->liste_etape_aro($id);
			$ote = $this->md_client->liste_ote_detail($aro->ote_id);
			$agent=$this->md_utilisateur->agent($aro->per_id);
			//load the view and saved it into $html variable
			$html=$this->load->view('impression/aro', array("a"=>$aro,"e"=>$etape,"o"=>$ote,"p"=>$agent), true);

			//this the the PDF filename that user will get to download
			$pdfFilePath = "offre_technique_AFRI-ITAL-ARO FORM-TEC-".$aro->aro_id.".pdf";

			//load mPDF library
			$this->load->library('m_pdf');

		   //generate the PDF from the given html
			$this->m_pdf->pdf->WriteHTML($html);

			//download it.
			$this->m_pdf->pdf->Output($pdfFilePath, 'D','A4-L');
		}
	}
	
	
}
