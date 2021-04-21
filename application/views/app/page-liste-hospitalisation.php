<?php include("includes/header.php"); ?>
<?php 
	
	$listeEncours = $this->md_patient->liste_hospitalisation();

 ?>
<section class="content home">
    <div class="container-fluid"> 
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
						
						<div class="card">
							<div class="header">
								<h2>L'assemble de ces actes ici sont soient payés, soient avancés</h2>
							</div>
							<div class="body table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>N° Matricule</th>
											<th>Photo</th>
											<th>Nom</th>
											<th>Prénom</th>
											<th>Acte médical</th>
											<th>disposition</th>
											<th>Début d'hospitalisation</th>
											<th style="width:60px">Action</th>
										</tr>
									</thead>
								   
									<tbody>
									<?php foreach($listeEncours AS $le){ ?>
										<tr>
											<td><?php echo $le->pat_sMatricule; ?></td>
											<td><img src="<?php echo base_url($le->pat_sAvatar); ?>" class="img-thumbnail " alt="profile-image" width="40" height="40"></td>
											<td><?php echo $le->pat_sNom; ?></td>
											<td><?php echo $le->pat_sPrenom; ?></td>
											<td><?php echo $le->lac_sLibelle; ?></td>
											<td><?php echo $le->hos_sType; ?></td>
											<td class="text-center"><?php echo $this->md_config->affDateFrNum($le->fac_dDatePaie);?></td>
											<td class="text-center">
												<?php if($user->per_iTypeCompte==1){ ?>
													<a href="<?php echo site_url("hospitalisation/patient_hospitalise/".$le->hos_id); ?>"><b><i class="fa fa-bed" style="font-size:23px"></i><br>Consulter</b></a>
												<?php } ?>
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
            
            <div role="tabpanel" class="tab-pane page-calendar" id="sales">
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
			
                    </div>
                </div>
            </div>  
			
            <div role="tabpanel" class="tab-pane page-calendar" id="sales2">
               
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
			
                     
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>
<?php include("includes/footer.php"); ?>