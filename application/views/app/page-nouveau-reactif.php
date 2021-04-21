
<?php include("includes/header.php"); ?>
<?php $listeActe = $this->md_parametre->liste_acts_actifs(); ?>
<?php $liste = $this->md_parametre->liste_type_couverture_assurance_actifs(); ?>


<?php $listeExam = $this->md_parametre->liste_type_examen_actifs();?>
<?php $list = $this->md_parametre->liste_reactif_actifs(); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des réactifs </h2>
                        <button style="" type="button" class="btn bg-blue-grey waves-effect ajout_typeAss pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b> Noveau réactif</b></button>
						
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation réactif</th>
									<th>Nombre d'utilisation</th>
									<th>Examens liés</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($list AS $l){?>
								<tr>
									<td>
										<span class="champs_tas<?php echo $l->rea_id ?>"><?php echo $l->rea_sLibelle; ?></span>
										<form id='form-edit-tas<?php echo $l->rea_id ?>'>
											<textarea class="cacher input_tas<?php echo $l->rea_id ?>" style='width:100%' name='lib'><?php echo $l->rea_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->rea_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->rea_sLibelle ?>" name="nom"/>
										</form>
									</td>
									<td>
										<span class="champs_taux<?php echo $l->rea_id ?>"><?php echo $l->rea_iNb; ?></span>
										<form id='form-edit-taux<?php echo $l->rea_id ?>'>
											<input type="number" class="cacher input_taux<?php echo $l->rea_id ?>" style='width:100%' name='taux' value="<?php echo $l->rea_iNb; ?>" />
										</form>
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
														echo "<li>".$r->tex_sLibelle."</li>";
													} 
													echo "</ul>";
												}
											?>
										</ul>
									
									</td>
									<td class="text-center">
										<a href="javascript:();" rel="" class="editTypeFinal confirm_tas cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="" class="editTypeAnnule annule_tas text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="" class="editType clique_tas" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer ce réactif ?')" href="<?php echo site_url("parametre/supprimer_reactif/".$l->rea_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
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

<!-- Large Size -->
<div class="modal fade" id="mdModalType" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="margin-top:20px; max-width:80%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:500px; overflow:auto;">
			
				 <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						
						<div class="body table-responsive">
							<div class="col-md-12">
								<form id="form-reactif">
									<div class="row clearfix">
										<div class="col-sm-12 retour3"></div>
										<div class="col-sm-5">
											<div class="header">
												<h2>Détails du réactif</h2>
											</div>
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="lib" class="form-control lib obligatoire" placeholder="Désignation du réactif *">
												</div>
											</div>
											<div class="form-group retour"></div>
										</div>
										<div class="col-sm-7">
											<div class="header">
												<h2>Examens liés</h2>
												<i style="font-size:12px;text-decoration:underline" class="text-danger">(N'oubliez pas d'appuyer sur le plus pour ajouter un examen)</i>
											</div>
											<div class="body table-responsive">
												<form id="form-cou">
													<table class="table table-bordered table-striped table-hover">
														<thead>
															<tr>
																<th>Examen *</th>
																<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
															</tr>
															<tr>
																<td>
																	<select id="lacId" style="width:100%;padding-bottom:5px;padding-top:5px">
																		<option value="">----- Choisissez le type d'examen -----</option>
																		<?php foreach($listeExam AS $l){ ?>
																		<option value="<?php echo $l->tex_id; ?>-/-<?php echo $l->tex_sLibelle; ?>"><?php echo $l->tex_sLibelle; ?></option>
																		<?php } ?>
																	</select>
																</td>
																<td class="text-center">
																	<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addExam"><i class="fa fa-plus"></i></a>
																</td>
															</tr>
														</thead>
													   
														<tbody id="tbodyCou"></tbody>
													</table>
												</form>
												
											</div>
										</div>
										
									</div>
								</form>
									
							</div>
							
						</div>
					</div>
				</div>
			
			</div>
            <div class="modal-footer">
                <a href="javascript:();" class="btn btn-success waves-effect addReactif" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
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
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DES RESSOURCES HUMAINES</h4>
            </div>
            <div class="modal-body text-center"> Données enregistées avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>
		
		 <script type="text/javascript">
        'use strict';
		
        var listeCou = document.querySelector('#tbodyCou');
        var addExam = document.querySelector('#addExam');
        var annuaireCou;
        annuaireCou = new Array();

        function removeCou(index) {
            annuaireCou.splice(index,1);
            showListeCou();	
        }

        function addDetailCou() 
        {
            var lacId 	            = document.getElementById('lacId').value;
			
            if(lacId == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contactCou = new Object();
                contactCou.lacId	        = lacId;
                annuaireCou.push(contactCou);
                showListeCou();
            }
        }

        addExam.addEventListener('click', addDetailCou);

        function showListeCou() 
        {
            var contenuCou="";
            var tailleTableauCou = annuaireCou.length;            
                
            for(var i = 0; i < tailleTableauCou; i++) {
				
				var tabLac = annuaireCou[i].lacId.split("-/-");
				
                contenuCou += '<tr>';
                contenuCou += '<td><input type="hidden" name="lac[]" value="'+ tabLac[0]+'"/>' + tabLac[1] + '</td>';
                contenuCou += '<td class="text-center"><a href="javascript:();" onClick="removeCou(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenuCou += '</tr>';
            }

            listeCou.innerHTML = contenuCou;
			// alert(contenuCou);
        }
    
        </script>

<?php include("includes/footer.php"); ?>