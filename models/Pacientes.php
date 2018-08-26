<?php

class Pacientes extends Model {

	private $id;
	private $nome;
	private $data_nasc;
	private $email;
	private $telefone;
	private $cpf;
	private $plano_saude;

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

	public function cadastrarPaciente($nome_paciente, $data_nasc, $email, $telefone, $cpf, $plano_saude) {
		$sql = "INSERT INTO pacientes (nome, data_nasc, email, telefone, cpf, plano_saude) VALUES (:nome, :data_nasc, :email, :telefone, :cpf, :plano_saude)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":nome", $nome_paciente);
		$sql->bindValue(":data_nasc", $data_nasc);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":telefone", $telefone);
		$sql->bindValue(":cpf", $cpf);
		$sql->bindValue(":plano_saude", $plano_saude);
		$sql->execute();
	}

	public function verificarPaciente($cpf) {
		$sql = "SELECT * FROM pacientes
				WHERE
				cpf = :cpf";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":cpf", $cpf);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return false; // cpf já existe
		} 
		else {
			return true;
		}
	}

}
?>
