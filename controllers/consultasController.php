<?php

class consultasController extends Controller {

	# URL: /consultas
	public function index() {

		$consultas = new Consultas();

		$dados = array(
			'consultas' => $consultas->listarConsultas(),
			'quantidade' => $consultas->totalConsultas()
		);

		$this->loadTemplate('consulta-listar', $dados);
	}

	# URL: /consultas/marcar
	public function marcar() {

		$marcacao = new Consultas();
		$verificacao = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();

		$dtConsulta_fim = '';
		$dtConsulta_inicio = '';
		$id_medico = '';
		$paciente = '';
		$statusConsulta = '';
		$msgConsultaMarcada = '';
		$msgIndisponibilidadeMedico = '';

		if(!empty($_POST['medico']) && !empty($_POST['dataConsulta']) && !empty($_POST['horaConsulta']) && !empty($_POST['paciente'])) {
			$id_medico = addslashes($_POST['medico']);
			$dataConsulta = explode('/', addslashes($_POST['dataConsulta']));
			$horaConsulta = addslashes($_POST['horaConsulta']);
			$paciente = addslashes($_POST['paciente']);
			$statusConsulta = addslashes($_POST['statusConsulta']);

			// AAAA-MM-DD HH:MM
			$dtConsulta_inicio = $dataConsulta[2].'-'.$dataConsulta[1].'-'.$dataConsulta[0].' '.$horaConsulta;

			// $dtConsulta_inicio + 30 minutos
			$dtConsulta_fim = date("Y-m-d H:i", strtotime($dtConsulta_inicio. '+30 minutes'));

			if($verificacao->verificarAgenda($id_medico, $dtConsulta_inicio, $dtConsulta_fim)) {
				$marcacao->marcarConsulta($id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente, $statusConsulta);
				$msgMarcarConsultaOK = "Consulta marcada com sucesso: em ".$dtConsulta_inicio;
				header('Location:'. BASE_URL.'consultas/marcar?msgOK='.urlencode($msgMarcarConsultaOK));
			} else {
				$msgMarcarConsultaNOTOK = "O médico não está disponível nesta data. Favor escolher outra!";
				header('Location:'. BASE_URL.'consultas/marcar?msgError='.urlencode($msgMarcarConsultaNOTOK));
			}
		}

		$dados = array(
			'medicos' => $medicos->listarMedicosAtivos(),
			'pacientes' => $pacientes->listarPacientes(),
			'id_medico' => $id_medico,
			'paciente' => $paciente,
			'statusConsulta' => $statusConsulta,
			'dtConsulta_inicio' => $dtConsulta_inicio,
			'dtConsulta_fim' => $dtConsulta_fim,
			'msgIndisponibilidadeMedico' => $msgIndisponibilidadeMedico,
			'msgConsultaMarcada' => $msgConsultaMarcada
		);

		$this->loadTemplate('consulta-marcar', $dados);
	}

	# URL: /consultas/detalhe/[id]
	public function detalhe($id) {

		$consultas = new Consultas();
		//$usuarios = new Usuarios();
		//$pacientes = new Pacientes();

		$detalhe = $consultas->detalheConsulta($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$diaMesConsultaFim = substr($detalhe['con_fim'], 0, 10); // AAAA-MM-DD
		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$dataConsultaFim = explode('-', addslashes($diaMesConsultaFim));
		$dtConsulta_fim = $dataConsultaFim[2].'/'.$dataConsultaFim[1].'/'.$dataConsultaFim[0]; // DD/MM/AAA

		$dados = array(
			'med_id' => $detalhe['med_id'],
			'med_nome' => $detalhe['med_nome'],
			'especialidade' => $detalhe['especialidade'],
			'pac_id' => $detalhe['pac_id'],
			'pac_nome' => $detalhe['pac_nome'],
			'detalhe' => $detalhe,
			'id'=> $id,
			'con_data' => $dtConsulta_inicio,
			'con_hora' => $horaConsulta,
			'con_status' => $detalhe['con_status'],
			'con_data_fim' => $dtConsulta_fim,
			'con_hora_fim' => $horaConsultaFim
		);

		$this->loadTemplate('consulta-detalhe', $dados);
	}

	# URL: /consultas/editar/id
	public function editar($id) {

		$consulta = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();

		$detalhe = $consulta->detalheConsulta($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$diaMesConsultaFim = substr($detalhe['con_fim'], 0, 10); // AAAA-MM-DD
		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$dataConsultaFim = explode('-', addslashes($diaMesConsultaFim));
		$dtConsulta_fim = $dataConsultaFim[2].'/'.$dataConsultaFim[1].'/'.$dataConsultaFim[0]; // DD/MM/AAA

		$medicoSelecionadoID = $detalhe['med_id'];
		$pacienteSelecionadoID = $detalhe['pac_id'];

		if(!empty($_POST['medico']) && !empty($_POST['dataConsulta']) && !empty($_POST['horaConsulta'])) {
			$id_medico = addslashes($_POST['medico']);
			$dataConsulta = explode('/', addslashes($_POST['dataConsulta']));
			$horaConsulta = addslashes($_POST['horaConsulta']);

			$dataConsultaFim = explode('/', addslashes($_POST['dataConsultaFim']));
			$horaConsultaFim = addslashes($_POST['horaConsultaFim']);

			$statusConsulta = addslashes($_POST['statusConsulta']);

			if($statusConsulta == "0") {
				$paciente = '';
			} else {
				$paciente = addslashes($_POST['paciente']);
			}

			// AAAA-MM-DD HH:MM
			$dtConsulta_inicio = $dataConsulta[2].'-'.$dataConsulta[1].'-'.$dataConsulta[0].' '.$horaConsulta;



			if($statusConsulta == "0") {

				// AAAA-MM-DD HH:MM
				$dtConsulta_fim = $dataConsultaFim[2].'-'.$dataConsultaFim[1].'-'.$dataConsultaFim[0].' '.$horaConsultaFim;

			} else {

				// $dtConsulta_inicio + 30 minutos
				$dtConsulta_fim = date("Y-m-d H:i", strtotime($dtConsulta_inicio. '+30 minutes'));

			}



			$consulta->editarConsulta($id, $id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente, $statusConsulta);
			$msgEditarConsultaOK = "Consulta alterada com sucesso: em ".$dtConsulta_inicio;
			header('Location:'. BASE_URL.'consultas/editar/'.$id.'?msgOK='.urlencode($msgEditarConsultaOK));
		}

		$dados = array(
			'detalhe' => $detalhe,
			'medicos' => $medicos->listarMedicosAtivos(),
			'pacientes' => $pacientes->listarPacientes(),
			'med_id' => $detalhe['med_id'],
			'med_nome' => $detalhe['med_nome'],
			'especialidade' => $detalhe['especialidade'],
			'pac_id' => $detalhe['pac_id'],
			'pac_nome' => $detalhe['pac_nome'],
			'id'=> $id,
			'con_data' => $dtConsulta_inicio,
			'con_hora' => $horaConsulta,
			'con_status' => $detalhe['con_status'],
			'con_data_fim' => $dtConsulta_fim,
			'con_hora_fim' => $horaConsultaFim,
			'medicoSelecionadoID' => $medicoSelecionadoID,
			'pacienteSelecionadoID' => $pacienteSelecionadoID
		);

		$this->loadTemplate('consulta-editar', $dados);
	}

}

?>