<h5><i class="far fa-calendar-alt mr-1"></i> <?php echo $con_data; ?> <i class="far fa-clock ml-5 mr-1"></i> <?php echo $con_hora; ?></h5>

<?php
	switch ($con_status) {
		case "1":
			$situacao = "<p class='text-info'><i class='far fa-calendar-check mr-1'></i>Marcada</p>";
			break;
		case "2":
			$situacao = "<p class='text-success'><i class='fas fa-check mr-1'></i> Realizada</p>";
			break;
		case "3":
			$situacao = "<p class='text-secondary'><i class='far fa-user mr-1'></i> Ausente</p>";
			break;
		case "4":
			$situacao = "<p class='text-secondary'><i class='far fa-calendar-times mr-1'></i> Cancelada</p>";
			break;
	}
	if(isset($situacao)) { echo $situacao; }
?>

<h4 class="mt-4">
	<i class="fas fa-user mr-1"></i> <a href="<?php echo BASE_URL ?>pacientes/ficha/<?php echo $pac_id; ?>" title="Ver ficha do paciente"><?php echo $pac_nome; ?></a>
	<small class="text-secondary">(CPF: <?php echo $detalhe['cpf']; ?>)</small>
</h4>

<h5 class="mt-4 mb-4">
	<i class="fas fa-user-md mr-1"></i> <a href="<?php echo BASE_URL ?>usuarios/ficha/<?php echo $med_id; ?>" title="Ver ficha do médico"><?php echo $med_nome; ?></a>
	<span class="d-sm-none"><br></span>
	<small class="h6">
	<?php
		if($especialidade == 'Oftalmologista') { echo '<i class="far fa-eye ml-3 mr-0"></i> Oftalmologista'; }
			else { echo '<i class="fas fa-deaf ml-3 mr-0"></i> Otorrinolaringologista'; }
	?>
	</small>
</h5>
