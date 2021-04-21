

$("#editCompte").click(function(){
	
	var nbError = 0;
	var ancien = $("form#form-per input.apass").val();
	var nouveau = $("form#form-per input.npass").val();
	var confir = $("form#form-per input.cpass").val();
	

	if(ancien!="" && nouveau=="" && confir==""){
		$("form#form-per input.apass").parent("div").removeClass("has-error");
		$("form#form-per input.npass").parent("div").addClass("has-error");
		$("form#form-per input.cpass").parent("div").addClass("has-error");
		nbError++;
	}
	else if(ancien!="" && nouveau!="" && confir==""){
		$("form#form-per input.apass").parent("div").removeClass("has-error");
		$("form#form-per input.npass").parent("div").removeClass("has-error");
		$("form#form-per input.cpass").parent("div").addClass("has-error");
		nbError++;
	}
	else if(ancien=="" && nouveau=="" && confir!=""){
		$("form#form-per input.apass").parent("div").addClass("has-error");
		$("form#form-per input.npass").parent("div").addClass("has-error");
		$("form#form-per input.cpass").parent("div").removeClass("has-error");
		nbError++;
	}
	else if(ancien=="" && nouveau!="" && confir!=""){
		$("form#form-per input.apass").parent("div").addClass("has-error");
		$("form#form-per input.npass").parent("div").removeClass("has-error");
		$("form#form-per input.cpass").parent("div").removeClass("has-error");
		nbError++;
	}
	else if(ancien=="" && nouveau!="" && confir==""){
		$("form#form-per input.apass").parent("div").addClass("has-error");
		$("form#form-per input.npass").parent("div").removeClass("has-error");
		$("form#form-per input.cpass").parent("div").addClass("has-error");
		nbError++;
	}
	else{
		$("form#form-per input.apass").parent("div").removeClass("has-error");
		$("form#form-per input.npass").parent("div").removeClass("has-error");
		$("form#form-per input.cpass").parent("div").removeClass("has-error");
	}
	
	$("form#form-per input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
		}
	});
	
	
	if(nbError == 0){
		$(".retour-per").removeClass("alert alert-danger").html('');
		var data = $('form#form-per').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: editComptePersonnel,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		
		.done(function(retour){
			// alert(retour);
			if(retour == "Le format de votre email est incorrect"){
				$(".retour-per").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-per input.tel").parent("div").removeClass("has-error");
				$("form#form-per input.email").parent("div").addClass("has-error");
				$("form#form-per input.apass").parent("div").removeClass("has-error");
				$("form#form-per input.npass").parent("div").removeClass("has-error");
				$("form#form-per input.cpass").parent("div").removeClass("has-error");
			}
			else if(retour == "Les mots de passe doivent être identiques"){
				$(".retour-per").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-per input.tel").parent("div").removeClass("has-error");
				$("form#form-per input.email").parent("div").removeClass("has-error");
				$("form#form-per input.apass").parent("div").removeClass("has-error");
				$("form#form-per input.npass").parent("div").addClass("has-error");
				$("form#form-per input.cpass").parent("div").addClass("has-error");
			}
			else if(retour == "Ce numéro de téléphone n'est pas valable en république du Congo" || retour == "Ce numéro de téléphone est déja utilisé par un autre per" || retour == "Ceci n'est pas un numéro de téléphone. Veuillez entrer SVP un numéro de téléphone"){
				$(".retour-per").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-per input.tel").parent("div").addClass("has-error");
				$("form#form-per input.email").parent("div").removeClass("has-error");
				$("form#form-per input.apass").parent("div").removeClass("has-error");
				$("form#form-per input.npass").parent("div").removeClass("has-error");
				$("form#form-per input.cpass").parent("div").removeClass("has-error");
			}
			else if(retour == "L'ancien mot de passe est incorrect"){
				$(".retour-per").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-per input.tel").parent("div").removeClass("has-error");
				$("form#form-per input.email").parent("div").removeClass("has-error");
				$("form#form-per input.apass").parent("div").addClass("has-error");
				$("form#form-per input.npass").parent("div").removeClass("has-error");
				$("form#form-per input.cpass").parent("div").removeClass("has-error");
			}
			else{	
				$(".retour-per").addClass("alert alert-success").html(retour).removeClass("danger");
				$("form#form-per input.tel").parent("div").removeClass("has-error");
				$("form#form-per input.email").parent("div").removeClass("has-error");
				$("form#form-per input.apass").parent("div").removeClass("has-error");
				$("form#form-per input.npass").parent("div").removeClass("has-error");
				$("form#form-per input.cpass").parent("div").removeClass("has-error");
				$("form#form-per input.pass").val("");
				$("form#form-per input.npass").val("");
				$("form#form-per input.cpass").val("");
			}
		});
		
	}
	else{
		$(".retour-per").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});




$("#changerAvatar").click(function(){
	
	var nbError = 0;
	
	$("form#form-avatar input.form-control.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
		}
	});
	
	if(nbError == 0){
		$(".retour-avatar").removeClass("alert alert-danger").html('');
		var form = $('form#form-avatar').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url:editAvatarPersonnel,
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
			if(retour == "La taille de l'image ne doit pas dépasser les 150 Ko" || retour == "Les formats de l'image autorisés sont .jpg, .jpeg, .png"){
				$(".retour-avatar").addClass("alert alert-danger").html(retour).removeClass("success");
				$("form#form-avatar input.photo").parent("div").addClass("has-error");
			}
			else{
				$(".retour-avatar").removeClass("alert alert-danger").html("").removeClass("success");
				$("form#form-avatar input.photo").parent("div").removeClass("has-error");
				location.reload(true);
			}
			
		});
		
	}
	else{
		$(".retour-avatar").addClass("alert alert-danger").html('Veuillez charger l\image avant de changer la photo');
	}
	
	
	return false;
});

$("select#statut1").on("change",function(){
	var data = $('select#statut1').val();
	// alert(data);
	if(data!=""){
		$.ajax({
			type:"POST",
			url: afficheStatut,
			data:"statut="+data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			$("#RecepStat").html(retour);
		});
	}
	
	return false;
});
