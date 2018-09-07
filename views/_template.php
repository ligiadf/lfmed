<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap -->
	<!--
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/sb-admin.css">

	<!-- Font Awesome -->
	<!--
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/fontawesome.all.min.css">
	
	<!-- Sistema -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/template.css">

	<link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL?>assets/images/clinica-oftorrino-icone.png">

	<title>Clínica Oftorrino</title>

</head>

<body>

<nav class="navbar navbar-expand-md static-top navbar-dark pl-1" style="background-color: #008080;">

	<button class="btn btn-link btn-sm text-white order-sm-0 mr-3" id="sidebarToggle" href="#" title="Menu principal">
		<i class="fas fa-bars"></i>
	</button>

	<a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo NOME_CLINICA; ?></a>

	<div class="ml-auto" id="navbarText">
		<span class="navbar-text">
		<i class="fas fa-user-circle"></i> Bárbara Gordon
		</span>
	</div>
</nav>

<div id="wrapper">
	<!-- Sidebar -->
	<ul class="sidebar navbar-nav toggled">
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'calendario')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>calendario">
				<i class="far fa-calendar-alt mr-1"></i>
				<span>Calendário</span>
			</a>
		</li>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'consultas')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>consultas">
				<i class="far fa-calendar-check mr-1"></i>
				<span>Consultas</span>
			</a>
		</li>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'pacientes')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>pacientes">
				<i class="fas fa-users mr-1"></i>
				<span>Pacientes</span>
			</a>
		</li>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'medicos')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>medicos">
				<i class="fas fa-user-md mr-1"></i>
				<span>Médicos</span>
			</a>
		</li>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'usuarios')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>usuarios">
				<i class="fas fa-users-cog mr-1"></i>
				<span>Usuários</span>
			</a>
		</li>
	</ul>

	<!-- Conteúdo -->
	<div id="content-wrapper">
		<main class="container-fluid mb-5">
			<?php $this->loadViewInTemplate($viewName, $viewData) ?>
		</main><!-- container-fluid -->
		<footer class="sticky-footer p-0">
			<div class="container my-auto">
				<div class="copyright text-center">
					<span class="text-dark">&copy; <?php echo NAME." v.".VERSION; ?> &ndash; <?php echo "Desenvolvido por ".DEV; ?> &ndash; <?php echo LICENSE; ?></span>
				</div>
			</div>
		</footer>



	</div><!-- content-wrapper -->

</div><!-- #wrapper -->

	<!-- Bootstrap 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
	-->
	<script src="<?php echo BASE_URL?>assets/js/jquery-3.3.1.slim.min.js"></script>

	<script src="<?php echo BASE_URL?>assets/js/bootstrap.min.js"></script>

	<?php if(strpos($_SERVER['REQUEST_URI'], 'usuarios/adicionar') || strpos($_SERVER['REQUEST_URI'], 'usuarios/editar')): ?>
	<script src="<?php echo BASE_URL?>assets/js/valida-cadastro-usuarios.js"></script>
	<?php endif; ?>

	<script src="<?php echo BASE_URL?>assets/js/sb-admin.js"></script>

</body>
</html>