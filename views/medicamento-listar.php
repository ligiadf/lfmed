<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Medicamentos</h1>
		</header>

		<div class="list-group list-group-flush">
			<div class="row pt-2 pb-3 ml-1">
				<div class="col-12 col-md-5 pl-0 text-uppercase font-weight-bold"><i class="fas fa-medkit mr-1"></i> Nome comercial (Fabricante)</div>
				<div class="col-12 col-md-2 pl-0 text-uppercase font-weight-bold"><i class="fas fa-mortar-pestle mr-1"></i> Princípio ativo</div>
				<div class="col-12 col-md-5 pl-0 text-uppercase font-weight-bold"><i class="fas fa-pills mr-1"></i> Apresentação</div>
			</div>
			<?php foreach($medicamentos as $item): ?>
				<a href="<?php echo BASE_URL ?>medicamentos/ficha/<?php echo $item['id']; ?>" class="list-group-item list-group-item-action" title="Ver ficha do paciente">
					<div class="row">
						<div class="col-12 col-md-5 pl-0"><i class="fas fa-medkit mr-1"></i> <strong><?php echo $item['nome_comercial']; ?></strong> (<?php echo $item['fabricante']; ?>)</div>
						<div class="col-12 col-md-2 pl-0"><i class="fas fa-mortar-pestle mr-1"></i> <?php echo $item['principio_ativo']; ?></div>
						<div class="col-12 col-md-5 pl-0"><i class="fas fa-pills mr-1"></i> <?php echo $item['apresentacao']; ?></div>
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
				<a class="btn btn-secondary" role="button" href="<?php echo BASE_URL; ?>medicamentos?p=1" title="Primeira página">1</a>
				<?php endif;?>

				<!-- Página anterior -->
				<?php if($pagina_atual > 1 && $pagina_atual != 2): ?>
					<?php if($pagina_atual != 3) { echo "..."; } ?>
					<a class="btn btn-secondary <?php if($pagina_atual <= 1) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL; ?>medicamentos?p=<?php echo $p_anterior; ?>" title="Página anterior"><?php echo $p_anterior; ?></a>
				<?php endif;?>

				<!-- Página atual -->
				<?php if($pagina_atual == $p): ?>
				<a class="btn btn-secondary active" role="button" href="<?php echo BASE_URL; ?>medicamentos?p=<?php echo $pagina_atual; ?>" title="Página atual"><?php echo $pagina_atual; ?></a>
				<?php endif;?>

				<!-- Próxima página -->
				<?php if($pagina_atual < $paginas && $pagina_atual != $p_penultima): ?>
				<a class="btn btn-secondary <?php if($pagina_atual >= $paginas) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL; ?>medicamentos?p=<?php echo $p_proximo; ?>" title="Próxima página"><?php echo $p_proximo; ?></a>
				<?php endif;?>

				<!-- Última página -->
				<?php if($pagina_atual < $paginas): ?>
					<?php if($pagina_atual != $p_penultima && $pagina_atual != $p_antepenultima) { echo "..."; } ?>
					<a class="btn btn-secondary <?php if($pagina_atual >= $paginas) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL; ?>medicamentos?p=<?php echo $paginas; ?>" title="Última página"><?php echo $paginas; ?></a>
				<?php endif;?>

			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>

	</div>
</div>