<?php
// Controlador da página inicial
class homeController extends Controller {

	public function index() {

		$usuarios = new Usuarios();

		$dados = array(
			'titulo_pagina' => 'Página inicial'
		);

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		if( strpos($_SESSION['uLogin']['permissoes'], 'H01') !== false ) {
			$this->loadTemplate('home', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}



}