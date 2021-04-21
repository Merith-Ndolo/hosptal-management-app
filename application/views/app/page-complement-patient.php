<?php include("includes/header.php"); ?>
<?php $acm = $this->md_patient->acm_patient($id); ?>
<?php $patient = $this->md_patient->recup_patient($acm->pat_id); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Complément des informations importantes du patient</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<a href="<?php echo site_url("consultation/faire/".$id); ?>"> <i class="fa fa-"></i>retour </a>
					</div>
					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-12 col-md-12 col-lg-12"> 
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" style="display:none">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home_animation_1" id="antecedent">Étape 1</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages_animation_1" id="contact">Étape finale</a></li>
								</ul>
								
								<ul class="nav nav-tabs">
									<li class="nav-item"><a class="nav-link active"  disabled >Pour <?php if($patient->pat_sSexe == "H"){echo "le patient";}else{echo "la patiente";} ?> <b><?php echo $patient->pat_sNom." ".$patient->pat_sPrenom; ?> </b></a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">		
										<div class="row clearfix">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="card">
													<div class="header">
														<h2>ANTÉCÉDENT MÉDICAL <small>renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
													<div class="body">
														<form id="form-antecedent">
															<div class="row clearfix">
																<div class="col-sm-12 retour1"></div>
																<div class="col-sm-6">
																	<div class="form-group drop-custum">
																		<select name="confirmAnt" class="form-control obligatoire show-tick ante">
																			<option value="">-- Antécédent médical ou maladie héréditaire * --</option>
																			<option value="Non">Non</option>
																			<option value="Oui">Oui</option>
																		</select>
																	</div>
																</div>
																
															</div>
															<div class="row clearfix liste cacher">
																<div class="col-sm-12">
																	<div class="form-group">
																		<div class="body table-responsive">
																			<table class="table table-bordered table-striped table-hover">
																				<thead>
																					<tr>
																						<th style="width:48%">Type</th>
																						<th style="width:48%">Désignation</th>
																						<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
																					</tr>
																					<tr>
																						<td>
																							<select id="ante" style="width:100%;padding-bottom:5px;padding-top:5px">
																								<option value="">----- Choisissez le type * -----</option>
																								<option value="Maladie héréditaire">Maladie héréditaire</option>
																								<option value="Antécédent médical">Antécédent médical</option>
																							</select>
																						</td>
																						<td>
																							<input type="text" id="libAnt" style="width:100%" placeholder="Saisissez le nom de la maladie"/>
																						</td>
																						
																						<td class="text-center">
																							<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addAnt"><i class="fa fa-plus"></i></a>
																						</td>
																					</tr>
																				</thead>
																			   
																				<tbody id="tbodyAnt"></tbody>
																			</table>
																		</div>
																	</div>
																</div>
																
															</div>
															<div class="row clearfix">
																
																<div class="col-sm-12">
																	<button type="submit" class="btn btn-raised bg-blue-grey" id="suivantAnt">Suivant</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
				
									<div role="tabpanel" class="tab-pane animated flipInX" id="messages_animation_1">
										<div class="row clearfix">
											<div class="col-md-12">
												<div class="card">
													<div class="header">
														<h2>PERSONNE À CONTACTER <small>Renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
													<div class="body">
														<form id="form-perContact">
															<div class="row clearfix">
																<div class="col-sm-12 retour3"></div>
																<div class="col-sm-6">
																	<div class="form-group drop-custum">
																		<select name="confirmPer" class="form-control obligatoire show-tick per">
																			<option value="">-- Personnes à contacter en cas de problème * --</option>
																			<option value="Non">Non</option>
																			<option value="Oui">Oui</option>
																		</select>
																	</div>
																</div>
																
															</div>
															<div class="row clearfix listePer cacher">
																<div class="col-sm-12">
																	<div class="form-group">
																		<div class="body table-responsive">
																			<table class="table table-bordered table-striped table-hover">
																				<thead>
																					<tr>
																						<th>Nom</th>
																						<th>Prénom</th>
																						<th>Type de lien</th>
																						<th>Téléphone</th>
																						<th style="width:130px">Adresse</th>
																						<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
																					</tr>
																					<tr>
																						
																						<td>
																							<input type="text" id="nom" style="width:100%" placeholder="Saisissez le nom de la personne *"/>
																						</td>
																						<td>
																							<input type="text" id="prenom" style="width:100%" placeholder="Saisissez le prénom de la personne"/>
																						</td>
																						<td>
																							<input type="text" id="lien" style="width:100%" placeholder="Lien avec le patient"/>
																						</td>
																						<td>
																							<input type="text" id="tel" style="width:100%" placeholder="Numéro de téléphone de la personne *"/>
																						</td>
																						<td>
																							<textarea id="adresse" style="width:100%" placeholder="Adresse"></textarea>
																						</td>
																						
																						<td class="text-center">
																							<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addPer"><i class="fa fa-plus"></i></a>
																						</td>
																					</tr>
																				</thead>
																			   
																				<tbody id="tbodyPer"></tbody>
																			</table>
																			<input type="hidden" name="id" value="<?php echo $acm->pat_id; ?>"/>
																		</div>
																	</div>
																</div>
																
															</div>
															
															<div class="row clearfix">
																<div class="col-sm-12">
																	<button type="button" class="btn btn-raised g-bg-cyan" id="precedentAnt">Précédent</button>
																	<button type="submit" class="btn btn-raised bg-blue-grey" id="terminerAnt">Terminer</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>                           
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Tabs With Custom Animations -->
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
    </div>
