
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_pharmacie->liste_entrees_code(); ?>
<?php $perime = $this->md_pharmacie->liste_produit_perimes(date("Y-m-d")); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
	
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Ensemble des produits contenu en stock <a id="destock" href="javascript:();" class="btn bg-blue-grey waves-effect volontaire pull-right cacher" style="color:#fff"><i class="fa fa-remove"></i> <b>Destocker</b></a></h2>
                    </div>
                    <div class="body table-responsive"> 
						<div class="text-center" style="color:red"> <?php if($perime){ if(count($perime)==1){echo count($perime).' produit est devenu prérimé';}elseif(count($perime)>1){echo count($perime).' produits sont maintenant périmés';} echo ' <a href="javascript:();" class="btn bg-blue-grey btn-sm waves-effect destock" style="color:#fff">Destocker</a>';} ?> </div>
						<form id="form-destockage">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>selection</th>
									<th>Produit</th>
									<th>Prix de vente</th>
									<th>Date d'expiration</th>
									<th>Numéro code à barre</th>
									<th>Image code à barre</th>
									<th>Statut</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<input type="hidden" name="ach[]" value="<?php echo $l->ach_id; ?>"/>
										<div class="switch">
											<label>
												<input type="checkbox" class="checkProduit" name="id[]" value="<?php echo $l->pro_id; ?>">
												<span class="lever"></span>
											</label>
										</div>
									</td>
									<td>
										<?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>
									</td>
									<td>
										<?=number_format($l->ach_iPrixVente,2,",",".");?> Fcfa
									</td>									
									<td>
										<?=$this->md_config->affDateFrNum($l->pro_dDateExpir);?>
									</td>
									<td>
										<?=$l->pro_sCodeBarre;?>
									</td>
									<td class="text-center">
										<a title="télécharger" href="<?php echo base_url($l->pro_sImage);?>" download="<?php echo $l->pro_sImage;?>"><img src="<?php echo base_url($l->pro_sImage);?>" width="120"/></a>
									</td>
									<td class="text-center">
										<?php $verif = $this->md_pharmacie->produit_perime(date("Y-m-d"),$l->pro_id); if($verif){echo '<b style="color:red">Périmé</b>';}else{echo '<b style="color:green">En bonne état</b>';} ?>
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