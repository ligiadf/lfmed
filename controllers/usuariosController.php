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
			// vai para view
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