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

	<title><?php if(!empty($titulo_pagina)) { echo $titulo_pagina." &ndash; ".NOME_CLINICA; } else { echo NOME_CLINICA; } ?></title>

</head>

<body>

<?php
	if(!isset($_SESSION['uLogin']) && empty($_SESSION['uLogin'])) {
		header('Location:'. BASE_URL.'login');
	}
?>

<nav class="navbar navbar-expand-md static-top navbar-dark pl-1" style="background-color: #008080;">

	<button class="btn btn-link btn-sm text-white order-sm-0 mr-3" id="sidebarToggle" href="#" title="Menu principal">
		<i class="fas fa-bars"></i>
	</button>

	<a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo NOME_CLINICA; ?></a>

	<div class="ml-auto" id="navbarText">
		<span class="navbar-text text-white">
			<?php if( isset($_SESSION['uLogin']) && !empty($_SESSION['uLogin']) ): ?>
				<?php
					switch($_SESSION['uLogin']['perfil']) {
						case 'ADM':
							$perfilTexto = '<i class="fas fa-user-shield mr-1"></i> '; break;
						case 'MED':
							$perfilTexto = '<i class="fas fa-user-md mr-1"></i> '; break;
						case 'REC':
							$perfilTexto = '<i class="fas fa-user-clock mr-1"></i> '; break;
						case 'LAB':
							$perfilTexto = '<i class="fas fa-hospital mr-1"></i> '; break;
					}
				?>
				<?php echo $perfilTexto.$_SESSION['uLogin']['nome']; ?>
				<a href="<?php echo BASE_URL; ?>login/sair"><i class="fas fa-sign-out-alt ml-4 mr-1"></i> Sair</a>
			<?php else : ?>
				<a href="<?php echo BASE_URL; ?>login"><i class="fas fa-sign-in-alt mr-1"></i> Entrar</a>
			<?php endif; ?>
		</span>
	</div>
</nav>

<div id="wrapper">
	<!-- Sidebar -->
	<ul class="sidebar navbar-nav toggled bg-white <?php if( $_SERVER['REQUEST_URI'] == substr(BASE_URL, -7)) { echo 'd-none'; } ?>">
<?php if( strpos($_SESSION['uLogin']['permissoes'], 'A01') !== false ): ?>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'agenda')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>agenda">
				<i class="far fa-calendar-alt mr-1"></i>
				<span>Agenda</span>
			</a>
		</li>
<?php endif; ?>
<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C01') !== false ): ?>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'consultas') || strpos($_SERVER['REQUEST_URI'], 'medicamentos/adicionar')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>consultas">
				<i class="far fa-calendar-check mr-1"></i>
				<span>Consultas</span>
			</a>
		</li>
<?php endif; ?>
<?php if( strpos($_SESSION['uLogin']['permissoes'], 'C01') !== false ): ?>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'pacientes')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>pacientes">
				<i class="fas fa-users mr-1"></i>
				<span>Pacientes</span>
			</a>
		</li>
<?php endif; ?>
<?php if( strpos($_SESSION['uLogin']['permissoes'], 'M01') !== false ): ?>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'medicos')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>medicos">
				<i class="fas fa-user-md mr-1"></i>
				<span>Médicos</span>
			</a>
		</li>
<?php endif; ?>
<?php if( strpos($_SESSION['uLogin']['permissoes'], 'U01') !== false ): ?>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'usuarios')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>usuarios">
				<i class="fas fa-users-cog mr-1"></i>
				<span>Usuários</span>
			</a>
		</li>
<?php endif; ?>
<?php if( strpos($_SESSION['uLogin']['permissoes'], 'R01') !== false ): ?>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'medicamentos')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>medicamentos">
				<i class="fas fa-pills mr-1"></i>
				<span>Medicamentos</span>
			</a>
		</li>
<?php endif; ?>
<?php if( strpos($_SESSION['uLogin']['permissoes'], 'E01') !== false ): ?>
		<li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], 'exames')) { echo "active"; } ?>">
			<a class="nav-link" href="<?php echo BASE_URL; ?>exames">
				<i class="fas fa-pills mr-1"></i>
				<span>Exames</span>
			</a>
		</li>
<?php endif; ?>
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
					<?php echo EMAIL_CLINICA; ?><br>
					<?php echo FONE_CLINICA; ?><br>
					<?php echo END_CLINICA; ?></p>
				</div>
				<div class="copyright text-center">
					<span class="text-dark"><?php echo NAME." v.".VERSION; ?> &ndash; <?php echo "Desenvolvido por ".DEV; ?> <br><br> &copy; 2018 <?php echo LICENSE; ?></span>
				</div>
			</div>
		</footer>

	</div><!-- content-wrapper -->

</div><!-- #wrapper -->

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

	<script src="<?php echo BASE_URL?>assets/js/sb-admin.js"></script>

	<!-- Input mask -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

	<?php if(strpos($_SERVER['REQUEST_URI'], 'usuarios/adicionar') || strpos($_SERVER['REQUEST_URI'], 'usuarios/editar')): ?>
	<script src="<?php echo BASE_URL?>assets/js/valida-cadastro-usuarios.js?v=<?php echo rand(1,99) ?>"></script>
	<?php endif; ?>

	<?php if(strpos($_SERVER['REQUEST_URI'], 'agenda') || strpos($_SERVER['REQUEST_URI'], 'consultas') ): ?>
	<script src="<?php echo BASE_URL?>assets/js/valida-filtro.js?v=<?php echo rand(1,99) ?>"></script>
	<?php endif; ?>

</body>
</html>