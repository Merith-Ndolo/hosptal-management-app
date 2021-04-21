<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $info = $this->md_parametre->info_structure(); $ord = $this->md_patient->recup_ordonnance($id); $element = $this->md_patient->element_ordonnance($id);?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ordonnance</title>
		<meta charset="UTF-8">
		<style>
			@page { margin:10px 0px 0px 0px; height:100%;}
			body { margin: 0px;}
			table.footer{ position:fixed; bottom:40px; left:0px; right:0px; }

		</style>
		<!--<script type="text/javascript" src="assets/js/imprimer.js')"></script>-->
	</head>
	
	<body>
		<div style="padding:0px 30px 0px 30px" >
			<!-- En-tête du reçu -->
			<table style="width:100%; height:120px" >
				<tr>
					<td  align="left" ><img src="<?php echo base_url($info->str_sLogo) ;?>" width="100px" height="100px" border="0" /><br><span align="right"><?php echo $info->str_sEnseigne  ;?><span></td>
				</tr>
			</table>
			
			<table style="width:100%; font-size:12px">
				<tr> 
					<td style="font-size:25px; height:20px; font-weight:bold" align="center"><u>ORDONNANCE MEDICAL</u></td>
				</tr>
				<tr>
					<td align="center" style="font-weight:bold"><br><?php echo $ord->per_sTitre.' '.$ord->per_sNom.' '.$ord->per_sPrenom  ;?></td>
				</tr>
			</table>
			
			<table style="width:100%; height:100px; font-size:12px">
				<tr>
					<td style="width:30%">Ordonnance N: <?php echo $ord->ord_id ;?></td>
					<td style="width:70%" align="right"><?php echo $ord->ord_dDate ;?></td>
				</tr>
				<tr>
					<td colspan="2" style="height:50px">Patient : <?php echo $ord->pat_sNom.' '.$ord->pat_sPrenom  ;?></td>
				</tr>
				
			</table>
			<!-- Corps de reçu -->
			<table style="width:100%; font-size:12px">
				<thead align="left">
					<th>Produit prescrit</th>
					<th style="width:40px">Qté</th>
					<th style="width:60px">Posologie</th>
					<th style="width:60px">Durée</th>
				</thead>
				<tbody align="left">
					<?php foreach($element AS $e){?>
					<tr>
						<td><?php echo $e->elo_sProduit ;?></td>
						<td><?php echo $e->elo_iQuantite ;?></td>
						<td><?php echo $e->elo_sPosologie ;?></td>
						<td><?php echo $e->elo_iDuree ;?></td>
					</tr>
					<?php }?>
					
				</tbody>
			</table>
			<table>
				<tr>
					<td  align="left" style="width:100%; height:100px">Signature du médecin : 
					</td>
				</tr>
			</table>
		 
			
			<!-- footer -->
			<table class="footer" style="width:100%; font-weight:bold; font-size:10px">
				<tr>
					<td  align="center" style="width:100%"><span>Email: <span style="color:maroon"><i><u><?php echo $info->str_sAdresse;?> / <?php echo $info->str_sVille   ;?>,  <?php echo $info->str_iBp   ;?></u></i></span></span>
					</td>
				</tr>
				<tr>
					<td align="center" style="font-size:10px">tel: <?php echo $info->str_sTel;?></td>
				</tr>
			
			</table>
				
		</div>
	</body>
</html>