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
		<p><i class="fas fa-user mr-1"></i> Ficha do paciente</p>
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

	<div class="col-md-12">

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

	<div class="row">
		<?php foreach($consulta as $item): ?>
			<?php 
				$dt_inicio = date('d/m/Y', strtotime($item['con_inicio']));
				$hora_inicio = date('H:i', strtotime($item['con_inicio']));
				$hora_fim = date('H:i', strtotime($item['con_fim']));
				$situacao = $item['con_status'];
				switch ($situacao) {
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

			<div class="col-md-6 col-xl-4">
				<div class="card mb-2 border-<?php echo $situacao_cor; ?> border-light">
					<div class="card-header text-<?php echo $situacao_cor; ?> font-weight-bold border-<?php echo $situacao_cor; ?>">
						<?php echo $situacao_icone.$dt_inicio." ".$hora_inicio." - ".$situacao_nome; ?>
					</div>
					<div class="card-body">
						<p class="card-text">Consulta com <?php echo $item['med_nome']." - ".$item['especialidade']."."; ?></p>
						<?php if($situacao=='2'): ?>
							<div class="row">
								<p class="card-text col-lg-6"><i class="fas fa-file-signature mr-1"></i> 
									<?php
										if(!empty($item['atestado_periodo'])) { echo "Atestado emitido"; }
											else { echo "Sem atestado"; }
									?>
								</p>
								<p class="card-text col-xl-6"><i class="fas fa-file-medical mr-1"></i>
									<?php
										if(!empty($item['anotacao'])) { echo "Anotações realizadas"; }
											else { echo "Sem anotações"; }
									?>
								</p>
							</div>
							<div class="row mt-3 mb-3 mt-xl-0 mb-xl-0">
								<p class="card-text col-xl-6"><i class="fas fa-pills mr-1"></i> Medicamentos?</p>
								<p class="card-text col-xl-6"><i class="fas fa-prescription mr-1"></i> Exames?</p>
							</div>
						<?php endif; ?>
						<p class="card-text text-center">
							<a class="btn btn-secondary" href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $item['id']; ?>">Ver detalhes</a>
						</p>
					</div>
				</div>
			</div>


		<?php endforeach; ?>
	</div><!-- row -->

	</div><!-- col-md-12 -->
</div><!-- row -->