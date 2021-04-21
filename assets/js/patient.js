
$("a#addReed").click(function(){
	// alert("ok");
	var nbError3 = 0;
	
	$("form#form-reeducation input").each(function(){
		if($.trim($(this).val()) == ""){
			nbError3++;
		}
		else{
			
		}
	});	
	
	$("form#form-reeducation textarea").each(function(){
		if($.trim($(this).val()) == ""){
			nbError3++;
		}
		else{
			
		}
	});
	
	if(nbError3 == 0){
		
		$(".retour-reeducation").html('');
		var data = $('form#form-reeducation').serialize();
		// alert(data);
		
		$.ajax({
			type:"POST",
			url: ajoutReeducation,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
		})
		.done(function(retour){
			// alert(retour);
			var tab = retour.split("-//-");
			alert(tab[0]);
			if(tab[0] =="fin" ){
				$("#tbodyRee").html(tab[1]);
				$("#nb").html(tab[2]);
				$("#form-reeducation").html('<h5><style="color:green">Dossier du patient clôturé, le nombre de seance est arrivé à echeance</span></h5>');
				
			}
			else{
				$("#tbodyRee").html(tab[0]);
				$("#nb").html(tab[1]);
				$("#form-reeducation input.obligatoire").val('');
				$("#form-reeducation textarea").val('');
			}
		});
		
	}
	else{
		$(".retour-reeducation").html('<span style="color:red">Veuillez enseigner tous les champs</span="color:red">');
	}
	
	return false;
});



$(".traiter").click(function(){
	
		var data = $('form#form-infimier').serialize();
		// alert(data);
		
		$.ajax({
			type:"POST",
			url: traiter,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
		})
		.done(function(retour){
			alert("Acte de soins validé");
			location.href=assignation;
	
		});
	
	return false;
});


$("#EnregistrerPatient").click(function(){
	
	var nbError3 = 0;
	
	$("form#form-add-pat input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-add-pat select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-add-pat textarea.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	if(nbError3 == 0){
		
		$(".retour-add-pat").removeClass("alert alert-danger").html('');
		var form = $('form#form-add-pat').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: ajoutPatient,
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
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo" || retour=="Ce numéro de téléphone est déja enregistré pour un membre du personnel"){	
				$(".retour-add-pat").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-add-pat .tel").parent("div").addClass("has-error");
				$("form#form-add-pat .photo").parent("div").removeClass("has-error");
			}
			else if(retour == "La taille de l'image ne doit pas dépasser les 150 Ko" || retour == "Les formats de l'image autorisés sont .jpg, .jpeg, .png"){	
				$(".retour-add-pat").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-add-pat .tel").parent("div").removeClass("has-error");
				$("form#form-add-pat .photo").parent("div").addClass("has-error");
			}
			else{	
				$(".retour-add-pat").addClass("alert alert-success").html("Patient ajouté avec succès").removeClass("danger");
				$("form#form-add-pat .tel").parent("div").removeClass("has-error");
				$("form#form-add-pat .photo").parent("div").removeClass("has-error");
				$("#finishPatient").click();
				$("#refreshPatient").html("<meta http-equiv='"+orientation+"/"+retour+"' content='2'>");
				$('#mdModalPatient').attr("rel",retour);
			}
			
		});
		
	}
	else{
		$(".retour-add-pat").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});


