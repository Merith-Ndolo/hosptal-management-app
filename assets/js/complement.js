
$("#precedentAnt2").click(function(){
	$("#antecedent").click();
});
$("#precedentAnt3").click(function(){
	$("#allergie").click();
});
	
		
$("#suivantAnt").click(function(){
	
	var nbError1 = 0;
	
	$("form#form-antecedent select.form-control.obligatoire").each(function(){
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
	var verifAnt = $("form#form-antecedent select.form-control.obligatoire").val();
	if(verifAnt == "Oui"){
		var tab = $("#tbodyAnt").html();
		if($.trim(tab)==""){
			nbError1++;
		}
	}
	
	if(nbError1 == 0){
		$(".retour1").removeClass("alert alert-danger").html('');
		$("#allergie").click();
	}
	else{
		$(".retour1").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});

		
$("#suivantAll").click(function(){
	
	var nbError2 = 0;
	
	$("form#form-allergie select.form-control.obligatoire").each(function(){
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
	var verifAll = $("form#form-allergie select.form-control.obligatoire").val();
	if(verifAll == "Oui"){
		var tab = $("#tbodyAll").html();
		if($.trim(tab)==""){
			nbError2++;
		}
	}
	
	if(nbError2 == 0){
		$(".retour2").removeClass("alert alert-danger").html('');
		$("#contact").click();
	}
	else{
		$(".retour2").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});



$("#terminerAnt").click(function(){
	
	var nbError3 = 0;
	
	$("form#form-perContact select.form-control.obligatoire").each(function(){
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
	
	var verifPer = $("form#form-perContact select.form-control.obligatoire").val();
	if(verifPer == "Oui"){
		var tab = $("#tbodyPer").html();
		if($.trim(tab)==""){
			nbError3++;
		}
	}
	
	
	if(nbError3 == 0){
		
		$(".retour3").removeClass("alert alert-danger").html('');
		var data1 = $('form#form-antecedent').serialize();
		var data2 = $('form#form-perContact').serialize();
		var data3 = $('form#form-allergie').serialize();
		// alert(data);
		$.ajax({
			type:"POST",
			url: ajoutComplement,
			data:data1+"&"+data2+"&"+data3,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retourHtml){
			if(retourHtml=="ok"){
				$("#finale").click();
				$("div.refresh").html("<meta http-equiv='refresh' content='2'>");
			}
		});
		
	}
	else{
		$(".retour3").addClass("alert alert-danger").html('Veuillez SVP renseigner tous les champs obligatoires!');
	}
	
	
	return false;
});




$("select.ante").on("change",function(){

	var ante = $('select.ante').val();
	if(ante == "Oui"){
		$("div.liste").removeClass("cacher");
	}
	else{
		$("div.liste").addClass("cacher");
	}
	
});

$("select.all").on("change",function(){

	var allergie = $('select.all').val();
	if(allergie == "Oui"){
		$("div.listeAll").removeClass("cacher");
	}
	else{
		$("div.listeAll").addClass("cacher");
	}
	
});

$("select.per").on("change",function(){

	var per = $('select.per').val();
	if(per == "Oui"){
		$("div.listePer").removeClass("cacher");
	}
	else{
		$("div.listePer").addClass("cacher");
	}
	
});
