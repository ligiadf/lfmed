<div class="row justify-content-center">
	<div class="col-md-8">
	<header class="mt-4 mb-4">
		<h1><?php if($con_status=='0') { echo "<span class='text-danger'><i class='fas fa-ban mr-1'></i> Indisponibilidade</span>"; } else { echo "Detalhes da consulta"; } ?></h1>
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
			<p><i class="fas fa-passport mr-1"></i> <strong>ID:</strong> <?php echo $id; ?></p>
		</div>

		<div class="form-group">
			<label for="medico"><i class="fas fa-user-md mr-1"></i> Médico(a):</label>
			<select class="form-control" id="medico" name="medico" required>
				<?php foreach($medicos as $item): ?>
					<option value="<?php echo $item['id']; ?>" <?php if($medicoSelecionadoID == $item['id']) { echo "selected"; } ?>> <?php echo $item['id']." ".$item['nome'] ." (". $item['especialidade'] .")"; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-row">
			<div class="form-group col-sm-6">
				<label for="dataConsulta"><i class="far fa-calendar-alt mr-1"></i> Data:</label>
				<input type="text" class="form-control" id="dataConsulta" name="dataConsulta" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" maxlength="10" placeholder="DD/MM/AAAA" value="<?php echo $con_data; ?>" required>
				<small id="dataConsultaHelp" class="form-text text-muted">Preencha no formato DD/MM/AAAA. Ex.: 26/08/2018</small>
			</div>

			<div class="form-group col-sm-6">
				<label for="horaConsulta"><i class="far fa-clock mr-1"></i> Horário início:</label>
				<input type="text" class="form-control" id="horaConsulta" name="horaConsulta" maxlength="8" placeholder="HH:mm" value="<?php echo $con_hora; ?>" required>
				<small id="horaConsultaHelp" class="form-text text-muted">Preencha no formato HH:mm. Ex.: 16:00</small>
			</div>
		</div><!-- form-row -->

<?php if($con_status == 0): ?>

		<div class="form-row" id="blocoIndisponibilidade">
			<div class="form-group col-sm-6">
				<label for="dataConsultaFim"><i class="far fa-calendar-alt mr-1"></i> Data fim:</label>
				<input type="text" class="form-control" id="dataConsultaFim" name="dataConsultaFim" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" maxlength="10" placeholder="DD/MM/AAAA" value="<?php echo $con_data_fim; ?>" required>
				<small id="dataConsultaFimHelp" class="form-text text-muted">Preencha no formato DD/MM/AAAA. Ex.: 26/08/2018</small>
			</div>

			<div class="form-group col-sm-6">
				<label for="horaConsultaFim"><i class="far fa-clock mr-1"></i> Horário fim:</label>
				<input type="text" class="form-control" id="horaConsultaFim" name="horaConsultaFim" pattern="[0-9]{2}:[0-9]{2}" maxlength="5" placeholder="HH:mm" value="<?php echo $con_hora_fim; ?>" required>
				<small id="horaConsultaFimHelp" class="form-text text-muted">Preencha no formato HH:mm. Ex.: 16:00</small>
			</div>
		</div><!-- form-row -->

<?php endif; ?>


<?php if($con_status != 0): ?>

		<div class="form-group">
			<label for="paciente"><i class="fas fa-users mr-1"></i> Paciente:</label>
			<select class="form-control" id="paciente" name="paciente" required>
				<?php foreach($pacientes as $item): ?>
					<option value="<?php echo $item['id']; ?>" <?php if($pacienteSelecionadoID == $item['id']) { echo "selected"; } ?>> <?php echo $item['id']." ".$item['nome']." [CPF: ".$item['cpf']."]"; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-row justify-content-left">
			<label for="statusConsulta" class="col-12"><i class="fas fa-user mr-1"></i> Situação:</label>
			<div class="form-group col-md-4">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="statusConsulta" id="statusConsulta1" value="1" <?php if($con_status == '1') { echo "checked"; }; ?>>
					<label class="form-check-label text-primary" for="statusConsulta1"><i class='far fa-calendar-check mr-1'></i> Marcada (1)</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="statusConsulta" id="statusConsulta2" value="2" <?php if($con_status == '2') { echo "checked"; }; ?>>
					<label class="form-check-label text-success" for="statusConsulta2"><i class='fas fa-check mr-1'></i> Realizada (2)</label>
				</div>
			</div>
			<div class="form-group col-md-4">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="statusConsulta" id="statusConsulta3" value="3" <?php if($con_status == '3') { echo "checked"; }; ?>>
					<label class="form-check-label text-secondary" for="statusConsulta3"><i class='far fa-user mr-1'></i> Ausente (3)</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="statusConsulta" id="statusConsulta4" value="4" <?php if($con_status == '4') { echo "checked"; }; ?>>
					<label class="form-check-label text-secondary" for="statusConsulta4"><i class='far fa-calendar-times mr-1'></i> Cancelada (4)</label>
				</div>
			</div>

		</div><!--form-row -->

<?php endif; ?><!-- $con_status != 0 -->

		<div class="row">
			<div class="col-6">
				<a class="btn btn-link text-danger" href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $id; ?>"><i class="fas fa-times mr-1"></i> Cancelar edição</a>
			</div>
			<div class="col-6 text-right">
				<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Atualizar consulta</button>
			</div>
		</div>
	</form>
	</div><!-- col-md-6 -->
</div><!-- row -->