$("#connexion").click(function(){
	
	var nbError = 0;
	// var nbError = "<?php echo json_encode( echo 0); ?>;";
	
	$("form#form-connexion input.form-control").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).addClass("has-error-login");
			nbError++;
		}
		else{
			$(this).removeClass("has-error-login");
		}
	});
	
	if(nbError == 0){
		$(".retour").removeClass("alert alert-danger").html('');
		var data = $('form#form-connexion').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: urlConnect,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour == 'login'){
				$('form#form-connexion input.form-control').removeClass('has-error-login');
				document.location.href=app;
			}
			else if(retour == 'Identifiant ou mot de passe incorrect'){
				$(".retour").addClass("alert alert-danger").html(retour);
				$('form#form-connexion input.form-control').addClass('has-error-login');
			}
			else if(retour == 'Format email incorrect' || retour == 'Ce numéro de téléphone n\'est pas un format reconnu au Congo'){
				$(".retour").addClass("alert alert-danger").html(retour);
				$('form#form-connexion input.form-control.login').addClass('has-error-login');
				$('form#form-connexion input.form-control.pass').removeClass('has-error-login');
			}
			
		});
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs');
	}
	
	
	return false;
});



$("#oublie").click(function(){
	
	var nbError = 0;
	// var nbError = "<?php echo json_encode( echo 0); ?>;";
	
	$("form#form-oublie input.form-control").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).addClass("has-error-login");
			nbError++;
		}
		else{
			$(this).removeClass("has-error-login");
		}
	});
	
	if(nbError == 0){
		$(".retour").removeClass("alert alert-danger").html('');
		var data = $('form#form-oublie').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: urlOublie,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
		// alert(retour);
			if(retour == "Le format de votre email est incorrect"){
				$(".retour").addClass("alert alert-danger").html(retour);
				$('form#form-oublie input.email').addClass('has-error-login');
			}
			else if(retour == 'Un mail vous a été envoyé pour le changement de votre mot de passe'){
				$("#block-oublie").html("<div class='text-center'><a href='"+urlSite+"' class='btn btn-success btn-block btn-flat'>Retour à la connexion</a></div>");
				$(".retour").addClass("alert text-success").html(retour).removeClass('alert-danger');
			}
			else if(retour == "Cet email n'est pas reconnu dans notre système"){
				$('form#form-oublie input.email').addClass('has-error-login');
				$(".retour").addClass("alert alert-danger").html(retour).removeClass('text-success');
			}
			
		});
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner votre Email');
	}
	
	
	return false;
});
