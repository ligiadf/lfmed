<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Exames</h1>
		</header>

		<div class="row card-deck mt-4 d-flex justify-content-center">

		<?php if( strpos($_SESSION['uLogin']['permissoes'], 'E01') !== false ): ?>
			<div class="col-12 col-md-6 mt-2">
				<div class="card">
					<div class="card-header">
						<i class="fas fa-prescription mr-1"></i> Exames disponíveis
					</div>
					<div class="card-body d-flex justify-content-center">
						<a class="btn btn-info" href="<?php echo BASE_URL.'exames/listar'; ?>">Acessar</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if( strpos($_SESSION['uLogin']['permissoes'], 'E01') !== false ): ?>
			<div class="col-12 col-md-6 mt-2">
				<div class="card">
					<div class="card-header">
						<i class="fas fa-users mr-1"></i> Buscar paciente
					</div>
					<div class="card-body d-flex justify-content-center">
						<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'exames/pacientes'; ?>">Acessar</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		</div>
	</div>
</div>