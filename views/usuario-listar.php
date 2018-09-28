<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'usuarios'; ?>">Usuários</a></li>
	<li class="breadcrumb-item active">Listar</li>
</ol>
<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Usuários <small><a class="btn btn-primary btn-sm" href="<?php echo BASE_URL ?>usuarios/adicionar"><i class="fas fa-user-plus mr-1"></i> Adicionar usuário</a></small></h1>
		</header>

		<div class="list-group list-group-flush">
			<?php foreach($usuarios as $item): ?>
				<a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $item['id']; ?>" class="list-group-item list-group-item-action" title="Ver ficha do usuário">
					<div class="row">
						<div class="col-12 col-md-3">
							<strong><?php echo $item['nome']; ?></strong>
						</div>
						<div class="col-12 col-md-3">
							<?php
								switch($item['perfil']) {
									case 'ADM':
										echo '<i class="fas fa-user-shield mr-1"></i> Administrador'; break;
									case 'MED':
										echo '<i class="fas fa-user-md mr-1"></i> Médico'; break;
									case 'REC':
										echo '<i class="fas fa-user-clock mr-1"></i> Recepcionista'; break;
									case 'LAB':
										echo '<i class="fas fa-hospital mr-1"></i> Laboratório'; break;
									}
							?>
						</div>
						<div class="col-12 col-md-3">
							<?php
								if( $item['perfil'] == 'MED' && $item['especialidade'] == 'Oftalmologista') { echo '<i class="far fa-eye mr-1"></i> Oftalmologista'; }
								else if( $item['perfil'] == 'MED' && $item['especialidade'] == 'Otorrinolaringologista') { echo '<i class="fas fa-deaf mr-1"></i> Otorrinolaringologista'; }
									else if ($item['perfil'] == 'MED') { echo '<span class="text-danger">Cadastrar especialidade!</span>'; }
							?>
						</div>
						<div class="col-12 col-md-3">

							<?php
								if($item['status'] == 1) { echo '<span class="text-success"><i class="fas fa-user-check mr-1"></i> Ativo</span>'; }
									else { echo '<span class="text-danger"><i class="fas fa-user-times mr-1"></i> Inativo</span>'; }
							?>
						</div>

					</div>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="row text-center mt-3">
			<div class="col-12">
			<?php for($p=1; $p<=$paginas; $p++): ?>
				<a class="btn btn-secondary <?php if($pagina_atual == $p) { echo "active"; } ?>" role="button" href="<?php echo BASE_URL; ?>usuarios?p=<?php echo $p; ?>"><?php echo $p; ?></a>
			<?php endfor; ?>
			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>
	</div>
</div>