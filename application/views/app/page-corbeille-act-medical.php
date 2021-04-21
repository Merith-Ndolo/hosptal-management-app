
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_acts_supprimees(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des actes médicaux de l'hopital </h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation de l'act</th>
									<th>Coût</th>
									<th>Durée</th>
									<th>Unité</th>
									<th>Service</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>									
									<td>
										<?php echo $l->lac_sLibelle; ?>
										</form>
									</td>
									
									<td>
										<?php echo $l->lac_iCout; ?> <small>FCFA</small>
									</td>
									
									<td>
										<?php echo $l->lac_iDure; ?> Jrs
									</td>

									<td>
										<?php echo $l->uni_sLibelle; ?>
									</td>
									<td>
										<?php echo $l->ser_sLibelle; ?>
									</td>
									<td class="text-center">
										<a onClick="return confirm('Êtes-vous sûr de restaurer cet acte ?')" href="<?php echo site_url("corbeille/restaure_act/".$l->lac_id); ?>" class="delete" title="Supprimer"><i class="fa fa-reply text-success" style="font-size:20px"></i></a>
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
							<h2>Ajoutez des nouveaux actes médicaux</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-act">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:25%">Acte</th>
											<th style="width:12%">Coût (FCFA)</th>
											<th style="width:7%">Durée (Jrs)</th>
											<th style="width:25%">Service</th>
											<th style="width:25%">Unité</th>
											<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
											<td>
												<input type="text" id="lib" style="width:100%" placeholder="Nom de l'acte"/>
												
											</td>
											<td>
												<input type="number" id="cout" style="width:100%" placeholder="Coût de l'acte"/>
												
											</td>
											<td>
												<input type="number" id="duree" style="width:100%" placeholder="Durée de l'acte"/>
												
											</td>
											<td>
												<select id="ser" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez le service * -----</option>
													<?php foreach($listeSer AS $d){ ?>
													<option value="<?php echo $d->ser_id; ?>-/-<?php echo $d->ser_sLibelle; ?>"><?php echo $d->ser_sLibelle; ?></option>
													<?php } ?>
												</select>
											</td>
											<td>
												<select id="uni" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez l'unité * -----</option>
													
												</select>
											</td>
											
											<td class="text-center">
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addAct"><i class="fa fa-plus"></i></a>
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
                <a href="javascript:();" class="btn btn-success waves-effect addAct" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
            <div class="modal-body text-center"> Acte(s) enregisté(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeAct = document.querySelector('#tbody');
        var addAct = document.querySelector('#addAct');
        var annuaire;
        annuaire = new Array();

        function removeAct(index) {
            annuaire.splice(index,1);
            showListeAct();	
        }

        function addDetailAct() 
        {
            var lib 	            = document.getElementById('lib').value;
            var cout 	            = document.getElementById('cout').value;
            var duree 	            = document.getElementById('duree').value;
            var ser 	            = document.getElementById('ser').value;
            var uni 	            = document.getElementById('uni').value;
			
            if(lib == '' || uni == ''|| ser == ''|| cout == ''|| duree == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                contact.cout	    = cout;
                contact.duree	        = duree;
                contact.ser	    = ser;
                contact.uni	        = uni;
                annuaire.push(contact);
                showListeAct();	
				document.getElementById('lib').value="";
				document.getElementById('cout').value="";
				document.getElementById('duree').value="";
            }
        }

        addAct.addEventListener('click', addDetailAct);

        function showListeAct() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabType = annuaire[i].ser.split("-/-");
				var tabDom = annuaire[i].uni.split("-/-");
				
                contenu += '<tr>'; 
				contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
				contenu += '<td><input type="hidden" name="cout[]" value="'+ annuaire[i].cout+'"/>' + annuaire[i].cout + ' <small>FCFA</small></td>';
				contenu += '<td><input type="hidden" name="duree[]" value="'+ annuaire[i].duree+'"/>' + annuaire[i].duree + ' jrs </td>';
                contenu += '<td>' + tabType[1] + '</td>';
                contenu += '<td><input type="hidden" name="uni[]" value="'+ tabDom[0]+'"/>' + tabDom[1] + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeAct(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeAct.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>