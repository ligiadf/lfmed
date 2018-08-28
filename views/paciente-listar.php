<header class="mt-4 mb-4">
	<h1>Pacientes <small>[<?php echo $quantidade; ?>]</small></h1>
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

<p><a class="btn btn-primary" href="<?php echo BASE_URL ?>pacientes/cadastrar"><i class="fas fa-user-plus mr-1"></i> Cadastrar paciente</a></p>

<table class="table table-bordered table-hover">
	<tr>
		<th>id</th>
		<th>Nome</th>
		<th>Data de nascimento</th>
		<th>E-mail</th>
		<th>Telefone</th>
		<th>CPF</th>
		<th>Plano de saúde</th>
		<th>Ações</th>
	</tr>

<?php foreach($pacientes as $item): ?>

	<tr>
		<td><?php echo $item['id']; ?></td>
		<td><?php echo $item['nome']; ?></td>
		<td><?php echo $item['data_nasc']; ?></td>
		<td><?php echo $item['email']; ?></td>
		<td><?php echo $item['telefone']; ?></td>
		<td><?php echo $item['cpf']; ?></td>
		<td><?php echo $item['plano_saude']; ?></td>
		<td><a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $item['id']; ?>"><i class="fas fa-id-card mr-1"></i> Ver cadastro</a></td>
	</tr>

<?php endforeach; ?>

</table>