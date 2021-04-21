<?php include("includes/header.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Ajouter un personnel</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2> Direction des ressources humaines </h2>
					</div>
					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-12 col-md-12 col-lg-12"> 
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" style="display:none">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home_animation_1" id="etape1">Étape 1</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile_animation_1" id="etape2">Étape 2</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages_animation_1" id="finale">Étape finale</a></li>
								</ul>
								
								<ul class="nav nav-tabs">
									<li class="nav-item"><a class="nav-link active"  disabled >Étape 1</a></li>
									<li class="nav-item"><a class="nav-link" disabled >Étape 2</a></li>
									<li class="nav-item"><a class="nav-link" disabled >Étape finale</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">		
										<div class="row clearfix">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="card">
													<div class="header">
														<h2>Informations personnelles <small>renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
													<div class="body">
														<form id="info-per">
															<div class="row clearfix">
																<div class="col-sm-12 retour1"></div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="nom" class="form-control obligatoire" placeholder="Nom *">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="autres_noms" class="form-control" placeholder="Autres noms">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="prenom" class="form-control" placeholder="Prénom">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="autres_prenoms" class="form-control" placeholder="Autres prénoms">
																		</div>
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
																	<div class="form-group drop-custum">
																		<select name="genre" class="form-control obligatoire show-tick">
																			<option value="">-- Genre * --</option>
																			<option value="H">Homme</option>
																			<option value="F">Femme</option>
																		</select>
																	</div>
																</div>
																<div class="col-sm-3">
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
																<div class="col-sm-3">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="number" name="nb_enfant" class="form-control obligatoire" placeholder="Nombre d'enfant *">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group drop-custum">
																		<select name="pathologie" class="form-control pathologie obligatoire show-tick">
																			<option value="">-- Pathologie chronique ou héréditaire * --</option>
																			<option value="Non">Non</option>
																			<option value="Oui">Oui</option>
																		</select>
																	</div>
																</div>
																<div class="col-sm-6 group-cacher cacher">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="maladie" class="form-control maladie" placeholder="Nom de la maladie *">
																		</div>
																	</div>
																</div>
																
																<div class="col-sm-12">
																	<div class="form-group">
																		<div class="form-group">
																			<div class="form-line">
																				<textarea rows="4" name="adresse" class="form-control obligatoire no-resize" placeholder="Adresse complète..."></textarea>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="col-sm-12">
																	<button type="submit" class="btn btn-raised bg-blue-grey" id="suivant1">Suivant</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane animated flipInX" id="profile_animation_1">
												
										<div class="row clearfix">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="card">
													<div class="header">
														<h2>Informations professionnelles <small>Renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
													<div class="body">
														<form id="info-pro">
															<div class="row clearfix">
																<div class="col-sm-12 retour2"></div>
																<div class="col-sm-6">
																	<div class="form-group drop-custum">
																		<select name="poste" class="form-control obligatoire posteDomaine show-tick">
																			<option value="">-- Domaine professionnel hospitalier * --</option>
																			<?php $poste = $this->md_parametre->liste_postes_actifs(); foreach($poste AS $p){ ?>
																			<option value="<?php echo $p->pst_id; ?>"><?php echo $p->pst_sLibelle; ?></option>
																			<?php } ?>
																		</select>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group drop-custum">
																		<select name="specialite" class="form-control specialitePoste obligatoire show-tick">
																			<option value="">-- Spécialité * --</option>
																			
																		</select>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-sm-12">
																	<div class="form-group drop-custum">
																		<select name="departement" class="form-control obligatoire show-tick">
																			<option value="">-- Direction de travail * --</option>
																			<?php $depart = $this->md_parametre->liste_departements_actifs(); foreach($depart AS $d){ ?>
																			<option value="<?php echo $d->dep_id; ?>"><?php echo $d->dep_sLibelle; ?></option>
																			<?php } ?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-sm-6">
																	<div class="form-group drop-custum">
																		<select name="titre" class="form-control obligatoire show-tick">
																			<option value="">-- Titre de l'employé * --</option>
																			<option value="pdt">Pas de titre</option>
																			<option value="DR.">Docteur</option>
																			<option value="PR.">Professeur</option>
																		</select>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="date_recru" class="datepicker form-control obligatoire" placeholder="Date de recrutement *">
																		</div>
																	</div>
																</div>
																<div class="col-sm-12">
																	<button type="button" class="btn btn-raised g-bg-cyan" id="precedent2">Précédent</button>
																	<button type="submit" class="btn btn-raised bg-blue-grey" id="suivant2">Suivant</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div role="tabpanel" class="tab-pane animated flipInX" id="messages_animation_1">
										<div class="row clearfix">
											<div class="col-md-12">
												<div class="card">
													<div class="header">
														<h2>Information de compte <small>Renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
													<div class="body">
														<form id="info-compte">
															<div class="row clearfix">
																<div class="col-sm-12 retour3"></div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="email" name="email" class="form-control email obligatoire" placeholder="Adresse mail *">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="tel" class="form-control tel obligatoire" placeholder="Numéro de téléphone *">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="password" name="pass" class="form-control pass" placeholder="Mot de passe">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="password" name="cpass" class="form-control cpass" placeholder="Confirmer le mot de passe">
																		</div>
																	</div>
																</div>
																<div class="col-sm-12">
																	<button type="button" class="btn btn-raised g-bg-cyan" id="precedent3">Précédent</button>
																	<button type="submit" class="btn btn-raised bg-blue-grey" id="terminer">Terminer</button>
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