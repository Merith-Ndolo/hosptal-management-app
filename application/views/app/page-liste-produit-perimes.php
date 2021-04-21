
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_pharmacie->liste_produit_perimes(date('Y-m-d')); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des produits périmés </h2>
						
						<?php //var_dump($liste); ?>
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Nom commercial</th>
									<th>Forme</th>
									<th>Dosage/Unité</th>
									<th>Quantité</th>
									<th>Montant</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td><?=$l->med_sNc;?></td>
									<td><?=$l->for_sLibelle;?></td>
									<td><?=$l->med_iDosage.''.$l->med_sUnite;?></td>
									<td><?=$l->ach_iQte;?></td>
									<td><?=$l->ach_iQte*$l->ach_iPrixAchat;?></td>
									<td class="text-center">
										<a style="color:red" onClick="return confirm('Êtes-vous sûr d'effectuer cette opération ?')" href="<?php echo site_url("pharmacie/destockage_produit/".$l->ach_id); ?>" class="delete" title="Supprimer">Destocké</a>&nbsp;&nbsp;
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
							<h2>Ajoutez des nouveaux postes hospitalièrs</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-poste">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:32%">Type personnel</th>
											<th style="width:32%">Domaine</th>
											<th style="width:32%">Poste</th>
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
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addPos"><i class="fa fa-plus"></i></a>
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
                <a href="javascript:();" class="btn btn-success waves-effect addPos" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
            <div class="modal-body text-center"> Poste(s) enregisté(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listePoste = document.querySelector('#tbody');
        var addPos = document.querySelector('#addPos');
        var annuaire;
        annuaire = new Array();

        function removePoste(index) {
            annuaire.splice(index,1);
            showListePoste();	
        }

        function addDetailPoste() 
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
                showListePoste();	
				document.getElementById('lib').value="";
            }
        }

        addPos.addEventListener('click', addDetailPoste);

        function showListePoste() 
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
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removePoste(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listePoste.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>