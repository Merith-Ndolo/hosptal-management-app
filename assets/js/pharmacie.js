

$(".commander").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbody").html();
	
	if($.trim(tab)==""){
		nbError++;
	}
	
	if($("#four").val()==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-commander').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: effectuerCommnde,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			$("#finish").click();
			$("div.refresh").html("<meta http-equiv='refresh' content='2'>");
		});
	}
	else{
		alert("Veuillez verifier que la liste des produits et le fournisseur soient renseignés !");
	}
	
	return false;
});

$(".addClient").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-add-client input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	if(nbError == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
		var data = $('form#form-add-client').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutClient,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo" || retour=="Ce numéro de téléphone est déja enregistré pour un fournisseur"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-add-client .tel").parent("div").addClass("has-error");
			}
			else{	
				$(".retour").addClass("alert alert-success").html("Opération effectuée avec succès").removeClass("danger");
					$("#finish").click();
					$("#largeModal").modal("hide");
					$("div.refresh").html("<meta http-equiv='refresh' content='4'>");
					$("#mdModal div.modal-body").html(retour);
			}
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});

$(".addBon").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-add-bon input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	if(nbError == 0){
		
		var data = $('form#form-add-bon').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutBon,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
				location.reload(true);
			
		});
		
	}
	
	
	return false;
});

$(".vendre").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbody").html();
	
	if($.trim(tab)==""){
		nbError++;
	}
	if(nbError == 0){
		var data = $('form#form-vendre').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: effectuerVente,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			$("#tbody").html("");
			$("#tfooter").val("");
		});
	}
	else{
		alert("Veuillez verifier que la liste des produits et le montant payé soient bien renseignés !");
	}
	
	return false;
});




$("#editentreeStock").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-edit-entree-stock input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-form-edit-entree-stock select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	if(nbError == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
			var form = $('form#form-edit-entree-stock').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: editentreeStock,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
				// $("#finish").click();
				// $("#largeModal").modal("hide");
				// $("div.refresh").html("<meta http-equiv='refresh' content='2'>");
				// location.reload(true);
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo" || retour=="Ce numéro de téléphone est déja enregistré pour un fournisseur"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-entree-stock .email").parent("div").removeClass("has-error");
				$("form#form-entree-stock .photo").parent("div").removeClass("has-error");
				$("form#form-entree-stock .tel1").parent("div").addClass("has-error");
			}
			else if(retour == "Format adresse mail incorrect"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-entree-stock .email").parent("div").addClass("has-error");
				$("form#form-entree-stock .tel1").parent("div").removeClass("has-error");
				$("form#form-entree-stock .photo").parent("div").removeClass("has-error");
			}else if(retour == "La taille de l'image ne doit pas dépasser les 150 Ko"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-entree-stock .photo").parent("div").addClass("has-error");
				$("form#form-entree-stock .email").parent("div").removeClass("has-error");
				$("form#form-entree-stock .tel1").parent("div").removeClass("has-error");
			}
			else{	
				$(".retour").addClass("alert alert-success").html("Opération effectuée avec succès").removeClass("danger");
				$("form#form-entree-stock .email").parent("div").removeClass("has-error");
				$("form#form-entree-stock .tel").parent("div").removeClass("has-error");
				$("form#form-entree-stock input").val("");
			}
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});



$("#entreeStock").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-entree-stock input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-entree-stock select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	if(nbError == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
			var form = $('form#form-entree-stock').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: entreeStock,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){	
			$(".retour").addClass("alert alert-success").html("Opération effectuée avec succès").removeClass("danger");
			$("form#form-entree-stock input").val("");
			$("form#form-entree-stock select option[value='']").prop("selected", true);
			$('.retour').fadeIn('fast',function(){
				$('.retour').fadeOut(6000);
			});
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});

