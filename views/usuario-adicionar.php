<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'usuarios'; ?>">Usuários</a></li>
	<li class="breadcrumb-item active">Adicionar</li>
</ol>
<div class="row justify-content-center">
	<div class="col-md-6">
	<header class="mt-4 mb-4">
		<h1>Adicionar usuário</h1>
	</header>

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

	<form method="POST">
		<div class="form-group">
			<label for="nomeUsuario"><i class="fas fa-user mr-1"></i> Nome:</label>
			<input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" required>
			<small id="nomeUsuarioHelp" class="form-text text-muted">Preencha o nome completo do usuário.</small>
		</div>

		<div class="form-group">
			<label for="email"><i class="fas fa-envelope mr-1"></i> E-mail:</label>
			<input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
			<small id="emailHelp" class="form-text text-muted">Preencha o e-mail do usuário. Deve ser único no sistema.</small>
		</div>

		<div class="form-group">
			<label for="senha"><i class="fas fa-key mr-1"></i> Senha:</label>
			<input type="password" class="form-control" id="senha" name="senha" required>
			<small id="senhaHelp" class="form-text text-muted">Preencha a senha para o usuário entrar no sistema.</small>
		</div>

		<div class="form-group">
			<label for="perfil"><i class="fas fa-user-cog mr-1"></i> Perfil:</label><br>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="perfil" id="perfil1" value="MED" <?php if(isset($_GET['pf']) && $_GET['pf'] == 'md') { echo 'checked'; } ?>>
				<label class="form-check-label" for="perfil1">Médico</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="perfil" id="perfil2" value="REC">
				<label class="form-check-label" for="perfil2">Recepcionista</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="perfil" id="perfil3" value="LAB">
				<label class="form-check-label" for="perfil3">Laboratório</label>
			</div>
			<small id="planoSaudeHelp" class="form-text text-muted">Selecione o perfil do usuário.</small>
		</div>

	<fieldset class="form-group" id="apenasMedicos">
		<legend class="small">Apenas para médicos</legend>
		<div class="form-group">
			<label for="especialidade"><i class="fas fa-medkit mr-1"></i> Especialidade:</label><br>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="especialidade" id="especialidade1" value="Oftalmologista">
				<label class="form-check-label" for="especialidade1">Oftalmologista</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="especialidade" id="especialidade2" value="Otorrinolaringologista">
				<label class="form-check-label" for="especialidade2">Otorrinolaringologista</label>
			</div>
			<small id="planoSaudeHelp" class="form-text text-muted">Selecione a especialidade do médico.</small>
		</div>

		<div class="form-group">
			<label for="crm"><i class="fas fa-id-card mr-1"></i> CRM:</label>
			<input type="text" class="form-control" id="crm" name="crm" maxlength="15">
			<small id="crmHelp" class="form-text text-muted">Preencha o número de registro do médico no Conselho. Ex.: CREMERS 12345</small>
		</div>
	</fieldset>

		<input type="hidden" id="statusUsuario" name="statusUsuario" value="1">

		<div class="row">
			<div class="col-6">
				<a class="btn btn-link text-danger" href="<?php echo BASE_URL ?>usuarios/"><i class="fas fa-times mr-1"></i> Cancelar</a>
			</div>
			<div class="col-6 text-right">
				<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Adicionar</button>
			</div>
		</div>

	</form>

	</div><!-- col-md-6 -->
</div><!-- row -->