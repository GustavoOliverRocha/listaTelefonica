<?php

require_once "Lib/Application.php";
//Os controllers conseguem ter acesso ao Application por  que ele está sendo instanciado no index
$a = new Application();
$a->importarController();

?>