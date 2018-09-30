<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'pacientes'; ?>">Pacientes</a></li>
	<li class="breadcrumb-item active">Ver todos</li>
</ol>
<div class="row justify-content-center">
	<div class="col-md-10">
		<header class="mt-4 mb-4">
			<h1>Pacientes 
				<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C02') !== false ): ?>
					<small><a class="btn btn-sm btn-primary" href="<?php echo BASE_URL ?>pacientes/cadastrar"><i class="fas fa-user-plus mr-1"></i> Cadastrar paciente</a></small>
				<?php endif; ?>
				</h1>
		</header>

		<div class="row">
			<div class="col-12 mt-2 mb-2 pt-2 pb-2">
				<form method="GET" class="form-inline">
					<div class="form-group col-12 col-md-8 pl-0">
						<input type="text" class="form-control col-12" id="busca_paciente" name="pc" placeholder="Filtre por nome ou CPF do paciente" value="<?php if(!empty($_GET['pc'])) { echo $_GET['pc']; } ?>">
					</div>
					<div class="form-group col-12 col-md-4 pl-0">
						<button type="submit" id="filtro" class="btn btn-primary btn-sm ml-md-3"><i class="fas fa-filter"></i> Filtrar</button>
						<small><a class="ml-4 text-secondary" href="<?php echo BASE_URL.'pacientes'; ?>"><i class="fas fa-times mr-1"></i> Limpar</a></small>
					</div>
				</form>
			</div>
		</div>

		<?php if( $msgSemResultado != '' ): ?>
			<div class="alert alert-warning col-12 col-md-6">
				<?php echo $msgSemResultado; ?>
			</div>
		<?php endif; ?>

			<?php foreach($pacientes as $item): ?>
					<div class="row mb-2 mt-2">
						<div class="col-12 col-lg-3"><strong><?php echo $item['nome']; ?></strong> (<?php echo $item['cpf']; ?>)</div>
						<div class="col-12 col-lg-2"><i class="fas fa-phone mr-1"></i> <?php echo $item['telefone']; ?></div>
						<div class="col-12 col-lg-2"><i class="fas fa-briefcase-medical mr-1"></i> <?php echo $item['plano_saude']; ?></div>
						<div class="col-12 col-lg-5 mt-2 mb-4 mt-md-1 mb-md-1">
							<a class="btn btn-info mr-3" role="button" title="Ver ficha para paciente <?php echo $item['nome']; ?>" href="<?php echo BASE_URL.'pacientes/ficha/'.$item['id']; ?>"><i class="fas fa-user mr-1"></i> Ficha</a>
							<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C02') !== false ): ?>
								<a class="btn btn-info mr-3" role="button" title="Marcar consulta para paciente <?php echo $item['nome']; ?>" href="<?php echo BASE_URL.'consultas/marcar/?pc='.$item['id'] ?>"><i class="far fa-calendar-plus mr-1"></i> Marcar consulta</a>
							<?php endif;?>
							<?php if( strpos($_SESSION['uLogin']['permissoes'], 'E02') !== false ): ?>
								<a class="btn btn-info ml-3" role="button" title="Ver exames para paciente <?php echo $item['nome']; ?>" href="<?php echo BASE_URL.'exames/paciente/'.$item['id']; ?>"><i class="fas fa-prescription mr-1"></i> Exames</a>
							<?php endif;?>
						</div>
					</div>
			<?php endforeach; ?>

		<div class="row text-center mt-3">
			<div class="col-12">
			<?php for($p=1; $p<=$paginas; $p++): ?>
				<a class="btn btn-secondary <?php if($pagina_atual == $p) { echo "active"; } ?>" role="button" href="<?php echo BASE_URL; ?>pacientes?p=<?php echo $p; ?><?php if(!empty($_GET['pc'])) { echo "&pc=".$_GET['pc']; } ?>"><?php echo $p; ?></a>
			<?php endfor; ?>
			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>

	</div>
</div>