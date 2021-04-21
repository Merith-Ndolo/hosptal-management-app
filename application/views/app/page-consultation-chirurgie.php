
<?php include("includes/header.php"); ?>
<?php $acm = $this->md_patient->acm_patient($acm_id); ?>
<?php $patient = $this->md_patient->recup_patient($acm->pat_id); ?>
<?php $ante = $this->md_patient->liste_antecedant($acm->pat_id); ?>
<?php $constante = $this->md_patient->constante($acm_id); ?>
<?php $ListeConst = $this->md_patient->liste_constante($acm_id); ?>
<?php $consultation = $this->md_patient->consultation($acm_id); ?>
<?php $liste = $this->md_patient-> sejour_acm($acm_id); ?>
<?php $listeMed = $this->md_pharmacie->liste_medicament(); ?>
<?php $listeUnite = $this->md_parametre->liste_unites_actifs(); ?>
<?php $listeMaladie = $this->md_patient->liste_maladie_actifs(); ?>
<?php $listeActeLabo = $this->md_parametre->liste_acts_laboratoires_actifs(); ?>

<section class="content profile-page">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Consultation sur l'acte médical : <?php echo $acm->lac_sLibelle; ?></h2>
            <small class="text-muted" style="text-transform:uppercase"><?php $reste = $this->md_config->joursRestantDateTime($acm->acm_dDateExp); echo $reste;?></small>
        </div>        
        <div class="row clearfix">
            <div class="col-lg-3 col-md-12 col-sm-12">
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
            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body"> 
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" style="font-size:14px">
                            <li class="nav-item"><a class="nav-link active"data-toggle="tab" onclick="location.reload(true);" href="#rapport"><b>Dossier médical</b></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#constante"><b>Constante vitale</b></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#complement"><b>Informations complémentaires</b></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" id="cc" href="#planning"><b>Planification de l'opération</b></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" id="cc" href="#consultation"><b>Consultation</b></a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" id="or" href="#ordonnance"><b> Ordonnance</b></a></li>
                            
                        </ul>
						
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane in active" id="rapport">                               
								<div class="wrap-reset" style="margin-top:45px">
									<div class="table-responsive"> 
										<?php if(empty($liste)){echo "<span class='text-danger'>Aucune action n'a été faite sur les séjours de ce patient</span>";}else{?>
										<table class="table table-bordered table-striped table-hover">
										   
											<thead>
												<tr>
													<th>Date de séjour</th>
													<th>Opérations faites</th>
													<th style="width:75px">Résultat</th>
												</tr>
											</thead>
												<?php 
													foreach($liste AS $l){ 
													$constante_sejour = $this->md_patient->constante_sejour($l->sea_id);
													$consultation_sejour = $this->md_patient->consultation_sejour($l->sea_id);
													$ordonnance_sejour = $this->md_patient->ordonnance_sejour($l->sea_id);
													
												?>
												<tr>
													<td>Le <?php echo $this->md_config->affDateFrNum($l->sea_dDate); ?></td>
													<td colspan="2">
														<table style="width:100%;padding:0">
															<?php if($constante_sejour){ ?>
															<tr>
																<td>Constante vitale</td>
																<td style="width:17.6%">
																	<a href="javascript:();" rel="<?php echo $l->sea_id;  ?>" class="text-info const_sej" style="color:#fff"><i class="fa fa-arrow-right pull-right" style="font-size:25px"></i></a>
																</td>
															</tr>
															<?php } ?>
															
															<?php if($consultation_sejour){ ?>
															<tr>
																<td>Consultation</td>
																<td style="width:17.6%">
																	<a href="javascript:();" rel="<?php echo $l->sea_id;  ?>" class="text-info consu_sej" style="color:#fff"><i class="fa fa-arrow-right pull-right" style="font-size:25px"></i></a>
																</td>
															</tr>
															<?php } ?>
															
															<?php if($ordonnance_sejour){ ?>
															<tr>
																<td>Ordonnance</td>
																<td style="width:17.6%">
																	<a href="javascript:();" rel="<?php echo $l->sea_id;  ?>" class="text-info ordo_sej" style="color:#fff"><i class="fa fa-arrow-right pull-right" style="font-size:25px"></i></a>
																</td>
															</tr>
															<?php } ?>
															
															
															
															
															
														</table>
													</td>
												</tr>
												<?php } ?>
											<tbody>
											
											</tbody>
										</table>
										<?php } ?>
									</div>
								</div>
                            </div>
							
                            <div role="tabpanel" class="tab-pane" id="constante">
								
                                <div class="header" style="margin-top:45px">
									<h2>prise des constantes <small>renseignez tous les champs marqués par des (*)</small> </h2>
									
								</div>
								
								<div class="body">
									
									<form id="form-constante">
										<div class="row clearfix">
											<div class="col-sm-12 retour-const"></div>
											<div class="col-sm-12 retour-constFinal"></div>
											<div class="col-sm-3">
												<div class="form-group">
													<div class="form-line">
														<label style="color:#000">Température (°F)</label>
														<input type="number" value="<?php if(!is_null($constante)){echo $constante->con_iTemperature;}?>" name="temperature" class="form-control temperature">
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<div class="form-line">
														<label style="color:#000">Tension arterielle (mmHg)</label>
														<input type="text" value="<?php if(!is_null($constante)){echo $constante->con_iTension;}?>" name="ta" class="form-control ta">
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<div class="form-line">
														<label style="color:#000">Poids (Kg)</label>
														<input type="text" value="<?php if(!is_null($constante)){echo $constante->con_fPoids;}?>" name="poids" class="form-control poids">
													</div>
												</div>
											</div>
											<div class="col-sm-2">
												<div class="form-group">
													<div class="form-line">
														<label style="color:#000">Taille (m)</label>
														<input type="text" value="<?php if(!is_null($constante)){echo $constante->con_fTaille;}?>" name="taille" class="form-control taille">
														<input type="hidden" value="<?php echo $acm_id; ?>" name="id">
													</div>
												</div>
											</div>
										</div>
										
										<div class="row clearfix">
											
											<div class="col-sm-12">
												<button type="submit" class="btn btn-raised bg-blue-grey" id="enregistrerConstante">Enregistrer</button>
											</div>
										</div>
									</form>
								</div>
                            </div>
							
							<div role="tabpanel" class="tab-pane" id="complement">
                                
                            </div>
								
							<div role="tabpanel" class="tab-pane" id="planning">
												
												<div class="col-md-12 col-lg-12 col-xl-12">
													<div class="card m-t-20">
														<form id="cal">
														<?php $rdv = $this->md_rdv->liste_de_mes_rdv(); $odij = date("Y-m-d"); $heure = date("H:i:s");?>
															<?php foreach($rdv AS $r){?>
															<input type="hidden" name="couleurRdv" class="couleurRdv" value="<?php if($r->dir_dDate == $odij AND $r->dir_tHeure_arrive<=$heure){echo "b-l b-2x b-success";}elseif($r->dir_dDate == $odij AND $r->dir_tHeure_arrive>$heure){echo "b-l b-2x b-success bg-warning";}elseif($r->dir_dDate < $odij AND $r->dir_tHeure_arrive<=$heure){echo "b-l b-2x b-lightred";}elseif($r->dir_dDate < $odij AND $r->dir_tHeure_arrive>$heure){echo "b-l b-2x b-lightred bg-warning";}elseif($r->dir_dDate > $odij){echo "bg-cyan";} ?>"/>
															<input type="hidden" name="dateHeureRdv" class="dateHeureRdv" value="<?php echo $r->dir_dDate; ?>T<?php echo $r->dir_tHeure; ?>"/>
															<input type="hidden" name="objetRdv" class="objetRdv" value="Rendez-vous avec <?php echo $r->dir_sNom." ".$r->dir_sPrenom; ?> <?php if($r->dir_sObjet){echo " pour ".$r->dir_sObjet;} ?>"/>
															<?php } ?>
														<form>
														<div class="body">
															<button class="btn btn-raised btn-success btn-sm m-r-0 m-t-0" id="change-view-today">Aujourd'hui</button>
															<button class="btn btn-raised btn-default btn-sm m-r-0 m-t-0" id="change-view-day" >Jour</button>
															<button class="btn btn-raised btn-default btn-sm m-r-0 m-t-0" id="change-view-week">Semaine</button>
															<button class="btn btn-raised btn-default btn-sm m-r-0 m-t-0" id="change-view-month">Mois</button>                        
															<div id="calendar-planning"></div>
														</div>
													</div>
												</div>
												
												<div class="body table-responsive">
													<div class="col-md-12">
														
														<?php $liste = $this->md_personnel->nb_complete_personnel(); ?>
															<div class="row clearfix">
															<form action="" method="POST">
																<div class="col-sm-12"></div>
																<div class="col-sm-4">
																	<div class="header">
																		<h2>Planification de l'opération</h2>
																		
																	</div>
																	<div class="form-group">
																		<div class="form-line">
																			<select name="acte" class="obligatoire"  style="width:100%;padding-bottom:5px;padding-top:5px">
																			<option value="">----- Acte chirurgical * -----</option>
																			<?php $acte = $this->md_parametre->liste_acts_actifs();; foreach($acte AS $a){ ?>
																			<option value="<?php echo $a->lac_id; ?>"><?php echo $a->lac_sLibelle; ?></option>
																			<?php } ?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="form-line">
																			<select name="salle" class="obligatoire" style="width:100%;padding-bottom:5px;padding-top:5px">
																			<option value="">----- Choisissez la salle * -----</option>
																			<?php $salle = $this->md_parametre->liste_salle_actifs(); foreach($salle AS $s){ ?>
																			<option value="<?php echo $s->sal_id; ?>"><?php echo $s->sal_sLibelle; ?></option>
																			<?php } ?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="date" class="datepicker form-control obligatoire" placeholder="Date d'opération *">
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="heureDebut" class="timepicker form-control obligatoire" placeholder="Heure de debut *">
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" name="heureFin" class="timepicker form-control obligatoire" placeholder="Heure de fin *">
																			<input type="hidden" value="<?php echo $acm_id; ?>" name="id_chi">
																			<input type="hidden" value="<?php echo $acm->pat_id; ?>" name="pat_chi">
																		</div>
																	</div>
																	
																</div>
																<div class="col-sm-8">
																	<div class="header">
																		<h2>Equipe technique</h2>
																		<i style="font-size:12px;text-decoration:underline" class="text-danger">(N'oubliez pas d'appuyer sur le plus pour ajouter un agent)</i>
																	</div>
																	<div class="body table-responsive">
																		<table class="table table-bordered table-striped table-hover">
																			<thead>
																				<tr>
																					<th>Agent(s)</th>
																					<th>Rôle(s)</th>
																					<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
																				</tr>
																				<tr>
																					<td>
																						<select id="agent" style="width:100%;padding-bottom:5px;padding-top:5px">
																							<option value="">----- Choisissez l'agent * -----</option>
																							<?php foreach($liste AS $l){ ?>
																							<option value="<?php echo $l->per_id; ?>-/-<?php echo $l->per_sTitre; ?> <?php echo $l->per_sNom; ?> <?php echo $l->per_sPrenom; ?>"><?php echo $l->per_sTitre; ?> <?php echo $l->per_sNom; ?> <?php echo $l->per_sPrenom; ?></option>
																							<?php } ?>
																						</select>
																					</td>
																					<td>
																						<select id="role" style="width:100%;padding-bottom:5px;padding-top:5px">
																							<option value="">----- Rôle * -----</option>
																							<option value="Assistant(e)">Assistant(e)</option>
																							<option value="Anestésiste">Anestésiste</option>
																							<option value="Chirurgien(ne)">Chirurgien(ne)</option>
																						</select>
																					</td>
																					
																					<td class="text-center">
																						<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addPer"><i class="fa fa-plus"></i></a>
																					</td>
																				</tr>
																			</thead>
																		   
																			<tbody id="tbody"></tbody>
																		</table>
																		
																	</div>
																</div>
															</form>
															</div>														
															<div class="col-sm-12 pull-left retour"></div>
															<button type="button" class="btn btn-success waves-effect pull-right addOpe" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</button>
												

													</div>
											
												</div>
                            </div>
							
							<div role="tabpanel" class="tab-pane" id="consultation">
                                  <div class="header" style="margin-top:45px">
									<h2>Faire une consultation <small>renseignez tous les champs marqués par des (*)</small> </h2>
									
								</div>
								<div class="body">
									<form id="form-consultation">
										<div class="row clearfix">
											<div class="col-sm-12 retour-consul"></div>
											<div class="col-sm-12 retour-consulFinal"></div>
											
											<div class="col-sm-12">
												<div class="form-group">
													<div class="form-line">
														<label style="color:#000">Motif de consultation*</label>
														<textarea id='edit_3' name="motif" style="margin-top: 30px;" placeholder="Saissez les ici"><?php if($consultation){echo $consultation->csl_sMotif ;}?></textarea>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label style="color:#000">Examen clinique</label>
													<div id="editor">
														<textarea id='edit' name="obs" style="margin-top: 30px;" placeholder="Saissez les ici"><?php if($consultation){echo $consultation->csl_sObservation ;}?></textarea>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<div class="form-line">
														<label style="color:#000">Anamnèse</label>
														<textarea id='edit_2' name="an" style="margin-top: 30px;" placeholder="Saissez les ici"><?php if($consultation){echo $consultation->csl_sAnamnese ;}?></textarea>
														<input type="hidden" value="<?php echo $acm_id; ?>" name="id">
													</div>
												</div>
											</div>
											
										</div>
										
										<div class="row clearfix">
											
											<div class="col-sm-12">
												<button type="submit" class="btn btn-raised bg-blue-grey" id="enregistrerConsultation">Enregistrer</button>
												<a href="#cc" class="cacher cliqueConsul">clique</a>
											</div>
										</div>
									</form>
								</div>
                            </div>
							
							<div role="tabpanel" class="tab-pane" id="ordonnance">
								<div class="header" style="margin-top:45px">
									<h2>Établir une ordonnance <small>Ajoutez les éléments dans la liste et puis validez</small> </h2>
								</div>
								
								<div class="body">
									<div class="table-responsive">
										<form id="form-ord">
											<div class="retour-ord"></div>
											<table class="table table-bordered table-striped table-hover" style="font-size:12px">
												<thead>
													<tr>
														<th style="width:34%">Nom produit</th>
														<th style="width:50px">Qte</th>
														<th style="width:180px">Posologie</th>
														<th style="width:50px">Durée</th>
														<th style="width:50px"  class="text-center"><i class="fa fa-wrench"></i></th>
													</tr>
													<tr>
														<td>
															<select id="med" style="width:100%;padding-bottom:5px;padding-top:5px">
																<option value="">----- Prescription * -----</option>
																 <?php foreach($listeMed AS $l){ ?>
																<option value="<?php echo  $l->med_id;?>-/-<?php echo  $l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>"><?php echo  $l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?></option>
																 <?php } ?>
															</select>
														</td>
														<td>
															<input type="number" id="qte" style="width:100%"/>
															
														</td>
														<td>
															<input type="text" id="pos" style="width:40%"/>
															<select id="typePos" style="width:55%;padding-bottom:5px;padding-top:5px">
																<option value="Cp">Cp</option>
																<option value="Inj">Inj</option>
																<option value="Amp">Amp</option>
																<option value="Clt">Clt</option>
																
															</select>
															
														</td>
														<td>
															<input type="text" id="duree" style="width:100%"/>
															
														</td>
														
														<td class="text-center">
															<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addOrd"><i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
											   
												<tbody id="tbodyOrd"></tbody>
											</table>
											<input type="hidden" value="<?php echo $acm_id; ?>" name="id">
										</form>
										<a href="javascript:();" class="btn btn-success waves-effect pull-right addOrd" style="color:#fff"><i class="fa fa-check"></i>Valider l'ordonnance</a>
										<a href="#or" class="cacher cliqueOrd">clique</a>
									</div>
								</div>
                            </div>
										
									</form>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalConsulte" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="max-width:90%;margin-top:20px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:500px; overflow:auto;">
			
				 <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						
						<div class="body table-responsive">
							<div class="col-md-12" id="recepConsultation"></div>
						</div>
					</div>
				</div>
			
			</div>
          
        </div>
    </div>
