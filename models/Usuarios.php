<?php

class Usuarios extends Model {

	private $id;
	private $email;
	private $senha;
	private $nome;
	private $perfil;
	private $status;
	protected $pdo;
/*
	public function __construct($i='') {

		global $pdo;
		$this->pdo = $pdo;

		if(!empty($i)) {
			$sql = "SELECT * FROM usuarios WHERE id = ?";
			$sql = $this->pdo->prepare($sql);
			$sql->execute( array($i) );

			if($sql->rowCount() > 0) {
				$user = $sql->fetch();
				$this->id     = $user['id'];
				$this->email  = $user['email'];
				$this->senha  = $user['senha'];
				$this->nome   = $user['nome'];
				$this->perfil = $user['perfil'];
				$this->status = $user['status'];
			}
		}

	}
*/

	public function totalUsuarios() {
		$sql = "SELECT COUNT(*) as c FROM usuarios";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['c'];

		} else {
			return 0;
		}
	}

	public function listarUsuarios() {

		$array = array();

		$sql = "SELECT * FROM usuarios ORDER BY status DESC, perfil ASC, nome ASC";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		// else echo "Não há usuários";

		return $array;

	}

	public function adicionarUsuario($nome_usuario, $email, $senha, $perfil, $status, $especialidade='', $crm='') {
		$sql = "INSERT INTO usuarios (nome, perfil, senha, email, status, especialidade, crm) VALUES (:nome, :perfil, :senha, :email, :status, :especialidade, :crm)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":nome", $nome_usuario);
		$sql->bindValue(":perfil", $perfil);
		$sql->bindValue(":senha", $senha);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":status", $status);
		$sql->bindValue(":especialidade", $especialidade);
		$sql->bindValue(":crm", $crm);
		$sql->execute();
	}

	public function verificarUsuario($email) {
		$sql = "SELECT * FROM usuarios
				WHERE
				email = :email";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return false; // email já existe
		} 
		else {
			return true;
		}
	}

	public function fichaUsuario($id) {

		$array = array();

		$sql = "SELECT * FROM usuarios
				WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;

	}

	public function editarUsuario($id, $nome_usuario, $perfil, $email, $status, $especialidade, $crm) {
		$sql = "UPDATE usuarios SET nome = :nome, perfil = :perfil, email = :email, status = :status, especialidade = :especialidade, crm = :crm WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":nome", $nome_usuario);
		$sql->bindValue(":perfil", $perfil);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":status", $status);
		$sql->bindValue(":especialidade", $especialidade);
		$sql->bindValue(":crm", $crm);
		$sql->execute();
	}

}

class Recepcionista extends Usuarios {

}

?>