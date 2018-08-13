<?php
	require 'config.php';
	include_once 'header.php';
?>



<h2>Consultas</h2>

<p><a href="marcar.php">Marcar consulta</a></p>

<form method="GET">
	<div class="form-row">
		<div class="col-2">
	
			<select class="form-control" name="ano" id="ano">
				<?php for($ano = date('Y'); $ano > 2015; $ano--): ?>
					<option <?php if($ano == date('Y')) { echo "selected"; } ?> ><?php echo $ano ?></option>
				<?php endfor; ?>
			</select>
		</div>
		<div class="col-2">
			<select class="form-control" name="mes" id="mes">
				<option selected>01</option>
				<option>02</option>
				<option>03</option>
				<option>04</option>
				<option>05</option>
				<option>06</option>
				<option>07</option>
				<option>08</option>
				<option>09</option>
				<option>10</option>
				<option>11</option>
				<option>12</option>
			</select>
		</div>
		<div class="col-2">
			<button type="submit" class="btn btn-success">Ir</button>
		</div>
	</div>
</form>

<?php

// TODO: validação
$data = $_GET['ano'].'-'.$_GET['mes'];

// dia da semana do primeiro dia do mês
$dia1 = date('w', strtotime($data));

// quantos dias tem o mês
$dias = date('t', strtotime($data));

// número de linhas, arredondando para cima
$linhas = ceil(($dia1 + $dias) / 7);

// data de início do calendário: saber dias antes e depois do mês atual
// diminui do primeiro dia do mês o número de dias que tem antes, que é igual ao número do dia da semana
// domingo é 0 e fica na primeira coluna
$data_inicio = date('Y-m-d', strtotime(- $dia1.' days', strtotime($data)));

// data do final do calendário: primeiro dia + número de linhas x 7; menos 1 para contar o primeiro dia
$data_fim = date('Y-m-d', strtotime( (- $dia1 + ($linhas*7) - 1 ).' days', strtotime($data)));

	switch ($dia1) {
		case 0:
			$dia1 = "Domingo";
			break;
		case 1:
			$dia1 = "Segunda";
			break;
		case 2:
			$dia1 = "Terça";
			break;
		case 3:
			$dia1 = "Quarta";
			break;
		case 4:
			$dia1 = "Quinta";
			break;
		case 5:
			$dia1 = "Sexta";
			break;
		case 6:
			$dia1 = "Sábado";
			break;
	}

/*
* DEBUG:
echo "Mês: ".$data."<br>";
echo "Primeiro dia: ".$dia1."<br>";
echo "Total de dias: ".$dias."<br>";
echo "Linhas: ".$linhas."<br>";
echo "Início do calendário (domingo): ".$data_inicio."<br>";
echo "Final do calendário (sábado): ".$data_fim."<br>";
*/


?>

<!--

<h2>Lista consultas [oculto]</h2>
<?php
/*
$lista = $consultas->listaConsultas();

foreach ($lista as $consulta) {
	$dt_inicio = date('d/m/Y H:i', strtotime($consulta['con_inicio']));
	$dt_fim = date('d/m/Y H:i', strtotime($consulta['con_fim']));

	echo 'Paciente '. $consulta['id_pac']. ' consulta com médico '.$consulta['id_med']. ' entre '.$dt_inicio.' e '.$dt_fim.'<br>';
}
*/
?>

<hr>
-->
<?php $calendario = $consultas->calendarioConsultas($data_inicio, $data_fim); ?>

<?php require 'calendario.php'; ?>


<hr>
<?php


echo "data: ".$data."<br>";
echo "data_inicio: ".$data_inicio."<br>";
echo "data_fim: ".$data_fim."<br>";
echo "dh_con_inicio: ".$dh_con_inicio."<br>";
echo "dh_con_fim: ".$dh_con_fim."<br>";

?>

<?php include_once 'footer.php'; ?>