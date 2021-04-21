<?php include("includes/header.php"); ?>
<?php $listeRdv = $this->md_rdv->liste_des_rdv(date("Y-m-d")); ?>



<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">Liste des rendez-vous </h2>
                    </div>
					
					
                    <div class="body table-responsive"> 
					
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Demandeur</th>
									<th>Date</th>
									<th>Heure</th>
									<th>Destinataire</th>
									<th>Objet</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
							<?php  //var_dump($liste)?>
							<tbody>

								<?php foreach($listeRdv AS $lr){ ?>
								<tr <?php if($lr->dir_dDate==date("Y-m-d") AND $lr->dir_tHeure<date("H:i:s")){ ?>class="table-danger"<?php } ?>>
									<td><?php echo $lr->dir_sNom;?>
									 <?php echo $lr->dir_sPrenom;?> </td>
									<td><?php echo $this->md_config->affDateFrNum($lr->dir_dDate);?></td>
									<td><?php echo $lr->dir_tHeure;?></td>
									<td><?php echo $lr->per_sNom;?> <?php echo $lr->per_sPrenom;?> </td>
									<td><?php echo $lr->dir_sObjet;?></td>
									<td>	
										<a onClick="return confirm('Êtes-vous sûr d\'annuler le rendez-vous ?')" href="<?php echo site_url("rdv/annulerRdv/".$lr->dir_id); ?>" class="delete" title="annuler"><i class="fa fa-remove text-danger" style="font-size:20px"></i></a>
										<a onClick="return confirm('Êtes-vous sûr d\'accorder l\'audience ?')" href="<?php echo site_url("rdv/validerRdv/".$lr->dir_id); ?>" class="delete" title="annuler"><i class="fa fa-check text-success" style="font-size:20px"></i></a>
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