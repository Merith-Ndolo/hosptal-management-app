
<?php include("includes/header.php"); ?>
<?php $patient = $this->md_patient->recup_patient($id); ?>
<?php $ante = $this->md_patient->liste_antecedant($id); ?>
<?php $liste = $this->md_patient->liste_contacts($id); ?>

<section class="content profile-page">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Informations sur le patient</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>        
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class=" card patient-profile">
                    <img src="<?php echo base_url($patient->pat_sAvatar);?>" class="img-fluid" alt="">                              
                </div>
                <div class="card">
                    <div class="header">
                        <h2>À PROPOS DU PATIENT</h2>
                    </div>
                    <div class="body">
                        <strong>Code patient</strong>
                        <p><?php echo $patient->pat_sMatricule;?></p>
						<strong>Nom(s) et prénom(s)</strong>
                        <p><?php echo $patient->pat_sCivilite;?> <?php echo $patient->pat_sNom;?> <?php echo $patient->pat_sPrenom;?></p>
                        <strong>Âge</strong>
                        <p><?php $ageAnnee= $this->md_config->ageAnnee($patient->pat_dDateNaiss); if($ageAnnee>1){echo $ageAnnee." ans";}else if($ageAnnee ==1){echo $ageAnnee." an";}else{echo $this->md_config->ageMois($patient->pat_dDateNaiss)." mois";} ?></p>
						<strong>Genre</strong>
                        <p><?php if($patient->pat_sSexe=="H"){echo "Homme";}else{echo "Femme";}?></p>
						<strong>Profession</strong>
                        <p><?php echo $patient->pat_sProfession;?></p>
                        <strong>Situation familiale</strong>
                        <p><?php echo $patient->pat_sSituationMat	;?></p>
						<?php if(!is_null($patient->pat_sTel)){?>
                        <strong>Téléphone</strong>
                        <p><?php echo $patient->pat_sTel;?></p>
						<?php } ?>
						<?php if(!is_null($patient->pat_sAdresse)){?>
                        <strong>Adresse</strong>
                        <address><?php echo $patient->pat_sAdresse;?></address>
						<?php } ?>
						 <hr>
						<strong>Date d'enregistrement</strong>
                        <p><?php echo $this->md_config->affDateTimeFr($patient->pat_dDateEnreg);?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body"> 
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active"data-toggle="tab"  href="#report">Détail et activité sur le patient</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#timeline">Timeline</a></li>
                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane in active" id="report">                               
                            <div class="wrap-reset">
                                <div class="mypost-list">
                                    <div class="post-box">
										<h4>Antécédent médical ou maladie héréditaire</h4>
										 <ul class="dis">
											<?php foreach($ante AS $a){ ?>
											<li><?php if($a->ant_sAntecedent=="Non"){echo "Non";}else{echo $a->ant_sALibelle;} ?></li>
											<?php } ?>
										</ul>
                                     
                                    </div>
                                    <hr>
                                    <div class="post-box">
                                        <h4>Personnes à contacter en cas d'urgence</h4>                                        
                                        <div class="body p-l-0 p-r-0">
											<?php if(empty($liste)){echo "Non renseigné";}else{ ?>
                                            <div class="table-responsive"> 
												<table class="table table-bordered table-striped table-hover">
												   
													<thead>
														<tr>
															<th>Nom(s) et prénom(s)</th>
															<th>Lien de parenté</th>
															<th>Numéro de téléphone</th>
															<th>Adresse</th>
														</tr>
													</thead>
												   
													<tbody>
													<?php foreach($liste AS $l){ ?>
														<tr>
															<td>
																<?php echo $l->pec_sNom; ?> <?php echo $l->pec_sPrenom; ?>
															</td>
															<td>
																<?php echo $l->pec_sLien; ?>
															</td>
															<td>
																<?php echo $l->pec_sTelephone; ?>
															</td>
															<td>
																<?php echo $l->pec_sAdresse; ?>
															</td>
															
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</div>
											<?php } ?>
                                        </div>
                                    </div>
									<hr>
                                    <div class="post-box">
                                        <h4>General Report</h4>                                        
                                        <div class="body p-l-0 p-r-0">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <div>Blood Pressure</div>
                                                    <div class="progress m-b-20">
                                                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>Heart Beat</div>
                                                    <div class="progress  m-b-20">
                                                        <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>Haemoglobin</div>
                                                    <div class="progress  m-b-20">
                                                        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>Sugar</div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Education</h4>
                                    <ul class="dis">
                                        <li>B.Com from Ski University</li>
                                        <li>In hac habitasse platea dictumst.</li>
                                        <li>In hac habitasse platea dictumst.</li>
                                        <li>Vivamus elementum semper nisi.</li>
                                        <li>Praesent ac sem eget est egestas volutpat.</li>
                                    </ul>
                                    <hr>
                                    <h4>Past Visit History</h4>
                                    <ul class="dis">
                                        <li>Integer tincidunt.</li>
                                        <li>Praesent vestibulum dapibus nibh.</li>
                                        <li>Integer tincidunt.</li>
                                        <li>Praesent vestibulum dapibus nibh.</li>
                                        <li>Integer tincidunt.</li>
                                        <li>Praesent vestibulum dapibus nibh.</li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="timeline">
                                <div class="timeline-body">
                                    <div class="timeline m-border">
                                        <div class="timeline-item">
                                            <div class="item-content">
                                                <div class="text-small">Just now</div>
                                                <p>Discharge.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small">11:30</div>
                                                <p>Routine Checkup</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-warning border-l">
                                            <div class="item-content">
                                                <div class="text-small">10:30</div>
                                                <p>Operation </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-warning">
                                            <div class="item-content">
                                                <div class="text-small">3 days ago</div>
                                                <p>Routine Checkup</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-danger">
                                            <div class="item-content">
                                                <div class="text--muted">Thu, 10 Mar</div>
                                                <p>Routine Checkup</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small">Sat, 5 Mar</div>
                                                <p>Routine Checkup</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-danger">
                                            <div class="item-content">
                                                <div class="text-small">Sun, 11 Feb</div>
                                                <p>Blood checkup test</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small">Thu, 17 Jan</div>
                                                <p>Admit patient ward no. 21</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include("includes/footer.php"); ?>