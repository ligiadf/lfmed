<?php

class Usuarios extends model {

	private $id;
	private $email;
	private $senha;
	private $nome;
	private $perfil;
	private $status;
	protected $pdo;

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

	/*
	* Id
	*/
	public function getId() {
		return $this->id;
	}

	/*
	* E-mail
	*/
	public function setEmail($email) {
		$this->email = $email;
	}

	public function getEmail() {
		return $this->email;
	}

	/*
	* Senha
	*/
	public function setSenha($senha) {
		$this->senha = md5($senha);
	}

	/*
	* Nome
	*/
	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

	/*
	* Perfil
	*/
	public function setPerfil($perfil) {
		$this->perfil = $perfil;
	}

	public function getPerfil() {
		return $this->perfil;
	}

	/*
	* Status
	*/
	public function setStatus($status) {
		$this->status = $status;
	}

	public function getStatus() {
		return $this->status;
	}

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

		$sql = "SELECT * FROM usuarios ORDER BY status DESC";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há usuários";

		return $array;

	}

	/*
	* Salvar usuário: adicionar novo ou editar existente.
	*/
	public function salvarUsuario() {

		if(!empty($this->id)) {
			// editando usuario
			$sql = "UPDATE usuarios SET
				email = ?,
				senha = ?,
				nome = ?,
				perfil = ?,
				status = ?
				WHERE
				id = ?";
			$sql = $this->pdo->prepare($sql);
			$sql->execute(array(
				$this->email,
				$this->senha,
				$this->nome,
				$this->perfil,
				$this->status,
				$this->id));
		} else {
			// adicionando novo usuario
			$sql = "INSERT INTO usuarios SET
				email = ?,
				senha = ?,
				nome = ?,
				perfil = ?,
				status = ?";
			$sql = $this->pdo->prepare($sql);
			$sql->execute(array(
				$this->email,
				$this->senha,
				$this->nome,
				$this->perfil,
				$this->status));
			}
	}

	public function deletarUsuario() {
		$sql = "DELETE from usuarios WHERE id = ?";
		$sql = $this->pdo->prepare($sql);
		$sql->execute(array($this->id));
	}
}

class Recepcionista extends Usuarios {

}

?>