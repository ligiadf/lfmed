<?php

class controller {

	public function loadView($viewName, $viewData = array()) {
		extract($viewData); // transforma o que está no array em variáveis
		require 'views/'.$viewName.'.php';
	}

	// nos Controllers
	public function loadTemplate($viewName, $viewData = array()) {
		extract($viewData); // transforma o que está no array em variáveis
		require 'views/template.php';
	}

	// no template.php
	public function loadViewInTemplate($viewName, $viewData = array()) {
		extract($viewData); // transforma o que está no array em variáveis
		require 'views/'.$viewName.'.php';
	}
}

?>