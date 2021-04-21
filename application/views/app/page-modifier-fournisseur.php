<?php 
	include("includes/header.php"); 
	$f = $this->md_pharmacie->recup_fournisseur($frs_id);
	$listeType = $this->md_parametre->liste_type_fournisseur_actifs();
	$listePays = $this->md_parametre->liste_pays_actifs();
	$listeVille = $this->md_parametre->liste_ville_actifs($f->pay_id);
	$tfrCourant = $this->md_parametre->type_fournisseur_courant($f->tfr_id);
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Modifier les informations du fournisseur</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
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
														<h2>Informations du fournisseur <small>renseignez tous les champs marqués par des (*)</small> </h2>
													</div>
													<div class="body">
														<form id="form-edit-four">
															<div class="row clearfix">
																<div class="col-sm-12 retour"></div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="nom" value="<?=$f->frs_sEnseigne;?>" class="form-control obligatoire" placeholder="Nom du fournisseur *">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="adresse" value="<?=$f->frs_sAdresse;?>" class="form-control obligatoire adresse" placeholder="Adresse *">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="tel1" value="<?=$f->frs_sTel_1;?>" class="form-control obligatoire tel1" placeholder="Téléphone 1 *">
																			<input style="display:none" type="text" name="id" value="<?=$f->frs_id;?>">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="tel2" value="<?=$f->frs_sTel_2;?>" class="form-control" placeholder="Téléphone 2">
																		</div>
																	</div>
																</div>
															</div>															
															<div class="row clearfix">
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="email" value="<?=$f->frs_sEmail;?>" class="form-control obligatoire email" placeholder="E-mail *">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="web" value="<?=$f->frs_sWeb;?>" class="form-control" placeholder="Site Web">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-sm-3">
																	<div class="form-group drop-custum">
																		<select name="pays" id="pays" class="form-control obligatoire">
																			<?php foreach($listePays AS $l){ ?>
																				<option value="<?php echo $l->pay_id; ?>" <?php if($l->pay_id==$f->pay_id){echo 'selected="selected"';} ?>><?php echo $l->pay_sLib; ?></option>
																			<?php } ?>
																		</select>
																	</div>
																</div>																
																<div class="col-sm-3">
																	<div class="form-group drop-custum">
																		<select name="ville" id="ville" class="form-control obligatoire">
																		<?php foreach($listeVille AS $l){ ?>
																			<option value="<?php echo $l->vil_id; ?>" <?php if($l->vil_id==$f->vil_id){echo 'selected="selected"';} ?>><?php echo $l->vil_sLib; ?></option>
																		<?php } ?>
																		</select>
																	</div>
																</div>		
																<div class="col-sm-6">
																	<div class="form-group drop-custum">
																		<select name="type" class="form-control obligatoire">
																			<option value="<?php echo $f->tfr_id; ?>"><?php echo $tfrCourant->tfr_sLibelle; ?></option>
																			<?php foreach($listeType AS $l){ ?>
																			<option value="<?php echo $l->tfr_id; ?>"><?php echo $l->tfr_sLibelle; ?></option>
																			<?php } ?>
																		</select>
																	</div>
																</div>
																<div class="col-sm-3">
																	<button type="button" class="btn btn-raised bg-blue-grey" id="editFournisseur">Modifier</button>
																</div>
																<div class="col-sm-3">
																	Changer le logo
																	<div class="fallback focused">
																		<input name="photo" type="file" class="form-control photo">
																	</div>
																</div>																
																<div class="col-sm-3">
																	Logo de la structure
																	<div class="fallback focused">
																		<img src="<?php echo base_url($f->frs_sLogo); ?>" class="img-fluid" alt="">
																	</div>
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