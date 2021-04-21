
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_personnel-> nb_complete_personnel(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>LISTE COMPLÈTE DU PERSONNEL</h2>
                        
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>N° Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Direction</th>
                                    <th>Domaine</th>
									<th>Spécialiste en</th>
                                    <th>Téléphone</th>
                                    
                                    <th style="width:60px">Action</th>
                                </tr>
                            </thead>
                           
                            <tbody>
							<?php foreach($liste AS $l){ ?>
                                <tr>
                                    <td><?php echo $l->per_sMatricule; ?></td>
                                    <td><?php echo $l->per_sNom; ?></td>
                                    <td><?php echo $l->per_sPrenom; ?></td>
                                    <td><?php echo $l->dep_sLibelle; ?></td>
                                    <td><?php echo $l->pst_sLibelle; ?></td>
                                    <td><?php echo $l->spt_sLibelle; ?></td>
                                    <td><?php echo $l->per_sTel; ?></td>
                                    <td>
										<a href="<?php echo site_url("personnel/profil/".$l->per_id); ?>" class="edit" title="Voir  le profil"><i class="fa fa-eye text-success" style="font-size:20px"></i></a> &nbsp;
										<a href="<?php echo site_url("personnel/editer/".$l->per_id); ?>" class="edit" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onclick="return confirm('Confirmez-vous la suppression de cet employé ?');" href="<?php echo site_url("personnel/supprimer/".$l->per_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
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