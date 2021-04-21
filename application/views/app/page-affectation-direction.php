
<?php include("includes/header.php"); $directions = $this->md_parametre->liste_departements_actifs(); ?>
<section class="content home" style="min-height:550px">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Gestion des affectations / Choisissez la direction</h2>
            <small class="text-muted">Affecter les employés dans les unités données</small>
        </div>
        
        <div class="row clearfix">
		<?php foreach($directions AS $d){ $nombre = count($this->md_personnel->personnel_par_direction($d->dep_id)); ?>
            <div class="col-lg-11 col-md-11 col-sm-11">
                <div class="info-box-4 hover-zoom-effect">
                    <?php if($nombre>=1){ ?><div class="icon"><a href="<?php echo site_url("personnel/service/".$d->dep_id);?>"><i class="fa fa-arrow-right col-blue-grey"></i><br>Cliquez ici</a></div><?php } ?>
                    <div class="content">
                        <div class="text" style="font-size:16px"><?php echo $d->dep_sLibelle; ?></div>
                        <div class="number" style="font-size:14px">
							<?php 
								if($nombre>1){
									echo "<b>".$nombre." employés enregistrés</b>";
								}
								else if($nombre==1){
									echo "<b>".$nombre." employé enregistré</b>";
								}
								else{
									echo "<i class='text-danger'>Il n'y a aucun employé recruté dans cette direction</i>";
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