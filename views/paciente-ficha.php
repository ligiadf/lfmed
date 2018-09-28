<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'pacientes'; ?>">Pacientes</a></li>
	<li class="breadcrumb-item active">Ficha do paciente</li>
</ol>
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
		<h1>
			<?php echo $nome; ?>
			<small style="font-size: 40%;" class="badge badge-pill  badge-light"><?php echo $id; ?></small>
		</h1>
	</header>

	<h5><i class="fas fa-birthday-cake mr-1"></i> <?php echo $idade; ?></h5>

	<p><i class="fas fa-envelope mr-1"></i> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
	<p><i class="fas fa-phone mr-1"></i> <?php echo $telefone; ?></p>
	<p><i class="fas fa-id-card mr-1"></i> CPF <?php echo $cpf; ?></p>
	<p><i class="fas fa-briefcase-medical mr-1"></i> <?php echo $plano_saude; ?></p>

	<p class="mt-2">
		<a class="btn btn-warning" href="<?php echo BASE_URL ?>pacientes/editar/<?php echo $id; ?>"><i class="fas fa-user-edit mr-1"></i> Editar paciente</a>
	</p>
	</div><!-- col-md-10 -->

	<div class="col-md-10">

	<header class="mt-4 mb-4">
		<h2>Exames</h2>
	</header>

	<p class="mt-2">
		<a class="btn btn-primary" href="<?php echo BASE_URL ?>exames/paciente/<?php echo $id; ?>"><i class="fas fa-prescription mr-1"></i> Ver exames</a>
	</p>

	<header class="mt-4 mb-4">
		<h2>Consultas</h2>
	</header>

	<p class="mt-2">
		<a class="btn btn-primary btn-sm" href="<?php echo BASE_URL.'consultas/marcar/?pc='.$id; ?>"><i class="far fa-calendar-plus mr-1"></i> Marcar consulta</a>
	</p>
		<?php foreach($consulta as $item): ?>
			<div class="list-group list-group-flush">
				<?php
					$dt_inicio = date('d/m/Y', strtotime($item['con_inicio']));
					$hora_inicio = date('H:i', strtotime($item['con_inicio']));
					$dt_fim = date('d/m/Y', strtotime($item['con_fim']));
					$hora_fim = date('H:i', strtotime($item['con_fim']));
					$situacao = $item['con_status'];

					switch ($situacao) {
						case "0": 
							$situacao_nome = "Indisponibilidade";
							$situacao_cor = "danger";
							$situacao_icone = "<i class='fas fa-ban mr-1'></i>";
							break;
						case "1": 
							$situacao_nome = "Marcada";
							$situacao_cor = "info";
							$situacao_icone = "<i class='far fa-calendar-check mr-1'></i>";
							break;
						case "2": 
							$situacao_nome = "Realizada";
							$situacao_cor = "success";
							$situacao_icone = "<i class='fas fa-check mr-1'></i>";
							break;
						case "3": 
							$situacao_nome = "Paciente ausente";
							$situacao_cor = "secondary";
							$situacao_icone = "<i class='far fa-user mr-1'></i>";
							break;
						case "4": 
							$situacao_nome = "Cancelada";
							$situacao_cor = "secondary";
							$situacao_icone = "<i class='far fa-calendar-times mr-1'></i>";
							break;
						}
				?>
				<a href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $item['id']; ?>" class="list-group-item list-group-item-action text-<?php echo $situacao_cor; ?>" title="Ver detalhes da consulta">
					<div class="row">
						<div class="col-12 col-md-3">
							<?php echo "<strong>".$dt_inicio." ".$hora_inicio."</strong>"; ?>
						</div>
						<div class="col-12 col-md-6">
							<?php echo "<strong>".$item['med_nome']."</strong> (".$item['especialidade'].")"; ?>
						</div>
						<div class="col-12 col-md-3">
							<?php echo $situacao_icone." ".$situacao_nome; ?>
						</div>
					</div>

				</a>
			</div>

		<?php endforeach; ?>

	</div><!-- col-md-12 -->
</div><!-- row -->