</div>


 <script type="text/javascript">
        'use strict';
		
        var listeOrd = document.querySelector('#tbodyOrd');
        var addOrd = document.querySelector('#addOrd');
        var annuaire;
        annuaire = new Array();

        function removeOrd(index) {
            annuaire.splice(index,1);
            showListeOrd();	
        }

        function addDetailOrd() 
        {
            var med 	            = document.getElementById('med').value;
            var qte 	            = document.getElementById('qte').value;
            var duree 	            = document.getElementById('duree').value;
            var pos 	            = document.getElementById('pos').value;
            var typePos 	        = document.getElementById('typePos').value;
			
            if(med == '' || qte == ''|| duree == ''|| pos == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.med	       	    = med;
                contact.qte	    		= qte;
                contact.duree	        = duree;
                contact.pos	        	= pos;
                contact.typePos	        = typePos;
                annuaire.push(contact);
                showListeOrd();	
				document.getElementById('qte').value="";
				document.getElementById('duree').value="";
				document.getElementById('pos').value="";
            }
        }

        addOrd.addEventListener('click', addDetailOrd);

        function showListeOrd() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabMed = annuaire[i].med.split("-/-");
				
                contenu += '<tr>';
                contenu += '<td><input type="hidden" name="med[]" value="'+ tabMed[0]+'"/>' + tabMed[1] + '</td>';
				 contenu += '<td><input type="hidden" name="qte[]" value="'+ annuaire[i].qte+'"/>' + annuaire[i].qte + '</td>';
				 contenu += '<td><input type="hidden" name="pos[]" value="'+ annuaire[i].pos+ ' ' + annuaire[i].typePos+' /j"/>' + annuaire[i].pos + ' ' + annuaire[i].typePos + ' /j</td>';
				 contenu += '<td><input type="hidden" name="duree[]" value="'+ annuaire[i].duree+'"/>' + annuaire[i].duree + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeOrd(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeOrd.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>

 <script type="text/javascript">
        'use strict';
		
        var listeSoins = document.querySelector('#tbodySoins');
        var addSoins = document.querySelector('#addSoins');
        var annuaireSoins;
        annuaireSoins = new Array();

        function removeSoins(index) {
            annuaireSoins.splice(index,1);
            showListeSoins();	
        }

        function addDetailSoins() 
        {
            var act_soins 	            = document.getElementById('act_soins').value;
            var qte_soins 	            = document.getElementById('qte_soins').value;
            var heure_soins 	            = document.getElementById('heure_soins').value;
            var freq_soins 	            = document.getElementById('freq_soins').value;
            var cons 	            = document.getElementById('cons').value;
			
            if(act_soins == '' || qte_soins == ''|| heure_soins == '' || cons == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contactSoins = new Object();
                contactSoins.act_soins	       	    = act_soins;
                contactSoins.qte_soins	    		= qte_soins;
                contactSoins.heure_soins	        = heure_soins;
                contactSoins.freq_soins	        	= freq_soins;
                contactSoins.cons	        	= cons;
                annuaireSoins.push(contactSoins);
                showListeSoins();	
				document.getElementById('heure_soins').value="";
				document.getElementById('qte_soins').value="";
				document.getElementById('cons').value="";
            }
        }

        addSoins.addEventListener('click', addDetailSoins);

        function showListeSoins() 
        {
            var contenuSoins="";
            var tailleTableauSoins = annuaireSoins.length;            
                
            for(var i = 0; i < tailleTableauSoins; i++) {
				
				var tabSoins = annuaireSoins[i].act_soins.split("-/-");
				
                contenuSoins += '<tr>';
                contenuSoins += '<td><input type="hidden" name="act_soins[]" value="'+ tabSoins[0]+'"/><input type="hidden" name="uni_soins[]" value="'+ tabSoins[2]+'"/>' + tabSoins[1] + '<input type="hidden" name="duree_soins[]" value="'+ tabSoins[3]+'"/> </td>';
				 contenuSoins += '<td><input type="hidden" name="qte_soins[]" value="'+ annuaireSoins[i].qte_soins+'"/>X ' + annuaireSoins[i].qte_soins + '</td>';
				 contenuSoins += '<td><input type="hidden" name="heure_soins[]" value="'+ annuaireSoins[i].heure_soins+'"/><input type="hidden" name="freq_soins[]" value="'+ annuaireSoins[i].freq_soins+'"/> à ' + annuaireSoins[i].heure_soins + ' chaque '+annuaireSoins[i].freq_soins+'H</td>';
				 contenuSoins += '<td><input type="hidden" name="cons[]" value="'+ annuaireSoins[i].cons+'"/>' + annuaireSoins[i].cons + '</td>';
                contenuSoins += '<td class="text-center"><a href="javascript:();" onClick="removeSoins(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenuSoins += '</tr>';
            }

            listeSoins.innerHTML = contenuSoins;
			// alert(contenu);
        }
    
 </script>
 
 <script type="text/javascript">
        'use strict';
		
        var listeEquipe = document.querySelector('#tbody');
        var addPer = document.querySelector('#addPer');
        var annuaire;
        annuaire = new Array();

        function removeSpe(index) {
            annuaire.splice(index,1);
            showListePer();	
        }

        function addDetailEqui() 
        {
            var agent 	            = document.getElementById('agent').value;
            var role 	            = document.getElementById('role').value;
      
			
            if(agent == '' || role == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.agent    = agent;
                contact.role    = role;
                annuaire.push(contact);
                showListePer();
            }
        }

        addPer.addEventListener('click', addDetailEqui);

        function showListePer() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
				
				var tabPer = annuaire[i].agent.split("-/-");
				
                contenu += '<tr>';
                contenu += '<td><input type="hidden" name="agent[]" value="'+ tabPer[0]+'"/>' + tabPer[1] + '</td>';
				 contenu += '<td><input type="hidden" name="role[]" value="'+ annuaire[i].role+'"/>' + annuaire[i].role + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeSpe(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeEquipe.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>
		
<?php include("includes/footer.php"); ?>