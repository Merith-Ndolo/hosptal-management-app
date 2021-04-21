<?php include("includes/header.php"); ?>
<?php 
	$articleParPage = 12;
	
	/* tout le monde */
	$articleTotauxLps  = count($this->md_personnel->nb_complete_personnel());
	$pagesTotalesLps = ceil($articleTotauxLps/$articleParPage);
	if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pagesTotalesLps){
		$_GET['page'] = intval($_GET['page']);
		$pageActuelleLps = $_GET['page'];
	}else{
		$pageActuelleLps = 1;
	}
	
	/* Personnel medical */
	$articleTotauxPms  = count($this->md_personnel->nb_personnel_medical());
	$pagesTotalesPms  = ceil($articleTotauxPms/$articleParPage);
	if(isset($_GET['pm']) && !empty($_GET['pm']) && $_GET['pm'] > 0 && $_GET['pm'] <= $pagesTotalesPms){
		$_GET['pm'] = intval($_GET['pm']);
		$pageActuellePms  = $_GET['pm'];
	}else{
		$pageActuellePms  = 1;
	}
	
	/* personnel non medical */
	$articleTotauxPns  = count($this->md_personnel->nb_personnel_non_medical());
	$pagesTotalesPns = ceil($articleTotauxPns/$articleParPage);
	if(isset($_GET['pn']) && !empty($_GET['pn']) && $_GET['pn'] > 0 && $_GET['pn'] <= $pagesTotalesPns){
		$_GET['pn'] = intval($_GET['pn']);
		$pageActuellePns = $_GET['pn'];
	}else{
		$pageActuellePns = 1;
	}
	
	/* personnel medico-technique */
	$articleTotauxPts  = count($this->md_personnel->nb_complete_medico_technique());
	$pagesTotalesPts = ceil($articleTotauxPts/$articleParPage);
	if(isset($_GET['pmt']) && !empty($_GET['pmt']) && $_GET['pmt'] > 0 && $_GET['pmt'] <= $pagesTotalesPts){
		$_GET['pmt'] = intval($_GET['pmt']);
		$pageActuellePts = $_GET['pmt'];
	}else{
		$pageActuellePts = 1;
	}
	
	
	$pms = $this->md_personnel->liste_personnel_medical($articleParPage,$pageActuellePms);
	$pns = $this->md_personnel->liste_personnel_non_medical($articleParPage,$pageActuellePns);
	$pts = $this->md_personnel->liste_personnel_medical_technique($articleParPage,$pageActuellePts);
	$lps = $this->md_personnel->liste_complete_personnel($articleParPage,$pageActuelleLps);
	
	
	
	// var_dump($pms);
 ?>
