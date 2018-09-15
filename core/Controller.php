<?php

class Controller {

	public function loadView($viewName, $viewData = array()) {
		extract($viewData); // transforma o que está no array em variáveis
		require 'views/'.$viewName.'.php';
	}

	// nos Controllers
	public function loadTemplate($viewName, $viewData = array()) {
		extract($viewData); // transforma o que está no array em variáveis
		require 'views/_template.php';
	}

	// nos Controllers - usuários deslogados
	public function loadTemplateGuest($viewName, $viewData = array()) {
		extract($viewData); // transforma o que está no array em variáveis
		require 'views/_template-guest.php';
	}

	// no _template.php
	public function loadViewInTemplate($viewName, $viewData = array()) {
		extract($viewData); // transforma o que está no array em variáveis
		require 'views/'.$viewName.'.php';
	}

}

?>