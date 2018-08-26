<header>
	<h1>Marcar consulta</h1>
</header>

<?php if(!empty($msgIndisponibilidadeMedico)): ?>
	<div class="alert alert-danger">
		<?php echo $msgIndisponibilidadeMedico; ?>
	</div>
<?php endif ?>

<?php if(!empty($msgConsultaMarcada)): ?>
	<div class="alert alert-success">
		<?php echo $msgConsultaMarcada; ?>
	</div>
<?php endif ?>


<form method="POST">
	<div class="form-group">
		<label for="medico">Selecione o médico</label>
		<select class="form-control" id="medico" name="medico">
			<?php
			foreach($medicos as $item):
			?>
				<option value=" <?php echo $item['id']; ?> " > <?php echo $item['nome'] ." (". $item['especialidade'] .")"; ?></option>
			<?php
			endforeach;
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="dataConsulta">Data da consulta</label>
		<input type="date" class="form-control" id="dataConsulta" name="dataConsulta">
	</div>

	<div class="form-group">
		<label for="horaConsulta">Horário da consulta</label>
		<input type="time" class="form-control" id="horaConsulta" name="horaConsulta">
	</div>

	<div class="form-group">
		<label for="paciente">Selecione o paciente</label>
		<select class="form-control" id="paciente" name="paciente">
			<?php
			foreach($pacientes as $item):
			?>
				<option value=" <?php echo $item['id']; ?> "> <?php echo $item['nome']." [CPF: ".$item['cpf']."]"; ?></option>
			<?php
			endforeach;
			?>
		</select>
	</div>

	<input type="hidden" id="statusConsulta" name="statusConsulta" value="1">

	<button type="submit" class="btn btn-primary">Marcar consulta</button>
</form>