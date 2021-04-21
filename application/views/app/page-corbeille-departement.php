
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_parametre->liste_departements_supprimes(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Corbeille</h2>
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>liste des directions de l'hôpital</h2>
                        
                    </div>
                    <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Désignation de la direction</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($liste AS $l){ ?>
								<tr>
									<td>
										<span class="champs<?php echo $l->dep_id ?>"><?php echo $l->dep_sLibelle; ?></span>
										<form id='form-edit-dir<?php echo $l->dep_id ?>'>
											<textarea class="cacher input<?php echo $l->dep_id ?>" style='width:100%' name='lib'><?php echo $l->dep_sLibelle; ?></textarea>
											<input type="hidden" value="<?php echo $l->dep_id ?>" name="id"/>
											<input type="hidden" value="<?php echo $l->dep_sLibelle ?>" name="nom"/>
										</form>
									</td>
									<td class="text-center">
										<a onClick="return confirm('Êtes-vous sûr de restaurer cette direction ?')" href="<?php echo site_url("corbeille/restaure_direction/".$l->dep_id); ?>" class="Restaurer" title="Supprimer"><i class="fa fa-reply text-success" style="font-size:20px"></i></a>
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

<?php include("includes/footer.php"); ?>