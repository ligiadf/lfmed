<?php

class Consultas extends Model {

	public function listarConsultas($offset, $limite, $md, $st) {
		$array = array();

		if(empty($_GET['md'])) { $md = ''; }
			else { $md = $_GET['md']; }

		if(empty($_GET['st'])) { $st = ''; }
			else { $st = $_GET['st']; }

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');

		if(!empty($md)){
			$filtroString[] = 'usuarios.id = :med_id';
		}
		switch ($st) {
			case 'm':
				$filtroString[] = 'consultas.con_status = 1';
				break;
			case 'r':
				$filtroString[] = 'consultas.con_status = 2';
				break;
			case 'a':
				$filtroString[] = 'consultas.con_status = 3';
				break;
			case 'c':
				$filtroString[] = 'consultas.con_status = 4';
				break;
			case 'i':
				$filtroString[] = 'consultas.con_status = 0';
				break;
		}

		$sql = "SELECT pacientes.nome, usuarios.nome as med_nome, usuarios.especialidade, consultas.con_inicio, consultas.con_fim, consultas.con_status, consultas.id
				FROM consultas
				LEFT JOIN pacientes ON pacientes.id = consultas.id_pac
				LEFT JOIN usuarios ON usuarios.id = consultas.id_med
				WHERE ".implode(' AND ', $filtroString)."
				ORDER BY con_inicio
				LIMIT $offset, $limite";
		if(empty($md) && empty($st)){
			$sql = $this->pdo->query($sql);
		}

		if(!empty($md) || !empty($st)){
			$sql = $this->pdo->prepare($sql);
			if(!empty($md)) {
				$sql->bindValue(":med_id", $md);
			}
			$sql->execute();
		}

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function listarConsultasPaciente($id) {
		$array = array();

		$sql = "SELECT pacientes.nome, pacientes.id, usuarios.nome as med_nome, usuarios.especialidade, consultas.con_inicio, consultas.con_fim, consultas.con_status, consultas.id, consultas.atestado_periodo, consultas.atestado_motivo, consultas.atestado_cid
				FROM consultas
				LEFT JOIN pacientes ON pacientes.id = consultas.id_pac
				LEFT JOIN usuarios ON usuarios.id = consultas.id_med
				WHERE pacientes.id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		} else {
			// echo "Não há consultas";
		}

		return $array;
	}

	public function listarConsultasMedico($id) {
		$array = array();

		$sql = "SELECT pacientes.nome, pacientes.id, usuarios.nome as med_nome, usuarios.id, consultas.con_inicio, consultas.con_fim, consultas.con_status, consultas.id as con_id
				FROM consultas
				LEFT JOIN pacientes ON pacientes.id = consultas.id_pac
				LEFT JOIN usuarios ON usuarios.id = consultas.id_med
				WHERE usuarios.id = :id
				ORDER BY con_inicio";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		} else {
			$msgSemConsultas = "Não há consultas";
		}

		return $array;
	}

	public function totalConsultas($md, $st) {

		if(empty($_GET['md'])) { $md = ''; }
			else { $md = $_GET['md']; }

		if(empty($_GET['st'])) { $st = ''; }
			else { $st = $_GET['st']; }

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');
		if(!empty($md)){
			$filtroString[] = 'usuarios.id = :med_id';
		}

		switch ($st) {
			case 'm':
				$filtroString[] = 'consultas.con_status = 1';
				break;
			case 'r':
				$filtroString[] = 'consultas.con_status = 2';
				break;
			case 'a':
				$filtroString[] = 'consultas.con_status = 3';
				break;
			case 'c':
				$filtroString[] = 'consultas.con_status = 4';
				break;
			case 'i':
				$filtroString[] = 'consultas.con_status = 0';
				break;
		}

		$sql = "SELECT COUNT(*) as c
				FROM consultas
				LEFT JOIN usuarios ON usuarios.id = consultas.id_med
				WHERE ".implode(' AND ', $filtroString)."";

		if(empty($md) && empty($st)){
			$sql = $this->pdo->query($sql);
		}

		if(!empty($md) || !empty($st)){
			$sql = $this->pdo->prepare($sql);
			if(!empty($md)) {
				$sql->bindValue(":med_id", $md);
			}
			$sql->execute();
		}

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['c'];

		} else {
			return 0;
		}
	}

	public function marcarConsulta($id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente, $statusConsulta) {
		$sql = "INSERT INTO consultas (id_med, id_pac, con_inicio, con_fim, con_status) VALUES (:id_med, :id_pac, :con_inicio, :con_fim, :con_status)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_med", $id_medico);
		$sql->bindValue(":id_pac", $paciente);
		$sql->bindValue(":con_inicio", $dtConsulta_inicio);
		$sql->bindValue(":con_fim", $dtConsulta_fim);
		$sql->bindValue(":con_status", $statusConsulta);
		$sql->execute();
	}

	public function marcarIndisponibilidade($id_medico, $dtConsulta_inicio, $dtConsulta_fim, $statusConsulta) {
		$sql = "INSERT INTO consultas (id_med, con_inicio, con_fim, con_status) VALUES (:id_med, :con_inicio, :con_fim, 0)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_med", $id_medico);
		$sql->bindValue(":con_inicio", $dtConsulta_inicio);
		$sql->bindValue(":con_fim", $dtConsulta_fim);
		$sql->execute();
	}

	public function verificarAgenda($id_medico, $dtConsulta_inicio, $dtConsulta_fim) {
		$sql = "SELECT * FROM consultas
				WHERE
				id_med = :id_medico AND
				(con_status = '0' OR con_status = '1' OR con_status = '2') AND
				( NOT ( :con_inicio >= con_fim OR :con_fim <= con_inicio ) )";
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

	public function detalheConsulta($id) {

		$array = array();

		$sql = "SELECT pacientes.nome pac_nome, pacientes.id as pac_id, pacientes.cpf, usuarios.nome as med_nome, usuarios.id as med_id, usuarios.especialidade, usuarios.crm, consultas.con_inicio, consultas.con_fim, consultas.con_status, consultas.id as con_id, consultas.atestado_motivo, consultas.atestado_periodo, consultas.atestado_cid
				FROM consultas
				LEFT JOIN pacientes ON pacientes.id = consultas.id_pac
				LEFT JOIN usuarios ON usuarios.id = consultas.id_med
				WHERE consultas.id = :id
				ORDER BY con_inicio";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;

	}

	public function editarConsulta($id, $id_medico, $dtConsulta_inicio, $dtConsulta_fim, $paciente='', $statusConsulta) {
		$sql = "UPDATE consultas
				SET id_med = :id_med, id_pac = :id_pac, con_inicio = :con_inicio, con_fim = :con_fim, con_status = :con_status 
				WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_med", $id_medico);
		$sql->bindValue(":id_pac", $paciente);
		$sql->bindValue(":con_inicio", $dtConsulta_inicio);
		$sql->bindValue(":con_fim", $dtConsulta_fim);
		$sql->bindValue(":con_status", $statusConsulta);
		$sql->execute();
	}

	public function adicionarAtestado($id, $atestadoPeriodo, $atestadoMotivo, $atestadoCID='') {
		$sql = "UPDATE consultas
				SET atestado_periodo = :atestadoPeriodo, atestado_motivo = :atestadoMotivo, atestado_cid = :atestadoCID
				WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":atestadoPeriodo", $atestadoPeriodo);
		$sql->bindValue(":atestadoMotivo", $atestadoMotivo);
		$sql->bindValue(":atestadoCID", $atestadoCID);
		$sql->execute();
	}

}

?>