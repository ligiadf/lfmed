<?php

class consultasController extends Controller {

	# URL: /consultas
	public function index() {

		$usuarios = new Usuarios();

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'C01') !== false ) {
			$this->loadTemplate('consulta');
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /consultas/listar
	public function listar() {

		$consultas = new Consultas();
		$medicos = new Medicos();
		$usuarios = new Usuarios();

		$dados = array();

	// filtro
		$md = '';
		$st = '';
		$di = '';
		$df = '';
		if(isset($_GET['md'])) { $md = $_GET['md']; }
		if(isset($_GET['st'])) { $st = $_GET['st']; }
		if(isset($_GET['di'])) { $di = $_GET['di']; }
		if(isset($_GET['df'])) { $df = $_GET['df']; }

	// paginação
		$offset = 0;
		$limite = 10;

		$dados['md'] = $md;
		$dados['st'] = $st;
		$dados['di'] = $di;
		$dados['df'] = $df;

		$dados['quantidade'] = $consultas->totalConsultas($md, $st, $di, $df);
		$quantidade = $dados['quantidade'];

		$dados['paginas'] = ceil($quantidade/$limite);

		$dados['pagina_atual'] = 1;
		
		if(!empty($_GET['p'])) {
			$dados['pagina_atual'] = intval($_GET['p']);
		}
		$offset = ($dados['pagina_atual'] * $limite) - $limite;

		$dados['consultas'] = $consultas->listarConsultas($offset, $limite, $md, $st, $di, $df);

		$dados['medicos'] = $medicos->listarMedicosAtivos($offset=0, $limite=10);

		$dados['titulo_pagina'] = 'Consultas';

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'C01') !== false ) {
			$this->loadTemplate('consulta-listar', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /consultas/marcar
	public function marcar() {

		$marcacao = new Consultas();
		$verificacao = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();
		$usuarios = new Usuarios();

		$offset = 0;
		$limite = 100;

	// filtro
		$md = '';
		$pc = '';
		$id_pc = '';
		if(isset($_GET['md'])) {
			$md = $_GET['md'];
		}
		if(isset($_GET['pc'])) {
			$pc = $_GET['pc'];
		}
		if(isset($_GET['id_pc'])) {
			$id_pc = $_GET['id_pc'];
		}

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
				$msgMarcarConsultaOK = "Consulta marcada com sucesso!";
				header('Location:'. BASE_URL.'consultas/marcar?msgOK='.urlencode($msgMarcarConsultaOK));
			} else {
				$msgMarcarConsultaNOTOK = "O médico não está disponível nesta data. Favor escolher outra!";
				header('Location:'. BASE_URL.'consultas/marcar?msgError='.urlencode($msgMarcarConsultaNOTOK));
			}
		}

		$dados = array(
			'titulo_pagina' => 'Marcar consulta',
			'medicos' => $medicos->listarMedicosAtivos($offset, $limite),
			'pacientes' => $pacientes->listarPacientes($offset, $limite, $pc, $id_pc),
			'id_medico' => $id_medico,
			'paciente' => $paciente,
			'statusConsulta' => $statusConsulta,
			'dtConsulta_inicio' => $dtConsulta_inicio,
			'dtConsulta_fim' => $dtConsulta_fim,
			'msgIndisponibilidadeMedico' => $msgIndisponibilidadeMedico,
			'msgConsultaMarcada' => $msgConsultaMarcada,
			'md' => $md,
			'pc' => $pc,
			'id_pc' => $id_pc
		);

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		if( strpos($_SESSION['uLogin']['permissoes'], 'C02') !== false ) {
			$this->loadTemplate('consulta-marcar', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /consultas/detalhe/[id]
	public function detalhe($id) {

		$consultas = new Consultas();
		$medicamentos = new Medicamentos();
		$exames = new Exames();
		$usuarios = new Usuarios();

		$detalhe = $consultas->detalheConsulta($id);
		$receita = $medicamentos->prescricoesMedicamentos($id);

		$pedido = $exames->requisicoesExames($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$diaMesConsultaFim = substr($detalhe['con_fim'], 0, 10); // AAAA-MM-DD
		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$dataConsultaFim = explode('-', addslashes($diaMesConsultaFim));
		$dtConsulta_fim = $dataConsultaFim[2].'/'.$dataConsultaFim[1].'/'.$dataConsultaFim[0]; // DD/MM/AAA

		$dados = array(
			'titulo_pagina' => 'Detalhes da consulta n. '.$id,
			'detalhe' => $detalhe,
			'receita' => $receita,
			'pedido' => $pedido,
			'id'=> $id,
			'con_data' => $dtConsulta_inicio,
			'con_hora' => $horaConsulta,
			'con_data_fim' => $dtConsulta_fim,
			'con_hora_fim' => $horaConsultaFim
		);

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'C03') !== false ) {

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

		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /consultas/editar/id
	public function editar($id) {

		$consulta = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();
		$usuarios = new Usuarios();

		$detalhe = $consulta->detalheConsulta($id);

		$offset = 0;
		$limite = 100;

	// filtro
		$md = '';
		$pc = '';
		$id_pc = '';
		if(isset($_GET['md'])) {
			$md = $_GET['md'];
		}
		if(isset($_GET['pc'])) {
			$pc = $_GET['pc'];
		}
		if(isset($_GET['id_pc'])) {
			$id_pc = $_GET['id_pc'];
		}

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

			// não se a consulta for "realizada", "ausente" ou "cancelada"
			if($statusConsulta == "0" || $statusConsulta == "2" || $statusConsulta == "3"  || $statusConsulta == "4") {
				$consulta->editarConsulta($id, $id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente, $statusConsulta);
				$msgMarcarConsultaOK = "Consulta alterada com sucesso!";
				header('Location:'. BASE_URL.'consultas/detalhe/'.$id.'?msgOK='.urlencode($msgEditarConsultaOK));
			} elseif ($statusConsulta == "1") {
				if($consulta->verificarAgenda($id_medico, $dtConsulta_inicio, $dtConsulta_fim)) {
					$consulta->editarConsulta($id, $id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente, $statusConsulta);
					$msgMarcarConsultaOK = "Consulta alterada com sucesso!";
					header('Location:'. BASE_URL.'consultas/detalhe/'.$id.'?msgOK='.urlencode($msgEditarConsultaOK));
				} else {
					$msgMarcarConsultaNOTOK = "O médico não está disponível nesta data. Favor escolher outra!";
					header('Location:'. BASE_URL.'consultas/editar/'.$id.'?msgError='.urlencode($msgMarcarConsultaNOTOK));
				}

			}

		}

		$dados = array(
			'titulo_pagina' => 'Editar consulta n. '.$id,
			'detalhe' => $detalhe,
			'medicos' => $medicos->listarMedicosAtivos($offset, $limite),
			'pacientes' => $pacientes->listarPacientes($offset, $limite, $pc, $id_pc),
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

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'C02') !== false ) {

			if( !empty($detalhe) ) {
				$this->loadTemplate('consulta-editar', $dados);
			} else {
				$dados404 = array (
					'msg404' => 'Consulta não existe:',
					'msglink404' => 'ver todas as consultas.',
					'link404' => BASE_URL.'consultas'
				);
				$this->loadTemplate('404', $dados404);
			}

		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /consultas/comprovante/id
	public function comprovante($id) {

		$consultas = new Consultas();
		$usuarios = new Usuarios();

		$detalhe = $consultas->detalheConsulta($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$data_atual = date('d/m/Y');

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		// se não tem permissão
		elseif ( strpos($_SESSION['uLogin']['permissoes'], 'C03') != true ) {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

		// id inválido
		elseif( empty($detalhe) && strpos($_SESSION['uLogin']['permissoes'], 'C03') !== false ) {
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
			$pdf->SetTitle(NOME_CLINICA. ' - Comprovante comparecimento '.$detalhe['pac_nome'].' em '.$dtConsulta_inicio, true);

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

			$pdf->Output(NOME_CLINICA. ' - Comprovante '.$detalhe['pac_nome'].' '.$dtConsulta_inicio.'.pdf', 'I');
			ob_end_flush;
		}

	}

	# URL: /consultas/indisponibilidade
	public function indisponibilidade() {

		$consultas = new Consultas();
		$medicos = new Medicos();
		$usuarios = new Usuarios();

		$offset = 0;
		$limite = 100;

		$dtConsulta_fim = '';
		$dtConsulta_inicio = '';
		$id_medico = '';

		$statusConsulta = '';
		$msgConsultaMarcada = '';
		$msgIndisponibilidadeMedico = '';

		if(empty($_GET['md'])) {
			$medicoSelecionadoID = '';
		} else {
			$medicoSelecionadoID = $_GET['md'];
		}

		if(!empty($_POST['medico']) && !empty($_POST['dataConsulta']) && !empty($_POST['horaConsulta'])) {
			$id_medico = addslashes($_POST['medico']);
			$dataConsulta = explode('/', addslashes($_POST['dataConsulta']));
			$horaConsulta = addslashes($_POST['horaConsulta']);
			$dataConsultaFim = explode('/', addslashes($_POST['dataConsultaFim']));
			$horaConsultaFim = addslashes($_POST['horaConsultaFim']);
			$statusConsulta = addslashes($_POST['statusConsulta']);

			// AAAA-MM-DD HH:MM
			$dtConsulta_inicio = $dataConsulta[2].'-'.$dataConsulta[1].'-'.$dataConsulta[0].' '.$horaConsulta;
			$dtConsulta_fim = $dataConsultaFim[2].'-'.$dataConsultaFim[1].'-'.$dataConsultaFim[0].' '.$horaConsultaFim;

			if($consultas->verificarAgenda($id_medico, $dtConsulta_inicio, $dtConsulta_fim)) {
				$consultas->marcarIndisponibilidade($id_medico, $dtConsulta_inicio, $dtConsulta_fim, $statusConsulta);
				$msgMarcarConsultaOK = "Indisponibilidade marcada com sucesso.";
				header('Location:'. BASE_URL.'usuarios/ficha/'.$id_medico.'?msgOK='.urlencode($msgMarcarConsultaOK));
			} else {
				$msgMarcarConsultaNOTOK = "Não é possível marcar indisponibilidade: o(a) médico(a) já possui consulta neste horário.";
				header('Location:'. BASE_URL.'consultas/indisponibilidade?md='.$medicoSelecionadoID.'&msgError='.urlencode($msgMarcarConsultaNOTOK));
			}
		}

		$dados = array(
			'titulo_pagina' => 'Marcar indisponibilidade',
			'medicos' => $medicos->listarMedicosAtivos($offset, $limite),
			'id_medico' => $id_medico,
			'statusConsulta' => $statusConsulta,
			'dtConsulta_inicio' => $dtConsulta_inicio,
			'dtConsulta_fim' => $dtConsulta_fim,
			'msgIndisponibilidadeMedico' => $msgIndisponibilidadeMedico,
			'msgConsultaMarcada' => $msgConsultaMarcada,
			'medicoSelecionadoID' => $medicoSelecionadoID
		);

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'C02') !== false ) {
			$this->loadTemplate('consulta-indisponibilidade', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	public function estatisticas() {

		$consultas = new Consultas();
		$usuarios = new Usuarios();

		$stats1 = $consultas->estatisticasConsultas(1);
		$stats2 = $consultas->estatisticasConsultas(2);
		$stats3 = $consultas->estatisticasConsultas(3);
		$stats4 = $consultas->estatisticasConsultas(4);

		$statsMed4 = $consultas->estatisticasConsultasMedico(4);
		$statsMed5 = $consultas->estatisticasConsultasMedico(5);
		$statsMed9 = $consultas->estatisticasConsultasMedico(9);
		$statsMed10 = $consultas->estatisticasConsultasMedico(10);

		$dados = array(
			'titulo_pagina' => 'Estatísticas de atendimento',
			'stats1' => $stats1,
			'stats2' => $stats2,
			'stats3' => $stats3,
			'stats4' => $stats4,
			'statsMed4' => $statsMed4,
			'statsMed5' => $statsMed5,
			'statsMed9' => $statsMed9,
			'statsMed10' => $statsMed10
		);

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'C05') !== false ) {
			$this->loadTemplate('consulta-estatistica', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

}

?>