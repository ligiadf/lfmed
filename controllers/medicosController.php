<?php

class medicosController extends Controller {

	public function index() {

		$usuarios = new Usuarios();
		$medicos = new Medicos();

	// paginação
		$offset = 0;
		$limite = 10;

		$dados['quantidade'] = $medicos->totalMedicos();
		$quantidade = $dados['quantidade'];

		$dados['paginas'] = ceil($quantidade/$limite);

		$dados['pagina_atual'] = 1;
		
		if(!empty($_GET['p'])) {
			$dados['pagina_atual'] = intval($_GET['p']);
		}
		$offset = ($dados['pagina_atual'] * $limite) - $limite;

		$dados['medicos'] = $medicos->listarMedicosAtivos($offset, $limite);

		$dados['titulo_pagina'] = 'Médicos(as)';

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'M01') !== false ) {
			$this->loadTemplate('medico-listar', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

}

?>