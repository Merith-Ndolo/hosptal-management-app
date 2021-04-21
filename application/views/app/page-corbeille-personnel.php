
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_personnel-> liste_personnels_supprimes(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>LISTE EMPLOYÉ SUPPRIMÉS</h2>
                        
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Matricule</th>
                                    <th>Direction</th>
                                    <th>Domaine</th>
                                    <th>Spécialité</th>
                                    <th style="width:30px">Action</th>
                                </tr>
                            </thead>
                           
                            <tbody>
							<?php foreach($liste AS $l){ ?>
                                <tr>
                                    <td><?php echo $l->per_sNom; ?></td>
                                    <td><?php echo $l->per_sPrenom; ?></td>
                                    <td><?php echo $l->per_sTel; ?></td>
                                    <td><?php echo $l->per_sMatricule; ?></td>
                                    <td><?php echo $l->dep_sLibelle; ?></td>
                                    <td><?php echo $l->pst_sLibelle; ?></td>
                                    <td><?php echo $l->spt_sLibelle; ?></td>
                                    <td class="text-center">
										<a onclick="return confirm('Confirmez-vous la restauration de cet employé ?');" href="<?php echo site_url("corbeille/restaure_personnel/".$l->per_id); ?>" class="text-success" title="Restaurer"><i class="fa fa-reply text-success" style="font-size:25px"></i></a>
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