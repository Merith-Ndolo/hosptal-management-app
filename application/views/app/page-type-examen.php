
<?php include("includes/header.php"); ?>
<?php $listeActeLabo = $this->md_parametre->liste_acts_laboratoires_actifs(); ?>
<?php $liste = $this->md_parametre->liste_type_examen_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des type d'examen </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_service pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Ajouter un nouveau</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Type d'examen</th>
									<th>Acte médical</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<span class="champs_ser<?php echo $l->tex_id ?>"><?php echo $l->tex_sLibelle; ?></span>
										<form id='form-type-examen<?php echo $l->tex_id ?>'>
											<textarea class="cacher input_ser<?php echo $l->tex_id ?>" style='width:100%' name='lib'><?php echo $l->tex_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->tex_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->tex_sLibelle ?>" name="nom"/>
										</form>
									</td>
									<td>
										<span class="champs_dep<?php echo $l->tex_id ?>"><?php echo $l->lac_sLibelle; ?></span>
										<form id='form-edit-lac<?php echo $l->tex_id ?>'>
											<select class="cacher input_dep<?php echo $l->tex_id ?>" name="dep" style="width:100%;padding-bottom:10px;padding-top:10px">
												<?php foreach($listeActeLabo AS $d){ ?>
												<option value="<?php echo $d->lac_id; ?>-/-<?php echo $d->lac_sLibelle; ?>" <?php if($d->lac_id == $l->tex_id){echo "selected='selected'";} ?>><?php echo $d->lac_sLibelle; ?></option>
												<?php } ?>
											</select>
										</form>
									</td>
									<td class="text-center">
										<a href="javascript:();" rel="<?php echo $l->tex_id; ?>" class="editTypeExamenFinal confirm_ser<?php echo $l->tex_id; ?> cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="<?php echo $l->tex_id; ?>" class="editTypeExamenAnnule annule_ser<?php echo $l->tex_id; ?> text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="<?php echo $l->tex_id; ?>" class="editTypeExamen clique_ser<?php echo $l->tex_id; ?>" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer ce type d'examen ?')" href="<?php echo site_url("parametre/supprimer_type_examen/".$l->tex_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
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
							<h2>Ajoutez un nouveau type d'examen</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-ser">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:48%">Type d'examen</th>
											<th style="width:48%">Acte médical</th>
											<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
											<td>
												<input type="text" id="lib" style="width:100%" placeholder="Saisissez le type d'examen"/>
												
											</td>
											<td>
												<select id="dep" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez l'acte médical * -----</option>
													<?php foreach($listeActeLabo AS $t){ ?>
													<option value="<?php echo $t->lac_id; ?>-/-<?php echo $t->lac_sLibelle; ?>"><?php echo $t->lac_sLibelle; ?></option>
													<?php } ?>
												</select>
											</td>
											<td class="text-center">
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addTypeExamen"><i class="fa fa-plus"></i></a>
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
                <a href="javascript:();" class="btn btn-success waves-effect addTypeExamen" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
            <div class="modal-body text-center"> Type d'examen(s) enregisté(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeSer = document.querySelector('#tbody');
        var addTypeExamen = document.querySelector('#addTypeExamen');
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
            if(lib == '' || dep == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                contact.dep	        = dep;
                annuaire.push(contact);
                showListeSer();	
				document.getElementById('lib').value="";
            }
        }

        addTypeExamen.addEventListener('click', addDetailSer);

        function showListeSer() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabDep = annuaire[i].dep.split("-/-");
				
                contenu += '<tr>';
                contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
                contenu += '<td><input type="hidden" name="dep[]" value="'+ tabDep[0]+'"/>' + tabDep[1] + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeSer(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeSer.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>