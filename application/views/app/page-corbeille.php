
<?php include("includes/header.php"); ?>
<section class="content home" style="min-height:550px">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Corbeille</h2>
            <small class="text-muted">Administrer les composants du fonctionnement de l'application</small>
        </div>
        
        <div class="row clearfix">

			 <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="<?php echo site_url("corbeille/personnel");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a></div>
                    <div class="content">
                        <div class="text">Personnel</div>
                        <div class="number"><?php echo count($this->md_personnel->liste_personnels_supprimes());?></div>
                    </div>
                </div>
            </div>
			 <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="<?php echo site_url("corbeille/patient");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a></div>
                    <div class="content">
                        <div class="text">Patient</div>
                        <div class="number"><?php echo count($this->md_patient->liste_patients_supprimes());?></div>
                    </div>
                </div>
            </div>
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="<?php echo site_url("corbeille/direction");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a></div>
                    <div class="content">
                        <div class="text">Directions</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_departements_supprimes());?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/service");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Services</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_services_supprimes());?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/unite");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Unités</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_unites_supprimees());?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/domaine");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Domaines professionnels</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_postes_supprimes());?></div>
                    </div>
                </div>
            </div>
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/specialite");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Spécialités</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_specialites_supprimees());?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/poste");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Postes des employés</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_fonctions_supprimees());?></div>
                    </div>
                </div>
            </div>
			
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/acte_medical");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Actes médicaux</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_acts_supprimees());?></div>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/assureur");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Assureurs</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_assureurs_supprimes());?></div>
                    </div>
                </div>
            </div>
			
			 <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/type_couverture");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Type de couverture d'assurance</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_type_assurance_supprimes());?></div>
                    </div>
                </div>
            </div>		
   
				<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/categorie_produit");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Catégorie produits</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_categories_produits_supprimes());?></div>
                    </div>
                </div>
            </div>			
			
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/famille_produit");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Famille produits</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_familles_produits_supprimes());?></div>
                    </div>
                </div>
            </div>			
			
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/forme_produit");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Forme produits</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_formes_produits_supprimes());?></div>
                    </div>
                </div>
            </div>			
			
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/type_fournisseur");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Type de fournisseurs</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_formes_produits_supprimes());?></div>
                    </div>
                </div>
            </div>			
			
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/salle");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Salles</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_salle_supprimes());?></div>
                    </div>
                </div>
            </div>			
			
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/armoire");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Armoires</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_armoire_supprimes());?></div>
                    </div>
                </div>
            </div>			
			
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/fournisseur");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Fournisseurs</div>
                        <div class="number"><?php echo count($this->md_parametre->liste_armoire_supprimes());?></div>
                    </div>
                </div>
            </div>			
			
			<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"> <a href="<?php echo site_url("corbeille/client");?>" class="text-danger"><i class="zmdi zmdi-delete col-red"></i><br>Administrer</a> </div>
                    <div class="content">
                        <div class="text">Clients</div>
                        <div class="number"><?php echo count($this->md_pharmacie->liste_client_supprimes());?></div>
                    </div>
                </div>
            </div>
			
        </div>
        
	</div>

</section>
<?php include("includes/footer.php"); ?>