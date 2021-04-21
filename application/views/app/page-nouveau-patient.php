<?php include("includes/header.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Ajouter un patient</h2>
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
							
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">		
										<div class="row clearfix">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="card">
													<div class="header">
														<h2>Informations du patient <small>renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
													<div class="body">
														<form id="form-add-pat">
															<div class="row clearfix">
																<div class="col-sm-12 retour-add-pat"></div>
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
																			<input type="text" name="prenom" class="form-control" placeholder="Prénom(s)">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-sm-4">
																	<div class="form-group drop-custum">
																		<select name="civilite" class="form-control obligatoire show-tick">
																			<option value="">-- Civilité * --</option>
																			<option value="Mr">Monsieur</option>
																			<option value="Mme">Madame</option>
																			<option value="Mlle">Madémoiselle</option>
																		</select>
																	</div>
																</div>
																<div class="col-sm-4">
																	<div class="form-group drop-custum">
																		<select name="genre" class="form-control obligatoire show-tick">
																			<option value="">-- Genre * --</option>
																			<option value="H">Homme</option>
																			<option value="F">Femme</option>
																		</select>
																	</div>
																</div>
																<div class="col-sm-4">
																	<div class="form-group drop-custum">
																		<select name="situation" class="form-control obligatoire show-tick">
																			<option value="">-- Situation famiale * --</option>
																			<option value="Célibataire">Célibataire</option>
																			<option value="Marié(e)">Marié(e)</option>
																			<option value="Divorcé(e)">Divorcé(e)</option>
																			<option value="Veuf(ve)">Veuf(ve)</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-sm-3">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="date_naiss" class="datepicker form-control obligatoire" placeholder="Date de naissance *">
																		</div>
																	</div>
																</div>
																<div class="col-sm-3">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="tel" class="form-control tel" placeholder="Téléphone">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="profession" class="form-control" placeholder="Profession">
																		</div>
																	</div>
																</div>
																
																<div class="col-sm-12">
																	<div class="form-group">
																		<div class="form-group">
																			<div class="form-line">
																				<textarea rows="4" name="adresse" class="form-control no-resize" placeholder="Adresse complète..."></textarea>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="col-sm-6">
																	<label>Photo</label>
																	<div class="fallback">
																		<input name="photo" type="file" class="form-control photo" />
																	</div>
																</div>
																
																<div class="col-sm-12">
																	<button type="submit" class="btn btn-raised bg-blue-grey" id="EnregistrerPatient">Enregistrer</button>
																</div>
															</div>
														</form>
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
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finishPatient" id="finishPatient">BLUE GREY</button>
    </div>
</section>


<!-- For Material Design Colors -->
<div class="modal fade" id="mdModalPatient" tabindex="-1" role="dialog">
	
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE ACCUEIL</h4>
            </div>
            <div class="modal-body text-center"> Patient enregistré avec succès <br><img src="<?php echo base_url("assets/images/icons8-attendance-50.png");?>"/></div>
            <div id="refresh"></div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>