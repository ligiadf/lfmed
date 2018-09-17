<div class="row justify-content-center">
	<div class="col-md-10">

	<?php if(!empty($_GET['msgError'])): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $_GET['msgError']; ?>
		</div>
	<?php endif ?>

	<?php if(!empty($_GET['msgOK'])): ?>
		<div class="alert alert-success" role="alert">
			<?php echo $_GET['msgOK']; ?>
		</div>
	<?php endif ?>

	<header class="mt-4 mb-4">
		<h1>
			<?php
				if($con_status=='0') { echo "<span class='text-danger'>Indisponibilidade</span>"; }
					else { echo "Detalhes da consulta"; } ?>
			<small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $id; ?></small>
		</h1>
	</header>

	<?php if($con_status == '0'): ?>
		<h5>
			<i class="far fa-calendar-alt mr-1"></i> <?php echo $con_data; ?> <i class="far fa-clock ml-3 mr-1"></i> <?php echo $con_hora; ?>
		</h5>
		<h5>
			<i class="far fa-calendar-alt mr-1"></i> <?php echo $con_data_fim; ?> <i class="far fa-clock ml-3 mr-1"></i> <?php echo $con_hora_fim; ?>
		</h5>
	<?php else: ?>
		<h5><i class="far fa-calendar-alt mr-1"></i> <?php echo $con_data; ?> <i class="far fa-clock ml-5 mr-1"></i> <?php echo $con_hora; ?></h5>
	<?php endif; ?>

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

	<?php if($con_status != '0'): ?>
		<h4 class="mt-4">
			<i class="fas fa-user mr-1"></i> <a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $pac_id; ?>" title="Ver ficha do paciente"><?php echo $pac_nome; ?></a>
		</h4>
	<?php endif; ?>

	<h5 class="mt-4">
		<i class="fas fa-user-md mr-1"></i> <a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $med_id; ?>" title="Ver ficha do médico"><?php echo $med_nome; ?></a>
		<span class="d-sm-none"><br></span>
		<small class="h6">
		<?php
			if($especialidade == 'Oftalmologista') { echo '<i class="far fa-eye ml-3 mr-0"></i> Oftalmologista'; }
				else { echo '<i class="fas fa-deaf ml-3 mr-0"></i> Otorrinolaringologista'; }
		?>
		</small>
	</h5>

	<p class="mt-2 text-right">
		<a class="btn btn-warning" href="<?php echo BASE_URL ?>consultas/editar/<?php echo $id; ?>"><i class="far fa-calendar-check mr-1"></i> Editar</a>
	</p>

<?php if($con_status == '2'): ?>
	<p><a class="btn btn-info" href="<?php echo BASE_URL ?>consultas/comprovante/<?php echo $id; ?>" target="_blank"><i class="fas fa-file-contract mr-1"></i> Comprovante</a></p>

<div class="card-deck">
	<div class="card border-light mt-3">
		<div class="card-header"><i class="fas fa-file-signature mr-1"></i> Atestado</div>
		<div class="card-body">
			<p class="card-text">
				<?php
					if(!empty($atestado_periodo)){
						echo "Atestado ".$atestado_periodo." por ".$atestado_motivo;
						if(!empty($atestado_cid)) {
							echo " (".$atestado_cid.")";
						}
						echo ".";
					} else {
						echo "Não há atestado vinculado a esta consulta.";
					}
				?>
			</p>

			<p class="card-text text-center">
				<?php if(!empty($atestado_periodo)): ?>
					<a href="<?php echo BASE_URL ?>atestados/editar/<?php echo $id; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit mr-1"></i> Editar</a>
					<a href="<?php echo BASE_URL ?>atestados/imprimir/<?php echo $id; ?>" target="_blank" class="btn btn-dark btn-sm ml-5"><i class="fas fa-file-pdf mr-1"></i></i> Imprimir</a>
				<?php else: ?>
					<a href="<?php echo BASE_URL ?>atestados/adicionar/<?php echo $id; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-plus mr-1"></i> Adicionar</a>
				<?php endif; ?>
			</p>

		</div>
	</div>

	<div class="card border-light mt-3">
		<div class="card-header"><i class="fas fa-file-medical mr-1"></i> Anotações</div>
		<div class="card-body">
			<p class="card-text">
				<?php
					if(!empty($anotacao)){ echo $anotacao; }
					else { echo "Não há anotação vinculada a esta consulta."; }
				?>
			</p>

			<p class="card-text text-center">
				<?php if(!empty($anotacao)): ?>
					<a href="<?php echo BASE_URL ?>anotacoes/editar/<?php echo $id; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit mr-1"></i> Editar</a>
				<?php else: ?>
					<a href="<?php echo BASE_URL ?>anotacoes/adicionar/<?php echo $id; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-plus mr-1"></i> Adicionar</a>
				<?php endif; ?>
			</p>

		</div>
	</div>
</div>
<div class="card-deck">
	<div class="card border-light mt-3">
		<div class="card-header"><i class="fas fa-pills mr-1"></i> Medicamentos</div>
		<div class="card-body">
			<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			<a href="<?php echo BASE_URL ?>medicamentos/adicionar" class="btn btn-secondary btn-sm"><i class="fas fa-plus mr-1"></i> Adicionar</a>
		</div>
	</div>

	<div class="card border-light mt-3">
		<div class="card-header"><i class="fas fa-prescription mr-1"></i> Exames</div>
		<div class="card-body">
			<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			<a href="<?php echo BASE_URL ?>exames/adicionar" class="btn btn-secondary btn-sm"><i class="fas fa-plus mr-1"></i> Adicionar</a>
		</div>
	</div>
</div>
<?php endif; ?>
	</div><!-- col-md-6 -->
</div><!-- row -->