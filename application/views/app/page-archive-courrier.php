<?php include("includes/header.php"); ?>
<?php $listeCourrierEntrant = $this->md_courrier->recup_archive_courrier(); ?>




<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>ARCHIVAGES</h2>
            <small class="text-muted">MÉDICALIS, votre application de gestion hospitalière</small>
        </div>
		
		<!-- Tabs With Custom Animations -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2> Courriers archivés </h2>
					</div>
					 <div class="body table-responsive"> 
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Expéditeur</th>
									<th>Destinataire</th>
									<th>Date de reception</th>
									<th>Objet</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
						   
							<tbody>
							<?php foreach($listeCourrierEntrant AS $l){ ?>
								<tr>
									<td>
										<?php echo $l->tce_sEnvoyeur; ?>
										
									</td>
									<td>
										<?php echo $l->tce_sDestinataire; ?>
										
									</td>
									<td>
										<?php echo $l->tce_dDate; ?>
										
									</td>
									<td>
										<?php echo $l->tce_sObjet; ?>
										
									</td>
									<td class="text-center">
										<a href="<?php echo base_url($l->tce_sContenu); ?>" target="_blank" title="voir"><i class="zmdi zmdi-receipt mdc-text-light-blue" style="font-size:20px"></i></a> &nbsp;
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
                    </div>
				</div>
			</div>
		</div>
		<!-- #END# Tabs With Custom Animations -->
<button style="display:none" type="button" class="btn bg-blue-grey waves-effect finish" id="finish">BLUE GREY</button>
    </div>
</section>




<?php include("includes/footer.php"); ?>