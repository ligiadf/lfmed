<?php
	require 'config.php';
	include_once 'header.php';

if(!empty($_POST['medico'])) {
	$id_medico = addslashes($_POST['medico']);
	$dataConsulta = explode('/', addslashes($_POST['dataConsulta']));
	$horaConsulta = addslashes($_POST['horaConsulta']);
	$paciente = addslashes($_POST['paciente']);
	$statusConsulta = addslashes($_POST['statusConsulta']);

	// AAAA-MM-DD HH:MM
	$dtConsulta_inicio = $dataConsulta[2].'-'.$dataConsulta[1].'-'.$dataConsulta[0].' '.$horaConsulta;

	// $dtConsulta_inicio + 30 minutos
	$dtConsulta_fim = date("Y-m-d H:i", strtotime($dtConsulta_inicio. '+30 minutes'));
	

	if($consultas->verificarAgenda($id_medico, $dtConsulta_inicio, $dtConsulta_fim)) {
		$consultas->marcar($id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente, $statusConsulta);
		header("Location: index.php");
		exit;
	} else {
		echo "O médico não está disponível nesta data. Favor escolher outra!";
	}
}

?>

<h2>Marcar consulta</h2>

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
		<input type="text" class="form-control" id="statusConsulta" name="statusConsulta" value="Marcada" readonly>
	</div>

	<button type="submit" class="btn btn-primary">Marcar consulta</button>
</form>

<?php include_once 'footer.php'; ?>