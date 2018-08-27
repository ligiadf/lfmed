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
	<div class="form-group col-md-8 col-lg-6">
		<label for="nomeUsuario"><i class="fas fa-user mr-1"></i> Nome:</label>
		<input type="text" class="form-control col-lg-6" id="nomeUsuario" name="nomeUsuario" required>
		<small id="nomeUsuarioHelp" class="form-text text-muted">Preencha o nome completo do usuário.</small>
	</div>

	<div class="form-group col-md-8 col-lg-6">
		<label for="email"><i class="fas fa-envelope mr-1"></i> E-mail:</label>
		<input type="email" class="form-control col-lg-6" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
		<small id="emailHelp" class="form-text text-muted">Preencha o e-mail do usuário.</small>
	</div>

	<div class="form-group col-md-8 col-lg-6">
		<label for="senha"><i class="fas fa-key mr-1"></i> Senha:</label>
		<input type="password" class="form-control col-lg-6" id="senha" name="senha" required>
		<small id="senhaHelp" class="form-text text-muted">Preencha a senha para o usuário entrar no sistema.</small>
	</div>

	<div class="form-group col-md-8 col-lg-6">
		<label for="perfil"><i class="fas fa-user-cog mr-1"></i> Perfil:</label><br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="perfil" id="perfil1" value="MED">
			<label class="form-check-label" for="perfil1">Médico</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="perfil" id="perfil2" value="REC">
			<label class="form-check-label" for="perfil2">Recepcionista</label>
		</div>
		<small id="planoSaudeHelp" class="form-text text-muted">Selecione o perfil do usuário.</small>
	</div>

<fieldset class="form-group">
	<legend class="small">Apenas para médicos</legend>
	<div class="form-group col-md-8 col-lg-6">
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

	<div class="form-group col-md-8 col-lg-6">
		<label for="crm"><i class="fas fa-id-card mr-1"></i> CRM:</label>
		<input type="text" class="form-control col-lg-6" id="crm" name="crm" maxlength="15">
		<small id="cpfHelp" class="form-text text-muted">Preencha o número de registro do médico no Conselho. Ex.: CREMERS 12345</small>
	</div>
</fieldset>

	<input type="hidden" id="statusUsuario" name="statusUsuario" value="1">

	<button type="submit" class="btn btn-primary">Adicionar usuário</button>
</form>