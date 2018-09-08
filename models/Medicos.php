<?php

class Medicos extends Usuarios {
	private $especialidade;
	private $crm;

	public function listarMedicos() {

		$array = array();

		$sql = "SELECT * FROM usuarios WHERE perfil = 'MED'";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há médicos";

		return $array;

	}

	public function listarMedicosAtivos($offset, $limite) {

		$array = array();

		$sql = "SELECT *
				FROM usuarios
				WHERE perfil = 'MED' AND status = '1'
				ORDER BY nome
				LIMIT $offset, $limite";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há médicos";

		return $array;

	}

	public function totalMedicos() {
		$sql = "SELECT COUNT(*) as c FROM usuarios WHERE perfil = 'MED' AND status = '1'";
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