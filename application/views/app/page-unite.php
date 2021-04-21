
<?php include("includes/header.php"); ?>
<?php $listeDirect = $this->md_personnel->liste_departements_actifs(); ?>
<?php $listeSer = $this->md_parametre->liste_services_actifs(); ?>
<?php $liste = $this->md_parametre->liste_unites_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des unités de l'hôpital </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_unite pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Ajouter un nouveau</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation de l'unité</th>
									<th>Service</th>
									<th>Direction</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<span class="champs_uni<?php echo $l->uni_id ?>"><?php echo $l->uni_sLibelle; ?></span>
										<form id='form-edit-uni<?php echo $l->uni_id ?>'>
											<textarea class="cacher input_uni<?php echo $l->uni_id ?>" style='width:100%' name='lib'><?php echo $l->uni_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->uni_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->uni_sLibelle ?>" name="nom"/>
										</form>
									</td>
									<td>
										<span class="champs_ser<?php echo $l->uni_id ?>"><?php echo $l->ser_sLibelle; ?></span>
										<form id='form-edit_ser<?php echo $l->uni_id ?>'>
											<select class="cacher input_ser<?php echo $l->uni_id ?>" name="ser" style="width:100%;padding-bottom:10px;padding-top:10px">
												<?php $lst = $this->md_parametre->liste_services_direction_actifs($l->dep_id); foreach($lst AS $ls){ ?>
												<option value="<?php echo $ls->ser_id; ?>-/-<?php echo $ls->ser_sLibelle; ?>" <?php if($ls->ser_id == $l->ser_id){echo "selected='selected'";} ?>><?php echo $ls->ser_sLibelle; ?></option>
												<?php } ?>
											</select>
										</form>
									</td>
									<td>
										<span class="champs_dep<?php echo $l->uni_id ?>"><?php echo $l->dep_sLibelle; ?></span>
										<form id='form-edit_dep<?php echo $l->uni_id ?>'>
											<select class="cacher clickDep input_dep<?php echo $l->uni_id ?>" name="dep" style="width:100%;padding-bottom:10px;padding-top:10px" rel="<?php echo $l->uni_id ?>">
												<?php foreach($listeDirect AS $d){ ?>
												<option value="<?php echo $d->dep_id; ?>-/-<?php echo $d->dep_sLibelle; ?>" <?php if($d->dep_id == $l->dep_id){echo "selected='selected'";} ?>><?php echo $d->dep_sLibelle; ?></option>
												<?php } ?>
											</select>
										</form>
									</td>
									<td class="text-center">
										<a href="javascript:();" rel="<?php echo $l->uni_id; ?>" class="editUniteFinal confirm_uni<?php echo $l->uni_id; ?> cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="<?php echo $l->uni_id; ?>" class="editUniteAnnule annule_uni<?php echo $l->uni_id; ?> text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="<?php echo $l->uni_id; ?>" class="editUnite clique_uni<?php echo $l->uni_id; ?>" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer cette unité ?')" href="<?php echo site_url("parametre/supprimer_unite/".$l->uni_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
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
    <div class="modal-dialog modal-lg" role="document" style="margin-top:20px; max-width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:500px; overflow:auto;">
			
				 <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="header">
							<h2>Ajoutez des nouvelles unités à l'hôpital</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-uni">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:32%">Direction</th>
											<th style="width:32%">Service</th>
											<th style="width:32%">Unité</th>
											<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
											<td>
												<select id="dir" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez la direction * -----</option>
													<?php foreach($listeDirect AS $d){ ?>
													<option value="<?php echo $d->dep_id; ?>-/-<?php echo $d->dep_sLibelle; ?>"><?php echo $d->dep_sLibelle; ?></option>
													<?php } ?>
												</select>
											</td>
											<td>
												<select id="serv" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez le service * -----</option>
													
												</select>
											</td>
											<td>
												<input type="text" id="lib" style="width:100%" placeholder="Saisissez le nom de l'unité dans ce champs"/>
												
											</td>
											
											<td class="text-center">
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addUni"><i class="fa fa-plus"></i></a>
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
                <a href="javascript:();" class="btn btn-success waves-effect addUni" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
            <div class="modal-body text-center"> Unité(s) enregistée(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeUni = document.querySelector('#tbody');
        var addUni = document.querySelector('#addUni');
        var annuaire;
        annuaire = new Array();

        function removeUni(index) {
            annuaire.splice(index,1);
            showListeUni();	
        }

        function addDetailUni() 
        {
            var lib 	            = document.getElementById('lib').value;
            var serv 	            = document.getElementById('serv').value;
            var dir 	            = document.getElementById('dir').value;
			
            if(lib == '' || dir == ''|| serv == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                contact.serv	    = serv;
                contact.dir	        = dir;
                annuaire.push(contact);
                showListeUni();	
				document.getElementById('lib').value="";
            }
        }

        addUni.addEventListener('click', addDetailUni);

        function showListeUni() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabDir = annuaire[i].dir.split("-/-");
				var tabServ = annuaire[i].serv.split("-/-");
				
                contenu += '<tr>';
                contenu += '<td>' + tabDir[1] + '</td>';
                contenu += '<td><input type="hidden" name="ser[]" value="'+ tabServ[0]+'"/>' + tabServ[1] + '</td>';
				 contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeUni(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeUni.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>