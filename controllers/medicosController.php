<?php

class medicosController extends controller {

	public function index() {

		$usuarios = new Usuarios();
		$medicos = new Medicos();

		$dados = array(
			// vai para view
			'medicos' => $medicos->listarMedicosAtivos(),
			'quantidade' => $medicos->totalMedicos()
		);

		$this->loadTemplate('medico-listar', $dados);
	}
}

?>