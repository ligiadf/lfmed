<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas'; ?>">Consultas</a></li>
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas/listar'; ?>">Listar consultas</a></li>
	<li class="breadcrumb-item active">Estatísticas</li>
</ol>

<div class="row justify-content-center">
	<div class="col-md-10">

		<header class="mt-4 mb-5">
			<h1><i class="fas fa-chart-line mr-1"></i> Consultas realizadas por médico</h1>
		</header>

		<div class="row">
			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-dark mb-4"><i class="fas fa-user-md mr-1"></i> <?php echo $statsMed4[0]['medico']; ?></h3>
				<table class="table table-sm text-dark text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($statsMed4 as $item): 
							switch ($item['mes']) {
							case '1':  $item['mes'] = 'Jan.'; break;
							case '2':  $item['mes'] = 'Fev.'; break;
							case '3':  $item['mes'] = 'Mar.'; break;
							case '4':  $item['mes'] = 'Abr.'; break;
							case '5':  $item['mes'] = 'Maio'; break;
							case '6':  $item['mes'] = 'Jun.'; break;
							case '7':  $item['mes'] = 'Jul.'; break;
							case '8':  $item['mes'] = 'Ago.'; break;
							case '9':  $item['mes'] = 'Set.'; break;
							case '10': $item['mes'] = 'Out.'; break;
							case '11': $item['mes'] = 'Nov.'; break;
							case '12': $item['mes'] = 'Dez.'; break;
							default:   $item['mes'] = $item['mes']; break;
						}
					?>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-dark mb-4"><i class="fas fa-user-md mr-1"></i> <?php echo $statsMed5[0]['medico']; ?></h3>
				<table class="table table-sm text-dark text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($statsMed5 as $item): 
							switch ($item['mes']) {
							case '1':  $item['mes'] = 'Jan.'; break;
							case '2':  $item['mes'] = 'Fev.'; break;
							case '3':  $item['mes'] = 'Mar.'; break;
							case '4':  $item['mes'] = 'Abr.'; break;
							case '5':  $item['mes'] = 'Maio'; break;
							case '6':  $item['mes'] = 'Jun.'; break;
							case '7':  $item['mes'] = 'Jul.'; break;
							case '8':  $item['mes'] = 'Ago.'; break;
							case '9':  $item['mes'] = 'Set.'; break;
							case '10': $item['mes'] = 'Out.'; break;
							case '11': $item['mes'] = 'Nov.'; break;
							case '12': $item['mes'] = 'Dez.'; break;
							default:   $item['mes'] = $item['mes']; break;
						}
					?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-dark mb-4"><i class="fas fa-user-md mr-1"></i> <?php echo $statsMed9[0]['medico']; ?></h3>
				<table class="table table-sm text-dark text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($statsMed9 as $item): 
							switch ($item['mes']) {
							case '1':  $item['mes'] = 'Jan.'; break;
							case '2':  $item['mes'] = 'Fev.'; break;
							case '3':  $item['mes'] = 'Mar.'; break;
							case '4':  $item['mes'] = 'Abr.'; break;
							case '5':  $item['mes'] = 'Maio'; break;
							case '6':  $item['mes'] = 'Jun.'; break;
							case '7':  $item['mes'] = 'Jul.'; break;
							case '8':  $item['mes'] = 'Ago.'; break;
							case '9':  $item['mes'] = 'Set.'; break;
							case '10': $item['mes'] = 'Out.'; break;
							case '11': $item['mes'] = 'Nov.'; break;
							case '12': $item['mes'] = 'Dez.'; break;
							default:   $item['mes'] = $item['mes']; break;
						}
					?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-dark mb-4"><i class="fas fa-user-md mr-1"></i> <?php echo $statsMed10[0]['medico']; ?></h3>
				<table class="table table-sm text-dark text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($statsMed10 as $item): 
							switch ($item['mes']) {
							case '1':  $item['mes'] = 'Jan.'; break;
							case '2':  $item['mes'] = 'Fev.'; break;
							case '3':  $item['mes'] = 'Mar.'; break;
							case '4':  $item['mes'] = 'Abr.'; break;
							case '5':  $item['mes'] = 'Maio'; break;
							case '6':  $item['mes'] = 'Jun.'; break;
							case '7':  $item['mes'] = 'Jul.'; break;
							case '8':  $item['mes'] = 'Ago.'; break;
							case '9':  $item['mes'] = 'Set.'; break;
							case '10': $item['mes'] = 'Out.'; break;
							case '11': $item['mes'] = 'Nov.'; break;
							case '12': $item['mes'] = 'Dez.'; break;
							default:   $item['mes'] = $item['mes']; break;
						}
					?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<header class="mt-4 mb-5">
			<h1><i class="fas fa-chart-line mr-1"></i> Todas as consultas</h1>
		</header>

		<div class="row">
			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-info mb-4"><i class="far fa-calendar-check mr-1"></i> Consultas marcadas</h3>
				<table class="table text-info text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($stats1 as $item): 
						switch ($item['mes']) {
							case '1':  $item['mes'] = 'Jan.'; break;
							case '2':  $item['mes'] = 'Fev.'; break;
							case '3':  $item['mes'] = 'Mar.'; break;
							case '4':  $item['mes'] = 'Abr.'; break;
							case '5':  $item['mes'] = 'Maio'; break;
							case '6':  $item['mes'] = 'Jun.'; break;
							case '7':  $item['mes'] = 'Jul.'; break;
							case '8':  $item['mes'] = 'Ago.'; break;
							case '9':  $item['mes'] = 'Set.'; break;
							case '10': $item['mes'] = 'Out.'; break;
							case '11': $item['mes'] = 'Nov.'; break;
							case '12': $item['mes'] = 'Dez.'; break;
							default:   $item['mes'] = $item['mes']; break;
						}
					?>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-success mb-4"><i class="fas fa-check mr-1"></i> Consultas realizadas</h3>
				<table class="table text-success text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($stats2 as $item): 
						switch ($item['mes']) {
							case '1':  $item['mes'] = 'Jan.'; break;
							case '2':  $item['mes'] = 'Fev.'; break;
							case '3':  $item['mes'] = 'Mar.'; break;
							case '4':  $item['mes'] = 'Abr.'; break;
							case '5':  $item['mes'] = 'Maio'; break;
							case '6':  $item['mes'] = 'Jun.'; break;
							case '7':  $item['mes'] = 'Jul.'; break;
							case '8':  $item['mes'] = 'Ago.'; break;
							case '9':  $item['mes'] = 'Set.'; break;
							case '10': $item['mes'] = 'Out.'; break;
							case '11': $item['mes'] = 'Nov.'; break;
							case '12': $item['mes'] = 'Dez.'; break;
							default:   $item['mes'] = $item['mes']; break;
						}
					?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-secondary mb-4"><i class="far fa-calendar-times mr-1"></i> Consultas canceladas</h3>
				<table class="table text-secondary text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($stats3 as $item):
							switch ($item['mes']) {
							case '1':  $item['mes'] = 'Jan.'; break;
							case '2':  $item['mes'] = 'Fev.'; break;
							case '3':  $item['mes'] = 'Mar.'; break;
							case '4':  $item['mes'] = 'Abr.'; break;
							case '5':  $item['mes'] = 'Maio'; break;
							case '6':  $item['mes'] = 'Jun.'; break;
							case '7':  $item['mes'] = 'Jul.'; break;
							case '8':  $item['mes'] = 'Ago.'; break;
							case '9':  $item['mes'] = 'Set.'; break;
							case '10': $item['mes'] = 'Out.'; break;
							case '11': $item['mes'] = 'Nov.'; break;
							case '12': $item['mes'] = 'Dez.'; break;
							default:   $item['mes'] = $item['mes']; break;
						}
					?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-secondary mb-4"><i class="far fa-user mr-1"></i> Consultas paciente ausente</h3>
				<table class="table text-secondary text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($stats4 as $item):
							switch ($item['mes']) {
							case '1':  $item['mes'] = 'Jan.'; break;
							case '2':  $item['mes'] = 'Fev.'; break;
							case '3':  $item['mes'] = 'Mar.'; break;
							case '4':  $item['mes'] = 'Abr.'; break;
							case '5':  $item['mes'] = 'Maio'; break;
							case '6':  $item['mes'] = 'Jun.'; break;
							case '7':  $item['mes'] = 'Jul.'; break;
							case '8':  $item['mes'] = 'Ago.'; break;
							case '9':  $item['mes'] = 'Set.'; break;
							case '10': $item['mes'] = 'Out.'; break;
							case '11': $item['mes'] = 'Nov.'; break;
							case '12': $item['mes'] = 'Dez.'; break;
							default:   $item['mes'] = $item['mes']; break;
						}
					?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>