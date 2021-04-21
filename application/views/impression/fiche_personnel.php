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
		 
			<form>	
			<fieldset>
				<legend style="background-color:silver" >Coordonnées</legend>
				<table>	
				<tr>	
					<td><label>Nom(s):</label></td>
					<td></td>
				</tr>
				<tr>	
					<td><label>Prenom(s):</label></td>
					<td></td>
				</tr>	
				<tr>	
					<td><label>Addresse:</label></td>
					<td></td>
				</tr>	
				<tr>
					<td><label>Email:</label></td>
					<td></td>
				</tr>	
				<tr>
				    <td><label>Tél:</label></td>
					<td></td>
				</tr>	

				</table>
			</fieldset>
			<br><br>
			<fieldset>
				<legend style="background-color:silver">Etat civil</legend>
				<table>	
				<tr>	
					<td><label>Né(e) le :</label></td>
					<td></td>
				</tr>
				<tr>	
					<td><label>A :</label></td>
					<td></td>
				</tr>		
				<tr>
				    <td><label>Sexe:</label></td>
					<td></td>
				</tr>	
				<tr>
					<td><label>Situation familiale :</label></td>
					<td></td>
				</tr>
				<tr>
					<td><label>Nombre d'enfants :</label></td>
					<td></td>
				</tr>
				</table>
			</fieldset>
			<br><br>
			<fieldset>
				<legend style="background-color:silver">Informations professionnelles</legend>
				<table>	
				<tr>	
					<td><label>Poste :</label></td>
					<td></td>
				</tr>
				<tr>	
					<td><label>N° Matricule :</label></td>
					<td></td>
				</tr>		
				<tr>
				    <td><label>Date de recrutement:</label></td>
					<td></td>
				</tr>	
				<tr>
					<td><label>Type de contrat :</label></td>
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