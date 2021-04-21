
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_postes_supprimes(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Corbeille</h2>
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des domaines professionnels </h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation du domaine</th>
									<th>Type personnel</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<?php echo $l->pst_sLibelle; ?>
									</td>
									<td>
										<?php echo $l->tpe_sLibelle; ?>
									</td>
									<td class="text-center">
										<a onClick="return confirm('Êtes-vous sûr de restaurer ce domaine ?')" href="<?php echo site_url("corbeille/restaure_domaine/".$l->pst_id); ?>" class="delete" title="Restaurer"><i class="fa fa-reply text-sucess" style="font-size:20px"></i></a>
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