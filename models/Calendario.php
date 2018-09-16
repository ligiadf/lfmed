<?php

class Calendario extends Model {

	public function mostrarCalendario($data_inicio, $data_fim, $filtros) {

		$array = array();

		if(empty($_GET['md'])) {
			$md = '';
		} else {
			$md = $_GET['md'];
		}

		if(empty($_GET['st'])) {
			$st = '';
		} else {
			$st = $_GET['st'];
		}

		// array vazio dá erro no SQL, então 1=1
		$filtroString = array('1=1');
		if(!empty($md)){
			$filtroString[] = 'usuarios.id = :med_id';
		}
		if( $st == 'm') {
			$filtroString[] = 'consultas.con_status = 1';
		}

		if( $st == 'r') {
			$filtroString[] = 'consultas.con_status = 2';
		}

		if( $st == 'i') {
			$filtroString[] = 'consultas.con_status = 0';
		}

		$sql = "SELECT pacientes.nome, usuarios.nome as med_nome, consultas.con_inicio, consultas.con_fim, consultas.con_status, consultas.id
				FROM consultas
				LEFT JOIN pacientes ON pacientes.id = consultas.id_pac
				LEFT JOIN usuarios ON usuarios.id = consultas.id_med
				WHERE
				( NOT ( :cal_inicio > con_fim OR :cal_fim < con_inicio ) )
				AND (con_status = 0 OR con_status = 1 OR con_status = 2)
				AND ".implode(' AND ', $filtroString)."
				ORDER BY con_inicio";

		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":cal_inicio", $data_inicio);
		$sql->bindValue(":cal_fim", $data_fim);

		if(!empty($md)){
			$sql->bindValue(":med_id", $md);
		}

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		//else echo "Não há consultas em ".$_GET['mes'];

		return $array;
	}
}

?>