$(document).ready(function(){

// Obrigar a preencher ao menos um filtro
	var medico = $('select[id=medico]').val();
	var status = $('select[id=status]').val();
	var data_inicial = $('select[id=data_inicial]').val();
	var data_final = $('select[id=data_final]').val();

	if(medico == '' && status == '' && data_inicial == '' && data_final == '') {
		$('button[id=filtro]').prop('disabled', true);
		$('button[id=filtro]').prop('title', 'Selecione pelo menos um campo');
	}

	$('select[id=medico]').change(function() {
		$('button').prop('disabled', false);
	});

	$('select[id=status]').change(function() {
		$('button').prop('disabled', false);
	});

	$('select[id=data_inicial]').click(function() {
		$('button').prop('disabled', false);
	});

	$('select[id=data_final]').click(function() {
		$('button').prop('disabled', false);
	});


});