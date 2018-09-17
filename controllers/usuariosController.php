<?php

class usuariosController extends Controller {

	public function index() {

		$usuarios = new Usuarios();

	// paginação
		$offset = 0;
		$limite = 10;

		$dados['quantidade'] = $usuarios->totalUsuarios();
		$quantidade = $dados['quantidade'];

		$dados['paginas'] = ceil($quantidade/$limite);

		$dados['pagina_atual'] = 1;
		
		if(!empty($_GET['p'])) {
			$dados['pagina_atual'] = intval($_GET['p']);
		}
		$offset = ($dados['pagina_atual'] * $limite) - $limite;

		$dados['usuarios'] = $usuarios->listarUsuarios($offset, $limite);

		$dados['titulo_pagina'] = 'Usuários';

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
			$senha = $_POST['senha'];
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
			'titulo_pagina' => 'Adicionar usuário',
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
		$consulta = $consultas->listarConsultasMedico($id);

		switch($ficha['perfil']) {
			case 'ADM':
				$perfilTexto = '<i class="fas fa-user-shield mr-1"></i> Administrador'; break;
			case 'MED':
				$perfilTexto = '<i class="fas fa-user-md mr-1"></i> Médico'; break;
			case 'REC':
				$perfilTexto = '<i class="fas fa-user-clock mr-1"></i> Recepcionista'; break;
			case 'LAB':
				$perfilTexto = '<i class="fas fa-hospital mr-1"></i> Laboratório'; break;
			}

		$dados = array(
			'titulo_pagina' => 'Ficha usuário n. '.$id,
			'ficha' => $ficha,
			'consulta' => $consulta,
			'id'=> $id,
			'nome' => $ficha['nome'],
			'email' => $ficha['email'],
			'perfil' => $ficha['perfil'],
			'perfilTexto' => $perfilTexto,
			'status' => $ficha['status'],
			'especialidade' => $ficha['especialidade'],
			'crm' => $ficha['crm']
		);

		if( !empty($ficha) ) {
			$this->loadTemplate('usuario-ficha', $dados);
		} else {
			$dados404 = array (
				'msg404' => 'Usuário não existe:',
				'msglink404' => 'ver todos os usuários.',
				'link404' => BASE_URL.'usuarios'
			);
			$this->loadTemplate('404', $dados404);
		}

	}

	# URL: /usuarios/editar/[id]
	public function editar($id) {

		$usuarios = new Usuarios();
		$verificacao = new Usuarios();

		$info = $usuarios->fichaUsuario($id);

		if( !empty($_POST['nomeUsuario']) && !empty($_POST['email']) && !empty($_POST['perfil']) ) {
			$email = addslashes($_POST['email']);
			$senha = $_POST['senha'];
			$nome_usuario = addslashes($_POST['nomeUsuario']);
			$perfil = addslashes($_POST['perfil']);
			$status = addslashes($_POST['status']);
			$especialidade = addslashes($_POST['especialidade']);
			$crm = addslashes($_POST['crm']);

			$usuarios->editarUsuario($id, $email, $senha, $nome_usuario, $perfil, $status, $especialidade, $crm);
			$msgAdicionarUsuarioOK = "Usuário editado com sucesso: ".$nome_usuario;
			header('Location:'. BASE_URL.'usuarios/ficha/'.$id.'?msgOK='.urlencode($msgAdicionarUsuarioOK));
		}
		
		$dados = array(
			'titulo_pagina' => 'Editar usuário n. '.$id,
			'info' => $info
		);

		if( !empty($info) ) {
			$this->loadTemplate('usuario-editar', $dados);
		} else {
			$dados404 = array (
				'msg404' => 'Usuário não existe:',
				'msglink404' => 'deseja adicionar um novo?',
				'link404' => BASE_URL.'usuarios/adicionar'
			);
			$this->loadTemplate('404', $dados404);
		}

	}

}

?>