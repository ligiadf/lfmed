<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap -->
	<!--
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<!--
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/all.min.css">
	
	<!-- Sistema -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/template.css">

	<title>Clínica Oftorrino</title>

</head>

<body>

<nav class="navbar navbar-expand-md sticky-top navbar-dark" style="background-color: #008080;">
	<a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo NOME_CLINICA; ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'calendario')) { echo "active"; } ?>">
				<a class="nav-link" href="<?php echo BASE_URL; ?>calendario"><i class="far fa-calendar-alt mr-1"></i> Calendário</a>
			</li>
			<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'consultas')) { echo "active"; } ?>">
				<a class="nav-link" href="<?php echo BASE_URL; ?>consultas"><i class="far fa-calendar-check ml-2 mr-1"></i> Consultas</a> 
			</li>
			<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'pacientes')) { echo "active"; } ?>">
				<a class="nav-link" href="<?php echo BASE_URL; ?>pacientes"><i class="fas fa-users ml-2 mr-1"></i> Pacientes</a>
			</li>
			<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'medicos')) { echo "active"; } ?>">
				<a class="nav-link" href="<?php echo BASE_URL; ?>medicos"><i class="fas fa-user-md ml-2 mr-1"></i> Médicos</a>
			</li>
			<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'usuarios')) { echo "active"; } ?>">
				<a class="nav-link" href="<?php echo BASE_URL; ?>usuarios"><i class="fas fa-users-cog ml-2 mr-1"></i> Usuários</a>
			</li>
		</ul>
		<span class="navbar-text">
		<i class="fas fa-user-circle"></i> Bárbara Gordon
		</span>
	</div>
</nav>

<main class="container-fluid mb-5">

	<!-- Conteúdo -->
	<?php $this->loadViewInTemplate($viewName, $viewData) ?>

</main><!-- container-fluid -->

<footer class="mt-4 pl-2 p-0 text-center">
	<small>&copy; <?php echo NAME; ?> &ndash; <?php echo VERSION; ?></small>
</footer>

	<!-- Bootstrap 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
	-->
	<script src="<?php echo BASE_URL?>assets/js/jquery-3.3.1.slim.min.js"></script>

	<script src="<?php echo BASE_URL?>assets/js/bootstrap.min.js"></script>

	<?php if(strpos($_SERVER['REQUEST_URI'], 'usuarios/adicionar')): ?>
		<script src="<?php echo BASE_URL?>assets/js/valida.js"></script>
	<?php endif; ?>

</body>
</html>