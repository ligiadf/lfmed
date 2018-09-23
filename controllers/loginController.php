<?php

class loginController extends Controller {

	# URL: /login
	public function index() {

		$login = new Usuarios();

		//$dados = array();
		$email = '';
		$senha = '';
		$msgError = '';

		if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);

			if($login->fazerLogin($email, $senha)) {
				header('Location:'. BASE_URL);
			} else {
				$msgError = "E-mail e senha não conferem.";
			}
		}
		$dados = array(
			'email' => $email,
			'senha' => $senha,
			'msgError' => $msgError
		);

		$this->loadTemplateGuest('login', $dados);

	}

	# URL: /login/sair
	public function sair() {
		
		unset($_SESSION['uLogin']);
		$msgOK = 'Você saiu com sucesso do sistema.';
		header('Location:'. BASE_URL.'login?msgOK='.urlencode($msgOK));

	}

}

?>