$(".addProduit").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-produit input.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			nbError++;
		}
	});
	$("form#form-produit select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			nbError++;
		}
	});
	
	
	if(nbError == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
		var form = $('form#form-produit').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: ajoutProduit,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
				$("#finish").click();
				$("#largeModal").modal("hide");
				$("div.refresh").html("<meta http-equiv='refresh' content='2'>");
				location.reload(true);
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires marqués par des (*)!');
	}
	
	
	return false;
});


$("#addFournisseur").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-add-four input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-add-four select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	if(nbError == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
			var form = $('form#form-add-four').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: ajoutFournisseur,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo" || retour=="Ce numéro de téléphone est déja enregistré pour un fournisseur"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-add-four .email").parent("div").removeClass("has-error");
				$("form#form-add-four .photo").parent("div").removeClass("has-error");
				$("form#form-add-four .tel1").parent("div").addClass("has-error");
			}
			else if(retour == "Format adresse mail incorrect"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-add-four .email").parent("div").addClass("has-error");
				$("form#form-add-four .tel1").parent("div").removeClass("has-error");
				$("form#form-add-four .photo").parent("div").removeClass("has-error");
			}else if(retour == "La taille de l'image ne doit pas dépasser les 150 Ko"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-add-four .photo").parent("div").addClass("has-error");
				$("form#form-add-four .email").parent("div").removeClass("has-error");
				$("form#form-add-four .tel1").parent("div").removeClass("has-error");
			}
			else{	
				$(".retour").addClass("alert alert-success").html("Opération effectuée avec succès").removeClass("danger");
				$("form#form-add-four .email").parent("div").removeClass("has-error");
				$("form#form-add-four .tel").parent("div").removeClass("has-error");
				$("form#form-add-four input").val("");
			}
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});


$("#editFournisseur").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-edit-four input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-edit-four select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	if(nbError == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
			var form = $('form#form-edit-four').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: modifFournisseur,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo" || retour=="Ce numéro de téléphone est déja enregistré pour un fournisseur"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-edit-four .email").parent("div").removeClass("has-error");
				$("form#form-edit-four .photo").parent("div").removeClass("has-error");
				$("form#form-edit-four .tel1").parent("div").addClass("has-error");
			}
			else if(retour == "Format adresse mail incorrect"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-edit-four .email").parent("div").addClass("has-error");
				$("form#form-edit-four .tel1").parent("div").removeClass("has-error");
				$("form#form-edit-four .photo").parent("div").removeClass("has-error");
			}else if(retour == "La taille de l'image ne doit pas dépasser les 150 Ko"){	
				$(".retour").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-edit-four .photo").parent("div").addClass("has-error");
				$("form#form-edit-four .email").parent("div").removeClass("has-error");
				$("form#form-edit-four .tel1").parent("div").removeClass("has-error");
			}
			else{	
				// $(".retour").addClass("alert alert-success").html("Opération effectuée avec succès").removeClass("danger");
				$("form#form-edit-four .email").parent("div").removeClass("has-error");
				$("form#form-edit-four .tel").parent("div").removeClass("has-error");
				// $("form#form-edit-four input").val("");
				location.reload(true);
			}
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});



$("#editProduit").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-edit-produit input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-edit-produit select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	if(nbError == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
			var form = $('form#form-edit-produit').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: modifProduit,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour == "erreur"){	
				$(".retour").addClass("alert alert-danger").html("Un produit avec les mêmes caractéristiques existe déjà !").removeClass("success");
				$("form#form-edit-produit .deja").parent("div").addClass("has-error");
			}
			else{	
				$(".retour").addClass("alert alert-success").html("Données modifiées").removeClass("danger");
				$("form#form-edit-produit .deja").parent("div").removeClass("has-error");
			}
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});


$(".editClient").click(function(){
	var rel=$(this).attr('rel');
	$(".input_nom"+rel).removeClass('cacher');
	$(".input_prenom"+rel).removeClass('cacher');
	$(".input_adresse"+rel).removeClass('cacher');
	$(".input_tel"+rel).removeClass('cacher');
	$(".champs_clt"+rel).addClass('cacher');
	$(".confirm_clt"+rel).removeClass('cacher');
	$(".annule_clt"+rel).removeClass('cacher');
	$(this).addClass('cacher');
	return false;
});

