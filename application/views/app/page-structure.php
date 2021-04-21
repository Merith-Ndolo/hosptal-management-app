<?php include("includes/header.php"); $info = $this->md_parametre->info_structure();?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Modifier identité de l'hôpital</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					
					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-12 col-md-12 col-lg-12"> 
							
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">		
										<div class="row clearfix">
											<div class="col-md-12 col-sm-12">
												<div class="card">
													<div class="header">
														<h2>Informations de l'hôpital <small>renseignez tous les champs marqués par des (*)</small> </h2>
														
													</div>
												</div>
											</div>
											<div class="col-md-4 col-sm-4">
												<div class="form-group">
													<div class="">
														<img src="../../<?php echo $info->str_sLogo   ;?>" style="width:100%"/>
													</div>
												</div>
											</div>
											<div class="col-lg-8 col-md-8 col-sm-8">
												<div class="card">
													
													<div class="body">
														<form id="form-modif-struc">
															<div class="row clearfix">
																<div class="col-sm-12 retour-modif-struc"></div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>* Nom de la structure</label>
																		<div class="form-line">
																			<input type="text" name="structure" class="form-control obligatoire" value="<?php echo $info->str_sEnseigne  ;?>">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																	<label>* E-mail</label>
																		<div class="form-line">
																			<input type="text" name="email" class="form-control obligatoire" value="<?php echo $info->str_sEmail  ;?>">
																		</div>
																	</div>
																</div>
																<div class="col-sm-12">
																	<div class="form-group">
																		<label>* Adresse</label>
																		<div class="form-line">
																			<input type="text" name="adresse" class="form-control obligatoire" value="<?php echo $info->str_sAdresse  ;?>">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-md-6 col-sm-6">
																	<label>* Ville</label>
																	<div class="form-group drop-custum">
																		<select name="ville" class="form-control obligatoire show-tick">
																			<option value="Brazzaville" <?php if($info->str_sVille=="Brazzaville"){echo "selected='selected'";}  ;?>>Brazzaville</option>
																			<option value="Pointe-Noire" <?php if($info->str_sVille=="Pointe-Noire"){echo "selected='selected'";}  ;?>>Pointe-Noire</option>
																			<option value="Dolisie" <?php if($info->str_sVille=="Dolisie"){echo "selected='selected'";}  ;?>>Dolisie</option>
																			<option value="Ouesso" <?php if($info->str_sVille=="Ouesso"){echo "selected='selected'";}  ;?>>Ouesso</option>
																			<option value="Owando" <?php if($info->str_sVille=="Owando"){echo "selected='selected'";}  ;?>>Owando</option>
																			<option value="Nkayi" <?php if($info->str_sVille=="Nkayi"){echo "selected='selected'";}  ;?>>Nkayi</option>
																			<option value="Kinkala" <?php if($info->str_sVille=="Kinkala"){echo "selected='selected'";}  ;?>>Kinkala</option>
																			<option value="Impfondo" <?php if($info->str_sVille=="Impfondo"){echo "selected='selected'";}  ;?>>Impfondo</option>
																			<option value="Oyo" <?php if($info->str_sVille=="Oyo"){echo "selected='selected'";}  ;?>>Oyo</option>
																			<option value="Mossendjo" <?php if($info->str_sVille=="Mossendjo"){echo "selected='selected'";}  ;?>>Mossendjo</option>
																			<option value="Madingou" <?php if($info->str_sVille=="Madingou"){echo "selected='selected'";}  ;?>>Madingou</option>
																			<option value="Djambala" <?php if($info->str_sVille=="Djambala"){echo "selected='selected'";}  ;?>>Djambala</option>
																			<option value="Sibiti" <?php if($info->str_sVille=="Sibiti"){echo "selected='selected'";}  ;?>>Sibiti</option>
																			<option value="Gamboma" <?php if($info->str_sVille=="Gamboma"){echo "selected='selected'";}  ;?>>Gamboma</option>
																			<option value="Mouyondzi" <?php if($info->str_sVille=="Mouyondzi"){echo "selected='selected'";}  ;?>>Mouyondzi</option>
																			<option value="Makoua" <?php if($info->str_sVille=="Makoua"){echo "selected='selected'";}  ;?>>Makoua</option>
																			<option value="Mossaka" <?php if($info->str_sVille=="Mossaka"){echo "selected='selected'";}  ;?>>Mossaka</option>
																			<option value="Loukoléla" <?php if($info->str_sVille=="Loukoléla"){echo "selected='selected'";}  ;?>>Loukoléla</option>
																			<option value="Sembé" <?php if($info->str_sVille=="Sembé"){echo "selected='selected'";}  ;?>>Sembé</option>
																			<option value="Mindouli" <?php if($info->str_sVille=="Mindouli"){echo "selected='selected'";}  ;?>>Mindouli</option>
																			<option value="Loango" <?php if($info->str_sVille=="Loango"){echo "selected='selected'";}  ;?>>Loango</option>
																			<option value="Pokola" <?php if($info->str_sVille=="Pokola"){echo "selected='selected'";}  ;?>>Pokola</option>
																			<option value="Kindamba" <?php if($info->str_sVille=="Kindamba"){echo "selected='selected'";}  ;?>>Kindamba</option>
																			<option value="Boundji" <?php if($info->str_sVille=="Boundji"){echo "selected='selected'";}  ;?>>Boundji</option>
																			<option value="Ewo" <?php if($info->str_sVille=="Ewo"){echo "selected='selected'";}  ;?>>Ewo</option>
																			<option value="Etoumbi" <?php if($info->str_sVille=="Etoumbi"){echo "selected='selected'";}  ;?>>Etoumbi</option>
																			<option value="Mvouti" <?php if($info->str_sVille=="Mvouti"){echo "selected='selected'";}  ;?>>Mvouti</option>
																			<option value="Dongou" <?php if($info->str_sVille=="Dongou"){echo "selected='selected'";}  ;?>>Dongou</option>
																			<option value="Diosso" <?php if($info->str_sVille=="Diosso"){echo "selected='selected'";}  ;?>>Diosso</option>
																			<option value="Souanké" <?php if($info->str_sVille=="Souanké"){echo "selected='selected'";}  ;?>>Souanké</option>
																			<option value="Loutété" <?php if($info->str_sVille=="Loutété"){echo "selected='selected'";}  ;?>>Loutété</option>
																			<option value="Boko" <?php if($info->str_sVille=="Boko"){echo "selected='selected'";}  ;?>>Boko</option>
																			<option value="Linzolo" <?php if($info->str_sVille=="Linzolo"){echo "selected='selected'";}  ;?>>Linzolo</option>
																			<option value="Lekana" <?php if($info->str_sVille=="Lekana"){echo "selected='selected'";}  ;?>>Lekana</option>
																			<option value="Mayoko"<?php if($info->str_sVille=="Mayoko"){echo "selected='selected'";}  ;?> >Mayoko</option>
																			<option value="Mayama"<?php if($info->str_sVille=="Mayama"){echo "selected='selected'";}  ;?>>Mayama</option>
																			<option value="Kéllé" <?php if($info->str_sVille=="Kéllé"){echo "selected='selected'";}  ;?>>Kéllé</option>
																			<option value="Kibangou" <?php if($info->str_sVille=="Kibangou"){echo "selected='selected'";}  ;?>>Kibangou</option>
																			<option value="Epena" <?php if($info->str_sVille=="Epena"){echo "selected='selected'";}  ;?>>Epena</option>
																			<option value="Zanaga" <?php if($info->str_sVille=="Zanaga"){echo "selected='selected'";}  ;?>>Zanaga</option>
																			<option value="Okoyo" <?php if($info->str_sVille=="Okoyo"){echo "selected='selected'";}  ;?>>Okoyo</option>
																			<option value="Abala" <?php if($info->str_sVille=="Abala"){echo "selected='selected'";}  ;?>>Abala</option>
																			<option value="Bouansa" <?php if($info->str_sVille=="Bouansa"){echo "selected='selected'";}  ;?>>Bouansa</option>
																		</select>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>BP</label>
																		<div class="form-line">
																			<input type="number" min="0" name="bp" class="form-control obligatoire" value="<?php echo $info->str_iBp  ;?>">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row clearfix">
																
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>* Téléphone principal</label>
																		<div class="form-line">
																			<input type="text" name="tel" class="form-control tel obligatoire" value="<?php echo $info->str_sTel  ;?>">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>Autre téléphone</label>
																		<div class="form-line">
																			<input type="text" name="tel2" class="form-control" value="<?php echo $info->str_sTel_2  ;?>">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>Autre téléphone</label>
																		<div class="form-line">
																			<input type="text" name="tel3" class="form-control" value="<?php echo $info->str_sTel_3  ;?>">
																		</div>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group">
																		<label>Autre téléphone</label>
																		<div class="form-line">
																			<input type="text" name="tel4" class="form-control" value="<?php echo $info->str_sTel_4  ;?>">
																		</div>
																	</div>
																</div>
																
																<div class="col-md-12 col-sm-6">
																	<label>Photo</label>
																	<div class="fallback">
																		<input name="photo" type="file" class="form-control photo" name="photo" />
																		<input style="display:none" name="photo1" type="file" name="<?php echo $info->str_sLogo  ;?>" />
																	</div>
																</div>
																
																<div class="col-sm-12">
																	<button type="submit" class="btn btn-raised bg-blue-grey" id="modifStructure">Modifier</button>
																</div>
																<div class="col-sm-12 retour-modif-struc"></div>
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
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Tabs With Custom Animations -->
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finishPatient" id="finishPatient">BLUE GREY</button>
    </div>
</section>


<!-- For Material Design Colors -->
<div class="modal fade" id="mdModalPatient" tabindex="-1" role="dialog">
	
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE ACCUEIL</h4>
            </div>
            <div class="modal-body text-center"> Patient enregistré avec succès <br><img src="<?php echo base_url("assets/images/icons8-attendance-50.png");?>"/></div>
            <div id="refresh"></div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>