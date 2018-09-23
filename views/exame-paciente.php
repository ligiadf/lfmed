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
				Exames do paciente
				<small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $ficha['id']; ?></small>
			</h1>
		</header>

<h4 class="mt-4">
	<i class="fas fa-user mr-1"></i> <a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $ficha['id']; ?>" title="Ver ficha do paciente"><?php echo $ficha['nome']; ?></a>
</h4>

	<?php if($pedido): ?>
		<div class="list-group list-group-flush mt-4">
			<div class="row mb-3">
				<div class="col-12 col-md-1 font-weight-bold">
					<i class="far fa-calendar-alt mr-1"></i> Data
				</div>
				<div class="col-12 col-md-5 font-weight-bold">
					<i class="fas fa-prescription mr-1"></i> Nome
				</div>
				<div class="col-12 col-md-3 font-weight-bold">
					<i class="fas fa-file-signature mr-1"></i> Observação
				</div>
				<div class="col-12 col-md-1 font-weight-bold">
					<i class="fas fa-file-medical mr-1"></i> CID-10
				</div>
				<div class="col-12 col-md-2 font-weight-bold">
					<i class="fas fa-file-prescription mr-1"></i> Resultado
				</div>
			</div>

			<?php foreach($pedido as $item): ?>
				<?php
					$dataConsulta = substr($item['con_inicio'], 0, 10); // AAAA-MM-DD
					$dataConsulta = explode('-', addslashes($dataConsulta));
					$dataConsulta = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA
				?>
				<div class="row text-secondary mb-3">
					<div class="col-12 col-md-1 pb-2">
						<span class="d-md-none"><i class="far fa-calendar-alt mr-1"></i></span>
						<strong><?php echo $dataConsulta." <small>(".$item['id_con'].")</small>"; ?></strong>
					</div>
					<div class="col-12 col-md-5 pb-2">
						<span class="d-md-none"><i class="fas fa-prescription mr-1"></i></span>
						<strong><?php echo $item['nome_exame']." <small>(".$item['id_requisicao'].")</small>"; ?></strong>
					</div>
					<div class="col-12 col-md-3 pb-2">
						<span class="d-md-none"><i class="fas fa-file-signature mr-1"></i></span>
						<?php if(!empty($item['observacao'])) { echo $item['observacao']; } else { echo "<em>Sem observação</em>"; } ?>
					</div>
					<div class="col-12 col-md-1 pb-2">
						<span class="d-md-none"><i class="fas fa-file-medical mr-1"></i></span>
						<?php if(!empty($item['cid'])) { echo $item['cid']; } else { echo "<em>Sem CID</em>"; } ?>
					</div>
					<div class="col-12 col-md-2 pb-2">
						<?php if(empty($item['resultado'])): ?>
							<a class="btn btn-success btn-sm mr-2" href="<?php echo BASE_URL.'exames/resultado_adicionar/'.$item['pac_id'].'/'.$item['id_requisicao']; ?>" role="button" title="Adicionar resultado de exame <?php echo $item['nome_exame'] ?>"><i class="fas fa-plus"></i></a>
						<?php else: ?>
							<a class="btn btn-primary btn-sm mr-2" href="<?php echo BASE_URL.'uploads/resultado-exame-'.$item['pac_id'].'-'.$item['id_requisicao'].'-'.substr($item['con_inicio'], 0, 10).'.pdf'; ?>" role="button" title="Ver resultado do exame <?php echo $item['nome_exame'] ?>"><i class="fas fa-file-pdf"></i></a>

							<a class="btn btn-danger btn-sm" href="<?php echo BASE_URL.'exames/resultado_deletar/'.$item['pac_id'].'/'.$item['id_requisicao']; ?>" role="button" title="Excluir resultado do exame <?php echo $item['nome_exame'] ?>"><i class="far fa-trash-alt"></i></a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>

		</div>

	<?php endif; ?>

	</div>
</div>