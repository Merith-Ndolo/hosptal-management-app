
<?php include("includes/header.php"); ?>
<?php $assigne = $this->md_patient->detail_patient_assigne($soi_id); ?>
<?php $hos = $this->md_patient->hospitalisation($assigne->hos_id); ?>
<?php $prescripteur = $this->md_patient->medecin_prescripteur($assigne->sea_id); ?>

<section class="content profile-page">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Infirmerie - Protocole de soin pour hospitalisation</h2>
            <small class="text-muted" style="text-transform:uppercas"><i class="fa fa-calendar"></i> <?php echo $this->md_config->affDateTimeFr($hos->hos_dDate);?> - Pour <?php if($hos->hos_iDuree > 1){echo $hos->hos_iDuree." jours";}else{echo $hos->hos_iDuree." jour";}?></small><br>
			<small class="text-muted" style="text-transform:uppercas">
				<div class="row clearfix">
					<div class="col-lg-3 col-md-12 col-sm-12">
						<i class="fa fa-bed"></i> au service <b><?php echo $hos->ser_sLibelle;?></b>
					</div>
					<div class="col-lg-3 col-md-12 col-sm-12">
						Dans l'unité <b><?php echo $hos->uni_sLibelle;?></b>
					</div>
					<div class="col-lg-3 col-md-12 col-sm-12">
						Chambre : <b><?php echo $hos->cha_sLibelle;?></b>, Lit : <b><?php echo $hos->lit_sLibelle;?></b>
					</div>
					<div class="col-lg-3 col-md-12 col-sm-12">
						Disposition : <b><?php if($hos->hos_sType != "Standard"){echo $hos->hos_sType;}else{echo "Rien à signaler";}?></b></b>
					</div>
				</div>
			</small>
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
								<strong>Acte de soin</strong>
								<p><?php echo $assigne->lac_sLibelle;?></p>	
								
								<strong>Heure début</strong>
								<p><?php echo $assigne->soi_tHeureDem;?></p>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<strong>Date prescription</strong>
								<p><?php echo $this->md_config->affDateTimeFr($assigne->soi_dDtatePres);?></p>
								
								<strong>Fréquence</strong>
								<p> Chaque <?php echo $assigne->soi_iFrequence;?>h</p>	
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<?php if($prescripteur){?>
								<strong>Médécin prinscripteur</strong>
								<p><?php echo $prescripteur->per_sTitre.' '.$prescripteur->per_sPrenom.' '.$prescripteur->per_sNom;?></p>
								<p><img src="<?php echo base_url($prescripteur->per_sAvatar);?>" class="img-fluid" width="100" alt="">  </p>	
								
								<?php } ?>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12">
								<?php if(!is_null($assigne->soi_sConsigne)){?>
								<strong>Consigne</strong>
								<address><?php echo nl2br($assigne->soi_sConsigne);?></address>
								<?php } ?>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<form id="form-infimier">
									<br><br>
									<strong>Obsevation</strong><br><br>
									<textarea id='edit' name="textarea" rows="2"></textarea><br>
									<input type="hidden" value="<?php echo $soi_id; ?>" name="id"/>
									<input type="hidden" value="<?php echo $this->session->medicalis;?>" name="idPer"/>
									<a href="javascript:();" onclick="return confirm('Confirmez la fin du traitement');" style="color:#fff" class="btn btn-success traiter">Valider</a>
								</form>
							</div>
						</div>
				</div>
            </div>
        </div>
    </div>
</section>




<?php include("includes/footer.php"); ?>