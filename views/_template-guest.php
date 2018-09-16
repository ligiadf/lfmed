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

<div id="wrapper">

	<!-- Conteúdo -->
	<div id="content-wrapper">
		<main class="container-fluid mb-1">
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

</body>
</html>