<?php 
	include("includes/header.php"); 
	$f = $this->md_pharmacie->recup_fournisseur($frs_id);
	$listeType = $this->md_parametre->liste_type_fournisseur_actifs();
	$listePays = $this->md_parametre->liste_pays_actifs();
	$listeVille = $this->md_parametre->liste_ville_actifs($f->pay_id);
	$tfrCourant = $this->md_parametre->type_fournisseur_courant($f->tfr_id);
?>

<section class="content profile-page">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Les détails du fournisseur</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>        
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class=" card patient-profile">
                    <img src="<?php echo base_url($f->frs_sLogo); ?>" class="img-fluid" alt="">                              
                </div>
                <div class="card">
                    <div class="header">
                        <h2>A propos du fournisseur</h2>
                    </div>
                    <div class="body">
                        <strong>Matricule</strong>
                        <p><?php echo $f->frs_sMatricule; ?></p>                        
						<strong>Enseigne</strong>
                        <p><?php echo $f->frs_sEnseigne; ?></p>
                        <strong>Adresse</strong>
                        <p><?php echo $f->frs_sAdresse; ?></p>
                        <strong>E-mail</strong>
                        <p><?php echo $f->frs_sEmail; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body"> 
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#timeline">Autres informations</a></li>
                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane in active" id="timeline">
                                <div class="timeline-body">
                                    <div class="timeline m-border">
									    <div class="timeline-item border-warning">
                                            <div class="item-content">
                                                <div class="text-small"><strong>Téléphone 1</strong></div>
                                                <p><?php echo $f->frs_sTel_1; ?></p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="item-content">
                                                <div class=""><strong>Téléphone 2</strong></div>
                                                <p><?php if($f->frs_sTel_2==null){echo '<em>Pas renseigné</em>';}else{echo $f->frs_sTel_2;}; ?></p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small"><strong>Pays</strong></div>
                                                <p><?php echo $f->pay_sLib; ?></p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-warning border-l">
                                            <div class="item-content">
                                                <div class="text-small"><strong>Ville</strong></div>
                                                <p><?php echo $f->vil_sLib; ?> </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-danger">
                                            <div class="item-content">
                                                <div class="text--muted"><strong>Site Web</strong></div>
                                                <p><?php if($f->frs_sWeb==null){echo '<em>Pas renseigné</em>';}else{echo $f->frs_sWeb;}; ?></p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small"><strong>Date Enregistrement</strong></div>
                                                <p><?php echo $this->md_config->affDateTimeFr($f->frs_dDateEnreg); ?></p>
                                            </div>
                                        </div>
										<div class="timeline-item border-warning">
                                            <div class="item-content">
                                                <div class="text-small"><strong>Type fournisseur</strong></div>
                                                <p><?php echo $tfrCourant->tfr_sLibelle; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
	
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DES RESSOURCES HUMAINES</h4>
            </div>
            <div class="modal-body text-center"> Employé ajouté avec succès <br><img src="<?php echo base_url("assets/images/icons8-attendance-50.png");?>"/></div>
            <div id="refresh"></div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>