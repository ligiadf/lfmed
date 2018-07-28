<?php

require 'classes/Consultas.php';
include 'settings.conf.php';
require 'classes/Medicos.php';

// contecta ao db
try {
	$pdo = new PDO($dsn, $dbuser, $dbpass);
} catch(PDOException $e) {
	echo "Erro de conexão: ".$e->getMessage();
	exit;
}

// conecta classe ao db
$consultas = new Consultas($pdo);
$medicos = new Medicos($pdo);


?>