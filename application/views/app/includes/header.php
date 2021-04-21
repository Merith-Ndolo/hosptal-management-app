<?php 
	if(!isset($_SESSION["medicalis"])){
		redirect();
	}
	
	$user = $this->md_connexion->personnel_connect();
	
	date_default_timezone_set('Africa/Brazzaville');
	$heure = date('H');
	if($heure>=4 AND $heure<=15){
		$salut = "Bonjour";
	}
	else{
		$salut = "Bonsoir";
	}
	
	$page = $this->uri->segment(1);
	$sousPage = $this->uri->segment(2);
	
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Médicalis - Hopital de louandjili</title>
<link rel="icon" href="favicon.ico');?>" type="image/x-icon">
<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/plugins/morrisjs/morris.css');?>" rel="stylesheet" />
<!-- Custom Css -->
<link href="<?php echo base_url('assets/css/main.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/font-awesome.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/icon.css');?>" rel="stylesheet">
<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="<?php echo base_url('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css');?>" rel="stylesheet" />
<!-- Dropzone Css -->
<link href="<?php echo base_url('assets/plugins/dropzone/dropzone.css');?>" rel="stylesheet">
<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css');?>" rel="stylesheet" />
<!-- Wait Me Css -->
<link href="<?php echo base_url('assets/plugins/waitme/waitMe.css');?>" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.css');?>" rel="stylesheet" />

<link href="<?php echo base_url('assets/css/themes/all-themes.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/plugins/fullcalendar/fullcalendar.min.css');?>" rel="stylesheet">


  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/froala_editor.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/froala_style.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/plugins/code_view.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/plugins/image_manager.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/plugins/image.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/plugins/table.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/plugins/video.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/editeur/css/codemirror.min.css');?>">

