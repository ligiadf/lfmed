<?php

class Medicos {

	// para usar conexao com db
	private $pdo;
	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function listaMedicos() {
		$array = array();

			$sql = "SELECT * FROM medicos";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0) {
				$array = $sql->fetchAll();
			}

		return $array;
	}

}

?>