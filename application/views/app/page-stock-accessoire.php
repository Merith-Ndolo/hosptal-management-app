<?php include("includes/header.php"); ?>

<section class="content home">
    <div class="container-fluid">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#income"> <span>Accessoires</span></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sales"> <span>Réactifs</span></a></li>
        </ul> 
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="income">
				<div class="block-header">
				<h2>Gestion du stock</h2>
					<small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
				</div>
				
				<!-- Tabs With Custom Animations -->
				<div class="row clearfix">
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="info-box-4 hover-zoom-effect">
							<div class="icon"><a href="<?php echo site_url("laboratoire/entree_accessoire");?>"><i class="fa fa-sign-in col-blue-grey"></i><br>Faire l'opération ici</a></div>
							<div class="content">
								<div class="text">Nouvelle entrée en stock</div>
								<div class="number"></div>
							</div>
						</div>
					</div>		
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="info-box-4 hover-zoom-effect">
							<div class="icon"><a href="<?php echo site_url("laboratoire/stock_accessoires");?>"><i class="fa fa-arrow-right col-blue-grey"></i><br>Voir les accessoires en stock</a></div>
							<div class="content">
								<div class="text">Inventaire de stock</div>
								<div class="number"></div>
							</div>
						</div>
					</div> 
											
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="info-box-4 hover-zoom-effect">
							<div class="icon"><a href="<?php echo site_url("laboratoire/liste_sortie_accessoire");?>"><i class="fa fa-list col-blue-grey"></i><br>Les sorties en stock</a></div>
							<div class="content">
								<div class="text">Inventaire de stock</div>
								<div class="number"></div>
							</div>
						</div>
					</div> 				
					
					
				</div>
				<!-- #END# Tabs With Custom Animations -->
          
            </div>
            
            <div role="tabpanel" class="tab-pane page-calendar" id="sales">
				<div class="block-header">
					<h2>Gestion du stock</h2>
					<small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
				</div>
				
				<!-- Tabs With Custom Animations -->
				<div class="row clearfix">			
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="info-box-4 hover-zoom-effect">
							<div class="icon"><a href="<?php echo site_url("laboratoire/entree_reactif");?>"><i class="fa fa-sign-in col-blue-grey"></i><br>Entrée réactif</a></div>
							<div class="content">
								<div class="text">Nouvelle entrée en stock</div>
								<div class="number"></div>
							</div>
						</div>
					</div> 				
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="info-box-4 hover-zoom-effect">
							<div class="icon"><a href="<?php echo site_url("laboratoire/historique_reactif");?>"><i class="fa fa-sign-in col-blue-grey"></i><br>Historique entrée réactif</a></div>
							<div class="content">
								<div class="text">Inventaire de stock</div>
								<div class="number"></div>
							</div>
						</div>
					</div> 			
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="info-box-4 hover-zoom-effect">
							<div class="icon"><a href="<?php echo site_url("laboratoire/stock_reactif");?>"><i class="fa fa-sign-in col-blue-grey"></i><br>Stock des réactifs</a></div>
							<div class="content">
								<div class="text">Inventaire de stock</div>
								<div class="number"></div>
							</div>
						</div>
					</div> 				
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="info-box-4 hover-zoom-effect">
							<div class="icon"><a href="<?php echo site_url("laboratoire/destock_reactif");?>"><i class="fa fa-sign-in col-blue-grey"></i><br>Réactifs destockés</a></div>
							<div class="content">
								<div class="text">Inventaire de stock</div>
								<div class="number"></div>
							</div>
						</div>
					</div> 					
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="info-box-4 hover-zoom-effect">
							<div class="icon"><a href="<?php echo site_url("laboratoire/sortie_reactif");?>"><i class="fa fa-sign-in col-blue-grey"></i><br>Historique des sorties des réactifs</a></div>
							<div class="content">
								<div class="text">Inventaire de stock</div>
								<div class="number"></div>
							</div>
						</div>
					</div>
					
				</div>
				<!-- #END# Tabs With Custom Animations -->
                
            </div>  
			       
        </div>
    </div>
</section>
        
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
 
<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
	
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DES RESSOURCES HUMAINES</h4>
            </div>
            <div class="modal-body text-center"> Employé ajouté avec succès <br><img src="<?php echo base_url("assets/images/icons8-attendance-50.png");?>"/></div>
            <div id="refresh"></div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>