<script>
	var deconnexion = <?php echo json_encode(site_url('authentification/deconnexion')); ?>;
	var noti = <?php echo json_encode(site_url('app/listNotifications')); ?>;
	var nbNoti = <?php echo json_encode(site_url('app/nbNotifications')); ?>;
	var listeSpecialitePoste = <?php echo json_encode(site_url('personnel/listeSpecialitePoste')); ?>;
	var listeFonctionPoste = <?php echo json_encode(site_url('personnel/listeFonctionPoste')); ?>;
	var ajoutPersonnel = <?php echo json_encode(site_url('personnel/ajoutPersonnel')); ?>;
	var personnel = <?php echo json_encode(site_url('personnel/nouveau')); ?>;
	var editAvatarPersonnel = <?php echo json_encode(site_url('personnel/editAvatarPersonnel')); ?>;
	var editComptePersonnel = <?php echo json_encode(site_url('personnel/editComptePersonnel')); ?>;
	var ajoutDepartement = <?php echo json_encode(site_url('parametre/ajoutDepartement')); ?>;
	var modifierDirection = <?php echo json_encode(site_url('parametre/modifierDirection')); ?>;
	var ajoutAssureur = <?php echo json_encode(site_url('parametre/ajoutAssureur')); ?>;
	var modifierAssureur = <?php echo json_encode(site_url('parametre/modifierAssureur')); ?>;
	var ajoutTypeAssurance = <?php echo json_encode(site_url('parametre/ajoutTypeAssurance')); ?>;
	var modifierTypeAssurance = <?php echo json_encode(site_url('parametre/modifierTypeAssurance')); ?>;
	var ajoutService = <?php echo json_encode(site_url('parametre/ajoutService')); ?>;
	var modifierService = <?php echo json_encode(site_url('parametre/modifierService')); ?>;	
	var ajoutUnite = <?php echo json_encode(site_url('parametre/ajoutUnite')); ?>;
	var modifierUnite = <?php echo json_encode(site_url('parametre/modifierUnite')); ?>;
	var listeServiceDirection = <?php echo json_encode(site_url('parametre/listeServiceDirection')); ?>;
	var listeServiceDirection2 = <?php echo json_encode(site_url('parametre/listeServiceDirection2')); ?>;
	var listePosteType = <?php echo json_encode(site_url('parametre/listePosteType')); ?>;
	var listePosteType2 = <?php echo json_encode(site_url('parametre/listePosteType2')); ?>;
	var ajoutDomaine = <?php echo json_encode(site_url('parametre/ajoutDomaine')); ?>;
	var modifierDomaine = <?php echo json_encode(site_url('parametre/modifierDomaine')); ?>;
	var ajoutSpecialite = <?php echo json_encode(site_url('parametre/ajoutSpecialite')); ?>;
	var modifierSpecialite = <?php echo json_encode(site_url('parametre/modifierSpecialite')); ?>;
	var ajoutAct = <?php echo json_encode(site_url('parametre/ajoutAct')); ?>;
	var listeUniteActe = <?php echo json_encode(site_url('parametre/listeUniteActe')); ?>;
	var modifierAct = <?php echo json_encode(site_url('parametre/modifierAct')); ?>;
	var ajoutFonction = <?php echo json_encode(site_url('parametre/ajoutFonction')); ?>;
	var modifierFonction = <?php echo json_encode(site_url('parametre/modifierFonction')); ?>;
	var listeUniteService = <?php echo json_encode(site_url('parametre/listeUniteService')); ?>;
	var listeUniteService2 = <?php echo json_encode(site_url('parametre/listeUniteService2')); ?>;
	var listedetail = <?php echo json_encode(site_url('parametre/listedetail')); ?>;
	var ajoutPatient = <?php echo json_encode(site_url('patient/ajoutPatient')); ?>;
	var antecedants = <?php echo json_encode(site_url('patient/complement')); ?>;
	var ajoutComplement = <?php echo json_encode(site_url('patient/ajoutComplement')); ?>;
	var listePatient = <?php echo json_encode(site_url('patient/liste')); ?>;
	var orientation = <?php echo json_encode(site_url('patient/accueil')); ?>;
	var ajoutOrientation = <?php echo json_encode(site_url('patient/ajoutOrientation')); ?>;
	var ensembleFacture = <?php echo json_encode(site_url('caisse/ensembleFacture')); ?>;
	var chargeAssurance = <?php echo json_encode(site_url('caisse/chargeAssurance')); ?>;
	var ajoutFactureCaisse = <?php echo json_encode(site_url('caisse/ajoutFactureCaisse')); ?>;
	var detailFacture = <?php echo json_encode(site_url('facture/detail')); ?>;
	var modifStructure = <?php echo json_encode(site_url('parametre/modifStructure')); ?>;
	var editBanque = <?php echo json_encode(site_url('parametre/editBanque')); ?>;
	var modifierPatient = <?php echo json_encode(site_url('patient/modifierPatient')); ?>;
	var afficheStatut = <?php echo json_encode(site_url('personnel/afficheStatut')); ?>;
	var ajoutAffectation = <?php echo json_encode(site_url('personnel/ajoutAffectation')); ?>;
	var listeFonctionPoste2 = <?php echo json_encode(site_url('parametre/listeFonctionPoste2')); ?>;
	var ajoutConstante = <?php echo json_encode(site_url('consultation/ajoutConstante')); ?>;
	var ajoutConsultation = <?php echo json_encode(site_url('consultation/ajoutConsultation')); ?>;
	var modifConsultation = <?php echo json_encode(site_url('consultation/modifConsultation')); ?>;
	var modifConsultation = <?php echo json_encode(site_url('consultation/modifConsultation')); ?>;
	var recupConstante = <?php echo json_encode(site_url('consultation/recupConstante')); ?>;
	var recupConstante2 = <?php echo json_encode(site_url('hospitalisation/recupConstante2')); ?>;
	var ajoutActeInfirmier2 = <?php echo json_encode(site_url('hospitalisation/ajoutActeInfirmier2')); ?>;
	var ajoutActeImagerie2 = <?php echo json_encode(site_url('hospitalisation/ajoutActeImagerie2')); ?>;
	var ajoutLabo2 = <?php echo json_encode(site_url('hospitalisation/ajoutLabo2')); ?>;
	var ajoutActeReeducation2 = <?php echo json_encode(site_url('hospitalisation/ajoutActeReeducation2')); ?>;
	var ajoutActeExp2 = <?php echo json_encode(site_url('hospitalisation/ajoutActeExp2')); ?>;
	var recupConsultation = <?php echo json_encode(site_url('consultation/recupConsultation')); ?>;
	var ajoutOrdonnance = <?php echo json_encode(site_url('consultation/ajoutOrdonnance')); ?>;
	var recupOrdonnance = <?php echo json_encode(site_url('consultation/recupOrdonnance')); ?>;
	var recupActeImagerie = <?php echo json_encode(site_url('consultation/recupActeImagerie')); ?>;
	var ajoutActeInfirmier = <?php echo json_encode(site_url('consultation/ajoutActeInfirmier')); ?>;
	var ajoutInformation = <?php echo json_encode(site_url('consultation/ajoutInformation')); ?>;
	var recupInformation = <?php echo json_encode(site_url('consultation/recupInformation')); ?>;
	var recupSoinsInfim = <?php echo json_encode(site_url('consultation/recupSoinsInfim')); ?>;
	var rapport_consultation = <?php echo json_encode(site_url('consultation/rapport_consultation')); ?>;
	var ajoutActeImagerie = <?php echo json_encode(site_url('consultation/ajoutActeImagerie')); ?>;
	var ajoutCategorieProduit = <?php echo json_encode(site_url('parametre/ajoutCategorieProduit')); ?>;
	var ajoutFamilleProduit = <?php echo json_encode(site_url('parametre/ajoutFamilleProduit')); ?>;
	var modifierFamilleProduit = <?php echo json_encode(site_url('parametre/modifierFamilleProduit')); ?>;
	var ajoutFormeProduit = <?php echo json_encode(site_url('parametre/ajoutFormeProduit')); ?>;
	var modifierFormeProduit = <?php echo json_encode(site_url('parametre/modifierFormeProduit')); ?>;
	var modifierTypeFournisseur = <?php echo json_encode(site_url('parametre/modifierTypeFournisseur')); ?>;
	var ajoutTypeFournisseur = <?php echo json_encode(site_url('parametre/ajoutTypeFournisseur')); ?>;
	var ajoutSalle = <?php echo json_encode(site_url('parametre/ajoutSalle')); ?>;
	var modifierSalle = <?php echo json_encode(site_url('parametre/modifierSalle')); ?>;
	var ajoutArmoire = <?php echo json_encode(site_url('parametre/ajoutArmoire')); ?>;
	var modifierArmoire = <?php echo json_encode(site_url('parametre/modifierArmoire')); ?>;
	var ajoutLigne = <?php echo json_encode(site_url('parametre/ajoutLigne')); ?>;
	var ajoutFournisseur = <?php echo json_encode(site_url('pharmacie/ajoutFournisseur')); ?>;
	var listeVillePays = <?php echo json_encode(site_url('parametre/listeVillePays')); ?>;
	var modifFournisseur = <?php echo json_encode(site_url('pharmacie/modifFournisseur')); ?>;
	var ajoutProduit = <?php echo json_encode(site_url('pharmacie/ajoutProduit')); ?>;
	var modifProduit = <?php echo json_encode(site_url('pharmacie/modifProduit')); ?>;
	var entreeStock = <?php echo json_encode(site_url('pharmacie/entreeStock')); ?>;
	var listeArmoireSalle = <?php echo json_encode(site_url('parametre/listeArmoireSalle')); ?>;
	var listeCelluleArmoire = <?php echo json_encode(site_url('parametre/listeCelluleArmoire')); ?>; 
	var effectuerVente = <?php echo json_encode(site_url('pharmacie/effectuerVente')); ?>;
	var ajoutClient = <?php echo json_encode(site_url('pharmacie/ajoutClient')); ?>;
	var modifierClient = <?php echo json_encode(site_url('pharmacie/modifierClient')); ?>;
	var ajoutBon = <?php echo json_encode(site_url('pharmacie/ajoutBon')); ?>;
	var effectuerCommnde = <?php echo json_encode(site_url('pharmacie/effectuerCommnde')); ?>;
	var entreeStock_2 = <?php echo json_encode(site_url('pharmacie/entreeStock_2')); ?>;
	var recupDetailStock = <?php echo json_encode(site_url('pharmacie/recupDetailStock')); ?>;
	var recupSalle = <?php echo json_encode(site_url('pharmacie/recupSalle')); ?>;
	var recupArmoir = <?php echo json_encode(site_url('pharmacie/recupArmoir')); ?>;
	var recupCellule = <?php echo json_encode(site_url('pharmacie/recupCellule')); ?>;
	var editEntreeStock = <?php echo json_encode(site_url('pharmacie/editEntreeStock')); ?>;
	var destockage = <?php echo json_encode(site_url('pharmacie/destockage')); ?>;
	var traiter = <?php echo json_encode(site_url('infirmerie/traiter')); ?>;
	var assignation = <?php echo json_encode(site_url('infirmerie/assignation')); ?>;
	var ajoutChambre = <?php echo json_encode(site_url('parametre/ajoutChambre')); ?>;
	var recupProduit = <?php echo json_encode(site_url('pharmacie/recupProduit')); ?>;
	var recupBon = <?php echo json_encode(site_url('pharmacie/recupBon')); ?>;
	var vide = <?php echo json_encode(site_url('pharmacie/vide')); ?>;
	var recupFictif = <?php echo json_encode(site_url('pharmacie/recupFictif')); ?>;
	var recupSommeTotal = <?php echo json_encode(site_url('pharmacie/recupSommeTotal')); ?>;
	var suppFictif = <?php echo json_encode(site_url('pharmacie/suppFictif')); ?>;
	var ajoutCompteRendu = <?php echo json_encode(site_url('imagerie/ajoutCompteRendu')); ?>;
	var ajoutCompteRenduExp = <?php echo json_encode(site_url('exploration/ajoutCompteRendu')); ?>;
	var listeActeExploration = <?php echo json_encode(site_url('exploration/acte_recu')); ?>;
	var listeChambreUniteDispo = <?php echo json_encode(site_url('parametre/listeChambreUniteDispo')); ?>;
	var listeLitChambreDispo = <?php echo json_encode(site_url('parametre/listeLitChambreDispo')); ?>;
	var ajoutHospitalisation = <?php echo json_encode(site_url('consultation/ajoutHospitalisation')); ?>;
	var recupHospitalisation = <?php echo json_encode(site_url('consultation/recupHospitalisation')); ?>;
	var recupActeExp = <?php echo json_encode(site_url('consultation/recupActeExp')); ?>;
	var ajoutActeExp = <?php echo json_encode(site_url('consultation/ajoutActeExp')); ?>;
	var ajoutActeReeducation = <?php echo json_encode(site_url('consultation/ajoutActeReeducation')); ?>;
	var ajoutMaladie = <?php echo json_encode(site_url('consultation/ajoutMaladie')); ?>;
	var ajoutReeducation = <?php echo json_encode(site_url('reeducation/ajoutReeducation')); ?>;
	var listeSeance = <?php echo json_encode(site_url('reeducation/assignation')); ?>;
	var recupReeducat = <?php echo json_encode(site_url('consultation/recupReeducat')); ?>;
	var nouveauNe = <?php echo json_encode(site_url('consultation/nouveauNe')); ?>;
	var recupNouveau = <?php echo json_encode(site_url('consultation/recupNouveau')); ?>;
	var casDeces = <?php echo json_encode(site_url('consultation/casDeces')); ?>;
	var recupDeces = <?php echo json_encode(site_url('consultation/recupDeces')); ?>;
	var recupDiagnostic = <?php echo json_encode(site_url('consultation/recupDiagnostic')); ?>;
	var ajoutLabo = <?php echo json_encode(site_url('consultation/ajoutLabo')); ?>;
	var recupLaboratoire = <?php echo json_encode(site_url('consultation/recupLaboratoire')); ?>;
	var ajoutTypeExamen = <?php echo json_encode(site_url('parametre/ajoutTypeExamen')); ?>;
	var modifierTypeExamen = <?php echo json_encode(site_url('parametre/modifierTypeExamen')); ?>;
	var ajoutElementAnalyse = <?php echo json_encode(site_url('parametre/ajoutElementAnalyse')); ?>;
	var ajoutLigneBudget = <?php echo json_encode(site_url('budget/ajoutLigneBudget')); ?>;
	var ajoutAccessoire = <?php echo json_encode(site_url('parametre/ajoutAccessoire')); ?>;
	var modifierAccessoire = <?php echo json_encode(site_url('parametre/modifierAccessoire')); ?>;
	var entreeConsommable = <?php echo json_encode(site_url('laboratoire/entreeConsommable')); ?>;
	var entreeAccessoire = <?php echo json_encode(site_url('laboratoire/entreeAccessoire')); ?>;
	var sortirAccessoire = <?php echo json_encode(site_url('laboratoire/sortirAccessoire')); ?>;
	var sortirAccessoire = <?php echo json_encode(site_url('laboratoire/sortirAccessoire')); ?>;
	var ajoutReactif = <?php echo json_encode(site_url('parametre/ajoutReactif')); ?>;
	var entreeReactif = <?php echo json_encode(site_url('parametre/entreeReactif')); ?>;
	var entreeReac = <?php echo json_encode(site_url('laboratoire/entreeReac')); ?>;
	var destockageReactif = <?php echo json_encode(site_url('laboratoire/destockageReactif')); ?>;
	var ensembleSortie = <?php echo json_encode(site_url('laboratoire/ensembleSortie')); ?>;
	var sortieReactif = <?php echo json_encode(site_url('laboratoire/sortieReactif')); ?>;
	var listeAct = <?php echo json_encode(site_url('caisse')); ?>;
	var prendreRendezVous = <?php echo json_encode(site_url('rdv/prendreRendezVous')); ?>;
	var ajoutTypeCourrier = <?php echo json_encode(site_url('courrier/ajoutTypeCourrier')); ?>;
	var recupCourrier = <?php echo json_encode(site_url('courrier/recupCourrier')); ?>;
	var editTypeCourrier = <?php echo json_encode(site_url('courrier/editTypeCourrier')); ?>;
	var courrierEntrant = <?php echo json_encode(site_url('courrier/courrierEntrant')); ?>;
	var courrierSortant = <?php echo json_encode(site_url('courrier/courrierSortant')); ?>;
	var recupCourrierEntrant = <?php echo json_encode(site_url('courrier/recupCourrierEntrant')); ?>;
	var archivage = <?php echo json_encode(site_url('courrier/archivage')); ?>;
	var ajoutCourrier = <?php echo json_encode(site_url('courrier/ajoutCourrier')); ?>;
	var ajoutCourrierSortant = <?php echo json_encode(site_url('courrier/ajoutCourrierSortant')); ?>;
	var nouveauCourrier = <?php echo json_encode(site_url('courrier/nouveauCourrier')); ?>;
	var listeTypeCourrier = <?php echo json_encode(site_url('courrier/listeTypeCourrier')); ?>;
	var exempleContenuType = <?php echo json_encode(site_url('courrier/exempleContenuType')); ?>;
	var recupCourrierEnvoye = <?php echo json_encode(site_url('courrier/recupCourrierEnvoye')); ?>;
	var editCourrierEnvoye = <?php echo json_encode(site_url('courrier/editCourrierEnvoye')); ?>;
	var ajoutOperation = <?php echo json_encode(site_url('chirurgie/ajoutOperation')); ?>;
