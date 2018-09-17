<div class="row justify-content-center">
	<div class="col-md-10">

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

	<header class="mt-4 mb-4">
		<h1>Editar anotação <small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $id; ?></small></h1>
	</header>

	<h5><i class="far fa-calendar-alt mr-1"></i> <?php echo $con_data; ?> <i class="far fa-clock ml-5 mr-1"></i> <?php echo $con_hora; ?></h5>

	<?php
		switch ($con_status) {
			case "1":
				$situacao = "<p class='text-info'><i class='far fa-calendar-check mr-1'></i>Marcada</p>";
				break;
			case "2":
				$situacao = "<p class='text-success'><i class='fas fa-check mr-1'></i> Realizada</p>";
				break;
			case "3":
				$situacao = "<p class='text-secondary'><i class='far fa-user mr-1'></i> Ausente</p>";
				break;
			case "4":
				$situacao = "<p class='text-secondary'><i class='far fa-calendar-times mr-1'></i> Cancelada</p>";
				break;
		}
		if(isset($situacao)) { echo $situacao; }
	?>

	<h4 class="mt-4">
		<i class="fas fa-user mr-1"></i> <a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $pac_id; ?>" title="Ver ficha do paciente"><?php echo $pac_nome; ?></a>
	</h4>

	<h5 class="mt-4 mb-4">
		<i class="fas fa-user-md mr-1"></i> <a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $med_id; ?>" title="Ver ficha do médico"><?php echo $med_nome; ?></a>
		<span class="d-sm-none"><br></span>
		<small class="h6">
		<?php
			if($especialidade == 'Oftalmologista') { echo '<i class="far fa-eye ml-3 mr-0"></i> Oftalmologista'; }
				else { echo '<i class="fas fa-deaf ml-3 mr-0"></i> Otorrinolaringologista'; }
		?>
		</small>
	</h5>

	<form method="POST">
		<div class="form-group col-12">
			<label for="anotacao">
				<h5 class="mt-3 mb-3"><i class="fas fa-file-signature mr-1"></i> Anotação</h5>
			</label>
			<textarea class="form-control" id="anotacao" name="anotacao" maxlength="500" rows="4" required><?php echo $anotacao; ?></textarea>
			<small id="anotacaoHelp" class="form-text text-muted">Preencha com anotações referentes ao relato do paciente e à observação clínica.</small>
		</div>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-link btn-sm text-danger" href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $id; ?>"><i class="fas fa-times mr-1"></i> Cancelar</a>
			</div>
			<div class="col-6 text-right">
				<button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check mr-1"></i> Editar</button>
			</div>
		</div>
	</form>
	</div><!-- col-md-6 -->
</div><!-- row -->