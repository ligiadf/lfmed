$(document).ready(function(){

// Seleção de campos para consultas conforme situaçãoo
	var situacao = $('input[type=radio][name=statusConsulta]:checked').val();

	// Indisponibilidade
	if(situacao == '0') {
		$("#paciente").prop("hidden", true);
		$("label[for=paciente]").prop("hidden", true);
	}
	else {
		$("#paciente").prop("hidden", false);
		$("label[for=paciente]").prop("hidden", false);
	}

	$('input[type=radio][id=statusConsulta0]').click(function() {
		ocultaPaciente();
		exibeDataHoraFim();
	});

	$('input[type=radio][id=statusConsulta1]').click(function() {
		exibePaciente();
		ocultaDataHoraFim();
	});
	$('input[type=radio][id=statusConsulta2]').click(function() {
		exibePaciente();
		ocultaDataHoraFim();
	});
	$('input[type=radio][id=statusConsulta3]').click(function() {
		exibePaciente();
		ocultaDataHoraFim();
	});
	$('input[type=radio][id=statusConsulta4]').click(function() {
		exibePaciente();
		ocultaDataHoraFim();
	});

	function exibePaciente() {
	$("#paciente").prop("hidden", false);
		$("#paciente").prop("disabled", false);
		$("#paciente").prop("required", true);
		$("label[for=paciente]").prop("hidden", false);
	}

	function ocultaPaciente() {
	$("#paciente").prop("hidden", true);
		$("#paciente").prop("disabled", true);
		$("#paciente").prop("required", false);
		$("label[for=paciente]").prop("hidden", true);
	}

	function exibeDataHoraFim() {
		$("#dataConsultaFim").prop("hidden", false);
		$("#dataConsultaFim").prop("disabled", false);
		$("label[for=dataConsultaFim]").prop("hidden", false);
		$("small#dataConsultaFimHelp").css("display", "inline");
		$("#horaConsultaFim").prop("hidden", false);
		$("#horaConsultaFim").prop("disabled", false);
		$("label[for=horaConsultaFim]").prop("hidden", false);
		$("small#horaConsultaFimHelp").css("display", "inline");
	}

	function ocultaDataHoraFim() {
		$("#dataConsultaFim").prop("hidden", true);
		$("#dataConsultaFim").prop("disabled", true);
		$("label[for=dataConsultaFim]").prop("hidden", true);
		$("small#dataConsultaFimHelp").css("display", "none");
		$("#horaConsultaFim").prop("hidden", true);
		$("#horaConsultaFim").prop("disabled", true);
		$("label[for=horaConsultaFim]").prop("hidden", true);
		$("small#horaConsultaFimHelp").css("display", "none");
		$("div#blocoIndisponibilidade").css("display", "none");
	}

});