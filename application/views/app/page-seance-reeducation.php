
<?php include("includes/header.php"); ?>
<?php $assigne = $this->md_patient->detail_patient_reeducation($id); ?>
<?php $prescripteur = $this->md_patient->medecin_prescripteur_reeducation($assigne->sea_id); ?>
<?php $listeSeance = $this->md_patient->liste_seance_reeducation($id); ?>

<section class="content profile-page">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Réeduction - pointage de séance</h2>
            <small class="text-muted" style="text-transform:uppercase"></small>
        </div>        
        <div class="row clearfix">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class=" card patient-profile">
                    <img src="<?php echo base_url($assigne->pat_sAvatar);?>" class="img-fluid" alt="">                              
                </div>
				 <?php //var_dump($listeSeance); ?>
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
            <div class="col-lg-9 col-md-12 col-sm-12">
				<div class="card">
					 <div class="body"> 
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-12">
								<strong>Réeduction</strong>
								<p><?php echo $assigne->lac_sLibelle;?></p>	
					
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12">
								<strong>Date prescription</strong>
								<p><?php echo $this->md_config->affDateFrNum($assigne->ree_dDate);?></p>
							</div>							
							<div class="col-lg-3 col-md-3 col-sm-12">
								<strong>Seances restantes</strong>
								<p id="nb"><?php echo $assigne->ree_iNombre;?></p>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12">
								<?php if($prescripteur){?>
								<strong>Médécin prinscripteur</strong>
								<p><?php echo $prescripteur->per_sTitre.' '.$prescripteur->per_sPrenom.' '.$prescripteur->per_sNom;?></p>
								<p><img src="<?php echo base_url($prescripteur->per_sAvatar);?>" class="img-fluid" width="100" alt="">  </p>	
								
								<?php } ?>
							</div>
							
							
							<div class="col-lg-12 col-md-12 col-sm-12">
									<table class="table table-bordered table-striped table-hover">
									<?php if($assigne->ree_iNombre != 0){?>
										<thead>
											<tr>
												<th style="">Jour </th>
												<th style="">Heure début </th>
												<th style="">Heure fin </th>
												<th colspan="2" style="">Observation </th>
											</tr>
											
										</thead>
									  <?php }?>
										<tbody id="tbodyRee">
											<?php if(empty($listeSeance)){echo '<tr><td colspan="5"><em>Aucune réeducation disponible</em></td></tr>';}else{ foreach($listeSeance AS $ls){ ?>
											<tr>
												<td>
													<?php echo $this->md_config->affDateFrNum($ls->sre_dJour);?>
												</td>									
												<td>
													<?php echo $ls->sre_tHeureDebut ;?>
												</td>									
												<td>
													<?php echo $ls->sre_tHeureFin ;?>
												</td>
												<td  colspan="2">
													<?php echo $ls->sre_sObservation ;?>
												</td>		
											</tr>
											<?php } } ?>
											<tr>
												<td colspan="4">
													<h3 id="echeance"></h3>
												</td>										
											</tr>
										</tbody>
									</table>
									<div class="">
									<?php if($assigne->ree_iNombre != 0){?>
										<form id="form-reeducation">
											<table class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th style="">Jour *</th>
														<th style="">Heure début *</th>
														<th style="">Heure fin *</th>
													</tr>
													<tr>
														<td>
															<input style="width:100%" type="text" id="jour" name="jour" class="datepicker obligatoire"/>
														</td>									
														<td>
															<input style="width:100%" type="time"  class="obligatoire" id="hd" name="hd"/>
														</td>			
														<td>
															<input style="width:100%" type="time" id="hf"  class="obligatoire" name="hf"/>
															<input type="hidden" id="idSession" name="idSession" value="<?php echo $this->session->medicalis;?>"/>
															<input type="hidden" id="idReeducation" name="idReeducation" value="<?php echo $id;?>"/>
														</td>			
													</tr>													
													<tr>		
														<th colspan="3">
															<label><strong style="color:#000">Observation *</strong></label>
															<textarea style="width:100%"  id="edit" name="observation"></textarea>
														</th>										
													</tr>																										
													<tr>									
														<td colspan="3"><div class="retour-reeducation"></div></td>
													</tr>
												</thead>
											</table>
											<a href="javascript:();" class="btn btn-success waves-effect pull-right " id="addReed" style="color:#fff"><i class="fa fa-check"></i>Valider</a>
										</form>
										<?php }else{echo "<script>location.href=listeSeance</script>";}?>
									
									</div>
							</div>
						</div>
				</div>
            </div>
        </div>
    </div>
</section>




<?php include("includes/footer.php"); ?>