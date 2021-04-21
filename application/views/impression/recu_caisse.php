<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$info = $this->md_parametre->info_structure(); $fac = $this->md_patient->detail_facture($id); $elt = $this->md_patient->element_facture($id);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Réçu</title>
		<meta charset="UTF-8">
		<style>
			@page { margin:10px 0px 0px 0px; height:100%;}
			body { margin: 0px;}
			table.footer{ position:fixed; bottom:40px; left:0px; right:0px; }

		</style>
		<!--<script type="text/javascript" src="assets/js/imprimer.js')"></script>-->
	</head>
	
	<body style="font-family:cursive">
		<!--<div style="width:300px; border:1px solid black; padding:5px 10px 0px 10px" class="recu">-->
		<div style=" padding:5px 10px 0px 10px" class="recu">
			<!-- En-tête du reçu -->
			<table style="width:100%; height:50px" >
				<tr>
					<td  align="center" ><img src="<?php echo base_url($info->str_sLogo) ;?>" style="width:40px; height:40px" border="0" /></td>
				</tr>
				<tr> 
					<td style="font-size:13px; height:20px; font-weight:bold" align="center"><u>RECU CAISSE</u></td>
				</tr>
			</table>
		 <!-- Corps de reçu -->
			<table style="width:100%; height:50px; font-size:10px">
				<td  style="width:40%">N° : <?php echo $fac->fac_sNumero  ;?></td>
				<td  style="width:40%"><?php echo $fac->pat_sMatricule    ;?>: <?php echo $fac->pat_sNom.' '.$fac->pat_sPrenom   ;?></td>
				<td align="right"  style="width:20%">Payée le <?php echo $this->md_config->affDateFrNum($fac->fac_dDatePaie) ; ?></td>
			</table>
	
			<table style="width:100%; height:50px; font-size:10px">
				<tr>
					<td style="width:40%; font-weight:bold">Mode de paiement: </td>
					<td style="width:60%"><?php if(is_null($fac->ass_id)){echo 'comptant';}else{echo 'Par assurance';} ;?></td>
				</tr>
				<tr>
					<td style="width:40%; font-weight:bold"></td>
					<td style="width:60%"><?php if(!is_null($fac->ass_id)){echo 'Assureur: <b>'.$fac->ass_sLibelle.'</b>';} ;?></td>
				</tr>
			
				<tr style="height:15px">
					<td></td>
					<td></td>
				</tr>
			</table>
			
			
				
			<table style="width:100%; font-size:10px; border:1px dashed black">
				<thead>
					<th style="width:5%">#</th>
					<th align="left" style="width:15%">Acte</th>
					<?php if(!is_null($fac->ass_id)){?>
					<th align="left" style="width:50%">Couverture assurance</th>
					<?php }?>
					<th align="left" style="width:30%">Coût</th>
				</thead>
				<tbody class="corps">
				<?php foreach($elt AS $e){?>
					<tr style="border:1px dashed black">
						<td align="center">2</td>
						<td align="left"><?php echo $e->lac_sLibelle ;?></td>
						<?php if(!is_null($fac->ass_id)){?>
						<td align="left">
							<?php $recup = $this->md_parametre->recup_acte_couvert($e->lac_id,$fac->tas_id);?>
							<?php if($recup){echo 'L\'assureur couvre '. $fac->tas_iTaux.' % du coût de l\'acte médical';}else{echo 'Acte non couvert par l\'assureur';};?> 
						</td>
						<?php }?>	
						<td align="left"><?php echo number_format($e->lac_iCout,2,",",".") ;?> <small>FCFA</small></td>
					</tr>
				<?php }?>	
					
					<tr style="border:1px dashed black">
						<td></td>
						<td></td>
						<td align="right" style="font-weight:bold">TOTAL: </td>
						<td align="left" style="font-weight:bold"><?php echo number_format($fac->fac_iMontant,2,",",".")  ;?>  <small>FCFA</small></td>
					</tr>
					</tbody>
				</table>
				
			<table style="width:100%; font-size:10px;">
					<?php if(!is_null($fac->ass_id)){ ;?>
					<tr>
						<td align="right" style="width:70%">Montant payé par l'assureur :</td>
						<td align="left" style="font-weight:bold"><?php echo number_format($fac->fac_iMontantAss,2,",",".").' <small>FCFA</small>' ;?></td>
					</tr>
					<?php }?>
					<tr>
						<td align="right"  style="width:70%">Montant payé par le patient: </td>
						<td align="left" style="font-weight:bold"><?php echo number_format($fac->fac_iMontantPaye,2,",",".")   ;?>  <small>FCFA</small></td>
					</tr>
				
			</table>
			
			<table class="footer" style="width:100%; font-weight:bold; font-size:10px">
				<tr>
					<td  align="center" style="width:100%"><span>Email: <span style="color:maroon"><i><u><?php echo $info->str_sEmail   ;?></u></i></span></span>
					</td>
				</tr>
				<tr>
					<td align="center" style="font-size:10px">tel:<?php echo $info->str_sTel   ;?></td>
				</tr>
			
			</table>

				

		</div>
	</body>
</html>