<?php
	require 'config.php';
	include_once 'header.php';
?>



<h2>Consultas</h2>

<p><a href="marcar.php">Marcar consulta</a></p>

<?php 

$lista = $consultas->listaConsultas();

foreach ($lista as $consulta) {
	$dt_inicio = date('d/m/Y H:i', strtotime($consulta['con_inicio']));
	$dt_fim = date('d/m/Y H:i', strtotime($consulta['con_fim']));

	echo $consulta['id_pac']. ' consulta com '.$consulta['id_med']. ' entre '.$dt_inicio.' e '.$dt_fim.'<br>';
}

?>

<?php include_once 'footer.php'; ?>