<?php include("includes/header.php"); ?>
<?php $listeAgent = $this->md_personnel->nb_complete_personnel(); ?>
<?php $listeClient = $this->md_patient->nb_patients(); ?>
<?php $listeFour = $this->md_pharmacie->liste_fournisseur_pharmacie(); ?>



<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Prendre Rendez-vous</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2> Accueil </h2>
					</div>
					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-12 col-md-12 col-lg-12"> 
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" style="display:none">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home_animation_1" id="etape1">Étape 1</a></li>
								
								</ul>
								
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">		
										<div class="row clearfix">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="card">
													<div class="header">
														<h2>Informations<small>renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
													<div class="body">
														<form id="form-dir">
															<div class="col-sm-12 retour"></div>
															<div class="row clearfix">
																
																<div class="col-sm-12">
																	
																	<div class="row clearfix" id="riverain">
																		<div class="col-sm-6">
																			<div class="form-group">
																				<div class="form-line">
																					<input type="text" name="nom" class="form-control obligatoire" placeholder="Nom(s) *">
																				</div>
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group">
																				<div class="form-line">
																					<input type="text" name="prenom" class="form-control obligatoire" placeholder="Prénom(s) *">
																				</div>
																			</div>
																		</div>
																	</div>
																	
																</div>
															</div>
															
															
															
															<div class="row clearfix" id="suite">
																
																<div class="col-sm-6 ">
																	<div class="form-group drop-custum obligatoire" id="destinaire">
																		<select name="vous_etes" class="form-control obligatoire show-tick">
																			<option value="">Destinataire *</option>
																					<?php foreach($listeAgent AS $listA){ ?>
																						<option value="<?php echo $listA->per_id ; ?>"><?php echo $listA->per_sMatricule; ?> - <?php echo $listA->per_sTitre; ?>  <?php echo $listA->per_sNom; ?> <?php echo $listA->per_sPrenom; ?></option>
																					<?php } ?>
																					
																		</select>
																	</div>
																</div>
																<div class="col-sm-3 ">
																	<div class="form-group" id="date_rdv">
																		<div class="form-line">
																			<input type="datepicker" name="date_rdv" class="datepicker obligatoire form-control date_rdv " placeholder="Date de Rendez-vous *">
																		</div>
																	</div>
																</div>
																
																<div class="col-sm-3 ">
																	<div class="form-group" id="heure_rdv">
																		<div class="form-line">
																			<input type="timepicker" name="heure_rdv" class="timepicker obligatoire form-control date_rdv " placeholder="Heure *">
																		</div>
																	</div>
																</div>
																
																<div class="col-sm-6 ">
																		<div class="form-group obligatoire" id="objet">
																			<div class="form-line obligatoire">
																				<label></label> 
																				<textarea class="form-control obligatoire" id="objet" name="objet" placeholder="Saisir l'objet "></textarea>
																			</div>
																		</div>
																</div>
																
																
															</div>
														</form>
														
														<a href="javascript:();" class="btn btn-success waves-effect pull-right addDir"id="bouton" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								
								</div>
							</div>                           
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Tabs With Custom Animations -->
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
    </div>
</section>


<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
	
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DES RESSOURCES HUMAINES</h4>
            </div>
            <div class="modal-body text-center"> Employé ajouté avec succès <br><img src="<?php echo base_url("assets/images/icons8-attendance-50.png");?>"/></div>
            <div id="refresh"></div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>