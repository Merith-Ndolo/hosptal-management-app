<?php include("includes/header.php"); ?>
<?php $listeCourrierEntrant = $this->md_courrier->recup_courrier_entrant(); ?>




<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Courriers entrants</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2> Boite de reception </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_service pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Ajouter un courrier entrant</b></button>
					</div>
					 <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Envoyeur</th>
									<th>Destinataire</th>
									<th>Date de reception</th>
									<th>Objet</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($listeCourrierEntrant AS $l){ ?>
								<tr>
									<td>
										<?php echo $l->tce_sEnvoyeur; ?>
										
									</td>
									<td>
										<?php echo $l->tce_sDestinataire; ?>
										
									</td>
									<td>
										<?php echo $l->tce_dDate; ?>
										
									</td>
									<td>
										<?php echo $l->tce_sObjet; ?>
										
									</td>
									<td class="text-center">
										<a href="<?php echo base_url($l->tce_sContenu); ?>" target="_blank" title="voir"><i class="zmdi zmdi-receipt mdc-text-light-blue" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de vouloir archiver ce courrier ?')" href="<?php echo site_url("courrier/archiver_courrier_entrant/".$l->tce_id); ?>" class="delete" title="Archiver"><i class="zmdi zmdi-archive text-warning" style="font-size:20px"></i></a>
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
    <div class="modal-dialog modal-lg" role="document" style="margin-top:20px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:500px; overflow:auto;">
			
				 <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="header">
						
							<h2>Ajoutez un courrier</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-tce">
								<div class="col-sm-12 retour"></div>
								<div class="row clearfix">
									
									<div class="col-sm-12">
										
										<div class="row clearfix" id="riverain">
											<div class="col-sm-12">
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="expediteur" class="form-control obligatoire" placeholder="Expéditeur *">
													</div>
													<div class="form-line">
														<input type="text" name="beneficiaire" class="form-control obligatoire" placeholder="Bénéficiaire *">
													</div>
													<div class="form-line">
														<input type="text" name="objet" class="form-control obligatoire" placeholder="Objet *">
													</div>
													<div class="form-line">
														<input type="datepicker" name="Date" class="datepicker form-control obligatoire" placeholder="Date *">
													</div>
													<div class="form-line">
													<label for="contenu">Joidre contenu</label>
														<input type="file" name="contenu" class="form-control obligatoire" placeholder="Contenu *">
													</div>
													
												</div>
											</div>
											
										</div>
										
									</div>
								</div>
							</form>
							
						</div>
					</div>
				</div>
			
			</div>
            <div class="modal-footer">
                <a href="javascript:();" class="btn btn-success waves-effect addTce" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
		<!-- #END# Tabs With Custom Animations -->
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
  <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DES RESSOURCES HUMAINES</h4>
            </div>
            <div class="modal-body text-center"> Courrier ajouté avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>






<?php include("includes/footer.php"); ?>