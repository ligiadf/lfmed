<?php

class notfoundController extends Controller {

	public function index() {

		$dados = array();
		$this->loadTemplate('404',$dados);

	}


}

