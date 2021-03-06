<?php

define("BASE_URL", "http://caminho-da-sua/instalacao/");
define("RAIZ", $_SERVER['DOCUMENT_ROOT']."/instalacao/");
define("NAME", "<i class=\"fab fa-github mr-1\"></i> <a href=\"https://github.com/ligiadf/lfmed\" target=\"_blank\">Sistema LFMED</a>");
define("VERSION", "0.5");
define("DEV", "<a href=\"http://lfreitas.info\" target=\"_blank\">LFreitas</a>");
define("LICENSE", "GNU General Public License v3.0");

define("NOME_CLINICA", "Nome da Clínica");
define("FONE_CLINICA", "(00) 1234-5678");
define("EMAIL_CLINICA", "contato@site-da-clinica.com.br");
define("END_CLINICA", "Endereço da Clínica");
define("LOGO_CLINICA", BASE_URL."assets/images/logo-da-clinica.png");

require ("db.php");

?>