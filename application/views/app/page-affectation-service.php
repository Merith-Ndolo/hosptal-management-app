
<?php 
	include("includes/header.php"); 
	$services = $this->md_parametre->liste_services_direction_actifs($direction); 
	$recup = $this->md_parametre->recup_direction($direction); 
?>
<section class="content home" style="min-height:550px">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Gestion des affectations / Choisissez le service</h2>
            <small class="text-muted">-> <?php echo $recup->dep_sLibelle; ?></small>
        </div>
        
        <div class="row clearfix">
		<?php foreach($services AS $d){ $nombre = count($this->md_parametre->liste_unite_services_actifs($d->ser_id)); ?>
            <div class="col-lg-11 col-md-11 col-sm-11">
                <div class="info-box-4 hover-zoom-effect">
                    <?php if($nombre>=1){ ?><div class="icon"><a href="<?php echo site_url("personnel/unite/".$d->ser_id);?>"><i class="fa fa-arrow-right col-blue-grey"></i><br>Cliquez ici</a></div><?php } ?>
                    <div class="content">
                        <div class="text" style="font-size:16px"><?php echo $d->ser_sLibelle; ?></div>
                        <div class="number" style="font-size:14px">
							<?php 
								if($nombre==0){
									echo "<i class='text-danger'>Il n'y a aucune unité dans ce service</i>";
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