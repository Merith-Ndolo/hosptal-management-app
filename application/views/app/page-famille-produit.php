
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_famille_produit_actifs(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-6 col-md-6 col-sm-12">
				<div class="card">
                    <div class="header">
                        <h2>Ajoutez des nouvelles familles de produits</h2>
                        
                    </div>
                    <div class="body table-responsive">
						<form id="form-fam">
							<table class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Désignation de la famille <a href="javascript:();" class="btn btn-success btn-sm waves-effect addFam" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a></th>
										<th style="width:60px"  class="text-center"><i class="fa fa-wrench"></i></th>
									</tr>
									<tr>
										<td>
											<input type="text" id="lib" style="width:100%" placeholder="Saisissez dans ce champs"/>
										</td>
										<td class="text-center">
											<a href="javascript:();" class="btn btn-sm waves-effect bg-blue-grey" id="addFam"><i class="fa fa-plus"></i></a>
										</td>
									</tr>
								</thead>
							   
								<tbody id="tbody"></tbody>
							</table>
						</form>
						<a href="javascript:();" class="btn btn-success waves-effect addFam" style="color:#fff"><i class="fa fa-check"></i> Enregistrer</a>
                    </div>
                </div>
			</div>
			
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>liste des familles des produits</h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation de la famille</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<span class="champs<?php echo $l->fam_id ?>"><?php echo $l->fam_sLibelle; ?></span>
										<form id='form-edit-fam<?php echo $l->fam_id ?>'>
											<textarea class="cacher input<?php echo $l->fam_id ?>" style='width:100%' name='lib'><?php echo $l->fam_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->fam_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->fam_sLibelle ?>" name="nom"/>
										</form>
									</td>
									<td class="text-center">
										<a href="javascript:();" rel="<?php echo $l->fam_id; ?>" class="editFamilleFinal confirm<?php echo $l->fam_id; ?> cacher" title="Modifier" style="text-decoration:underline">Modifier</a>
										<a href="javascript:();" rel="<?php echo $l->fam_id; ?>" class="editFamilleAnnule annule<?php echo $l->fam_id; ?> text-danger cacher" title="Annuler" style="text-decoration:underline">Annuler</a> &nbsp;
										<a href="javascript:();" rel="<?php echo $l->fam_id; ?>" class="editFamille clique<?php echo $l->fam_id; ?>" title="Modifier"><i class="zmdi zmdi-edit" style="font-size:20px"></i></a> &nbsp;
										<a onClick="return confirm('Êtes-vous sûr de supprimer cette famille de produit ?')" href="<?php echo site_url("parametre/supprimer_famille_produit/".$l->fam_id); ?>" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
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
            <div class="modal-body text-center"> famille(s) enregistée(s) avec succès <br><i style="font-size:40px" class="fa fa-hospital-o"></i></div>
            <div class="refresh"></div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        'use strict';
		
        var listeFam = document.querySelector('#tbody');
        var addFam = document.querySelector('#addFam');
        var annuaire;
        annuaire = new Array();

        function removeCat(index) {
            annuaire.splice(index,1);
            showListeFam();	
        }

        function addDetailFam() 
        {
            var lib 	            = document.getElementById('lib').value;
            if(lib == '') {
                alert('Veuillez renseigner le champs.');	
            }
            else {
                var contact = new Object();
                contact.lib	        = lib;
                annuaire.push(contact);
                showListeFam();	
				document.getElementById('lib').value="";
            }
        }

        addFam.addEventListener('click', addDetailFam);

        function showListeFam() 
        {
            var contenu="";
            var tailleTableau = annuaire.length;            
                
            for(var i = 0; i < tailleTableau; i++) {
                contenu += '<tr>';
                contenu += '<td><input type="hidden" name="lib[]" value="'+ annuaire[i].lib+'"/>' + annuaire[i].lib + '</td>';
                contenu += '<td class="text-center"><a href="javascript:();" onClick="removeCat(' + i + ')" class="delete" title="Supprimer"><i class="zmdi zmdi-delete text-danger" style="font-size:20px"></i></a></td>';
                contenu += '</tr>';
            }

            listeFam.innerHTML = contenu;
			// alert(contenu);
        }
    
        </script>


<?php include("includes/footer.php"); ?>