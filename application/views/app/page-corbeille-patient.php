
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_patient->liste_patients_supprimes(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des patients de l'hôpital (supprimés) </h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Matricule</th>
									<th>Nom et prénom</th>
									<th>Téléphone</th>
									<th>Adresse</th>
									<th class="text-center" style="width:65px">Photo</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<?php echo $l->pat_sMatricule; ?>
									</td>
									<td>
										<?php echo $l->pat_sNom; ?> <?php echo $l->pat_sPrenom; ?>
									</td>
									<td>
										<?php echo $l->pat_sTel; ?>
									</td>
									<td>
										<?php echo $l->pat_sAdresse; ?>
									</td>
									<td class="text-center">
										<img src="<?php echo base_url($l->pat_sAvatar); ?>" class="img-thumbnail" width="60"/>
									</td>
									<td class="text-center">
										<a onClick="return confirm('Êtes-vous sûr de restaurer ce patient ?')" href="<?php echo site_url("corbeille/restaure_patient/".$l->pat_id); ?>" class="delete" title="Restaurer"><i class="fa fa-reply text-success" style="font-size:20px"></i></a>
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
</section>

<?php include("includes/footer.php"); ?>