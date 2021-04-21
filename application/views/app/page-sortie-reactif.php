
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_sorties_reactif(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">historique des mouvements des réactifs</h2>
					</div>
                    <div class="body table-responsive"> 
					<form id="form-destockage">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="font-size:13px">
						   
							<thead>
								<tr>
									<th>Réactif</th>
									<th>Pour l'examen</th>
									<th>Code à barre</th>
									<th>Date de sortie</th>
									<th>Date de retour</th>
									<th>Retiré par</th>
									<th>Autorisé par</th>
									<th>Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>	
									
									<td>
										<?php echo $l->rea_sLibelle ;?>
									</td>
									<td>
										<?php echo $l->tex_sLibelle ;?>
									</td>									
									<td>
										<?php echo $l->res_sCode ;?>
									</td>									
									<td>
										<?php echo $this->md_config->affDateFrNum($l->res_dDateSortie) ;?>
									</td>
									<td>
										<?php if(!is_null($l->res_dDateRetour)){echo $this->md_config->affDateFrNum($l->res_dDateRetour);}else{echo "<i style='color:red'>en cours d'utilisation</i>";} ;?>
									</td>
									<td>
										<?php echo $l->per_sNom ;?> <?php echo $l->per_sPrenom ;?>
									</td>
									<td>
										<?php $per = $this->md_personnel->recup_personnel($l->res_iDon);echo $per->per_sNom ;?> <?php echo $per->per_sPrenom ;?>
									</td>
									<td>
										<?php if($l->sor_iSta!=1){ ?>
											<b style="color:green">Réactif utilisé et remis</i>
										<?php }else{ ?>
											<a onClick="return confirm('Confirmez-vous que ce réactif a été remis ?');" href="<?php echo site_url("laboratoire/remettre_reactif/".$l->sor_id) ;?>" class="btn bg-blue-grey btn-sm waves-effect pull-right remettre" style="color:#fff"><i class="fa fa-sign-out"></i> <b>Remettre</b></a>
										<?php } ?>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="mdModalDestockVolontaire" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title text-center" style="" id="defaultModalLabel">LABORATOIRE</h4>
				- <span class="nombre"></span>
            </div>
            <div class="modal-body"> 
				<p class=" text-center" style="color:red">Cette action supprimera tous les réactifs sélectionnés du stock<br>Voulez vous continuez ?  </p><br>
				<form id="form-motif">
					<textarea  style="width:100%"  name="motif" rows="4" placeholder="Décrire le motif de destockage ici"></textarea>
				</form>
			</div>
            <div class="modal-footer">
                <a href="javascript:();" onClick="return confirm('Dernier avertissement, valider si oui');" class="btn btn-success waves-effect destockReactif" style="color:#fff"><i class="fa fa-check"></i> OUI</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdModalSortie" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:60%">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title text-center" style="" id="defaultModalLabel">LABORATOIRE</h4>
				- <span class="nombre"></span>
            </div>
            <div class="modal-body">
				<form id="form-sortie"> 
					<div class="body table-responsive" style="font-size:13.5px" id="body"> 
					</div> 
				</form> 
			</div>
            <div class="modal-footer">
                <a href="javascript:();" class="btn btn-success waves-effect sortieReac" style="color:#fff"><i class="fa fa-check"></i> Autoriser la sortie</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Annuler</button>
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
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE D'ADMINISTRATION APP</h4>
            </div>
            <div class="modal-body text-center"> Opération effectuée avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>



<?php include("includes/footer.php"); ?>