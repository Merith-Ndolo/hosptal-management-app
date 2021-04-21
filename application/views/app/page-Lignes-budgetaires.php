
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_unites_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
           	 <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					
					<div class="body table-responsive">
						<div class="col-md-12">
							<form id="form-lib">
								<div class="row clearfix">
									<div class="col-sm-12 retour"></div>
									<div class="col-sm-6">
										<div class="header">
											<h2>Ajouter la ligne budgetaire</h2>
											
										</div>
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="lib" class="form-control lib obligatoire" placeholder="Designation *">
											</div>
										</div>
										<div class="form-group">
											<div class="form-line">
												<label>Objectif *</label> 
												<textarea class="form-control obligatoire" id="edit" name="objectif"></textarea>
											</div>
										</div>
										
										<div class="form-group">
											<div class="form-line">
												<input type="text" name="date" class="datepicker form-control obligatoire" placeholder="Date d'exécution *">
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-sm-4">
												<div class="form-group">
													<div class="form-line">
														<input type="number" name="montant" min="100" class="form-control obligatoire" placeholder="montant (Fcfa) *">
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<div class="form-line">
														<input type="number" name="seuil" class="form-control obligatoire" placeholder="seuil (Fcfa) *">
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<div class="form-line">
														<input type="number" name="etat" class="form-control obligatoire" placeholder="Etat (Fcfa) *">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="header">
											<h2>Unités destinataires</h2>
											<i style="font-size:12px;text-decoration:underline" class="text-danger">(N'oubliez pas d'appuyer sur le plus pour ajouter une unité)</i>
										</div>
										<div class="body table-responsive">
											<table class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th>Unités</th>
														<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
													</tr>
													<tr>
														<td>
															<select id="lacId" style="width:100%;padding-bottom:5px;padding-top:5px">
																<option value="">----- Choisissez l'unité * -----</option>
																<?php foreach($liste AS $l){ ?>
																<option value="<?php echo $l->uni_id; ?>-/-<?php echo $l->uni_sLibelle; ?>"><?php echo $l->uni_sLibelle; ?></option>
																<?php } ?>
															</select>
														</td>
														<td class="text-center">
															<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addCou"><i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
											   
												<tbody id="tbody"></tbody>
											</table>
											
										</div>
									</div>
									
								</div>
							</form>
							<div class="col-sm-12 pull-left retour"></div>
							<a href="javascript:();" class="btn btn-success waves-effect pull-right addLib" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
						</div>
						
					</div>
				</div>
			</div>
        </div>
    </div>
</section>


<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DES RESSOURCES HUMAINES</h4>
            </div>
            <div class="modal-body text-center"> Données enregistées avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>
		
<script type="text/javascript">
        'use strict';
		
        var listeCou = document.querySelector('#tbody');
        var addCou = document.querySelector('#addCou');
        var annuaireCou;
        annuaireCou = new Array();

        function removeCou(index) {
            annuaireCou.splice(index,1);
            showListeCou();	
        }

        function addDetailCou() 
        {
            var lacId 	            = document.getElementById('lacId').value;
			
            if(lacId == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contactCou = new Object();
                contactCou.lacId	        = lacId;
                annuaireCou.push(contactCou);
                showListeCou();
            }
        }

        addCou.addEventListener('click', addDetailCou);

        function showListeCou() 
        {
            var contenuCou="";
            var tailleTableauCou = annuaireCou.length;            
                
            for(var i = 0; i < tailleTableauCou; i++) {
				
				var tabLac = annuaireCou[i].lacId.split("-/-");
				
                contenuCou += '<tr>';
                contenuCou += '<td><input type="hidden" name="uni[]" value="'+ tabLac[0]+'"/>' + tabLac[1] + '</td>';
                contenuCou += '<td class="text-center"><a href="javascript:();" onClick="removeCou(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenuCou += '</tr>';
            }

            listeCou.innerHTML = contenuCou;
			// alert(contenuCou);
        }
    
        </script>

<?php include("includes/footer.php"); ?>