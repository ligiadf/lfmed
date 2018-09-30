<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas'; ?>">Consultas</a></li>
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas/listar'; ?>">Listar consultas</a></li>
	<li class="breadcrumb-item"><A HREF="<?php echo BASE_URL.'consultas/detalhe/'.$id ?>">Detalhes da consulta</a></li>
	<li class="breadcrumb-item active">Adicionar exame</li>
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
		<h1>Requisição de exames<small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $id; ?></small></h1>
	</header>

	<?php include_once('_dados-consulta.php'); ?>

	<h5 class="mt-3 mb-3">Adicionar exame</h5>

<!-- LISTA EXAMES -->

		<div class="row">
			<div class="col-12 mt-2 mb-2 pt-2 pb-2">
				<form method="GET" class="form-inline">
					<div class="form-group col-12 col-md-8 pl-0">
						<input type="text" class="form-control col-12" id="busca_exame" name="ex" placeholder="Filtre por nome do exame" value="<?php if(!empty($_GET['ex'])) { echo $_GET['ex']; } ?>">
					</div>
					<div class="form-group col-12 col-md-4 pl-0">
						<button type="submit" id="filtro" class="btn btn-primary btn-sm ml-md-3"><i class="fas fa-filter"></i> Filtrar</button>
						<small><a class="ml-4 text-secondary" href="<?php echo BASE_URL.'exames/adicionar/'.$id; ?>"><i class="fas fa-times mr-1"></i> Limpar</a></small>
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
				<a class="list-group-item list-group-item-action" href="<?php echo BASE_URL.'exames/adicionar/'.$id.'?id_exa='.$item['id']; ?>
					<?php if(!empty($_GET['p'])) { echo '&p='.$_GET['p']; } ?>#form" title="Selecione o exame para adicionar à requisição">
					<div class="row text-secondary mb-3">
						<div class="col-12">
							<strong><?php echo $item['nome']; ?></strong>
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
				<a class="btn btn-secondary" role="button" href="<?php echo BASE_URL.'exames/adicionar/'.$id;?>?p=1<?php if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } if(!empty($_GET['id_exa'])) { echo "&id_exa=".$_GET['id_exa']; } ?>" title="Primeira página">1</a>
				<?php endif;?>

				<!-- Página anterior -->
				<?php if($pagina_atual > 1 && $pagina_atual != 2): ?>
					<?php if($pagina_atual != 3) { echo "..."; } ?>
					<a class="btn btn-secondary <?php if($pagina_atual <= 1) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL.'exames/adicionar/'.$id;?>?p=<?php echo $p_anterior; if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } if(!empty($_GET['id_exa'])) { echo "&id_exa=".$_GET['id_exa']; } ?>" title="Página anterior"><?php echo $p_anterior; ?></a>
				<?php endif;?>

				<!-- Página atual -->
				<?php if($pagina_atual == $p): ?>
				<a class="btn btn-secondary active" role="button" href="<?php echo BASE_URL.'exames/adicionar/'.$id;?>?p=<?php echo $pagina_atual; if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } if(!empty($_GET['id_exa'])) { echo "&id_exa=".$_GET['id_exa']; } ?>" title="Página atual"><?php echo $pagina_atual; ?></a>
				<?php endif;?>

				<!-- Próxima página -->
				<?php if($pagina_atual < $paginas && $pagina_atual != $p_penultima): ?>
				<a class="btn btn-secondary <?php if($pagina_atual >= $paginas) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL.'exames/adicionar/'.$id;?>?p=<?php echo $p_proximo; if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } if(!empty($_GET['id_exa'])) { echo "&id_exa=".$_GET['id_exa']; } ?>" title="Próxima página"><?php echo $p_proximo; ?></a>
				<?php endif;?>

				<!-- Última página -->
				<?php if($pagina_atual < $paginas): ?>
					<?php if($pagina_atual != $p_penultima && $pagina_atual != $p_antepenultima) { echo "..."; } ?>
					<a class="btn btn-secondary <?php if($pagina_atual >= $paginas) { echo "disabled"; } ?>" role="button" href="<?php echo BASE_URL.'exames/adicionar/'.$id;?>?p=<?php echo $paginas; if(!empty($_GET['ex'])) { echo "&ex=".$_GET['ex']; } if(!empty($_GET['id_exa'])) { echo "&id_exa=".$_GET['id_exa']; } ?>" title="Última página"><?php echo $paginas; ?></a>
				<?php endif;?>

			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>
	<?php endif; ?>

<!-- FIM LISTA EXAMES -->

	<form method="POST" id="form">

		<input type="hidden" class="form-control form-control-plaintext" id="paciente" name="id_pac" maxlength="11" value="<?php echo $pac_id; ?>" required>
		
		<div class="form-group row">
			<label for="exame" class="col-8 col-md-2 col-form-label"><i class="fas fa-barcode mr-1"></i> Código do exame:</label>
			<div class="col-4">
				<input type="text" class="form-control form-control-plaintext" id="exame" name="id_exa" maxlength="11" value="<?php if(!empty($_GET['id_exa'])) { echo $_GET['id_exa']; } else { echo "Selecione um exame acima"; } ?>" placeholder="Selecione um exame acima" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12">
				<label for="observacao"><i class="fas fa-file-signature mr-1"></i> Observação:</label>
				<input type="text" class="form-control" id="observacao" name="observacao" maxlength="200">
				<small id="observacaoHelp" class="form-text text-muted">Preencha observação para a realização do exame, se necessário.</small>
			</div>
			<div class="form-group col-12 col-md-3">
				<label for="CID"><i class="fas fa-file-medical mr-1"></i> CID-10: <small>[<a href="http://www.datasus.gov.br/cid10/v2008/cid10.htm" target="_blank" title="Consulte CID-10">Consultar</a>]</small></label>
				<input type="text" class="form-control" id="CID" name="cid" maxlength="10">
				<small id="CIDHelp" class="form-text text-muted">Preencha CID-10, se necessário.</small>
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