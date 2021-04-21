

$(".addLib").click(function(){
	// alert();
	var nbError = 0;
		$("form#form-lib input.form-control.obligatoire").each(function(){
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
	
	var tab = $("#tbody").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	
	if(nbError == 0){
		var data = $('form#form-lib').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutLigneBudget,
			data:data,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}	
		})
		.done(function(retour){
	// alert(retour);
			$(".retour").removeClass("alert alert-danger").html(retour).removeClass("success");
			$('.retour').fadeIn('fast',function(){
				$('.retour').fadeOut(6000);
			});
			$("form#form-lib .form-control").val("");
			$("textarea#edit").val("");
			$("#tbody").html("");
			// $("#finish").click();
			// $("div.refresh").html("<meta http-equiv='refresh' content='2'>");
			
		});
	}
	else{
		$(".retour").addClass("alert alert-danger").html("Veuillez remplir les champs obligatoire et renseigner les unités").removeClass("success");
	}
	
	return false;
});