$(".editClientFinal").click(function(){
	var rel=$(this).attr('rel');
	var data = $('form#form-edit-client'+rel).serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: modifierClient,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo" || retour=="Ce numéro de téléphone est déja enregistré pour un fournisseur"){
				$(".retour"+rel).addClass("alert alert-danger");
				$(".retour"+rel).html(retour);
				$(".tel"+rel).attr("style","width:100%;border-color:red;background:rgba(255,0,0,0.2)");
			}
			else{
				$(".retour"+rel).html("");
				$(".retour"+rel).removeClass("alert alert-danger");
				$(".tel"+rel).attr("style","width:100%");
				$(".champs_clt"+rel).html(retour);
				$(".champs_clt"+rel).removeClass('cacher');
				$(".input_nom"+rel).addClass('cacher');
				$(".input_prenom"+rel).addClass('cacher');
				$(".input_adresse"+rel).addClass('cacher');
				$(".input_tel"+rel).addClass('cacher');
				$(".confirm_clt"+rel).addClass('cacher');
				$(".clique_clt"+rel).removeClass('cacher');
				$(".annule_clt"+rel).addClass('cacher');

			}
		});
	
	return false;
});

$(".editClientAnnule").click(function(){
	var rel=$(this).attr('rel');
	$(".champs_clt"+rel).removeClass('cacher');
	$(".input_nom"+rel).addClass('cacher');
	$(".input_prenom"+rel).addClass('cacher');
	$(".input_adresse"+rel).addClass('cacher');
	$(".input_tel"+rel).addClass('cacher');
	$(".confirm_clt"+rel).addClass('cacher');
	$(".clique_clt"+rel).removeClass('cacher');
	$(this).addClass('cacher');
	return false;
});


$(".clickBon").click(function(){
	var rel=$(this).attr("rel");
	
	$("#mdModalBon div.modal-body").html('<form id="form-add-bon"><div class="col-sm-12"><div class="form-group"><div class="form-line"><input type="number" name="montant" class="form-control obligatoire montant" placeholder="Montant (Fcfa) *"><input type="hidden" name="client" value="'+rel+'"></div></div></div></form>');
	
	
});

$(".modif_stock").click(function(){
	var rel= $(this).attr('rel');
	var recup = rel.split("-/-");
	// alert(recup);
	$("#modifier").removeClass("cacher");
	$("#ajout").addClass("cacher");
	$("#detail").addClass("cacher");
	$("#btn-ajout").addClass("cacher");
	$("#btn-ajout").removeClass("addStock");
	$("#btn-edit").attr("rel",recup[0]);
	$("#btn-edit").removeClass("cacher");
	$("#idAch").val(recup[0]);
	$("#modif").html(recup[1]);
	$("#pv").val(recup[5]);
	$("#seuil").val(recup[6]);
	$("#large").attr('style',"margin-top:20px");
	
	var dataSal = recup[2];
	var dataArm = recup[3];
	var dataCel = recup[4];
	
	$.ajax({
		type:"POST",
		url: recupSalle,
		data:"sal="+dataSal,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#salle").html(retour);
	});
	
	$.ajax({
		type:"POST",
		url: recupArmoir,
		data:"arm="+dataArm+"&sal="+dataSal,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#armoire").html(retour);
	});
	
	$.ajax({
		type:"POST",
		url: recupCellule,
		data:"cel="+dataCel+"&arm="+dataArm,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#cellule").html(retour);
	});
});


