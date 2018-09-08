<?php

class Calendario extends Model {

	public function mostrarCalendario($data_inicio, $data_fim) {

		$array = array();

		$sql = "SELECT pacientes.nome, usuarios.nome as med_nome, consultas.con_inicio, consultas.con_fim, consultas.con_status, consultas.id
				FROM consultas
				LEFT JOIN pacientes ON pacientes.id = consultas.id_pac
				LEFT JOIN usuarios ON usuarios.id = consultas.id_med
				WHERE
				( NOT ( :cal_inicio > con_fim OR :cal_fim < con_inicio ) )
				ORDER BY con_inicio";

		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":cal_inicio", $data_inicio);
		$sql->bindValue(":cal_fim", $data_fim);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		//else echo "Não há consultas em ".$_GET['mes'];

		return $array;
	}
}

?>