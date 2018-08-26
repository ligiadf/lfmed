<?php

class consultasController extends controller {

	# URL: /consultas
	public function index() {

		$consultas = new Consultas();

		$dados = array(
			'consultas' => $consultas->listarConsultas(),
			'quantidade' => $consultas->totalConsultas()
		);

		$this->loadTemplate('consultas', $dados);
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
//			'marcar' => $marcacao->marcarConsulta($id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente, $statusConsulta),
//			'verificar' => $verificacao->verificarAgenda($id_medico, $dtConsulta_inicio, $dtConsulta_fim),
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

		$this->loadTemplate('marcar', $dados);
	}
}

?>