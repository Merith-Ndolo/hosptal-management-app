
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_laboratoire->liste_accessoire_enstock(); ?>
<?php $perime = $this->md_pharmacie->liste_produit_perimes(date("Y-m-d")); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
	
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Ensemble des accessoires en stock </h2>
						<?php //var_dump($liste); ?>
					</div>
                    <div class="body table-responsive"> 
						<form id="form-destockage">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Accessoire</th>
									<th>Quantité</th>
									<th>Seuil</th>
									<th>Statut</th>
									<th>Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<?=$l->acc_sLibelle;?>
									</td>										
									<td>
										<?=$l->sac_iQte;?>
									</td>									
									<td>
										<?=$l->sac_iSeuil;?>
									</td>									
									
									<td>
										<?php if($l->sac_iSeuil==$l->sac_iQte){echo '<b style="color:red">a atteint le seuil</b>';}elseif($l->sac_iSeuil > $l->sac_iQte){echo '<b style="color:red">en alerte de stock</b>';}elseif($l->sac_iQte==0){echo '<b style="color:red">en rupture de stock</b>';}else{echo '<b style="color:green">disponible</b>';};?>
									</td>
									<td>
										<i class="fa fa-arrow-right text-danger" style="font-size:20px"></i><a href="<?php echo site_url("laboratoire/sortir_accessoire/".$l->sac_id); ?>" class="" style="" title="sortir du stock"> Sortir</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- For Material Design Colors -->
<div class="modal fade" id="mdModalDestock" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title text-center" style="margin-left:150px" id="defaultModalLabel">PHARMACIE</h4>
            </div>
            <div class="modal-body text-center" style="color:red"> Cette action supprimera tous les produits périmés du stock, et vos prévisions de vente baisseront. <br>Voulez vous continuez ?  </div>
            <div class="modal-footer">
                <a href="<?php echo site_url("pharmacie/destockPerimes"); ?>" onClick="return confirm('Dernier avertissement, valider si oui');" class="btn btn-success waves-effect" style="color:#fff"><i class="fa fa-check"></i> OUI</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<!-- For Material Design Colors -->
<div class="modal fade" id="mdModalDestockVolontaire" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title text-center" style="" id="defaultModalLabel">PHARMACIE</h4>
				- <span id="nombre"></span>
            </div>
            <div class="modal-body"> 
				<p class=" text-center" style="color:red">Cette action supprimera tous les produits sélectionnés du stock, et vos prévisions de vente baisseront. <br>Voulez vous continuez ?  </p><br>
				<form id="form-motif">
					<textarea  style="width:100%"  name="motif" rows="4" placeholder="Décrire le motif de destockage ici"></textarea>
				</form>
			</div>
            <div class="modal-footer">
                <a href="javascript:();" onClick="return confirm('Dernier avertissement, valider si oui');" class="btn btn-success waves-effect destockPerime" style="color:#fff"><i class="fa fa-check"></i> OUI</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeFam = document.querySelector('#tbody');
        var addFam = document.querySelector('#addFam');
        var annuaire;
        annuaire = new Array();

        function removeCat(index) {
            annuaire.splice(index,1);
            showListeFam();	
        }

        function addDetailFam() 
        {
            var lib 	            = document.getElementById('lib').value;
            if(lib == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                annuaire.push(contact);
                showListeFam();	
				document.getElementById('lib').value="";
            }
        }

        addFam.addEventListener('click', addDetailFam);

        function showListeFam() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
                contenu += '<tr>';
                contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeCat(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeFam.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>