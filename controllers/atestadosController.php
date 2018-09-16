<?php

class atestadosController extends Controller {

	# URL: /atestados/adicionar
	public function adicionar($id) {

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

		if(!empty($_POST['atestadoPeriodo']) && !empty($_POST['atestadoMotivo'])) {
			$atestadoPeriodo = addslashes($_POST['atestadoPeriodo']);
			$atestadoMotivo = addslashes($_POST['atestadoMotivo']);

			if(!empty($atestadoCID)) {
				$atestadoCID = addslashes($_POST['atestadoCID']);
			}

			$consulta->adicionarAtestado($id, $atestadoPeriodo, $atestadoMotivo, $atestadoCID);
			$msgOK = "Atestado adicionado com sucesso.";
			header('Location:'. BASE_URL.'consultas/detalhe/'.$id.'?msgOK='.urlencode($msgOK));
		}

		$dados = array(
			'detalhe' => $detalhe,
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
			'con_hora_fim' => $horaConsultaFim
		);

		$this->loadTemplate('atestado-adicionar', $dados);
	}


	# URL: /atestados/editar/id
	public function editar($id) {

		$consulta = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();

		$detalhe = $consulta->detalheConsulta($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$medicoSelecionadoID = $detalhe['med_id'];
		$pacienteSelecionadoID = $detalhe['pac_id'];

		if(!empty($_POST['atestadoPeriodo']) && !empty($_POST['atestadoMotivo'])) {
			$atestadoPeriodo = addslashes($_POST['atestadoPeriodo']);
			$atestadoMotivo = addslashes($_POST['atestadoMotivo']);

			if(!empty($_POST['atestadoCID'])) {
				$atestadoCID = addslashes($_POST['atestadoCID']);
			}

			$consulta->adicionarAtestado($id, $atestadoPeriodo, $atestadoMotivo, $atestadoCID);
			$msgOK = "Atestado editado com sucesso.";
			header('Location:'. BASE_URL.'consultas/detalhe/'.$id.'?msgOK='.urlencode($msgOK));
		}

		$dados = array(
			'detalhe' => $detalhe,
			'med_id' => $detalhe['med_id'],
			'med_nome' => $detalhe['med_nome'],
			'especialidade' => $detalhe['especialidade'],
			'pac_id' => $detalhe['pac_id'],
			'pac_nome' => $detalhe['pac_nome'],
			'id'=> $id,
			'con_data' => $dtConsulta_inicio,
			'con_hora' => $horaConsulta,
			'con_status' => $detalhe['con_status'],
			'atestadoPeriodo' => $detalhe['atestado_periodo'],
			'atestadoMotivo' => $detalhe['atestado_motivo'],
			'atestadoCID' => $detalhe['atestado_cid']
		);

		if( !empty($detalhe) ) {
			$this->loadTemplate('atestado-editar', $dados);
		} else {
			$dados404 = array (
				'msg404' => 'Consulta não existe:',
				'msglink404' => 'deseja marcar uma nova?',
				'link404' => BASE_URL.'consultas/marcar'
			);
			$this->loadTemplate('404', $dados404);
		}

	}

	# URL: /atestados/imprimir/id
	public function imprimir($id) {

		$consultas = new Consultas();

		$detalhe = $consultas->detalheConsulta($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$data_atual = date('d/m/Y');

		// id inválido
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
				'msg404' => 'Não é possível emitir atestado para a consulta, pois ela não foi realizada.'
			);
			$this->loadTemplate('404', $dados404);
		}

		// id de consulta sem atestado
		elseif( empty($detalhe['atestado_periodo']) ) {
			$dados404 = array (
				'id' => $id,
				'msg404' => 'Não há atestado para esta consulta.',
				'msglink404' => 'Deseja adicionar?',
				'link404' => BASE_URL.'atestados/adicionar/'.$id
			);
			$this->loadTemplate('404', $dados404);
		}

		// id de consulta realizada
		else {
			ob_start();
			require ("assets/fpdf/fpdf.php");
			require ("assets/tfpdf/tfpdf.php");
			$pdf = new tFPDF();
			$pdf->AddPage('P','A5');
			$pdf->SetAutoPageBreak(true,1);
			
			$pdf->SetAuthor(NOME_CLINICA, true);
			$pdf->SetTitle(NOME_CLINICA. ' - Atestado para consulta '.$id, true);
			
			// Fonte Unicode para usar UTF-8
			$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
			$pdf->SetFont('DejaVu','',12);

			$pdf->Image(LOGO_CLINICA,5,5,80,40,'PNG');

			$pdf->Ln(35);
			$pdf->MultiCell(125,20,'ATESTADO',0,'C');

			if(!empty($detalhe['atestado_cid'])) {
				$pdf->MultiCell(125,10,'Atesto para os devidos fins que '.$detalhe['pac_nome'].', inscrito(a) no CPF sob o nº '.$detalhe['cpf'].', esteve em consulta no dia '.$dtConsulta_inicio.' às '.$horaConsulta.' apresentando quadro de '.$detalhe['atestado_motivo'].' (CID-10 '.$detalhe['atestado_cid'].') e necessitando de repouso '.$detalhe['atestado_periodo'].'.');
			} else {
				$pdf->MultiCell(125,10,'Atesto para os devidos fins que '.$detalhe['pac_nome'].', inscrito(a) no CPF sob o nº '.$detalhe['cpf'].', esteve em consulta no dia '.$dtConsulta_inicio.' às '.$horaConsulta.' apresentando quadro de '.$detalhe['atestado_motivo'].' e necessitando de repouso '.$detalhe['atestado_periodo'].'.');
			}

			$pdf->Ln(7);
			$pdf->MultiCell(125,10, 'Atenciosamente,',0,'R');
			$pdf->MultiCell(125,10, '__________________________',0,'R');
			$pdf->MultiCell(125,7, $detalhe['med_nome'],0,'R');
			$pdf->MultiCell(125,7, $detalhe['especialidade'],0,'R');
			$pdf->MultiCell(125,7, $detalhe['crm'],0,'R');

			$pdf->Ln(10);
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