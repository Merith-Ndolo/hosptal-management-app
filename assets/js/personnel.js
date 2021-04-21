
$("#precedent2").click(function(){
	$("#etape1").click();
});
$("#precedent3").click(function(){
	$("#etape2").click();
});
		
$("#suivant1").click(function(){
	
	var nbError1 = 0;
	
	$("form#info-per input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError1++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#info-per select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError1++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#info-per textarea.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError1++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	
	if(nbError1 == 0){
		$(".retour1").removeClass("alert alert-danger").html('');
		$("#etape2").click();
	}
	else{
		$(".retour1").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});

$("#suivant2").click(function(){
	
	var nbError2 = 0;
	
	$("form#info-pro input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError2++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#info-pro select.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError2++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	$("form#info-pro textarea.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			$(this).addClass("obligatoire-color");
			nbError2++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	if(nbError2 == 0){
		$(".retour2").removeClass("alert alert-danger").html('');
		$("#finale").click();
	}
	else{
		$(".retour2").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});


$("#terminer").click(function(){
	
	var nbError3 = 0;
	
	$("form#info-compte input.form-control.obligatoire").each(function(){
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
	$("form#info-compte select.form-control.obligatoire").each(function(){
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
	$("form#info-compte textarea.form-control.obligatoire").each(function(){
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
	
	var pass=$("form#info-compte .pass").val();
	var cpass=$("form#info-compte .cpass").val();
	
	if(pass!="" && cpass==""){
		$("form#info-compte .cpass").parent("div").addClass("has-error");
		$("form#info-compte .pass").parent("div").removeClass("has-error");
		nbError3++;
	}
	else if(pass=="" && cpass!=""){
		$("form#info-compte .cpass").parent("div").removeClass("has-error");
		$("form#info-compte .pass").parent("div").addClass("has-error");
		nbError3++;
	}
	else{
		$("form#info-compte .cpass").parent("div").removeClass("has-error");
		$("form#info-compte .pass").parent("div").removeClass("has-error");
		
	}
	
	
	if(nbError3 == 0){
		
		$(".retour3").removeClass("alert alert-danger").html('');
		var data1 = $('form#info-per').serialize();
		var data2 = $('form#info-pro').serialize();
		var data3 = $('form#info-compte').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutPersonnel,
			data:data1+"&"+data2+"&"+data3,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone" || retour=="Ce numéro de téléphone n'est pas valable en république du Congo" || retour=="Ce numéro de téléphone est déja enregistré pour un membre du personnel"){	
				$(".retour2").removeClass("alert alert-danger").html("").removeClass("success");
				$(".retour1").removeClass("alert alert-danger").html("").removeClass("success");
				$(".retour3").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#info-compte .email").parent("div").removeClass("has-error");
				$("form#info-compte .tel").parent("div").addClass("has-error");
				$("form#info-compte .pass").parent("div").removeClass("has-error");
				$("form#info-compte .cpass").parent("div").removeClass("has-error");
				$("#finale").click();
			}
			else if(retour == "Les mots de passe ne sont pas identiques"){	
				$(".retour2").removeClass("alert alert-danger").html("").removeClass("success");
				$(".retour1").removeClass("alert alert-danger").html("").removeClass("success");
				$(".retour3").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#info-compte .email").parent("div").removeClass("has-error");
				$("form#info-compte .tel").parent("div").removeClass("has-error");
				$("form#info-compte .pass").parent("div").addClass("has-error");
				$("form#info-compte .cpass").parent("div").addClass("has-error");
				$("#finale").click();
			}
			else if(retour == "Le format de l'email est incorrect"){	
				$(".retour2").removeClass("alert alert-danger").html("").removeClass("success");
				$(".retour1").removeClass("alert alert-danger").html("").removeClass("success");
				$(".retour3").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#info-compte .email").parent("div").addClass("has-error");
				$("form#info-compte .tel").parent("div").removeClass("has-error");
				$("form#info-compte .pass").parent("div").removeClass("has-error");
				$("form#info-compte .cpass").parent("div").removeClass("has-error");
				$("#finale").click();
			}
			else if(retour == "Employé ajouté avec succès"){	
				$(".retour2").removeClass("alert alert-danger").html("").removeClass("success");
				$(".retour1").removeClass("alert alert-danger").html("").removeClass("success");
				$(".retour3").removeClass("alert alert-danger").html("").removeClass("success");
				$("form#info-compte .email").parent("div").removeClass("has-error");
				$("form#info-compte .tel").parent("div").removeClass("has-error");
				$("form#info-compte .pass").parent("div").removeClass("has-error");
				$("form#info-compte .cpass").parent("div").removeClass("has-error");
				$("#finish").click();
				$("#refresh").html("<meta http-equiv='refresh' content='2'>");
			}
			
		});
		
	}
	else{
		$(".retour3").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});



$("select.posteDomaine").on("change",function(){

	var data = $('select.posteDomaine').val();
	// alert(data);
	$.ajax({
		type:"POST",
		url: listeSpecialitePoste,
		data:"idPst="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("select.specialitePoste").html(retour);
		
	});
	
	return false;
});


$("select#per").on("change",function(){

	var data = $('select#per').val();
	// alert(data);
	$.ajax({
		type:"POST",
		url: listeFonctionPoste2,
		data:"idPst="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("select#fct").html(retour);
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



$(".addAft").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbody").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-aft').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutAffectation,
			data:data,
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
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});

