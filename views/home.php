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

<header>
	<h1 class="h3">Seja bem-vindo(a), <?php if($_SESSION) { echo $_SESSION['uLogin']['nome']."!"; } ?></h1>
</header>

<div class="row card-deck mt-4 d-flex justify-content-center">

<?php if( strpos($_SESSION['uLogin']['permissoes'], 'A01') !== false ): ?>
	<div class="col-12 col-md-4 mt-2">
		<div class="card">
			<div class="card-header">
				<i class="far fa-calendar-alt mr-1"></i> Agenda
			</div>
			<div class="card-body d-flex justify-content-center">
				<a class="btn btn-info" href="<?php echo BASE_URL.'agenda'; ?>">Agenda semanal</a>
				<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'agenda/mensal'; ?>">Agenda mensal</a>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C01') !== false ): ?>
	<div class="col-12 col-md-4 mt-2">
		<div class="card">
			<div class="card-header">
				<i class="far fa-calendar-check mr-1"></i> Consultas
			</div>
			<div class="card-body d-flex justify-content-center">
				<a class="btn btn-info" href="<?php echo BASE_URL.'consultas/listar'; ?>">Todas</a>
				<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'consultas/listar/?di='.date('d-m-Y'); ?>">Próximas</a>
				<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'consultas/marcar'; ?>">Marcar</a>
				<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'consultas/estatisticas'; ?>">Estatísticas</a>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if( strpos($_SESSION['uLogin']['permissoes'], 'P01') !== false ): ?>
	<div class="col-12 col-md-4 mt-2">
		<div class="card">
			<div class="card-header">
				<i class="fas fa-users mr-1"></i> Pacientes
			</div>
			<div class="card-body d-flex justify-content-center">
				<a class="btn btn-info" href="<?php echo BASE_URL.'pacientes'; ?>">Todos</a>
				<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'pacientes/cadastrar'; ?>">Cadastrar</a>
			</div>
		</div>
	</div>
<?php endif; ?>

</div>

<div class="row card-deck mt-4 d-flex justify-content-center">

<?php if( strpos($_SESSION['uLogin']['permissoes'], 'M01') !== false ): ?>
	<div class="col-12 col-md-4 mt-2">
		<div class="card">
			<div class="card-header">
				<i class="fas fa-user-md mr-1"></i> Médicos
			</div>
			<div class="card-body d-flex justify-content-center">
				<a class="btn btn-info" href="<?php echo BASE_URL.'medicos'; ?>">Ativos</a>
				<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'usuarios/adicionar?pf=md'; ?>">Adicionar</a>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if( strpos($_SESSION['uLogin']['permissoes'], 'U01') !== false ): ?>
	<div class="col-12 col-md-4 mt-2">
		<div class="card">
			<div class="card-header">
				<i class="fas fa-users-cog mr-1"></i> Usuários
			</div>
			<div class="card-body d-flex justify-content-center">
				<a class="btn btn-info" href="<?php echo BASE_URL.'usuarios'; ?>">Todos</a>
				<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'usuarios/adicionar?pf=md'; ?>">Adicionar</a>
			</div>
		</div>
	</div>
<?php endif; ?>

</div>

<div class="row card-deck mt-4 d-flex justify-content-center">

<?php if( strpos($_SESSION['uLogin']['permissoes'], 'R01') !== false ): ?>
	<div class="col-12 col-md-4 mt-2">
		<div class="card">
			<div class="card-header">
				<i class="fas fa-pills mr-1"></i> Medicamentos
			</div>
			<div class="card-body d-flex justify-content-center">
				<a class="btn btn-info" href="<?php echo BASE_URL.'medicamentos'; ?>">Listar</a>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if( strpos($_SESSION['uLogin']['permissoes'], 'E01') !== false ): ?>
	<div class="col-12 col-md-4 mt-2">
		<div class="card">
			<div class="card-header">
				<i class="fas fa-pills mr-1"></i> Exames
			</div>
			<div class="card-body d-flex justify-content-center">
				<a class="btn btn-info" href="<?php echo BASE_URL.'exames/listar'; ?>">Listar</a>
				<a class="btn btn-info ml-2" href="<?php echo BASE_URL.'exames/pacientes'; ?>">Buscar paciente</a>
			</div>
		</div>
	</div>
<?php endif; ?>

</div>