$(document).ready(function(){

// Obrigar a preencher ao menos um filtro
	var medico = $('select[id=medico]').val();
	var status = $('select[id=status]').val();

	if(medico == '' && status == '') {
		$("button").prop("disabled", true);
		$("button").prop("title", "Selecione pelo menos um campo");
	}

	$('select[id=medico]').change(function() {
		$("button").prop("disabled", false);
	});

	$('select[id=status]').change(function() {
		$("button").prop("disabled", false);
	});

});