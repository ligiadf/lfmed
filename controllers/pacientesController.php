<?php

class pacientesController extends controller {

	# URL: /pacientes
	public function index() {

		$pacientes = new Pacientes();

		$dados = array(
			// vai para view
			'pacientes' => $pacientes->listarPacientes(),
			'quantidade' => $pacientes->totalPacientes()
		);

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
			//'pacientes' => $pacientes->cadastrarPaciente($nome_paciente, $data_nasc, $email, $telefone, $cpf, $plano_saude),
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


	# URL: /pacientes/cadastro/[id]
	public function cadastro($id) {

		$pacientes = new Pacientes();
		$consultas = new Consultas();

		$perfil = $pacientes->perfilPaciente($id);
		$consultaPac = $consultas->listarConsultasPaciente($id);

		$dataNascimento = explode('-', addslashes($perfil['data_nasc']));
		$dataNasc = $dataNascimento[2].'/'.$dataNascimento[1].'/'.$dataNascimento[0];

		$dados = array(
			// vai para view
			'perfil' => $perfil,
			'consulta' => $consultaPac,
			'id'=> $id,
			'nome' => $perfil['nome'],
			'data_nasc' => $dataNasc,
			'email' => $perfil['email'],
			'telefone' => $perfil['telefone'],
			'cpf' => $perfil['cpf'],
			'plano_saude' => $perfil['plano_saude']
		);

		$this->loadTemplate('paciente-cadastro', $dados);
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
				header('Location:'. BASE_URL.'pacientes/cadastro/'.$id.'?msgOK='.urlencode($msgCadastrarPacienteOK));
			
		}

		$info = $pacientes->perfilPaciente($id);

		$dataNascimento = explode('-', addslashes($info['data_nasc']));
		$dataNasc = $dataNascimento[2].'/'.$dataNascimento[1].'/'.$dataNascimento[0];

		$dados = array(
			// vai para view
			'info' => $info,
			'data_nasc' => $dataNasc
		);

		$this->loadTemplate('paciente-editar', $dados);

	}

}

?>