
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_pharmacie->liste_produit_destock(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des produits destockés </h2>
						
						<?php //var_dump($liste); ?>
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Produit</th>
									<th>Emplacement</th>
									<th>P.vente</th>
									<th>Date Destockage</th>
									<th>Date Expiration</th>
									<th>Code à barre</th>
									<th>Motif</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>
									</td>						
									<td>
										<?=$l->sal_sLibelle.' '.$l->arm_sLibelle.' '.$l->cel_sLibelle;?>
									</td>
									<td>
										<?=number_format($l->ach_iPrixVente,2,",",".");?> Fcfa
									</td>									
									<td>
										<?=$this->md_config->affDateFrNum($l->pro_dDateExpir);?>
									</td>									
									<td>
										<?=$this->md_config->affDateFrNum($l->pro_dDateDestock);?>
									</td>
									<td>
										<?=$l->pro_sCodeBarre;?>
									</td>
									<td>
										<?=$l->pro_sMotif;?>
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