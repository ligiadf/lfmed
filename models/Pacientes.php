<?php

class Pacientes extends Model {

	private $id;
	private $nome;
	private $data_nasc;
	private $email;
	private $telefone;
	private $cpf;
	private $plano_saude;

	public function listarPacientes($offset, $limite, $pc) {

		$array = array();

		if(empty($_GET['pc'])) { $pc = ''; }
			else { $pc = $_GET['pc']; }

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');

		if(!empty($pc)){
			$filtroString[] = 'nome LIKE :pc OR cpf LIKE :pc';
		}

		$sql = "SELECT *
				FROM pacientes
				WHERE ".implode(' AND ', $filtroString)."
				ORDER BY nome
				LIMIT $offset, $limite";
		if(empty($pc)){
			$sql = $this->pdo->query($sql);
		}

		if(!empty($pc)) {
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":pc", '%'.$pc.'%');
			$sql->execute();
		}

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;

	}

	public function totalPacientes() {

		if(empty($_GET['pc'])) { $pc = ''; }
			else { $pc = $_GET['pc']; }

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');

		if(!empty($pc)){
			$filtroString[] = 'nome LIKE :pc OR cpf LIKE :pc';
		}

		$sql = "SELECT COUNT(*) as c
				FROM pacientes
				WHERE ".implode(' AND ', $filtroString)."";
		if(empty($pc)){
			$sql = $this->pdo->query($sql);
		}

		if(!empty($pc)) {
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":pc", '%'.$pc.'%');
			$sql->execute();
		}

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
				WHERE cpf = :cpf";
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

	public function fichaPaciente($id) {

		$array = array();

		$sql = "SELECT * FROM pacientes
				WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;

	}

	public function editarPaciente($id, $nome_paciente, $data_nasc, $email, $telefone, $cpf, $plano_saude) {
		$sql = "UPDATE pacientes SET nome = :nome, data_nasc = :data_nasc, email = :email, telefone = :telefone, cpf = :cpf, plano_saude = :plano_saude WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":nome", $nome_paciente);
		$sql->bindValue(":data_nasc", $data_nasc);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":telefone", $telefone);
		$sql->bindValue(":cpf", $cpf);
		$sql->bindValue(":plano_saude", $plano_saude);
		$sql->execute();
	}

}
?>
