	
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_pharmacie->liste_entrees(); ?>
<?php $listeassurance = $this->md_parametre->liste_assureurs_actifs(); ?>
<?php $listetype = $this->md_parametre->liste_type_couverture_assurance_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
                    <div class="header">
                        <h2>Effectuez une vente</h2>
                        <?php //var_dump($liste); ?>
                    </div>
                    <div class="body table-responsive">
						<form id="form-vendre">
							<div id="reception"></div>
							<table class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th colspan="4">Code à barre du produit *</th>
										<th colspan="2" style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
									</tr>
									<tr>
										<td colspan="4">
											<input style="width:100%" type="text" name="" id="libCode" />
											<span style="color:red" id="retour" class="retour"></span>
											<input style="" type="hidden" name="" id="prod" />
											<input style="" type="hidden" name="" id="seuil" />
											<input style="" type="hidden" name="" id="pu" />
											<input style="" type="hidden" name="" id="ach" />
										</td>
									
										<td colspan="2" class="text-center">
											<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey cacher" id="addFictif"><i class="fa fa-plus"></i></a>
										</td>
									</tr>									
									<tr>
										<th>Produit *</th>
										<th style="width:100px" class="text-center">PU (Fcfa) *</th>
										<th style="width:100px" class="text-center">Quantité *</th>
										<th style="width:200px"  class="text-center">Montant (Fcfa) </th>
										<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
									</tr>
								</thead>
							   
								<tbody id="tbody"></tbody>
								<tfoot>
									<tr>
										<td colspan="6" class="text-right">
											<strong>Total à payer:</strong> <input type="text" id="tfooter" name="montantTotal" placeholder="0"  readonly />										
										</td>
									</tr>										
									<tr>
										<td colspan="6" class="text-right">
											<strong>Type de paiement:</strong> 
											<select name="typePaie" id="select" style="width:180px;padding-top:5px;padding-bottom:5px;">
												<option value="comptant">comptant</option>
												<option value="bonpharmacie">bon pharmacie</option>
												<option value="assurance">assurance</option>
											</select>										
										</td>
									</tr>									
									<tr id="assu" class="cacher">
										<td colspan="6" class="text-right">
											<select name="ass" style="width:180px;padding-top:5px;padding-bottom:5px;">
												<option value="">----- assureur -----</option>
												<?php foreach($listeassurance AS $la){?>
												<option value="<?=$la->ass_id;?>"><?=$la->ass_sLibelle;?></option>
												<?php }?>
											</select>								
											
											<select name="tas" id="type" style="width:180px;padding-top:5px;padding-bottom:5px;">
												<option value="">----- Type d'assurance -----</option>
												<?php foreach($listetype AS $t){?>
												<option value="<?=$t->tas_id."-/-".$t->tas_iTaux;?>"><?=$t->tas_sLibelle;?></option>
												<?php }?>
											</select><br>
											<span id="mess"></span>
											 <input type="hidden" id="montantAss" name="montantAss" />									
										</td>
									</tr>	
									
									<tr id="client" class="cacher">
										<td colspan="6" class="text-right">
											<strong>N° de Bon de pharmacie:</strong> <input type="text" id="bon" name="bon" />
											<br>
											<span class="retourBon" style="color:red"></span>
										</td>
									</tr>
									
								</tfoot>
							</table>
						</form>
						<a href="javascript:();" class="btn btn-success waves-effect vendre pull-right" style="color:#fff"><i class="fa fa-check"></i> Valider</a>
                    </div>
                </div>
			</div>
        </div>
		<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
    </div>
</section>

