<?php

class consultasController extends Controller {

	# URL: /consultas
	public function index() {

		$consultas = new Consultas();
		$medicos = new Medicos();

		$dados = array();

		// filtro
			$md = '';
			$st = '';
			if(isset($_GET['md'])) {
				$md = $_GET['md'];
			}
			if(isset($_GET['st'])) {
				$st = $_GET['st'];
			}

	// paginação
		$offset = 0;
		$limite = 10;

		$dados['md'] = $md;
		$dados['st'] = $st;

		$dados['quantidade'] = $consultas->totalConsultas($md, $st);
		$quantidade = $dados['quantidade'];

		$dados['paginas'] = ceil($quantidade/$limite);

		$dados['pagina_atual'] = 1;
		
		if(!empty($_GET['p'])) {
			$dados['pagina_atual'] = intval($_GET['p']);
		}
		$offset = ($dados['pagina_atual'] * $limite) - $limite;

		$dados['consultas'] = $consultas->listarConsultas($offset, $limite, $md, $st);

		$dados['medicos'] = $medicos->listarMedicosAtivos($offset=0, $limite=10);


		$this->loadTemplate('consulta-listar', $dados);
	}

	# URL: /consultas/marcar
	public function marcar() {

		$marcacao = new Consultas();
		$verificacao = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();

		$offset = 0;
		$limite = 100;

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
			'medicos' => $medicos->listarMedicosAtivos($offset, $limite),
			'pacientes' => $pacientes->listarPacientes($offset, $limite),
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
			'cpf' => $detalhe['cpf'],
			'detalhe' => $detalhe,
			'id'=> $id,
			'con_data' => $dtConsulta_inicio,
			'con_hora' => $horaConsulta,
			'con_status' => $detalhe['con_status'],
			'con_data_fim' => $dtConsulta_fim,
			'con_hora_fim' => $horaConsultaFim,
			'atestado_motivo' => $detalhe['atestado_motivo'],
			'atestado_periodo' => $detalhe['atestado_periodo'],
			'atestado_cid' => $detalhe['atestado_cid']
		);

		if( !empty($detalhe) ) {
			$this->loadTemplate('consulta-detalhe', $dados);
		} else {
			$dados404 = array (
				'msg404' => 'Consulta não existe:',
				'msglink404' => 'ver todas as consultas.',
				'link404' => BASE_URL.'consultas'
			);
			$this->loadTemplate('404', $dados404);
		}

	}

	# URL: /consultas/editar/id
	public function editar($id) {

		$consulta = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();

		$detalhe = $consulta->detalheConsulta($id);

		$offset = 0;
		$limite = 100;

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
			header('Location:'. BASE_URL.'consultas/detalhe/'.$id.'?msgOK='.urlencode($msgEditarConsultaOK));
		}

		$dados = array(
			'detalhe' => $detalhe,
			'medicos' => $medicos->listarMedicosAtivos($offset, $limite),
			'pacientes' => $pacientes->listarPacientes($offset, $limite),
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

		if( !empty($detalhe) ) {
			$this->loadTemplate('consulta-editar', $dados);
		} else {
			$dados404 = array (
				'msg404' => 'Consulta não existe:',
				'msglink404' => 'deseja marcar uma nova?',
				'link404' => BASE_URL.'consultas/marcar'
			);
			$this->loadTemplate('404', $dados404);
		}

	}

	# URL: /consultas/comprovante/id
	public function comprovante($id) {

		$consultas = new Consultas();

		$detalhe = $consultas->detalheConsulta($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$data_atual = date('d/m/Y');

		// id inválido
		//if( empty($dtConsulta_inicio) || empty($detalhe['med_nome']) ) {
		if( empty($detalhe) ) {
			$dados404 = array (
				'msg404' => 'Consulta não existe:',
				'msglink404' => 'deseja marcar uma nova?',
				'link404' => BASE_URL.'consultas/marcar'
			);
			$this->loadTemplate('404', $dados404);
		}

		// id de consulta que não foi realizada
		elseif( $detalhe['con_status'] != 2 ) {
			$dados404 = array (
				'id' => $id,
				'msg404' => 'Não é possível emitir comprovante para a consulta, pois ela não foi realizada.'
			);
			$this->loadTemplate('404', $dados404);

		// id de consulta realizada
		} else {
			ob_start();
			require ("assets/fpdf/fpdf.php");
			require ("assets/tfpdf/tfpdf.php");
			$pdf = new tFPDF();
			$pdf->AddPage('P','A5');
			$pdf->SetAutoPageBreak(true,1);
			
			$pdf->SetAuthor(NOME_CLINICA, true);
			$pdf->SetTitle(NOME_CLINICA. ' - Comprovante comparecimento consulta '.$id, true);
			
			// Fonte Unicode para usar UTF-8
			$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
			$pdf->SetFont('DejaVu','',12);

			$pdf->Image(LOGO_CLINICA,5,5,80,40,'PNG');

			$pdf->Ln(40);
			$pdf->MultiCell(125,20,'COMPROVANTE DE COMPARECIMENTO',0,'C');
			$pdf->MultiCell(125,10,'Declaro para os devidos fins que '.$detalhe['pac_nome'].' esteve em consulta médica na Clínica Oftorrino no dia '.$dtConsulta_inicio.', das '.$horaConsulta.' às '.$horaConsultaFim.'.');

			$pdf->Ln(10);
			$pdf->MultiCell(125,10, 'Atenciosamente,',0,'R');
			$pdf->MultiCell(125,10, '__________________________',0,'R');
			$pdf->MultiCell(125,7, $detalhe['med_nome'],0,'R');
			$pdf->MultiCell(125,7, $detalhe['especialidade'],0,'R');
			$pdf->MultiCell(125,7, $detalhe['crm'],0,'R');

			$pdf->Ln(20);
			$pdf->MultiCell(120,10, 'Porto Alegre, '.$data_atual,0,'C');

			$pdf->SetY(-15);
			$pdf->SetFont('Arial','I',8);
			$pdf->Cell(0,10,END_CLINICA,0,0,'C');

			$pdf->Output();
			ob_end_flush;
		}

	}

}

?>