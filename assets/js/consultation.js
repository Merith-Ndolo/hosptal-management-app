// $('.retour-constFinal').hide();
// $('.retour-consulFinal').fadeOut(6000)
$("#enregistrerHospi").click(function(){
	var nbError1 = 0;
	
	$("form#form-hos input.form-control.obligatoire").each(function(){
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
	$("form#form-hos select.form-control.obligatoire").each(function(){
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
	$("form#form-hos textarea.form-control.obligatoire").each(function(){
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

		$(".retour-hos").removeClass("alert alert-danger").html('');
		var data = $('form#form-hos').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutHospitalisation,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);

			// $(".retour-hos").removeClass("alert alert-danger").html('');
			// $(".retour-hosFinal").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-hosFinal').fadeIn('fast',function(){
				// $('.retour-hosFinal').fadeOut(6000);
			// });
			location.href=rapport_consultation+'/'+retour;
			
		});
	}
	else{
		$(".retour-hos").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	return false;
});

$("#enregistrerConstante").click(function(){
	var nbError = 0;
	
	var dia = $('form#form-constante input.dia').val();
	var sys = $('form#form-constante input.sys').val();
	
	if(dia=="" && sys!=""){
		$('form#form-constante input.dia').addClass("has-error");
		$('form#form-constante input.sys').removeClass("has-error");
		$("form#form-constante input.temperature").parent("div").removeClass("has-error");
		$("form#form-constante input.poids").parent("div").removeClass("has-error");
		$("form#form-constante input.taille").parent("div").removeClass("has-error");
		nbError++;
	}
	else if(dia!="" && sys==""){
		$('form#form-constante input.dia').removeClass("has-error");
		$('form#form-constante input.sys').addClass("has-error");
		$("form#form-constante input.temperature").parent("div").removeClass("has-error");
		$("form#form-constante input.poids").parent("div").removeClass("has-error");
		$("form#form-constante input.taille").parent("div").removeClass("has-error");
		nbError++;
	}
	else{
		$('form#form-constante input.dia').removeClass("has-error");
		$('form#form-constante input.sys').removeClass("has-error");
		$("form#form-constante input.temperature").parent("div").removeClass("has-error");
		$("form#form-constante input.poids").parent("div").removeClass("has-error");
		$("form#form-constante input.taille").parent("div").removeClass("has-error");
	}
	
	if(nbError == 0){
		$(".retour-const").removeClass("alert alert-danger").html('');
		var data = $('form#form-constante').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutConstante,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour=="ok"){	
				// $(".retour-const").removeClass("alert alert-danger").html('');
				// $(".temperature").parent("div").removeClass("has-error");
				// $(".ta").parent("div").removeClass("has-error");
				// $(".poids").parent("div").removeClass("has-error");
				// $(".taille").parent("div").removeClass("has-error");
				// $(".retour-constFinal").addClass("alert alert-success").html('Données enregistrées avec succès');
				// $('.retour-constFinal').fadeIn('fast',function(){
					// $('.retour-constFinal').fadeOut(6000);
				// });
				location.reload(true);
				
			}
			else if(retour=="temperature"){
				$(".retour-const").addClass("alert alert-danger").html('Erreur des valeurs');
				$(".temperature").parent("div").addClass("has-error");
				$(".dia").parent("div").removeClass("has-error");
				$(".sys").parent("div").removeClass("has-error");
				$(".poids").parent("div").removeClass("has-error");
				$(".taille").parent("div").removeClass("has-error");
			}
			else if(retour=="sys"){
				$(".retour-const").addClass("alert alert-danger").html('Erreur des valeurs');
				$(".temperature").parent("div").removeClass("has-error");
				$(".sys").parent("div").addClass("has-error");
				$(".dia").parent("div").removeClass("has-error");
				$(".poids").parent("div").removeClass("has-error");
				$(".taille").parent("div").removeClass("has-error");
			}
			else if(retour=="dia"){
				$(".retour-const").addClass("alert alert-danger").html('Erreur des valeurs');
				$(".temperature").parent("div").removeClass("has-error");
				$(".dia").parent("div").addClass("has-error");
				$(".sys").parent("div").removeClass("has-error");
				$(".poids").parent("div").removeClass("has-error");
				$(".taille").parent("div").removeClass("has-error");
			}
			else if(retour=="poids"){
				$(".retour-const").addClass("alert alert-danger").html('Erreur des valeurs');
				$(".temperature").parent("div").removeClass("has-error");
				$(".dia").parent("div").removeClass("has-error");
				$(".sys").parent("div").removeClass("has-error");
				$(".poids").parent("div").addClass("has-error");
				$(".taille").parent("div").removeClass("has-error");
			}
			else if(retour=="taille"){
				$(".retour-const").addClass("alert alert-danger").html('Erreur des valeurs');
				$(".temperature").parent("div").removeClass("has-error");
				$(".dia").parent("div").removeClass("has-error");
				$(".sys").parent("div").removeClass("has-error");
				$(".poids").parent("div").removeClass("has-error");
				$(".taille").parent("div").addClass("has-error");
			}
			else{
				$(".retour-const").addClass("alert alert-danger").html(retour);
				$(".temperature").parent("div").addClass("has-error");
				$(".dia").parent("div").addClass("has-error");
				$(".sys").parent("div").addClass("has-error");
				$(".poids").parent("div").addClass("has-error");
				$(".taille").parent("div").addClass("has-error");
			}
		});
	}
	else{
		$(".retour-const").addClass("alert alert-danger").html('Les deux valeurs de la tension doivent être renseignées');
	}
	
	return false;
});

