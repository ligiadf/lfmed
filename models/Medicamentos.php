<?php

class Medicamentos extends Model {

	private $id;
	private $principio_ativo;
	private $nome_comercial;
	private $apresentacao;
	private $fabricante;

	public function listarMedicamentos($offset, $limite) {

		$array = array();

		$sql = "SELECT *
				FROM medicamentos
				ORDER BY principio_ativo
				LIMIT $offset, $limite";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;

	}

	public function totalMedicamentos() {
		$sql = "SELECT COUNT(*) as c FROM medicamentos";
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