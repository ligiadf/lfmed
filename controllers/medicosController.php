<?php

class medicosController extends controller {

	public function index() {

		$usuarios = new Usuarios();
		$medicos = new Medicos();

		$dados = array(
			// vai para view
			'medicos' => $medicos->listarMedicos(),
			'quantidade' => $medicos->totalMedicos()
		);

		$this->loadTemplate('medicos', $dados);
	}
}

?>