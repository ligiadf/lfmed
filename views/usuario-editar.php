<div class="row justify-content-center">
	<div class="col-md-6">
	<header class="mt-4 mb-4">
		<p><i class="fas fa-user-edit mr-1"></i> Editar cadastro usuário</p>
		<h1><?php echo $info['nome']; ?></h1>
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
			<p><i class="fas fa-passport mr-1"></i> <strong>ID:</strong> <?php echo $info['id']; ?></p>
		</div>

		<div class="form-group">
			<label for="status"><i class="fas fa-user mr-1"></i> Status:</label>
			<div class="form-check form-check-inline ml-2">
				<input class="form-check-input" type="radio" name="status" id="status1" value="1" <?php if($info['status'] == '1') { echo "checked"; }; ?>>
				<label class="form-check-label" for="status1">Ativo</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="status" id="status2" value="0" <?php if($info['status'] == '0') { echo "checked"; }; ?>>
				<label class="form-check-label" for="status2">Inativo</label>
			</div>
			<small id="statusHelp" class="form-text text-muted">Selecione o status do usuário.</small>
		</div>

		<div class="form-group">
			<label for="nomeUsuario"><i class="fas fa-user mr-1"></i> Nome:</label>
			<input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" value="<?php echo $info['nome']; ?>" required>
			<small id="nomeUsuarioHelp" class="form-text text-muted">Preencha o nome completo do usuário.</small>
		</div>

		<div class="form-group">
			<label for="email"><i class="fas fa-envelope mr-1"></i> E-mail:</label>
			<input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $info['email']; ?>" required>
			<small id="emailHelp" class="form-text text-muted">Preencha o e-mail do usuário. Deve ser único no sistema.</small>
		</div>

		<div class="form-group">
			<label for="perfil"><i class="fas fa-user-cog mr-1"></i> Perfil:</label>
			<div class="form-check form-check-inline ml-2">
				<input class="form-check-input" type="radio" name="perfil" id="perfil1" value="MED" <?php if($info['perfil'] == 'MED') { echo "checked"; }; ?>>
				<label class="form-check-label" for="perfil1">Médico</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="perfil" id="perfil2" value="REC" <?php if($info['perfil'] == 'REC') { echo "checked"; }; ?>>
				<label class="form-check-label" for="perfil2">Recepcionista</label>
			</div>
			<small id="perfilHelp" class="form-text text-muted">Selecione o perfil do usuário.</small>
		</div>

	<fieldset class="form-group" id="apenasMedicos">
		<legend class="small">Apenas para médicos</legend>
		<div class="form-group">
			<label for="especialidade"><i class="fas fa-medkit mr-1"></i> Especialidade:</label><br>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="especialidade" id="especialidade1" value="Oftalmologista" <?php if($info['especialidade'] == 'Oftalmologista') { echo "checked"; }; ?>>
				<label class="form-check-label" for="especialidade1">Oftalmologista</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="especialidade" id="especialidade2" value="Otorrinolaringologista" <?php if($info['especialidade'] == 'Otorrinolaringologista') { echo "checked"; }; ?>>
				<label class="form-check-label" for="especialidade2">Otorrinolaringologista</label>
			</div>
			<small id="especialidadeHelp" class="form-text text-muted">Selecione a especialidade do médico.</small>
		</div>

		<div class="form-group">
			<label for="crm"><i class="fas fa-id-card mr-1"></i> CRM:</label>
			<input type="text" class="form-control" id="crm" name="crm" maxlength="15" value="<?php echo $info['crm'];?>">
			<small id="crmHelp" class="form-text text-muted">Preencha o número de registro do médico no Conselho. Ex.: CREMERS 12345</small>
		</div>
	</fieldset>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-link text-danger" href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $info['id']; ?>"><i class="fas fa-times mr-1"></i> Cancelar edição</a>
			</div>
			<div class="col-6 text-right">
				<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Salvar alterações</button>
			</div>
		</div>

	</form>

	</div><!-- col-md-6 -->
</div><!-- row -->