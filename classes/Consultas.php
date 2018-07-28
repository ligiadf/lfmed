<?php

class Consultas {

	// para usar conexao com db
	private $pdo;
	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function listaConsultas() {
		$array = array();

		$sql = "SELECT * FROM consultas";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há consultas";

		return $array;
	}

	public function verificarAgenda($medico, $dtConsulta, $statusConsulta) {
		$sql = "SELECT * FROM consultas
				WHERE id_medico = :medico AND
				()";
		$sql = $this->pdo->query($sql);
		$sql->bindValeu(":medico", $id_medico);
		$sql->bindValeu(":dtConsulta", $dataConsulta);
		$sql->bindValeu(":dtConsulta", $statusConsulta);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return false;	
		} 
		else {
			return true;
		}
	}

}

?>
