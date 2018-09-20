<?php

class medicamentosController extends Controller {

	# URL: /medicamentos
	public function index() {

		$medicamentos = new Medicamentos();

		$dados = array();

	// paginação
		$offset = 0;
		$limite = 15;

		$dados['quantidade'] = $medicamentos->totalMedicamentos();
		$quantidade = $dados['quantidade'];

		$dados['paginas'] = ceil($quantidade/$limite);
		$paginas = $dados['paginas'];

		$dados['pagina_atual'] = 1;

		$dados['p_penultima'] = $paginas - 1;
		$dados['p_antepenultima'] = $paginas - 2;

		if(!empty($_GET['p'])) {
			$dados['pagina_atual'] = intval($_GET['p']);
		}
		$offset = ($dados['pagina_atual'] * $limite) - $limite;

		$dados['medicamentos'] = $medicamentos->listarMedicamentos($offset, $limite);

		$dados['titulo_pagina'] = 'Medicamentos';

		$this->loadTemplate('medicamento-listar', $dados);
	}

}

?>