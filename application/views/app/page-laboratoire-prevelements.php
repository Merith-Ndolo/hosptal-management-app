<?php include("includes/header.php"); ?>
<?php 
	
	$listeEncours = $this->md_patient->liste_acm_laboratoire(date("Y-m-d H:i:s"),27);

 ?>
<section class="content home">
    <div class="container-fluid">
       
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
						
						<div class="card">
							<div class="header">
								<h2>Prélèvements laboratoires</h2>
								<?php //var_dump($listeEncours) ?>
							</div>
							<div class="body table-responsive">
								  <!-- Nav tabs -->
								<ul class="nav nav-tabs">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">En attente</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Déjà prélévé</a></li>
								</ul>                        
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane in active" id="home"> <b>Contenu du prélèvement en attente</b>
										<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
												<tr>
													<th>Patient</th>
													<th>Acte laboratoire</th>
													<th>Médécin prescripteur</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
										   
											<tbody>
											<?php foreach($listeEncours AS $le){ ?>
												<tr>
													<td><?php echo '<b>'.$le->pat_sPrenom.' '.$le->pat_sNom .'</b> ('.$le->pat_sMatricule.')'; ?></td>
													<td><?php echo $le->lac_sLibelle ; ?></td>
													<td class="text-center" style="font-size:13px"><?php echo "<img src='".base_url($le->per_sAvatar)."' width='50' height='50'/><br><b>".$le->per_sNom.'</b> '.$le->per_sPrenom." <br>(".$le->per_sMatricule.")"; ?></td>
													<td class="text-center">
														<a href="<?php echo site_url("laboratoire/prelevement_tube/".$le->ala_id); ?>"><b><i class="fa fa-flask" style="font-size:23px"></i><br>Générer le numéro de tube</b></a>
													</td>
												</tr>
											<?php } ?>
											</tbody>
											
										</table>
									</div>
									<div role="tabpanel" class="tab-pane" id="profile"> <b>Contenu du prélèvement déjà effectué</b>
										<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
												<tr>
													<th>Patient</th>
													<th>Acte laboratoire</th>
													<th>Médécin prescripteur</th>
													<th>Prél</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
										   
											<tbody>
											<?php foreach($listeEncours AS $le){ ?>
												<tr>
													<td><?php echo '<b>'.$le->pat_sPrenom.' '.$le->pat_sNom .'</b> ('.$le->pat_sMatricule.')'; ?></td>
													<td><?php echo $le->lac_sLibelle ; ?></td>
													<td class="text-center" style="font-size:13px"><?php echo "<img src='".base_url($le->per_sAvatar)."' width='50' height='50'/><br><b>".$le->per_sNom.'</b> '.$le->per_sPrenom." <br>(".$le->per_sMatricule.")"; ?></td>
													<td class="text-center">
														
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
</section>
<?php include("includes/footer.php"); ?>