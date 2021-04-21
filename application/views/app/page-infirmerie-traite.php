<?php include("includes/header.php"); ?>
<?php 
	
	$listeEncours = $this->md_patient->liste_acm_infirmerie_fait(21);

 ?>
<section class="content home">
    <div class="container-fluid">
       
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
						
						<div class="card">
							<div class="header">
								<h2>Liste des soins infirmiers faits </h2>
								<?php //var_dump($listeEncours) ?>
							</div>
							<div class="body table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>Patient</th>
											<th>Prescrition acte soins</th>
											<th>Infimier(ière) traitant(e)</th>
											<th>Observation</th>
											<th>Date des soins</th>
										</tr>
									</thead>
								   
									<tbody>
									<?php foreach($listeEncours AS $le){ ?>
										<tr>
											<td><?php echo $le->pat_sPrenom.' '.$le->pat_sNom ; ?> (<?php echo $le->pat_sMatricule ; ?>)</td>
											<td><?php echo '<b>'.$le->lac_sLibelle.'</b> à '.$le->soi_tHeureDem.', chaque '.$le->soi_iFrequence.'H' ; ?></td>
											<td><?php echo $le->per_sNom." ".$le->per_sPrenom." (".$le->uni_sLibelle.")" ; ?></td>
											<td><?php echo $le->soi_sObservation ; ?></td>
											<td><?php echo $this->md_config->affDateTimeFr($le->soi_dDateFait) ; ?></td>
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