
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_pharmacie->liste_entrees(); ?>
<?php $listeFour = $this->md_pharmacie->liste_fournisseur_actifs(); ?>
<?php $listeSalle = $this->md_pharmacie->liste_salle_pharmacie_actifs(); ?>
<?php $listeCat = $this->md_parametre->liste_categorie_produit_actifs(); ?>
<?php $listeFor = $this->md_parametre->liste_forme_produit_actifs(); ?>
<?php $seuil = $this->md_pharmacie->detecte_seuil(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">Inventaire </h2>
                    </div>
					
					
					<?php
						//$this->md_config->genereCodeBarre("PHR","pharmacie","doliprane");
					?>
					
					
                    <div class="body table-responsive"> 
					<div class="text-center" style="color:red"> <?php if(count($seuil)==1){echo count($seuil).' produit est en alerte de stock';}elseif(count($seuil)>1){echo count($seuil).' produits sont en alerte de stock';}; ?> </div>
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Produit</th>
									<th>Salle</th>
									<th>Armoire</th>
									<th>Cellule</th>
									<th>Prix vente</th>
									<th>Quantité</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
							<?php  //var_dump($liste)?>
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td class="pro<?=$l->ach_id;?>"><span style="<?php if($l->ach_iQte <= $l->ach_iSeuil){echo 'color:red;text-decoration:underline';}?>"><?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?></span></td>
									<td class="sal<?=$l->ach_id;?>"><?=$l->sal_sLibelle;?></td>
									<td class="arm<?=$l->ach_id;?>"><?=$l->arm_sLibelle;?></td>
									<td class="cel<?=$l->ach_id;?>"><?=$l->cel_sLibelle;?></td>
									<td class="ve<?=$l->ach_id;?>"><?=number_format($l->ach_iPrixVente,2,",",".");?> Fcfa</td>
									<td class="qte<?=$l->ach_id;?>"><span style="<?php if($l->ach_iQte <= $l->ach_iSeuil){echo 'color:red;';}?>"><?=$l->ach_iQte;?></span></td>
									<td class="text-center">
										<a href="javascript:();" rel="<?=$l->ach_id;?>-/-<?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>-/-<?=$l->ach_iPrixVente;?>" class="delete ajout_stock" title="Nouvelles entrées du produit en stock"><i class="fa fa-sign-in text-primary" style="font-size:20px"></i></a>&nbsp;&nbsp;
										<a href="javascript:();" rel="<?=$l->ach_id;?>-/-<?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>" class="delete list_stock" title="L'historique des entrées"><i class="fa fa-list text-warning" style="font-size:20px"></i></a>&nbsp;&nbsp;
										<a href="javascript:();" id="rel" rel="<?=$l->ach_id;?>-/-<?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>-/-<?=$l->sal_id;?>-/-<?=$l->arm_id;?>-/-<?=$l->cel_id;?>-/-<?=$l->ach_iPrixVente;?>-/-<?=$l->ach_iSeuil;?>"class="delete modif_stock" title="modifier"><i class="fa fa-edit text-success" style="font-size:20px"></i></a>&nbsp;&nbsp;
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


<div class="modal fade" id="largeModalStock" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" id="large" style="margin-top:20px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:500px; overflow:auto;">
				<div class="col-lg-12 col-md-12 col-sm-12 cacher" id="ajout">
					<div class="card">
						<div class="header">
							<h2>Nouvelle entrée du produit : <b><span id="produit"></span><small></b>renseignez tous les champs marqués par des (*)</small> </h2>
						</div>
						<div class="body">
							<form id="form-stock">
								<div class="row clearfix">
									<div class="col-sm-12 retour-ajout"></div>							
									<div class="col-sm-12">
										<div class="form-group drop-custum">
											<select name="four" id="four" class="form-control obligatoire">
												<option value="">------------------------- Sélectionnez le fournisseur * -------------------------</option>
												<?php  foreach( $listeFour  AS $fours ){ ?>
												<option value="<?php echo $fours->frs_id;?>"><?php echo $fours->frs_sEnseigne;?></option>
												<?php }; ?>
											</select>
										</div>
									</div>																																												
									<div class="col-sm-6">
										<div class="form-group">
											<label>Quantité *</label>
											<div class="form-line">
												<input type="number" min="0" name="qte" value="" class="form-control obligatoire">
											</div>
										</div>
									</div>	
									<div class="col-sm-6">
										<div class="form-group">
											<label>Prix d'achat *</label>
											<div class="form-line">
												<input type="number" min="1" name="pa" class="form-control obligatoire pa">
											</div>
										</div>
									</div>																
																								
									<div class="col-sm-6">
										<div class="form-group">
											<label>Date d'achat </label>
											<div class="form-line">
												<input type="text" name="da" value="" class="form-control obligatoire datepicker">
											</div>
										</div>
									</div>																
									<div class="col-sm-6">
										<div class="form-group">
											<label>Date d'expiration *</label>
											<div class="form-line">
												<input type="text" name="de" value="" class="form-control obligatoire datepicker">
												<input type="hidden" name="id" id="id">
												<input type="hidden" name="pv" id="vente">
											</div>
										</div>
									</div>
								</div>														
								
							</form>
						</div>
					</div>
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 cacher" id="detail">
				
							<div class="card">
								<div class="header">
									<h2>L'historique des entrées du produit : <b><span id="detailListe"></span></b></h2>
								</div>
							<div id="tbody"> 
								
							</div>
					</div>
				
				</div>				
				
				<div class="col-lg-12 col-md-12 col-sm-12 cacher" id="modifier">
				
					<div class="card">
						<div class="header">
							<h2>Modification sur le stockage du produit : <b><span id="modif"></span></b></h2>
						</div>
						<div class="body">
							
							<form id="form-edit-entree-stock">
								<div class="row clearfix">
									<div class="col-sm-12 retour-modif"></div>		
									
									<div class="col-sm-4">
										<div class="form-group drop-custum">
											<select name="salle" id="salle" class="form-control obligatoire">
												
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group drop-custum">
											<select name="armoire" id="armoire" class="form-control obligatoire">
											</select>
										</div>
									</div>																
									<div class="col-sm-4">
										<div class="form-group drop-custum">
											<input type="hidden" name="id" id="idAch">
											<select name="cellule" id="cellule" class="form-control obligatoire">
												
											</select>
										</div>
									</div>														
									<div class="col-sm-6">
										<div class="form-group">
											<label>Prix de vente *</label>
											<div class="form-line">
												<input type="number" min="1" name="pv" id="pv" class="form-control obligatoire pv">
											</div>
										</div>
									</div>																															
									<div class="col-sm-6">
										<div class="form-group">
											<label>Seuil d'alerte sur la quantité * </label>
											<div class="form-line">
												<input type="number" min="0" name="seuil" id="seuil"  class="form-control obligatoire">
											</div>
										</div>
									</div>																
									
								</div>														
								
							</form>
						</div>
				
					</div>
				</div>
			
			</div>
            <div class="modal-footer">
                <a href="javascript:();" class="btn btn-success waves-effect cacher addStock" id="btn-ajout" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
                <a href="javascript:();" class="btn btn-success waves-effect cacher editStock" id="btn-edit" style="color:#fff"><i class="fa fa-check"></i> Modifier</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>



<?php include("includes/footer.php"); ?>