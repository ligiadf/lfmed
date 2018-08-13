<?php

class Consultas {

	// para usar conexao com db
	private $pdo;
	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function listaConsultas() {
		$array = array();

		$sql = "SELECT * FROM consultas ORDER BY id_med,con_inicio";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há consultas";

		return $array;
	}

	public function calendarioConsultas($data_inicio, $data_fim) {
		$array = array();

		// SELECT * FROM consultas WHERE con_status = 'Marcada' AND ( NOT ( '2018-08-14 00:00' > con_fim OR '2018-08-14 23:59' < con_inicio ) ) ORDER BY con_inicio;

		// SELECT * FROM consultas WHERE con_status = 'Marcada' AND ( NOT ( con_inicio > '2018-08-14 23:59' OR con_fim < '2018-08-14 00:00' ) ) ORDER BY con_inicio;

		$sql = "SELECT * FROM consultas
				WHERE
				(con_status = 'Marcada' OR con_status = 'Realizada' ) AND
				( NOT ( :cal_inicio > con_fim OR :cal_fim < con_inicio ) )
				# ( NOT ( con_inicio > :cal_fim OR con_fim < :cal_inicio ) )
				ORDER BY con_inicio";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":cal_inicio", $data_inicio);
		$sql->bindValue(":cal_fim", $data_fim);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há consultas em ". $_GET['ano'].'-'.$_GET['mes'];

		return $array;
	}

		/*
		SELECT * FROM consultas
		WHERE id_med = '2' AND
		con_status = 'Marcada' AND
		( NOT ( '2018-08-14 11:00' > con_fim OR '2018-08-14 11:30' < con_inicio ) );
		*/

	public function verificarAgenda($id_medico, $dtConsulta_inicio, $dtConsulta_fim) {
		$sql = "SELECT * FROM consultas
				WHERE
				id_med = :id_medico AND
				con_status = 'Marcada' AND
				( NOT ( :con_inicio > con_fim OR :con_fim < con_inicio ) )";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_medico", $id_medico);
		$sql->bindValue(":con_inicio", $dtConsulta_inicio);
		$sql->bindValue(":con_fim", $dtConsulta_fim);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return false; // horário do médico não disponível
		} 
		else {
			return true;
		}
	}

	public function marcar($id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente, $statusConsulta) {
		$sql = "INSERT INTO consultas (id_med, id_pac, con_inicio, con_fim, con_status) VALUES (:id_med, :id_pac, :con_inicio, :con_fim, :con_status)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_med", $id_medico);
		$sql->bindValue(":id_pac", $paciente);
		$sql->bindValue(":con_inicio", $dtConsulta_inicio);
		$sql->bindValue(":con_fim", $dtConsulta_fim);
		$sql->bindValue(":con_status", $statusConsulta);
		$sql->execute();
	}

}

?>