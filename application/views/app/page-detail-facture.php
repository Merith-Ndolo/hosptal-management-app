
<?php include("includes/header.php"); $info = $this->md_parametre->info_structure(); $fac = $this->md_patient->detail_facture($id); $elt = $this->md_patient->element_facture($id);?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Patient's Invoice</h2>
            <small class="text-muted">Welcome to Swift application</small>
        </div>
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>FACTURE</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Print Invoices</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li><a href="javascript:void(0);">Export to XLS</a></li>
                                        <li><a href="javascript:void(0);">Export to CSV</a></li>
                                        <li><a href="javascript:void(0);">Export to XML</a></li>                                    
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-4 col-sm-4">
                                    <h4><img src="<?php echo base_url($info->str_sLogo) ;?>" width="70" alt="velonic"></h4>                                                
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h4>Objet <br>
                                        <strong><?php echo $fac->fac_sObjet  ;?></strong>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <address>
                                        <strong><?php echo $info->str_sEnseigne  ;?></strong><br>
                                        <i class="fa fa-map-marker"></i>  <?php echo $info->str_sAdresse   ;?><br>
                                         <?php echo $info->str_sVille   ;?>,  <?php echo $info->str_iBp   ;?><br>
                                        <abbr title="Phone"></abbr><i class="fa fa-phone"></i>  <?php echo $info->str_sTel   ;?><br>
                                        <abbr title="Phone"><i class="fa fa-envelope"></i></abbr>  <?php echo $info->str_sEmail   ;?>
                                    </address>
                                </div>                                
								<div class="col-md-4 col-sm-4 text-center">
                                    <address>
										 <strong><?php echo $fac->pat_sMatricule    ;?></strong><br>
                                        <strong><?php echo $fac->pat_sNom.' '.$fac->pat_sPrenom   ;?></strong><br>
                                    </address>
                                </div>
                                <div class="col-md-4 col-sm-4 text-right">
                                    <p><strong>Date paiement : </strong> <?php if(is_null($fac->fac_dDateReste)){ echo $this->md_config->affDateFrNum($fac->fac_dDatePaie) ; }else{ echo $this->md_config->affDateFrNum($fac->fac_dDateReste);} ?></p>
                                    <p class="m-t-10"><strong>Satut: </strong> 										
									<?php if($fac->fac_iReste ==0){ ?>
										<span class="label label-success">Facture payée</span>
										<?php }else{ ?>
										<span class="label label-warning">Montant avancé</span>
									<?php } ?></p>
                                    <p class="m-t-10"><strong>N° : </strong> <?php echo $fac->fac_sNumero  ;?></p>
                                </div>
                            </div>
							 <p class="text-center"><?php if(is_null($fac->ass_id)){echo 'Patient non assuré';}else{echo 'Assureur <b>'.$fac->ass_sLibelle.'</b>';} ;?></p>
							 <p class="text-center"><?php if(!is_null($fac->tas_id)){echo 'Type d\'assurance : <b>'.$fac->tas_sLibelle.'</b>';} ;?></p>
                            <div class="mt-40"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
										<div class="row">
											<div class="col-md-1 col-lg-1 col-sm-1" style="padding-right:0">
												<table  class="table table-striped" style="cursor: pointer;border-bottom:3px solid #fff">
													<thead>
														<tr><th>#</th>
														</tr>
													</thead>
													<tbody>
													<?php 
														$val = array();
														for($i=0; $i<count($elt);$i++){
															$val[] = $i+1;
														}
													?>
													<?php for($j=0; $j <count($val);$j++){?>
														<tr>
															<td><?php echo  $val[$j];?></td>
														</tr>
													<?php }?>
													</tbody>
												</table>
											</div>
											<div class="col-md-11 col-lg-11 col-sm-11" style="padding-left:0">
												 <table id="mainTable" class="table table-striped" style="cursor: pointer;border-bottom:3px solid #fff">
													<thead>
														<tr>
															<th>Acte</th>
															<?php if(!is_null($fac->ass_id)){?>
															<th>Couverture assurance</th>
															<?php }?>
															<th class="text-right">Coût</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach($elt AS $e){?>
														<tr>
															<td><?php echo $e->lac_sLibelle ;?></td>
															<?php if(!is_null($fac->ass_id)){?>
															<td>
																<?php  
																	$recup = $this->md_parametre->recup_acte_couvert($e->lac_id,$fac->tas_id);?>
																<?php if($recup){echo 'L\'assureur couvre '. $fac->tas_iTaux.' % du coût de l\'acte médical';}else{echo 'Acte non couvert par l\'assureur';};?> 
															</td>
															<?php }?>
															<th class="text-right"><?php echo number_format($e->lac_iCout,2,",",".") ;?> <small>FCFA</small></th>
														</tr>
													<?php }?>
													</tbody>
												</table>
											</div>
										</div>
                                    </div>
                                </div>
                            </div>
							  <hr>
                            <div class="row" style="border-radius: 0px;">
                                <div class="col-md-12 text-right">
                                    <p class="text-right"><b>Total:</b> <?php echo number_format($fac->fac_iMontant,2,",",".")  ;?>  <small>FCFA</small></p>
                                    <p class="text-right"><?php if(!is_null($fac->ass_id)){echo 'Montant payé par l\'assureur : '.number_format($fac->fac_iMontantAss,2,",",".").' <small>FCFA</small>';} ;?></p>
                                    <p class="text-right">Montant payé par le patient:  <?php echo number_format($fac->fac_iMontantPaye,2,",",".")   ;?>  <small>FCFA</small></p>
                                    <hr>
                                    <h3 class="text-right">Montant encaissé : <?php echo number_format($fac->fac_iMontantAss + $fac->fac_iMontantPaye ,2,",",".")  ;?> <small>FCFA</small></h3>
                                    <?php if($fac->fac_iReste !=0){ ?>
								   <h4 class="text-right text-danger">Reste à payer : <?php echo number_format($fac->fac_iReste,2,",",".")  ;?> <small>FCFA</small></h4>
									<?php }?>
                                </div>
                            </div>
                            <hr>
                            <div class="hidden-print col-md-12 text-right">
                                <a href="javascript:window.print()" class="btn btn-raised btn-success"><i class="zmdi zmdi-print"></i></a>
                                <a href="#" class="btn btn-raised btn-default">Submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<?php include("includes/footer.php"); ?>