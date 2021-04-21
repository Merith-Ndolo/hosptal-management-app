
<?php include("includes/header.php"); ?>
<?php $listeType = $this->md_parametre->liste_type_personnel(); ?>
<?php $listePst = $this->md_parametre->liste_postes_actifs(); ?>
<?php $liste = $this->md_parametre->liste_specialites_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des spécialités hospitalières </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_unite pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Ajouter un nouveau</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation de la spécialité</th>
									<th>Domaine</th>
									<th>Type personnel</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<span class="champs_spt<?php echo $l->spt_id ?>"><?php echo $l->spt_sLibelle; ?></span>
										<form id='form-edit-spt<?php echo $l->spt_id ?>'>
											<textarea class="cacher input_spt<?php echo $l->spt_id ?>" style='width:100%' name='lib'><?php echo $l->spt_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->spt_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->spt_sLibelle ?>" name="nom"/>
										</form>
									</td>
									<td>
										<span class="champs_pst<?php echo $l->spt_id ?>"><?php echo $l->pst_sLibelle; ?></span>
										<form id='form-edit_pst<?php echo $l->spt_id ?>'>
											<select class="cacher input_pst<?php echo $l->spt_id ?>" name="pst" style="width:100%;padding-bottom:10px;padding-top:10px">
												<?php $lst = $this->md_parametre->liste_poste_type_actifs($l->tpe_id); foreach($lst AS $ls){ ?>
												<option value="<?php echo $ls->pst_id; ?>-/-<?php echo $ls->pst_sLibelle; ?>" <?php if($ls->pst_id == $l->pst_id){echo "selected='selected'";} ?>><?php echo $ls->pst_sLibelle; ?></option>
												<?php } ?>
											</select>
										</form>
									</td>
									<td>
										<span class="champs_tpe<?php echo $l->spt_id ?>"><?php echo $l->tpe_sLibelle; ?></span>
										<form id='form-edit_tpe<?php echo $l->spt_id ?>'>
											<select class="cacher clickTpe input_tpe<?php echo $l->spt_id ?>" name="tpe" style="width:100%;padding-bottom:10px;padding-top:10px" rel="<?php echo $l->spt_id ?>">
												<?php foreach($listeType AS $d){ ?>
												<option value="<?php echo $d->tpe_id; ?>-/-<?php echo $d->tpe_sLibelle; ?>" <?php if($d->tpe_id == $l->tpe_id){echo "selected='selected'";} ?>><?php echo $d->tpe_sLibelle; ?></option>
												<?php } ?>
											</select>
										</form>
									</td>
									<td class="text-center">
										<a href="javascript:();" rel="<?php echo $l->spt_id; ?>" class="editSpecialiteFinal confirm_spt<?php echo $l->spt_id; ?> cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="<?php echo $l->spt_id; ?>" class="editSpecialiteAnnule annule_spt<?php echo $l->spt_id; ?> text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="<?php echo $l->spt_id; ?>" class="editSpecialite clique_spt<?php echo $l->spt_id; ?>" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer cette spécialité ?')" href="<?php echo site_url("parametre/supprimer_specialite/".$l->spt_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
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
							<h2>Ajoutez des nouvelles spécialités hospitalières</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-spe">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:32%">Type personnel</th>
											<th style="width:32%">Domaine</th>
											<th style="width:32%">Spécialité</th>
											<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
											<td>
												<select id="typePer" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez le type de personnel * -----</option>
													<?php foreach($listeType AS $d){ ?>
													<option value="<?php echo $d->tpe_id; ?>-/-<?php echo $d->tpe_sLibelle; ?>"><?php echo $d->tpe_sLibelle; ?></option>
													<?php } ?>
												</select>
											</td>
											<td>
												<select id="domaine" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez le domaine * -----</option>
													
												</select>
											</td>
											<td>
												<input type="text" id="lib" style="width:100%" placeholder="Saisissez le nom de la spécialté dans ce champs"/>
												
											</td>
											
											<td class="text-center">
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addSpe"><i class="fa fa-plus"></i></a>
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
                <a href="javascript:();" class="btn btn-success waves-effect addSpe" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
            <div class="modal-body text-center"> Spécialité(s) enregistée(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeUni = document.querySelector('#tbody');
        var addSpe = document.querySelector('#addSpe');
        var annuaire;
        annuaire = new Array();

        function removeSpe(index) {
            annuaire.splice(index,1);
            showListeSpe();	
        }

        function addDetailSpe() 
        {
            var lib 	            = document.getElementById('lib').value;
            var domaine 	            = document.getElementById('domaine').value;
            var typePer 	            = document.getElementById('typePer').value;
			
            if(lib == '' || typePer == ''|| domaine == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                contact.domaine	    = domaine;
                contact.typePer	        = typePer;
                annuaire.push(contact);
                showListeSpe();	
				document.getElementById('lib').value="";
            }
        }

        addSpe.addEventListener('click', addDetailSpe);

        function showListeSpe() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabType = annuaire[i].typePer.split("-/-");
				var tabDom = annuaire[i].domaine.split("-/-");
				
                contenu += '<tr>';
                contenu += '<td>' + tabType[1] + '</td>';
                contenu += '<td><input type="hidden" name="pst[]" value="'+ tabDom[0]+'"/>' + tabDom[1] + '</td>';
				 contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeSpe(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeUni.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>