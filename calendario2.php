<h2><?php echo $data; ?></h2>

<table  class="table table-responsive">
	<tr>
		<th>Dom</th>
		<th>Seg</th>
		<th>Terça</th>
		<th>Quarta</th>
		<th>Quinta</th>
		<th>Sexta</th>
		<th>Sábado</th>
	</tr>

<?php $calendario = $consultas->calendarioConsultas($data, $data_inicio, $data_fim); ?>

	<?php for($l=0; $l<$linhas; $l++): ?>
		<tr>
			<?php for($c=0; $c<7; $c++): ?>
				<?php
					$d = date('Y-m-d', strtotime( ($c + ($l*7)).' days', strtotime($data_inicio) ));
				?>

				<td><?php
						// data atual do loop / exibição calendário:
						echo $d."[d]<br>";
						foreach ($calendario as $item) {
							//$dt_inicio = strtotime($item['con_inicio'].'08:00');
							//$dt_fim = strtotime($item['con_fim'].'18:00');
							$dt_inicio = date('Y-m-d', strtotime($item['con_inicio']));
							$dt_fim = date('Y-m-d', strtotime($item['con_fim']));

							$hora_consulta = date('H:i', strtotime($item['con_inicio']));

							$paciente = $item['id_pac'];
							$d = strtotime($d);

							if( $d >= $dt_inicio && $d <= $dt_fim) {
								echo 'oi'.$hora_consulta." -- ".$paciente."<br>";
							}
						}
					?>
				</td>
			<?php endfor; ?>
		</tr>
	<?php endfor; ?>
</table>
