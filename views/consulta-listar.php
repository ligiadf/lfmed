<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Consultas <small><a class="btn btn-sm btn-primary" href="<?php echo BASE_URL ?>consultas/marcar"><i class="far fa-calendar-check mr-1"></i> Marcar consulta</a></small></h1>
		</header>

		<?php foreach($consultas as $item): ?>

			<div class="list-group list-group-flush">
				<?php
					$dt_inicio = date('d/m/Y', strtotime($item['con_inicio']));
					$hora_inicio = date('H:i', strtotime($item['con_inicio']));
					$dt_fim = date('d/m/Y', strtotime($item['con_fim']));
					$hora_fim = date('H:i', strtotime($item['con_fim']));
					$situacao = $item['con_status'];

					switch ($situacao) {
						case "0": 
							$situacao_nome = "Indisponibilidade";
							$situacao_cor = "danger";
							$situacao_icone = "<i class='fas fa-ban mr-1'></i>";
							break;
						case "1": 
							$situacao_nome = "Marcada";
							$situacao_cor = "info";
							$situacao_icone = "<i class='far fa-calendar-check mr-1'></i>";
							break;
						case "2": 
							$situacao_nome = "Realizada";
							$situacao_cor = "success";
							$situacao_icone = "<i class='fas fa-check mr-1'></i>";
							break;
						case "3": 
							$situacao_nome = "Paciente ausente";
							$situacao_cor = "secondary";
							$situacao_icone = "<i class='far fa-user mr-1'></i>";
							break;
						case "4": 
							$situacao_nome = "Cancelada";
							$situacao_cor = "secondary";
							$situacao_icone = "<i class='far fa-calendar-times mr-1'></i>";
							break;
						}
				?>
				<a href="<?php echo BASE_URL ?>consultas/detalhe/<?php echo $item['id']; ?>" class="list-group-item list-group-item-action text-<?php echo $situacao_cor; ?>" title="Ver detalhes da consulta">
					<div class="row">
						<div class="col-12 col-md-4">
							<?php
								echo $situacao_icone." ";
								if($situacao != '0') {
									echo "<strong>".$dt_inicio." ".$hora_inicio."</strong> - ".$situacao_nome;
								} else {
									echo "<strong>".$dt_inicio." ".$hora_inicio." - ".$dt_fim." ".$hora_fim."</strong>";
								}
							?>
						</div>
						<div class="col-12 col-md-4">
							<?php
								echo "<strong>".$item['med_nome']."</strong> (".$item['especialidade'].")";
							?>
						</div>
						<div class="col-12 col-md-4">
							<?php
								if($situacao != '0') { echo "<i class='fas fa-user'></i> ".$item['nome']; }
								else { echo $situacao_nome; }
							?>
						</div>
					</div>

				</a>
			</div>

		<?php endforeach; ?>

		<div class="row text-center mt-3">
			<div class="col-12">
			<?php for($p=1; $p<=$paginas; $p++): ?>
				<a class="btn btn-secondary <?php if($pagina_atual == $p) { echo "active"; } ?>" role="button" href="<?php echo BASE_URL; ?>consultas?p=<?php echo $p; ?>"><?php echo $p; ?></a>
			<?php endfor; ?>
			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>

	</div>
</div>