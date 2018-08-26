<?php

class Medicos extends Usuarios {
	private $especialidade;
	private $crm;

	/*
	* Especialidade
	*/
	public function setEspecialidade($especialidade) {
		$this->especialidade = $especialidade;
	}

	public function getEspecialidade() {
		return $this->especialidade;
	}

	/*
	* CRM
	*/
	public function setCRM($crm) {
		$this->crm = $crm;
	}

	public function getCRM() {
		return $this->crm;
	}

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

	public function listarMedicosAtivos() {

		$array = array();

		$sql = "SELECT * FROM usuarios WHERE perfil = 'MED' and status = '1'";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há médicos";

		return $array;

	}

	public function totalMedicos() {
		$sql = "SELECT COUNT(*) as c FROM usuarios WHERE perfil = 'MED'";
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