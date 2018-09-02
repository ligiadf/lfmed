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
		
		<dt class="col-md-5"><i class="fas fa-birthday-cake mr-1"></i> Idade</dt>
		<dd class="col-md-7">
			<?php
				$data_nasc_iso = $ficha['data_nasc'];
				$hoje = date("Y-m-d");
				$idade = date_diff(date_create($data_nasc_iso), date_create($hoje));
				echo $idade->format('%y')." anos (".$data_nasc.")";
			?>
			
		</dd>

		<dt class="col-md-5"><i class="fas fa-envelope mr-1"></i> E-mail</dt>
		<dd class="col-md-7"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></dd>

		<dt class="col-md-5"><i class="fas fa-phone mr-1"></i> Telefone</dt>
		<dd class="col-md-7"><?php echo $telefone; ?></dd>

		<dt class="col-md-5"><i class="fas fa-id-card mr-1"></i> CPF</dt>
		<dd class="col-md-7"><?php echo $cpf; ?></dd>

		<dt class="col-md-5"><i class="fas fa-briefcase-medical mr-1"></i> Plano de saúde</dt>
		<dd class="col-md-7"><?php echo $plano_saude; ?></dd>
	</dl>

	<p class="mt-2 text-right">
		<a class="btn btn-warning" href="<?php echo BASE_URL ?>pacientes/editar/<?php echo $id; ?>"><i class="fas fa-user-edit mr-1"></i> Editar paciente</a>
	</p>
	</div><!-- col-md-6 -->

	<div class="col-md-6 col-lg-5">
	<header class="mt-4 mb-4">
		<h2>Consultas</h2>
	</header>

	<div class="list-group">
		<?php foreach($consulta as $item): ?>
			<?php 
				$dt_inicio = date('d/m/Y', strtotime($item['con_inicio']));
				$hora_inicio = date('H:i', strtotime($item['con_inicio']));
				$hora_fim = date('H:i', strtotime($item['con_fim']));
				$situacao = $item['con_status'];
				switch ($situacao) {
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
			<a class="list-group-item mb-1 link-unstyled <?php echo $situacao_cor; ?>" title="<?php echo $situacao_nome ?>" href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $item['id']; ?>">
				<?php echo $situacao_icone; ?>
				<?php echo $dt_inicio." ".$hora_inicio ?>
				<!--&ndash;-->
				<i class="fas fa-user-md ml-3 mr-1"></i> <?php echo $item['med_nome']; ?>

			</a>

		<?php endforeach; ?>
	</div><!-- list-grop -->

	<p class="mt-2 text-right">
		<a class="btn btn-primary" href="<?php echo BASE_URL ?>consultas/marcar"><i class="far fa-calendar-check mr-1"></i> Marcar consulta</a>
	</p>

	</div><!-- col-md-6 -->
</div><!-- row -->