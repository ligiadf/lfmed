<?php
// Controlador da página inicial
class homeController extends Controller {

	public function index() {

		// informações para a view
		$dados = array(
			'titulo_pagina' => '',
			'data' => date('d-m-Y'),
			'hora' => date('H:i:s')
		);

		$this->loadTemplate('home', $dados);
	}



}