<h2><?php echo $mes_extenso; ?></h2>

<div class="mt-3 mb-3">
	<a class="btn btn-secondary btn-sm" href="?mes=<?php echo date("Y-m", strtotime($data. 'last month')); ?>">Mês anterior</a>
	<a class="btn btn-secondary btn-sm text-right" href="?mes=<?php echo date("Y-m", strtotime($data. 'next month')); ?>">Próximo mês</a>
</div>

<div class="table-responsive">
<table id="calendario_completo" class="table table-sm">
	<tr>
		<th>Domingo</th>
		<th>Segunda</th>
		<th>Terça</th>
		<th>Quarta</th>
		<th>Quinta</th>
		<th>Sexta</th>
		<th>Sábado</th>
	</tr>

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

						$paciente = $item['nome'];
						$medico =   $item['med_nome'];

						if( $d == $dt_con_inicio || ($d >= $dh_con_inicio) && ($d <= $dh_con_fim) ) {
							if($situacao != '0'){
								echo "<p>".$hr_con_inicio."-".$hr_con_fim."<br>".
									 $paciente."<br>".
									 "<small>".$medico."</small></p>";
							} else {
								echo "<p class='text-danger'>".$hr_con_inicio."-".$hr_con_fim."<br>".
									 $medico." indisponível</p>";
							}
						}
					}
				?>
			</td>
			<?php endfor; ?>
		</tr>
	<?php endfor; ?>
</table>
</div><!-- table-responsive -->