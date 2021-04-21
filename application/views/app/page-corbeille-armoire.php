
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_armoire_supprimes(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Corbeille</h2>
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Liste des armoires supprimées</h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Armoire</th>
									<th>Nombre de lignes</th>
									<th>Nombre de colonnes</th>
									<th>Cellules</th>
									<th>Salle</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<?php echo $l->arm_sLibelle; ?>
										
									</td>
									<td>
										<?php $ligne = count($this->md_parametre->liste_ligne_armoire($l->arm_id)); ?>
										<?php echo $ligne; ?>
									</td>									
									<td>
										<?php $colonne = count($this->md_parametre->liste_colonne_armoire($l->arm_id)); ?>
										<?php echo $colonne; ?>
										
									</td>
									<td>
										<?php $cellule = $this->md_parametre->liste_cellule_armoire($l->arm_id); foreach($cellule AS $c){echo $c->cel_sLibelle."; ";} ?>
									</td>
									
									<td>
										<?php echo $l->sal_sLibelle; ?>
										
									</td>
									<td class="text-center">
										<a onClick="return confirm('Êtes-vous sûr de restaurer cette armoire ?')" href="<?php echo site_url("corbeille/restaure_armoire/".$l->arm_id); ?>" class="Restaurer" title="Supprimer"><i class="fa fa-reply text-success" style="font-size:20px"></i></a>
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