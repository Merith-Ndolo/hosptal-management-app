
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_laboratoire->liste_sortie_accessoire(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">L'historique des sorties des accessoires </h2>
						<?php //var_dump($liste);?>
					</div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Accessoire</th>
									<th>Bénéficiaire</th>
									<th>Magasinier</th>
									<th>Quantité</th>
									<th>Date sortie</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){?>
								<tr>									
									<td>
										<?=$l->acc_sLibelle;?>
									</td>
									<td>
										<?=$l->per_sTitre.' '.$l->per_sPrenom.' '.$l->per_sNom;?>
									</td>
									<td>
										<?php $pers = $this->md_laboratoire->recup_magasinier($l->per_iAutorisant); ?>
										<?php echo $pers->per_sTitre.' '.$pers->per_sPrenom.' '.$pers->per_sNom ;?>
									</td>
									<td>
										<?=$l->acs_iQte;?>
									</td>	
									<td>
										<?=$this->md_config->affDateFrNum($l->acs_dDateSorti);?>
									</td>
								</tr>
							<?php }?>
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include("includes/footer.php"); ?>