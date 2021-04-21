

$(".sortieReac").click(function(){
	// alert('ok');
	var nbError = 0;

	var check = $("form#form-sortie input[type=checkbox]:checked");
	
	if(check.length == 0){
		alert('Champs vide');
		nbError++;
	}
	
	$("form#form-sortie select.obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			alert('Champs vide');
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
			$(this).removeClass("obligatoire-color");
		}
	});
	
	
	if(nbError == 0){
		
		$(".retour").removeClass("alert alert-danger").html('');
		var data = $('form#form-sortie').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: sortieReactif,
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
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});




$(".destockReactif").on("click",function(){
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
		url: destockageReactif,
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



$(".checkReactif").click(function(){
	var check = $("input[type=checkbox]:checked");
	if(check.length >= 1){
		$("#destock").removeClass("cacher");
		$("#sortir").removeClass("cacher");
	}
	else{
		$("#destock").addClass("cacher");
		$("#sortir").addClass("cacher");
	}
	
	if(check.length == 1){
		var nombre= check.length+" réactif selectionné";
	}
	else if(check.length > 1){
		var nombre= check.length+" réactifs selectionnés";
	}
	
	$(".nombre").html(nombre)
});


$(".addEntreeRea").click(function(){
	// alert('ok');
	var nbError = 0;
	var tab = $("#tbody").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-arm').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: entreeReac,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
			alert(retour);
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

$("#sortirAccessoire").click(function(){
	// alert('ok');
	var nbError = 0;
	
	$("form#form-sortir-accessoire input.form-control.obligatoire").each(function(){
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
	$("form#form-sortir-accessoire select.form-control.obligatoire").each(function(){
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
		var data = $('form#form-sortir-accessoire').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: sortirAccessoire,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){	
			
			if(retour =='La quantité saisie est supérieure à la quantité en stock'){
				$(".retour").addClass("alert alert-danger").html(retour).addClass("danger");
				$("form#form-sortir-accessoire input#qte").parent("div").addClass("has-error");
			}else{
				$(".retour").addClass("alert alert-success").html("Opération effectuée avec succès").removeClass("danger");
				$("form#form-sortir-accessoire input").val("");
				$('.retour').fadeIn('fast',function(){
				$('.retour').fadeOut(6000);
			});
			}
			
		});
		
	}
	else{
		$(".retour").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});





$(".addEntreeAcc").click(function(){
	// alert('ok');
	var nbError = 0;
	var tab = $("#tbody").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	if(nbError == 0){
		var data = $('form#form-arm').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: entreeAccessoire,
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



$(".sortir").on("click",function(){

	var data = $(this).attr("rel");
	// alert(data);
	$.ajax({
		type:"POST",
		url: ensembleSortie,
		data:"id="+data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#body").html(retour);
	});
	
	return false;
});