$("#enregistrerInformation").click(function(){

		var data = $('form#form-complement').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutInformation,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour == "ok"){
				location.reload(true);
			}
			else{
				$(".retour-complement").addClass("alert alert-danger").html(retour);
			}			
			
		});
	
	return false;
});


$("#enregistrerConsultation").click(function(){
	var nbError = 0;
	
	$("form#form-consultation textarea.obligatoire").each(function(){
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
	
	if(nbError==0){
		$(".retour-consul").removeClass("alert alert-danger").html('');
		var data = $('form#form-consultation').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutConsultation,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			if(retour=="ok"){
				// $("a.cliqueConsul").click();
				// $(".retour-consulFinal").addClass("alert alert-success").html('Données enregistrées avec succès');
				// $('.retour-consulFinal').fadeIn('fast',function(){
					// $('.retour-consulFinal').fadeOut(6000);
				// });
				location.reload(true);
			}
			
		});
	}
	else{
		$(".retour-consul").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	return false;
});


$(".effectuer").click(function(){
	var nbError = 0;
	
	if($.trim($("form#form-imagerie textarea").val()) == ""){
		$("#compte").html("<em>(Veuillez renseigner le compte rendu)</em>").addClass("text-danger");
		nbError++;
	}
	else{
		$("#compte").html("").removeClass("text-danger");
	}
	
	// if($.trim($("form#frmFileUpload input[type=file]").val()) == ""){
		// $("#image").html("<em>(Veuillez renseigner au moins une image de la radio)</em>").addClass("text-danger");
		// nbError++;
	// }
	// else{
		// $("#image").html("").removeClass("text-danger");
	// }
	
	if(nbError==0){
		var form = $('form#form-imagerie').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: ajoutCompteRendu,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			location.href=listeActeImagerie;
			// if(retour=="ok"){
				// $("a.cliqueConsul").click();
				// $(".retour-consulFinal").addClass("alert alert-success").html('Données enregistrées avec succès');
				// $('.retour-consulFinal').fadeIn('fast',function(){
					// $('.retour-consulFinal').fadeOut(6000);
				// });
			// }
			
		});
		
	}
	
	return false;
});


$(".effectuerExp").click(function(){
	var nbError = 0;
	
	if($.trim($("form#form-exploration textarea").val()) == ""){
		$("#compte").html("<em>(Veuillez renseigner le compte rendu)</em>").addClass("text-danger");
		nbError++;
	}
	else{
		$("#compte").html("").removeClass("text-danger");
	}
	
	// if($.trim($("form#frmFileUpload input[type=file]").val()) == ""){
		// $("#image").html("<em>(Veuillez renseigner au moins une image de la radio)</em>").addClass("text-danger");
		// nbError++;
	// }
	// else{
		// $("#image").html("").removeClass("text-danger");
	// }
	
	if(nbError==0){
		var form = $('form#form-exploration').get(0);
		var formData = new FormData(form);
		// alert(formData);
		$.ajax({
			type:"POST",
			url: ajoutCompteRenduExp,
			contentType:false,
			processData:false,
			data:formData,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			location.href=listeActeExploration;
			// if(retour=="ok"){
				// $("a.cliqueConsul").click();
				// $(".retour-consulFinal").addClass("alert alert-success").html('Données enregistrées avec succès');
				// $('.retour-consulFinal').fadeIn('fast',function(){
					// $('.retour-consulFinal').fadeOut(6000);
				// });
			// }
			
		});
		
	}
	
	return false;
});


$(".const_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupConstante,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});


$(".const_sej_2").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupConstante2,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});

