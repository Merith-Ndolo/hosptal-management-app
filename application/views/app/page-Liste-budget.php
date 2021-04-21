
<?php include("includes/header.php"); ?>
<?php $liste = $this->md_budget->lignes_budget_actives(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
           
        </div>
        <div class="row clearfix">
			
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class=" pull-left">Liste des budgets </h2>
                    </div>
					
					
                    <div class="body table-responsive"> 
					
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						   
							<thead>
								<tr>
									<th>Designation</th>
									<th>Objectif</th>
									<th>Date d'exécution</th>
									<th>Montant</th>
									<th>Seuil</th>
									<th>Etat</th>
									<th>Unité destinataire</th>
									<th style="width:60px">Action</th>
								</tr>
							</thead>
							<?php  //var_dump($liste)?>
							<tbody>
							<?php foreach($liste AS $l){ $unite=$this->md_budget->lignes_budget_unite($l->lib_id);?>
								<tr>
									<td class="pro<?=$l->lib_id;?>"><span style="<?php if($l->lib_iMontant <= $l->lib_iSeuil){echo 'color:red;text-decoration:underline';}?>"><?=$l->lib_sLibelle;?></span></td>
									<td class="sal<?=$l->lib_id;?>"><?=$l->lib_sObjectifs;?></td>
									<td class="arm<?=$l->lib_id;?>"><?=$this->md_config->affDateFrNum($l->lib_dDate_exe);?></td>
									<td class="ve<?=$l->lib_id;?>"><?=number_format($l->lib_iMontant,2,",",".");?> Fcfa</td>
									<td class="ve<?=$l->lib_id;?>"><?=number_format($l->lib_iSeuil,2,",",".");?> Fcfa</td>
									<td class="qte<?=$l->lib_id;?>"><span style="<?php if($l->lib_iMontant <= $l->lib_iSeuil){echo 'color:red;';}?>"><?=number_format($l->lib_iEtat,2,",",".");?> Fcfa</span></td>
									<td>
										<ul>
											<?php foreach($unite AS $u){ ?>
											<li><?=$u->uni_sLibelle;?></li>
											<?php } ?>
										</ul>
									</td>
									<td class="text-center">
										<!--<a href="javascript:();" rel="<?=$l->lib_id;?>-/-<?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>-/-<?=$l->lib_iPrixVente;?>" class="delete ajout_stock" title="Nouvelles entrées du produit en stock"><i class="fa fa-sign-in text-primary" style="font-size:20px"></i></a>&nbsp;&nbsp;
										<a href="javascript:();" rel="<?=$l->lib_id;?>-/-<?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>" class="delete list_stock" title="L'historique des entrées"><i class="fa fa-list text-warning" style="font-size:20px"></i></a>&nbsp;&nbsp;
										<a href="javascript:();" id="rel" rel="<?=$l->lib_id;?>-/-<?=$l->med_sNc.' '.$l->for_sLibelle.' '.$l->med_iDosage.''.$l->med_sUnite;?>-/-<?=$l->sal_id;?>-/-<?=$l->arm_id;?>-/-<?=$l->cel_id;?>-/-<?=$l->lib_iPrixVente;?>-/-<?=$l->lib_iSeuil;?>"class="delete modif_stock" title="modifier"><i class="fa fa-edit text-success" style="font-size:20px"></i></a>&nbsp;&nbsp;-->
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





<?php include("includes/footer.php"); ?>