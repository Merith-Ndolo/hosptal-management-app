<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Fiche personnel</title>
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
					<td style="font-size:25px; height:20px; font-weight:bold" align="center">FICHE D'HOSPITALISATION</td>
				</tr>
			</table>
			<form>	
			<fieldset>
				<legend style="background-color:rgb(167,206,0)" >Renseignements administratifs</legend>
				<table>	
				<tr>	
					<td style="width:25%"><label>Nom(s):</label></td>
					<td style="width:75%"></td>
				</tr>
				<tr>	
					<td>Prenom(s):</td>
					<td></td>
				</tr>	
				<tr>	
					<td>Date de naissance:</td>
					<td></td>
				</tr>	
				<tr>
					<td>Nationalité:</td>
					<td></td>
				</tr>	
				<tr>
				    <td>Représentant légal:</td>
					<td></td>
				</tr>	
				<tr>
				    <td>Adresse:</td>
					<td></td>
				</tr>	
				<tr>
				    <td>Téléphone:</td>
					<td></td>
				</tr>	
				<tr>
				    <td align="center"><br><strong>Personne à prévénir</strong></td>
					<td></td>
				</tr>	
				<tr>
				    <td>Nom et Prenom:</td>
					<td></td>
				</tr>	
				<tr>
				    <td>Lien de parenté:</td>
					<td></td>
				</tr>	
				<tr>
				    <td align="center"><br><strong><u>Couverture santé</strong></u><br><br><br><br></td>
					<td></td>
				</tr>
				
				</table>
			</fieldset>
			<br><br>
			<fieldset>
				<legend style="background-color:rgb(167,206,0)">Renseignements médicaux</legend>
				<table>	
				<tr>	
					<td>Motif d'hospitalisation :<br><br></td>
					<td></td>
				</tr>
				<tr>
				    <td align="center"><br><strong><u>Medecin adresseur<br></strong></u></td>
					<td></td>
				</tr>		
				<tr>
				    <td>Titre:</td>
					<td></td>
				</tr>	
				<tr>
					<td>Nom:</td>
					<td></td>
				</tr>
				<tr>
					<td>Adresse:</td>
					<td></td>
				</tr>
				<tr>
					<td>Téléphone:</td>
					<td></td>
				</tr>
				<tr>
					<td>Mail:</td>
					<td></td>
				</tr>
				
				<tr>
				    <td align="center"><br><br><strong>Antécédant(s) majeurs(s)</strong><br><br></td>
					<td></td>
				</tr>
				<tr>
				    <td align="center"><br><strong>Allergie(s)</strong><br><br></td>
					<td></td>
				</tr>
				<tr>
				    <td align="center"><br><strong>Traitement(s) en cours</strong><br><br></td>
					<td></td>
				</tr>
				
				
				</table>
			</fieldset>
			<br><br>
			<fieldset>
				<legend style="background-color:rgb(167,206,0)">Cadre reservé à l'hôpital</legend>
				<table>	
				<tr>
				    <td align="center"><strong>Accord ou refus de la commission d'admission<br><br></strong></td>
					<td></td>
				</tr>
				<tr>	
					<td>Avis médical/Motif(s) de refus :<br><br></td>
					<td></td>
				</tr>		
				<tr>
				    <td>Avis de la direction:<br><br></td>
					<td></td>
				</tr>	
				</table>
			</fieldset>
			
		</form>

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