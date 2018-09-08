<header class="mt-4 mb-4">
	<p><i class="far fa-calendar-alt mr-1"></i> <?php echo "Início: ".$dia_atual." de ".$mes_atual_extenso." de ".$ano_atual; ?></p>
	<h1>Agenda da semana
	</h1>
</header>

<div class="row col-12 mt-3 mb-3">
	<div class="col-6">
		<a class="btn btn-secondary btn-sm" href="?d=<?php echo date("Y-m-d", strtotime($data. 'last week')); ?>"><i class="far fa-calendar-minus mr-1"></i> Semana anterior</a>
	</div>
	<div class="col-6 text-right">
		<a class="btn btn-secondary btn-sm" href="?d=<?php echo date("Y-m-d", strtotime($data. 'next week')); ?>">Próximo semana <i class="far fa-calendar-plus ml-1"></i></a>
	</div>
</div>

<div class="table-responsive">
<table id="calendario_completo" class="table table-sm">
	<thead>
		<tr>
			<th scope="col">Domingo</th>
			<th scope="col">Segunda</th>
			<th scope="col">Terça</th>
			<th scope="col">Quarta</th>
			<th scope="col">Quinta</th>
			<th scope="col">Sexta</th>
			<th scope="col">Sábado</th>
		</tr>
	</thead>
	<tbody>
	<?php for($l=0; $l<$linhas; $l++): ?>
		<tr>
			<?php for($c=0; $c<7; $c++): 
				$d = date('Y-m-d', strtotime( ($c + ($l*7)).' days', strtotime($data_inicio)) );
			?>
			<td>
				<?php

					// data atual do loop / exibição calendário:
					$d = date('Y-m-d', strtotime($d));
					echo "<strong>". date('d/m', strtotime($d)) ."</strong><br>";

					foreach ($calendario as $item) {

						$dt_con_inicio = date('Y-m-d', strtotime($item['con_inicio']));

						$dh_con_inicio = date('Y-m-d H:i', strtotime($item['con_inicio']));
						$dh_con_fim =    date('Y-m-d H:i', strtotime($item['con_fim']));

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
								echo "<p><a class='text-".$situacao_cor."' href=".BASE_URL."consultas/detalhe/".$id." title='Ver detalhes da consulta'>".$situacao_icone." ".$hr_con_inicio." ".
									 $paciente."<br>".
									 "<small><strong>".$medico."</strong></small></a></p>";
							} else {
								echo "<p><a class='text-".$situacao_cor."' href=".BASE_URL."consultas/detalhe/".$id." title='Ver detalhes da consulta'>".$hr_con_inicio."-".$hr_con_fim."<br>".
									 "<small>".$situacao_icone." ".$medico."</small></a></p>";
							}
						}
					}
				?>
			</td>
			<?php endfor; ?>
		</tr>
	<?php endfor; ?>
	</tbody>
</table>
</div><!-- table-responsive -->