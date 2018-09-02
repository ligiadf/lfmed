<?php

class usuariosController extends controller {

	public function index() {

		$usuarios = new Usuarios();

		$dados = array(
			// vai para view
			'usuarios' => $usuarios->listarUsuarios(),
			'quantidade' => $usuarios->totalUsuarios()
		);

		$this->loadTemplate('usuario-listar', $dados);
	}

	# URL: /usuarios/adicionar
	public function adicionar() {

		$usuarios = new Usuarios();
		$verificacao = new Usuarios();

		$nome_usuario = '';
		$email = '';
		$senha = '';
		$perfil = '';
		$especialidade = '';
		$crm = '';
		$status = '';

		$msgAdicionarUsuarioOK = '';
		$msgAdicionarUsuarioNOTOK = '';

		if( !empty($_POST['nomeUsuario']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['perfil']) ) {
			$nome_usuario = addslashes($_POST['nomeUsuario']);
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			$perfil = addslashes($_POST['perfil']);
			$status = addslashes($_POST['statusUsuario']);
			$especialidade = addslashes($_POST['especialidade']);
			$crm = addslashes($_POST['crm']);

			if($verificacao->verificarUsuario($email)) {
				$usuarios->adicionarUsuario($nome_usuario, $email, $senha, $perfil, $status, $especialidade, $crm);
				$msgAdicionarUsuarioOK = "Usuário cadastrado com sucesso: ".$nome_usuario;
				header('Location:'. BASE_URL.'usuarios/adicionar?msgOK='.urlencode($msgAdicionarUsuarioOK));
			} else {
				$msgAdicionarUsuarioNOTOK = "Usuário não foi cadastrado: e-mail ".$email." já existe";
				header('Location:'. BASE_URL.'usuarios/adicionar?msgError='.urlencode($msgAdicionarUsuarioNOTOK));
			}

		}

		$dados = array(
			'nome_usuario' => $nome_usuario,
			'email' => $email,
			'senha' => $senha,
			'perfil' => $perfil,
			'especialidade' => $especialidade,
			'crm' => $crm,
			'status' => $status,
			'msgAdicionarUsuarioOK' => $msgAdicionarUsuarioOK,
			'msgAdicionarUsuarioNOTOK' => $msgAdicionarUsuarioNOTOK
		);

		$this->loadTemplate('usuario-adicionar', $dados);

	}

	# URL: /usuarios/ficha/[id]
	public function ficha($id) {

		$usuarios = new Usuarios();
		$consultas = new Consultas();

		$ficha = $usuarios->fichaUsuario($id);
		$consultaMed = $consultas->listarConsultasMedico($id);

		$dados = array(
			// vai para view
			'ficha' => $ficha,
			'consulta' => $consultaMed,
			'id'=> $id,
			'nome' => $ficha['nome'],
			'email' => $ficha['email'],
			'perfil' => $ficha['perfil'],
			'status' => $ficha['status'],
			'especialidade' => $ficha['especialidade'],
			'crm' => $ficha['crm']
		);

		$this->loadTemplate('usuario-ficha', $dados);
	}

	# URL: /usuarios/editar/[id]
	public function editar($id) {

		$usuarios = new Usuarios();
		$verificacao = new Usuarios();

		$info = $usuarios->fichaUsuario($id);

		if( !empty($_POST['nomeUsuario']) && !empty($_POST['email']) && !empty($_POST['perfil']) ) {
			$nome_usuario = addslashes($_POST['nomeUsuario']);
			$email = addslashes($_POST['email']);
			$perfil = addslashes($_POST['perfil']);
			$status = addslashes($_POST['status']);
			$especialidade = addslashes($_POST['especialidade']);
			$crm = addslashes($_POST['crm']);

			$usuarios->editarUsuario($id, $nome_usuario, $perfil, $email, $status, $especialidade, $crm);
			$msgAdicionarUsuarioOK = "Usuário editado com sucesso: ".$nome_usuario;
			header('Location:'. BASE_URL.'usuarios/ficha/'.$id.'?msgOK='.urlencode($msgAdicionarUsuarioOK));

		}
		$dados = array(
			// vai para view
			'info' => $info
		);

		$this->loadTemplate('usuario-editar', $dados);

	}

}

?>