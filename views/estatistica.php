<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo BASE_URL.'consultas/listar'; ?>">Consultas</a></li>
	<li class="breadcrumb-item active">Estatísticas</li>
</ol>

<div class="row justify-content-center">
	<div class="col-md-10">

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
					<?php foreach ($stats1 as $item): ?>
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
					<?php foreach ($stats2 as $item): ?>
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
					<?php foreach ($stats3 as $item): ?>
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
					<?php foreach ($stats4 as $item): ?>
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
			<h1><i class="fas fa-chart-line mr-1"></i> Consultas por médico</h1>
		</header>

		<div class="row">
			<div class="col-12 col-md-3">
				<h3 class="h4 text-center text-dark mb-4"><i class="fas fa-user-md mr-1"></i> <?php echo $statsMed4[0]['medico']; ?></h3>
				<table class="table table-sm text-dark text-center">
					<thead>
						<tr>
							<th scope="row">Ano</th>
							<th scope="row">Mês</th>
							<th scope="row">Situação</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($statsMed4 as $item): ?>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['situacao']; ?></td>
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
							<th scope="row">Situação</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($statsMed5 as $item): ?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['situacao']; ?></td>
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
							<th scope="row">Situação</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($statsMed9 as $item): ?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['situacao']; ?></td>
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
							<th scope="row">Situação</th>
							<th scope="row">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($statsMed10 as $item): ?>
						<tr>
							<td><?php echo $item['ano']; ?></td>
							<td><?php echo $item['mes']; ?></td>
							<td><?php echo $item['situacao']; ?></td>
							<td><?php echo $item['total']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>