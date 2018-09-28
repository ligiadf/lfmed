<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas'; ?>">Consultas</a></li>
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas/listar'; ?>">Listar consultas</a></li>
	<li class="breadcrumb-item"><A HREF="<?php echo BASE_URL.'consultas/detalhe/'.$id ?>">Detalhes da consulta</a></li>
	<li class="breadcrumb-item active">Adicionar medicamento</li>
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
		<h1>Prescrição de medicamentos<small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $id; ?></small></h1>
	</header>

	<?php include_once('_dados-consulta.php'); ?>

	<h5 class="mt-3 mb-3">Adicionar medicamento</h5>

<!-- LISTA MEDICAMENTOS -->

		<div class="row">
			<div class="col-12 mt-2 mb-2 pt-2 pb-2">
				<form method="GET" class="form-inline">
					<div class="form-group col-12 col-md-8 pl-0">
						<input type="text" class="form-control col-12" id="busca_medicamento" name="rem" placeholder="Filtre por nome comercial ou princípio ativo" value="<?php if(!empty($_GET['rem'])) { echo $_GET['rem']; } ?>">
					</div>
					<div class="form-group col-12 col-md-4 pl-0">
						<button type="submit" id="filtro" class="btn btn-primary btn-sm ml-md-3"><i class="fas fa-filter"></i> Filtrar</button>
						<small><a class="ml-4 text-secondary" href="<?php echo BASE_URL.'medicamentos/adicionar/'.$id; ?>"><i class="fas fa-times mr-1"></i> Limpar</a></small>
					</div>
				</form>
			</div>
		</div>

		<?php if( $msgSemResultado != '' ): ?>
			<div class="alert alert-warning col-12 col-md-6">
				<?php echo $msgSemResultado; ?>
			</div>
		<?php endif; ?>

	<?php if($remedios): ?>
		<div class="list-group list-group-flush">
			<div class="row mb-3">
				<div class="col-12 col-md-5 font-weight-bold">
					<i class="fas fa-medkit mr-1"></i> Nome comercial (Fabricante)
				</div>
				<div class="col-12 col-md-2 font-weight-bold">
					<i class="fas fa-mortar-pestle mr-1"></i> Princípio ativo
				</div>
				<div class="col-12 col-md-5 font-weight-bold">
					<i class="fas fa-pills mr-1"></i> Apresentação
				</div>
			</div>

			<?php foreach($remedios as $item): ?>
				<a class="list-group-item list-group-item-action" href="<?php echo BASE_URL.'medicamentos/adicionar/'.$id.'?id_rem='.$item['id']; ?>
					<?php if(!empty($_GET['p'])) { echo '&p='.$_GET['p']; } ?>#form" title="Selecione o medicamento para adicionar à prescrição">
					<div class="row text-secondary mb-3">
						<div class="col-12 col-md-5">
							<span class="d-md-none"><i class="fas fa-medkit mr-1"></i></span> <strong><?php echo $item['nome_comercial']; ?></strong> (<?php echo $item['fabricante']; ?>)
						</div>
						<div class="col-12 col-md-2">
							<span class="d-md-none"><i class="fas fa-mortar-pestle mr-1"></i></span> <?php echo $item['principio_ativo']; ?>
						</div>
						<div class="col-12 col-md-5">
							<span class="d-md-none"><i class="fas fa-pills mr-1"></i></span> <?php echo $item['apresentacao']; ?>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>

		<?php
			if(!empty($_GET['p'])) { $p = $_GET['p']; } else { $p = 1; }
			$p_anterior = $pagina_atual - 1;
			$p_proximo = $pagina_atual + 1;
		?>

		<div class="row text-center mt-3">
			<div class="col-12">
				<!-- Primeira página -->
				<?php if($pagina_atual > 1): ?>
				<a class="btn btn-secondary" role="button" href="<?php echo BASE_URL.'medicamentos/adicionar/'.$id;?>?p=1<?php if(!empty($_GET['rem'])) { echo "&rem=".$_GET['rem']; } if(!empty($_GET['id_rem'])) { echo "&id_rem=".$_GET['id_rem']; } ?>" title="Primeira página">1</a>
				<?php endif;?>

				<!-- Página anterior -->
				<?php if($pagina_atual > 1 && $pagina_atual != 2): ?>
					<?php if($pagina_atual != 3) { echo "..."; } ?>
					<a class="btn btn-secondary <?php if($pagina_atual <= 1) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL.'medicamentos/adicionar/'.$id;?>?p=<?php echo $p_anterior; if(!empty($_GET['rem'])) { echo "&rem=".$_GET['rem']; } if(!empty($_GET['id_rem'])) { echo "&id_rem=".$_GET['id_rem']; } ?>" title="Página anterior"><?php echo $p_anterior; ?></a>
				<?php endif;?>

				<!-- Página atual -->
				<?php if($pagina_atual == $p): ?>
				<a class="btn btn-secondary active" role="button" href="<?php echo BASE_URL.'medicamentos/adicionar/'.$id;?>?p=<?php echo $pagina_atual; if(!empty($_GET['rem'])) { echo "&rem=".$_GET['rem']; } if(!empty($_GET['id_rem'])) { echo "&id_rem=".$_GET['id_rem']; } ?>" title="Página atual"><?php echo $pagina_atual; ?></a>
				<?php endif;?>

				<!-- Próxima página -->
				<?php if($pagina_atual < $paginas && $pagina_atual != $p_penultima): ?>
				<a class="btn btn-secondary <?php if($pagina_atual >= $paginas) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL.'medicamentos/adicionar/'.$id;?>?p=<?php echo $p_proximo; if(!empty($_GET['rem'])) { echo "&rem=".$_GET['rem']; } if(!empty($_GET['id_rem'])) { echo "&id_rem=".$_GET['id_rem']; } ?>" title="Próxima página"><?php echo $p_proximo; ?></a>
				<?php endif;?>

				<!-- Última página -->
				<?php if($pagina_atual < $paginas): ?>
					<?php if($pagina_atual != $p_penultima && $pagina_atual != $p_antepenultima) { echo "..."; } ?>
					<a class="btn btn-secondary <?php if($pagina_atual >= $paginas) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL.'medicamentos/adicionar/'.$id;?>?p=<?php echo $paginas; if(!empty($_GET['rem'])) { echo "&rem=".$_GET['rem']; } if(!empty($_GET['id_rem'])) { echo "&id_rem=".$_GET['id_rem']; } ?>" title="Última página"><?php echo $paginas; ?></a>
				<?php endif;?>

			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>
	<?php endif; ?>

