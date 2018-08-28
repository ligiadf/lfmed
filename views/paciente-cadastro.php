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
	<dt class="col-md-3 col-lg-2">id</dt>
	<dd class="col-md-9 col-lg-10"><?php echo $id; ?></dd>
	
	<dt class="col-md-3 col-lg-2">Data de nascimento</dt>
	<dd class="col-md-9 col-lg-10"><?php echo $data_nasc; ?></dd>

	<dt class="col-md-3 col-lg-2">E-mail</dt>
	<dd class="col-md-9 col-lg-10"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></dd>

	<dt class="col-md-3 col-lg-2">Telefone</dt>
	<dd class="col-md-9 col-lg-10"><?php echo $telefone; ?></dd>

	<dt class="col-md-3 col-lg-2">CPF</dt>
	<dd class="col-md-9 col-lg-10"><?php echo $cpf; ?></dd>

	<dt class="col-md-3 col-lg-2">Plano de saúde</dt>
	<dd class="col-md-9 col-lg-10"><?php echo $plano_saude; ?></dd>

</dl>

<p><a class="btn btn-warning" href="<?php echo BASE_URL ?>pacientes/editar/<?php echo $id; ?>"><i class="fas fa-user-edit mr-1"></i> Editar paciente</a></p>

<h2>Consultas</h2>

<div class="table-responsive">
	<table class="table table-bordered table-hover table-sm w-auto">
		<tr>
			<th class="p-3">id</th>
			<th class="p-3">Data e hora</th>
			<th class="p-3">Médico</th>
			<th class="p-3">Situação</th>
			<th class="p-3">Ações</th>
		</tr>

	<?php foreach($consulta as $item): ?>

		<?php 
			$dt_inicio = date('d/m/Y', strtotime($item['con_inicio']));
			$hora_inicio = date('H:i', strtotime($item['con_inicio']));
			$hora_fim = date('H:i', strtotime($item['con_fim']));
			$situacao = $item['con_status'];
		?>

		<tr>
			<td class="p-3"><?php echo $item['id']; ?></td>
			<td class="p-3"><?php echo $dt_inicio." ".$hora_inicio."-".$hora_fim ?></td>
			<td class="p-3"><?php echo $item['med_nome']; ?></td>
			<td class="p-3">
				<?php
				switch ($situacao) {
					case "1":
						$situacao = "<span class='text-info'>Marcada</span>";
						break;
					case "2":
						$situacao = "<span class='text-success'>Realizada</span>";
						break;
					case "3":
						$situacao = "<span class='text-danger'>Ausente</span>";
						break;
					case "4":
						$situacao = "<span class='text-danger'>Cancelada</span>";
						break;
				}
				echo $situacao;
				?>
			</td>
			<td class="p-3">
				<span><a href="consultas/detalhes/[id]"><i class="fas fa-calendar-check mr-1"></i> Editar consulta</a></span>
			</td>
		</tr>

	<?php endforeach; ?>

	</table>
</div>