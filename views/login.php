<div class="row justify-content-center">
	<div class="col-md-6">

	<?php if(!empty($msgError)): ?>
		<div class="alert alert-danger">
			<?php echo $msgError; ?>
		</div>
	<?php endif ?>

	<?php if(!empty($_GET['msgOK'])): ?>
		<div class="alert alert-success">
			<?php echo $_GET['msgOK']; ?>
		</div>
	<?php endif ?>

	<header class="mt-4 mb-4">
		<h1><img src="<?php echo LOGO_CLINICA; ?>" class="img-responsive" width="400px" alt="<?php echo NOME_CLINICA; ?>" /></h1>
	</header>

	<form method="POST">

		<div class="form-group">
			<label for="email"><i class="fas fa-envelope mr-1"></i> E-mail:</label>
			<input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
			<small id="emailHelp" class="form-text text-muted">Digite seu e-mail.</small>
		</div>

		<div class="form-group">
			<label for="senha"><i class="fas fa-key mr-1"></i> Senha:</label>
			<input type="password" class="form-control" id="senha" name="senha" required>
			<small id="senhaHelp" class="form-text text-muted">Digite sua senha.</small>
		</div>

		<button type="submit" class="btn btn-success btn-block btn-lg">Entrar</button>

	</form>

	</div><!-- col-md-6 -->
</div><!-- row -->