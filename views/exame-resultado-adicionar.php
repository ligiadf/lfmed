<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'exames'; ?>">Exames</a></li>
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'exames/pacientes'; ?>">Buscar paciente</a></li>
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'exames/paciente/'.$ficha['id']; ?>">Exames do paciente <?php echo $ficha['nome']; ?></a></li>
	<li class="breadcrumb-item active">Adicionar resultado de exame</li>
</ol>

<div class="row justify-content-center">
	<div class="col-md-10">

	<?php if(!empty($_GET['msgError'])): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $_GET['msgError']; ?>
		</div>
	<?php endif ?>

	<?php if(!empty($_GET['msgOK'])): ?>
		<div class="alert alert-success" role="alert">
			<?php echo $_GET['msgOK']; ?>
		</div>
	<?php endif ?>

	<?php if(!empty($_GET['msgOK2'])): ?>
		<div class="alert alert-success" role="alert">
			<?php echo $_GET['msgOK2']; ?>
		</div>
	<?php endif ?>

		<header class="mt-4 mb-4">
			<h1>
				Resultado de exame
				<small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $pedido['id_req']; ?></small>
			</h1>
		</header>

	<h4 class="mt-4">
		<i class="fas fa-user mr-1"></i> <a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $ficha['id']; ?>" title="Ver ficha do paciente"><?php echo $ficha['nome']; ?></a>
	</h4>

	<h5 class="mt-3 mb-3">Adicionar resultado para exame <?php echo $pedido['nome']; ?></h5>


	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-12 text-left">
				<label for="arquivo">Enviar arquivo</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="8388608" />
				<input type="file" class="form-control-file" id="arquivo" name="arquivo" />
				<small id="arquivoHelp" class="form-text text-muted">Envie um arquivo PDF único com o resultado deste exame. Tamanho máximo: 8MB.</small>
			</div>
			<div class="col-12 mt-2">
				<button type="submit" id="filtro" class="btn btn-success btn-sm"><i class="fas fa-file-upload mr-1"></i> Enviar arquivo</button>
			</div>
		</div>
	</form>

	</div><!-- col-md-6 -->
</div><!-- row -->