<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE D'ADMINISTRATION APP</h4>
            </div>
            <div class="modal-body text-center"> salle(s) enregistée(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
	
	
		// function prixUnitaire(){
			// var med = document.getElementById('lib').value;
			// var tab = med.split("-/-");
				// var prix = tab[2];
				// document.getElementById('pu').value = prix;
				
			// var qte = document.getElementById('qte').value;
			// var taux = document.getElementById('remise').value;
			
			// var montantRemise = (prix * taux)/100;
			// var montantTot = (prix - montantRemise)*qte;
			
			// document.getElementById('montant').value = montantTot;
			
			// var quantite = tab[3];
			// document.getElementById('qte').setAttribute("max",quantite);
			
		// }
		
		// function leMontantTotal(){
			// var seuil = document.getElementById('seuil').value;
			// var quantite = parseInt(seuil);
			
			// var prix = document.getElementById('pu').value;
			// document.getElementById('montant').value = prix;
				
			// var qte = parseInt(document.getElementById('qte').value);
			// var qte2 = parseInt(document.getElementById('qte').value);
			// var taux = parseInt(document.getElementById('remise').value);
			
			// if(qte > quantite){	
				// qte = quantite;
				// document.getElementById('qte').value = qte;
			// }
			// else{
				// qte = qte2;
				// document.getElementById('qte').value = qte;
			// }
			// var montantRemise = (prix * taux)/100;
			// var montantTot = (prix - montantRemise)*qte;
			
			// document.getElementById('montant').value = montantTot;
			
		// }
		
		
		// function resteApayer(){
			// var montantTotal = document.getElementById('tfooter').value;
			// var tab = montantTotal.split(" ");
			// var montantPaye = parseInt(document.getElementById('montantPaye').value);
			
			// document.getElementById('reste').value = tab[0]-montantPaye+" Fcfa";
			
			// var reste = document.getElementById('reste').value;
			// var montantReste =  reste.split(" ");
			
			// if(montantReste[0]==0){
				// document.getElementById('reste').setAttribute("style","color:green");
			// }
			// else{
				// document.getElementById('reste').setAttribute("style","color:red");
			// }
		// }
		
		
		
        // var retour = document.querySelector('#retour');
        // var reception = document.querySelector('#reception');
        // var listeSal = document.querySelector('#tbody');
        // var addSal = document.querySelector('#addSal');
        // var annuaire;
        // var annuaireCode;
        // annuaire = new Array();
        // annuaireCode = new Array();

        // function removeCat(index) {
            // annuaire.splice(index,1);
            // showListeSal();	
        // }

        // function addDetailSal() 
        // {
           
            // var code 	        = document.getElementById('libCode').value;
        
			
			// var contactCode = new Object();
			// contactCode.code	    = code;
			// annuaireCode.push(contactCode);
			// var barre = annuaireCode.length;
			 // var content="";
			 // var message =0;
			 // var verif = "";

			// for(var j = 0; j < barre; j++) {
				// if(verif != annuaireCode[j].code){
					// content += '<input type="hidden" name="code[]" value="'+ annuaireCode[j].code +'"/>';
					// verif= annuaireCode[j].code;
					// message=0;
				// }
				// else{
					// message++;
				// }
			// }
		
			// reception.innerHTML = content;
				
			// if(message == 0){
				// var pu 	            = document.getElementById('pu').value;
				// var qte 	        = 1;
				// var montant 	    = pu;
				// var lib 	        = document.getElementById('prod').value;
				 
				 
				// var contact = new Object();
				// contact.lib	        = lib;
				// contact.qte	        = qte;
				// contact.pu	        = pu;
				// contact.montant	    = montant;
				// annuaire.push(contact);
				// showListeSal();	
				// document.getElementById('libCode').value='';
			// }
			// else{
				// retour.innerHTML = "Code à barre déjà utilisé";
			// }	
        // }

        // addSal.addEventListener('click', addDetailSal);

        // function showListeSal() 
        // {
            // var contenu="";
            // var tailleTableau = annuaire.length;            
            // var somme = 0;
			
			// var verif2 = "";
			// var infiltre = "";
			// var espion = new Array();
			// var sandrine =0;
            // for(var i = 0; i < tailleTableau; i++) {
				// if(verif2 != annuaire[i].lib){
					// contenu += '<tr>';
					// contenu += '<td>' + annuaire[i].lib + '</td>';
					// contenu += '<td><input type="hidden" name="pu[]" value="'+ annuaire[i].pu+'"/>' + annuaire[i].pu + ' Fcfa</td>';
					// contenu += '<td><input type="text" name="qte[]" id="qte'+i+'" value="'+ annuaire[i].qte+'"  readonly /></td>';
					// contenu += '<td><input type="hidden" name="montant[]" value="'+ annuaire[i].montant+'"/>' + annuaire[i].montant + ' Fcfa</td>';
					// contenu += '<td class="text-center"><a href="javascript:();" onClick="removeCat(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
					// contenu += '</tr>';
					// verif2=annuaire[i].lib;
					// sandrine =0;
				// }
				// else{
					// sandrine++;
					// var id = i-1;
					// var quantite = document.getElementById('qte'+id).value;
					// var result = parseInt(quantite)+1;
					// annuaire[i].qte = annuaire[i].qte + 1;
					// espion=result;
					// infiltre = id;
					// espion.push(id+" "+annuaire[i].lib);
					// alert(espion.length);
				// }
				
				// somme = somme + parseInt(annuaire[i].montant);
            // }
			
            // listeSal.innerHTML = contenu;
			
			// alert(espion.length);
			// if(sandrine!=0){
				// document.getElementById('qte'+infiltre).value = espion;
			// }
			
			// for(var j=0; j<espion.length;j++){
				// alert(espion[j]);
			// }
			
			
			// var somme = [];
			
			// for(var j=0; j<tableau.length;j++){
				// tableau[j]+=tableau[j];
				// somme[] = tableau[j];
			// }
			
			// document.getElementById('tfooter').value=somme +" Fcfa";
			
			// alert(contenu);
        // }
    
        </script>


<?php include("includes/footer.php"); ?>