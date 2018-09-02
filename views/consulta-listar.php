<header class="mt-4 mb-4">
	<h1>Consultas <small>[<?php echo $quantidade; ?>]</small></h1>
</header>

<p><a class="btn btn-primary" href="<?php echo BASE_URL ?>consultas/marcar"><i class="far fa-calendar-check mr-1"></i> Marcar consulta</a></p>

<table class="table table-bordered table-hover">
	<tr>
		<th>id</th>
		<th>Início da consulta</th>
		<th>Fim da consulta</th>
		<th>Paciente</th>
		<th>Médico</th>
		<th>Situação</th>
		<th>Ações</th>
	</tr>

<?php foreach($consultas as $item): ?>

	<?php 
		$dt_inicio = date('d/m/Y H:i', strtotime($item['con_inicio']));
		$dt_fim = date('d/m/Y H:i', strtotime($item['con_fim']));
		$hora_fim = date('H:i', strtotime($item['con_fim']));
		$situacao = $item['con_status'];
	?>

	<tr >
		<td><?php echo $item['id']; ?></td>
		<td><?php echo $dt_inicio ?></td>
		<td><?php echo $dt_fim ?></td>
		<td>
			<?php
			if($situacao == 0) { echo "- Indisponibilidade -"; }
				else { echo $item['nome']; }
			?>
		</td>
		<td><?php echo $item['med_nome']; ?></td>
		<td>
			<?php
			switch ($situacao) {
				case "0":
					$situacao = "<span class='text-danger'>Indisponibilidade</span>";
					break;
				case "1":
					$situacao = "<span class='text-info'>Marcada</span>";
					break;
				case "2":
					$situacao = "<span class='text-success'>Realizada</span>";
					break;
				case "3":
					$situacao = "<span class='text-secondary'>Ausente</span>";
					break;
				case "4":
					$situacao = "<span class='text-secondary'>Cancelada</span>";
					break;
			}
			echo $situacao;
			?>
		</td>
		<td><span><a href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $item['id']; ?>"><i class="fas fa-list-alt mr-1"></i> Ver detalhes</a></span></td>
	</tr>

<?php endforeach; ?>

</table>