
<?php include("includes/header.php"); ?>
<?php $listeSalle = $this->md_parametre->liste_salle_actifs(); ?>
<?php $liste = $this->md_parametre->liste_armoire_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">Les armoires et leurs salles </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_service pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Ajouter une nouvelle</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Armoire</th>
									<th>Nombre de lignes</th>
									<th>Nombre de colonnes</th>
									<th>Cellules</th>
									<th>Salle</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<span class="champs_arm<?php echo $l->arm_id; ?>"><?php echo $l->arm_sLibelle; ?></span>
										<form id='form-edit-arm<?php echo $l->arm_id; ?>'>
											<textarea class="cacher input_arm<?php echo $l->arm_id ?>" style='width:100%' name='lib'><?php echo $l->arm_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->arm_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->arm_sLibelle ?>" name="nom"/>
										</form>
									</td>									
									
									<td>
										<?php $ligne = count($this->md_parametre->liste_ligne_armoire($l->arm_id)); ?>
										<span class="champs_lig<?php echo $l->arm_id; ?>"><?php echo $ligne; ?></span>
										<form id='form-edit-lig<?php echo $l->arm_id; ?>'>
											<input class="cacher input_lig<?php echo $l->arm_id ?>" style='width:100%' name='ligne' value="<?php echo $ligne; ?>" />
										</form>
									</td>									
									<td>
										<?php $colonne = count($this->md_parametre->liste_colonne_armoire($l->arm_id)); ?>
										<span class="champs_col<?php echo $l->arm_id; ?>"><?php echo $colonne; ?></span>
										<form id='form-edit-col<?php echo $l->arm_id; ?>'>
											<input class="cacher input_col<?php echo $l->arm_id ?>" style='width:100%' name='colonne' value="<?php echo $colonne; ?>" />
										</form>
									</td>
									<td id="cel<?php echo $l->arm_id; ?>">
										<?php $cellule = $this->md_parametre->liste_cellule_armoire($l->arm_id); foreach($cellule AS $c){echo $c->cel_sLibelle."; ";} ?>
									</td>
									
									<td>
										<span class="champs_sal<?php echo $l->arm_id; ?>"><?php echo $l->sal_sLibelle; ?></span>
										<form id='form-edit_sal<?php echo $l->arm_id; ?>'>
											<select class="cacher input_sal<?php echo $l->arm_id ;?>" name="sal" style="width:100%;padding-bottom:10px;padding-top:10px">
												<?php foreach($listeSalle AS $d){ ?>
												<option value="<?php echo $d->sal_id; ?>-/-<?php echo $d->sal_sLibelle; ?>" <?php if($d->sal_id == $l->sal_id){echo "selected='selected'";} ?>><?php echo $d->sal_sLibelle; ?></option>
												<?php } ?>
											</select>
										</form>
									</td>
									<td class="text-center">
										<a href="javascript:();" rel="<?php echo $l->arm_id; ?>" class="editArmoireFinal confirm_arm<?php echo $l->arm_id; ?> cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="<?php echo $l->arm_id; ?>" class="editArmoireAnnule annule_arm<?php echo $l->arm_id; ?> text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="<?php echo $l->arm_id; ?>" class="editArmoire clique_arm<?php echo $l->arm_id; ?>" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer cette armoire ?')" href="<?php echo site_url("parametre/supprimer_armoire/".$l->arm_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
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
							<h2>Ajoutez des nouvelles armoires</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-arm">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:24%">Salle *</th>
											<th style="width:24%">Libellé armoire *</th>
											<th style="width:24%">Nombre de lignes *</th>
											<th style="width:24%">Nombre de colonnes *</th>
											<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
											
											<td>
												<select id="dep" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez la salle -----</option>
													<?php foreach($listeSalle AS $lis){ ?>
													<option value="<?php echo $lis->sal_id; ?>-/-<?php echo $lis->sal_sLibelle; ?>"><?php echo $lis->sal_sLibelle; ?></option>
													<?php } ?>
												</select>
											</td>
											<td>
												<input type="text" id="lib" style="width:100%" placeholder="Saisissez le libellé dans ce champs"/>
											</td>
											<td>
												<input type="number" min="1" id="ligne" style="width:100%" value="1"/>
											</td>
											<td>
												<input type="number" min="1" id="colonne" style="width:100%" value="1"/>
											</td>
											<td class="text-center">
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addArm"><i class="fa fa-plus"></i></a>
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
                <a href="javascript:();" class="btn btn-success waves-effect addArm" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE D'ADMINISTRATION APP</h4>
            </div>
            <div class="modal-body text-center"> Armoire(s) enregistée(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeArm = document.querySelector('#tbody');
        var addArm = document.querySelector('#addArm');
        var annuaire;
        annuaire = new Array();

        function removeArm(index) {
            annuaire.splice(index,1);
            showListeArm();	
        }

        function addDetailArm() 
        {
            var lib 	            = document.getElementById('lib').value;
            var dep 	            = document.getElementById('dep').value;
            var ligne 	            = document.getElementById('ligne').value;
            var colonne 	            = document.getElementById('colonne').value;
            if(lib == '' || dep == '' || ligne == '' || colonne == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                contact.dep	        = dep;
                contact.ligne	        = ligne;
                contact.colonne	        = colonne;
                annuaire.push(contact);
                showListeArm();	
				document.getElementById('lib').value="";
            }
        }

        addArm.addEventListener('click', addDetailArm);

        function showListeArm() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabDep = annuaire[i].dep.split("-/-");
				
                contenu += '<tr>';
				contenu += '<td><input type="hidden" name="sal[]" value="'+ tabDep[0]+'"/>' + tabDep[1] + '</td>';
                contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
                contenu += '<td><input type="hidden" name="ligne[]" value="'+ annuaire[i].ligne+'"/>' + annuaire[i].ligne + '</td>';
                contenu += '<td><input type="hidden" name="colonne[]" value="'+ annuaire[i].colonne+'"/>' + annuaire[i].colonne + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeArm(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeArm.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>