
<?php include("includes/header.php"); ?>
<?php $assigne = $this->md_patient->patient_imagerie($aef_id); ?>
<?php $prescripteur = $this->md_patient->medecin_prescripteur_exploration($assigne->sea_id); ?>

<section class="content profile-page">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Exploration fonctionnelle</h2>
            <small class="text-muted" style="text-transform:uppercase"></small>
        </div>        
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class=" card patient-profile">
                    <img src="<?php echo base_url($assigne->pat_sAvatar);?>" class="img-fluid" alt="">                              
                </div>
				<?php //var_dump($prescripteur); ?>
               <div class="card">
                    <div class="header">
                        <h2>À PROPOS DU PATIENT</h2>
                    </div>
                    <div class="body">
                        <strong>Code patient</strong>
                        <p><?php echo $assigne->pat_sMatricule;?></p>
						<strong>Nom(s) et prénom(s)</strong>
                        <p><?php echo $assigne->pat_sCivilite;?> <?php echo $assigne->pat_sNom;?> <?php echo $assigne->pat_sPrenom;?></p>
                        <strong>Âge</strong>
                        <p><?php $ageAnnee= $this->md_config->ageAnnee($assigne->pat_dDateNaiss); if($ageAnnee>1){echo $ageAnnee." ans";}else if($ageAnnee ==1){echo $ageAnnee." an";}else{echo $this->md_config->ageMois($assigne->pat_dDateNaiss)." mois";} ?></p>
						<strong>Genre</strong>
                        <p><?php if($assigne->pat_sSexe=="H"){echo "Homme";}else{echo "Femme";}?></p>
						<strong>Profession</strong>
                        <p><?php echo $assigne->pat_sProfession;?></p>
                        <strong>Situation familiale</strong>
                        <p><?php echo $assigne->pat_sSituationMat	;?></p>
						<?php if(!is_null($assigne->pat_sTel)){?>
                        <strong>Téléphone</strong>
                        <p><?php echo $assigne->pat_sTel;?></p>
						<?php } ?>
						<?php if(!is_null($assigne->pat_sAdresse)){?>
                        <strong>Adresse</strong>
                        <address><?php echo $assigne->pat_sAdresse;?></address>
						<?php } ?>
						 <hr>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
				<div class="card">
					 <div class="body"> 
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12">
								<strong>Acte médical</strong>
								<p><?php echo $assigne->lac_sLibelle;?></p>	
								
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<strong>Date prescription</strong>
								<p><?php echo $this->md_config->affDateTimeFr($assigne->img_dDate);?></p>
								
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<?php if($prescripteur){?>
								<strong>Médécin prinscripteur</strong>
								<p><?php echo $prescripteur->per_sTitre.' '.$prescripteur->per_sPrenom.' '.$prescripteur->per_sNom;?></p>
								<p><img src="<?php echo base_url($prescripteur->per_sAvatar);?>" class="img-fluid" width="100" alt="">  </p>	
								
								<?php } ?>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12">
								<?php if(!is_null($assigne->img_sDescription)){?>
								<strong>Indication</strong>
								<address><?php echo nl2br($assigne->img_sDescription);?></address>
								<?php } ?>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<form id="form-exploration">
									<br><br>
									<strong>Compte rendu <span id="compte"></span></strong><br><br>
									<textarea id='edit' name="compte" rows="2"></textarea><br>
									<div class="form-group retour-avatar"></div>
									<div class="fallback">
										<strong>Enregistrement image <span id="image"></span></strong><br><br>
										<input type="file" name="image" style="width:400px"><br><br>
									</div>
									
									<input type="hidden" value="<?php echo $aef_id; ?>" name="id"/>
									<input type="hidden" value="<?php echo $this->session->medicalis;?>" name="idPer"/>
								</form>
								
								<br>
								<a href="javascript:();" onclick="return confirm('Confirmez la validation des résultats des examens ?');" style="color:#fff" class="btn btn-success effectuerExp">Acte effecté</a>
							</div>
						</div>
				</div>
            </div>
        </div>
    </div>
</section>




<?php include("includes/footer.php"); ?>