</script>

<script src="<?php echo base_url('assets/js/maj.js');?>"></script>
</head>

<body class="theme-blue-grey" <?php if($page=='pharmacie' && $sousPage=="vente_produit"){ ?>onload="chargement()"<?php } ?> <?php if($page=='rdv' && $sousPage=="mesRdv"){ ?>onload="clique()"<?php } ?>>
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-cyan">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Patientez SVP...</p>
    </div>
</div>
<!-- #END# Page Loader --> 
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- 
<ul id="f-menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
  <li class="mfb-component__wrap">
    <a href="#" class="mfb-component__button--main g-bg-cyan">
      <i class="mfb-component__main-icon--resting zmdi zmdi-plus"></i>
      <i class="mfb-component__main-icon--active zmdi zmdi-close"></i>
    </a>
    <ul class="mfb-component__list">
      <li>
        <a href="doctor-schedule.html" data-mfb-label="Doctor Schedule" class="mfb-component__button--child bg-blue">
          <i class="zmdi zmdi-calendar mfb-component__child-icon"></i>
        </a>
      </li>
      <li>
        <a href="patients.html" data-mfb-label="Patients List" class="mfb-component__button--child bg-orange">
          <i class="zmdi zmdi-account-o mfb-component__child-icon"></i>
        </a>
      </li>

      <li>
        <a href="payments.html" data-mfb-label="Payments" class="mfb-component__button--child bg-purple">
          <i class="zmdi zmdi-balance-wallet mfb-component__child-icon"></i>
        </a>
      </li>
    </ul>
  </li>
