<header class="mt-4 mb-4">
	<h1>Editar paciente</h1>
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
		<label for="nomePaciente"><i class="fas fa-user mr-1"></i> Nome:</label>
		<input type="text" class="form-control col-lg-6" id="nomePaciente" name="nomePaciente" value="<?php echo $info['nome']; ?>" required>
		<small id="nomePacienteHelp" class="form-text text-muted">Preencha o nome completo do paciente.</small>
	</div>

	<div class="form-group col-md-8 col-lg-6">
		<label for="dataNascimento"><i class="fas fa-birthday-cake mr-1"></i> Data de nascimento:</label>
		<input type="text" class="form-control col-lg-6" id="dataNascimento" name="dataNascimento" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" maxlength="10" placeholder="DD/MM/AAAA" value="<?php echo $data_nasc; ?>" required>
		<small id="dataNascimentoHelp" class="form-text text-muted">Preencha no formato DD/MM/AAAA. Ex.: 26/08/1968</small>
	</div>

	<div class="form-group col-md-8 col-lg-6">
		<label for="email"><i class="fas fa-envelope mr-1"></i> E-mail:</label>
		<input type="email" class="form-control col-lg-6" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $info['email']; ?>" required>
		<small id="emailHelp" class="form-text text-muted">Preencha o e-mail do paciente.</small>
	</div>

	<div class="form-group col-md-8 col-lg-6">
		<label for="telefone"><i class="fas fa-phone mr-1"></i> Telefone:</label>
		<input type="text" class="form-control col-lg-6" id="telefone" name="telefone" maxlength="12" value="<?php echo $info['telefone']; ?>"required>
		<small id="telefoneHelp" class="form-text text-muted">Preencha o telefone do paciente no formato DDD123456789. Ex.: 051998765432.</small>
	</div>

	<div class="form-group col-md-8 col-lg-6">
		<label for="cpf"><i class="fas fa-id-card mr-1"></i> CPF:</label>
		<input type="text" class="form-control col-lg-6" id="cpf" name="cpf" maxlength="11" value="<?php echo $info['cpf']; ?>" required>
		<small id="cpfHelp" class="form-text text-muted">Preencha o CPF do paciente no formato 12345678900. Ex.: 65400063185.</small>
	</div>

	<div class="form-group col-md-8 col-lg-6">
		<label for="planoSaude"><i class="fas fa-briefcase-medical mr-1"></i> Plano de saúde:</label>
		<select class="form-control col-lg-6" id="planoSaude" name="planoSaude"  required>
			<option value="">-- Selecione --</option>
			<option value="AMIL" <?php if($info['plano_saude'] == "AMIL") { echo "selected"; } ?>>AMIL</option>
			<option value="CABERGS" <?php if($info['plano_saude'] == "CABERGS") { echo "selected"; } ?>>CABERGS</option>
			<option value="CASSI" <?php if($info['plano_saude'] == "CASSI") { echo "selected"; } ?>>CASSI</option>
			<option value="UNIMED"<?php if($info['plano_saude'] == "UNIMED") { echo "selected"; } ?>>UNIMED</option>
		</select>
		<small id="planoSaudeHelp" class="form-text text-muted">Selecione o plano de saúde do paciente. Caso não esteja na lista, informar o valor da consulta particular.</small>
	</div>

	<button type="submit" class="btn btn-success">Salvar alterações</button>
</form>
<br>
<p class="text-right"><a class="btn btn-danger" href="<?php echo BASE_URL ?>pacientes/cadastro/<?php echo $info['id']; ?>"><i class="fas fa-times mr-1"></i> Cancelar edição</a></p>
