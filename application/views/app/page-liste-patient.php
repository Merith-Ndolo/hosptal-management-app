<?php include("includes/header.php"); ?>
<?php 
	$articleParPage = 12;
	
	/* tout le monde */
	$articleTotaux  = count($this->md_patient->nb_patients());
	$pagesTotales = ceil($articleTotaux/$articleParPage);
	if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pagesTotales){
		$_GET['page'] = intval($_GET['page']);
		$pageActuelle = $_GET['page'];
	}else{
		$pageActuelle = 1;
	}
	
	$liste = $this->md_patient->liste_patients($articleParPage,$pageActuelle);
	
	
	
	// var_dump($pms);
 ?>

<section class="content patients" style="min-height:590px">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Liste des Patients (<?php echo $articleTotaux;?>)</h2>
            <small class="text-muted">Médicalis, votre application de gestion hospitalière</small>
        </div>
        <div class="row clearfix">
		<?php foreach($liste AS $l){ ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card all-patients">
                    <div class="body">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 text-center m-b-0">
                                <a href="#" class="p-profile-pix"><img src="<?php echo base_url($l->pat_sAvatar); ?>" alt="user" class="img-thumbnail img-fluid"></a>
                            </div>
                            <div class="col-md-8 col-sm-8 m-b-0">
                                <h5 class="m-b-0"><a href="<?php echo site_url("patient/voir/".$l->pat_id); ?>"><?php echo $l->pat_sNom; ?> <?php echo $l->pat_sPrenom; ?> (<?php $ageAnnee= $this->md_config->ageAnnee($l->pat_dDateNaiss); if($ageAnnee>1){echo $ageAnnee." ans";}else if($ageAnnee ==1){echo $ageAnnee." an";}else{echo $this->md_config->ageMois($l->pat_dDateNaiss)." mois";} ?> )</a> <a onclick="return confirm('Confirmez-vous la suppression de ce patient ?');" href="<?php echo site_url("patient/supprimer_patient/".$l->pat_id);?>" class="edit"><i class="zmdi zmdi-delete text-danger"></i></a> <a href="<?php echo site_url("patient/modifier/".$l->pat_id); ?>" class="edit" title="Modifier"><i class="zmdi zmdi-edit"></i>&nbsp;&nbsp;</a> <a href="<?php echo site_url("patient/voir/".$l->pat_id); ?>" class="edit" title="Voir détails"><i class="fa fa-eye text-success"></i>&nbsp;&nbsp;</a> </h5> 
								<a href="<?php echo site_url("patient/accueil/".$l->pat_id); ?>" class="btn bg-blue-grey waves-effect btn-sm" style="color:#fff">Faire l'acte médical</a>

                                <address class="m-b-0">
									<i class="fa fa-home"></i> : <?php if(!is_null($l->pat_sAdresse)){echo $l->pat_sAdresse;}else{echo "<i>Non renseignée</i>";} ?><br>
									<i class="fa fa-phone"></i>: <?php if(!is_null($l->pat_sTel)){echo $l->pat_sTel;}else{echo "<i>Non renseigné</i>";} ?><br>
									<abbr title="Numéro matricule patient">#: <?php echo $l->pat_sMatricule; ?></abbr>
							   </address>               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
		<?php if($articleTotaux >$articleParPage){ ?>
		<div class="row clearfix">
			<div class="col-sm-12 text-center">
				<ul class="pagination">
					<?php
						for($i=1;$i<=$pagesTotales;$i++){
							if($i==$pageActuelle){
					?>
					<li class="page-item active"><a class="page-link" href="javascript:();"><?=$i?></a></li>
					<?php }else{  ?>
					 <li class="page-item"><a class="page-link" href="<?php echo site_url("patient/liste");?>/?page=<?=$i?>"><?=$i?></a></li>
					<?php } } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
    </div>
</section>

<?php include("includes/footer.php"); ?>