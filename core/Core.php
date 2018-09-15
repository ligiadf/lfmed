<?php

class Core {

	// define rotas
	public function run() {
		// base_url/controller/action/parametro1/parametro2
		$url = '/';

		if(isset($_GET['url'])) {
			$url.= $_GET['url'];
		}

		$params = array(); // inicia vazio

		if(!empty($url) && $url != '/'){
			$url = explode('/', $url);
			array_shift($url); // remove primeiro item, que é vazio (antes da /)

			$currentController = $url[0].'Controller'; // consultasController
			array_shift($url); // remove Controller, deixa só Action e params
			
			if(isset($url[0]) && !empty($url[0])){
				$currentAction = $url[0]; 
				array_shift($url); // remove Action, deixa só params
			} else {
				$currentAction = 'index';
			}

			if(count($url) > 0) {
				$params = $url;
			}

		} else {
			// default:
			$currentController = 'homeController';
			$currentAction = 'index';
		}

		// 404
		if(!file_exists('controllers/'.$currentController.'.php') || !method_exists($currentController, $currentAction)  ) {
				$currentController = 'notfoundController';
				$currentAction = 'index';
		}

		// instanciar Controller definido acima, indo para arquivo pelo autoload
		$c = new $currentController();

		// executar sem saber o nome da action, permitindo passar parâmetros, se houverem
		call_user_func_array(array($c, $currentAction), $params);

		/*
		// DEBUG:
		echo "<p>controller: ".$currentController."</p>";
		echo "<p>action: ".$currentAction."</p>";
		echo "<p>parâmetros: ".print_r($params, true)."</p>";
		*/

	}

}

?>