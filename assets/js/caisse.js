
$("select#ass").on("change",function(){

	var choix = $('select#ass').val();
	// alert(choix);
	if(choix == "Oui"){
		$("div#assurance").removeClass("cacher");
		$("div#assureur").removeClass("cacher");
		$("select#selectAssureur").addClass("obligatoire");
		$("select#selectAssurance").addClass("obligatoire");
	}
	else{
		$("div#assurance").addClass("cacher");
		$("div#assureur").addClass("cacher");
		$("select#selectAssureur").removeClass("obligatoire");
		$("select#selectAssurance").removeClass("obligatoire");
		var valeur= $("#clientPaie").val();
		// alert(valeur);
		$("#retourCharge").html('<input type="hidden" value="'+valeur+'" name="montant" />');
	}
	
});


$("select#selectAssurance").on("change",function(){

	var data = $('form#form-caisse').serialize();
	// alert(choix);
	$.ajax({
		type:"POST",
		url: chargeAssurance,
		data:data,
		async:true,
		error:function(xhr, status, error){
			alert(xhr.responseText);
		}
		
	})
	.done(function(retour){
		// alert(retour);
		$("#retourCharge").html(retour);
	});
	
	return false;
	
});
