<?php

class pacientesController extends controller {

	public function index() {

		$pacientes = new Pacientes();

		$dados = array(
			// vai para view
			'pacientes' => $pacientes->listarPacientes(),
			'quantidade' => $pacientes->totalPacientes()
		);

		$this->loadTemplate('pacientes', $dados);
	}
}

?>