$("#ModifierPatient").click(function(){
	
	var nbError3 = 0;
	
	$("form#form-edit-pat input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-edit-pat select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-edit-pat textarea.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	if(nbError3 == 0){
		
		$(".retour-edit-pat").removeClass("alert alert-danger").html('');
		var form = $('form#form-edit-pat').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: modifierPatient,
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
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo" || retour=="Ce numéro de téléphone est déja enregistré pour un membre du personnel"){	
				$(".retour-edit-pat").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-edit-pat .tel").parent("div").addClass("has-error");
				$("form#form-edit-pat .photo").parent("div").removeClass("has-error");
			}
			else if(retour == "La taille de l'image ne doit pas dépasser les 150 Ko" || retour == "Les formats de l'image autorisés sont .jpg, .jpeg, .png"){	
				$(".retour-edit-pat").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-edit-pat .tel").parent("div").removeClass("has-error");
				$("form#form-edit-pat .photo").parent("div").addClass("has-error");
			}
			else{	
				$(".retour-edit-pat").addClass("alert alert-success").html("Données modifiées avec succès").removeClass("danger");
				$("form#form-edit-pat .tel").parent("div").removeClass("has-error");
				$("form#form-edit-pat .photo").parent("div").removeClass("has-error");
				$("#finish").click();
			}
			
		});
		
	}
	else{
		$(".retour-edit-pat").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});


$("#modifStructure").click(function(){
	
	var nbError3 = 0;
	
	$("form#form-modif-struc input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-modif-struc select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-modif-struc textarea.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	if(nbError3 == 0){
		
		$(".retour-modif-struc").removeClass("alert alert-danger").html('');
		var form = $('form#form-modif-struc').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: modifStructure,
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
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo"){	
				$(".retour-modif-struc").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-modif-struc .email").parent("div").removeClass("has-error");
				$("form#form-modif-struc .tel").parent("div").addClass("has-error");
				$("form#form-modif-struc .photo").parent("div").removeClass("has-error");
			}
			else if(retour == "La taille de l'image ne doit pas dépasser les 150 Ko" || retour=="Les formats de l'image autorisés sont .jpg, .jpeg, .png"){	
				$(".retour-modif-struc").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-modif-struc .email").parent("div").removeClass("has-error");
				$("form#form-modif-struc .tel").parent("div").removeClass("has-error");
				$("form#form-modif-struc .photo").parent("div").addClass("has-error");
			}			
			else if(retour == "Format email incorrect"){	
				$(".retour-modif-struc").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-modif-struc .email").parent("div").addClass("has-error");
				$("form#form-modif-struc .tel").parent("div").removeClass("has-error");
				$("form#form-modif-struc .photo").parent("div").addClass("has-error");
			}
			else{	
				$(".retour-modif-struc").addClass("alert alert-success").html("Modification effectuée avec succès").removeClass("danger");
				$("form#form-modif-struc .tel").parent("div").removeClass("has-error");
				$("form#form-modif-struc .photo").parent("div").removeClass("has-error");
			}
			
		});
		
	}
	else{
		$(".retour-modif-struc").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});


$("#modifBanque").click(function(){
	
	var nbError3 = 0;
	
	$("form#form-modif-banque input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-modif-banque select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-modif-banque textarea.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	if(nbError3 == 0){
		
		$(".retour-modif-banque").removeClass("alert alert-danger").html('');
		var data = $('form#form-modif-banque').serialize();
		
		// alert(data);
		$.ajax({
			type:"POST",
			url: editBanque,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
		
			if(retour == "ok"){	
				$(".retour-modif-banque").addClass("alert alert-success").html("Modification effectuée avec succès").removeClass("danger");
			}
			
		});
		
	}
	else{
		$(".retour-modif-banque").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});



$("#validerActe").click(function(){
	
	var nbError3 = 0;
	
	$("form#form-orientation input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-orientation select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#form-orientation textarea.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError3++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	var check = $("input[type=radio]:checked");
	if(check.length == 0){
		// alert(check.length);
		nbError3++;
	}
	
	
	if(nbError3 == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
		var data = $('form#form-orientation').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutOrientation,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
		})
		.done(function(retour){
			// alert(retour);
			$("#retour-cout").html(retour);
			$("#finishOrient").click();
			$("#refresh").html("<meta http-equiv='refresh' content='3'>");
			
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires  et cocher le personnel soignant!');
	}
	
	return false;
});

$("a.caisse").click(function(){
	
	var nbError3 = 0;
	
	$("form#form-caisse input.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			nbError3++;
		}
		else{
			
		}
	});
	$("form#form-caisse select.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			nbError3++;
		}
		else{

		}
	});
	
	if(nbError3 == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
		/*
		var data = $('form#form-caisse').serialize();
		// alert(data);
		
		$.ajax({
			type:"POST",
			url: ajoutFactureCaisse,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
		})
		.done(function(retour){
			// alert(retour);
			$("#modalPaye").modal("hide");
			$("#finish").click();
			$("#refresh").html("<meta http-equiv='refresh' content='3'>");
	
		});
		*/
		return true;
	}
	else{
		alert("Veuillez renseigner tous les champs obligatoires");
	}
	
	return false;
});



