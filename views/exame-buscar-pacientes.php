<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'exames'; ?>">Exames</a></li>
	<li class="breadcrumb-item active">Buscar paciente</li>
</ol>

<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Buscar paciente</h1>
		</header>

		<div class="row">
			<div class="col-12 mt-2 mb-2 pt-2 pb-2">
				<form method="GET" class="form-inline">
					<div class="form-group col-12 col-md-8 pl-0">
						<input type="text" class="form-control col-12" id="busca_paciente" name="pc" placeholder="Filtre por nome ou CPF do paciente" value="<?php if(!empty($_GET['pc'])) { echo $_GET['pc']; } ?>">
					</div>
					<div class="form-group col-12 col-md-4 pl-0">
						<button type="submit" id="filtro" class="btn btn-primary btn-sm ml-md-3"><i class="fas fa-filter"></i> Filtrar</button>
						<small><a class="ml-4 text-secondary" href="<?php echo BASE_URL.'exames/pacientes'; ?>"><i class="fas fa-times mr-1"></i> Limpar</a></small>
					</div>
				</form>
			</div>
		</div>

		<?php if( $msgSemResultado != '' ): ?>
			<div class="alert alert-warning col-12 col-md-6">
				<?php echo $msgSemResultado; ?>
			</div>
		<?php endif; ?>

		<div class="list-group list-group-flush">
			<?php foreach($pacientes as $item): ?>
				<a href="<?php echo BASE_URL ?>exames/paciente/<?php echo $item['id']; ?>" class="list-group-item list-group-item-action" title="Ver exames do paciente">
					<div class="row">
						<div class="col-12 col-md-4"><i class="fas fa-user mr-1"></i> <strong><?php echo $item['nome']; ?></strong> (<?php echo $item['cpf']; ?>)</div>
						<div class="col-12 col-md-4"><i class="fas fa-phone mr-1"></i> <?php echo $item['telefone']; ?></div>
						<div class="col-12 col-md-4"><i class="fas fa-briefcase-medical mr-1"></i> <?php echo $item['plano_saude']; ?></div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="row text-center mt-3">
			<div class="col-12">
			<?php for($p=1; $p<=$paginas; $p++): ?>
				<a class="btn btn-secondary <?php if($pagina_atual == $p) { echo "active"; } ?>" role="button" href="<?php echo BASE_URL; ?>exames/pacientes?p=<?php echo $p; ?><?php if(!empty($_GET['pc'])) { echo "&pc=".$_GET['pc']; } ?>"><?php echo $p; ?></a>
			<?php endfor; ?>
			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>

	</div>
</div>