<header>
	<h1>Lista dos médicos</h1>
</header>

<p>Total: <?php echo $quantidade; ?></p>

<table class="table table-bordered">
	<tr>
		<th>id</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Especialidade</th>
		<th>CRM</th>
		<th>Status</th>
		<th>Ações</th>
	</tr>

<?php foreach($medicos as $item): ?>

	<tr>
		<td><?php echo $item['id']; ?></td>
		<td><?php echo $item['nome']; ?></td>
		<td><?php echo $item['email']; ?></td>
		<td><?php echo $item['especialidade']; ?></td>
		<td><?php echo $item['crm']; ?></td>
		<td><?php echo $item['status']; ?></td>
		<td></td>
	</tr>

<?php endforeach; ?>

</table>