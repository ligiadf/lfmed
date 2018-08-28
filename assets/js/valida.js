// Seleção de campos para usuários conforme perfil
$(':radio[id=perfil1]').change(function() {
	$("#apenasMedicos").attr("disabled", false);
	$("#especialidade1").attr("required", true);
	$("#especialidade2").attr("required", true);
	$("#crm").attr("required", true);
});
$(':radio[id=perfil2]').change(function() {
	$("#apenasMedicos").attr("disabled", true);
	$("#especialidade1").attr("required", false);
	$("#especialidade2").attr("required", false);
	$("#crm").attr("required", false);
});

