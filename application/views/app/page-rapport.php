
<?php include("includes/header.php"); ?>
<?php $listeDirect = $this->md_parametre->liste_unites_actifs(); ?>
<?php $liste = $this->md_parametre->liste_services_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">Paramètrage du modèle de rapport </h2><button style="" type="button" class="btn bg-blue-grey waves-effect ajout_service pull-right" style="color:#fff"><i class="fa fa-plus"></i> <b>Ajouter un nouveau</b></button>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation de la direction</th>
									<th>Direction</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<span class="champs_ser<?php echo $l->ser_id ?>"><?php echo $l->ser_sLibelle; ?></span>
										<form id='form-edit-ser<?php echo $l->ser_id ?>'>
											<textarea class="cacher input_ser<?php echo $l->ser_id ?>" style='width:100%' name='lib'><?php echo $l->ser_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->ser_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->ser_sLibelle ?>" name="nom"/>
										</form>
									</td>
									<td>
										<span class="champs_dep<?php echo $l->ser_id ?>"><?php echo $l->dep_sLibelle; ?></span>
										<form id='form-edit_dep<?php echo $l->ser_id ?>'>
											<select class="cacher input_dep<?php echo $l->ser_id ?>" name="dep" style="width:100%;padding-bottom:10px;padding-top:10px">
												<?php foreach($listeDirect AS $d){ ?>
												<option value="<?php echo $d->dep_id; ?>-/-<?php echo $d->dep_sLibelle; ?>" <?php if($d->dep_id == $l->dep_id){echo "selected='selected'";} ?>><?php echo $d->dep_sLibelle; ?></option>
												<?php } ?>
											</select>
										</form>
									</td>
									<td class="text-center">
										<a href="javascript:();" rel="<?php echo $l->ser_id; ?>" class="editServiceFinal confirm_ser<?php echo $l->ser_id; ?> cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="<?php echo $l->ser_id; ?>" class="editServiceAnnule annule_ser<?php echo $l->ser_id; ?> text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="<?php echo $l->ser_id; ?>" class="editService clique_ser<?php echo $l->ser_id; ?>" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer ce service ?')" href="<?php echo site_url("parametre/supprimer_service/".$l->ser_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="margin-top:20px; max-width:70%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:500px; overflow:auto;">
			
				 <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="header">
							<h2>Faire un modèle de rapport</h2>
							
						</div>
						<div class="body table-responsive">
							<form id="form-ser">
								<table style="border:none" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:48%;border:none">Titre du rapport</th>
											<th  colspan="2" style="width:48%;border:none">Unité</th>
											
										</tr>
										<tr>
											<td style="border:none">
												<input type="text" name="titre" style="width:100%" placeholder="Saisissez le titre du rapport"/>
												
											</td>
											<td colspan="2" style="border:none">
												<select id="dep" style="width:100%;padding-bottom:5px;padding-top:5px">
													<option value="">----- Choisissez l'unité * -----</option>
													<?php foreach($listeDirect AS $d){ ?>
													<option value="<?php echo $d->uni_id; ?>"><?php echo $d->uni_sLibelle; ?></option>
													<?php } ?>
												</select>
											</td>
											
										</tr>
									</thead>
								</table>
								<table class="table table-bordered table-striped table-hover">	
									<thead>
										<tr>
											<th style="width:70%">Soustitre</th>
											<th style="width:30%"  class="text-center"><i class="fa fa-wrench"></i></th>
										</tr>
										<tr>
											<td>
												<input type="text" id="sous" style="width:100%" placeholder="Saisissez le sous titre"/>
												
											</td>
											
											<td class="text-center">
												<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addSous"><i class="fa fa-plus"></i></a>
											</td>
										</tr>
									</thead>
								   
									<tbody id="tbody"></tbody>
								</table>
							</form>
							
						</div>
					</div>
				</div>
			
			</div>
            <div class="modal-footer">
                <a href="javascript:();" class="btn btn-success waves-effect addSer" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
<!-- For Material Design Colors -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left:70px" id="defaultModalLabel">SERVICE DES RESSOURCES HUMAINES</h4>
            </div>
            <div class="modal-body text-center"> Service(s) enregisté(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeSous = document.querySelector('#tbody');
        var addSous = document.querySelector('#addSous');
        var annuaireSous;
        annuaireSous = new Array();
		var annuaireListeNum = new Array();

        function removeSous(index) {
            annuaireSous.splice(index,1);
            showListeSous();	
        }

        function ajoutListeNum(index) {
           var li = index;	
		   alert(li);
		   var contactListeNum = new Object();
			contactListeNum.li	        = li;
			annuaireListeNum.push(contactListeNum);
			showListeNum();
        }

        function addDetailSous() 
        {
            var sous 	         = document.getElementById('sous').value;
            if(sous == '') {
                alert('Veuillez le champs sous titre.');	
            }
            else {
                var contactSous = new Object();
                contactSous.sous	        = sous;
                annuaireSous.push(contactSous);
                showListeSous();	
				document.getElementById('sous').value="";
            }
        }

        addSous.addEventListener('click', addDetailSous);

        function showListeSous() 
        {
            var contenuSous="";
            var tailleTableauSous = annuaireSous.length;            
                
            for(var i = 0; i < tailleTableauSous; i++) {
				var id=i+1;
                contenuSous += '<tr>';
                contenuSous += '<td><input type="hidden" name="sous[]" value="'+ annuaireSous[i].sous+'"/><h6><span style="text-decoration:underline">Sous titre ' +id+' </span>: '+ annuaireSous[i].sous + '</h6><ol id="s_'+i+'"></ol></td>';
                contenuSous += '<td class="text-center"><a href="javascript:();" onClick="ajoutListeNum(' + i + ')" ><i class="fa fa-plus text-primary" style="font-size:20px"></i> Liste</a> &nbsp;';
                contenuSous += '<a href="javascript:();" onClick="removeSous(' + i + ')" class="delete" title="Supprimer text-danger"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i>&nbsp; supprimer</a> </td>';
                contenuSous += '</tr>';
				// alert(id);
            }
            listeSous.innerHTML = contenuSous;
			// alert(contenu);
        }
    
        function showListeNum() 
        {
            var contenuNum="";
            var tailleTableauListeNum = annuaireListeNum.length;            
			var valeur="";
            for(var j = 0; j < tailleTableauListeNum; j++) {
                contenuNum += '<li><input type="text" style="width:65%" name="listeNum[]"/> <a href="javascript:();" onClick="ajoutListePuce(' + j + ')" ><i class="fa fa-plus text-primary" style="font-size:20px"></i> Liste puce</a> &nbsp; <a href="javascript:();" onClick="removeListeNum(' + j + ')" class="delete text-danger" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i>&nbsp; supprimer</a> <br><ul id="p_'+j+'"></ul></li><br>';
				valeur = annuaireListeNum[j].li;
			}
			
            document.getElementById("s_"+valeur).innerHTML = contenuNum;
			// alert(valeur);
        }
    
        </script>


<?php include("includes/footer.php"); ?>