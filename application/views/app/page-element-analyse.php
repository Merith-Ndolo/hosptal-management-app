
<?php include("includes/header.php"); ?>
<?php $listeActeLabo = $this->md_parametre->liste_acts_laboratoires_actifs(); ?>
<?php $liste = $this->md_parametre->liste_element_analyse_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">Liste des elements d'analyse </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_service pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Ajouter un nouveau</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Examen</th>
									<th>Type examen</th>
									<th>Valeur maximale</th>
									<th>Valeur minimale</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   <?php //var_dump($liste); ?>
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<span class="champs_dep<?php echo $l->ela_id ?>"><?php echo $l->ela_sLibelle; ?></span>
										<form id='form-edit-lac<?php echo $l->ela_id ?>'>
											<select class="cacher input_dep<?php echo $l->ela_id ?>" name="dep" style="width:100%;padding-bottom:10px;padding-top:10px">
												<?php foreach($listeActeLabo AS $d){ ?>
												<option value="<?php echo $d->lac_id; ?>-/-<?php echo $d->ela_sLibelle; ?>" <?php if($d->lac_id == $l->ela_id){echo "selected='selected'";} ?>><?php echo $d->ela_sLibelle; ?></option>
												<?php } ?>
											</select>
										</form>
									</td>
									<td>
										<span class="champs_ser<?php echo $l->ela_id ?>"><?php echo $l->tex_sLibelle; ?></span>
										<form id='form-type-examen<?php echo $l->ela_id ?>'>
											<textarea class="cacher input_ser<?php echo $l->ela_id ?>" style='width:100%' name='lib'><?php echo $l->tex_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->ela_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->tex_sLibelle ?>" name="nom"/>
										</form>
									</td>									
									<td>
										<span class="champs_ser<?php echo $l->ela_id ?>"><?php echo $l->ela_iValMax; ?></span>
										<form id='form-type-examen<?php echo $l->ela_id ?>'>
											<textarea class="cacher input_ser<?php echo $l->ela_id ?>" style='width:100%' name='lib'><?php echo $l->ela_iValMax; ?></textarea>
											<input type="hidden" value="<?php echo $l->ela_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->ela_iValMax ?>" name="nom"/>
										</form>
									</td>			
									<td>
										<span class="champs_ser<?php echo $l->ela_id ?>"><?php echo $l->ela_iValMin; ?></span>
										<form id='form-type-examen<?php echo $l->ela_id ?>'>
											<textarea class="cacher input_ser<?php echo $l->ela_id ?>" style='width:100%' name='lib'><?php echo $l->ela_iValMin; ?></textarea>
											<input type="hidden" value="<?php echo $l->ela_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->ela_iValMin ?>" name="nom"/>
										</form>
									</td>								

									<td class="text-center">
										<a href="javascript:();" rel="<?php echo $l->ela_id; ?>" class="editTypeExamenFinal confirm_ser<?php echo $l->ela_id; ?> cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="<?php echo $l->ela_id; ?>" class="editTypeExamenAnnule annule_ser<?php echo $l->ela_id; ?> text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="<?php echo $l->ela_id; ?>" class="editTypeExamen clique_ser<?php echo $l->ela_id; ?>" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer cet element d'analyse ?')" href="<?php echo site_url("parametre/supprimer_element_analyse/".$l->ela_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
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
    <div class="modal-dialog modal-lg" role="document" style="margin-top:20px; max-width:80%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:500px; overflow:auto;">
			
				 <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="header">
							<h2>Ajoutez les elements d'analyse</h2>
						</div>
						<div class="body table-responsive">
							<form id="form-ser">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="">Examen *</th>
											<th style="">Type examen *</th>
											<th style="">Valeur minimale *</th>
											<th style="">Valeur maximale *</th>
											<th style=""  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
										<?php //var_dump($liste)?>
											<td>
												<select id="dep" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez l'acte médical * -----</option>
													<?php foreach($liste AS $t){ ?>
														<option value="<?php echo $t->tex_id; ?>-/-<?php echo $t->tex_sLibelle; ?>"><?php echo $t->tex_sLibelle; ?></option>
													<?php } ?>
												</select>
											</td>
											<td>
												<input type="text" id="lib" style="width:" placeholder=""/>
											</td>		
											<td>
												<input type="number" id="v1" style="width:" placeholder=""/>
											</td>											
											<td>
												<input type="number" id="v2" style="width:" placeholder=""/>
											</td>
											<td class="text-center">
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addElementAnalyse"><i class="fa fa-plus"></i></a>
											</td>
										</tr>
									</thead>
								   
									<tbody id="tbody"></tbody>
								</table>
							</form>
							
						</div>
					</div>
				</div>
			
			</div>
            <div class="modal-footer">
                <a href="javascript:();" class="btn btn-success waves-effect addElementAnalyse" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
            <div class="modal-body text-center"> element(s) analyse enregisté(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeSer = document.querySelector('#tbody');
        var addElementAnalyse = document.querySelector('#addElementAnalyse');
        var annuaire;
        annuaire = new Array();

        function removeSer(index) {
            annuaire.splice(index,1);
            showListeSer();	
        }

        function addDetailSer() 
        {
            var lib 	            = document.getElementById('lib').value;
            var dep 	            = document.getElementById('dep').value;
            var v1 	            = document.getElementById('v1').value;
            var v2 	            = document.getElementById('v2').value;
            if(lib == '' || dep == '' || v1 == '' || v2 == '') {
                alert('Veuillez renseigner tous les champs.');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                contact.dep	        = dep;
                contact.v1	        = v1;
                contact.v2	        = v2;
                annuaire.push(contact);
                showListeSer();	
				document.getElementById('lib').value="";
				document.getElementById('v1').value="";
				document.getElementById('v2').value="";
            }
        }

        addElementAnalyse.addEventListener('click', addDetailSer);

        function showListeSer() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabDep = annuaire[i].dep.split("-/-");
				
                contenu += '<tr>';
                contenu += '<td><input type="hidden" name="dep[]" value="'+ tabDep[0]+'"/>' + tabDep[1] + '</td>';
				contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
				contenu += '<td><input type="hidden" name="v1[]" value="'+ annuaire[i].v1+'"/>' + annuaire[i].v1 + '</td>';
				contenu += '<td><input type="hidden" name="v2[]" value="'+ annuaire[i].v2+'"/>' + annuaire[i].v2 + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeSer(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeSer.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>