<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="theme-color" content="#008080">

	<!-- Bootstrap -->
	<!--
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/sb-admin.css">

	<!-- Input mask -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

	<!-- Font Awesome -->
	<!--
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/fontawesome.all.min.css">
	
	<!-- Sistema -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/css/template.css?v=<?php echo rand(1,99) ?>">

	<link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL?>assets/images/clinica-oftorrino-icone.png">

	<title>Clínica Oftorrino</title>

</head>

<body>

<div id="wrapper">

	<!-- Conteúdo -->
	<div id="content-wrapper">
		<main class="container-fluid mb-1">
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

	<!-- Input mask -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

	<?php if(strpos($_SERVER['REQUEST_URI'], 'usuarios/adicionar') || strpos($_SERVER['REQUEST_URI'], 'usuarios/editar')): ?>
	<script src="<?php echo BASE_URL?>assets/js/valida-cadastro-usuarios.js"></script>
	<?php endif; ?>

	<script src="<?php echo BASE_URL?>assets/js/sb-admin.js"></script>



	


</body>
</html>