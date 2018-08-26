<header>
	<h1>Lista dos pacientes</h1>
</header>

<p>Total: <?php echo $quantidade; ?></p>

<table class="table table-bordered">
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
		<td></td>
	</tr>

<?php endforeach; ?>

</table>