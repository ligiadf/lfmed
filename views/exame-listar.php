<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'exames'; ?>">Exames</a></li>
	<li class="breadcrumb-item">Exames disponíveis</li>
</ol>
<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Exames disponíveis</h1>
		</header>

		<div class="row">
			<div class="col-12 mt-2 mb-2 pt-2 pb-2">
				<form method="GET" class="form-inline">
					<div class="form-group col-12 col-md-8 pl-0">
						<input type="text" class="form-control col-12" id="busca_exame" name="ex" placeholder="Filtre por nome do exame" value="<?php if(!empty($_GET['ex'])) { echo $_GET['ex']; } ?>">
					</div>
					<div class="form-group col-12 col-md-4 pl-0">
						<button type="submit" id="filtro" class="btn btn-primary btn-sm ml-md-3"><i class="fas fa-filter"></i> Filtrar</button>
						<small><a class="ml-4 text-secondary" href="<?php echo BASE_URL.'exames'; ?>"><i class="fas fa-times mr-1"></i> Limpar</a></small>
					</div>
				</form>
			</div>
		</div>

		<?php if( $msgSemResultado != '' ): ?>
			<div class="alert alert-warning col-12 col-md-6">
				<?php echo $msgSemResultado; ?>
			</div>
		<?php endif; ?>

	<?php if($pedido): ?>
		<div class="list-group list-group-flush">
			<div class="row mb-3">
				<div class="col-12 col-md-5 font-weight-bold">
					<i class="fas fa-prescription mr-1"></i> Nome
				</div>
			</div>

			
			<?php foreach($pedido as $item): ?>
				<div class="row text-secondary mb-3">
					<div class="col-12 col-md-5">
						<strong><?php echo $item['nome']; ?></strong>
					</div>
				</div>
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
				<a class="btn btn-secondary" role="button" href="<?php echo BASE_URL; ?>exames?p=1<?php if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } ?>" title="Primeira página">1</a>
				<?php endif;?>

				<!-- Página anterior -->
				<?php if($pagina_atual > 1 && $pagina_atual != 2): ?>
					<?php if($pagina_atual != 3) { echo "..."; } ?>
					<a class="btn btn-secondary <?php if($pagina_atual <= 1) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL; ?>exames?p=<?php echo $p_anterior; if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } ?>" title="Página anterior"><?php echo $p_anterior; ?></a>
				<?php endif;?>

				<!-- Página atual -->
				<?php if($pagina_atual == $p): ?>
				<a class="btn btn-secondary active" role="button" href="<?php echo BASE_URL; ?>exames?p=<?php echo $pagina_atual; if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } ?>" title="Página atual"><?php echo $pagina_atual; ?></a>
				<?php endif;?>

				<!-- Próxima página -->
				<?php if($pagina_atual < $paginas && $pagina_atual != $p_penultima): ?>
				<a class="btn btn-secondary <?php if($pagina_atual >= $paginas) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL; ?>exames?p=<?php echo $p_proximo; if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } ?>" title="Próxima página"><?php echo $p_proximo; ?></a>
				<?php endif;?>

				<!-- Última página -->
				<?php if($pagina_atual < $paginas): ?>
					<?php if($pagina_atual != $p_penultima && $pagina_atual != $p_antepenultima) { echo "..."; } ?>
					<a class="btn btn-secondary <?php if($pagina_atual >= $paginas) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL; ?>exames?p=<?php echo $paginas; if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } ?>" title="Última página"><?php echo $paginas; ?></a>
				<?php endif;?>

			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>
	<?php endif; ?>

	</div>
</div>