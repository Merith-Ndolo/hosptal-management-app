
<?php include("includes/header.php"); ?>
<?php 
	$liste = $this->md_pharmacie->liste_client_supprimes();
 ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Corbeille</h2>
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Liste des clients supprimés</h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Matricule</th>
									<th>Nom</th>
									<th>Prénom(s)</th>
									<th>Adresse</th>
									<th>Téléphone</th>
									<th>Date création</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td><?=$l->clt_sMatricule ;?></td>
									<td><?=$l->clt_sNom ;?></td>
									<td><?=$l->clt_sPrenom ;?></td>
									<td><?=$l->clt_sAdresse ;?></td>
									<td><?=$l->clt_sTel ;?></td>								
									<td><?=$this->md_config->affDateFrNum($l->clt_dDateCreation);?></td>								
									<td class="text-center">
										<a onClick="return confirm('Êtes-vous sûr de restaurer ce client ?')" href="<?php echo site_url("corbeille/restaure_client/".$l->clt_id); ?>" class="Restaurer" title="Supprimer"><i class="fa fa-reply text-success" style="font-size:20px"></i></a>
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