

$(".suppList").click(function(){

	 var prod = $(this).attr("rel");
	 // alert(prod);
		$.ajax({
			type:"POST",
			url: suppFictif,
			data:"prod="+prod,
			async:true,
			error:function(xhr, status, error){
				alert(xhr.responseText);
			}
			
		})
		.done(function(retour){
			// alert(retour);
			var tab = retour.split("-//-");
			$("#retour").html("");
			$('#tbody').html(tab[0]);
			$('#tfooter').val(tab[1]);
			
		});
	
	
	return false;
});