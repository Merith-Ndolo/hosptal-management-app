
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_pharmacie->liste_medicament(); ?>
<?php $listeCat = $this->md_parametre->liste_categorie_produit_actifs(); ?>
<?php $listeFour = $this->md_pharmacie->liste_fournisseur_actifs(); ?>
<?php $listeFor = $this->md_parametre->liste_forme_produit_actifs(); ?>
<?php $listeSalle = $this->md_pharmacie->liste_salle_pharmacie_actifs(); ?>


<section class="content">
<div class="container-fluid">
	<div class="block-header">
		<h2>Entrée en stock</h2>
		<small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
	</div>
	
	<!-- Tabs With Custom Animations -->
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="header">
					<h2> pharmacie</h2>
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
													<h2><!--Informations du fournisseur--> <a href="<?php echo  site_url("pharmacie/liste_entrees"); ?>">Voir les produits en stock</a><small>renseignez tous les champs marqués par des (*)</small> </h2>
												</div>
												<div class="body">
													<form id="form-entree-stock">
														<div class="row clearfix">
															<div class="col-sm-12 retour"></div>
															<div class="col-sm-6">
																<div class="form-group drop-custum">
																	<select name="pro" id="pro" class="form-control obligatoire">
																		<option value="">------------------------- Sélectionnez le produit * -------------------------</option>
																		<?php foreach( $liste AS $l ){ ?>
																		<option value="<?php echo $l->med_id;?>"><?php echo $l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?></option>
																		<?php }; ?>
																	</select>
																</div>
															</div>																	
															<div class="col-sm-6">
																<div class="form-group drop-custum">
																	<select name="four" id="four" class="form-control obligatoire">
																		<option value="">------------------------- Sélectionnez le fournisseur * -------------------------</option>
																		<?php  foreach( $listeFour  AS $fours ){ ?>
																		<option value="<?php echo $fours->frs_id;?>"><?php echo $fours->frs_sEnseigne;?></option>
																		<?php }; ?>
																	</select>
																</div>
															</div>	
															<div class="col-sm-4">
																<div class="form-group drop-custum">
																	<select name="salle" id="salle" class="form-control obligatoire">
																		<option value="">---------- Séleclionenz la salle * ----------</option>
																		<?php  foreach($listeSalle  AS $salle ){ ?>
																		<option value="<?php echo $salle->sal_id;?>"><?php echo $salle->sal_sLibelle;?></option>
																		<?php }; ?>
																	</select>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group drop-custum">
																	<select name="armoire" id="armoire" class="form-control obligatoire">
																		<option value="">---------- Sélectionnez l'armoire * ----------</option>
																	</select>
																</div>
															</div>																<div class="col-sm-4">
																<div class="form-group drop-custum">
																	<select name="cellule" id="cellule" class="form-control obligatoire">
																		<option value="">---------- Sélectionnez la cellule * ----------</option>
																	</select>
																</div>
															</div>																																													
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Quantité *</label>
																	<div class="form-line">
																		<input type="number" min="0" name="qte" value="" class="form-control obligatoire">
																	</div>
																</div>
															</div>	
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Prix d'achat *</label>
																	<div class="form-line">
																		<input type="number" min="1" name="pa" class="form-control obligatoire pa">
																	</div>
																</div>
															</div>																
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Prix de vente *</label>
																	<div class="form-line">
																		<input type="number" min="1" name="pv" class="form-control obligatoire pv">
																	</div>
																</div>
															</div>																															
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Seuil d'alerte sur la quantité * </label>
																	<div class="form-line">
																		<input type="number" min="0" name="seuil"  class="form-control obligatoire">
																	</div>
																</div>
															</div>																
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Date d'achat </label>
																	<div class="form-line">
																		<input type="text" name="da" value="" class="form-control obligatoire datepicker">
																	</div>
																</div>
															</div>																
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Date d'expiration *</label>
																	<div class="form-line">
																		<input type="text" name="de" value="" class="form-control obligatoire datepicker">
																	</div>
																</div>
															</div>
														</div>														
														<div class="row clearfix">															
															<div class="col-sm-3">
																<button type="button" class="btn btn-raised bg-blue-grey" id="entreeStock">Valider</button>
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