<section class="content home">
    <div class="container-fluid">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#income"><i class="fa fa-user"></i> <span>Personnel non médical</span></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sales"><i class="fa fa-user-md"></i> <span>Personnel médical</span></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sales2"><i class="fa fa-user"></i><i class="fa fa-medkit"></i> <span>Personnel médico-technique</span></a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("personnel/tout"); ?>"><i class="fa fa-search"></i> <span>Recherche large</span></a></li>
        </ul> 
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
                <div class="row clearfix">
                    
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box-3 bg-blue-grey">
                           
                            <div class="content">
                                <div class="text">Un totale de</div>
                                <div class="number"><?php echo $articleTotauxPns; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
			
                        <div class="card">
                            <div class="body">
                                <div class="container-fluid">
									<div class="row clearfix">
										<?php foreach($pns AS $pn){ ?>
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
											<div class="card">
												<div class="body">
													<div class="member-card verified">                            
														<div class="thumb-xl member-thumb">
															<img src="<?php echo base_url($pn->per_sAvatar);?>" class="img-thumbnail rounded-circle" alt="profile-image">                               
														</div>

														<div class="">
															<h4 class="m-b-5 m-t-20"><?php echo $pn->per_sTitre;?> <?php echo $pn->per_sNom;?> <?php echo $pn->per_sPrenom;?> </h4>
															<p class="text-muted"><?php echo $pn->dep_sLibelle;?><span> <a href="#" class="text-pink"><?php echo $pn->per_sTel;?></a> </span></p>
														</div>

														<p class="text-muted"><?php echo $pn->per_sAdresse;?></p>                           
														<a href="<?php echo site_url("personnel/profil/".$pn->per_id);?>"  class="btn btn-raised btn-sm">Voir le profil</a>
														
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
									<?php if($articleTotauxPns >$articleParPage){ ?>
									<div class="row clearfix">
										<div class="col-sm-12 text-center">
											<ul class="pagination">
												<?php
													for($i=1;$i<=$pagesTotalesPns;$i++){
														if($i==$pageActuellePns){
												?>
												<li class="page-item active"><a class="page-link" href="javascript:();"><?=$i?></a></li>
												<?php }else{  ?>
												 <li class="page-item"><a class="page-link" href="<?php echo site_url("personnel/liste");?>/?pn=<?=$i?>"><?=$i?></a></li>
												<?php } } ?>
											</ul>
										</div>
									</div>
									<?php } ?>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                          
            </div>
            
            <div role="tabpanel" class="tab-pane page-calendar" id="sales">
                <div class="row clearfix">
                    
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box-3 bg-blue-grey">
                           
                            <div class="content">
                                <div class="text">Un totale de</div>
                                <div class="number"><?php echo $articleTotauxPms; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
			
                        <div class="card">
                            <div class="body">
                                <div class="container-fluid">
									<div class="row clearfix">
										<?php foreach($pms AS $pm){ ?>
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
											<div class="card">
												<div class="body">
													<div class="member-card verified">                            
														<div class="thumb-xl member-thumb">
															<img src="<?php echo base_url($pm->per_sAvatar);?>" class="img-thumbnail rounded-circle" alt="profile-image">                               
														</div>

														<div class="">
															<h4 class="m-b-5 m-t-20"><?php echo $pm->per_sTitre;?> <?php echo $pm->per_sNom;?> <?php echo $pm->per_sPrenom;?> </h4>
															<p class="text-muted"><?php echo $pm->dep_sLibelle;?><span> <a href="#" class="text-pink"><?php echo $pm->per_sTel;?></a> </span></p>
														</div>

														<p class="text-muted"><?php echo $pm->per_sAdresse;?></p>                           
														<a href="<?php echo site_url("personnel/profil/".$pm->per_id);?>"  class="btn btn-raised btn-sm">Voir le profil</a>
														
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
									<?php if($articleTotauxPms >$articleParPage){ ?>
									<div class="row clearfix">
										<div class="col-sm-12 text-center">
											<ul class="pagination">
												<?php
													for($i=1;$i<=$pagesTotalesPms;$i++){
														if($i==$pageActuellePms){
												?>
												<li class="page-item active"><a class="page-link" href="javascript:();"><?=$i?></a></li>
												<?php }else{  ?>
												 <li class="page-item"><a class="page-link" href="<?php echo site_url("personnel/liste");?>/?pm=<?=$i?>"><?=$i?></a></li>
												<?php } } ?>
											</ul>
										</div>
									</div>
									<?php } ?>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
			
            <div role="tabpanel" class="tab-pane page-calendar" id="sales2">
                <div class="row clearfix">
                    
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box-3 bg-blue-grey">
                           
                            <div class="content">
                                <div class="text">Un totale de</div>
                                <div class="number"><?php echo $articleTotauxPts; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
				
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
			
                        <div class="card">
                            <div class="body">
                                <div class="container-fluid">
									<div class="row clearfix">
										<?php foreach($pts AS $pt){ ?>
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
											<div class="card">
												<div class="body">
													<div class="member-card verified">                            
														<div class="thumb-xl member-thumb">
															<img src="<?php echo base_url($pt->per_sAvatar);?>" class="img-thumbnail rounded-circle" alt="profile-image">                               
														</div>

														<div class="">
															<h4 class="m-b-5 m-t-20"><?php echo $pt->per_sTitre;?> <?php echo $pt->per_sNom;?> <?php echo $pt->per_sPrenom;?> </h4>
															<p class="text-muted"><?php echo $pt->dep_sLibelle;?><span> <a href="#" class="text-pink"><?php echo $pt->per_sTel;?></a> </span></p>
														</div>

														<p class="text-muted"><?php echo $pt->per_sAdresse;?></p>                           
														<a href="<?php echo site_url("personnel/profil/".$pt->per_id);?>"  class="btn btn-raised btn-sm">Voir le profil</a>
														
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
									<?php if($articleTotauxPts >$articleParPage){ ?>
									<div class="row clearfix">
										<div class="col-sm-12 text-center">
											<ul class="pagination">
												<?php
													for($i=1;$i<=$pagesTotalesPts;$i++){
														if($i==$pageActuellePts){
												?>
												<li class="page-item active"><a class="page-link" href="javascript:();"><?=$i?></a></li>
												<?php }else{  ?>
												 <li class="page-item"><a class="page-link" href="<?php echo site_url("personnel/liste");?>/?pmt=<?=$i?>"><?=$i?></a></li>
												<?php } } ?>
											</ul>
										</div>
									</div>
									<?php } ?>
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