<?php
// Controlador da página inicial
class homeController extends controller {

	public function index() {

		// informações para a view
		$dados = array(
			'data' => date('d-m-Y'),
			'hora' => date('H:i:s')
		);

		$this->loadTemplate('home', $dados);
	}



}