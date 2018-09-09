<div class="row justify-content-center">
	<div class="col-md-6 col-lg-5">
	<header class="mt-4 mb-4">
		<h1><?php echo $nome; ?> </h1> 
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

	<dl class="row">
		<dt class="col-md-5"><i class="fas fa-passport mr-1"></i> ID</dt>
		<dd class="col-md-7"><?php echo $id; ?></dd>
		
		<dt class="col-md-5"><i class="fas fa-user mr-1"></i> Status</dt>
		<dd class="col-md-7">
			<?php
				if($status == '1') { echo '<span class="text-success"><i class="fas fa-user-check mr-1"></i> Ativo</span>'; }
					else { echo '<span class="text-danger"><i class="fas fa-user-times mr-1"></i> Inativo</span>'; }
			?>
		</dd>

		<dt class="col-md-5"><i class="fas fa-user-cog mr-1"></i> Perfil</dt>
		<dd class="col-md-7">
			<?php
				switch($perfil) {
					case 'ADM':
						echo '<i class="fas fa-user-shield mr-1"></i> Administrador'; break;
					case 'MED':
						echo '<i class="fas fa-user-md mr-1"></i> Médico'; break;
					case 'REC':
						echo '<i class="fas fa-user-clock mr-1"></i> Recepcionista'; break;
					case 'LAB':
						echo '<i class="fas fa-hospital mr-1"></i> Laboratório'; break;
					}
			?>
		</dd>

		<dt class="col-md-5"><i class="fas fa-envelope mr-1"></i> E-mail</dt>
		<dd class="col-md-7"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></dd>

		<?php if($perfil == 'MED'):?>

		<dt class="col-md-5"><i class="fas fa-medkit mr-1"></i> Especialidade</dt>
		<dd class="col-md-7"><?php echo $especialidade; ?></dd>

		<dt class="col-md-5"><i class="fas fa-id-card mr-1"></i> CRM</dt>
		<dd class="col-md-7"><?php echo $crm; ?></dd>

	<?php endif; ?>
	</dl>

	<p class="mt-2 text-right">
		<a class="btn btn-warning" href="<?php echo BASE_URL ?>usuarios/editar/<?php echo $id; ?>"><i class="fas fa-user-edit mr-1"></i> Editar usuário</a>
	</p>
	</div><!-- col-md-6 -->

<?php if($perfil=='MED'):?>
	<div class="col-md-6 col-lg-5">
	<header class="mt-4 mb-4">
		<h2>Consultas</h2>
	</header>

	<div class="list-group">
		<?php if(!empty($msgSemConsultas)): ?>
			<div class="alert alert-danger">
				<?php echo $msgSemConsultas; ?>
			</div>
		<?php endif ?>

		<?php foreach($consulta as $item): ?>
			<?php 
				$dt_inicio = date('d/m/Y', strtotime($item['con_inicio']));
				$dt_fim = date('d/m/Y', strtotime($item['con_inicio']));
				$hora_inicio = date('H:i', strtotime($item['con_inicio']));
				$hora_fim = date('H:i', strtotime($item['con_fim']));
				$situacao = $item['con_status'];
				switch ($situacao) {
					case "0": 
						$situacao_nome = "Alterar indisponibilidade.";
						$situacao_cor = "text-danger";
						$situacao_icone = "<i class='fas fa-ban mr-1'></i>";
						break;
					case "1": 
						$situacao_nome = "Ver detalhes da consulta marcada.";
						$situacao_cor = "text-primary";
						$situacao_icone = "<i class='far fa-calendar-check mr-1'></i>";
						break;
					case "2": 
						$situacao_nome = "Ver detalhes da consulta realizada";
						$situacao_cor = "text-success";
						$situacao_icone = "<i class='fas fa-check mr-1'></i>";
						break;
					case "3": 
						$situacao_nome = "Paciente ausente";
						$situacao_cor = "text-secondary";
						$situacao_icone = "<i class='far fa-user mr-1'></i>";
						break;
					case "4": 
						$situacao_nome = "Consulta cancelada";
						$situacao_cor = "text-secondary";
						$situacao_icone = "<i class='far fa-calendar-times mr-1'></i>";
						break;
				} 
			?>
			<a class="list-group-item mb-1 link-unstyled <?php echo $situacao_cor; ?>" title="<?php echo $situacao_nome ?>" href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $item['con_id']; ?>">
				<?php if($situacao != '0'):
					echo $situacao_icone;
					echo $dt_inicio." ".$hora_inicio ?>
					<!--&ndash;-->
					<i class="fas fa-user ml-3 mr-1"></i> <?php echo $item['nome']; ?>
				<?php else:
					echo $situacao_icone; ?>
					Indisponibilidade: 
				<?php
					echo $dt_inicio." ".$hora_inicio." a ";
					echo $dt_fim." ".$hora_fim;

				endif; ?>
			</a>

		<?php endforeach; ?>
	</div><!-- list-grop -->

	<p class="mt-2 text-right">
		<a class="btn btn-primary" href="<?php echo BASE_URL ?>consultas/marcar"><i class="far fa-calendar-check mr-1"></i> Marcar consulta</a>
	</p>

	</div><!-- col-md-6 -->

<?php endif; ?>
</div><!-- row -->