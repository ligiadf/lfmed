<header class="mt-4 mb-4">
	<h1>Médicos <small>[<?php echo $quantidade; ?>]</small></h1>
</header>

<p>Total: <?php echo $quantidade; ?></p>

<table class="table table-bordered">
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
			<span><a href="usuarios/ficha/[id]"><i class="fas fa-id-card-alt mr-1"></i> Ver ficha</a></span>
		</td>
	</tr>

<?php endforeach; ?>

</table>