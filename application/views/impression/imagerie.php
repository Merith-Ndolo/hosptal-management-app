<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
	
	<body>
		
			<!-- En-tête du reçu -->
			<table style="width:100%; height:100px" >
				<tr>
					<td  align="left" ><img src="assets/img/hopital22.png" width="70px" height="70px" border="0" /></td>
					<td  align="right"><img src="assets/img/images.jpg" width="50px" height="70px" border="0" /></td>
				</tr>	
			</table>
			
			<table style="width:100%; font-size:12px">
				<tr> 
					<td style="font-size:25px; height:20px; font-weight:bold" align="center"><u>EXAMENS RADIOLOGIQUES</u></td>
				</tr>
				<tr>
					<td align="center" style="font-weight:bold"><br>Dr. BOUKORO Jarce</td>
				</tr>
			</table>
			
			<table style="width:90%; height:100px; font-size:12px">
				<tr>
					<td style="width:30%">Fiche N°:</td>
					<td style="width:70%" align="right">Date et heure</td>
				</tr>
			</table>
			<table style="width:90%; height:50px; font-size:12px" border="1" cellspacing="0" align="center">
					<tr>
						<td>Nom: <b> NDOLO NZAMBA </b></td>
						<td>sexe: <b>Masculin</b></td>
					</tr>
					<tr>
						<td>Prénom: <b>Merith_Magni</b></td>
						<td></td>
					</tr>
			</table><br><br>
			<!-- Corps de reçu -->
			<table style="width:90%; font-size:12px" border="1"  cellspacing="0" align="center">
				<thead>
					<th>Date</th>
					<th>Acte d'imagérie</th>
					<th>........</th>
					<th>........</th>
					<th>........</th>
				</thead>
				<tbody>
					<tr>
						<td>20/06/2019</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>22/06/2019</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					
				</tbody>
			</table>
			<table>
					<tr>
						<td  align="left" style="width:90%"><br><br>Signature du Radiologue</td>
					</tr>
			</table>
			<!-- footer -->
			<table class="footer" style="width:100%; font-weight:bold; font-size:12px">
				<tr>
					<td  align="center" style="width:100%"><span>Email: <span style="color:maroon"><i><u>magasin@medicalis.com</u></i></span></span>
					</td>
				</tr>
				<tr>
					<td style="font-size:12px" align="center">tel:(+242) 06 839 20 56 / 06 888 52 88 / 06 598 58 87</td>
				</tr>
			
			</table>
				

	</body>
</html>