$(".ajout_stock").click(function(){
	var rel= $(this).attr('rel');
	var recup = rel.split("-/-");
	// alert(recup);
	$("#ajout").removeClass("cacher");
	$("#modifier").addClass("cacher");
	$("#detail").addClass("cacher");
	$("#btn-ajout").removeClass("cacher");
	$("#btn-edit").addClass("cacher");
	$("#btn-ajout").attr("rel",recup[0]);
	$("#id").val(recup[0]);
	$("#produit").html(recup[1]);
	$("#vente").val(recup[2]);
	$("#large").attr('style',"margin-top:20px");
});

$(".list_stock").click(function(){
	var rel= $(this).attr('rel');
	var recup = rel.split("-/-");
	// alert(recup);
	$("#ajout").addClass("cacher");
	$("#modifier").addClass("cacher");
	$("#detail").removeClass("cacher");
	$("#btn-ajout").addClass("cacher");
	$("#btn-edit").addClass("cacher");
	$("#btn-ajout").attr("rel",recup[0]);
	var data = recup[0];
	$("#detailListe").html(recup[1]);
	$("#large").attr('style',"margin-top:20px;max-width:80%");
	
	$.ajax({
			type:"POST",
			url: recupDetailStock,
			data:"ach_id="+data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			$("#tbody").html(retour);
		});
});


$(".editStock").click(function(){
	// alert('ok');
	var rel= $(this).attr("rel");
	var recup = rel.split("-/-");
	var nbError = 0;
	
	$("form#form-edit-entree-stock input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-edit-entree-stock select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	if(nbError == 0){
		
		$(".retour-modif").removeClass("alert alert-danger").html('');
			var form = $('form#form-edit-entree-stock').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: editEntreeStock,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){	
			// alert(retour);
			$(".retour-modif").addClass("alert alert-success").html("Opération effectuée avec succès").removeClass("danger");
			$('.retour-modif').fadeIn('fast',function(){
				$('.retour-modif').fadeOut(6000);
			});
			var tabRetour = retour.split("-/-");
			$(".sal"+recup[0]).html(tabRetour[0]);
			$(".arm"+recup[0]).html(tabRetour[1]);
			$(".cel"+recup[0]).html(tabRetour[2]);
			$(".ve"+recup[0]).html(tabRetour[3]);
			
			$("#rel").attr("rel",recup[0]+"-/-"+recup[1]+"-/-"+tabRetour[4]+"-/-"+tabRetour[5]+"-/-"+tabRetour[6]+"-/-"+tabRetour[7]+"-/-"+tabRetour[8]);
		});
		
	}
	else{
		$(".retour-modif").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});

$(".addStock").click(function(){
	// alert('ok');
	var rel= $(this).attr("rel");
	var recup = rel.split("-/-");
	var nbError = 0;
	
	$("form#form-stock input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-stock select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	if(nbError == 0){
		
		$(".retour-ajout").removeClass("alert alert-danger").html('');
			var form = $('form#form-stock').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: entreeStock_2,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){	
			// alert(retour);
			$(".retour-ajout").addClass("alert alert-success").html("Opération effectuée avec succès").removeClass("danger");
			$("form#form-stock input.form-control").val("");
			$("form#form-stock select option[value='']").prop("selected", true);
			$('.retour-ajout').fadeIn('fast',function(){
				$('.retour-ajout').fadeOut(6000);
			});
			$(".qte"+recup[0]).html(retour);
			
		});
		
	}
	else{
		$(".retour-ajout").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});


$(".checkProduit").click(function(){
	var check = $("input[type=checkbox]:checked");
	if(check.length >= 1){
		$("#destock").removeClass("cacher");
	}
	else{
		$("#destock").addClass("cacher");
	}
	
	if(check.length == 1){
		var nombre= check.length+" produit selectionné";
	}
	else if(check.length > 1){
		var nombre= check.length+" produits selectionnés";
	}
	
	$("#nombre").html(nombre)
});




