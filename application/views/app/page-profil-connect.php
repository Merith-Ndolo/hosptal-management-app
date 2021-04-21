<?php include("includes/header.php"); ?>

<section class="content profile-page">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12 p-l-0 p-r-0">
                <section class="boxs-simple">
                    <div class="profile-header">
                        <div class="profile_info">
                            <div class="profile-image"> <img src="assets/images/random-avatar7.jpg" alt=""> </div>
                            <h4 class="mb-0"><strong><?php echo $user->per_sTitre ;?> <?php echo $user->per_sNom.' '.$user->per_sAutresNoms ;?></strong> <?php echo $user->per_sPrenom.' '.$user->per_sAutresPrenoms ;?></h4>
                            <span class="text-muted col-white"><?php echo $user->pst_sLibelle ;?> - <?php echo $user->spt_sLibelle ;?></span>
                            <!--
							<div class="mt-10">
                                <button class="btn btn-raised btn-default bg-blush btn-sm">Follow</button>
                                <button class="btn btn-raised btn-default bg-green btn-sm">Message</button>
                            </div>
                            <p class="social-icon">
                                <a title="Twitter" href="#"><i class="zmdi zmdi-twitter"></i></a>
                                <a title="Facebook" href="#"><i class="zmdi zmdi-facebook"></i></a>
                                <a title="Google-plus" href="#"><i class="zmdi zmdi-twitter"></i></a>
                                <a title="Dribbble" href="#"><i class="zmdi zmdi-dribbble"></i></a>
                                <a title="Behance" href="#"><i class="zmdi zmdi-behance"></i></a>
                                <a title="Instagram" href="#"><i class="zmdi zmdi-instagram "></i></a>
                                <a title="Pinterest" href="#"><i class="zmdi zmdi-pinterest "></i></a>
                            </p>
							-->
                        </div>
                    </div>
                    <div class="profile-sub-header">
                        <div class="box-list">
                            <ul class="text-center">
                                <li> <a href="mail-inbox.html" class=""><i class="zmdi zmdi-email"></i>
                                    <p>Ma boîte de messagerie</p>
                                    </a> </li>
                                <li> <a href="#" class=""><i class="zmdi zmdi-folder"></i>
                                    <p>Mes Archives</p>
                                    </a> </li>
                               
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-5 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Consigne à rappeler aux patients</h2>
                    </div>
                    <div class="body">
                        <p class="text-default">Pour qu'un séjour à l'hôpital se déroule dans de bonnes conditions, il est indispensable que chacun respecte quelques règles de savoir-vivre et de sécurité.</p>
                        <div class="col-lg-12 col-md-12 col-sm-12">
								
							<div class="row clearfix">
								<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
									<div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">
										<div class="panel panel-col-grey">
											<div class="panel-heading" role="tab" id="headingOne_17">
												<h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseOne_17" aria-expanded="true" aria-controls="collapseOne_17" style="font-size:14px"><b>Quelques règles élémentaires de savoir-vivre</b> </a> </h4>
											</div>
											<div id="collapseOne_17" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_17">
												<div class="panel-body"> 
													Vous allez, durant votre hospitalisation, côtoyer d'autres patients et des personnels de l'établissement. 
													Il convient donc de respecter quelques règles élémentaires de savoir-vivre :
													<ul>
														<li>Ne détériorez ni les locaux ni le matériel mis à votre disposition.</li>
														<li>Usez avec discrétion des appareils de radio et de télévision, ainsi que des baladeurs.</li>
														<li>Evitez les conversations trop bruyantes.</li>
														<li>Soyez courtois avec les autres malades, les visiteurs et le personnel.</li>
														<li>Soyez ponctuel lorsque vous avez rendez-vous pour une consultation (pensez à venir un peu plus tôt que l'horaire indiqué, afin d'effectuer les formalités administratives indispensables à votre prise en charge).</li>
														<li>Si vous ne pouvez pas vous rendre à la consultation programmée, pensez à annuler votre rendez-vous auprès du secrétariat, afin que ce créneau horaire puisse être attribué à un autre patient.</li>
														
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-col-blue-grey">
											<div class="panel-heading" role="tab" id="headingTwo_17">
												<h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseTwo_17" aria-expanded="false"
														   aria-controls="collapseTwo_17" style="font-size:14px"> <b> Quelques règles d'hygiène</b></a> </h4>
											</div>
											<div id="collapseTwo_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_17">
												<div class="panel-body"> 
													Lorsque l'on est malade ou que l'on procède à des examens, les règles d'hygiène 
													revêtent une importance toute particulière. C'est pourquoi il convient toujours : 
													<ul>
														<li>de se laver les mains au savon après être allé aux toilettes, avant de manger, avant de sortir de sa chambre (y compris pour les visiteurs) ;</li>
														<li>de prendre une douche par jour ;</li>
														<li>de veiller à une bonne hygiène bucco-dentaire.</li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="panel panel-col-deep-orange">
											<div class="panel-heading" role="tab" id="headingFour_17">
												<h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseFour_17" aria-expanded="false"
														   aria-controls="collapseFour_17" style="font-size:14px"> <b>Quelques règles de sécurité</b> </a> </h4>
											</div>
											<div id="collapseFour_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour_17">
												<div class="panel-body"> 
													Pour la sécurité et la santé de tous, nous vous rappelons qu'à l'hôpital public, il est interdit :
													<ul>
														<li><b>De fumer</b> dans l'enceinte de l'établissement, par mesure d'hygiène et de sécurité (décret du 15 novembre 2006).</li>
														<li><b>D'apporter ou de se faire apporter des boissons alcoolisées.</b></li>
														<li><b>De se faire remettre des vivres, boissons ou médicaments, sauf autorisation expresse de votre médecin.</b> En effet, votre santé impose souvent un régime alimentaire particulier lors de votre hospitalisation. Le non respect de ce régime peut donc présenter un danger.</li>
														<li><b>D'utiliser des téléphones portables</b> au sein de l'établissement, en raison des risques de perturbations des dispositifs médicaux fonctionnant avec des systèmes électroniques. Votre téléphone doit être éteint et non pas placé en mode vibreur (circulaire du ministère de la Santé du 9 octobre 1995).</li>
														<li><b>D'introduire des animaux dans l'établissement</b> (sauf les chiens-guides d'aveugles).</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							
						</div>
						<blockquote>
                            <p>Les efforts des équipes de l'hôpital, ainsi que le respect de ces quelques règles de vie en commun, permettront à votre passage au sein de l'établissement de se dérouler dans les meilleures conditions possibles..</p>
                            <small>Signé le <cite title="Directeur général">Directeur général</cite></small> </blockquote>
                    </div>
                </div>
               
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="card">
                    <div class="body"> 
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#mypost">Mes Publications</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#timeline">Activités à suivre</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#usersettings">Éditer mon profil</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#avatarsettings">Changer ma photo</a></li>
                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane in active" id="mypost">
                                <div class="wrap-reset">
                                    <div class="mypost-form">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                            </div>
                                        </div>
                                        <div class="post-toolbar-b"> <a href="#" tooltip="Add File" class="btn btn-raised btn-default btn-sm"><i class="zmdi zmdi-attachment"></i></a> <a href="#" tooltip="Add Image" class="btn btn-raised btn-default btn-sm"><i class="zmdi zmdi-camera"></i></a> <a href="#" class="pull-right btn btn-raised btn-success btn-sm" tooltip="Post it!">Post</a> </div>
                                    </div>
                                    <div class="mypost-list">
                                        <div class="post-box"> <span class="text-muted text-small"><i class="zmdi zmdi-alarm"></i> 3 minutes ago</span>
                                            <div class="post-img"><img src="assets/images/puppy-1.jpg" class="img-fluid" alt /></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="" class="btn btn-raised btn-info btn-sm"><i class="zmdi zmdi-favorite-outline"></i> Like (5) </a> <a href="" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="post-box"> <span class="text-muted text-small"><i class="zmdi zmdi-alarm"></i> 23 minutes ago</span>
                                            <div class="post-img"><img src="assets/images/puppy-2.jpg" class="img-fluid" alt /></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="" class="btn btn-raised btn-info btn-sm"><i class="zmdi zmdi-favorite-outline"></i> Like (5) </a> <a href="" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="post-box"> <span class="text-muted text-small"><i class="zmdi zmdi-alarm"></i> 45 minutes ago</span>
                                            <div class="post-img"><img src="assets/images/puppy-3.jpg" class="img-fluid" alt /></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="" class="btn btn-raised btn-info btn-sm"><i class="zmdi zmdi-favorite-outline"></i> Like (5) </a> <a href="" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="text-center"> <a href="#" class="btn btn-raised btn-default">Load More …</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="timeline">
                                <div class="timeline-body">
                                    <div class="timeline m-border">
                                        <div class="timeline-item">
                                            <div class="item-content">
                                                <div class="text-small">Just now</div>
                                                <p>Finished task #features 4.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small">11:30</div>
                                                <p>@Jessi retwit your post</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-warning border-l">
                                            <div class="item-content">
                                                <div class="text-small">10:30</div>
                                                <p>Call to customer #Jacob and discuss the detail.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-warning">
                                            <div class="item-content">
                                                <div class="text-small">3 days ago</div>
                                                <p>Jessi commented your post.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-danger">
                                            <div class="item-content">
                                                <div class="text--muted">Thu, 10 Mar</div>
                                                <p>Trip to the moon</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small">Sat, 5 Mar</div>
                                                <p>Prepare for presentation</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-danger">
                                            <div class="item-content">
                                                <div class="text-small">Sun, 11 Feb</div>
                                                <p>Jessi assign you a task #Mockup Design.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small">Thu, 17 Jan</div>
                                                <p>Follow up to close deal</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="item-content">
                                                <div class="text-small">Just now</div>
                                                <p>Finished task #features 4.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-info">
                                            <div class="item-content">
                                                <div class="text-small">11:30</div>
                                                <p>@Jessi retwit your post</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-warning border-l">
                                            <div class="item-content">
                                                <div class="text-small">10:30</div>
                                                <p>Call to customer #Jacob and discuss the detail.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item border-warning">
                                            <div class="item-content">
                                                <div class="text-small">3 days ago</div>
                                                <p>Jessi commented your post.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="usersettings">
                               <div class="body">
                                    <h2 class="card-inside-title">Identifiants de connexion</h2>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
											<form id="form-per">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group retour-per"></div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="form-line">
																<label>Adresse mail *</label>
																<input type="email" name="email" class="form-control email obligatoire" placeholder="Adresse mail" value="<?php echo $user->per_sEmail;?>">
																<input name="id" type="hidden" value="<?php echo $user->per_id; ?>"/>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="form-line">
																<label>Numéro de téléphone *</label>
																<input type="text" name="tel" class="form-control tel obligatoire" placeholder="Numéro de téléphone" value="<?php echo $user->per_sTel;?>">
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="form-line">
														<label><i>(Vous n'êtes pas obligé de changer le mot de passe)</i></label>
														<input type="password" name="apass" class="form-control apass" placeholder="Ancien mot de passe">
													</div>
												</div> 
												<div class="form-group">
													<div class="form-line">
														<input type="password" name="npass" class="form-control npass" placeholder="Nouveau mot de passe">
													</div>
												</div>
												<div class="form-group">
													<div class="form-line">
														<input type="password" name="cpass" class="form-control cpass" placeholder="Confirmez le mot de passe">
													</div>
												</div>
												<button type="submit" class="btn btn-raised btn-success" id="editCompte">Sauvegarder le changement</button>
											</form>
                                        </div>
                                    </div>
                                   
                               </div>
                            </div>
							<div role="tabpanel" class="tab-pane" id="avatarsettings">
                               <div class="body">
                                    <h2 class="card-inside-title">Photo de profil</h2>
                                    <div class="row clearfix">
										<div class="col-lg-5 col-md-5 col-sm-12">
											<a href="<?php echo base_url($user->per_sAvatar); ?>" target="blank"><img src="<?php echo base_url($user->per_sAvatar); ?>" class="img-thumbnail" alt="profile-image"></a>                              
										</div>
										<div class="col-lg-7 col-md-7 col-sm-12">
											<form id="form-avatar" >
												<div class="form-group retour-avatar"></div>
												<div class="fallback">
													<input name="photo" type="file" multiple class="form-control obligatoire" />
													<input name="photoActuelle" type="hidden" value="<?php echo $user->per_sAvatar; ?>"/>
													<input name="id" type="hidden" value="<?php echo $user->per_id; ?>"/>
												</div>
												<button type="submit" class="btn btn-raised btn-success" id="changerAvatar">Changez</button>
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
</section>

<?php include("includes/footer.php"); ?>