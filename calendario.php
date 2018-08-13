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

	<?php for($l=0; $l<$linhas; $l++): ?>
		<tr>
			<?php for($c=0; $c<7; $c++): ?>
				<?php
					$d = date('Y-m-d', strtotime( ($c + ($l*7)).' days', strtotime($data_inicio)) );
				?>
				<td><?php
						// data atual do loop / exibição calendário:
						
						$d = date('Y-m-d', strtotime($d));
						echo "<strong>".$d."</strong><br>";

						foreach ($calendario as $item) {

							$dh_con_inicio = date('Y-m-d', strtotime($item['con_inicio']));

							if( $d == $dh_con_inicio) {
								echo date('H:i', strtotime($item['con_inicio']))."-". date('H:i', strtotime($item['con_fim'])) ."<br>".
									 "id: ".$item['id']." | ".
									 "med: ".$item['id_med']." | ".
									 "pac: ".$item['id_pac']."<br><br>";
							}

						}
					?>
				</td>
			<?php endfor; ?>
		</tr>
	<?php endfor; ?>
</table>
