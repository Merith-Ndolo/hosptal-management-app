
<?php include("includes/header.php"); ?>
<?php $listeSer = $this->md_parametre->liste_services_actifs(); ?>
<?php $liste = $this->md_parametre->liste_chambre_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">Les chambres et les lits </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_service pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Ajouter une nouvelle</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Nom chambre</th>
									<th>Nombre de lit</th>
									<th>Prix du lit</th>
									<th>Unité</th>
									<th>service</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<?php echo $l->cha_sLibelle; ?>
									</td>									
									
									<td>
										<?php echo count($this->md_parametre->liste_lit_chambre($l->cha_id));?>
									</td>									
									<td>
										<?php echo $l->cha_iPrixLit; ?> Fcfa
									</td>
									<td>
										<?php echo $l->uni_sLibelle; ?>
									</td>
									<td>
										<?php echo $l->ser_sLibelle; ?>
									</td>
									
									
									<td class="text-center">
										
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
							<h2>Ajoutez des nouvelles chambres</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-chambre">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:30%">Service *</th>
											<th style="width:30%">Unité *</th>
											<th style="width:22%">Nom salle *</th>
											<th style="width:13%">Prix /jour*</th>
											<th style="width:8%">Nombre de lit *</th>
											<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
											<td>
												<select id="serCh" style="width:100%;padding-bottom:7px;padding-top:7px">
													<?php foreach($listeSer AS $ls){ ?>
													<option value="<?php echo $ls->ser_id; ?>-/-<?php echo $ls->ser_sLibelle; ?>"><?php echo $ls->ser_sLibelle; ?></option>
													<?php } ?>
												</select>
											</td>
											<td>
												<select id="uni" style="width:100%;padding-bottom:7px;padding-top:7px">
													<option value=''>----- Choisissez l'unité * -----</option>
												</select>
											</td>
											<td>
												<input type="text" id="lib" style="width:100%"/>
											</td>
											<td>
												<input type="number"  id="prix" style="width:100%" value="0"/>
											</td>
											<td>
												<input type="number" min="1" id="nb" style="width:100%" value="1"/>
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
                <a href="javascript:();" class="btn btn-success waves-effect addChambre" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
            <div class="modal-body text-center"> Chambre(s) enregistée(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
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
            var serCh 	            = document.getElementById('serCh').value;
            var uni 	            = document.getElementById('uni').value;
            var nb 	            = document.getElementById('nb').value;
            var lib 	            = document.getElementById('lib').value;
            var prix 	            = document.getElementById('prix').value;
            if(serCh == '' || uni == '' || nb == '' || lib == '' 	|| prix == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.serCh	    = serCh;
                contact.uni	        = uni;
                contact.nb	        = nb;
                contact.lib	        = lib;
                contact.prix	        = prix;
                annuaire.push(contact);
                showListeArm();	
				document.getElementById('lib').value="";
				document.getElementById('nb').value=1;
				document.getElementById('prix').value=0;
            }
        }

        addArm.addEventListener('click', addDetailArm);

        function showListeArm() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabSer = annuaire[i].serCh.split("-/-");
				var tabUni = annuaire[i].uni.split("-/-");
				
                contenu += '<tr>';
				contenu += '<td><input type="hidden" name="ser[]" value="'+ tabSer[0]+'"/>' + tabSer[1] + '</td>';
				contenu += '<td><input type="hidden" name="uni[]" value="'+ tabUni[0]+'"/>' + tabUni[1] + '</td>';
                contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
                contenu += '<td><input type="hidden" name="prix[]" value="'+ annuaire[i].prix+'"/>' + annuaire[i].prix + ' Fcfa / jr</td>';
                contenu += '<td><input type="hidden" name="nb[]" value="'+ annuaire[i].nb+'"/>' + annuaire[i].nb + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeArm(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeArm.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>