$(".destockPerime").on("click",function(){
	var nbError = 0;
	if($.trim($('textarea').val())==""){
		$("textarea").attr("placeholder","Veuillez décrire le motif de destockage");
		$("textarea").attr("style","width:100%;border:1px solid red");
		nbError++;
	}else{
		$("textarea").attr("placeholder","Décrire le motif de destockage ici");
		$("textarea").attr("style","width:100%;border:1px solid black");
	}
	
	var data1 = $('form#form-destockage').serialize();
	var data2 = $('form#form-motif').serialize();
	// alert(choix);
	$.ajax({
		type:"POST",
		url: destockage,
		data:data1+"&"+data2,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		location.reload(true);
	});
	
	return false;
	
});


$("#libCode").on('change',function(){
	var code = $("#libCode").val();
	
		$.ajax({
		type:"POST",
		url: recupProduit,
		data:"code="+code,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
	// alert(retour);
		if(retour=='echec'){
			$('.retour').html("* Ce code à barre n`'est pas enregistré");
			$('#addFictif').addClass('cacher');
		}else{
			$('.retour').html("");
			$('#addFictif').removeClass('cacher');
			 var tab = retour.split("-/-");
			 $("#pu").val(tab[0]);
			 $("#prod").val(tab[1]);
			 $("#seuil").val(tab[2]);
			 $("#ach").val(tab[3]);
			 
			 // var prix = tab[0];
			// var taux =  $("#remise").val();
			// var qte =  $("#qte").val();
			
			// var montantRemise = (prix * taux)/100;
			// var montantTot = (prix - montantRemise)*qte;
			// $("#montant").val(montantTot);
			
			// var quantite = tab[2];
			// $('#qte').attr("max",quantite);
		}
	});
	return false;
});




$("#bon").on('change',function(){
	var bon = $("#bon").val();
	
		$.ajax({
		type:"POST",
		url: recupBon,
		data:"bon="+bon,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
	// alert(retour);
		if(retour=='echec'){
			$('.retourBon').html("* Cet abonnement n'est pas valide").attr("style","color:red");
		}else{
			$('.retourBon').html("abonnement valide").attr("style","color:green");
		}
	});
	return false;
});




$('#select').on("change",function(){
	var select = $('#select').val();
	
	if(select=='comptant'){
		$("#assu").addClass("cacher");
		$("#client").addClass("cacher");
	}else if(select=='bon pharmacie'){
		$("#assu").addClass("cacher");
		$("#client").removeClass("cacher");
	}else{
		$("#assu").removeClass("cacher");
		$("#client").addClass("cacher");
	}
});



$('#type').on("change",function(){
	var select = $('#type').val();
	
	if(select != ""){
		var tab = select.split("-/-");
		var montant  = $("#tfooter").val();
		if(montant!=""){
			var couverture = (parseInt(montant)*parseInt(tab[1]))/100;
			$("#montantAss").val(couverture);
			
			var reste = parseInt(montant) - couverture;
			$("#mess").html("L'assureur couvre "+tab[1]+"% des charges, le client paie <b>"+reste+" Fcfa</b>")
			if(reste == 0){
				$("#pay").addClass("cacher");
			}
			else{
				$("#pay").removeClass("cacher");
			}
		}
		else{
			$("#mess").html("");
		}
	}
	else{
		$("#mess").html("");
	}
});


function chargement(){
	var body=0;
	 // alert('chargement');
		$.ajax({
		type:"POST",
		url: vide,
		data:"body="+body,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		 // alert(retour);
	});
	return false;
};


$("#addFictif").click(function(){
	 var code = $("#libCode").val();
	 var prod = $("#prod").val();
	 var pu = $("#pu").val();
	 var ach = $("#ach").val();
		$.ajax({
			type:"POST",
			url: recupFictif,
			data:"code="+code+"&prod="+prod+"&pu="+pu+"&ach="+ach,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour == "ce produit est déjà ajouté"){
				$("#retour").html(retour);
				
			}
			else{
				$("#libCode").val('');
				var tab = retour.split("-//-");
				$("#retour").html("");
				$('#tbody').html(tab[0]);
				$('#tfooter').val(tab[1]);
			}
			
		});
	
	
	return false;
});

