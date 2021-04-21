<?php 
	include("includes/header.php"); 
	$f = $this->md_pharmacie->recup_produit($med_id);
	$ach = $this->md_pharmacie->somme_produit($f->med_id);
	$listeCat = $this->md_pharmacie->cat_produit_courant($f->cat_id);
	$listeFam = $this->md_pharmacie->fam_produit_courant($f->fam_id);
	$listeFor = $this->md_pharmacie->for_produit_courant($f->for_id);
?>

<section class="content profile-page">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Les détails du produit</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class=" card patient-profile">
							<h3><span style="text-decoration:underline">à propos du produit</span>: <?php echo $f->med_sNc;?></h3>					
						</div>
					</div>					
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class=" card patient-profile">
							<img src="" class="img-fluid" alt="">    
						</div>
					</div>
				</div>
                        
                 
                <div class="card">

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="body">
								<strong>Nom commercial</strong>
								<p><?php echo $f->med_sNc;?></p>                        
								<strong>Nom scientifique</strong>
								<p><?php echo $f->med_sNs;?></p>
								<strong>Quantité en stock</strong>
								<p><?php echo $ach->somme;?></p>
								<strong>Seuil d'alerte</strong>
								<p><?php echo $ach->ach_iSeuil;?></p>
							</div>     
						</div>     
						<div class="col-lg-4 col-md-4 col-sm-12">					
							<div class="body">
								<strong>Catégorie</strong>
								<p><?php echo $listeCat->cat_sLibelle;?></p>                        
								<strong>Famille</strong>
								<p><?php echo $listeFam->fam_sLibelle;?></p>
								<strong>Forme</strong>
								<p><?php echo $listeFor->for_sLibelle;?></p>								
								<strong>Date d'achat</strong>
								<p><?php echo $this->md_config->affDateFrNum($ach->ach_dDateAchat);?></p>
							</div>
						</div>						
						<div class="col-lg-4 col-md-4 col-sm-12">					
							<div class="body">
								<strong>Prix d'achat</strong>
								<p><?php echo $ach->ach_iPrixAchat;?></p>								
								<strong>Prix de vente</strong>
								<p><?php echo $ach->ach_iPrixVente;?></p>			
								<strong>Date d'expiration</strong>
								<p><?php echo $this->md_config->affDateFrNum($ach->ach_dDateExpir);?></p>
								<strong>Dosage</strong>
								<p><?php echo $f->med_iDosage.$f->med_sUnite;?></p>                        
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
	
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DES RESSOURCES HUMAINES</h4>
            </div>
            <div class="modal-body text-center"> Employé ajouté avec succès <br><img src="<?php echo base_url("assets/images/icons8-attendance-50.png");?>"/></div>
            <div id="refresh"></div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>