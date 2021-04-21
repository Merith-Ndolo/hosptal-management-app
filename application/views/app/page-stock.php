<?php include("includes/header.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Gestion du stock</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
        <div class="row clearfix">
			
			<div class="col-lg-6 col-md-6 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="<?php echo site_url("pharmacie/entree");?>"><i class="fa fa-sign-in col-blue-grey"></i><br>Faire l'opération ici</a></div>
                    <div class="content">
                        <div class="text">Nouvelle entrée en stock</div>
                        <div class="number"></div>
                    </div>
                </div>
            </div>		
			
			<div class="col-lg-6 col-md-6 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="<?php echo site_url("pharmacie/liste_entrees");?>"><i class="fa fa-arrow-right col-blue-grey"></i><br>Voir les produits en stock</a></div>
                    <div class="content">
                        <div class="text">Inventaire de stock</div>
                        <div class="number"></div>
                    </div>
                </div>
            </div> 
									
			
			<div class="col-lg-6 col-md-6 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="<?php echo site_url("pharmacie/produits");?>"><i class="fa fa-list col-blue-grey"></i><br>Voir</a></div>
                    <div class="content">
                        <div class="text">Identifiants produits</div>
                        <div class="number"></div>
                    </div>
                </div>
            </div> 					
			
        </div>
		<!-- #END# Tabs With Custom Animations -->
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
    </div>
</section>


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