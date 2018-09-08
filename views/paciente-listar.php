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
			<h1>Pacientes <small><a class="btn btn-sm btn-primary" href="<?php echo BASE_URL ?>pacientes/cadastrar"><i class="fas fa-user-plus mr-1"></i> Cadastrar paciente</a></small></h1>
		</header>

		<div class="list-group list-group-flush">
			<?php foreach($pacientes as $item): ?>
				<a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $item['id']; ?>" class="list-group-item list-group-item-action text-<?php echo $situacao_cor; ?>" title="Ver ficha do paciente">
					<i class="fas fa-user mr-1"></i> <strong><?php echo $item['nome']; ?></strong> (<?php echo $item['cpf']; ?>)<br>
					<i class="fas fa-phone mr-1"></i> <?php echo $item['telefone']; ?><br>
					<i class="fas fa-briefcase-medical mr-1"></i> <?php echo $item['plano_saude']; ?>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="row text-center mt-3">
			<div class="col-12">
			<?php for($p=1; $p<=$paginas; $p++): ?>
				<a class="btn btn-secondary <?php if($pagina_atual == $p) { echo "active"; } ?>" role="button" href="<?php echo BASE_URL; ?>pacientes?p=<?php echo $p; ?>"><?php echo $p; ?></a>
			<?php endfor; ?>
			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>

	</div>
</div>