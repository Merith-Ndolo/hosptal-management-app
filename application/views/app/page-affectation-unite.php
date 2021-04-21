
<?php 
	include("includes/header.php"); 
	$unites = $this->md_parametre->liste_unite_services_actifs($service); 
	$recup = $this->md_parametre->recup_service($service); 
?>
<section class="content home" style="min-height:550px">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Gestion des affectations / Choisissez l'unité</h2>
			<small class="text-muted">-> <?php echo $recup->dep_sLibelle; ?> -> <?php echo $recup->ser_sLibelle; ?></small>
        </div>
        
        <div class="row clearfix">
		<?php foreach($unites AS $d){ $nombre = count($this->md_personnel->liste_affectation_personnel_unite($d->uni_id)); ?>
            <div class="col-lg-11 col-md-11 col-sm-11">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="<?php echo site_url("personnel/affectation/".$d->uni_id);?>"><i class="fa fa-arrow-down col-blue-grey"></i><br>Cliquez ici</a></div>
                    <div class="content">
                        <div class="text" style="font-size:16px"><?php echo $d->uni_sLibelle; ?></div>
                        <div class="number" style="font-size:14px">
							<?php 
								if($nombre>1){
									echo "<b>".$nombre." employés y sont affectés</b>";
								}
								else if($nombre==1){
									echo "<b>".$nombre." employé y est affecté</b>";
								}
								else{
									echo "<i class='text-danger'>Il n'y a aucun employé dans cette unité</i>";
								}
							?>
						</div>
                    </div>
                </div>
            </div>            
		<?php } ?>
        </div>
        
	</div>

</section>
<?php include("includes/footer.php"); ?>