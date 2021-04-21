<?php include("includes/header.php"); $info = $this->md_parametre->info_structure();?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Administration</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					
					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-12 col-md-12 col-lg-12"> 
							
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">		
										<div class="row clearfix">
											<div class="col-md-12 col-sm-12">
												<div class="card">
													<div class="header">
														<h2>Coordonnées bancaires de l'hôpital <small>renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
												</div>
											</div>
											<div class="col-md-3 col-sm-3">
												<div class="form-group">
													<div class="">
														<img src="../../<?php echo $info->str_sLogo   ;?>" style="width:100%"/>
													</div>
												</div>
											</div>
											<div class="col-lg-8 col-md-8 col-sm-8">
												<div class="card">
													
													<div class="body">
														<form id="form-modif-banque">
															<div class="row clearfix">
																<div class="col-sm-12 retour-modif-banque"></div>
																<div class="col-sm-8">
																	<div class="form-group">
																		<label>* Nom de la Banque</label>
																		<div class="form-line">
																			<input type="text" name="banque" class="form-control obligatoire" value="<?php echo $info->str_sBanque ;?>">
																		</div>
																	</div>
																</div>
																<div class="col-sm-4">
																	<div class="form-group">
																	<label>* Code banque</label>
																		<div class="form-line">
																			<input type="number" name="code_banque" class="form-control obligatoire" value="<?php echo $info->str_iCodeBanque   ;?>">
																		</div>
																	</div>
																</div>
																
															</div>
															<div class="row clearfix">
																
																<div class="col-sm-3">
																	<div class="form-group">
																		<label>Code guichet *</label>
																		<div class="form-line">
																			<input type="number" min="0" name="guichet" class="form-control obligatoire" value="<?php echo $info->str_sGuichet ;?>">
																		</div>
																	</div>
																</div>
																
																<div class="col-sm-7">
																	<div class="form-group">
																		<label>Numéro de compte *</label>
																		<div class="form-line">
																			<input type="number" min="0" name="numero" class="form-control obligatoire" value="<?php echo $info->str_iNumeroCompte  ;?>">
																		</div>
																	</div>
																</div>
																
																<div class="col-sm-2">
																	<div class="form-group">
																		<label>Clé RIB *</label>
																		<div class="form-line">
																			<input type="number" min="0" name="cle" class="form-control obligatoire" value="<?php echo $info->str_iCle  ;?>">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																
																<div class="col-sm-12">
																	<div class="form-group">
																		<label>IBAN</label>
																		<div class="form-line">
																			<input type="text" name="iban" class="form-control" value="<?php echo $info->str_sIban  ;?>">
																		</div>
																	</div>
																</div>
															
																<div class="col-sm-12">
																	<button type="submit" class="btn btn-raised bg-blue-grey" id="modifBanque">Mise à jour</button>
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