$("select.acte").on("change",function(){

	var data = $('select.acte').val();
	// alert(data);
	$.ajax({
		type:"POST",
		url: listeUniteActe,
		data:"acte="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepOrientation").html(retour);
	});
	
	return false;
});



$("select.acte").on("change",function(){

	var data = $('select.acte').val();
	// alert(data);
	$.ajax({
		type:"POST",
		url: listedetail,
		data:"acte="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepDetail").html(retour);
	});
	
	return false;
});


$("#facture").on("click",function(){

	var data = $('#form-facture').serialize();
	// alert(data);
	$.ajax({
		type:"POST",
		url: ensembleFacture,
		data:data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepFact").html(retour);
	});
	
	return false;
});


$("#facture_2").on("click",function(){

	var data = $('#form-facture_2').serialize();
	// alert(data);
	$.ajax({
		type:"POST",
		url: ensembleFacture,
		data:data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepFact").html(retour);
	});
	
	return false;
});


$("select.pathologie").on("change",function(){

	var path = $('select.pathologie').val();
	if(path == "Oui"){
		$("div.group-cacher").removeClass("cacher");
		$("input.maladie").addClass("obligatoire");
	}
	else{
		$("div.group-cacher").addClass("cacher");
		$("input.maladie").removeClass("obligatoire");
	}
	
});


$(".checkPatient").click(function(){
	var check = $("input[type=checkbox]:checked");
	if(check.length >= 1){
		$("#facture").removeClass("cacher");
	}
	else{
		$("#facture").addClass("cacher");
	}
});


$(".checkPatient_2").click(function(){
	var check = $("input[type=checkbox]:checked");
	if(check.length >= 1){
		$("#facture_2").removeClass("cacher");
	}
	else{
		$("#facture_2").addClass("cacher");
	}
});


$("#AddNouveauNe").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-nouveau-ne input.form-control.obligatoire").each(function(){
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


	$("form#form-nouveau-ne select.form-control.obligatoire").each(function(){
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
		
		$(".retour-nouveau-ne").html('');
		var data = $('form#form-nouveau-ne').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: nouveauNe,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			$(".retour-nouveau-ne").addClass("alert alert-success").html("Nouveau né enregistré avec succès").removeClass("danger");
			$("form#form-nouveau-ne input.obligatoire").val('');
			$('.retour-new-ne').fadeIn('fast',function(){
				$('.retour-nouveau-ne').fadeOut(6000);
			});
		});
		
	}
	else{
		$(".retour-nouveau-ne").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});


$("#AddDeces").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-deces input.form-control.obligatoire").each(function(){
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


	$("form#form-deces select.form-control.obligatoire").each(function(){
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
	
	$("form#form-deces textarea.form-control.obligatoire").each(function(){
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
		
		$(".retour-deces").html('');
		var data = $('form#form-deces').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: casDeces,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			$(".retour-new-deces").addClass("alert alert-success").html("Patient déclaré décédé!").removeClass("danger");
			$("form#form-deces input.obligatoire").val('');
			$("form#form-deces textarea.obligatoire").val('');
			$('.retour-new-ne').fadeIn('fast',function(){
				$('.retour-new-deces').fadeOut(6000);
			});
		});
		
	}
	else{
		$(".retour-deces").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});

