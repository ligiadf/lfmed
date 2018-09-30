<?php

class Exames extends Model {

	private $id;
	private $principio_ativo;
	private $nome_comercial;
	private $apresentacao;
	private $fabricante;

	public function listarExames($offset, $limite, $ex) {

		$array = array();

		if(empty($_GET['ex'])) { $ex = ''; }
			else { $ex = $_GET['ex']; }

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');

		if(!empty($ex)){
			$filtroString[] = 'nome LIKE :ex';
		}

		$sql = "SELECT *
				FROM exames
				WHERE ".implode(' AND ', $filtroString)."
				ORDER BY nome
				LIMIT $offset, $limite";
		if(empty($ex)){
			$sql = $this->pdo->query($sql);
		}

		if(!empty($ex)) {
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":ex", '%'.$ex.'%');
			$sql->execute();
		}

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		} else {
			return false;
		}

		return $array;

	}

	public function totalExames() {

		$array = array();

		if(empty($_GET['ex'])) { $ex = ''; }
			else { $ex = $_GET['ex']; }

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');

		if(!empty($ex)){
			$filtroString[] = 'nome LIKE :ex';
		}

		$sql = "SELECT COUNT(*) as c
				FROM exames
				WHERE ".implode(' AND ', $filtroString)."";

		if(empty($ex)){
			$sql = $this->pdo->query($sql);
		}

		if(!empty($ex)) {
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":ex", '%'.$ex.'%');
			$sql->execute();
		}

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['c'];

		} else {
			return 0;
		}
	}

	public function requisicoesExames($id) {
		$array = array();

		$sql = "SELECT exames.nome, requisicoes.id as id_req, consultas.id as con_id, requisicoes.id_exa, requisicoes.observacao, requisicoes.cid, requisicoes.resultado
				FROM requisicoes
				LEFT JOIN consultas ON consultas.id = requisicoes.id_con
				LEFT JOIN exames ON exames.id = requisicoes.id_exa
				WHERE id_con = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function requisicaoExameUnico($id_req) {
		$array = array();

		$sql = "SELECT exames.nome, requisicoes.id as id_req, consultas.id as con_id, consultas.con_inicio, requisicoes.id_exa, requisicoes.observacao, requisicoes.cid, requisicoes.resultado
				FROM requisicoes
				LEFT JOIN consultas ON consultas.id = requisicoes.id_con
				LEFT JOIN exames ON exames.id = requisicoes.id_exa
				WHERE requisicoes.id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id_req);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function adicionarExame($id, $id_pac, $id_exa, $observacao='', $cid='') {
		$sql = "INSERT INTO requisicoes (id_con, id_pac, id_exa, observacao, cid)
				VALUES (:id_con, :id_pac, :id_exa, :observacao, :cid)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_con", $id);
		$sql->bindValue(":id_pac", $id_pac);
		$sql->bindValue(":id_exa", $id_exa);
		$sql->bindValue(":observacao", $observacao);
		$sql->bindValue(":cid", $cid);

		$sql->execute();
	}

	public function deletarExame($id_req) {
		$sql = "DELETE FROM requisicoes
				WHERE id = :id_req";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_req", $id_req);
		$sql->execute();
	}

	public function listarExamesPaciente($pac_id) {
		$array = array();

		$sql = "SELECT consultas.con_inicio, pacientes.nome as pac_nome, pacientes.id as pac_id, requisicoes.id_con, consultas.id as id, exames.nome as nome_exame, requisicoes.id_exa as id_exame, requisicoes.id as id_requisicao, requisicoes.observacao, requisicoes.cid, requisicoes.resultado
				FROM requisicoes
				LEFT JOIN consultas ON consultas.id = requisicoes.id_con
				LEFT JOIN exames ON exames.id = requisicoes.id_exa
				LEFT JOIN pacientes ON pacientes.id = requisicoes.id_pac
				WHERE requisicoes.id_pac = :id
				ORDER BY con_inicio DESC, requisicoes.id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $pac_id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function deletarResultadoExame($id_req) {
		$sql = "UPDATE requisicoes
				SET resultado = NULL
				WHERE id = :id_req";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_req", $id_req);
		$sql->execute();
	}

	public function adicionarResultadoExame($id_req, $nome_arquivo) {
		$sql = "UPDATE requisicoes
				SET resultado = :nome_arquivo
				WHERE id = :id_req";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_req", $id_req);
		$sql->bindValue(":nome_arquivo", $nome_arquivo);
		$sql->execute();
	}

}

?>