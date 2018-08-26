<?php

class usuariosController extends controller {

	public function index() {

		$usuarios = new Usuarios();

		$dados = array(
			// vai para view
			'usuarios' => $usuarios->listarUsuarios(),
			'quantidade' => $usuarios->totalUsuarios()
		);

		$this->loadTemplate('usuarios', $dados);
	}
}

?>