</ul>
 -->
<!-- 
<div id="morphsearch" class="morphsearch">
    <form class="morphsearch-form">
        <div class="form-group m-0">
            <input value="" type="search" placeholder="Explorez l'hopital..." class="form-control morphsearch-input" />
            <button class="morphsearch-submit" type="submit">Recherche</button>
        </div>
    </form>
    <div class="morphsearch-content">
        <div class="dummy-column">
            <h2>People</h2>
            <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar1.jpg');?>" alt=""/>
            <h3>Sara Soueidan</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar2.jpg');?>" alt=""/>
            <h3>Rachel Smith</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar3.jpg');?>" alt=""/>
            <h3>Peter Finlan</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar4.jpg');?>" alt=""/>
            <h3>Patrick Cox</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar5.jpg');?>" alt=""/>
            <h3>Tim Holman</h3>
            </a></div>
        <div class="dummy-column">
            <h2>Popular</h2>
            <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar5.jpg');?>" alt=""/>
            <h3>Sara Soueidan</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar4.jpg');?>" alt=""/>
            <h3>Rachel Smith</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar1.jpg');?>" alt=""/>
            <h3>Peter Finlan</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar2.jpg');?>" alt=""/>
            <h3>Patrick Cox</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar3.jpg');?>" alt=""/>
            <h3>Tim Holman</h3>
            </a> </div>
        <div class="dummy-column">
            <h2>Recent</h2>
            <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar1.jpg');?>" alt=""/>
            <h3>Sara Soueidan</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar5.jpg');?>" alt=""/>
            <h3>Rachel Smith</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar1.jpg');?>" alt=""/>
            <h3>Peter Finlan</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar4.jpg');?>" alt=""/>
            <h3>Patrick Cox</h3>
            </a> <a class="dummy-media-object" href="#"> <img class="round" src="<?php echo base_url('assets/images/xs/avatar2.jpg');?>" alt=""/>
            <h3>Tim Holman</h3>
            </a></div>
    </div>
     --> 
    <span class="morphsearch-close"></span> </div>
