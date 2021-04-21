<?php 
	include("includes/header.php"); 
	$lab = $this->md_laboratoire->recup_accessoire($sac_id);
	$per = $this->md_personnel->nb_complete_personnel();
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
					<div class="header">
						<h2> Laboratoire, Sorti en stock de l'accessoire : <br><?php echo $lab->acc_sLibelle ;?> Quantité : <?php echo $lab->sac_iQte ;?></h2>
						<?php //echo var_dump($lab) ;?>
						<?php //echo var_dump($per) ;?>
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
														<form id="form-sortir-accessoire">
															<div class="row clearfix">
																<div class="col-sm-12 retour"></div>
																<div class="col-sm-12">
																	<div class="form-group drop-custum">
																		<label>Bénéficiaire *</label>
																		<select name="benef" id="benef" class="form-control obligatoire">
																			<option value="">---------- selectionner ----------</option>
																			<?php foreach($per AS $p){ ?>
																				<option value="<?php echo $p->per_id; ?>"><?php echo $p->per_sPrenom.' '.$p->per_sNom; ?></option>
																			<?php } ?>
																		</select>
																	</div>
																</div>
																<div class="col-sm-12">
																	<div class="form-group">
																		<label>Quantité *</label>
																		<div class="form-line">
																			<input type="number" name="qte" id="qte" class="form-control obligatoire" >
																			<input type="hidden" name="id" value="<?php echo $lab->sac_id ;?>">
																		</div>
																	</div>
																</div>																	
																<div class="col-sm-12">
																	<div class="form-group">
																		<label>Date opération *</label>
																		<div class="form-line">
																			<input type="text" name="date" value="" class="form-control obligatoire datepicker" >
																		</div>
																	</div>
																</div>																														
															</div>														
															<div class="row clearfix">
																<div class="col-sm-3">
																	<button type="button" class="btn btn-raised bg-blue-grey" id="sortirAccessoire">Valider</button>
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