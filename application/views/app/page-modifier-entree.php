
<?php include("includes/header.php"); ?>
<?php // $list = $this->md_pharmacie->liste_medicament_actifs($id); ?>
<?php $liste = $this->md_pharmacie->recup_entree($id); ?>
<?php $list = $this->md_pharmacie->liste_medicament_actifs(); ?>
<?php $listeFour = $this->md_pharmacie->liste_fournisseur_actifs(); ?>
<?php $listeSalle = $this->md_pharmacie->liste_salle_actifs(); ?>
<?php $listeArmoire = $this->md_pharmacie->liste_armoire_actifs(); ?>
<?php $listeCellule = $this->md_pharmacie->liste_cellule_actifs(); ?>


<section class="content">
<div class="container-fluid">
	<div class="block-header">
		<h2>Modifier une entrée en stock</h2>
		<small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
	</div>
	
	<!-- Tabs With Custom Animations -->
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="header">
					<h2> pharmacie</h2>
				</div>
				<?php //var_dump($list); ?>
				<?php //var_dump($liste); ?>
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
													<h2><!--Informations du fournisseur--> <small>renseignez tous les champs marqués par des (*)</small> </h2>
												</div>
												<div class="body">
													<form id="form-edit-entree-stock">
														<div class="row clearfix">
															<div class="col-sm-12 retour"></div>	
															<div class="col-sm-4">
																<div class="form-group drop-custum">
																	<select name="salle" id="salle" class="form-control obligatoire">
																		<?php foreach($listeSalle AS $s){ ?>
																			<option value="<?php echo $s->sal_id; ?>" <?php if($s->sal_id==$liste->sal_id){echo 'selected="selected"';} ?>><?php echo $s->sal_sLibelle; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>																
															<div class="col-sm-4">
																<div class="form-group drop-custum">
																	<select name="armoire" id="armoire" class="form-control obligatoire">
																		<?php foreach($listeArmoire AS $a){ ?>
																			<option value="<?php echo $a->arm_id; ?>" <?php if($a->arm_id==$liste->arm_id){echo 'selected="selected"';} ?>><?php echo $a->arm_sLibelle; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>																
															<div class="col-sm-4">
																<div class="form-group drop-custum">
																	<select name="cellule" id="cellule" class="form-control obligatoire">
																		<?php foreach($listeCellule AS $c){ ?>
																			<option value="<?php echo $c->cel_id; ?>" <?php if($c->cel_id==$liste->cel_id){echo 'selected="selected"';} ?>><?php echo $c->cel_sLibelle; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>																																													
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Quantité *</label>
																	<div class="form-line">
																		<input type="number" min="0" name="qte" value="<?php echo $liste->ach_iQte; ?>" class="form-control obligatoire">
																		<input style="display:none" type="text" name="id" value="<?php echo $liste->ach_id; ?>" class="">
																	</div>
																</div>
															</div>	
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Prix d'achat *</label>
																	<div class="form-line">
																		<input type="number" min="1" name="pa" value="<?php echo $liste->ach_iPrixAchat; ?>" class="form-control obligatoire pa">
																	</div>
																</div>
															</div>																
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Prix de vente</label>
																	<div class="form-line">
																		<input type="number" min="1" name="pv" value="<?php echo $liste->ach_iPrixVente; ?>" class="form-control pv">
																	</div>
																</div>
															</div>																															
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Seuil d'alerte</label>
																	<div class="form-line">
																		<input type="number" min="0" name="seuil" value="<?php echo $liste->ach_iSeuil; ?>"  class="form-control">
																	</div>
																</div>
															</div>																
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Date d'achat </label>
																	<div class="form-line">
																		<input type="text" name="da" value="<?php echo $this->md_config->affDateFrNum($liste->ach_dDateAchat); ?>" class="form-control datepicker">
																	</div>
																</div>
															</div>																
															<div class="col-sm-4">
																<div class="form-group">
																	<label>Date d'expiration *</label>
																	<div class="form-line">
																		<input type="text" name="de" value="<?php echo $this->md_config->affDateFrNum($liste->ach_dDateExpir); ?>" class="form-control obligatoire datepicker">
																	</div>
																</div>
															</div>
														</div>														
														<div class="row clearfix">															
															<div class="col-sm-3">
																<button type="button" class="btn btn-raised bg-blue-grey" id="editentreeStock">Valider</button>
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