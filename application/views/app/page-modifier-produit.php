<?php 
	include("includes/header.php"); 
	$f = $this->md_pharmacie->recup_produit($med_id);
	$listeCat = $this->md_parametre->liste_categorie_produit_actifs($f->cat_id);
	$listeFam = $this->md_parametre->liste_famille_produit_actifs($f->fam_id);
	$listeFor = $this->md_parametre->liste_forme_produit_actifs($f->for_id);
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Modifier un produit</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<a href="<?php echo site_url("pharmacie/liste_produit");?>" style="margin-left:15px">Retour</a>
					<div class="header">
						<h2> pharmacie </h2>
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
														<h2><!--Informations du fournisseur--> <small>renseignez tous les champs marqués par des (*)</small> </h2>
													</div>
													<div class="body">
														<form id="form-edit-produit">
															<div class="row clearfix">
																<div class="col-sm-12 retour"></div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>Nom commercial *</label>
																		<div class="form-line">
																			<input type="text" name="nc" value="<?php echo $f->med_sNc; ?>" class="form-control deja obligatoire" >
																			<input style="display:none" type="text" name="id" value="<?php echo $f->med_id; ?>">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>Nom scientifique</label>
																		<div class="form-line">
																			<input type="text" name="ns" value="<?php echo $f->med_sNs; ?>" class="form-control ns">
																		</div>
																	</div>
																</div>																															
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>Dosage *</label>
																		<div class="form-line">
																			<input type="number" min="0" name="dos" value="<?php echo $f->med_iDosage; ?>" class="form-control deja obligatoire" >
																		</div>
																	</div>
																</div>																
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>Unité *</label>
																		<div class="form-line">
																			<input type="text" name="uni" value="<?php echo $f->med_sUnite; ?>" class="form-control deja obligatoire">
																		</div>
																	</div>
																</div>
															</div>														
															<div class="row clearfix">
																<div class="col-sm-4">
																	<div class="form-group drop-custum">
																		<label>Catégorie *</label>
																		<select name="cat" id="cat" class="form-control deja obligatoire">
																			<?php foreach($listeCat AS $l){ ?>
																				<option value="<?php echo $l->cat_id; ?>" <?php if($l->cat_id==$f->cat_id){echo 'selected="selected"';} ?>><?php echo $l->cat_sLibelle; ?></option>
																			<?php } ?>
																		</select>
																	</div>
																</div>																
																<div class="col-sm-4">
																	<div class="form-group drop-custum">
																		<label>Famille *</label>
																		<select name="fam" id="fam" class="form-control deja obligatoire">
																		<?php foreach($listeFam AS $fam){ ?>
																			<option value="<?php echo $fam->fam_id; ?>" <?php if($fam->fam_id==$f->fam_id){echo 'selected="selected"';} ?>><?php echo $fam->fam_sLibelle; ?></option>
																		<?php } ?>
																		</select>
																	</div>
																</div>																	
																<div class="col-sm-4">
																	<div class="form-group drop-custum">
																		<label>Forme *</label>
																		<select name="for" id="for" class="form-control deja obligatoire">
																		<?php foreach($listeFor AS $for){ ?>
																			<option value="<?php echo $for->for_id; ?>" <?php if($for->for_id==$f->for_id){echo 'selected="selected"';} ?>><?php echo $for->for_sLibelle; ?></option>
																		<?php } ?>
																		</select>
																	</div>
																</div>		
																<div class="col-sm-3">
																	<button type="button" class="btn btn-raised bg-blue-grey" id="editProduit">Modifier</button>
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