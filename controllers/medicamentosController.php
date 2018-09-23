<?php

class medicamentosController extends Controller {

	# URL: /medicamentos
	public function index() {

		$medicamentos = new Medicamentos();

		$dados = array();

		// filtro
			$rem = '';
			if(isset($_GET['rem'])) {
				$rem = $_GET['rem'];
			}

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

		$dados['medicamentos'] = $medicamentos->listarMedicamentos($offset, $limite, $rem);

		if($medicamentos->listarMedicamentos($offset, $limite, $rem) == false) {
			$dados['msgSemResultado'] = 'Não há resultados, filtre por outro termo.';
		} else {
			$dados['msgSemResultado'] = '';
		}

		$dados['titulo_pagina'] = 'Medicamentos';

		$this->loadTemplate('medicamento-listar', $dados);
	}

	# URL: /medicamentos/adicionar
	public function adicionar($id) {

		$consulta = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();
		$medicamentos = new Medicamentos();

		$detalhe = $consulta->detalheConsulta($id);
		$receita = $medicamentos->prescricoesMedicamentos($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$diaMesConsultaFim = substr($detalhe['con_fim'], 0, 10); // AAAA-MM-DD
		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$dataConsultaFim = explode('-', addslashes($diaMesConsultaFim));
		$dtConsulta_fim = $dataConsultaFim[2].'/'.$dataConsultaFim[1].'/'.$dataConsultaFim[0]; // DD/MM/AAA

		// filtro
			$rem = '';
			if(isset($_GET['rem'])) {
				$rem = $_GET['rem'];
			}

	// paginação
		$offset = 0;
		$limite = 15;

		$quantidade = $medicamentos->totalMedicamentos();

		$paginas = ceil($quantidade/$limite);

		$pagina_atual = 1;

		$p_penultima = $paginas - 1;
		$p_antepenultima = $paginas - 2;

		if(!empty($_GET['p'])) {
			$pagina_atual = intval($_GET['p']);
		}
		$offset = ($pagina_atual * $limite) - $limite;

		$remedios = $medicamentos->listarMedicamentos($offset, $limite, $rem);

		if($medicamentos->listarMedicamentos($offset, $limite, $rem) == false) {
			$msgSemResultado = 'Não há resultados, filtre por outro termo.';
		} else {
			$msgSemResultado = '';
		}

		if(!empty($_POST['id_rem']) && !empty($_POST['posologia'])) {
			$id_rem = addslashes($_POST['id_rem']);
			$posologia = addslashes($_POST['posologia']);

			$medicamentos->adicionarReceita($id, $id_rem, $posologia);

			$msgOK = "Receita adicionada com sucesso.";
			header('Location:'. BASE_URL.'consultas/detalhe/'.$id.'?msgOK='.urlencode($msgOK));
		}

		$dados = array(
			'titulo_pagina' => 'Adicionar item na receita para consulta n. '.$id,
			'detalhe' => $detalhe,
			'medicamentos' => $medicamentos,
			'remedios' => $remedios,
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
			'msgSemResultado' => $msgSemResultado,
			'p_antepenultima' => $p_antepenultima,
			'p_penultima' => $p_penultima,
			'pagina_atual' => $pagina_atual,
			'paginas' => $paginas,
			'quantidade' => $quantidade
		);

		$this->loadTemplate('medicamento-adicionar', $dados);
	}

	# URL: /medicamentos/deletar/id
	public function deletar($id_con,$id_presc) {

		$medicamentos = new Medicamentos();

		$receita = $medicamentos->deletarReceita($id_presc);

		$msgOK = "Medicamento deletado com sucesso da receita.";
		header('Location:'. BASE_URL.'consultas/detalhe/'.$id_con.'?msgOK='.urlencode($msgOK));
	}

	# URL: /medicamentos/imprimir/id
	public function imprimir($id) {

		$consultas = new Consultas();
		$medicamentos = new Medicamentos();

		$detalhe = $consultas->detalheConsulta($id);
		$receita = $medicamentos->prescricoesMedicamentos($id);

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
				'msg404' => 'Não é possível emitir prescrição de medicamentos para a consulta, pois ela não foi realizada.'
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
			$pdf->SetTitle(NOME_CLINICA. ' - Prescrição remédios '.$detalhe['pac_nome'].' em '.$dtConsulta_inicio, true);

			// Fonte Unicode para usar UTF-8
			$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
			$pdf->SetFont('DejaVu','',12);

			$pdf->Image(LOGO_CLINICA,5,5,80,40,'PNG');

			$pdf->Ln(35);
			//$pdf->MultiCell(125,20,'PRESCRIÇÃO DE REMÉDIOS',0,'C');

			$pdf->MultiCell(125,10,strtoupper($detalhe['pac_nome']),0,'C');
			$pdf->Ln(4);

			$pdf->SetFont('DejaVu','',11);
			foreach ($receita as $item) {
				$pdf->MultiCell(125,7,$item['nome_comercial'].$item['apresentacao']);
				$pdf->MultiCell(125,7,$item['posologia']);
				$pdf->Ln(4);
			}

			$pdf->Ln(5);
			$pdf->MultiCell(125,10, '__________________________',0,'R');
			$pdf->MultiCell(125,7, $detalhe['med_nome'],0,'R');
			$pdf->MultiCell(125,7, $detalhe['especialidade'],0,'R');
			$pdf->MultiCell(125,7, $detalhe['crm'],0,'R');

			$pdf->Ln(5);
			$pdf->MultiCell(120,10, 'Porto Alegre, '.$data_atual,0,'C');

			$pdf->SetY(-20);
			$pdf->SetFont('Arial','I',8);
			$pdf->MultiCell(0,7, "E-mail: ".EMAIL_CLINICA." - Telefone: ".FONE_CLINICA,0,'C');
			$pdf->MultiCell(0,7, END_CLINICA,0,'C');
			
			$pdf->Output(NOME_CLINICA. ' - Prescrição remédios '.$detalhe['pac_nome'].' '.$dtConsulta_inicio.'.pdf', 'I');
			ob_end_flush;
		}
	}

}

?>