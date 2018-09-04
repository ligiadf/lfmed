<div class="row justify-content-center">
	<div class="col-md-10">
	<header class="mt-4 mb-4">
		<h1>
			<?php
				if($con_status=='0') { echo "<span class='text-danger'>Indisponibilidade</span>"; }
					else { echo "Detalhes da consulta"; } ?>
			<small style="font-size: 40%;" class="badge badge-pill  badge-light"><?php echo $id; ?></small>
		</h1>
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

	<?php if($con_status == '0'): ?>
		<h5><i class="far fa-calendar-alt mr-1"></i> <?php echo $con_data." - ".$con_data_fim; ?> <i class="far fa-clock ml-5 mr-1"></i> <?php echo $con_hora." - ".$con_hora_fim; ?></h5>
	<?php else: ?>
		<h5><i class="far fa-calendar-alt mr-1"></i> <?php echo $con_data; ?> <i class="far fa-clock ml-5 mr-1"></i> <?php echo $con_hora; ?></h5>
	<?php endif; ?>

	<?php
		switch ($con_status) {
/*			case "0":
				$situacao = "<p class='text-danger'><i class='fas fa-ban mr-1'></i>Indisponibilidade</p>";
				break;*/
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

	<h4><i class="fas fa-user-md mr-1"></i> <a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $med_id; ?>" title="Ver ficha do médico" target="_blank"><?php echo $med_nome; ?></a>
	<span class="d-sm-none"><br></span>
	<small>
	<?php
		if($especialidade == 'Oftalmologista') { echo '<i class="fas fa-deaf mr-1"></i> Oftalmologista'; }
			else { echo '<i class="far fa-eye mr-1"></i> Otorrinolaringologista'; }
	?>
	</small>
	</h4>

	<?php if($con_status != '0'): ?>
		<h5><i class="fas fa-user mr-1"></i> <a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $pac_id; ?>" title="Ver ficha do paciente" target="_blank"><?php echo $pac_nome; ?></a></h5>
	<?php endif; ?>



	<p class="mt-2 text-right">
		<a class="btn btn-warning" href="<?php echo BASE_URL ?>consultas/editar/<?php echo $id; ?>"><i class="far fa-calendar-check mr-1"></i> Editar</a>
	</p>

<?php if($con_status == '2'): ?>
	<p><a class="btn btn-info" href="<?php echo BASE_URL ?>consultas/comprovante/<?php echo $id; ?>" target="_blank"><i class="fas fa-file-contract mr-1"></i> Comprovante</a></p>

<div class="card-deck">
	<div class="card mt-3">
		<div class="card-header"><i class="fas fa-file-signature mr-1"></i> Atestado</div>
		<div class="card-body">
			<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			<a href="<?php echo BASE_URL ?>consultas/anotacoes" class="btn btn-info"><i class="fas fa-plus mr-1"></i> Adicionar</a>
		</div>
	</div>

	<div class="card mt-3">
		<div class="card-header"><i class="fas fa-file-medical mr-1"></i> Anotações</div>
		<div class="card-body">
			<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			<a href="<?php echo BASE_URL ?>anotacoes/adicionar" class="btn btn-info"><i class="fas fa-plus mr-1"></i> Adicionar</a>
		</div>
	</div>
</div>
<div class="card-deck">
	<div class="card mt-3">
		<div class="card-header"><i class="fas fa-pills mr-1"></i> Medicamentos</div>
		<div class="card-body">
			<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			<a href="<?php echo BASE_URL ?>medicamentos/adicionar" class="btn btn-info"><i class="fas fa-plus mr-1"></i> Adicionar</a>
		</div>
	</div>

	<div class="card mt-3">
		<div class="card-header"><i class="fas fa-prescription mr-1"></i> Exames</div>
		<div class="card-body">
			<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			<a href="<?php echo BASE_URL ?>exames/adicionar" class="btn btn-info"><i class="fas fa-plus mr-1"></i> Adicionar</a>
		</div>
	</div>
</div>
<?php endif; ?>

	</div><!-- col-md-6 -->
</div><!-- row -->