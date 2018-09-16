<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="theme-color" content="#008080">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/sb-admin.min.css">

	<!-- Input mask -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<!-- Sistema -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/template.css?v=<?php echo rand(1,99) ?>">

	<link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL?>assets/images/clinica-oftorrino-icone.png">

	<title><?php echo NOME_CLINICA; ?></title>

</head>

<body>

<nav class="navbar navbar-expand-md static-top navbar-dark pl-1" style="background-color: #008080;">

	<button class="btn btn-link btn-sm text-white order-sm-0 mr-3" id="sidebarToggle" href="#" title="Menu principal">
		<i class="fas fa-bars"></i>
	</button>

	<a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo NOME_CLINICA; ?></a>

	<div class="ml-auto" id="navbarText">
		<span class="navbar-text">
			<?php if( isset($_SESSION['uLogin']) && !empty($_SESSION['uLogin']) ): ?>
				<i class="fas fa-user-circle mr-1"></i>
				<a href="<?php echo BASE_URL; ?>usuarios/ficha/<?php echo $_SESSION['uLogin']; ?>"><?php echo $_SESSION['uLogin']; ?></a>
				<a href="<?php echo BASE_URL; ?>login/sair"><i class="fas fa-sign-out-alt ml-4 mr-1"></i> Sair</a>
			<?php else : ?>
				<a href="<?php echo BASE_URL; ?>login"><i class="fas fa-sign-in-alt mr-1"></i> Entrar</a>
			<?php endif; ?>
		</span>
	</div>
</nav>

<div id="wrapper">
	<!-- Sidebar -->
	<ul class="sidebar navbar-nav toggled bg-white">
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
	<div id="content-wrapper" class="pb-0">
		<main class="container-fluid mb-5 pb-1">
			<?php $this->loadViewInTemplate($viewName, $viewData) ?>
		</main><!-- container-fluid -->

		<div class="clearfix mt-5 mb-5 p-5"></div>

		<footer class="sticky-footer mt-5 pt-3 pb-3 bg-light h-auto">
			<div class="container my-auto">
				<div class="text-center">
					<p class="text-dark"><strong><?php echo NOME_CLINICA; ?></strong><br>
					<?php echo END_CLINICA; ?></p>
				</div>
				<div class="copyright text-center">
					<span class="text-dark"><?php echo NAME." v.".VERSION; ?> &ndash; <?php echo "Desenvolvido por ".DEV; ?> <br><br> &copy; 2018 <?php echo LICENSE; ?></span>
				</div>
			</div>
		</footer>

	</div><!-- content-wrapper -->

</div><!-- #wrapper -->

	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

	<script src="<?php echo BASE_URL?>assets/js/sb-admin.js"></script>

	<!-- Input mask -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

	<?php if(strpos($_SERVER['REQUEST_URI'], 'usuarios/adicionar') || strpos($_SERVER['REQUEST_URI'], 'usuarios/editar')): ?>
	<script src="<?php echo BASE_URL?>assets/js/valida-cadastro-usuarios.js?v=<?php echo rand(1,99) ?>"></script>
	<?php endif; ?>

	<?php if(strpos($_SERVER['REQUEST_URI'], 'calendario') || strpos($_SERVER['REQUEST_URI'], 'consultas') ): ?>
	<script src="<?php echo BASE_URL?>assets/js/valida-filtro.js?v=<?php echo rand(1,99) ?>"></script>
	<?php endif; ?>

</body>
</html>