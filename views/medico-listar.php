<header class="mt-4 mb-4">
	<h1>Médicos <small>[<?php echo $quantidade; ?>]</small></h1>
</header>

<p><a class="btn btn-primary" href="<?php echo BASE_URL ?>usuarios/adicionar"><i class="fas fa-user-plus mr-1"></i> Adicionar médico</a></p>

<table class="table table-bordered table-hover">
	<tr>
		<th>id</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Especialidade</th>
		<th>CRM</th>
		<th>Ações</th>
	</tr>

<?php foreach($medicos as $item): ?>

	<tr>
		<td><?php echo $item['id']; ?></td>
		<td><?php echo $item['nome']; ?></td>
		<td><?php echo $item['email']; ?></td>
		<td>
			<?php
				if($item['especialidade'] == 'Oftalmologista') { echo '<i class="fas fa-deaf mr-1"></i> Oftalmologista'; }
					else { echo '<i class="far fa-eye mr-1"></i> Otorrinolaringologista'; }
			?>
		</td>
		<td><?php echo $item['crm']; ?></td>
		<td>
			<span><a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $item['id']; ?>"><i class="fas fa-id-card-alt mr-1"></i> Ver ficha</a></span>
		</td>
	</tr>

<?php endforeach; ?>

</table>
