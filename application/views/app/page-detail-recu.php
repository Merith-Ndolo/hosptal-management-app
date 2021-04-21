
<?php include("includes/header.php"); $info = $this->md_parametre->info_structure(); $fac = $this->md_pharmacie->detail_recu($id); $elt = $this->md_pharmacie->element_facture($id);?>
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
                                <div class="col-md-6 col-sm-6">
                                    <address>
                                        <strong><?php echo $info->str_sEnseigne  ;?></strong><br>
                                        <i class="fa fa-map-marker"></i>  <?php echo $info->str_sAdresse   ;?><br>
                                         <?php echo $info->str_sVille   ;?>,  <?php echo $info->str_iBp   ;?><br>
                                        <abbr title="Phone"></abbr><i class="fa fa-phone"></i>  <?php echo $info->str_sTel   ;?><br>
                                        <abbr title="Phone"><i class="fa fa-envelope"></i></abbr>  <?php echo $info->str_sEmail   ;?>
                                    </address>
                                </div>                                
                                <div class="col-md-6 col-sm-6 text-right">
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
															<th>Produit</th>
															<th>Prix Unitaire</th>
															<th>Quantité</th>
															<th>Remise</th>
															<th class="text-right">Montant</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach($elt AS $e){?>
														<tr>
															<td><?php echo  $e->med_sNc.' '.$e->for_sLibelle.' '.$e->med_iDosage.''.$e->med_sUnite;?></td>
															<td><?php echo number_format($e->ach_iPrixVente,2,",",".") ;?> <small>FCFA</small></td>
															<td><?php echo $e->elf_iQte ;?></td>
															<td><?php echo $e->elf_iRemise ;?>%</td>
															<?php $montantRemise = ($e->ach_iPrixVente*$e->elf_iRemise)/100; $montant = ($e->ach_iPrixVente - $montantRemise)*$e->elf_iQte ;?>
															<th class="text-right"><?php echo number_format($montant,2,",",".") ;?> <small>FCFA</small></th>
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
                                    <p class="text-right">Montant payé par le patient:  <?php echo number_format($fac->fac_iMontantPaye,2,",",".")   ;?>  <small>FCFA</small></p>
                                    <hr>
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