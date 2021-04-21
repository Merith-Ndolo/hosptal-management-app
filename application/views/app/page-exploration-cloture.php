<?php include("includes/header.php"); ?>
<?php 
	
	$listeEncours = $this->md_patient->liste_acm_exploration_fait(31);
 ?>
<section class="content home">
    <div class="container-fluid">
       
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
						
						<div class="card">
							<div class="header">
								<h2>Liste des examens faits</h2>
								<?php //var_dump($listeEncours) ?>
							</div>
							<div class="body table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>Patient</th>
											<th>Acte imagerie</th>
											<th>Médecin prescripteur</th>
											<th>Jour de l'acte</th>
											<th>Médecin examinateur</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
								   
									<tbody>
									<?php foreach($listeEncours AS $le){ 
										$e = $this->md_patient->medecin_prescripteur_exploration($le->sea_id); 
										
									?>
										<tr>
											<td><?php echo '<b>'.$le->pat_sPrenom.' '.$le->pat_sNom .'</b><br> ('.$le->pat_sMatricule.')'; ?></td>
											<td class="text-center"><?php echo $le->lac_sLibelle ; ?> <br><br> dans l'unité<br><br><b><?php echo $le->uni_sLibelle ; ?></b></td>
											<td class="text-center"><?php if(!is_null($e->per_sAvatar)){echo "<img src='".base_url($e->per_sAvatar)."' width='65' height='65'/><br><b>".$e->per_sNom.'</b> '.$e->per_sPrenom." <br>(".$e->per_sMatricule.")";}else{echo "<span style='color:red'>pas encore renseigné</span>";} ?></td>
											<td class="text-center"><?php echo $this->md_config->affDateTimeFr($le->aef_dDate);?></td>
											<td class="text-center"><?php echo "<img src='".base_url($le->per_sAvatar)."' width='65' height='65'/><br><b>".$le->per_sNom.'</b> '.$le->per_sPrenom." <br>(".$le->per_sMatricule.")"; ?></td>
											<td class="text-center">
												<a href="javascript:();"><i class="fa fa-print" style="font-size:40px"></i></a>
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