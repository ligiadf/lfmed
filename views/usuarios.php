<header>
	<h1>Lista dos usuários</h1>
</header>

<p>Total: <?php echo $quantidade; ?></p>

<table class="table table-bordered table-hover">
	<tr>
		<th>id</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Especialidade</th>
		<th>CRM</th>
		<th>Perfil</th>
		<th>Status</th>
		<th>Ações</th>
	</tr>

<?php foreach($usuarios as $item): ?>

	<tr">
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
			<?php
				switch($item['perfil']) {
					case 'ADM':
						echo '<i class="fas fa-user-shield mr-1"></i> Administrador'; break;
					case 'MED':
						echo '<i class="fas fa-user-md mr-1"></i> Médico'; break;
					case 'REC':
						echo '<i class="fas fa-user-clock mr-1"></i> Recepcionista'; break;
					}
			?>
		</td>
		<td>
			<?php
				if($item['status'] == 1) { echo '<span class="text-success"><i class="fas fa-user-check mr-1"></i> Ativo</span>'; }
					else { echo '<i class="fas fa-user-times mr-1"></i> Inativo'; }
			?>
		</td>
		<td>
			<span><a href="usuarios/ficha/[id]"><i class="fas fa-id-card-alt mr-1"></i> Ver ficha</a></span>
		</td>
	</tr>

<?php endforeach; ?>

</table>