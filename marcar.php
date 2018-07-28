<?php
	require 'config.php';
	include_once 'header.php';
?>

<h2>Marcar consulta</h2>

<?php

if(!empty($_POST['medico'])) {
	$id_medico = addslashes($_POST['medico']);
	$dataConsulta = explode('/', addslashes($_POST['dataConsulta']));
	$horaConsulta = addslashes($_POST['horaConsulta']);
	$paciente = addslashes($_POST['paciente']);
	$statusConsulta = addslashes($_POST['statusConsulta']);

	// AAAA-MM-DD HH:MM
	$dtConsulta_inicio = $dataConsulta[2].'-'.$dataConsulta[1].'-'.$dataConsulta[0].' '.$horaConsulta;

	$dtConsulta_fim = $dtConsulta_inicio + strtotime();

	if($consultas->verificarAgenda($medico, $dtConsulta, $statusConsulta)) {
		$consultas->marcar($medico, $dtConsulta, $paciente, $statusConsulta);
	} else {
		echo "O médico não está disponível nesta data. Favor escolher outra";
	}
}

?>

<form method="POST">
	<div class="form-group">
		<label for="medico">Selecione o médico</label>
		<select class="form-control" id="medico" name="medico">
			<?php
			$lista = $medicos->listaMedicos();
			foreach($lista as $medico):
			?>
				<option value=" <?php echo $medico['id']; ?> " > <?php echo $medico['med_nome'] ." (". $medico['id'] .")"; ?></option>
			<?php
			endforeach;
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="dataConsulta">Data da consulta</label>
		<input type="text" class="form-control" id="dataConsulta" name="dataConsulta">
	</div>

	<div class="form-group">
		<label for="horaConsulta">Horário da consulta</label>
		<input type="text" class="form-control" id="horaConsulta" name="horaConsulta">
	</div>

	<div class="form-group">
		<label for="paciente">Nome do paciente</label>
		<input type="text" class="form-control" id="paciente" name="paciente">
	</div>

	<div class="form-group">
		<label for="statusConsulta">Status</label>
		<input type="text" class="form-control" id="statusConsulta" name="statusConsulta" value="Marcada" disabled>
	</div>

	<button type="submit" class="btn btn-primary">Marcar consulta</button>
</form>

<?php include_once 'footer.php'; ?>