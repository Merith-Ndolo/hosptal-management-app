
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_stock_reactif(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">Stock des réactifs </h2>
						<a id="destock" href="javascript:();" class="btn btn-danger btn-sm waves-effect volontaire pull-right cacher" style="color:#fff"><i class="fa fa-remove"></i> <b>Destocker</b></a>
						<?php //var_dump($liste ) ;?>
					</div>
                    <div class="body table-responsive"> 
					<form id="form-destockage">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Selection</th>
									<th>Réactif</th>
									<th>Nombre</th>
									<th>Examen lié restant</th>
									<th>Code à barre</th>
									<th>Image code</th>
									<th>Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>	
									<td>
										<input type="hidden" name="ere[]" value="<?php echo $l->ere_id; ?>"/>
										<div class="switch">
											<label>
												<input type="checkbox" class="checkReactif" name="id[]" value="<?php echo $l->res_id; ?>">
												<span class="lever"></span>
											</label>
										</div>
									</td>
									<td>
										<?php echo $l->rea_sLibelle ;?>
									</td>
									<td>
										<?php echo $l->res_iNb ;?>
									</td>	
									<td>
										
										<ul>
											<?php 
												$reactif = $this->md_parametre->liste_examen_reactif_actifs($l->rea_id);
												if(empty($reactif)){
													echo "<i class='text-danger' style='font-size:12px'>Pas d'examens liés à ce réactif</i>";
												}
												else{
													echo "<ul>";
													foreach($reactif AS $r){
														$verif=$this->md_parametre->liste_examen_reactif_nu_actifs($r->tex_id,$l->res_id);
														if(!$verif){
															echo "<li>".$r->tex_sLibelle."</li>";
														}
													} 
													echo "</ul>";
												}
											?>
										</ul>
									
									</td>									
									<td>
										<?php echo $l->res_sCode ;?>
									</td>									
									<td>
										<img style="width:100px" src="<?php echo base_url( $l->res_sImg) ;?>"/> 
									</td>
									<td>
										<?php $verification = $this->md_parametre->liste_examen_reactif_sortie($l->res_id);  var_dump($verification); if($verification){ ?>
											<b style="color:red">Réactif Non Disponible</b><br><i>en cours d'utilisation</i>
										<?php }else{ ?>
											<a href="javascript:();" rel="<?php echo $l->res_id ;?>" class="btn bg-blue-grey btn-sm waves-effect pull-right sortir" style="color:#fff"><i class="fa fa-sign-in"></i> <b>Sortir</b></a>
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