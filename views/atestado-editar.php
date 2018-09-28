<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas'; ?>">Consultas</a></li>
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas/listar'; ?>">Listar consultas</a></li>
	<li class="breadcrumb-item"><A HREF="<?php echo BASE_URL.'consultas/detalhe/'.$id ?>">Detalhes da consulta</a></li>
	<li class="breadcrumb-item active">Editar atestado</li>
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
		<h1>Editar atestado <small style="font-size: 40%;" class="badge badge-pill badge-light"><?php echo $id; ?></small></h1>
	</header>

	<?php include_once('_dados-consulta.php'); ?>

	<h5 class="mt-3 mb-3"><i class="fas fa-file-signature mr-1"></i> Dados do atestado</h5>

	<form method="POST">

		<div class="form-group col-12">
			<label for="atestadoPeriodo"><i class="far fa-calendar-alt mr-1"></i> Período:</label>
			<input type="text" class="form-control" id="atestadoPeriodo" name="atestadoPeriodo" maxlength="50" value="<?php echo $atestadoPeriodo; ?>" required>
			<small id="atestadoPeriodoHelp" class="form-text text-muted">Preencha o período do atestado. Exemplos: <code>de 3 dias a partir de 15/07/2018</code> | <code>de 15 a 20/07/2018</code> | <code>por 7 dias a partir de hoje</code></small>
		</div>

		<div class="form-group col-12">
			<label for="atestadoMotivo"><i class="fas fa-file-signature mr-1"></i> Motivo:</label>
			<textarea class="form-control" id="atestadoMotivo" name="atestadoMotivo" maxlength="100" rows="2" required><?php echo $atestadoMotivo; ?></textarea>
			<small id="atestadoMotivoHelp" class="form-text text-muted">Preencha o motivo do atestado. Exemplos: <code>suspeita de conjuntivite</code> | <code>glaucoma</code></small>
		</div>

		<div class="form-group col-12 col-md-6">
			<label for="atestadoCID"><i class="fas fa-file-medical mr-1"></i> CID-10: <small>[<a href="http://www.datasus.gov.br/cid10/v2008/cid10.htm" target="_blank" title="Consulte CID-10">Consultar</a>]</small></label>
			<input type="text" class="form-control" id="atestadoCID" name="atestadoCID" maxlength="10" value="<?php if(!empty($atestadoCID)) { echo $atestadoCID; } ?>">
			<small id="atestadoCIDHelp" class="form-text text-muted">Preencha o CID-10 da doença (opcional). Exemplos: <code>H404</code> | <code>H10.1</code></small>
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