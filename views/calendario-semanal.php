<div class="row justify-content-center">
	<div class="col-md-10">
		<header class="mt-4 mb-4">
			<h1>Agenda semanal</h1>
			<small><i class="far fa-calendar-alt mr-1"></i> Semana do dia: <?php echo $dia_atual." de ".$mes_atual_extenso." de ".$ano_atual; ?></small>
		</header>

		<div class="row">
			<div class="col-12 mt-2 mb-2 pt-2 pb-2">
			<form method="GET" class="form-inline">
				<input type="hidden" name="d" value="<?php if(empty($_GET['d'])) { echo date('Y-m-d'); } else { echo $_GET['d']; } ?>">
				<div class="form-group">
					<select class="form-control form-control-sm ml-2" id="medico" name="md">
						<option value="" selected>Todos os médicos</option>
						<?php foreach($medicos as $item): ?>
							<option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $md) { echo "selected"; } ?> > <?php echo $item['nome'] ." (". $item['especialidade'] .")"; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control form-control-sm ml-2" id="status" name="st">
						<option value="" selected>Todas as consultas</option>
						<option value="m" <?php if($st == 'm') { echo "selected"; } ?> >Marcada</option>
						<option value="r" <?php if($st == 'r') { echo "selected"; } ?> >Realizada</option>
						<option value="i" <?php if($st == 'i') { echo "selected"; } ?> >Indisponibilidade</option>
					</select>
				</div>
				<div class="form-group">
				<button type="submit" class="btn btn-primary btn-sm ml-4"><i class="fas fa-filter"></i> Filtrar</button>
				<small><a class="ml-4 text-secondary" href="<?php if(empty($_GET['d'])) { $dt = date('Y-m-d'); } else { $dt = $_GET['d']; }; echo BASE_URL.'calendario?d='.$dt; ?>"><i class="fas fa-times mr-1"></i> Limpar</a></small>
				</div>
			</form>
			</div>
		</div>

		<div class="row col-12 mt-3 mb-3">
			<div class="col-6">
				<a class="btn btn-secondary btn-sm" href="?d=<?php echo date("Y-m-d", strtotime($data. 'last week')); ?>
					<?php if(!empty($md)) { echo '&md='.$md; } ?>
					<?php if(!empty($st)) { echo '&st='.$st; } ?>"
					><i class="far fa-calendar-minus mr-1"></i> Semana anterior</a>
			</div>
			<div class="col-6 text-right">
				<a class="btn btn-secondary btn-sm" href="?d=<?php echo date("Y-m-d", strtotime($data. 'next week')); ?>
				<?php if(!empty($md)) { echo '&md='.$md; } ?>
				<?php if(!empty($st)) { echo '&st='.$st; } ?>"
				>Próximo semana <i class="far fa-calendar-plus ml-1"></i></a>
			</div>
		</div>

		<div class="list-group list-group-flush">
			<div class="row">
			<?php for($c=0; $c<7; $c++): 
				$d = date('Y-m-d', strtotime( ($c ).' days', strtotime($data_inicio)) );
				// data atual do loop / exibição calendário:
				$d = date('Y-m-d', strtotime($d));
				
				// dia da semana:
				$w = date('l', strtotime($d));
				switch ($w) {
					case "Sunday":
						$w = "Domingo"; break;
					case "Monday":
						$w = "Segunda"; break;
					case "Tuesday":
						$w = "Terça"; break;
					case "Wednesday":
						$w = "Quarta"; break;
					case "Thursday":
						$w = "Quinta"; break;
					case "Friday":
						$w = "Sexta"; break;
					case "Saturday":
						$w = "Sábado"; break;
				}?>

				<div class="col-xs-12 col-md-5 <?php if($w == 'Quarta') { echo "col-lg-3"; } else { echo "col-lg-2"; } ?> bg bg-light mr-1 mb-1" <?php if( $w == 'Domingo' || $w == 'Sábado') { echo "style='display:none;'"; } ?>>
				<?php
				echo "<p class='font-weight-bold mt-2'>". $w." ". date('d/m', strtotime($d)) ."</p>";

					foreach ($calendario as $item) {
						// consulta
						$dt_con_inicio = date('Y-m-d', strtotime($item['con_inicio']));
						$dh_con_inicio = date('Y-m-d H:i', strtotime($item['con_inicio']));
						$dh_con_fim =    date('Y-m-d H:i', strtotime($item['con_fim']));

						// exibição
						$dthr_con_inicio = date('d/m H:i', strtotime($item['con_inicio']));
						$dthr_con_fim =    date('d/m H:i', strtotime($item['con_fim']));
						$hr_con_inicio = date('H:i', strtotime($item['con_inicio']));
						$hr_con_fim =    date('H:i', strtotime($item['con_fim']));

						$situacao =  $item['con_status'];

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

						$id =  $item['id'];

						$paciente = $item['nome'];
						$medico =   $item['med_nome'];

						if( $d == $dt_con_inicio || ($d >= $dh_con_inicio) && ($d <= $dh_con_fim) ) {
							if($situacao != '0') {
								echo "<p><a class='text-".$situacao_cor."' href=".BASE_URL."consultas/detalhe/".$id." title='Ver detalhes da consulta'>".$hr_con_inicio." ".
									 $paciente."<br>".
									 "<small><strong>".$medico."</strong></small></a></p>";
							} else {
								echo "<p><a class='text-".$situacao_cor."' href=".BASE_URL."consultas/detalhe/".$id." title='Ver detalhes da consulta'>".$dthr_con_inicio." - ".$dthr_con_fim." ".
									 "<small><strong>".$medico."</strong></small></a></p>";
							}
						}
					} // foreach
				?>

			</div>
			<?php endfor; ?>
			</div><!-- row -->
		</div><!-- list-group -->

		<div class="d-lg-none">
			<div class="row col-12 mt-3 mb-3">
			<div class="col-6">
				<a class="btn btn-secondary btn-sm" href="?d=<?php echo date("Y-m-d", strtotime($data. 'last week')); ?>"><i class="far fa-calendar-minus mr-1"></i> Semana anterior</a>
			</div>
			<div class="col-6 text-right">
				<a class="btn btn-secondary btn-sm" href="?d=<?php echo date("Y-m-d", strtotime($data. 'next week')); ?>">Próximo semana <i class="far fa-calendar-plus ml-1"></i></a>
			</div>
		</div>
		</div>

	</div>
</div>