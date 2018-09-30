<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Consultas</h1>
		</header>

		<div class="row card-deck mt-4 d-flex justify-content-center">

		<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C01') !== false ): ?>
			<div class="col-12 col-md-6 mt-2">
				<div class="card">
					<div class="card-header">
						<i class="far fa-calendar-check mr-1"></i> Consultas
					</div>
					<div class="card-body d-flex justify-content-center">
						<div class="btn-group" role="group" aria-label="Consultas">
							<a class="btn btn-info text-white rounded" href="
								<?php
									if($_SESSION['uLogin']['perfil'] == 'MED') {
										echo BASE_URL.'consultas/listar?md='.$_SESSION['uLogin']['id'];
									} else {
										echo BASE_URL.'consultas/listar';
									}
								?>
								">Ver todas</a>
							<a class="btn btn-info text-white ml-2 rounded" href="
								<?php
									if($_SESSION['uLogin']['perfil'] == 'MED') {
										echo BASE_URL.'consultas/listar?di='.date('d-m-Y').'&md='.$_SESSION['uLogin']['id'];
									} else {
										echo BASE_URL.'consultas/listar?di='.date('d-m-Y');
									}
								?>
								">Ver as próximas</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>


		<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C02') !== false ): ?>
			<div class="col-12 col-md-6 mt-2">
				<div class="card">
					<div class="card-header">
						<i class="far fa-calendar-plus mr-1"></i> Marcar
					</div>
					<div class="card-body d-flex justify-content-center">
						<div class="btn-group" role="group" aria-label="Marcação">
							<a class="btn btn-info rounded" href="<?php echo BASE_URL.'consultas/marcar'; ?>">Marcar consulta</a>
							<a class="btn btn-info rounded ml-2" href="<?php echo BASE_URL.'consultas/indisponibilidade'; ?>">Marcar indisponibilidade</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C05') !== false ): ?>
			<div class="col-12 col-md-3 mt-2">
				<div class="card">
					<div class="card-header">
						<i class="fas fa-chart-line mr-1"></i>Estatísticas
					</div>
					<div class="card-body d-flex justify-content-center">
						<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'consultas/estatisticas'; ?>">Acessar estatísticas</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		</div>
	</div>
</div>