<!-- FIM LISTA MEDICAMENTOS -->

	<form method="POST" id="form">
		<div class="form-group row">
			<label for="medicamento" class="col-8 col-md-2 col-form-label"><i class="fas fa-barcode mr-1"></i> Código do medicamento:</label>
			<div class="col-4">
				<input type="text" class="form-control form-control-plaintext" id="medicamento" name="id_rem" maxlength="11" value="<?php if(!empty($_GET['id_rem'])) { echo $_GET['id_rem']; } else { echo "Selecione um medicamento acima"; } ?>" placeholder="Selecione um medicamento acima" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12">
				<label for="posologia"><i class="fas fa-file-signature mr-1"></i> Posologia:</label>
				<input type="text" class="form-control" id="posologia" name="posologia" maxlength="50" required>
				<small id="posologiaHelp" class="form-text text-muted">Preencha a posologia do medicamento. Exemplos: <code>1 gota/dia durante 7 dias</code> | <code>2 comprimidos a cada 8h por 10 dias</code></small>
			</div>
		</div>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-link btn-sm text-danger" href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $id; ?>"><i class="fas fa-times mr-1"></i> Cancelar</a>
			</div>
			<div class="col-6 text-right">
				<button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check mr-1"></i> Adicionar</button>
			</div>
		</div>
	</form>
	</div><!-- col-md-6 -->
</div><!-- row -->