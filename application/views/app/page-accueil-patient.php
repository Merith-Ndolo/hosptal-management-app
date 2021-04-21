<?php include("includes/header.php"); ?>
<?php $patient = $this->md_patient->recup_patient($id); ?>
<?php $listeACte = $this->md_parametre->liste_acts_actifs($id); ?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Accueil patient</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2> Orientation </h2>
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
														<h2><span style="font-size:12px"><?php echo $patient->pat_sCivilite; ?></span> <?php echo $patient->pat_sNom." ".$patient->pat_sPrenom ?> <?php if(!is_null($patient->pat_sTel)){echo "- ".$patient->pat_sTel;} ?> <span class="pull-right"> <span style="font-size:12px">Code du patient</span> : <b style="text-decoration:underline"><?php echo $patient->pat_sMatricule; ?></b></span></h2>
													</div>
													<div class="body">
														<form id="form-orientation">
															
															<div class="row clearfix">
																<div class="col-sm-12"><div class="form-group retour"></div></div>
																<div class="col-sm-6">
																	<div class="form-group drop-custum">
																		<label>Sélection de l'acte médical</label>
																		<select name="acte" class="form-control acte obligatoire show-tick">
																			<option value="">-- Sélection de l'acte médical * --</option>
																			<?php foreach($listeACte AS $la){ ?>
																			<option value="<?php echo $la->lac_id; ?>"><?php echo $la->lac_sLibelle; ?></option>
																			<?php } ?>
																		</select>
																		<input type="hidden" name="id" value="<?php echo $patient->pat_id; ?>"/>
																	</div>
																</div>
																<div class="col-sm-6" id="recepDetail"></div>
																<div class="col-sm-12" id="recepOrientation">
																	
																</div>
																<div class="col-sm-12">
																	<div class="form-group pull-left retour"></div>
																	<button type="submit" class="btn btn-raised bg-blue-grey pull-right" id="validerActe">Valider</button>
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
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finishOrient" id="finishOrient">BLUE GREY</button>
    </div>
</section>


<!-- For Material Design Colors -->
<div class="modal fade" id="mdModalOrientation" tabindex="-1" role="dialog">
	
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE ACCUEIL</h4>
            </div>
            <div class="modal-body text-center"> Le patient doit maintenant passer par le caisse <br> Coût <span id="retour-cout"></span> <small>FCFA</small> <br><img src="<?php echo base_url("assets/images/icons8-attendance-50.png");?>"/></div>
            <div id="refresh"></div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>