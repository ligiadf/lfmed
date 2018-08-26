<?php

class Pacientes extends Model {

	public function listarPacientes() {

		$array = array();

		$sql = "SELECT * FROM pacientes ORDER BY nome";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há pacientes";

		return $array;

	}

	public function totalPacientes() {
		$sql = "SELECT COUNT(*) as c FROM pacientes";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['c'];

		} else {
			return 0;
		}
	}

}
?>