$(document).ready(function(){

// Seleção de campos para usuários conforme perfil
	var perfil = $('input[type=radio][name=perfil]:checked').val();

	if(perfil == 'MED') {
		$("#apenasMedicos").prop("disabled", false);
		$("#especialidade1").prop("required", true);
		$("#especialidade2").prop("required", true);
		$("#crm").prop("required", true);
	}
	else if (perfil == 'REC') {
		$("#apenasMedicos").prop("disabled", true);
		$("#especialidade1").prop("required", false);
		$("#especialidade2").prop("required", false);
		$("#crm").prop("required", false);
	}

	$('input[type=radio][id=perfil1]').click(function() {
		$("#apenasMedicos").prop("disabled", false);
		$("#especialidade1").prop("required", true);
		$("#especialidade2").prop("required", true);
		$("#crm").prop("required", true);
	});
	$('input[type=radio][id=perfil2]').click(function() {
		$("#apenasMedicos").prop("disabled", true);
		$("#especialidade1").prop("required", false);
		$("#especialidade2").prop("required", false);
		$("#crm").prop("required", false);
	});

});