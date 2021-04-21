$(function () {
    $('.js-modal-buttons .btn').on('click', function () {
        var color = $(this).data('color');
        $('#mdModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModal').modal('show');
    });
});

$(function () {
    $('.finish').on('click', function () {
        var color = $(this).data('color');
        $('#mdModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModal').modal('show');
    });
});


$(function () {
    $('.ajout_service').on('click', function () {
        var color = $(this).data('color');
        $('#largeModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#largeModal').modal('show');
    });
});


$(function () {
    $('.modifier_courrier').on('click', function () {
        var color = $(this).data('color');
        $('#modifCourrier .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modifCourrier').modal('show');
    });
});

$(function (){
	$('.corriger_courrier').on('click', function () {
		$('#corigCourrier').modal('show');
		// alert();
	});
});

$(function () {
    $('.ajout_unite').on('click', function () {
        var color = $(this).data('color');
        $('#largeModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#largeModal').modal('show');
    });
});


$(function () {
    $('.sortir').on('click', function () {
        var color = $(this).data('color');
        $('#mdModalSortie .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModalSortie').modal('show');
    });
});

$(function () {
    $('.finishPatient').on('click', function () {
        var color = $(this).data('color');
        $('#mdModalPatient .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModalPatient').modal('show');
    });
});

$(function () {
    $('.finaleComplement').on('click', function () {
        var color = $(this).data('color');
        $('#mdModalPatientComplet .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModalPatientComplet').modal('show');
    });
});


$(function () {
    $('.ajout_typeAss').on('click', function () {
        var color = $(this).data('color');
        $('#mdModalType .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModalType').modal('show');
    });
});

$(function () {
    $('.ajout_couverture').on('click', function () {
        var color = $(this).data('color');
        $('#mdModalCouverture .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModalCouverture').modal('show');
    });
});

$(function () {
    $('.finishOrient').on('click', function () {
        var color = $(this).data('color');
        $('#mdModalOrientation .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModalOrientation').modal('show');
    });
});

$(function () {
    $('#facture').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalPaye .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalPaye').modal('show');
    });
});


$(function () {
    $('#facture_2').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalPaye .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalPaye').modal('show');
    });
});



$(function () {
    $('.consu_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});

$(function () {
    $('.clickBon').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#mdModalBon .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModalBon').modal('show');
    });
});
$(function () {
    $('.const_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});
$(function () {
    $('.info_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});
$(function () {
    $('.const_sej_2').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});
$(function () {
    $('.ordo_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});
$(function () {
    $('.soins_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});
$(function () {
    $('.imagerie_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});
$(function () {
    $('.hospitalisation_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});

$(function () {
    $('.exp_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});
$(function () {
    $('.laboratoire_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});


$(function () {
    $('.ajout_stock').on('click', function () {
        var color = $(this).data('color');
        $('#largeModalStock .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#largeModalStock').modal('show');
    });
});

$(function () {
    $('.list_stock').on('click', function () {
        var color = $(this).data('color');
        $('#largeModalStock .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#largeModalStock').modal('show');
    });
});

$(function () {
    $('.modif_stock').on('click', function () {
        var color = $(this).data('color');
        $('#largeModalStock .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#largeModalStock').modal('show');
    });
});
$(function () {
    $('.destock').on('click', function () {
        $('#mdModalDestock').modal('show');
    });
});
$(function () {
    $('.volontaire').on('click', function () {
        $('#mdModalDestockVolontaire').modal('show');
    });
});

$(function () {
    $('.reeducation_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});

$(function () {
    $('.nouveau_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});

$(function () {
    $('.deces_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});

$(function () {
    $('.diagnostic_sej').on('click', function () {
        var color = $(this).data('color');
		var paye=$(this).attr("rel");
        $('#modalConsulte .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#modalConsulte').modal('show');
    });
});


// $('#modalPaye').on('hidden.bs.modal', function () {
	// $("div#recepFact").html("ok");
// })

$('#mdModal').on('hidden.bs.modal', function () {
	location.reload(true);
});

$('#mdModalOrientation').on('hidden.bs.modal', function () {
	location.href=listePatient;
});

$('#mdModalPatient').on('hidden.bs.modal', function () {
	var rel=$(this).attr("rel");
	location.href=orientation+"/"+rel;
});

$('#mdModalPatientComplet').on('hidden.bs.modal', function () {
	location.href=listePatient;
});

$('#modalPaye').on('hidden.bs.modal', function () {
	location.href=listeAct;
});
