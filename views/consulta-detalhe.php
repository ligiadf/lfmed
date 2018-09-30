<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas'; ?>">Consultas</a></li>
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas/listar'; ?>">Listar consultas</a></li>
	<li class="breadcrumb-item active">Detalhes da consulta</li>
</ol>

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
				if($detalhe['con_status']=='0') { echo "<span class='text-danger'>Indisponibilidade</span>"; }
					else { echo "Detalhes da consulta"; } ?>
			<small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $id; ?></small>
		</h1>
	</header>

	<?php if($detalhe['con_status'] == '0'): ?>
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
		switch ($detalhe['con_status']) {
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

	<?php if($detalhe['con_status'] != '0'): ?>
		<h4 class="mt-4">
			<i class="fas fa-user mr-1"></i> <a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $detalhe['pac_id']; ?>" title="Ver ficha do paciente"><?php echo $detalhe['pac_nome']; ?></a>
			<small class="text-secondary">(CPF: <?php echo $detalhe['cpf']; ?>)</small>
		</h4>
	<?php endif; ?>

	<h5 class="mt-4">
		<i class="fas fa-user-md mr-1"></i>
			<?php if( strpos($_SESSION['uLogin']['permissoes'], 'M03') !== false ) :?>
			<a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $detalhe['med_id']; ?>" title="Ver ficha do médico"><?php echo $detalhe['med_nome']; ?></a>
			<?php else: ?>
				<?php echo $detalhe['med_nome']; ?>
			<?php endif; ?>
		<span class="d-sm-none"><br></span>
		<small class="h6">
		<?php
			if($detalhe['especialidade'] == 'Oftalmologista') { echo '<i class="far fa-eye ml-3 mr-0"></i> Oftalmologista'; }
				else { echo '<i class="fas fa-deaf ml-3 mr-0"></i> Otorrinolaringologista'; }
		?>
		</small>
	</h5>


	<p class="mt-2 text-right">
		<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C02') !== false ): ?>
			<a class="btn btn-warning" href="<?php echo BASE_URL ?>consultas/editar/<?php echo $id; ?>"><i class="far fa-calendar-check mr-1"></i> Editar</a>
		<?php endif; ?>
	</p>


<?php if($detalhe['con_status'] == '2'): ?>
	<p><a class="btn btn-info" href="<?php echo BASE_URL ?>consultas/comprovante/<?php echo $id; ?>" target="_blank"><i class="fas fa-file-contract mr-1"></i> Comprovante</a></p>

<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C04') !== false ): ?>

	<h3>Histórico</h3>

	<div class="card-deck">
		<div class="card border-light mt-3">
			<div class="card-header"><i class="fas fa-file-signature mr-1"></i> Atestado</div>
			<div class="card-body">
				<p class="card-text">
					<?php
						if(!empty($detalhe['atestado_periodo'])){
							echo "Atestado ".$detalhe['atestado_periodo']." por ".$detalhe['atestado_motivo'];
							if(!empty($detalhe['atestado_cid'])) {
								echo " (".$detalhe['atestado_cid'].")";
							}
							echo ".";
						} else {
							echo "Não há atestado vinculado a esta consulta.";
						}
					?>
				</p>

				<p class="card-text text-center">
					<?php if(!empty($detalhe['atestado_periodo'])): ?>
						<a href="<?php echo BASE_URL ?>atestados/editar/<?php echo $id; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit mr-1"></i> Editar</a>
						<a href="<?php echo BASE_URL ?>atestados/imprimir/<?php echo $id; ?>" target="_blank" class="btn btn-dark btn-sm ml-3"><i class="fas fa-file-pdf mr-1"></i></i> Imprimir</a>
						<a href="<?php echo BASE_URL ?>atestados/deletar/<?php echo $id; ?>" class="btn btn-danger btn-sm ml-3" title="Apagar atestado"><i class="far fa-trash-alt mr-1"></i> Excluir</a>
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
						if(!empty($detalhe['anotacao'])){ echo $detalhe['anotacao']; }
						else { echo "Não há anotação vinculada a esta consulta."; }
					?>
				</p>
				<p class="card-text text-center">
					<?php if(!empty($detalhe['anotacao'])): ?>
						<a href="<?php echo BASE_URL ?>anotacoes/editar/<?php echo $id; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit mr-1"></i> Editar</a>

						<a href="<?php echo BASE_URL ?>anotacoes/deletar/<?php echo $id; ?>" class="btn btn-danger btn-sm ml-3" title="Apagar anotação"><i class="far fa-trash-alt mr-1"></i> Excluir</a>
					<?php else: ?>
						<a href="<?php echo BASE_URL ?>anotacoes/adicionar/<?php echo $id; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-plus mr-1"></i> Adicionar</a>
					<?php endif; ?>

				</p>

			</div>
		</div>
	</div>
	<div class="card-deck">
		<div class="card border-light mt-3">
			<div class="card-header"><i class="fas fa-pills mr-1"></i> Prescrição de medicamentos</div>
			<div class="card-body">
				<p class="card-text">
					<ul class="list-group list-group-flush">
					<?php foreach ($receita as $item): ?>
						<li class="list-group-item border-top-0 border-bottom-0">
							<?php echo $item['nome_comercial']." ".$item['apresentacao']."<br>".$item['posologia']; ?>
							<a href="<?php echo BASE_URL ?>medicamentos/deletar/<?php echo $id; ?>/<?php echo $item['id_presc']; ?>" class="badge badge-danger p-2 ml-2" title="Apagar <?php echo $item['nome_comercial']." ".$item['apresentacao']." &ndash; ".$item['posologia']; ?>"><i class="far fa-trash-alt"></i> <?php echo $item['id_presc']; ?></a>
						</li>
					<?php endforeach; ?>
					</ul>
					<?php if(empty($receita)) { echo "Não há receita vinculada a esta consulta."; } ?>
				</p>
				<p class="card-text text-center">
					<a href="<?php echo BASE_URL ?>medicamentos/adicionar/<?php echo $id; ?>" class="btn btn-secondary btn-sm">
						<i class="fas fa-plus mr-1"></i> Adicionar</a>
					<?php if(!empty($receita)): ?>
						<a href="<?php echo BASE_URL ?>medicamentos/imprimir/<?php echo $id; ?>" target="_blank" class="btn btn-dark btn-sm ml-3">
							<i class="fas fa-file-pdf mr-1"></i> Imprimir</a>
					<?php endif; ?>
				</p>
			</div>
		</div>

		<div class="card border-light mt-3">
			<div class="card-header"><i class="fas fa-prescription mr-1"></i> Requisição de exames</div>
			<div class="card-body">
				<p class="card-text">
					<ul class="list-group list-group-flush">
					<?php foreach ($pedido as $item): ?>
						<li class="list-group-item border-top-0 border-bottom-0">
							<?php
							echo $item['nome'];
							if(!empty($item['observacao']) || !empty($item['cid'])) {
								echo "<br>";
							}
							if(!empty($item['observacao'])) {
								echo $item['observacao'];
							}
							if(!empty($item['cid'])) {
								echo " CID-10:  ".$item['cid'];
							}
							?>
							<a href="<?php echo BASE_URL ?>exames/deletar/<?php echo $id; ?>/<?php echo $item['id_req']; ?>" class="badge badge-danger p-2 ml-2" title="Apagar <?php echo $item['nome']." &ndash; ".$item['observacao']; ?>"><i class="far fa-trash-alt"></i> <?php echo $item['id_req']; ?></a>
						</li>
					<?php endforeach; ?>
					</ul>
					<?php if(empty($pedido)) { echo "Não há exame vinculado a esta consulta."; } ?>
				</p>
				<p class="card-text text-center">
					<a href="<?php echo BASE_URL ?>exames/adicionar/<?php echo $id; ?>" class="btn btn-secondary btn-sm">
						<i class="fas fa-plus mr-1"></i> Adicionar</a>
					<?php if(!empty($pedido)): ?>
						<a href="<?php echo BASE_URL ?>exames/imprimir/<?php echo $id; ?>" target="_blank" class="btn btn-dark btn-sm ml-3">
							<i class="fas fa-file-pdf mr-1"></i> Imprimir</a>
					<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php endif; ?> <!-- sessão -->
	</div><!-- col-md-6 -->
</div><!-- row -->