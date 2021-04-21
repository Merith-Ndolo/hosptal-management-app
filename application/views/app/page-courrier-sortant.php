<?php include("includes/header.php"); ?>
<?php $listeCourrierSortrant = $this->md_courrier->recup_courrier_sortant(); ?>
<?php $listeCourrierEnvoye = $this->md_courrier->recup_courrier_sortant_a_envoye(); ?>

<section class="content home">
    <div class="container-fluid">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#income"> <span>Correction avant envoi</span></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sales"> <span>Courrier(s) envoyé(s)</span></a></li>
        </ul> 
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
				
                <div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="card">
							<div class="header">
							    <h2>Courriers sortants</h2>
								<small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
							</div>
		
							<!-- Tabs With Custom Animations -->
							<div class="row clearfix">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="card">
										 <div class="body table-responsive"> 
											<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											   
												<thead>
													<tr>
														<th>Envoyeur</th>
														<th>Destinataire</th>
														<th>Date d'envoi</th>
														<th>Type de courrier</th>
														<th style="width:60px">Action</th>
													</tr>
												</thead>
											   
												<tbody>
												<?php foreach($listeCourrierSortrant AS $l){ ?>
													<tr>
														<td>
															<?php echo $l->tcs_sExpediteur; ?>
															
														</td>
														<td>
															<?php echo $l->tcs_sDestinataire; ?>
															
														</td>
														<td>
															<?php echo $l->tcs_dDate; ?>
														</td>
														<td>
															<?php 
															if(is_null($l->tco_sType)) {
																echo $l->tcs_sAutreType; 
															 }
															 else
															{ 
																echo $l->tco_sType; 
															}
															 ?>
															
														</td>
														<td class="text-center">
															<a href="javascript:();" rel="<?php echo $l->tcs_id; ?>" class="corriger_courrier" title="Corriger"><i class="fa fa-external-link" style="font-size:20px"></i></a> &nbsp;
															<a onClick="return confirm('Êtes-vous sûr de supprimer ce courrier ?')" href="<?php echo site_url("courrier/supprimer_courrier_sortant/".$l->tcs_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
														</td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
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
								<h2>Courriers sortants</h2>
								<small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
							</div>
		
							<!-- Tabs With Custom Animations -->
							<div class="row clearfix">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="card">
										 <div class="body table-responsive"> 
											<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											   
												<thead>
													<tr>
														<th>Envoyeur</th>
														<th>Destinataire</th>
														<th>Date d'envoi</th>
														<th>Type de courrier</th>
														<th style="width:60px">Action</th>
													</tr>
												</thead>
											   
												<tbody>
												<?php foreach($listeCourrierEnvoye AS $l){ ?>
													<tr>
														<td>
															<?php echo $l->tcs_sExpediteur; ?>
															
														</td>
														<td>
															<?php echo $l->tcs_sDestinataire; ?>
															
														</td>
														<td>
															<?php echo $l->tcs_dDate; ?>
														</td>
														<td>
															<?php 
															if(is_null($l->tco_sType)) {
																echo $l->tcs_sAutreType; 
															 }
															 else
															{ 
																echo $l->tco_sType; 
															}
															 ?>
															
														</td>
														<td class="text-center">
															<a href="<?php echo base_url($l->tcs_sContenu); ?>" title="voir"><i class="zmdi zmdi-receipt mdc-text-light-blue" style="font-size:20px"></i></a> &nbsp;
														</td>
													</tr>
													
													
												<?php } ?>
												</tbody>
											</table>
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
</section>

<!-- Large Size -->
<div class="modal fade" id="corigCourrier" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="margin-top:20px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:500px; overflow:auto;">
			
				 <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="header">
						
							<h2>CORRECTION</h2>
							
						</div>
						<div class="body table-responsive" id="corriger">
							
						</div>
					</div>
				</div>
			
			</div>
            <div class="modal-footer">
                <a href="javascript:();" class="btn btn-success waves-effect editTcs" style="color:#fff"><i class="fa fa-thumbs-o-up"></i> Valider</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>