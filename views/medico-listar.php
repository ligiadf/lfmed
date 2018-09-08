<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Médicos <small><a class="btn btn-primary btn-sm" href="<?php echo BASE_URL ?>usuarios/adicionar"><i class="fas fa-user-plus mr-1"></i> Adicionar médico</a></small></h1>
		</header>

		<div class="list-group list-group-flush">
			<?php foreach($medicos as $item): ?>
				<a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $item['id']; ?>" class="list-group-item list-group-item-action" title="Ver ficha do médico">
					<div class="row">
						<div class="col-12 col-md-4"><i class="fas fa-user mr-1"></i>
							<strong><?php echo $item['nome']; ?></strong>
						</div>
						<div class="col-12 col-md-4">
							<?php
								if($item['especialidade'] == 'Oftalmologista') { echo '<i class="fas fa-deaf mr-1"></i> Oftalmologista'; }
									else { echo '<i class="far fa-eye mr-1"></i> Otorrinolaringologista'; }
							?>
						</div>
						<div class="col-12 col-md-4"><i class="fas fa-id-card mr-1"></i> <?php echo $item['crm']; ?></div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="row text-center mt-3">
			<div class="col-12">
			<?php for($p=1; $p<=$paginas; $p++): ?>
				<a class="btn btn-secondary <?php if($pagina_atual == $p) { echo "active"; } ?>" role="button" href="<?php echo BASE_URL; ?>medicos?p=<?php echo $p; ?>"><?php echo $p; ?></a>
			<?php endfor; ?>
			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>

	</div>
</div>