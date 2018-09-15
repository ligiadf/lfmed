<?php

class calendarioController extends Controller {

	// calendário semanal: apenas consultas marcadas ou realizadas e indisponibilidade
	public function index() {

		$calendario = new Calendario();

		// data atual: AAAA-MM-DD
		if(empty($_GET['d'])) {
			$data = date('Y-m-d');
		} else {
			$data = $_GET['d'];
		}

		$dia_atual = substr($data, 8, 2);

		$mes_atual_extenso = substr($data, 5, 2);

		$ano_atual = substr($data, 0, 4);

		switch($mes_atual_extenso) {
			case '01': $mes_atual_extenso = 'janeiro'; break;
			case '02': $mes_atual_extenso = 'fevereiro'; break;
			case '03': $mes_atual_extenso = 'março'; break;
			case '04': $mes_atual_extenso = 'abril'; break;
			case '05': $mes_atual_extenso = 'maio'; break;
			case '06': $mes_atual_extenso = 'junho'; break;
			case '07': $mes_atual_extenso = 'julho'; break;
			case '08': $mes_atual_extenso = 'agosto'; break;
			case '09': $mes_atual_extenso = 'setembro'; break;
			case '10': $mes_atual_extenso = 'outubro'; break;
			case '11': $mes_atual_extenso = 'novembro'; break;
			case '12': $mes_atual_extenso = 'dezembro'; break;
		}

		// dia da semana do primeiro dia do mês
		$dia1 = date('w', strtotime($data));

		// quantos dias tem o mês
		$dias = date('t', strtotime($data));

		// número de linhas, arredondando para cima
		//$linhas = ceil(($dia1 + $dias) / 7);
		$linhas = '1';

		// data de início do calendário: saber dias antes e depois do mês atual
		// diminui do primeiro dia do mês o número de dias que tem antes, que é igual ao número do dia da semana
		// domingo é 0 e fica na primeira coluna
		$data_inicio = date('Y-m-d', strtotime(- $dia1.' days', strtotime($data)));

		// data do final do calendário: primeiro dia + número de linhas x 7; menos 1 para contar o primeiro dia
		$data_fim = date('Y-m-d', strtotime( (- $dia1 + ($linhas*7) - 1 ).' days', strtotime($data)));

		// seleção médicos
		if(empty($_GET['m'])) {
			$med = '';
		} else {
			$med = $_GET['m'];
		}

		$dados = array(
			'calendario' => $calendario->mostrarCalendario($data_inicio, $data_fim),
			'data' => $data,
			'dia_atual' => $dia_atual,
			'mes_atual_extenso' => $mes_atual_extenso,
			'ano_atual' => $ano_atual,
			'dia1' => $dia1,
			'dias' => $dias,
			'linhas' => $linhas,
			'data_inicio' => $data_inicio,
			'data_fim' => $data_fim
		);

		$this->loadTemplate('calendario-semanal', $dados);
	}

	public function mensal() {

		$calendario = new Calendario();

		// data atual: AAAA-MM
		if(empty($_GET['d'])) {
			$data = date('Y-m');
		} else {
			$data = $_GET['d'];
		}

		$mes_atual_extenso = substr($data, 5);

		$ano_atual = substr($data, 0, 4);

		switch($mes_atual_extenso) {
			case '01': $mes_atual_extenso = 'Janeiro'; break;
			case '02': $mes_atual_extenso = 'Fevereiro'; break;
			case '03': $mes_atual_extenso = 'Março'; break;
			case '04': $mes_atual_extenso = 'Abril'; break;
			case '05': $mes_atual_extenso = 'Maio'; break;
			case '06': $mes_atual_extenso = 'Junho'; break;
			case '07': $mes_atual_extenso = 'Julho'; break;
			case '08': $mes_atual_extenso = 'Agosto'; break;
			case '09': $mes_atual_extenso = 'Setembro'; break;
			case '10': $mes_atual_extenso = 'Outubro'; break;
			case '11': $mes_atual_extenso = 'Novembro'; break;
			case '12': $mes_atual_extenso = 'Dezembro'; break;
		}

		// dia da semana do primeiro dia do mês
		$dia1 = date('w', strtotime($data));

		// quantos dias tem o mês
		$dias = date('t', strtotime($data));

		// número de linhas, arredondando para cima
		$linhas = ceil(($dia1 + $dias) / 7);

		// data de início do calendário: saber dias antes e depois do mês atual
		// diminui do primeiro dia do mês o número de dias que tem antes, que é igual ao número do dia da semana
		// domingo é 0 e fica na primeira coluna
		$data_inicio = date('Y-m-d', strtotime(- $dia1.' days', strtotime($data)));

		// data do final do calendário: primeiro dia + número de linhas x 7; menos 1 para contar o primeiro dia
		$data_fim = date('Y-m-d', strtotime( (- $dia1 + ($linhas*7) - 1 ).' days', strtotime($data)));

		$dados = array(
			'calendario' => $calendario->mostrarCalendario($data_inicio, $data_fim),
			'data' => $data,
			'mes_atual_extenso' => $mes_atual_extenso,
			'ano_atual' => $ano_atual,
			'dia1' => $dia1,
			'dias' => $dias,
			'linhas' => $linhas,
			'data_inicio' => $data_inicio,
			'data_fim' => $data_fim
		);

		$this->loadTemplate('calendario-mensal', $dados);
	}
}

?>