<?php

class examesController extends Controller {

	# URL: /exames
	public function index() {

		$usuarios = new Usuarios();

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'E01') !== false ) {
			$this->loadTemplate('exame');
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /exames/listar
	public function listar() {

		$exames = new Exames();
		$usuarios = new Usuarios();

		$dados = array();

	// filtro
		$ex = '';
		if(isset($_GET['ex'])) {
			$ex = $_GET['ex'];
		}

	// paginação
		$offset = 0;
		$limite = 15;

		$dados['quantidade'] = $exames->totalExames();
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

		$dados['pedido'] = $exames->listarExames($offset, $limite, $ex);

		if($exames->listarExames($offset, $limite, $ex) == false) {
			$dados['msgSemResultado'] = 'Não há resultados, filtre por outro termo.';
		} else {
			$dados['msgSemResultado'] = '';
		}

		$dados['titulo_pagina'] = 'Exames';

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'E01') !== false ) {
			$this->loadTemplate('exame-listar', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}
	}

	# URL: /exames/adicionar
	public function adicionar($id) {

		$consulta = new Consultas();
		$medicos = new Medicos();
		$pacientes = new Pacientes();
		$exames = new Exames();
		$usuarios = new Usuarios();

		$detalhe = $consulta->detalheConsulta($id);
		$pedido = $exames->requisicoesExames($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$diaMesConsultaFim = substr($detalhe['con_fim'], 0, 10); // AAAA-MM-DD
		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$dataConsultaFim = explode('-', addslashes($diaMesConsultaFim));
		$dtConsulta_fim = $dataConsultaFim[2].'/'.$dataConsultaFim[1].'/'.$dataConsultaFim[0]; // DD/MM/AAA

	// filtro
		$ex = '';
		if(isset($_GET['ex'])) {
			$ex = $_GET['ex'];
		}

	// paginação
		$offset = 0;
		$limite = 15;

		$quantidade = $exames->totalExames();

		$paginas = ceil($quantidade/$limite);

		$pagina_atual = 1;

		$p_penultima = $paginas - 1;
		$p_antepenultima = $paginas - 2;

		if(!empty($_GET['p'])) {
			$pagina_atual = intval($_GET['p']);
		}
		$offset = ($pagina_atual * $limite) - $limite;

		$pedido = $exames->listarExames($offset, $limite, $ex);

		if($exames->listarExames($offset, $limite, $ex) == false) {
			$msgSemResultado = 'Não há resultados, filtre por outro termo.';
		} else {
			$msgSemResultado = '';
		}

		if(!empty($_POST['id_exa'])) {
			$id_pac = addslashes($_POST['id_pac']);
			$id_exa = addslashes($_POST['id_exa']);

			if(!empty($_POST['observacao'])) {
				$observacao = addslashes($_POST['observacao']);
			}

			if(!empty($_POST['cid'])) {
				$cid = addslashes($_POST['cid']);
			}

			$exames->adicionarExame($id, $id_pac, $id_exa, $observacao, $cid);

			$msgOK = "Exame adicionado com sucesso.";
			header('Location:'. BASE_URL.'consultas/detalhe/'.$id.'?msgOK='.urlencode($msgOK));
		}

		$dados = array(
			'titulo_pagina' => 'Adicionar exame na requisição para consulta n. '.$id,
			'detalhe' => $detalhe,
			'exames' => $exames,
			'pedido' => $pedido,
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

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'C04') !== false ) {
			$this->loadTemplate('exame-adicionar', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}
	}

	# URL: /exames/deletar/id_consulta/id_requisicao
	public function deletar($id_con,$id_req) {

		$exames = new Exames();
		$usuarios = new Usuarios();

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'C01') !== false ) {
			$exames = $exames->deletarExame($id_req);

			$msgOK = "Exame excluído com sucesso da requisição.";
			header('Location:'. BASE_URL.'consultas/detalhe/'.$id_con.'?msgOK='.urlencode($msgOK));
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /exames/imprimir/id
	public function imprimir($id) {

		$consultas = new Consultas();
		$exames = new Exames();
		$usuarios = new Usuarios();

		$detalhe = $consultas->detalheConsulta($id);
		$exames = $exames->requisicoesExames($id);

		$diaMesConsulta = substr($detalhe['con_inicio'], 0, 10); // AAAA-MM-DD
		$horaConsulta = substr($detalhe['con_inicio'], 11, 5); // HH:ii

		$dataConsulta = explode('-', addslashes($diaMesConsulta));
		$dtConsulta_inicio = $dataConsulta[2].'/'.$dataConsulta[1].'/'.$dataConsulta[0]; // DD/MM/AAA

		$horaConsultaFim = substr($detalhe['con_fim'], 11, 5); // HH:ii

		$data_atual = date('d/m/Y');

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		// se não tem permissão
		elseif ( strpos($_SESSION['uLogin']['permissoes'], 'C04') != true ) {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

		// id inválido
		elseif( empty($detalhe) ) {
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
				'msg404' => 'Não é possível emitir requisição de exames para a consulta, pois ela não foi realizada.'
			);
			$this->loadTemplate('404', $dados404);
		}

		// id de consulta sem exames
		elseif( empty($exames[0]['id_exa']) ) {
			$dados404 = array (
				'id' => $id,
				'msg404' => 'Não há requisição de exames para esta consulta.',
				'msglink404' => 'Deseja adicionar?',
				'link404' => BASE_URL.'exames/adicionar/'.$id
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
			$pdf->SetTitle(NOME_CLINICA. ' - Requisição exames '.$detalhe['pac_nome'].' em '.$dtConsulta_inicio, true);

			// Fonte Unicode para usar UTF-8
			$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
			$pdf->SetFont('DejaVu','',12);

			$pdf->Image(LOGO_CLINICA,5,5,80,40,'PNG');

			$pdf->Ln(35);
			//$pdf->MultiCell(125,20,'PRESCRIÇÃO DE REMÉDIOS',0,'C');

			$pdf->MultiCell(125,10,strtoupper($detalhe['pac_nome']),0,'C');
			$pdf->Ln(4);

			$pdf->SetFont('DejaVu','',11);

			foreach ($exames as $item) {
				if(!empty($item['cid'])) {
					$pdf->MultiCell(125,7,$item['nome']." (CID-10: ".$item['cid'].")");
				} else {
					$pdf->MultiCell(125,7,$item['nome']);
				}
				if(!empty($item['observacao'])) {
					$pdf->MultiCell(125,7,$item['observacao']);
				}
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

			$pdf->Output(NOME_CLINICA. ' - Requisição exames '.$detalhe['pac_nome'].' '.$dtConsulta_inicio.'.pdf', 'I');
			ob_end_flush;
		}
	}

	# URL: /exames/pacientes
	public function pacientes() {

		$pacientes = new Pacientes();
		$usuarios = new Usuarios();

		$dados = array();

	// filtro
		$pc = '';
		if(isset($_GET['pc'])) {
			$pc = $_GET['pc'];
		}
		$id_pc = '';
		if(isset($_GET['id_pc'])) {
			$id_pc = $_GET['id_pc'];
		}

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

		$dados['pacientes'] = $pacientes->listarPacientes($offset, $limite, $pc, $id_pc);

		if($pacientes->listarPacientes($offset, $limite, $pc, $id_pc) == false) {
			$dados['msgSemResultado'] = 'Não há resultados. Deseja <a href="'.BASE_URL.'pacientes/cadastrar'.'">cadastrar um paciente</a>?';
		} else {
			$dados['msgSemResultado'] = '';
		}

		$dados['titulo_pagina'] = 'Pacientes';

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'E02') !== false ) {
			$this->loadTemplate('exame-buscar-pacientes', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}


	# URL: /exames/paciente/id
	public function paciente($pac_id) {

		$pacientes = new Pacientes();
		$exames = new Exames();
		$usuarios = new Usuarios();

		$ficha = $pacientes->fichaPaciente($pac_id);
		$pedido = $exames->listarExamesPaciente($pac_id);

		$dados = array();

		$dados['ficha'] = $ficha;
		$dados['pedido'] = $pedido;

		$dados['titulo_pagina'] = 'Exames do paciente '.$ficha['nome'];

		if(!$pedido) {
			$dados['msgSemResultado'] = 'Não há requisição de exame para este paciente';
		}

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'E02') !== false ) {
			$this->loadTemplate('exame-paciente', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /exames/resultado_adicionar/id_paciente/id_requisicao
	public function resultado_adicionar($pac_id,$id_req) {

		$pacientes = new Pacientes();
		$exames = new Exames();
		$usuarios = new Usuarios();

		$ficha = $pacientes->fichaPaciente($pac_id);

		$nome_arquivo = '';
		$msgError = '';

		$pedido = $exames->requisicaoExameUnico($id_req);
		//$exames = $exames->adicionarResultadoExame($id_req, $nome_arquivo);

		$con_inicio = substr($pedido['con_inicio'], 0, 10); // AAAA-MM-DD

		if(isset($_FILES['arquivo']) && !empty($_FILES['arquivo'])) {

			$arquivo = $_FILES['arquivo'];

			$pasta = RAIZ.'uploads';

			$nome_arquivo = 'resultado-exame-'.$ficha['id'].'-'.$pedido['id_req'].'-'.$con_inicio.'.pdf';

			if(move_uploaded_file($arquivo['tmp_name'], $pasta.'/'.$nome_arquivo)) {
				$ext = strtolower(substr($arquivo['name'],-3));

				if($ext == 'pdf') {
					$exames->adicionarResultadoExame($id_req, $nome_arquivo);
					$msgOK = "Arquivo adicionado com sucesso.";
					header('Location:'. BASE_URL.'exames/paciente/'.$pac_id.'?msgOK='.urlencode($msgOK));
				} else {
					$msgError = "O arquivo enviado não é um PDF. Tente novamente selecionando um arquivo PDF.";
					header('Location:'. BASE_URL.'exames/resultado_adicionar/'.$pac_id.'/'.$pedido['id_req'].'?msgError='.urlencode($msgError));
				}
			}

			elseif($arquivo['error'] == 2) {
				$msgError = "Arquivo ultrapassa o tamanho máximo permitido: 8MB. [Erro 2]";
				header('Location:'. BASE_URL.'exames/resultado_adicionar/'.$pac_id.'/'.$pedido['id_req'].'?msgError='.urlencode($msgError));
			}

			elseif($arquivo['error'] == 4) {
				$msgError = "Nenhum arquivo selecionado. Selecione um arquivo PDF para enviar. [Erro 4]";
				header('Location:'. BASE_URL.'exames/resultado_adicionar/'.$pac_id.'/'.$pedido['id_req'].'?msgError='.urlencode($msgError));
			}

			elseif($arquivo['error'] == 6) {
				$msgError = "Pasta temporária não definida. Fale com o administrador do sistema. [Erro 6]";
				header('Location:'. BASE_URL.'exames/resultado_adicionar/'.$pac_id.'/'.$pedido['id_req'].'?msgError='.urlencode($msgError));
			}

			elseif($arquivo['error'] == 7) {
				$msgError = "Não foi possível salvar o arquivo no servidor.Fale com o administrador do sistema. [Erro 7]";
				header('Location:'. BASE_URL.'exames/resultado_adicionar/'.$pac_id.'/'.$pedido['id_req'].'?msgError='.urlencode($msgError));
			}

		}

		$dados = array();

		$dados['ficha'] = $ficha;
		$dados['pedido'] = $pedido;
		$dados['con_inicio'] = $con_inicio;

		$dados['titulo_pagina'] = 'Enviar resultado de exames do paciente '.$ficha['nome'];

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'E03') !== false ) {
			$this->loadTemplate('exame-resultado-adicionar', $dados);
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

	# URL: /exames/resultado_deletar/id_requisicao
	public function resultado_deletar($pac_id,$id_req) {

		$exames = new Exames();
		$usuarios = new Usuarios();

		// se não está logado
		if( !isset($_SESSION['uLogin']) && empty($_SESSION['uLogin']) ) {
			header('Location:'. BASE_URL.'login');
		}

		$perfil = $_SESSION['uLogin']['perfil'];

		$usuarios->verificarPermissoes($perfil);

		// se tem permissão
		if( strpos($_SESSION['uLogin']['permissoes'], 'E03') !== false ) {
			$exames = $exames->deletarResultadoExame($id_req);

			$msgOK = "Resultado de exame excluído com sucesso.";
			header('Location:'. BASE_URL.'exames/paciente/'.$pac_id.'?msgOK='.urlencode($msgOK));
		} else {
			$dados403 = array (
				'msg403' => 'Você não tem permissão para acessar esta página. Em caso de dúvidas, fale com o administrador do sistema.',
			);
			$this->loadTemplate('403', $dados403);
		}

	}

}

?>