<!-- Top Bar -->
<nav class="navbar clearHeader">
    <div class="col-12">
        <div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand" href="<?php echo site_url("app"); ?>">MÉDICALIS</a> </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- Notifications -->
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" id="not"><i class="zmdi zmdi-notifications"></i> <span class="label-count" id="nbNotifications"></span> </a>
                <ul class="dropdown-menu">
                    <li class="header">NOTIFICATIONS</li>
                    <li class="body">
                        <ul class="menu" id="notifications">
                           
                        </ul>
                    </li>
                    <li class="footer"> <a href="<?php echo site_url("app/notifications"); ?>">Voir toutes les notifications</a> </li>
                </ul>
            </li>
            <!-- #END# Notifications --> 
            <!-- Tasks -->
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-email"></i><span class="label-count" style="background:red">9</span> </a> </li>
            <li class="dropdown"> <a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="fa  fa-comments-o" style="font-size:18px"></i><span class="label-count" style="background:green">9</span> </a> </li>
          
        </ul>
    </div>
</nav>
<!-- #Top Bar -->
<section> 
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar"> 
        <!-- User Info -->
        <div class="user-info">
            <div class="admin-image"> <img src="<?php echo base_url($user->per_sAvatar);?>" alt=""> </div>
            <div class="admin-action-info"> <span><?php echo $user->per_sTitre;?> <?php echo $user->per_sNom;?></span>
                <h3></h3>
                <ul>
                    <li><a data-placement="bottom" title="Go to Inbox" href="mail-inbox.html"><i class="zmdi zmdi-email"></i></a></li>
                    <li><a data-placement="bottom" title="Mon compte" href="<?php echo  site_url("app/profil"); ?>"><i class="zmdi zmdi-account"></i></a></li>                    
                    <li><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings"></i></a></li>
                    <li><a data-placement="bottom" title="Déconnexion" href="<?php echo  site_url("authentification/deconnexion"); ?>" ><i class="fa fa-power-off" style="font-size:16px"></i></a></li>
                </ul>
				 <ul>
                    <li>
						<select id="statut1" class="" style="font-size:14px">
							<option value="">Changer statut</option>
							<option value="Présent(e)">Présent(e)</option>
							<option value="Absent(e)">Absent(e)</option>
						</select>
						
					</li>
                   
                </ul>
				
				
            </div>
            <div class="quick-stats">
                <h5> </h5>
                <ul>
                    <li><span>16<i>Patient</i></span></li>
                    <li><span>20<i>Panding</i></span></li>
                    <li>
						<span id="RecepStat">
							<?php if($user->per_sStatut == "Présent(e)"){ ?>
							<span class="" style="width:13px;height:13px;border-radius:100%;background:green;display:block;margin:auto;margin-bottom:10px"></span>
							<?php } else if($user->per_sStatut == "Absent(e)"){ ?>
							<span class="" style="width:13px;height:13px;border-radius:100%;background:red;display:block;margin:auto;margin-bottom:10px"></span>
							<?php }  ?>
							<i><?php echo $user->per_sStatut; ?></i>
						</span>
					</li>
                </ul>
				
            </div>
        </div>
        <!-- #User Info --> 
        <!-- Menu -->
        <div class="menu">
			 <ul class="list">
                <li class="header">--Menu principal</li>
				<li class="<?php if($page=="app" AND (!isset($sousPage) OR $sousPage=="index")){echo "active";} ?> open"><a href="<?php echo site_url("app");?>"><i class="zmdi zmdi-home"></i><span>Tableau de bord</span></a></li>
				<?php if($user->per_iTypeCompte==0){ ?>
				
				<?php }elseif($user->per_iTypeCompte==1){ ?>
				<li class="<?php if($page=="consultation"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-user-md"></i><span>Consultation</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="consultation" AND (!isset($sousPage) OR $sousPage=="index")){echo "style='color:#fff'";} ?> href="<?php echo site_url("consultation");?>">Consulter</a></li>
                        <li><a <?php if($page=="patient" AND $sousPage=="liste"){echo "style='color:#fff'";} ?> href="<?php echo site_url("patient/liste");?>">Mes patients</a></li>
                        <li><a <?php if($page=="patient" AND $sousPage=="liste"){echo "style='color:#fff'";} ?> href="<?php echo site_url("patient/liste");?>">Liste de tous les patients</a></li>
                    </ul>
                </li>
					
				<li class="<?php if($page=="hospitalisation"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-bed"></i><span>hospitalisation</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="hospitalisation" AND (!isset($sousPage) OR $sousPage=="index")){echo "style='color:#fff'";} ?> href="<?php echo site_url("hospitalisation");?>">Patients hospitalisés</a></li>
                        <li><a <?php if($page=="hospitalisation" AND $sousPage=="journal"){echo "style='color:#fff'";} ?> href="<?php echo site_url("hospitalisation/journal");?>">journal des passages	</a></li>
                    </ul>
                </li>
				
				<li class="<?php if($page=="exploration"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-heartbeat"></i><span>exploration fonctionnelle</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="exploration" AND $sousPage=="acte_recu"){echo "style='color:#fff'";} ?> href="<?php echo site_url("exploration/acte_recu");?>">Actes reçus</a></li>
                        <li><a <?php if($page=="exploration" AND $sousPage=="clotures"){echo "style='color:#fff'";} ?> href="<?php echo site_url("exploration/clotures");?>">Actes clôturés</a></li>
                    </ul>
                </li>
					
				<?php }elseif($user->per_iTypeCompte==2){ ?>
				<li class="<?php if($page=="pharmacie"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-medkit"></i><span>Pharmacie</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="stock"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/stock");?>">Stock</a></li>
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="vente_produit"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/vente_produit");?>">Caisse</a></li>
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="recu_caisse"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/recu_caisse");?>">Reçus de caisse</a></li>
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="statistique_stock"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/statistique_stock");?>">Statistiques</a></li>
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="compte_client"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/compte_client");?>">Client</a></li>
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="destock"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/destock");?>">Produits destockés</a></li>
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="nouveau_bon"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/nouveau_bon");?>">Bon de commande</a></li>
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="liste_produit"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/liste_produit");?>">Produits / médicaments</a></li>
                        <li><a <?php if($page=="pharmacie" AND $sousPage=="liste_fournisseur"){echo "style='color:#fff'";} ?> href="<?php echo site_url("pharmacie/liste_fournisseur");?>">Fournisseurs</a></li>
                    </ul>
                </li>
				<?php }elseif($user->per_iTypeCompte==3){ ?>
				<li class="<?php if($page=="patient"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-hospital-o"></i><span>Accueil</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="patient" AND $sousPage=="nouveau"){echo "style='color:#fff'";} ?> href="<?php echo site_url("patient/nouveau");?>">Ajouter un patient</a></li>
                        <li><a <?php if($page=="patient" AND $sousPage=="liste"){echo "style='color:#fff'";} ?> href="<?php echo site_url("patient/liste");?>">Liste des patients</a></li>
						
                    </ul>
                </li>
					<li class="<?php if($page=="rdv"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Rendez-vous</span> </a>
					<ul class="ml-menu">
							<li><a <?php if($page=="rdv" AND $sousPage=="prendre"){echo "style='color:#fff'";} ?> href="<?php echo site_url("rdv/prendre");?>">Prendre rendez-vous</a></li>
							<li><a <?php if($page=="rdv" AND $sousPage=="listeRdv"){echo "style='color:#fff'";} ?> href="<?php echo site_url("rdv/listeRdv");?>">Liste des rendez-vous</a></li>
							<li><a <?php if($page=="rdv" AND $sousPage=="listeRdvAnnule"){echo "style='color:#fff'";} ?> href="<?php echo site_url("rdv/listeRdvAnnule");?>">Rendez-vous annulés</a></li>
							<li><a <?php if($page=="rdv" AND $sousPage=="listeRdvValide"){echo "style='color:#fff'";} ?> href="<?php echo site_url("rdv/listeRdvValide");?>">Rendez-vous validés</a></li>
						  
							
					</ul>
				 </li>
				<!-- 
				 <li class="<?php if($page=="courrier"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Courriers</span> </a>
					<ul class="ml-menu">
							<li><a <?php if($page=="courrier" AND $sousPage=="nouveauCourrier"){echo "style='color:#fff'";} ?> href="<?php echo site_url("courrier/nouveauCourrier");?>">Nouveau courrier</a></li>
							<li><a <?php if($page=="courrier" AND $sousPage=="courrierEntrant"){echo "style='color:#fff'";} ?> href="<?php echo site_url("courrier/courrierEntrant");?>">Courriers entrants</a></li>
							<li><a <?php if($page=="courrier" AND $sousPage=="courrierSortant"){echo "style='color:#fff'";} ?> href="<?php echo site_url("courrier/courrierSortant");?>">Courriers sortants</a></li>	
							<li><a <?php if($page=="courrier" AND $sousPage=="archivage"){echo "style='color:#fff'";} ?> href="<?php echo site_url("courrier/archivage");?>">Archives</a></li>	
					</ul>
				 </li>
				 -->
				<?php }elseif($user->per_iTypeCompte==4){ ?>
				<li class="<?php if($page=="patient"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-hospital-o"></i><span>Accueil</span> </a>
                    <ul class="ml-menu">
						<li><a <?php if($page=="caisse"){echo "style='color:#fff'";} ?> href="<?php echo site_url("caisse");?>">Caisse</a></li>
						<li><a <?php if($page=="facture"){echo "style='color:#fff'";} ?> href="<?php echo site_url("facture");?>">Factures de caisses</a></li>
                    </ul>
                </li>
				<!-- 
				<li class="<?php if($page=="budget"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-dollar"></i><span>Lignes budgetaires</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="budget" AND $sousPage=="creation"){echo "style='color:#fff'";} ?> href="<?php echo site_url("budget/creation");?>">créations des lignes budgetaires</a></li>
                        <li><a <?php if($page=="budget" AND $sousPage=="liste"){echo "style='color:#fff'";} ?> href="<?php echo site_url("budget/liste");?>">Liste des budgets</a></li>
						
                    </ul>
                </li>
				-->
				<?php }elseif($user->per_iTypeCompte==5){ ?>
				<li class="<?php if($page=="infirmerie"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-wheelchair"></i><span>Infirmerie</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="infirmerie" AND $sousPage=="assignation"){echo "style='color:#fff'";} ?> href="<?php echo site_url("infirmerie/assignation");?>">Admission aux soins</a></li>
                        <li><a <?php if($page=="infirmerie" AND $sousPage=="patient_traite"){echo "style='color:#fff'";} ?> href="<?php echo site_url("infirmerie/patient_traite");?>">Patients traités</a></li>
                    </ul>
                </li>
				
				<li class="<?php if($page=="hospitalisation"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-bed"></i><span>hospitalisation</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="hospitalisation" AND (!isset($sousPage) OR $sousPage=="index")){echo "style='color:#fff'";} ?> href="<?php echo site_url("hospitalisation");?>">Patients hospitalisés</a></li>
                        <li><a <?php if($page=="hospitalisation" AND $sousPage=="protocole"){echo "style='color:#fff'";} ?> href="<?php echo site_url("hospitalisation/protocole");?>">Protocoles de soin</a></li>
                        <li><a <?php if($page=="hospitalisation" AND $sousPage=="journal"){echo "style='color:#fff'";} ?> href="<?php echo site_url("hospitalisation/journal");?>">journal des passages	</a></li>
                    </ul>
                </li>
				<?php }elseif($user->per_iTypeCompte==6){ ?>
				<li class="<?php if($page=="imagerie"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-heartbeat"></i><span>Imagerie</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="imagerie" AND $sousPage=="acte_recu"){echo "style='color:#fff'";} ?> href="<?php echo site_url("imagerie/acte_recu");?>">Actes reçus</a></li>
                        <li><a <?php if($page=="imagerie" AND $sousPage=="clotures"){echo "style='color:#fff'";} ?> href="<?php echo site_url("imagerie/clotures");?>">Actes clôturés</a></li>
                    </ul>
                </li>
				
				<li class="<?php if($page=="exploration"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-heartbeat"></i><span>exploration fonctionnelle</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="exploration" AND $sousPage=="acte_recu"){echo "style='color:#fff'";} ?> href="<?php echo site_url("exploration/acte_recu");?>">Actes reçus</a></li>
                        <li><a <?php if($page=="exploration" AND $sousPage=="clotures"){echo "style='color:#fff'";} ?> href="<?php echo site_url("exploration/clotures");?>">Actes clôturés</a></li>
                    </ul>
                </li>
						
				
				<?php }elseif($user->per_iTypeCompte==7){ ?>
				<li class="<?php if($page=="laboratoire"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-flask"></i><span>Laboratoire</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="laboratoire" AND $sousPage=="prevelements"){echo "style='color:#fff'";} ?> href="<?php echo site_url("laboratoire/prevelements");?>">Prélévements</a></li>
                        <li><a <?php if($page=="laboratoire" AND $sousPage=="examens"){echo "style='color:#fff'";} ?> href="<?php echo site_url("laboratoire/examens");?>">Examens à faire</a></li>
                        <li><a <?php if($page=="laboratoire" AND $sousPage=="examens_faites"){echo "style='color:#fff'";} ?> href="<?php echo site_url("laboratoire/examens_faites");?>">Examens terminés</a></li>
                       
                        <li><a <?php if($page=="laboratoire" AND $sousPage=="stock"){echo "style='color:#fff'";} ?> href="<?php echo site_url("laboratoire/stock_accessoire");?>">Gestion de stock</a></li>
                    </ul>
                </li>
				<?php }elseif($user->per_iTypeCompte==8){ ?>
				<li class="<?php if($page=="reeducation"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-wheelchair"></i><span>Réeducation</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="reeducation" AND $sousPage=="assignation"){echo "style='color:#fff'";} ?> href="<?php echo site_url("reeducation/assignation");?>">Séances ouvertes</a></li>
                        <li><a <?php if($page=="reeducation" AND $sousPage=="patient_traite"){echo "style='color:#fff'";} ?> href="<?php echo site_url("reeducation/patient_traite");?>">Séances clôturées</a></li>
                    </ul>
                </li>
				<?php }elseif($user->per_iTypeCompte==9){ ?>
				<li class="<?php if($page=="chirurgie") {echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-wheelchair"></i><span>Chirurgie</span></a>
					<ul class="ml-menu">
						<li><a <?php if($page=="chirurgie" AND ($sousPage=="preoperatoire" || $sousPage=="consulter")){echo "style='color:#fff'";} ?> href="<?php echo site_url("chirurgie/preoperatoire");?>">Consultation préopératoire</a></li>
						<li><a <?php if($page=="chirurgie" AND ($sousPage=="planning")){echo "style='color:#fff'";} ?> href="<?php echo site_url("chirurgie/planning");?>">Occupation des salles</a></li>
					</ul>
				</li>
				<?php }elseif($user->per_iTypeCompte==10){ ?>
				<li class="<?php if($page=="personnel"){echo "active";} ?>"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-users"></i><span>Resources humaines</span> </a>
                    <ul class="ml-menu">
                        <li><a <?php if($page=="personnel" AND $sousPage=="nouveau"){echo "style='color:#fff'";} ?> href="<?php echo site_url("personnel/nouveau");?>">Ajouter personnel</a></li>                                               
						<li><a <?php if($page=="personnel" AND ($sousPage=="liste" OR $sousPage=="tout")){echo "style='color:#fff'";} ?> href="<?php echo site_url("personnel/liste");?>">Liste du personnel</a></li>   
						<li><a <?php if($page=="personnel" AND ($sousPage=="direction" OR $sousPage=="service" OR $sousPage=="unite" OR $sousPage=="affectation")){echo "style='color:#fff'";} ?> href="<?php echo site_url("personnel/direction");?>">Affectations</a></li>   
                    </ul>
                </li>
				<?php } ?>
				<li class="<?php if($page=="rdv" AND  $sousPage=="mesRdv"){echo "active";} ?> open"><a href="<?php echo site_url("rdv/mesRdv");?>"><i class="zmdi zmdi-calendar-check"></i><span>Mes rendez-vous</span></a></li>
				<li class="<?php if($page=="parametre"){echo "active";} ?>"><a href="<?php echo site_url("parametre");?>"><i class="zmdi zmdi-settings"></i><span>Paramètre</span> </a></li>
				<li class="<?php if($page=="corbeille"){echo "active";} ?>"><a href="<?php echo site_url("corbeille");?>"><i class="zmdi zmdi-delete"></i><span>Corbeille</span> </a></li>	
				
			</ul>
			
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar --> 
    <!-- Right 
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#chat">Chat</a></li>
        </ul>
        <div class="tab-content">
            
            <div role="tabpanel" class="tab-pane in active in active" id="chat">
                <div class="demo-settings">
                    <div class="search">
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Search..." required autofocus>
                            </div>
                        </div>
                    </div>
                    <h6>Recent</h6>
                    <ul>
                        <li class="online">
                            <div class="media">
                                <a  role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url('assets/images/xs/avatar1.jpg');?>" alt=""> </a>
                                <div class="media-body">
                                    <span class="name">Claire Sassu</span> <span class="message">Can you share the...</span> <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                        <li class="online">
                            <div class="media"> <a  role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url('assets/images/xs/avatar2.jpg');?>" alt=""> </a>
                                <div class="media-body">
                                    <span class="name">Maggie jackson</span> <span class="message">Can you share the...</span> <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                        <li class="online">
                            <div class="media"> <a  role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url('assets/images/xs/avatar3.jpg');?>" alt=""> </a>
                                <div class="media-body">
                                    <span class="name">Joel King</span> <span class="message">Ready for the meeti...</span> <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h6>Contacts</h6>
                    <ul>
                        <li class="offline">
                            <div class="media"> <a  role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url('assets/images/xs/avatar4.jpg');?>" alt=""> </a>
                                <div class="media-body">
                                    <span class="name">Joel King</span> <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                        <li class="online">
                            <div class="media"> <a  role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url('assets/images/xs/avatar1.jpg');?>" alt=""> </a>
                                <div class="media-body">
                                    <span class="name">Joel King</span> <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                        <li class="offline">
                            <div class="media"> <a class="pull-left " role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url('assets/images/xs/avatar2.jpg');?>" alt=""> </a>
                                <div class="media-body">
                                    <span class="name">Joel King</span> <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </aside>
     Sidebar --> 
</section>