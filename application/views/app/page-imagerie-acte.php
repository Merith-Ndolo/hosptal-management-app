<?php include("includes/header.php"); ?>
<?php 
	
	$listeEncours = $this->md_patient->liste_acm_imagerie(date("Y-m-d H:i:s"),25);

 ?>
<section class="content home">
    <div class="container-fluid">
       
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
						
						<div class="card">
							<div class="header">
								<h2>Liste des actes reçus</h2>
								<?php //var_dump($listeEncours) ?>
							</div>
							<div class="body table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>Patient</th>
											<th>Acte imagerie</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
								   
									<tbody>
									<?php foreach($listeEncours AS $le){ ?>
										<tr>
											<td><?php echo '<b>'.$le->pat_sPrenom.' '.$le->pat_sNom .'</b> ('.$le->pat_sMatricule.')'; ?></td>
											<td><?php echo $le->lac_sLibelle ; ?></td>
											<td class="text-center">
												<a href="<?php echo site_url("imagerie/patient_en_examen/".$le->aci_id); ?>"><b>Effectuer l'acte</b></a>
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
</section>
<?php include("includes/footer.php"); ?>