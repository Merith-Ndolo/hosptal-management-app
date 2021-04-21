$(".addOpe").click(function(){
	// alert();
	var nbError = 0;
		$("form.form_ope .obligatoire").each(function(){
		if($.trim($(this).val()) == ""){
			$(this).parent("div").addClass("has-error");
			nbError++;
		}
		else{
			$(this).parent("div").removeClass("has-error");
		}
	});
	
	var tab = $("#tbody").html();
	if($.trim(tab)==""){
		nbError++;
	}
	
	
	if(nbError == 0){
		// return true;
		var recup=$("form.form_ope").serialize();
		alert(recup);
	}
	else{
		$(".retour").addClass("alert alert-danger").html("Veuillez remplir les champs obligatoire ").removeClass("success");
	}
	
	return false;
});