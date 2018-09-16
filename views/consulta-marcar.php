<div class="row justify-content-center">
	<div class="col-md-6">
	<header class="mt-4 mb-4">
		<h1>Marcar consulta</h1>
	</header>

	<?php if(!empty($_GET['msgError'])): ?>
		<div class="alert alert-danger">
			<?php echo $_GET['msgError']; ?>
		</div>
	<?php endif ?>

	<?php if(!empty($_GET['msgOK'])): ?>
		<div class="alert alert-success">
			<?php echo $_GET['msgOK']; ?>
		</div>
	<?php endif ?>


	<form method="POST">
		<div class="form-group">
			<label for="medico"><i class="fas fa-user-md mr-1"></i> Médico(a):</label>
			<select class="form-control" id="medico" name="medico" required>
					<option value="">-- Selecione --</option>
				<?php foreach($medicos as $item): ?>
					<option value=" <?php echo $item['id']; ?> " > <?php echo $item['nome'] ." (". $item['especialidade'] .")"; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="dataConsulta"><i class="far fa-calendar-alt mr-1"></i> Data:</label>
			<input type="text" class="form-control" id="dataConsulta" name="dataConsulta" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}" maxlength="10" placeholder="DD/MM/AAAA" data-mask="99/99/9999" required>
			<small id="dataConsultaHelp" class="form-text text-muted">Preencha no formato DD/MM/AAAA. Ex.: 26/08/2018</small>
		</div>

		<div class="form-group">
			<label for="horaConsulta"><i class="far fa-clock mr-1"></i> Horário:</label>
			<input type="text" class="form-control" id="horaConsulta" name="horaConsulta" pattern="(2[0-3]|1[0-9]|0[0-9]):([0-5][0-9])" maxlength="5" placeholder="HH:mm" data-mask="99:99" required>
			<small id="horaConsultaHelp" class="form-text text-muted">Preencha no formato HH:mm. Ex.: 16:00</small>
		</div>

		<div class="form-group">
			<label for="paciente"><i class="fas fa-users mr-1"></i> Paciente:</label>
			<select class="form-control" id="paciente" name="paciente" required>
					<option value="">-- Selecione --</option>
				<?php foreach($pacientes as $item): ?>
					<option value=" <?php echo $item['id']; ?> "> <?php echo $item['nome']." [CPF: ".$item['cpf']."]"; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<input type="hidden" id="statusConsulta" name="statusConsulta" value="1">

		<div class="row">
			<div class="col-6">
				<a class="btn btn-link text-danger" href="<?php echo BASE_URL ?>consultas"><i class="fas fa-times mr-1"></i> Cancelar</a>
			</div>
			<div class="col-6 text-right">
				<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Marcar</button>
			</div>
		</div>
	</form>
	</div><!-- col-md-6 -->
</div><!-- row -->