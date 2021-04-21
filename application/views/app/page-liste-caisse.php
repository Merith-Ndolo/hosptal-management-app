
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_patient-> liste_element_caisse(); ?>
<?php $listeH = $this->md_patient-> liste_element_caisse_hos(); ?>

<section class="content home">
    <div class="container-fluid">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#income"> <span>Caisse normale</span></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sales"> <span>Caisse hospitalisation</span></a></li>
        </ul> 
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
				
                <div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="card">
							<div class="header">
								<h2>liste des paiements des actes médicaux en attente <button id="facture" type="button" class="btn bg-blue-grey waves-effect pull-right cacher" style="color:#fff"><i class="fa fa-check"></i> <b>Faire une facture</b></button></h2>
								
							</div>
							<div class="body table-responsive">
								<form id="form-facture">
									<table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
										<thead>
											<tr>
												<th>#</th>
												<th>Code patient</th>
												<th>Nom & prénom</th>
												<th>Acte médical</th>
												<th>Coût de l'acte</th>
												<th>temps avant expiration</th>
												<th>Date</th>
											</tr>
										</thead>
									   
										<tbody>
											<?php foreach($liste AS $l){ ?>
												<tr>
													<td>
														<input type="hidden" name="pat" value="<?php echo $l->pat_id; ?>"/>
														<div class="switch">
															<label>
																<input type="checkbox" class="checkPatient" name="id[]" value="<?php echo $l->acm_id; ?>">
																<span class="lever"></span>
															</label>
														</div>
													</td>
													<td>
														<?php echo $l->pat_sMatricule; ?>
														
													</td>
													<td>
														<?php echo $l->pat_sNom; ?> <?php echo $l->pat_sPrenom; ?>
													</td>
													<td>
														<?php echo $l->lac_sLibelle; ?>
													</td>
													<td>
														<?php echo number_format($l->lac_iCout,2,",","."); ?> <small>FCFA</small>
													</td>
													<td>
														<?php $reste = $this->md_config->joursRestantDateTime($l->acm_dDateDelai); echo $reste;?>

													</td>
													<td>
														<?php echo $this->md_config->affDateTimeFr($l->acm_dDate); ?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</form>
							</div>
						</div>
					</div>
				</div>
                          
            </div>
            
            <div role="tabpanel" class="tab-pane page-calendar" id="sales">
                <div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="card">
							<div class="header">
								<h2>liste des paiements des actes médicaux en attente <button id="facture_2" type="button" class="btn bg-blue-grey waves-effect pull-right cacher" style="color:#fff"><i class="fa fa-check"></i> <b>Faire une facture</b></button></h2>
								
							</div>
							<div class="body table-responsive">
								<form id="form-facture_2">
									<table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
										<thead>
											<tr>
												<th>#</th>
												<th>Code patient</th>
												<th>Nom & prénom</th>
												<th>Acte médical</th>
												<th>Coût de l'acte</th>
												<th>temps avant expiration</th>
												<th>Date</th>
											</tr>
										</thead>
									   
										<tbody>
											<?php foreach($listeH AS $l){ ?>
												<tr>
													<td>
														<input type="hidden" name="pat" value="<?php echo $l->pat_id; ?>"/>
														<div class="switch">
															<label>
																<input type="checkbox" class="checkPatient_2" name="id[]" value="<?php echo $l->acm_id; ?>">
																<span class="lever"></span>
															</label>
														</div>
													</td>
													<td>
														<?php echo $l->pat_sMatricule; ?>
														
													</td>
													<td>
														<?php echo $l->pat_sNom; ?> <?php echo $l->pat_sPrenom; ?>
													</td>
													<td>
														<?php echo $l->lac_sLibelle; ?>
													</td>
													<td>
														<?php echo number_format($l->lac_iCout,2,",","."); ?> <small>FCFA</small>
													</td>
													<td>
														<?php $reste = $this->md_config->joursRestantDateTime($l->acm_dDateDelai); echo $reste;?>

													</td>
													<td>
														<?php echo $this->md_config->affDateTimeFr($l->acm_dDate); ?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>  
			           
        </div>
    </div>
</section>

<!-- Large Size -->
<div class="modal fade" id="modalPaye" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="margin-top:20px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
			<form action="<?php echo site_url('caisse/ajoutFactureCaisse');?>" method="POST" id="form-caisse">
				<div class="modal-body" style="max-height:500px; overflow:auto;">
				
					 <div class="col-lg-12 col-md-12 col-sm-12">
						<div class="card">
							
							<div class="body table-responsive">
									<div class="col-md-12" id="recepFact"></div>

							</div>
						</div>
					</div>
				
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success waves-effect caisse" style="color:#fff"><i class="fa fa-check"></i> Encaisser</button>
					<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
				</div>
			</form>
        </div>
    </div>
</div>

<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DE CAISSE</h4>
            </div>
            <div class="modal-body text-center"> Facture(s) reglée(s) <br><i style="font-size:40px" class="fa fa-bank"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>