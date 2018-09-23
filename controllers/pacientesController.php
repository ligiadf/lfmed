<?php

class pacientesController extends Controller {

	# URL: /pacientes
	public function index() {

		$pacientes = new Pacientes();

		$dados = array();

	// paginação
		$offset = 0;
		$limite = 10;

		$dados['quantidade'] = $pacientes->totalPacientes();
		$quantidade = $dados['quantidade'];

		$dados['paginas'] = ceil($quantidade/$limite);

		$dados['pagina_atual'] = 1;
		
		if(!empty($_GET['p'])) {
			$dados['pagina_atual'] = intval($_GET['p']);
		}
		$offset = ($dados['pagina_atual'] * $limite) - $limite;

		$dados['pacientes'] = $pacientes->listarPacientes($offset, $limite);

		$dados['titulo_pagina'] = 'Pacientes';

		$this->loadTemplate('paciente-listar', $dados);
	}

	# URL: /pacientes/cadastrar
	public function cadastrar() {

		$pacientes = new Pacientes();
		$verificacao = new Pacientes();

		$nome_paciente = '';
		$data_nasc = '';
		$email = '';
		$telefone = '';
		$cpf = '';
		$plano_saude = '';
		$msgCadastrarPacienteOK = '';
		$msgCadastrarPacienteNOTOK = '';

		if( !empty($_POST['nomePaciente']) && !empty($_POST['dataNascimento']) && !empty($_POST['email']) && !empty($_POST['telefone']) && !empty($_POST['cpf']) && !empty($_POST['planoSaude']) ) {
			$nome_paciente = addslashes($_POST['nomePaciente']);
			$data_nascimento = explode('/', addslashes($_POST['dataNascimento']));
			$email = addslashes($_POST['email']);
			$telefone = addslashes($_POST['telefone']);
			$cpf = addslashes($_POST['cpf']);
			$plano_saude = addslashes($_POST['planoSaude']);

			// AAAA-MM-DD
			$data_nasc = $data_nascimento[2].'-'.$data_nascimento[1].'-'.$data_nascimento[0];

			if($verificacao->verificarPaciente($cpf)) {
				$pacientes->cadastrarPaciente($nome_paciente, $data_nasc, $email, $telefone, $cpf, $plano_saude);
				$msgCadastrarPacienteOK = "Paciente cadastrado com sucesso: ".$nome_paciente;
				header('Location:'. BASE_URL.'pacientes/cadastrar?msgOK='.urlencode($msgCadastrarPacienteOK));
			} else {
				$msgCadastrarPacienteNOTOK = "Paciente não foi cadastrado: CPF ".$cpf." já existe";
				header('Location:'. BASE_URL.'pacientes/cadastrar?msgError='.urlencode($msgCadastrarPacienteNOTOK));
			}

		}

		$dados = array(
			'titulo_pagina' => 'Cadastrar paciente',
			'nome_paciente' => $nome_paciente,
			'data_nasc' => $data_nasc,
			'email' => $email,
			'telefone' => $telefone,
			'cpf' => $cpf,
			'plano_saude' => $plano_saude,
			'msgCadastrarPacienteOK' => $msgCadastrarPacienteOK,
			'msgCadastrarPacienteNOTOK' => $msgCadastrarPacienteNOTOK
		);

		$this->loadTemplate('paciente-adicionar', $dados);

	}


	# URL: /pacientes/ficha/[id]
	public function ficha($id) {

		$pacientes = new Pacientes();
		$consultas = new Consultas();

		$ficha = $pacientes->fichaPaciente($id);
		$consulta = $consultas->listarConsultasPaciente($id);

		$dataNascimento = explode('-', addslashes($ficha['data_nasc']));
		$dataNasc = $dataNascimento[2].'/'.$dataNascimento[1].'/'.$dataNascimento[0];

		// cálculo idade
		$data_nasc_iso = $ficha['data_nasc'];
		$hoje = date("Y-m-d");
		$calculo = date_diff(date_create($data_nasc_iso), date_create($hoje));
		$idade = $calculo->format('%y')." anos (".$dataNasc.")";

		$dados = array(
			'titulo_pagina' => 'Ficha paciente n. '.$id,
			'ficha' => $ficha,
			'consulta' => $consulta,
			'id'=> $id,
			'idade'=> $idade,
			'nome' => $ficha['nome'],
			'email' => $ficha['email'],
			'telefone' => $ficha['telefone'],
			'cpf' => $ficha['cpf'],
			'plano_saude' => $ficha['plano_saude']
		);

		if( !empty($ficha) ) {
			$this->loadTemplate('paciente-ficha', $dados);
		} else {
			$dados404 = array (
				'msg404' => 'Paciente não existe:',
				'msglink404' => 'ver todos os pacientes',
				'link404' => BASE_URL.'pacientes'
			);
			$this->loadTemplate('404', $dados404);
		}

	}

	# URL: /pacientes/editar/[id]
	public function editar($id) {

		$pacientes = new Pacientes();

		if( !empty($_POST['nomePaciente']) && !empty($_POST['dataNascimento']) && !empty($_POST['email']) && !empty($_POST['telefone']) && !empty($_POST['cpf']) && !empty($_POST['planoSaude']) ) {
			$nome_paciente = addslashes($_POST['nomePaciente']);
			$data_nascimento = explode('/', addslashes($_POST['dataNascimento']));
			$email = addslashes($_POST['email']);
			$telefone = addslashes($_POST['telefone']);
			$cpf = addslashes($_POST['cpf']);
			$plano_saude = addslashes($_POST['planoSaude']);

			// AAAA-MM-DD
			$data_nasc = $data_nascimento[2].'-'.$data_nascimento[1].'-'.$data_nascimento[0];

			$pacientes->editarPaciente($id, $nome_paciente, $data_nasc, $email, $telefone, $cpf, $plano_saude);
			$msgCadastrarPacienteOK = "Paciente atualizado com sucesso: ".$nome_paciente;
			header('Location:'. BASE_URL.'pacientes/ficha/'.$id.'?msgOK='.urlencode($msgCadastrarPacienteOK));
		}

		$info = $pacientes->fichaPaciente($id);

		$dataNascimento = explode('-', addslashes($info['data_nasc']));
		$dataNasc = $dataNascimento[2].'/'.$dataNascimento[1].'/'.$dataNascimento[0];

		$dados = array(
			'titulo_pagina' => 'Editar paciente n. '.$id,
			'info' => $info,
			'data_nasc' => $dataNasc
		);

		if( !empty($info) ) {
			$this->loadTemplate('paciente-editar', $dados);
		} else {
			$dados404 = array (
				'msg404' => 'Paciente não existe:',
				'msglink404' => 'deseja cadastrar um novo?',
				'link404' => BASE_URL.'pacientes/cadastrar'
			);
			$this->loadTemplate('404', $dados404);
		}

	}

}

?>