</section>


<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
	
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE ACCUEIL</h4>
            </div>
            <div class="modal-body text-center"> Informations complétées avec succès <br><img src="<?php echo base_url("assets/images/icons8-attendance-50.png");?>"/></div>
            <div id="refresh"></div>
        </div>
    </div>
</div>



    <script type="text/javascript">
        'use strict';
		
        var listePer = document.querySelector('#tbodyPer');
        var addPer = document.querySelector('#addPer');
        var annuairePer;
        annuairePer = new Array();

        function removePer(index) {
            annuairePer.splice(index,1);
            showListePer();	
        }

        function addDetailPer() 
        {
            var nom 	            = document.getElementById('nom').value;
            var prenom 	            = document.getElementById('prenom').value;
            var adresse 	        = document.getElementById('adresse').value;
            var lien 	            = document.getElementById('lien').value;
            var tel 	            = document.getElementById('tel').value;
            if(nom == '' || lien == ''|| tel == '') {
                alert('Veuillez renseigner le champs obligatoire.');	
            }
            else {
                var contactPer = new Object();
                contactPer.nom	        = nom;
                contactPer.prenom	    = prenom;
                contactPer.adresse	    = adresse;
                contactPer.lien	        = lien;
                contactPer.tel	        = tel;
                annuairePer.push(contactPer);
                showListePer();	
				document.getElementById('nom').value="";
				document.getElementById('prenom').value="";
				document.getElementById('adresse').value="";
				document.getElementById('lien').value="";
				document.getElementById('tel').value="";
            }
        }

        addPer.addEventListener('click', addDetailPer);

        function showListePer() 
        {
            var contenuPer="";
            var tailleTableauPer = annuairePer.length;            
                
            for(var i = 0; i < tailleTableauPer; i++) {
				
                contenuPer += '<tr>';
                contenuPer += '<td><input type="hidden" name="nom[]" value="'+ annuairePer[i].nom+'"/>' + annuairePer[i].nom + '</td>';
                contenuPer += '<td><input type="hidden" name="prenom[]" value="'+ annuairePer[i].prenom+'"/>' + annuairePer[i].prenom + '</td>';
                contenuPer += '<td><input type="hidden" name="lien[]" value="'+ annuairePer[i].lien+'"/>' + annuairePer[i].lien + '</td>';
                contenuPer += '<td><input type="hidden" name="tel[]" value="'+ annuairePer[i].tel+'"/>' + annuairePer[i].tel + '</td>';
                contenuPer += '<td><input type="hidden" name="adresse[]" value="'+ annuairePer[i].adresse+'"/>' + annuairePer[i].adresse + '</td>';
                contenuPer += '<td class="text-center"><a href="javascript:();" onClick="removePer(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenuPer += '</tr>';
            }

            listePer.innerHTML = contenuPer;
			// alert(contenu);
        }
    
        </script>
		
		 <script type="text/javascript">
        'use strict';
		
        var listeAnt = document.querySelector('#tbodyAnt');
        var addAnt = document.querySelector('#addAnt');
        var annuaireAnt;
        annuaireAnt = new Array();

        function removeAnt(index) {
            annuaireAnt.splice(index,1);
            showListeAnt();	
        }

        function addDetailAnt() 
        {
            var libAnt 	            = document.getElementById('libAnt').value;
            var ante 	            = document.getElementById('ante').value;
            if(libAnt == '' || ante == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contactAnt = new Object();
                contactAnt.libAnt	        = libAnt;
                contactAnt.ante	        = ante;
                annuaireAnt.push(contactAnt);
                showListeAnt();	
				document.getElementById('libAnt').value="";
            }
        }

        addAnt.addEventListener('click', addDetailAnt);

        function showListeAnt() 
        {
            var contenuAnt="";
            var tailleTableauAnt = annuaireAnt.length;            
                
            for(var i = 0; i < tailleTableauAnt; i++) {
				
                contenuAnt += '<tr>';
                contenuAnt += '<td><input type="hidden" name="typeAnt[]" value="'+ annuaireAnt[i].ante+'"/>' + annuaireAnt[i].ante + '</td>';
                contenuAnt += '<td><input type="hidden" name="libAnt[]" value="'+ annuaireAnt[i].libAnt+'"/>' + annuaireAnt[i].libAnt + '</td>';
                contenuAnt += '<td class="text-center"><a href="javascript:();" onClick="removeAnt(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenuAnt += '</tr>';
            }

            listeAnt.innerHTML = contenuAnt;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>