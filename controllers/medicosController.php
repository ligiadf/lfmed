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

		$this->loadTemplate('medico-listar', $dados);
	}
}

?>