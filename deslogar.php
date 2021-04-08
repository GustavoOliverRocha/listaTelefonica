<?php
require_once "Controllers/UsuarioController.php";
$uc = new UsuarioController();
$uc->deslogar();
header("Location: index.php");

?>