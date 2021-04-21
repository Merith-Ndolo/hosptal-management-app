	
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_pharmacie->liste_medicament(); $listeFour = $this->md_pharmacie->liste_fournisseur_pharmacie(); $listeBon = $this->md_pharmacie->liste_bon_commande(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
                    <div class="header">
                        <h2>Nouveau bon de commande</h2>
                        <?php //var_dump($liste); ?>
                    </div>
                    <div class="body table-responsive">
						<form id="form-commander">
							<div class="form-group">
								<select name="four" id="four" style="width:50%;padding:10px">
									<option value="">-------------- Sélectionnez un fournisseur --------------</option>
									 <?php foreach($listeFour AS $l){ ?>
									<option value="<?php echo  $l->frs_id;?>"><?php echo  $l->frs_sEnseigne.' ('.$l->vil_sLib.' / '.$l->pay_sLib.')';?></option>
									 <?php } ?>
								</select>
							</div>
							<table class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Produit * <!--<a href="javascript:();" class="btn btn-success btn-sm waves-effect addSal" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>--></th>
										<th style="width:30px" class="text-right">Qté *</th>
										<th style="width:45px"  class="text-center"><i class="fa fa-wrench"></i></th>
									</tr>
									<tr>
										<td>
											<select id="lib"  style="width:100%;padding:7px">
												<option value="">-Sélectionnez un produit -</option>
												 <?php foreach($liste AS $l){ ?>
												<option value="<?php echo  $l->med_id;?>-/-<?php echo  $l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>"><?php echo  $l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?></option>
												 <?php } ?>
											</select>
										</td>
										<td>
											<input style="width:45px" type="number" min="1" value="1" id="qte" />
										</td>
										<td class="text-center">
											<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addBonCmd"><i class="fa fa-plus"></i></a>
										</td>
									</tr>
								</thead>
							   
								<tbody id="tbody"></tbody>
							</table>
						</form>
						<a href="javascript:();" class="btn btn-success waves-effect commander pull-right" style="color:#fff"><i class="fa fa-check"></i> Valider</a>
                    </div>
                </div>
			</div>
			
			     <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">liste des bons de commande </h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Bon de comande</th>
									<th>Liste des commandes</th>
									<th>Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($listeBon AS $l){  $detailBon = $this->md_pharmacie->liste_detail_bon($l->cmd_id); ?>
							
								<tr>
									<td>
											
											N° de bon : <strong><?php echo $l->cmd_sBonCmd; ?></strong><br>
											Fournisseur : <strong><?php echo $l->frs_sEnseigne; ?></strong><br>
											Adresse : <strong><?php echo $l->frs_sAdresse; ?> / <?php echo $l->vil_sLib; ?>, <?php echo $l->pay_sLib; ?></strong><br>
											Telephone : <strong><?php echo $l->frs_sTel_1; ?> / <?php echo $l->frs_sTel_2; ?></strong><br>
											Fait par : <strong><?php echo $l->per_sNom; ?> <?php echo $l->per_sPrenom; ?> le <?php echo $this->md_config->affDateFrNum($l->cmd_dDate); ?></strong><br>
											
										
									</td>
									<td>
										<?php foreach($detailBon AS $lb){ ?>
											Produit : <strong><?php echo  $lb->med_sNc.' '.$lb->for_sLibelle.' '.$lb->med_iDosage.''.$lb->med_sUnite; ?></strong>
											<br>
											Quantité. : <strong><?php echo $lb->dcm_iQte; ?></strong>
										
											<hr>
										<?php }?>
										
									</td>
									
								</tr>
							<?php } ?>
							</tbody>
						</table>
                    </div>
                </div>
            </div>
			
        </div>
		<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
    </div>
</section>

<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE D'ADMINISTRATION APP</h4>
            </div>
            <div class="modal-body text-center"> Bon de commande(s) enregistée(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
	
	
	
		
        var liste = document.querySelector('#tbody');
        var addBonCmd = document.querySelector('#addBonCmd');
        var annuaire;
        annuaire = new Array();

        function removeCmd(index) {
            annuaire.splice(index,1);
            showListe();	
        }

        function addDetail() 
        {
            var qte 	        = document.getElementById('qte').value;
            var lib 	        = document.getElementById('lib').value;
           
            if(qte == '' || lib == '') {
                alert('Veuillez renseigner les champs obligatoires !');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                contact.qte	        = qte;
                annuaire.push(contact);
                showListe();	
				document.getElementById('qte').value="";
            }
        }

        addBonCmd.addEventListener('click', addDetail);

        function showListe() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            

            for(var i = 0; i < tailleTableau; i++) {
				var tab = annuaire[i].lib.split("-/-");
				
                contenu += '<tr>';
                contenu += '<td><input type="hidden" name="lib[]" value="'+ tab[0]+'"/>' + tab[1] + '</td>';
				contenu += '<td class="text-right"><input type="hidden" name="qte[]" value="'+ annuaire[i].qte+'"/>' + annuaire[i].qte + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeCmd(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';

            }

            liste.innerHTML = contenu;

        }
    
        </script>


<?php include("includes/footer.php"); ?>