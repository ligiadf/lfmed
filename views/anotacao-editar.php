<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas'; ?>">Consultas</a></li>
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas/listar'; ?>">Listar consultas</a></li>
	<li class="breadcrumb-item"><A HREF="<?php echo BASE_URL.'consultas/detalhe/'.$id ?>">Detalhes da consulta</a></li>
	<li class="breadcrumb-item active">Editar anotação</li>
</ol>
<div class="row justify-content-center">
	<div class="col-md-10">

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

	<header class="mt-4 mb-4">
		<h1>Editar anotação <small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $id; ?></small></h1>
	</header>

	<?php include_once('_dados-consulta.php'); ?>

	<form method="POST">
		<div class="form-group col-12">
			<label for="anotacao">
				<h5 class="mt-3 mb-3"><i class="fas fa-file-signature mr-1"></i> Anotação</h5>
			</label>
			<textarea class="form-control" id="anotacao" name="anotacao" maxlength="500" rows="4" required><?php echo $anotacao; ?></textarea>
			<small id="anotacaoHelp" class="form-text text-muted">Preencha com anotações referentes ao relato do paciente e à observação clínica.</small>
		</div>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-link btn-sm text-danger" href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $id; ?>"><i class="fas fa-times mr-1"></i> Cancelar</a>
			</div>
			<div class="col-6 text-right">
				<button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check mr-1"></i> Editar</button>
			</div>
		</div>
	</form>
	</div><!-- col-md-6 -->
</div><!-- row -->