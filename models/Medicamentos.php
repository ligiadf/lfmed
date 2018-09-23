<?php

class Medicamentos extends Model {

	private $id;
	private $principio_ativo;
	private $nome_comercial;
	private $apresentacao;
	private $fabricante;

	public function listarMedicamentos($offset, $limite, $rem) {

		$array = array();

		if(empty($_GET['rem'])) { $rem = ''; }
			else { $rem = $_GET['rem']; }

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');

		if(!empty($rem)){
			$filtroString[] = 'principio_ativo LIKE :rem OR nome_comercial LIKE :rem';
		}

		$sql = "SELECT *
				FROM medicamentos
				WHERE ".implode(' AND ', $filtroString)."
				ORDER BY principio_ativo
				LIMIT $offset, $limite";
		if(empty($rem)){
			$sql = $this->pdo->query($sql);
		}

		if(!empty($rem)) {
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":rem", '%'.$rem.'%');
			$sql->execute();
		}

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		} else {
			return false;
		}

		return $array;

	}

	public function totalMedicamentos() {

		$array = array();

		if(empty($_GET['rem'])) { $rem = ''; }
			else { $rem = $_GET['rem']; }

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');

		if(!empty($rem)){
			$filtroString[] = 'principio_ativo LIKE :rem OR nome_comercial LIKE :rem';
		}

		$sql = "SELECT COUNT(*) as c
				FROM medicamentos
				WHERE ".implode(' AND ', $filtroString)."";

		if(empty($rem)){
			$sql = $this->pdo->query($sql);
		}

		if(!empty($rem)) {
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":rem", '%'.$rem.'%');
			$sql->execute();
		}

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['c'];

		} else {
			return 0;
		}
	}

	public function prescricoesMedicamentos($id) {
		$array = array();

		$sql = "SELECT medicamentos.nome_comercial, medicamentos.fabricante, medicamentos.principio_ativo, medicamentos.apresentacao, prescricoes.id as id_presc, consultas.id as con_id, prescricoes.id_rem, prescricoes.posologia
				FROM prescricoes
				LEFT JOIN consultas ON consultas.id = prescricoes.id_con
				LEFT JOIN medicamentos ON medicamentos.id = prescricoes.id_rem
				WHERE id_con = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function adicionarReceita($id, $id_rem, $posologia) {
		$sql = "INSERT INTO prescricoes (id_con, id_rem, posologia)
				VALUES (:id, :id_rem, :posologia)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_rem", $id_rem);
		$sql->bindValue(":posologia", $posologia);

		$sql->execute();
	}

	public function deletarReceita($id_presc) {
		$sql = "DELETE FROM prescricoes
				WHERE id = :id_presc";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_presc", $id_presc);
		$sql->execute();
	}

}

?>