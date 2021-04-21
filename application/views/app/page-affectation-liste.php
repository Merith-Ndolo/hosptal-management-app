
<?php include("includes/header.php"); ?>
<?php $recup = $this->md_parametre->recup_unite($unite); ?>
<?php $listeFonc = $this->md_parametre->liste_departements_actifs(); ?>
<?php $listePer = $this->md_personnel->liste_personnel_departement($recup->dep_id); ?>
<?php $liste = $this->md_personnel->liste_affectation_personnel_unite($unite); ?>
<?php 
	if($recup->ser_id == 31 || $recup->ser_id == 19 || $recup->ser_id == 11){
		$acces = 1;
	}
	else if($recup->ser_id == 29){
		$acces = 2;
	}
	else if($recup->ser_id == 1){
		$acces = 3;
	}
	else if($recup->ser_id == 37){
		$acces = 4;
	}
	else if($recup->ser_id == 21){
		$acces = 5;
	}
	// else if($recup->ser_id == ){
		// $acces = 0;
	// }
	else if($recup->ser_id == 25){
		$acces = 6;
	}
	else if($recup->ser_id == 27){
		$acces = 7;
	}
	else if($recup->ser_id == 30){
		$acces = 8;
	}
	else if($recup->ser_id == 22){
		$acces = 9;
	}
	else if($recup->ser_id == 38){
		$acces = 10;
	}

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
		
           <h2>Gestion des affectations dans l'unité <b style="text-decoration:underline"><?php echo $recup->uni_sLibelle; ?></b></h2>
			<small class="text-muted">-> <?php echo $recup->dep_sLibelle; ?> -> <?php echo $recup->ser_sLibelle; ?> -> <b><?php echo $recup->uni_sLibelle; ?></b></small>
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des employés de cette unité et leur poste </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_service pull-right" style="color:#fff"><i class="fa fa-arrow-right"></i> <b>Faire une affectation</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Matricule employé</th>
									<th>Photo</th>
									<th>Nom(s) et Prénom(s)</th>
									<th>Spécialité de l'employé</th>
									<th>Fonction occupée</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<?php echo $l->per_sMatricule; ?>
									</td>
									<td>
										<img src="<?php echo base_url($l->per_sAvatar);?>" class="img-thumbnail rounded-circle" alt="profile-image" width="50" height="50">
									</td>
									<td>
										<?php echo $l->per_sNom; ?> <?php echo $l->per_sPrenom; ?>
									</td>
									<td>
										<?php echo $l->spt_sLibelle; ?>
									</td>
									<td>
										<?php echo $l->fct_sLibelle; ?>
									</td>
									<td class="text-center">
										<a href="<?php echo site_url("personnel/supprimer_affectation/".$l->aft_id); ?>" class="delete" title="Enlevé  du service"><i class="fa fa-remove text-danger" style="font-size:20px"></i></a>
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
							<h2>Opération d'affectation</h2>
							<small class="text-muted">-> <?php echo $recup->dep_sLibelle; ?> -> <?php echo $recup->ser_sLibelle; ?> -> <b><?php echo $recup->uni_sLibelle; ?></b></small>
						</div>
						<div class="body table-responsive">
							<form id="form-aft">
								<input type="hidden" value="<?php echo $recup->uni_id; ?>" name="uni"/>
								<input type="hidden" value="<?php echo $acces; ?>" name="profile"/>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:48%">Employé</th>
											<th style="width:48%">Poste à occupé</th>
											<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
											<td>
												<select id="per" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez l'employé * -----</option>
													<?php foreach($listePer AS $p){ ?>
													<option value="<?php echo $p->per_id; ?>-/-(<?php echo $p->per_sMatricule; ?>) <?php echo $p->per_sNom; ?> <?php echo $p->per_sPrenom; ?>-/-<?php echo $p->pst_id; ?>">(<?php echo $p->per_sMatricule; ?>) <?php echo $p->per_sNom; ?> <?php echo $p->per_sPrenom; ?> </option>
													<?php } ?>
												</select>
												
											</td>
											<td>
												<select id="fct" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">-- Poste occupé au sein de l'hopital * --</option>

												</select>
											</td>
											<td class="text-center">
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addAft"><i class="fa fa-plus"></i></a>
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
                <a href="javascript:();" class="btn btn-success waves-effect addAft" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
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
            <div class="modal-body text-center"> Employé(s) affecté(s) à l'unité <?php echo $recup->uni_sLibelle; ?> avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeAft = document.querySelector('#tbody');
        var addAft = document.querySelector('#addAft');
        var annuaire;
        annuaire = new Array();

        function removeAft(index) {
            annuaire.splice(index,1);
            showListe();	
        }

        function addDetail() 
        {
            var per 	            = document.getElementById('per').value;
            var fct 	            = document.getElementById('fct').value;
            if(per == '' || fct == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.per	        = per;
                contact.fct	        = fct;
                annuaire.push(contact);
                showListe();
            }
        }

        addAft.addEventListener('click', addDetail);

        function showListe() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabPer = annuaire[i].per.split("-/-");
				var tabFct = annuaire[i].fct.split("-/-");
				
                contenu += '<tr>';
                contenu += '<td><input type="hidden" name="per[]" value="'+ tabPer[0]+'"/>' + tabPer[1] + '</td>';
                contenu += '<td><input type="hidden" name="fct[]" value="'+ tabFct[0]+'"/>' + tabFct[1] + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeAft(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeAft.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>