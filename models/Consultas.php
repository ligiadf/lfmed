<?php

class Consultas extends model {

	public function listarConsultas() {
		$array = array();

		$sql = "SELECT pacientes.nome, usuarios.nome as med_nome, consultas.con_inicio, consultas.con_fim, consultas.con_status, consultas.id
				FROM consultas
				LEFT JOIN pacientes ON pacientes.id = consultas.id_pac
				LEFT JOIN usuarios ON usuarios.id = consultas.id_med
				ORDER BY con_inicio";
		$sql = $this->pdo->query($sql);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		else echo "Não há consultas";

		return $array;
	}

	public function totalConsultas() {
		$sql = "SELECT COUNT(*) as c FROM consultas";
		$sql = $this->pdo->query($sql);

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

}

?>