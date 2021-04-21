

$(".addTco").click(function(){
	//alert();
	
	var nbError = 0;
		$("form#form-tco input.form-control").each(function(){
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
		var data = $('form#form-tco').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutTypeCourrier,
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
	else{
		$(".retour").addClass("alert alert-danger").html("Veuillez remplir tous les champs!").removeClass("success");
	}
	
	return false;
});

$(".addTce").click(function(){
	//alert();
	
	var nbError = 0;
		$("form#form-tce input.form-control").each(function(){
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
		var form = $('form#form-tce').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: ajoutCourrier,
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
			location.reload(true);			
		});
	}
	else{
		$(".retour").addClass("alert alert-danger").html("Veuillez remplir tous les champs!").removeClass("success");
	}
	
	return false;
});

$(".addTcs").click(function(){
	//alert();
	
	var nbError = 0;
		$("form#form-tcs input.form-control").each(function(){
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
		var form = $('form#form-tcs').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: ajoutCourrierSortant,
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
			location.reload(true);			
		});
	}
	else{
		$(".retour").addClass("alert alert-danger").html("Veuillez remplir tous les champs!").removeClass("success");
	}
	
	return false;
});


$(".editTco").click(function(){
	//alert();
	
	var nbError = 0;
		$("form#form-edit-tco input.form-control.obligatoire").each(function(){
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
		var data = $('form#form-edit-tco').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: editTypeCourrier,
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
	else{
		$(".retour").addClass("alert alert-danger").html("Veuillez remplir tous les champs!").removeClass("success");
	}
	
	return false;
});



$(".modifier_courrier").click(function(){
	//alert();
	var data=$(this).attr("rel");
		// alert(data);
		$.ajax({
			type:"POST",
			url: recupCourrier,
			data:"id="+data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			$("#modif").html(retour);
		});
	
	return false;
});

$("select.typeDeCourrier").on("change",function(){

	var data = $('select.typeDeCourrier').val();
	// alert(data);
	$.ajax({
		type:"POST",
		url: exempleContenuType,
		data:"idType="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("select.contenuType").html(retour);
		
	});
	
	return false;
});


$("#typeC").on("change",function(){
	// alert();
	var data = $('#typeC').val();
	if($.trim(data)!=""){
	
	if(data == "autre"){
		$("div#autreChoix").removeClass("cacher");
	}
	else {
		$("div#autreChoix").addClass("cacher");
		
	}
	
	$.ajax({
		type:"POST",
		url:listeTypeCourrier,
		data:"id="+data,
		async:true,
		error:function(xhr,status,error) {
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		$("#retour").html(retour);
		});
	}
	else {
		$("div#autreChoix").addClass("cacher");
		$("#retour").html("");
	}
	return false;
});

$(".corriger_courrier").click(function(){
	//alert();
	var data=$(this).attr("rel");
		// alert(data);
		$.ajax({
			type:"POST",
			url: recupCourrierEnvoye,
			data:"id="+data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			$("#corriger").html(retour);
		});
	
	return false;
});

$(".editTcs").click(function(){
	//alert();
	
	var nbError = 0;
		$("form#form-edit-tcs input.form-control.obligatoire").each(function(){
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
		var data = $('form#form-edit-tcs').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: editCourrierEnvoye,
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
	else{
		$(".retour").addClass("alert alert-danger").html("Veuillez remplir tous les champs!").removeClass("success");
	}
	
	return false;
});
