<header class="mt-4 mb-4">
	<h1>Usuários <small>[<?php echo $quantidade; ?>]</small></h1>
</header>

<p><a class="btn btn-primary" href="<?php echo BASE_URL ?>usuarios/adicionar"><i class="fas fa-user-plus mr-1"></i> Adicionar usuário</a></p>

<table class="table table-bordered table-hover">
	<tr>
		<th>id</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Perfil</th>
		<th>Especialidade</th>
		<th>CRM</th>
		<th>Situação</th>
		<th>Ações</th>
	</tr>

<?php foreach($usuarios as $item): ?>

	<tr>
		<td><?php echo $item['id']; ?></td>
		<td><?php echo $item['nome']; ?></td>
		<td><?php echo $item['email']; ?></td>
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
				if( $item['perfil'] == 'MED' && $item['especialidade'] == 'Oftalmologista') { echo '<i class="fas fa-deaf mr-1"></i> Oftalmologista'; }
				else if( $item['perfil'] == 'MED' && $item['especialidade'] == 'Otorrinolaringologista') { echo '<i class="far fa-eye mr-1"></i> Otorrinolaringologista'; }
					else if ($item['perfil'] == 'MED') { echo '<span class="text-danger">Cadastrar especialidade!</span>'; }
			?>
		</td>
		<td><?php echo $item['crm']; ?></td>
		<td>
			<?php
				if($item['status'] == 1) { echo '<span class="text-success"><i class="fas fa-user-check mr-1"></i> Ativo</span>'; }
					else { echo '<span class="text-danger"><i class="fas fa-user-times mr-1"></i> Inativo</span>'; }
			?>
		</td>
		<td>
			<span><a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $item['id']; ?>"><i class="fas fa-id-card-alt mr-1"></i> Ver ficha</a></span>
		</td>
	</tr>

<?php endforeach; ?>

</table>