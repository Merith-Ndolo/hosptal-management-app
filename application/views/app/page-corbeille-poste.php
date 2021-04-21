
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_fonctions_supprimees(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des postes hospitalièrs </h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation du poste</th>
									<th>Domaine</th>
									<th>Type personnel</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<?php echo $l->fct_sLibelle; ?>
									</td>
									<td>
										<?php echo $l->pst_sLibelle; ?>
									</td>
									<td>
										<?php echo $l->tpe_sLibelle; ?>
									</td>
									<td class="text-center">
										<a onClick="return confirm('Êtes-vous sûr de restaurer ce poste ?')" href="<?php echo site_url("corbeille/restaure_fonction/".$l->fct_id); ?>" class="delete" title="Restaurer"><i class="fa fa-reply text-success" style="font-size:20px"></i></a>
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