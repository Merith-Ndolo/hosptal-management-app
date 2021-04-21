
<?php include("includes/header.php"); ?>
<?php $listeDirect = $this->md_personnel->liste_departements_actifs(); ?>
<?php $liste = $this->md_parametre->liste_services_actifs(); ?>
<?php $listeClient = $this->md_pharmacie->liste_client_pharmacie(); ?>



<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des clients </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_service pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Nouveau</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Client</th>
									<th>Bon de pharmacie</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($listeClient AS $l){  $listeBon = $this->md_pharmacie->liste_bon_client($l->clt_id); ?>
							
								<tr>
									<td>
										<span class="champs_clt<?php echo $l->clt_id; ?>">
											
											Nom(s) : <strong><?php echo $l->clt_sNom; ?></strong><br>
											Prénom(s) : <strong><?php echo $l->clt_sPrenom; ?></strong><br>
											Adresse : <strong><?php echo $l->clt_sAdresse; ?></strong><br>
											Matricule : <strong><?php echo $l->clt_sMatricule; ?></strong><br>
											Téléphone : <strong><?php echo $l->clt_sTel; ?></strong><br>
											
										</span>
										<form id='form-edit-client<?php echo $l->clt_id; ?>'>
											<div class="retour<?php echo $l->clt_id; ?>"></div>
											<input type="hidden" value="<?php echo $l->clt_id; ?>" name="id"/>
											<label class="cacher input_nom<?php echo $l->clt_id; ?>" style="margin-right:25px;width:45%">Nom(s) : <input type="text" style='width:100%' name='nom' value="<?php echo $l->clt_sNom; ?>"><br></label>
											<label class="cacher input_prenom<?php echo $l->clt_id; ?>" style="margin-right:25px;width:45%">Prenom(s) : <input type="text" style='width:100%' name='prenom' value="<?php echo $l->clt_sPrenom; ?>"><br></label>
											<label class="cacher input_adresse<?php echo $l->clt_id; ?>" style="margin-right:25px;width:45%">Adresse : <input type="text" style='width:100%' name='adresse' value="<?php echo $l->clt_sAdresse; ?>"><br></label>
											<label class="cacher input_tel<?php echo $l->clt_id; ?>" style="margin-right:25px;width:45%">Téléphone : <input type="text" style='width:100%' name='tel' class="tel<?php echo $l->clt_id; ?>" value="<?php echo $l->clt_sTel; ?>"><br></label>
										</form>
									</td>
									<td>
										<a href="javascript:();" class="clickBon" rel="<?php echo $l->clt_id; ?>"><i class="fa fa-plus">Ajouter bon</i></a><br><br>
										<?php foreach($listeBon AS $lb){ ?>
											N° : <strong><?php echo $lb->bph_sNumBon; ?></strong><span class="pull-right"> Montant : <strong><?php echo number_format($lb->bph_iMontant,2,",",".") ; ?></strong>  Fcfa</span>
											<br>
											Enreg. : <strong><?php echo $this->md_config->affDateTimeFr($lb->bph_dDateEtablis) ; ?></strong>
											<span class="pull-right">Montant consommé : <strong><?php echo number_format($lb->bph_iMontantConso,2,",","."); ?></strong> Fcfa</span><br>
											Expire : <strong><?php echo $this->md_config->affDateFrNum($lb->bph_dDateExpir); ?></strong>
											<span class="pull-right">Reste : <strong><?php echo number_format($lb->bph_iReste,2,",","."); ?></strong> Fcfa</span>
											<hr>
										<?php }?>
										
									</td>
									<td class="text-center">
										<a href="javascript:();" rel="<?php echo $l->clt_id; ?>" class="editClientFinal confirm_clt<?php echo $l->clt_id; ?> cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="<?php echo $l->clt_id; ?>" class="editClientAnnule annule_clt<?php echo $l->clt_id; ?> text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="<?php echo $l->clt_id; ?>" class="editClient clique_clt<?php echo $l->clt_id; ?>" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer ce client ?')" href="<?php echo site_url("pharmacie/supprimer_client/".$l->clt_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
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

<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="">
			
				 <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="header">
							<h2>Ajoutez client/Bon pharmacie</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-add-client">
								<div class="row clearfix">
									<div class="col-sm-12 retour"></div>
									<div class="col-sm-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="nom" class="form-control obligatoire" placeholder="Nom du client *">
											</div>
										</div>
									</div>									
									<div class="col-sm-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="prenom" class="form-control" placeholder="Prénom du client">
											</div>
										</div>
									</div>
								</div>
														
								<div class="row clearfix">
									<div class="col-sm-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="adresse" class="form-control obligatoire adresse" placeholder="Adresse *">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="tel" class="form-control  obligatoire tel" placeholder="Téléphone *">
											</div>
										</div>
									</div>
								</div>								
								
								<div class="row clearfix">
									<div class="col-sm-12">
										<div class="form-group">
											<div class="form-line">
												<input type="number" name="montant" class="form-control obligatoire montant" placeholder="Montant (Fcfa) *">
											</div>
										</div>
									</div>
								</div>
									<div class="modal-footer">
										<a href="javascript:();" class="btn btn-success waves-effect addClient" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
										<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			
			</div>
        </div>
    </div>
</div>

<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE PHARMACIE</h4>
            </div>
            <div class="modal-body text-center">Bon de commande enregistré et transmis au responsable de validation </div>
            <div class="refresh"></div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>