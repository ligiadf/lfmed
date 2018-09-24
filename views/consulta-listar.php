<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-4">
			<h1>Consultas <small><a class="btn btn-sm btn-primary" href="<?php echo BASE_URL ?>consultas/marcar"><i class="far fa-calendar-check mr-1"></i> Marcar consulta</a></small></h1>
		</header>

		<div class="row">
			<div class="col-12 mt-2 mb-2 pt-2 pb-2">
				<form method="GET" class="">
					<div class="row">
						<div class="form-group col-12 col-lg-2">
							<label class="col-form-label-sm" for="data_inicial">Data inicial:</label>
							<input type="text" class="form-control form-control-sm ml-2" id="data_inicial" name="di" maxlength="10" placeholder="DD-MM-AAAA" value="<?php echo $di; ?>" >
						</div>
						<div class="form-group col-12 col-lg-2">
							<label class="col-form-label-sm" for="data_final">Data final:</label>
							<input type="text" class="form-control form-control-sm ml-2" id="data_final" name="df" maxlength="10 " placeholder="DD-MM-AAAA" value="<?php echo $df; ?>">
						</div>
						<div class="form-group col-12 col-lg-3">
							<label class="col-form-label-sm" for="medico">Médico:</label>
							<select class="form-control form-control-sm ml-2" id="medico" name="md">
								<option value="" selected>Todos os médicos</option>
								<?php foreach($medicos as $item): ?>
									<option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $md) { echo "selected"; } ?> > <?php echo $item['nome'] ." (". $item['especialidade'] .")"; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-12 col-lg-2">
							<label class="col-form-label-sm" for="status">Situação:</label>
							<select class="form-control form-control-sm ml-2" id="status" name="st">
								<option value="" selected>Todas as consultas</option>
								<option value="m" <?php if($st == 'm') { echo "selected"; } ?> >Marcada</option>
								<option value="r" <?php if($st == 'r') { echo "selected"; } ?> >Realizada</option>
								<option value="a" <?php if($st == 'a') { echo "selected"; } ?> >Ausente</option>
								<option value="c" <?php if($st == 'c') { echo "selected"; } ?> >Cancelada</option>
								<option value="i" <?php if($st == 'i') { echo "selected"; } ?> >Indisponibilidade</option>
							</select>
						</div>
						<div class="form-group col-12 col-lg-3">
							<button type="submit" id="filtro" class="btn btn-primary btn-sm ml-2 mt-0"><i class="fas fa-filter"></i> Filtrar</button>
							<small class="d-inline-block mt-lg-4 pt-3"><a class="ml-4 text-secondary" href="<?php echo BASE_URL.'consultas' ?>"><i class="fas fa-times mr-1"></i> Limpar</a></small>
						</div>
					</div>
				</form>
			</div>
		</div>

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
				<a class="btn btn-secondary <?php if($pagina_atual == $p) { echo "active"; } ?>" role="button" href="<?php echo BASE_URL.'consultas?p='.$p; if(!empty($_GET['md'])) { echo "&md=".$_GET['md']; } if(!empty($_GET['st'])) { echo "&st=".$_GET['st']; } if(!empty($_GET['di'])) { echo "&di=".$_GET['di']; } if(!empty($_GET['df'])) { echo "&df=".$_GET['df']; } ?>"><?php echo $p; ?></a>
			<?php endfor; ?>
			<p class="text-muted mt-2">Total: <?php echo $quantidade; ?></p>
			</div>
		</div>

	</div>
</div>