$(".info_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupInformation,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});


$(".consu_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupConsultation,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});


$(".hospitalisation_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupHospitalisation,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});



$(".soins_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupSoinsInfim,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});


$(".imagerie_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupActeImagerie,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});

$(".exp_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupActeExp,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});

$(".ordo_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupOrdonnance,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});



$(".addOrd").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodyOrd").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		return true;
		/*
		var data = $('form#form-ord').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutOrdonnance,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueOrd").click();
			// $("#tbodyOrd").html("");
			// $(".retour-ord").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-ord').fadeIn('fast',function(){
				// $('.retour-ord').fadeOut(6000);
			// });
			location.reload(true);
		});
		*/
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});


$(".reeducation_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupReeducat,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});

$(".laboratoire_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupLaboratoire,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});

$(".nouveau_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupNouveau,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});


$(".diagnostic_sej").on("click",function(){
	
	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: recupDiagnostic,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#recepConsultation").html(retour);
	});
	
	return false;
});


$(".addReeducation").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodyReeducation").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-reeducation').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutActeReeducation,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueReeducation").click();
			// $("#tbodyReeducation").html("");
			// $(".retour-reeducation").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-reeducation').fadeIn('fast',function(){
				// $('.retour-reeducation').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});


$(".addReeducation_2").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodyReeducation").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-reeducation').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutActeReeducation2,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueReeducation").click();
			// $("#tbodyReeducation").html("");
			// $(".retour-reeducation").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-reeducation').fadeIn('fast',function(){
				// $('.retour-reeducation').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});



$(".addMaladie").click(function(){
	// alert('ok');
	var nbError = 0;
	var tab = $("#tbodyMaladie").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-maladie').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutMaladie,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueImagerie").click();
			// $("#tbodyMaladie").html("");
			// $(".retour-maladie").addClass("alert alert-success").html('Donnée(s) enregistrée(s) avec succès');
			// $('.retour-maladie').fadeIn('fast',function(){
				// $('.retour-maladie').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});


$(".addLabo").click(function(){
	// alert('ok');
	var nbError = 0;
	var tab = $("#tbodyLabo").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-labo').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutLabo,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueImagerie").click();
			// $("#tbodyLabo").html("");
			// $(".retour-labo").addClass("alert alert-success").html('Donnée(s) enregistrée(s) avec succès');
			// $('.retour-labo').fadeIn('fast',function(){
				// $('.retour-labo').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});


$(".addLabo_2").click(function(){
	// alert('ok');
	var nbError = 0;
	var tab = $("#tbodyLabo").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-labo').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutLabo2,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueImagerie").click();
			// $("#tbodyLabo").html("");
			// $(".retour-labo").addClass("alert alert-success").html('Donnée(s) enregistrée(s) avec succès');
			// $('.retour-labo').fadeIn('fast',function(){
				// $('.retour-labo').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});


$(".addSoins").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodySoins").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-soins').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutActeInfirmier,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueSoins").click();
			// $("#tbodySoins").html("");
			// $(".retour-soins").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-soins').fadeIn('fast',function(){
				// $('.retour-soins').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});


$(".addSoins_2").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodySoins").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-soins').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutActeInfirmier2,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueSoins").click();
			// $("#tbodySoins").html("");
			// $(".retour-soins").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-soins').fadeIn('fast',function(){
				// $('.retour-soins').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});


$(".addImagerie").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodyImagerie").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-imagerie').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutActeImagerie,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueImagerie").click();
			// $("#tbodyImagerie").html("");
			// $(".retour-imagerie").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-imagerie').fadeIn('fast',function(){
				// $('.retour-imagerie').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});



$(".addImagerie_2").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodyImagerie").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-imagerie').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutActeImagerie2,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueImagerie").click();
			// $("#tbodyImagerie").html("");
			// $(".retour-imagerie").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-imagerie').fadeIn('fast',function(){
				// $('.retour-imagerie').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});



$(".addexp").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodyExp").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-exp').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutActeExp,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueExp").click();
			// $("#tbodyExp").html("");
			// $(".retour-exp").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-exp').fadeIn('fast',function(){
				// $('.retour-exp').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});



$(".addexp_2").click(function(){
	// alert();
	var nbError = 0;
	var tab = $("#tbodyExp").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-exp').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutActeExp2,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			// alert(retour);
			// $("a.cliqueExp").click();
			// $("#tbodyExp").html("");
			// $(".retour-exp").addClass("alert alert-success").html('Données enregistrées avec succès');
			// $('.retour-exp').fadeIn('fast',function(){
				// $('.retour-exp').fadeOut(6000);
			// });
			location.reload(true);
		});
	}
	else{
		alert("La liste à enregistrer est vide");
	}
	
	return false;
});





$("select.unitePresc").on("change",function(){
	// alert();
	var data = $('select.unitePresc').val();
	// alert(data);
	$.ajax({
		type:"POST",
		url: listeChambreUniteDispo,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("select.chambrePresc").html(retour);
	});
	
	return false;
});


$("select.chambrePresc").on("change",function(){
	// alert();
	var data = $('select.chambrePresc').val();
	// alert(data);
	$.ajax({
		type:"POST",
		url: listeLitChambreDispo,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("select.litPresc").html(retour);
	});
	
	return false;
});


