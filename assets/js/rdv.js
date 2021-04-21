

$(".addDir").click(function(){
	// alert();
	var nbError = 0;
		$("form#form-dir input.form-control.obligatoire").each(function(){
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
		var data = $('form#form-dir').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: prendreRendezVous,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
	// alert(retour);
			$(".retour").removeClass("alert-danger").html(retour).addClass("alert alert-success");
			$('.retour').fadeIn('fast',function(){
				$('.retour').fadeOut(4000);
			});
			$("form#form-dir .form-control").val("");
			$("textarea#objet").val("");
			
			
		});
	}
	else{
		$(".retour").addClass("alert alert-danger").html("Veuillez remplir les champs obligatoires").removeClass("success");
	}
	
	return false;
});

