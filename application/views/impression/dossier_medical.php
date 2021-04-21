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
	
	<body style="font-family:verdana">
		<div style="padding:5px 30px 0px 30px" >
			<!-- En-tête du reçu -->
			<table style="width:100%; height:50px" >
				<tr>
					<td  align="left" ><img src="assets/img/hopital22.png" width="70px" height="70px" border="0" /></td>
					<td  align="right"><img src="assets/img/images.jpg" width="50px" height="70px" border="0" /></td>
				</tr>	
			</table>
			
			<table style="width:100%; font-size:12px">
				<tr> 
					<td style="font-size:25px; height:20px; font-weight:bold" align="center">DOSSIER MEDICAL</td>
				</tr>
			</table>
		 <!-- Corps de reçu -->
			<table style="width:100%; height:50px; font-size:12px">
				<tr>
					<td style="width:30%">Dossier N°:</td>
					<td style="width:70%" align="right">Date et heure</td>
				</tr>
			</table>
		 
			<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
				<thead style="background-color:rgb(167,206,218)">
					<th colspan=2>Civilité</th>
					
				</thead>
				<tbody>
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
				</tbody>
			</table>
			<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
					<thead align="center"  style="background-color:rgb(167,206,218)">
						<th>Entreprise</th>
					</thead>
					<tbody>
						<tr>
							<td>Nom :</td>
						</tr>
						<tr>
							<td>Addresse:</td>
						</tr>
						<tr>
							<td>Poste occupé:</td>
						</tr>
					</tbody>
			</table>
			<br>
			<br>
			<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
					<thead align="center"  style="background-color:silver">
						<th colspan=2><strong>Antécedents</strong></th>
					</thead>
					<tbody>
						<tr>
							<td colspan=2><strong> * Antécedents héréditaires et familiaux</strong></td>
						</tr>
						<tr align="center">
							<td>Ascendants - collatéraux </td>
							<td>Conjoint - Enfants</td>
						</tr>
						<tr style="height:80px">
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan=2><strong> * Antécedents personnels</strong></td>
						</tr>
						<tr style="height:80px">
							<td>AVC</td>
							<td></td>
						</tr>
					</tbody>
			</table>
			<br>
				<div style="width:100%;" >
					<table style="height:15px">
						<tr><strong><br>ACTES MEDICAUX</strong></tr>
					</table>
					
					<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
							<thead align="center" style="background-color:rgb(167,206,0)">
								<th>CONSULATION</th>
							</thead>
							<tbody>
								<tr>
									<td>
										Constantes vitales :<br>
											<strong>*Température: 37.8 °C; *Tension: 120/80; *Poids: 70kg; *Taille: 180 cm</strong>    
									</td>
								</tr>
								<tr>
									<td>Motifs :<strong> Fièvres persistantes</strong></td>
								</tr>
								<tr>
									<td>Examen(s) clinique(s) : </td>
								</tr>
								<tr>
									<td>Anamnèse : </td>
								</tr>
							</tbody>
					</table>
					<br><br>
					<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
							<thead align="center" style="background-color:rgb(167,206,0)">
								<th>HOSPITALISATION</th>
							</thead>
							<tbody>
								<tr>
									<td>Service :</td>
								</tr>
								<tr>
									<td>Unités :</td>
								</tr>
								<tr>
									<td>Chambre :</td>
								</tr>
								<tr>
									<td>Lit :</td>
								</tr>
								<tr>
									<td>Disposition :</td>
								</tr>
								<tr>
									<td>Date d'hospitalisation :</td>
								</tr>
								<tr>
									<td>Motifs :</td>
								</tr>
							</tbody>
					</table>
					<br><br>
					<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
							<thead align="center" style="background-color:rgb(167,206,0)">
								<th>EXAMEN D'IMAGERIE</th>
							</thead>
							<tbody>
								<tr>
									<td>Acte imagérie :</td>
								</tr>
								<tr>
									<td>Médécin radiologue :</td>
								</tr>
								<tr>
									<td>Dte de réalisation :</td>
								</tr>
								<tr>
									<td>Image(s) jointe(s) : <br>
										<table style="width:100%;" border="" cellspacing="0">
											<tr>
												<td>
													<img src="assets/img/radiologie.jpg" style="width:120px; margin-top:20px " height="120px" border="0" />
													<img src="assets/img/radiologie.jpg" style="width:120px; margin-top:20px" height="120px" border="0" />
													<img src="assets/img/radiologie.jpg" style="width:120px; margin-top:20px" height="120px" border="0" />
												</td>
												
											</tr>
										</table>
									</td>
								</tr>
							</tbody>
					</table>
					<br><br>
					<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
							<thead align="center" style="background-color:rgb(167,206,0)">
								<th>EXAMEN LABORATOIRE</th>
							</thead>
							<tbody>
								<tr>
									<td>.............</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
							</tbody>
					</table>
					<br><br>
					<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
							<thead align="center" style="background-color:rgb(167,206,0)">
								<th>DECLARATION DE NOUVEAU NE</th>
							</thead>
							<tbody>
								<tr>
									<td>.............</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
							</tbody>
					</table>
					<br><br>
					<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
							<thead align="center" style="background-color:rgb(167,206,0)">
								<th>DECLARATION DE DECES</th>
							</thead>
							<tbody>
								<tr>
									<td>.............</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
							</tbody>
					</table>
					<br><br>
					<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
							<thead align="center" style="background-color:rgb(167,206,0)">
								<th>EXPLORATION FONCTIONNELLE</th>
							</thead>
							<tbody>
								<tr>
									<td>.............</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
								
							</tbody>
					</table>
					<br><br>
					<table style="width:100%; height:50px; font-size:12px" border="1" cellspacing="0">
							<thead align="center" style="background-color:rgb(167,206,0)">
								<th>INFORMATIONS COMPLEMENTAIRES</th>
							</thead>
							<tbody>
								<tr>
									<td>.............</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
								<tr>
									<td>...........</td>
								</tr>
							</tbody>
					</table>
					<br><br>
				</div>	
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