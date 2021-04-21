<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Fiche de consultation</title>
		<meta charset="UTF-8">
		<style>
			@page { margin:10px 0px 0px 0px; height:100%;}
			body { margin: 0px;}
			table.footer{ position:fixed; bottom:40px; left:0px; right:0px; }

		</style>
		<!--<script type="text/javascript" src="assets/js/imprimer.js')"></script>-->
	</head>
	
	<body style="font-family:verdana">
		<div style="padding:10px 30px 0px 30px" >
			<!-- En-tête du reçu -->
			<table style="width:100%; height:100px" >
				<tr>
					<td  align="left" ><img src="assets/img/hopital22.png" width="70px" height="70px" border="0" /></td>
					<td  align="right"><img src="assets/img/images.jpg" width="50px" height="70px" border="0" /></td>
				</tr>	
			</table>
		 <!-- Corps de reçu -->
			<table style="width:100%; font-size:12px">
				<tr> 
					<td style="font-size:25px; height:20px; font-weight:bold" align="center">FICHE DE CONSULTATION</td>
				</tr>
			</table>
			<table style="width:100%; height:50px; font-size:12px">
				<tr>
					<td style="width:30%">Fiche N°:</td>
					<td style="width:70%" align="right">Date et heure</td>
				</tr>
			</table>
			<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
					<tr>
						<td>Nom: <b> NDOLO NZAMBA </b></td>
						<td>sexe: <b>Masculin</b></td>
					</tr>
					<tr>
						<td>Prénom: <b>Merith_Magn</b>i</td>
						<td></td>
					</tr>
					<tr>
						<td>Né(e) le:<b> 02 Mars 1993</b> </td>
						<td>à : <b>Dolisie </b> </td>
					</tr>
					<tr>
						<td>Situation familiale :<b> Célibataire</b> </td>
						<td>Nationalité:<b> Congolaise </b> </td>
					</tr>
					<tr>
						<td colspan=2>Addresse:</td>
					</tr>
			</table>
			<form>	
			<fieldset>
				<table>		
				<tr>
				    <td style="width:25%">Motif de consultation:</td>
					<td style="width:75%"></td>
				</tr>	
				<tr>
				    <td>Examen(s) clinique(s):</td>
					<td></td>
				</tr>	
				<tr>
				    <td>Anamnèse:</td>
					<td></td>
				</tr>
				<tr>
				    <td align="center"><br><strong><u>Constantes vitales</strong></u><br></td>
					<td></td>
				</tr>
				<tr>	
					<td>Température(°C):</td>
					<td></td>
				</tr>
				<tr>	
					<td>Tension(mmHg):</td>
					<td></td>
				</tr>	
				<tr>	
					<td>Poids(kg):</td>
					<td></td>
				</tr>	
				<tr>
					<td>Taille(cm):</td>
					<td></td>
				</tr>
				</table>
			</fieldset>	
		</form>
			<table style="width:100%; height:50px; font-size:12px">
				<tr>
					<td style="width:30%"></td>
					<td style="width:70%" align="right">Identité et signature de l'infirmier(e)</td>
				</tr>
			</table>

			<br><br>
			<table class="footer" style="width:100%; font-weight:bold; font-size:12px">
				<tr>
					<td  align="center" style="width:100%"><span>Email: <span style="color:maroon"><i><u>magasin@medicalis.com</u></i></span></span>
					</td>
				</tr>
				<tr>
					<td style="font-size:12px" align="center">tel:(+242) 06 839 20 56 / 06 888 52 88 / 06 598 58 87</td>
				</tr>
			
			</table>
				
		</div>
	</body>
</html>