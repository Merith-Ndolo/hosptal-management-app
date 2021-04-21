<?php include("includes/header.php"); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Nouveau courrier sortant</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
	
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
						
							 <div class="col-lg-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="header">
									
										<h2>Ajoutez un courrier</h2>
										
									</div>
								<form id="form-tcs">
										<div class="col-sm-12 retour"></div>
									<div class="body table-responsive">
										<div class="row clearfix">
											<div class="col-md-12">
												<div class="row clearfix">
													<div class="col-md-6">
														<div class="form-group">
															<div class="form-line">
																<input text="" name="expediteur" class="form-control obligatoire" placeholder="Expéditeur">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="form-line">
																<input text="" name="beneficiaire" class="form-control obligatoire" placeholder="Bénéficiaire">
															</div>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-md-6">
														<div class="form-group drop-custom">
															<select name="type" id="typeC" class=="form-control show-tick">
																<option value="">----- Choisir le type de courrier *-----</option>
																<?php $type=$this->md_parametre->liste_types_courrier(); foreach ($type AS $t) { ?>
																<option value="<?php echo $t->tco_id; ?>"> - <?php echo $t->tco_sType; ?></option>
																<?php } ?>
																<option value="autre">Autre type</option>
															</select>
														</div>
													</div>
													<div class="col-md-6 cacher" id="autreChoix" >
															<div class="form-group">
																<div class="form-line">
																	<input text="" name="autreType" class="form-control" placeholder="Saisir l'objet">
																</div>
															</div>
													</div>
												</div>
												<div class="col-sm-12" id="retour" name="contenu">
													
												</div><br>
												<div class="form-line">
													<input type="datepicker" name="date" class="datepicker form-control obligatoire" placeholder="Date *">
												</div>
												
											</div>
										</div>
									</div>
									</div>
								</form>
						<a href="javascript:();" class="btn btn-success waves-effect pull-right addTcs"id="bouton" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
					
				</div>
			</div>
		</div>
		<!-- #END# Tabs With Custom Animations -->
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
    </div>
</section>








<?php include("includes/footer.php"); ?>