<?php

// dados de conexao
$dbname = "nome_db";
$dbuser = "usuario_db";
$dbpass = "senha_db";

global $pdo;

// contecta ao db
try {
	$pdo = new PDO("mysql:dbname=".$dbname.";host=localhost;charset=utf8", $dbuser, $dbpass);
} catch(PDOException $e) {
	echo "Erro de conexão: ".$e->getMessage()." (".$e->getCode().")";
	exit;
}

?>