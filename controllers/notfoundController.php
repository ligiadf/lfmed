<?php

class notfoundController extends Controller {

	public function index() {

		$dados = array(
			'titulo_pagina' => 'Página não encontrada'
		);
		$this->loadTemplate('404',$dados);

	}


}

